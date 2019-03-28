<?php
/**
 * Radicacion de Facturas SAIA
 */

class radicar_factura_beta extends rcube_plugin {
	public $task = 'mail';
	private $charset = 'ASCII';

	private $valid_types = array("pdf", "xml");
	//private $valid_types = array("pdf", "xml", "eml");
	function init() {
		$rcmail = rcmail::get_instance();

		$this -> register_action('plugin.radicar_factura', array(
			$this,
			'request_action'
		));
		//$this->add_hook('storage_init', array($this, 'storage_init'));

		if ($rcmail -> action == '' || $rcmail -> action == 'show') {
			$this -> include_script('radicar_factura.js');
			$this -> add_texts('localization', true);
			$this -> charset = $rcmail -> config -> get('radicar_factura_charset', RCUBE_CHARSET);
			$this -> add_button(array(
				'type' => 'link',
				'label' => 'buttontext',
				'command' => 'plugin.radicar_factura',
				'class' => 'button buttonPas junk disabled',
				'classact' => 'button junk',
				'title' => 'buttontitle',
				'domain' => 'radicar_factura'
			), 'toolbar');
		}
	}

	function request_action() {
		$max_salida = 10;
		$ruta_db_superior = $ruta = "";
		while ($max_salida > 0) {
			if (is_file($ruta . "db.php")) {
				$ruta_db_superior = $ruta;
			}
			$ruta .= "../";
			$max_salida--;
		}
		global $conn;
		require_once($ruta_db_superior."vendor/autoload.php");
		include_once ($ruta_db_superior . "db.php");
		$this -> add_texts('localization');

		$rcmail = rcmail::get_instance();
		$storage = $rcmail -> get_storage();
		$dato_correo = array();
		$tempfiles = array();

		$temp_dir = $rcmail -> config -> get('temp_dir');

		$almacenamiento = StorageUtils::get_storage_path("TEMPORAL");
		if(!$almacenamiento) {
		    $almacenamiento = StorageUtils::get_storage_path($temp_dir);
		}
		$str_tmp_dir = new Stringy\Stringy($temp_dir);
		$temp_dir = (string) $str_tmp_dir->ensureRight("/");

		if(!is_dir($temp_dir)) {
		    mkdir($temp_dir);
		    chmod($temp_dir, 0777);
		}
		if(!is_writable($temp_dir)) {
		    $rcmail -> output -> command('display_message', $this -> gettext('errpermisorwtmp') . ": $temp_dir", 'error');
		    return false;
		}

		$conteo_xml = 0;
		foreach (rcmail::get_uids() as $mbox => $uids) {
			$message = new rcube_message($uids[0]);
			rcmail_check_safe($message);
			$dato_correo["asunto"] = $message -> subject;
			$dato_correo["fecha_oficio_entrada"] = date("Y-m-d H:i:s", $message -> headers -> timestamp);
			$dato_correo["from"] = $message -> headers -> from;
			$dato_correo["tipo_radicado"] = $mbox;
			$dato_correo["to"] = $message -> headers -> to . "-" . $message -> headers -> cc . "--" . $message -> headers -> cco;

			foreach ($message->attachments as $part) {
				$pid = $part -> mime_id;
				$part = $message -> mime_parts[$pid];
				$filename = $part -> filename;
				if (empty($filename)) {
					$ext = (array)rcube_mime::get_mime_extensions($part -> mimetype);
					$ext = array_shift($ext);
					$filename = $rcmail -> gettext('messagepart') . ' ' . $pid;
					if ($ext) {
						$filename .= '.' . $ext;
					}
				}
				$ext_arch = pathinfo($filename,  PATHINFO_EXTENSION);
				$valido = array();
				//$rcmail -> output -> command('display_message', $ext_arch, 'warning');
				if(!empty($ext_arch)) {
    				$valido = preg_grep("/$ext_arch$/i", $this->valid_types);
				}
				if(empty($valido)) {
				    continue;
				}
				if(preg_match("/xml/i", $ext_arch)) {
				    $conteo_xml++;
				}
				$tmpfn = $temp_dir . uniqid() . "___" . $this -> _convert_filename($filename);
				$tmpfp = fopen($tmpfn, 'w');
				$tempfiles[] = $tmpfn;
				$message -> get_part_body($part -> mime_id, false, 0, $tmpfp);
				fclose($tmpfp);
			}
			$tmpfn = $temp_dir . uniqid() . "___mail.eml";
			$tmpfp = fopen($tmpfn, 'w');
			$storage -> get_raw_body($uids[0], $tmpfp);
			fclose($tmpfp);
			$tempfiles[] = $tmpfn;
			$dato_correo["adjuntos"] = $tempfiles;
		}
		if($conteo_xml < 1) {
		    $rcmail -> output -> command('display_message', $this -> gettext('errarchivosxml'), 'error');
		    return false;
		}

		$rcmail -> output -> command('display_message', $this -> gettext('msgfacturaradicada'), 'confirmation');
		$rcmail -> dato_correo = $dato_correo;
		$configuracion = busca_filtro_tabla("", "configuracion", "tipo='correo' AND nombre='formato_correo'", "", $conn);
		$ruta_formato = 'pruebas_factura/radicar_factura.php';
		/*if ($configuracion["numcampos"]) {
			$ruta_formato = $configuracion[0]["valor"];
		}*/
		$rcmail -> output -> command('redirect', $ruta_db_superior . $ruta_formato . "?datos_correo=" . json_encode($dato_correo), '');
		$rcmail -> output -> send();
	}

	private function _convert_filename($str) {
		$str = rcube_charset::convert($str, RCUBE_CHARSET, $this -> charset);
		return strtr($str, array(
			':' => '',
			'/' => '-'
		));
	}

}
