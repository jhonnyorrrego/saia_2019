<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
  if (is_file($ruta . "db.php")){
    $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}

// POSTERIOR AL APROBAR, se debe definir la variable ruta_db_superior desde donde se hace el llamado.
include_once ($ruta_db_superior . "pantallas/lib/PhpWord/funciones_include.php");
// require_once($ruta_db_superior.'pantallas/lib/PHPWord/src/PhpWord/Autoloader.php');
require_once ($ruta_db_superior . 'pantallas/lib/PhpWord/Autoloader.php');
date_default_timezone_set('UTC');

/**
 * Header file
 */
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;

error_reporting(E_ALL);

if (! defined('CLI')) {
define('CLI', (PHP_SAPI == 'cli') ? true : false);
define('EOL', CLI ? PHP_EOL : '<br />');
define('SCRIPT_FILENAME', basename($_SERVER['SCRIPT_FILENAME'], '.php'));
define('IS_INDEX', SCRIPT_FILENAME == 'index');
}

Autoloader::register();
Settings::loadConfig();
class RadicadoWord {
	private $idocumento;
	private $ruta_docx;
	private $combinar;
	private $archivo_csv;
	private $alm_csv;
	private $ruta_procesar;
	private $idformato;
	private $campo_qr_word = "codigo_qr";
	private $ruta_combinar;
	private $temp_fs;
	private $ruta_plantilla;
	private $alm_plantilla;

	public function __construct($iddoc) {
	    global $ruta_db_superior;
	    $this->ruta_db_superior = $ruta_db_superior;
		$this->iddocumento = $iddoc;
		$this->ruta_docx = '';
		$this->archivo_csv = null;
<<<<<<< HEAD
<<<<<<< HEAD
		$this->alm_csv = null;
=======
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
		$this->combinar = false;
		$this->ruta_procesar = null;
		$this->idformato = null;
		$this->prepare();
	}

	protected function prepare() {
		global $conn;
		if(@$this->iddocumento) {
			$anexo = busca_filtro_tabla("d.ruta, b.idformato", "documento a, formato b, campos_formato c, anexos d", "lower(a.plantilla)=b.nombre AND b.idformato=c.formato_idformato AND c.nombre='anexo_word' AND c.idcampos_formato=d.campos_formato AND a.iddocumento=" . $this->iddocumento . " AND d.documento_iddocumento=" . $this->iddocumento, "", $conn);
			$anexo_csv = busca_filtro_tabla("d.ruta", "documento a, formato b, campos_formato c, anexos d", "lower(a.plantilla)=b.nombre AND b.idformato=c.formato_idformato AND c.nombre='anexo_csv' AND c.idcampos_formato=d.campos_formato AND a.iddocumento=" . $this->iddocumento . " AND d.documento_iddocumento=" . $this->iddocumento, "", $conn);
			if(@$anexo['numcampos']) {

				$arr_ruta = StorageUtils::resolver_ruta($anexo[0]["ruta"]);
				$this->temp_fs = StorageUtils::get_memory_filesystem("tmp_docx", "saia");
				$this->ruta_docx = "saia://tmp_docx/docx/";
				// $ruta_imagen = "saia://tmp_docx/firma_temp";

				// $ruta_anexo = explode('anexos', $anexo[0]["ruta"]);
				// $this->ruta_combinar = $this->ruta_db_superior . $ruta_anexo[0] . 'pdf_temp/';
				// $this->ruta_docx = $this->ruta_db_superior . $ruta_anexo[0] . 'docx/';
				$this->idformato = $anexo[0]["idformato"];
			}
			if(@$anexo_csv['numcampos']) {
				$this->alm_csv = StorageUtils::resolver_ruta($anexo_csv[0]["ruta"]);
				// $this->archivo_csv = $this->ruta_db_superior . $anexo_csv[0]["ruta"];
				$this->ruta_combinar = StorageUtils::obtener_tempdir();
				$this->combinar = true;
			}

			if (!$arr_ruta["error"]) {
				$this->ruta_plantilla = $arr_ruta["ruta"];
				$this->alm_plantilla = $arr_ruta["clase"];
				// copiar desde el almacen al temporal
				$archivo_plantilla = $this->alm_plantilla->get_filesystem()->get($this->ruta_plantilla);
				$this->ruta_procesar = $this->ruta_docx . basename($archivo_plantilla->getName());

				if (! $this->temp_fs->write("docx/" . basename($archivo_plantilla->getName()), $archivo_plantilla->getContent(), true)) {
					die("No se pudo copiar el archivo: " . basename($archivo_plantilla->getName()));
				}
			} else {
				die($arr_ruta["mensaje"]);
			}
		}
	}

	public function asignar_radicado() {
		global $conn;
		if (is_file($this->ruta_procesar)) {
			
			// $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($this->ruta_docx . 'documento_word.docx');
			$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($this->ruta_procesar);
			
			$campos_word = $templateProcessor->getVariables();
			
			if(@$this->iddocumento && count($campos_word)) {
				$numero_radicado = busca_filtro_tabla("", "documento", "iddocumento=" . $this->iddocumento, "", $conn);
				$radicado = $numero_radicado[0]['numero'];
				if(!$this->combinar) {
				    //echo "NO COMBINAR<br>";
					$templateProcessor->setValue('formato_numero', $radicado);
					
					if(in_array($this->campo_qr_word, $campos_word)) {

						$src_qr = $this->obtener_codigo_qr($idformato, $_REQUEST["iddoc"]);
						$arr_alm_qr = StorageUtils::resolver_ruta($src_qr);
						$alm_qr = $arr_alm_qr["clase"];
						$archivo_qr = $alm_qr->get_filesystem()->get($arr_alm_qr["ruta"]);

						$ext_qr = "." . pathinfo($arr_alm_qr["ruta"], PATHINFO_EXTENSION);
						$src = StorageUtils::obtener_archivo_temporal("qr_");
						file_put_contents($src, $archivo_qr->getContent());
						rename($src, $src . $ext_qr);
						$src .= $ext_qr;

						// $src = $this->ruta_db_superior . $this->obtener_codigo_qr();
						
						$img2 = array(
							array(
								'img' => htmlspecialchars($src),
								'size' => array(
									100,
									100
								)
							)
						);
						$templateProcessor->setImg($this->campo_qr_word, $img2);
					}
					
					$archivo_out = 'documento_word';
					
					$extension_doc = '.docx';
					
					/*
					 * if(is_file($this->ruta_docx . $archivo_out . $extension_doc)) {
					 * unlink($this->ruta_docx . $archivo_out . $extension_doc);
					 * unlink($this->ruta_docx . $archivo_out . '.pdf');
					 * }
					 */
					$marca_agua = mostrar_estado_documento($_REQUEST['iddoc']);
					$templateProcessor->setTextWatermark($marca_agua);
					$templateProcessor->saveAs($this->ruta_docx . $archivo_out . $extension_doc);
					
					$ruta_temporal = busca_filtro_tabla("valor", "configuracion", "nombre='ruta_temporal'", "", $conn);
					$ruta_tmp_usr = $ruta_temporal[0]["valor"] . "_" . usuario_actual("login");
					$word_temp = StorageUtils::obtener_archivo_temporal($archivo_out, $ruta_tmp_usr);
					copy($this->ruta_docx . $archivo_out . $extension_doc, $word_temp);
					rename($word_temp, $word_temp . $extension_doc);

					if (is_file($word_temp . $extension_doc)) {
						$comando = 'export HOME=/tmp && libreoffice5.1 --headless --convert-to pdf:writer_pdf_Export --outdir ' . dirname($word_temp) . ' ' . $word_temp . $extension_doc;
						$var = shell_exec($comando);
					}
				} else {
				    //echo "COMBINAR<br>";
					$this->ruta_combinar = StorageUtils::obtener_tempdir();
					$tipo_alm_csv = $this->alm_csv["clase"];
					$csv_file = $tipo_alm_csv->get_filesystem()->get($this->alm_csv["ruta"]);
					$this->archivo_csv = $this->ruta_combinar . "/tmp_csv.csv";
					file_put_contents($this->archivo_csv, $csv_file->getContent());
					// crear_destino($this->ruta_combinar);
					// chmod($this->ruta_combinar, 0777);

					$this->combinar_documento($radicado);
				}
			} // fin si existe iddoc y el word tiene campos del formato
		} else { // fin si existe word
<<<<<<< HEAD
<<<<<<< HEAD
			die("No existe la plantilla" . $this->ruta_procesar);
=======
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
		    die("No existe la plantilla" . $this->ruta_docx . 'documento_word.docx');
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
		}
	}

	protected function combinar_documento($numero_radicado) {
		global $conn;
		
<<<<<<< HEAD
<<<<<<< HEAD
		$archivo_original = $this->ruta_procesar;
=======
		$archivo_original = $this->ruta_docx . 'documento_word.docx';
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
		$archivo_original = $this->ruta_docx . 'documento_word.docx';
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
		$marca_agua = mostrar_estado_documento($this->iddocumento);
		$extension_doc = '.docx';

		$datos = $this->cargar_csv($this->archivo_csv);
		for($i = 0; $i < count($datos); $i++) {
			// Cada elemento es un array campo => valor
			$archivo_out = "documento_word_" . ($i + 1);
<<<<<<< HEAD
			$archivo_copia = $this->ruta_combinar . "/$archivo_out" . $extension_doc;
=======
			$archivo_copia = $this->ruta_combinar . $archivo_out . $extension_doc;
<<<<<<< HEAD
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
			copy($archivo_original, $archivo_copia);
			$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($archivo_copia);
			$campos_word = $templateProcessor->getVariables();
			$templateProcessor->setValue('formato_numero', $numero_radicado);
			if(in_array($this->campo_qr_word, $campos_word)) {
				// $src = $this->ruta_db_superior . $this->obtener_codigo_qr();

				$src_qr = $this->obtener_codigo_qr($this->idformato, $this->iddocumento);
				$arr_alm_qr = StorageUtils::resolver_ruta($src_qr);
				$alm_qr = $arr_alm_qr["clase"];
				$archivo_qr = $alm_qr->get_filesystem()->get($arr_alm_qr["ruta"]);

				$ext_qr = "." . pathinfo($arr_alm_qr["ruta"], PATHINFO_EXTENSION);
				$src = StorageUtils::obtener_archivo_temporal("qr_");
				file_put_contents($src, $archivo_qr->getContent());
				rename($src, $src . $ext_qr);
				$src .= $ext_qr;

				$img2 = array(
					array(
						'img' => htmlspecialchars($src),
						'size' => array(
							100,
							100
						)
					)
				);
				$templateProcessor->setImg($this->campo_qr_word, $img2);
			}

			foreach($datos[$i] as $campo => $valor) {
				if(in_array($campo, $campos_word)) {
					$templateProcessor->setValue($campo, $valor);
				} else {
					die("No se encontr&oacute; el campo $campo en la plantilla");
				}
			}

			if(file_exists($archivo_copia)) {
				unlink($archivo_copia);
			}
			
			$templateProcessor->setTextWatermark($marca_agua);
			$templateProcessor->saveAs($archivo_copia);
			$templateProcessor = null;
		}
	
		if(is_dir($this->ruta_combinar)) {
			$comando1 = 'export HOME=/tmp && libreoffice5.1 --headless -print-to-file --outdir ' . $this->ruta_combinar . ' ' . $this->ruta_combinar . "/*" . $extension_doc;
			$var1 = shell_exec($comando1);
			if (file_exists($this->ruta_combinar . "/documento_word.pdf")) {
				unlink($this->ruta_combinar . "/documento_word.pdf");
			}
			$entrada_ps = $this->ruta_combinar . "/*.ps";
			$salida_ps = $this->ruta_combinar . "/documento_word.pdf";
			$comando2 = "gs -sDEVICE=pdfwrite -dNOPAUSE -dBATCH -dSAFER -sOutputFile=" . $salida_ps . " " . $entrada_ps;
			$var2 = shell_exec($comando2);

			$pdf_name = "documento_word";
			$dir_name = rtrim(dirname($this->ruta_plantilla), "anexos");
			$dir_name .= "docx/";

			$this->alm_plantilla->copiar_contenido_externo($salida_ps, $dir_name . $pdf_name . ".pdf");

			//print_r($entrada_ps);echo "<br>";
			//print_r($salida_ps);echo "<br>";
			//print_r($var2);echo "<br>";
			// $comando2 = 'export HOME=/tmp && libreoffice5.1 --headless --convert-to pdf:writer_pdf_Export --outdir ' . $directorio_out . ' ' . $directorio_out . "*" . $extension_doc;
		}
		//die();
	}
	
	private function obtener_codigo_qr() {
		global $conn, $ruta_db_superior;
		$codigo_qr = busca_filtro_tabla("", "documento_verificacion", "documento_iddocumento=" . $this->iddocumento, "", $conn);
		
		if(!$codigo_qr['numcampos']) {
			include_once ($this->ruta_db_superior . "pantallas/qr/librerias.php");
			generar_codigo_qr($this->idformato, $this->iddocumento);
			
			$codigo_qr = busca_filtro_tabla("", "documento_verificacion", "documento_iddocumento=" . $this->iddocumento, "", $conn);
		}
		
		return $codigo_qr[0]['ruta_qr'];
	}

	private function cargar_csv($inputFileName) {
		$resp = array();
		$fila = 1;
		$header = array();
		$head_size = -1;
		if(($gestor = fopen($inputFileName, "r")) !== FALSE) {
			while(($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
				if($fila == 1) {
					$header = $datos;
					$head_size = count($datos);
					$fila++;
					continue;
				}
				$numero = count($datos);
				if($numero > $head_size) {
					$mensaje = "Cantidad de datos excede el número de campos ($numero > $head_size) en la línea $fila";
					die($mensaje);
				}
				$fila++;
				$campos_fila = array();
				for($c = 0; $c < $numero; $c++) {
					$campos_fila[$header[$c]] = $datos[$c];
					// echo "{$header[$c]} = {$datos[$c]}<br />\n";
				}
				$resp[] = $campos_fila;
			}
			fclose($gestor);
		}
		return $resp;
	}
}
?>
