<?php

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

define('CLI', (PHP_SAPI == 'cli') ? true : false);
define('EOL', CLI ? PHP_EOL : '<br />');
define('SCRIPT_FILENAME', basename($_SERVER['SCRIPT_FILENAME'], '.php'));
define('IS_INDEX', SCRIPT_FILENAME == 'index');

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
	$anexo = busca_filtro_tabla("d.ruta", "documento a, formato b, campos_formato c, anexos d", "lower(a.plantilla)=b.nombre AND b.idformato=c.formato_idformato AND c.nombre='anexo_word' AND c.idcampos_formato=d.campos_formato AND a.iddocumento=" . $_REQUEST["iddoc"] . " AND d.documento_iddocumento=" . $_REQUEST["iddoc"], "", $conn);
}

$ruta_docx = '';

if(@$anexo['numcampos']) {
	$ruta_anexo = explode('anexos', $anexo[0]["ruta"]);
	$ruta_imagen = $ruta_db_superior . $ruta_anexo[0] . 'firma_temp/';
	$ruta_docx = $ruta_db_superior . $ruta_anexo[0] . 'docx/';
}

if(file_exists($ruta_docx . 'documento_word.docx')) {
	
	$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($ruta_docx . 'documento_word.docx');
	
	$campos_word = $templateProcessor->getVariables();
	
	if(@$_REQUEST["iddoc"] && count($campos_word)) {
		
		$numero_radicado = busca_filtro_tabla("", "documento", "iddocumento=" . $_REQUEST["iddoc"], "", $conn);
		$templateProcessor->setValue('formato_numero', $numero_radicado[0]['numero']);
		
		$campo_qr_word = "codigo_qr";
		if(in_array($campo_qr_word, $campos_word)) {
			$src = $ruta_db_superior . obtener_codigo_qr($_REQUEST["iddoc"]);
			
			$img2 = array(
			    
							'img' => htmlspecialchars($src),
							'size' => array(
									100,
									100
							)
					
			);
			$templateProcessor->setImg($campo_qr_word, $img2);
		}
		$directorio_out = $ruta_docx;
		$archivo_out = 'documento_word';
		
		$extension_doc = '.docx';
		
		if(file_exists($directorio_out . $archivo_out . $extension_doc)) {
			unlink($directorio_out . $archivo_out . $extension_doc);
			unlink($directorio_out . $archivo_out . '.pdf');
		}
		$marca_agua = mostrar_estado_documento($_REQUEST['iddoc']);
		$templateProcessor->setTextWatermark($marca_agua);
		$templateProcessor->saveAs($directorio_out . $archivo_out . $extension_doc);
		
		if(file_exists($directorio_out . $archivo_out . $extension_doc)) {
			$comando = 'export HOME=/tmp && libreoffice5.1 --headless --convert-to pdf:writer_pdf_Export --outdir ' . $directorio_out . ' ' . $directorio_out . $archivo_out . $extension_doc;
			$var = shell_exec($comando);
		}
	} // fin si existe iddoc y el word tiene campos del formato
}
 // fin si existe word
function obtener_codigo_qr($iddoc, $campos_word) {
	global $conn, $ruta_db_superior;
	$codigo_qr = busca_filtro_tabla("", "documento_verificacion", "documento_iddocumento=" . $iddoc, "", $conn);
	
	if(!$codigo_qr['numcampos']) {
		include_once ($ruta_db_superior . "pantallas/qr/librerias.php");
		generar_codigo_qr($idformato, $iddoc);
		
		$codigo_qr = busca_filtro_tabla("", "documento_verificacion", "documento_iddocumento=" . $iddoc, "", $conn);
	}
	
	return $codigo_qr[0]['ruta_qr'];
}

?>
