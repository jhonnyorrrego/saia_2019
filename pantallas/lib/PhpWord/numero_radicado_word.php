<?php

// POSTERIOR AL APROBAR, se debe definir la variable ruta_db_superior desde donde se hace el llamado.
include_once ($ruta_db_superior . "pantallas/lib/PhpWord/funciones_include.php");
// require_once($ruta_db_superior.'pantallas/lib/PHPWord/src/PhpWord/Autoloader.php');
require_once ($ruta_db_superior . 'pantallas/lib/PhpWord/Autoloader.php');

require_once ($ruta_db_superior . 'vendor/autoload.php');
require_once $ruta_db_superior . 'StorageUtils.php';
require_once $ruta_db_superior . 'filesystem/SaiaStorage.php';

use Stringy\StaticStringy as StringUtils;


date_default_timezone_set('UTC');

/**
 * Header file
 */
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use function Gaufrette\Adapter\file_exists;

error_reporting(E_ALL);

error_reporting(E_ALL);

if (!defined('CLI')) {
define('CLI', (PHP_SAPI == 'cli') ? true : false);
define('EOL', CLI ? PHP_EOL : '<br />');
define('SCRIPT_FILENAME', basename($_SERVER['SCRIPT_FILENAME'], '.php'));
define('IS_INDEX', SCRIPT_FILENAME == 'index');
}

Autoloader::register();
Settings::loadConfig();

// Return to the caller script when runs by CLI
if(CLI) {
	return;
}

/**
 * Write documents
 *
 * @param \PhpOffice\PhpWord\PhpWord $phpWord        	
 * @param string $filename        	
 * @param array $writers        	
 *
 * @return string
 */

// ini_set('display_errors',true);

if(@$iddoc) {
	$_REQUEST["iddoc"] = $iddoc;
}

$ruta_procesar = '';
if(@$_REQUEST["iddoc"]) {
	$anexo = busca_filtro_tabla("d.ruta, b.idformato", "documento a, formato b, campos_formato c, anexos d", "lower(a.plantilla)=b.nombre AND b.idformato=c.formato_idformato AND c.nombre='anexo_word' AND c.idcampos_formato=d.campos_formato AND a.iddocumento=" . $_REQUEST["iddoc"] . " AND d.documento_iddocumento=" . $_REQUEST["iddoc"], "", $conn);
	$anexo_csv = busca_filtro_tabla("d.ruta", "documento a, formato b, campos_formato c, anexos d", "lower(a.plantilla)=b.nombre AND b.idformato=c.formato_idformato AND c.nombre='anexo_csv' AND c.idcampos_formato=d.campos_formato AND a.iddocumento=" . $_REQUEST["iddoc"] . " AND d.documento_iddocumento=" . $_REQUEST["iddoc"], "", $conn);
}

$ruta_docx = '';
$archivo_csv = null;
$combinar = false;
$idformato = null;
$ruta_combinar = null;

if(@$anexo['numcampos']) {
	$arr_ruta = StorageUtils::resolver_ruta($anexo[0]["ruta"]);

	$temp_fs = StorageUtils::get_memory_filesystem("tmp_docx", "saia");

	$ruta_docx = "saia://tmp_docx/docx";
	$ruta_imagen = "saia://tmp_docx/firma_temp";
	//$ruta_anexo = explode('anexos', $anexo[0]["ruta"]);
	//$ruta_combinar = $ruta_db_superior . $ruta_anexo[0] . 'pdf_temp/';
	//$ruta_docx = $ruta_db_superior . $ruta_anexo[0] . 'docx/';
	$idformato = $anexo[0]["idformato"];
}

if ($arr_ruta["error"]) {
	die("Error: " . $arr_ruta["mensaje"]);
}

if(@$anexo_csv['numcampos']) {
	$archivo_csv = StorageUtils::resolver_ruta($anexo_csv[0]["ruta"]);
	$combinar = true;
}

if($arr_ruta["ruta"] != '') {
	$ruta_plantilla = $arr_ruta["ruta"];
	$alm_plantilla = $arr_ruta["clase"];
	// copiar desde el almacen al temporal
	$archivo_plantilla = $alm_plantilla->get_filesystem()->get($ruta_plantilla);
	$ruta_procesar = "saia://tmp_docx/" . basename($archivo_plantilla->getName());
	
	$temp_fs->write(basename($archivo_plantilla->getName()), $archivo_plantilla->getContent(), true);

	$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($ruta_procesar);
	
	$campos_word = $templateProcessor->getVariables();
	
	if(@$_REQUEST["iddoc"] && count($campos_word)) {
	    
		if(!$combinar) {
			$numero_radicado = busca_filtro_tabla("", "documento", "iddocumento=" . $_REQUEST["iddoc"], "", $conn);
			$templateProcessor->setValue('formato_numero', $numero_radicado[0]['numero']);
			
			$campo_qr_word = "codigo_qr";
			if(in_array($campo_qr_word, $campos_word)) {
				$src_qr = obtener_codigo_qr($idformato, $_REQUEST["iddoc"]);
				$arr_alm_qr = StorageUtils::resolver_ruta($src_qr);
				$alm_qr = $arr_alm_qr["clase"];
				$archivo_qr = $alm_qr->get_filesystem()->get($arr_alm_qr["ruta"]);
				
				$ext_qr = "." . pathinfo($arr_alm_qr["ruta"], PATHINFO_EXTENSION);
				$src = StorageUtils::obtener_archivo_temporal("qr_");
				file_put_contents($src, $archivo_qr->getContent());
				rename($src, $src . $ext_qr);
				$src .= $ext_qr;
				//$temp_fs->write(basename($archivo_qr->getName()), $archivo_qr->getContent(), true);
				//print_r($src);echo "<br>";
				//print_r(is_file($src));die();
				//$src = "../almacenamiento/APROBADO/2017-02-10/1242/qr/qr2017_02_10_21_02_30.png";
				$img2 = array(
					array(
						'img' => htmlspecialchars($src),
						'size' => array(
							100,
							100
						)
					)
				);
				$templateProcessor->setImg($campo_qr_word, $img2);
			}
			
			$directorio_out = $ruta_docx . "/";
	
			$archivo_out = 'documento_word';
			
			$extension_doc = '.docx';
			
			/*if(file_exists($directorio_out . $archivo_out . $extension_doc)) {
				unlink($directorio_out . $archivo_out . $extension_doc);
				unlink($directorio_out . $archivo_out . '.pdf');
			}*/
			$marca_agua = mostrar_estado_documento($_REQUEST['iddoc']);
			$templateProcessor->setTextWatermark($marca_agua);
			$templateProcessor->saveAs($directorio_out . $archivo_out . $extension_doc);
			
			$ruta_temporal = busca_filtro_tabla("valor", "configuracion", "nombre='ruta_temporal'", "", $conn);
			$ruta_tmp_usr=$ruta_temporal[0]["valor"]. "_" . usuario_actual("login");
			$word_temp = StorageUtils::obtener_archivo_temporal($archivo_out, $ruta_tmp_usr);
			copy($directorio_out . $archivo_out. $extension_doc, $word_temp);
			rename($word_temp, $word_temp . $extension_doc);

			if(is_file($word_temp . $extension_doc)) {
				$comando = 'export HOME=/tmp && libreoffice5.1 --headless --convert-to pdf:writer_pdf_Export --outdir ' . dirname($word_temp) . ' ' . $word_temp . $extension_doc;
				$var = shell_exec($comando);
				$pdf_name = "documento_word";
				$dir_name = rtrim (dirname($ruta_plantilla), "anexos");
				$dir_name .= "docx/";
				$alm_plantilla->copiar_contenido_externo($word_temp . ".pdf", $dir_name . $pdf_name . ".pdf");
				$alm_plantilla->copiar_contenido_externo($word_temp . $extension_doc, $ruta_plantilla);
				$alm_plantilla->copiar_contenido_externo($word_temp . $extension_doc, $pdf_name . $extension_doc);
			}
		} else {
			$ruta_combinar = StorageUtils::obtener_tempdir();
			$tipo_alm_csv = $archivo_csv["clase"];
			$csv_file = $tipo_alm_csv->get_filesystem()->get($archivo_csv["clase"]);
			$archivo_csv = $ruta_combinar . "/tmp_csv.csv";
			file_put_contents($archivo_csv, $csv_file->getContent());
			combinar_documento($archivo_csv, $ruta_combinar, $ruta_docx, $idformato, $_REQUEST["iddoc"], $alm_plantilla, $ruta_plantilla);
		}
	}// fin si existe iddoc y el word tiene campos del formato
} // fin si existe word

function obtener_codigo_qr($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	$codigo_qr = busca_filtro_tabla("", "documento_verificacion", "documento_iddocumento=" . $iddoc, "", $conn);
	
	if(!$codigo_qr['numcampos']) {
		include_once ($ruta_db_superior . "pantallas/qr/librerias.php");
		generar_codigo_qr($idformato, $iddoc);
		
		$codigo_qr = busca_filtro_tabla("", "documento_verificacion", "documento_iddocumento=" . $iddoc, "", $conn);
	}
	
	return $codigo_qr[0]['ruta_qr'];
}

function combinar_documento($archivo_csv, $directorio_out, $ruta_docx, $idformato, $iddoc, $alm_plantilla, $ruta_plantilla) {
	global $conn, $ruta_db_superior;

	$numero_radicado = busca_filtro_tabla("", "documento", "iddocumento=" . $_REQUEST["iddoc"], "", $conn);
	$campo_qr_word = "codigo_qr";
    $marca_agua = mostrar_estado_documento($iddoc);
	$extension_doc = '.docx';
	
	//print_r($ruta_docx); echo "<br>";die();
	$datos = cargar_csv($archivo_csv);
	for($i = 0; $i < count($datos); $i++) {
		// Cada elemento es un array campo => valor
		$archivo_out = "documento_word_$i";
		
	    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($ruta_docx . '/documento_word.docx');
    	$campos_word = $templateProcessor->getVariables();

    	$templateProcessor->setValue('formato_numero', $numero_radicado[0]['numero']);
		if(in_array($campo_qr_word, $campos_word)) {

			$src_qr = obtener_codigo_qr($idformato, $iddoc);
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
			$templateProcessor->setImg($campo_qr_word, $img2);
		}

		foreach($datos[$i] as $campo => $valor) {
			if(in_array($campo, $campos_word)) {
				$templateProcessor->setValue($campo, $valor);
				
				if(is_file($directorio_out . "/$archivo_out" . $extension_doc)) {
					unlink($directorio_out . "/$archivo_out" . $extension_doc);
				}
			} else {
				die("No se encontr&oacute; el campo $campo en la plantilla");
			}
		}
		$templateProcessor->setTextWatermark($marca_agua);
		$templateProcessor->saveAs($directorio_out . "/$archivo_out" . $extension_doc);
		$templateProcessor = null;
	}
	
	if(is_dir($directorio_out)) {
		$comando1 = 'export HOME=/tmp && libreoffice5.1 --headless -print-to-file --outdir ' . $directorio_out . ' ' . $directorio_out . "/*" . $extension_doc;
		$var1 = shell_exec($comando1);
		if(file_exists($directorio_out . "/documento_word.pdf")) {
		    unlink($directorio_out . "/documento_word.pdf");
		}
		$entrada_ps = $directorio_out . "/*.ps";
		$salida_ps = $directorio_out . "/documento_word.pdf";
        $comando2 = "gs -sDEVICE=pdfwrite -dNOPAUSE -dBATCH -dSAFER -sOutputFile=" . $salida_ps . " " . $entrada_ps;
		$var2 = shell_exec($comando2);

		$pdf_name = "documento_word";
		$dir_name = rtrim (dirname($ruta_plantilla), "anexos");
		$dir_name .= "docx/";
		$alm_plantilla->copiar_contenido_externo($salida_ps, $dir_name . $pdf_name . ".pdf");
		//$alm_plantilla->copiar_contenido_externo($word_temp . $extension_doc, $ruta_plantilla);
		//$alm_plantilla->copiar_contenido_externo($word_temp . $extension_doc, $pdf_name . $extension_doc);
	}
	//die();
}

function cargar_csv($inputFileName) {
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
?>
