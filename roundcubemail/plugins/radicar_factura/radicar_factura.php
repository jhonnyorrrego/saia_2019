<?php

/**
 * Radicacion de Facturas SAIA
 */
class radicar_factura extends rcube_plugin {

    public $task = 'mail';

    private $charset = 'ASCII';

    private $conn;

    private $ruta_saia;

    private $valid_types = array(
        "pdf",
        "xml"
    );

    // private $valid_types = array("pdf", "xml", "eml");
    function init() {

        $this->_inicializarSaia();

        $rcmail = rcmail::get_instance();

        $this->register_action('plugin.radicar_factura', array(
            $this,
            'request_action'
        ));
        // $this->add_hook('storage_init', array($this, 'storage_init'));

        if ($rcmail->action == '' || $rcmail->action == 'show') {
            $this->include_script('radicar_factura.js');
            $this->add_texts('localization', true);
            $this->charset = $rcmail->config->get('radicar_factura_charset', RCUBE_CHARSET);
            $this->add_button(array(
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
        $this->add_texts('localization');

        $rcmail = rcmail::get_instance();
        $storage = $rcmail->get_storage();

        $temp_dir = $rcmail->config->get('temp_dir');

        $almacenamiento = StorageUtils::get_storage_path("TEMPORAL");
        if (!$almacenamiento) {
            $almacenamiento = StorageUtils::get_storage_path($temp_dir);
        }
        $str_tmp_dir = new Stringy\Stringy($temp_dir);
        $temp_dir = (string) $str_tmp_dir->ensureRight("/");

        if (!is_dir($temp_dir)) {
            mkdir($temp_dir);
            chmod($temp_dir, 0777);
        }
        if (!is_writable($temp_dir)) {
            $rcmail->output->command('display_message', $this->gettext('errpermisorwtmp') . ": $temp_dir", 'error');
            return false;
        }

        $info_correo = array();
        $idgrupo = uniqid();
        $buzon = null;
        foreach (rcmail::get_uids() as $mbox => $uids) {
            if(empty($buzon)) {
                $buzon = $mbox;
            }
            $conteo_xml = 0;
            $conteo_pdf = 0;
            foreach ($uids as $idcorreo) {
                $tempfiles = array();
                $dato_correo = array();
                $message = new rcube_message($idcorreo);
                rcmail_check_safe($message);
                $dato_correo["idgrupo"] = $idgrupo;
                $dato_correo["asunto"] = $message->subject;
                $dato_correo["fecha_oficio_entrada"] = date("Y-m-d H:i:s", $message->headers->timestamp);
                $dato_correo["from"] = $message->headers->from;
                $dato_correo["buzon"] = $mbox;
                $dato_correo["uid"] = $idcorreo;
                $dato_correo["to"] = $message->headers->to;
                $dato_correo["cc"] = $message->headers->cc;
                $dato_correo["cco"] = $message->headers->cco;

                foreach ($message->attachments as $part) {
                    $pid = $part->mime_id;
                    $part = $message->mime_parts[$pid];
                    $filename = $part->filename;
                    if (empty($filename)) {
                        $ext = (array) rcube_mime::get_mime_extensions($part->mimetype);
                        $ext = array_shift($ext);
                        $filename = $rcmail->gettext('messagepart') . ' ' . $pid;
                        if ($ext) {
                            $filename .= '.' . $ext;
                        }
                    }
                    $ext_arch = pathinfo($filename, PATHINFO_EXTENSION);
                    $valido = array();
                    // $rcmail -> output -> command('display_message', $ext_arch, 'warning');
                    if (!empty($ext_arch)) {
                        $valido = preg_grep("/$ext_arch$/i", $this->valid_types);
                    }
                    if (empty($valido)) {
                        continue;
                    }
                    if (preg_match("/xml/i", $ext_arch)) {
                        $conteo_xml++;
                    }
                    if (preg_match("/pdf/i", $ext_arch)) {
                        $conteo_pdf++;
                    }
                    $tmpfn = $temp_dir . uniqid() . "___" . $this->_convert_filename($filename);
                    $tmpfp = fopen($tmpfn, 'w');
                    $tempfiles[] = $tmpfn;
                    $message->get_part_body($part->mime_id, false, 0, $tmpfp);
                    fclose($tmpfp);
                }
                $tmpfn = $temp_dir . uniqid() . "___mail.eml";
                $tmpfp = fopen($tmpfn, 'w');
                $storage->get_raw_body($idcorreo, $tmpfp);
                fclose($tmpfp);
                $tempfiles[] = $tmpfn;
                $dato_correo["adjuntos"] = $tempfiles;
                if ($conteo_xml < 1) {
                    $rcmail->output->command('display_message', $this->gettext('errarchivosxml'), 'error');
                    return false;
                }
                if ($conteo_pdf < 1) {
                    $rcmail->output->command('display_message', $this->gettext('errarchivospdf'), 'notice');
                    //return false;
                }
                if ($conteo_pdf != $conteo_xml) {
                    $rcmail->output->command('display_message', $this->gettext('errnumarchivos'), 'notice');
                    //return false;
                }
                $info_correo[] = $dato_correo;
            }
        }

        $saia_key = $_REQUEST["saia_key"];
        $respuesta = $this->_enviarPeticion($saia_key, $info_correo);
        $json = json_decode($respuesta, true);

        if(empty($json)) {
            $json = array('message' =>$respuesta);
        }
        if(isset($json["status"]) && $json["status"] == 1) {
            $rcmail->output->command('display_message', $this->gettext('msgfacturaradicada'), 'confirmation');
            //$this->_moverCorreos($buzon);
        } else if(isset($json["message"])) {
            $rcmail->output->command('display_message', $json["message"], 'error');
        }

        $rcmail->output->command('plugin.procesar_respuesta', $json);
        $rcmail->output->send();
    }

    private function _moverCorreos($buzon) {
        $rcmail  = rcmail::get_instance();
        $storage = $rcmail->get_storage();
        //$storage->move_message(rcmail::get_uids(), "Facturas SAIA");
        $moved = $this->conn->move(rcmail::get_uids(), $buzon, "Facturas SAIA");
        /*foreach (rcmail::get_uids() as $mbox => $uids) {
            $storage->unset_flag($uids, 'NONJUNK', $mbox);
            $storage->set_flag($uids, 'JUNK', $mbox);
        }

        if (($junk_mbox = $rcmail->config->get('junk_mbox'))) {
            $rcmail->output->command('move_messages', $junk_mbox);
        }*/

    }

    private function _convert_filename($str) {
        $str = rcube_charset::convert($str, RCUBE_CHARSET, $this->charset);
        return strtr($str, array(
            ':' => '',
            '/' => '-'
        ));
    }

    private function _enviarPeticion($saia_key, $dato_correo) {
        $ruta_formato = $this->ruta_saia . 'app/factura/radicar_factura.php';
        $ch = curl_init($ruta_formato);
        $timeout = 15;
        #curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        if (strpos(PROTOCOLO_CONEXION, 'https') !== false) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        $fields_string = json_encode($dato_correo);
        if(!$fields_string) {
            return ["status" => "error"];
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, array("datos_correo" => $fields_string, "saia_key" => $saia_key));
        $result = curl_exec($ch);
        curl_close ($ch);

        // delete temporary file ##
        //@unlink($sTmpFile);
        return $result;
    }

    private function _inicializarSaia() {
        global $conn;
        $max_salida = 10;
        $ruta_db_superior = $ruta = "";
        while ($max_salida > 0) {
            if (is_file($ruta . "db.php")) {
                $ruta_db_superior = $ruta;
            }
            $ruta .= "../";
            $max_salida--;
        }

        $conn_tmp = $conn;

        require_once ($ruta_db_superior . "vendor/autoload.php");
        include_once ($ruta_db_superior . "db.php");
        $this->ruta_saia = PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/";
        if(empty($conn_tmp)) {
            $conn_tmp = $conn;
        }

        $this->conn = $conn_tmp;
    }

}
