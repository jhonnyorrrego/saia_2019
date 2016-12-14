<?php

//	POSTERIOR AL CONFIRMAR, se debe definir la variable ruta_db_superior desde donde se hace el llamado.


include_once($ruta_db_superior."pantallas/lib/PhpWord/funciones_include.php");
//require_once($ruta_db_superior.'pantallas/lib/PHPWord/src/PhpWord/Autoloader.php');
require_once($ruta_db_superior.'pantallas/lib/PhpWord/Autoloader.php');
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
date_default_timezone_set('UTC');

/**
 * Header file
 */
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;

error_reporting(E_ALL);

if(!defined('CLI')){
	define('CLI', (PHP_SAPI == 'cli') ? true : false);
	define('EOL', CLI ? PHP_EOL : '<br />');
	define('SCRIPT_FILENAME', basename($_SERVER['SCRIPT_FILENAME'], '.php'));
	define('IS_INDEX', SCRIPT_FILENAME == 'index');
}
Autoloader::register();
Settings::loadConfig();


// Return to the caller script when runs by CLI
if (CLI) {
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

//ini_set('display_errors',true);


if(@$iddoc){
	$_REQUEST["iddoc"]=$iddoc;	
}




$ruta_procesar='';
if(@$_REQUEST["iddoc"]){
	$anexo=busca_filtro_tabla("d.ruta","documento a, formato b, campos_formato c, anexos d","lower(a.plantilla)=b.nombre AND b.idformato=c.formato_idformato AND c.nombre='anexo_word' AND c.idcampos_formato=d.campos_formato AND a.iddocumento=".$_REQUEST["iddoc"]." AND d.documento_iddocumento=".$_REQUEST["iddoc"],"",$conn) ;
}




$ruta_docx='';

if(@$anexo['numcampos']){
	$ruta_anexo=explode('anexos',$anexo[0]["ruta"]);
	$ruta_imagen=$ruta_db_superior.$ruta_anexo[0].'firma_temp/';
	$ruta_docx=$ruta_db_superior.$ruta_anexo[0].'docx/';	
}


if(file_exists($ruta_docx.'documento_word.docx')){
    
    


	$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($ruta_docx.'documento_word.docx');
	
	$campos_word=$templateProcessor->getVariables();

	if(@$_REQUEST["iddoc"] && count($campos_word)){
	    
	   

		$ruta=busca_filtro_tabla("","ruta","obligatorio=1 AND condicion_transferencia='POR_APROBAR' AND tipo='ACTIVO' AND documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
		$ruta_revisado=busca_filtro_tabla("","ruta","obligatorio=2 AND condicion_transferencia='POR_APROBAR' AND tipo='ACTIVO' AND documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
		
		
		if(!$ruta['numcampos'] && !$ruta_revisado['numcampos']){
			$ninguno_firma=busca_filtro_tabla("","ruta","obligatorio=0 AND condicion_transferencia='POR_APROBAR' AND tipo='ACTIVO' AND documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
			if(!$ninguno_firma['numcampos']){
				$ruta=busca_filtro_tabla("destino as origen, tipo_destino as tipo_origen","buzon_entrada","nombre='POR_APROBAR' AND archivo_idarchivo=".$_REQUEST["iddoc"],"",$conn);		
			}			
		}	
		
		

		for($j=0;$j<$ruta['numcampos'];$j++){
			
			$funcionario_codigo=$ruta[$j]['origen'];
					
			if($ruta[$j]['tipo_origen']!=1){
				$fun_code=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","iddependencia_cargo=".$ruta[$j]['origen'],"",$conn);
				$funcionario_codigo=$fun_code[0]['funcionario_codigo'];
			 }			
			
			
			$bzn_salida=busca_filtro_tabla("","buzon_salida","ruta_idruta='".$ruta[$j]['idruta']."' AND archivo_idarchivo=".$_REQUEST["iddoc"],"",$conn);
				
			if($bzn_salida['numcampos']){ //ya firmo
			
				$funcionario_codigo_encriptado=encrypt_md5($funcionario_codigo);
				$buscar_firma='f_'.$funcionario_codigo_encriptado;
				$imagen_firma=$ruta_imagen.'firma_'.$funcionario_codigo.'.jpg';

				if(in_array($buscar_firma,$campos_word)){
						
					$funcionario=busca_filtro_tabla("firma,nombres,apellidos","funcionario","funcionario_codigo=".$funcionario_codigo,"",$conn);

					if(MOTOR=="Oracle"){
						$img= stripslashes($funcionario[0]["firma"]);	
					}elseif(MOTOR=="MySql")   {
						$img= $funcionario[0]["firma"];
					}else{
						$img= stripslashes(base64_decode($funcionario[0]["firma"]));
					}
					
					crear_destino($ruta_imagen);	
					chmod($ruta_imagen, 0777); 

					if(file_exists($imagen_firma)){
						unlink($imagen_firma);
					}
						
					$im = imagecreatefromstring($img);
					imagejpeg($im, $imagen_firma);
					chmod($imagen_firma, 0777); 
						
					$src=$imagen_firma;
							
					$img2=array(array('img' => htmlspecialchars($src),'size' => array(170, 100)));
					$templateProcessor->setImg($buscar_firma,$img2);	
							
					imagedestroy($im);	
					
					$buscar_nombre='n_'.$funcionario_codigo_encriptado;
					$nombre=utf8_encode(html_entity_decode($funcionario[0]['nombres'].' '.$funcionario[0]['apellidos']));
					//$nombre=ucwords(strtolower($nombre));
					$nombre=strtoupper(strtolower($nombre));
					$templateProcessor->setValue($buscar_nombre,htmlspecialchars($nombre)); 	
					
					
					$buscar_cargo='c_'.$funcionario_codigo_encriptado;
					
					$carg=busca_filtro_tabla("cargo","vfuncionario_dc","estado_dc=1 AND funcionario_codigo=".$funcionario_codigo,"",$conn);
					$cargo=utf8_encode(html_entity_decode($carg[0]['cargo']));
					$cargo=ucwords(strtolower($cargo));
					$templateProcessor->setValue($buscar_cargo,htmlspecialchars($cargo)); 	
					
				}
			}else{ //no ha firmado
						
			}
		}

		//DESAROLLO REVISADO

		for($j=0;$j<$ruta_revisado['numcampos'];$j++){
			
			$funcionario_codigo=$ruta_revisado[$j]['origen'];
			
			if($ruta_revisado[$j]['tipo_origen']!=1){
				$fun_code=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","iddependencia_cargo=".$ruta_revisado[$j]['origen'],"",$conn);
				$funcionario_codigo=$fun_code[0]['funcionario_codigo'];
			 }			

			$bzn_salida=busca_filtro_tabla("","buzon_salida","ruta_idruta='".$ruta_revisado[$j]['idruta']."' AND archivo_idarchivo=".$_REQUEST["iddoc"],"",$conn);
			
			if($bzn_salida['numcampos']){ //ya firmo
			
				$funcionario_codigo_encriptado=encrypt_md5($funcionario_codigo);
				$buscar_revisado='r_'.$funcionario_codigo_encriptado;
				if(in_array($buscar_revisado,$campos_word)){				
					$funcionario=busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".$funcionario_codigo,"",$conn);
					$nombre=utf8_encode(html_entity_decode($funcionario[0]['nombres'].' '.$funcionario[0]['apellidos']));
					$nombre=ucwords(strtolower($nombre));
					$templateProcessor->setValue($buscar_revisado,htmlspecialchars($nombre)); 	
				}
			}else{ //no ha firmado
						
			}
		}		

		$directorio_out=$ruta_docx;
		$archivo_out='documento_word';
		
		$extension_doc='.docx';

		if(file_exists($directorio_out.$archivo_out.$extension_doc)){
			unlink($directorio_out.$archivo_out.$extension_doc);
			unlink($directorio_out.$archivo_out.'.pdf');
		}
		$marca_agua=mostrar_estado_documento($_REQUEST['iddoc']);
		$templateProcessor->setTextWatermark($marca_agua);
		$templateProcessor->saveAs($directorio_out.$archivo_out.$extension_doc);	
		
		if(file_exists($directorio_out.$archivo_out.$extension_doc)){
		  $comando='export HOME=/tmp && libreoffice5.1 --headless --convert-to pdf:writer_pdf_Export --outdir '.$directorio_out.' '.$directorio_out.$archivo_out.$extension_doc;
		  $var=shell_exec($comando); 
		} 	
		if(@$anexo['numcampos']){ //elimina las imagenes de la carpeta
			
			$dir = $ruta_imagen; 
			chmod($dir,0777);
			foreach (glob($dir."*.jpg") as $filename) {
	  		 chmod($filename,0777);
	  		 unlink($filename);			
			}		

		}			
				 
 
	}// fin si existe iddoc y el word tiene campos del formato

} //fin si existe word

?>