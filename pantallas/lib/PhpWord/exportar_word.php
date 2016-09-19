<?php


//	POSTERIOR AL ADICIONAR, se debe definir la variable ruta_db_superior desde donde se hace el llamado.


include_once($ruta_db_superior."pantallas/lib/PhpWord/funciones_include.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");


/*include_once 'Sample_Header.php';*/

// Template processor instance creation
//require_once($ruta_db_superior.'pantallas/lib/PhpWord/Autoloader.php');
//require_once($ruta_db_superior.'pantallas/lib/PHPWord/src/PhpWord/Autoloader.php');
require_once($ruta_db_superior.'pantallas/lib/PhpWord/Autoloader.php');
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

//Se debe validar que el archivo sea de tipo docx (zip de xml por documento)
$ruta_procesar='';

if(@$iddoc){
	$_REQUEST["iddoc"]=$iddoc;	
}



if(@$_REQUEST["iddoc"]){
	
  $anexo=busca_filtro_tabla("d.ruta,b.nombre","documento a, formato b, campos_formato c, anexos d","lower(a.plantilla)=b.nombre AND b.idformato=c.formato_idformato AND c.nombre='anexo_word' AND c.idcampos_formato=d.campos_formato AND a.iddocumento=".$_REQUEST["iddoc"]." AND d.documento_iddocumento=".$_REQUEST["iddoc"],"",$conn) ;
	
		

	
  if($anexo['numcampos']){
  	
	if(@$_REQUEST['from_externo']){
		include_once($ruta_db_superior.'formatos/'.$anexo[0]['nombre'].'/funciones.php');
	}		
	
  	$ruta_procesar=$ruta_db_superior.$anexo[0]["ruta"];
	$ruta_almacenar=explode('anexos',$anexo[0]["ruta"]);
	$ruta_docx=$ruta_db_superior.$ruta_almacenar[0].'docx/';
	$ruta_imagen=$ruta_db_superior.$ruta_almacenar[0].'firma_temp/';
	
	crear_destino($ruta_docx);	
	chmod($ruta_docx, 0777); 
	crear_destino($ruta_imagen);	
	chmod($ruta_imagen, 0777); 	  
	  
  }	
  
}

if($ruta_procesar!=''){
	 $ejecutar=0;	
	$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($ruta_procesar);
	$campos_word=$templateProcessor->getVariables();	
	
	if(@$_REQUEST["iddoc"] && count($campos_word)){		
	 // include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

      //CAMPOS OBLIGATORIOS
	  $ejecutar=1;	
	  $campos_obligatorios=busca_filtro_tabla("C.*,B.nombre as nombre_formato","documento A,formato B,campos_formato C","A.plantilla=B.nombre AND B.idformato=C.formato_idformato AND A.iddocumento=".$_REQUEST["iddoc"]." AND C.obligatoriedad=1","",$conn);
	  
	  $nombre_formato=$campos_obligatorios[0]['nombre_formato'];
	  $obligatorios_permitidos=array('serie_idserie','idft_'.$nombre_formato,'documento_iddocumento','dependencia','encabezado','firma');
	  
	  for($i=0;$i<$campos_obligatorios["numcampos"];$i++){
	  	
		if($ejecutar){
		    $nombre=$campos_obligatorios[$i]["nombre"];
		    
		    if($campos_obligatorios[$i]["etiqueta_html"]=='archivo'){  //permite que los tipo anexo obligatorios los pase por alto
		    	$obligatorios_permitidos[]=$nombre;
		    }
		    
		    if(in_array($nombre,$campos_word)){
		      $valor=mostrar_valor_campo($nombre,$campos_obligatorios[$i]["formato_idformato"],$_REQUEST['iddoc'],1);
		      $templateProcessor->setValue($nombre,htmlspecialchars($valor));  
		    }else if(in_array($nombre,$obligatorios_permitidos)){
	
		    }else{
		    	//$ejecutar=0;
		    	
		    	?>
		    	<script>
		    		//notificacion_saia('no es posible encontrar en el documento el campo obligatorio:  <?php echo($nombre); ?>','error','',4000);
		    	//	alert('no es posible encontrar en el documento el campo obligatorio: <?php echo($nombre); ?>');
		    	</script>
		    	<?php
		    	//die();	    	
		    }
		} //fin if ejecutar
	  } //fin for campos obligatorios
	  
	  //CAMPOS OPCIONALES
	  
	  if($ejecutar){
		  $campos_opcionales=busca_filtro_tabla("C.*","documento A,formato B,campos_formato C","A.plantilla=B.nombre AND B.idformato=C.formato_idformato AND A.iddocumento=".$_REQUEST["iddoc"]." AND C.obligatoriedad=0","",$conn);
		  for($i=0;$i<$campos_opcionales["numcampos"];$i++){
		    $nombre=$campos_opcionales[$i]["nombre"];
		    if(in_array($nombre,$campos_word)){
		      $valor=mostrar_valor_campo($nombre,$campos_opcionales[$i]["formato_idformato"],$_REQUEST['iddoc'],1);
		      $templateProcessor->setValue($nombre,htmlspecialchars($valor));  
		    }
		  }	  
	  } //fin if ejecutar


	 //INCLUIR FUNCIONES  	 
	 if($ejecutar){

		 $idformato=$campos_obligatorios[0]["formato_idformato"];
	    
	     $enlace="";	
		 $formato=busca_filtro_tabla("","formato A","A.idformato=".$idformato,"",$conn);	
	     $funciones=busca_filtro_tabla("nombre_funcion,parametros","funciones_formato A","(A.formato LIKE '".$idformato."' OR A.formato LIKE '%,".$idformato.",%' OR A.formato LIKE '%,".$idformato."' OR A.formato LIKE '".$idformato.",%') AND A.acciones LIKE '%m%'","GROUP BY nombre_funcion",$conn);
	
		$funciones_ejecutar=array('mostrar_estado_proceso','logo_empresa','ciudad_fecha','nombre_formato','formato_numero');
	
		for($i=0;$i<count($funciones_ejecutar);$i++){
		  	$nombre=$funciones_ejecutar[$i];
			if( in_array($nombre,$campos_word) ){
				
				switch($nombre){
					case 'formato_numero':
						$doc_aprobado=busca_filtro_tabla("estado,numero","documento","iddocumento=".$_REQUEST["iddoc"],"",$conn);
						if($doc_aprobado[0]['estado']=='APROBADO'){
							$templateProcessor->setValue('formato_numero',$doc_aprobado[0]['numero']);  
						}
						break;
					case 'mostrar_estado_proceso':
				      	
				      	$ruta=busca_filtro_tabla("","ruta","obligatorio=1 AND condicion_transferencia='POR_APROBAR' AND tipo='ACTIVO' AND documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
				      	$ruta_revisado=busca_filtro_tabla("","ruta","obligatorio=2 AND condicion_transferencia='POR_APROBAR' AND tipo='ACTIVO' AND documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
						
						if(!$ruta['numcampos'] && !$ruta_revisado['numcampos']){
							$ninguno_firma=busca_filtro_tabla("","ruta","obligatorio=0 AND condicion_transferencia='POR_APROBAR' AND tipo='ACTIVO' AND documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
							if(!$ninguno_firma['numcampos']){
								$ruta=busca_filtro_tabla("destino as origen, tipo_destino as tipo_origen, ruta_idruta as idruta","buzon_entrada","nombre='POR_APROBAR' AND archivo_idarchivo=".$_REQUEST["iddoc"],"",$conn);		
							}		
							
						}						
						
						$filas=0;
						if($ruta['numcampos']){
							if($ruta['numcampos']%2==0){  //CALCULO FILAS FIRMAN
								$filas=$ruta['numcampos']/2;
							}else{
								$filas=($ruta['numcampos']+1)/2;
							}							
						}
						$filas_revisado=0;
						
						if($ruta_revisado['numcampos']){
							$filas_revisado=1;
						}
						

						$filas=$filas+$filas_revisado;					
						$templateProcessor->cloneRow('mostrar_estado_proceso', $filas);
		
						$izq=1;
						$der=1;
						if($ruta['numcampos']){
							for($j=0;$j<$ruta['numcampos'];$j++){
								$firma='';
								$nombre='';
								$cargo='';
								$funcionario_codigo=$ruta[$j]['origen'];
								
								if($ruta[$j]['tipo_origen']!=1){
									$fun_code=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","iddependencia_cargo=".$ruta[$j]['origen'],"",$conn);
									$funcionario_codigo=$fun_code[0]['funcionario_codigo'];
						  		}
						  		
								$bzn_salida=busca_filtro_tabla("","buzon_salida","ruta_idruta='".$ruta[$j]['idruta']."' AND archivo_idarchivo=".$_REQUEST["iddoc"]." AND lower(nombre) NOT IN ('borrador','leido') ","",$conn);
								
								
									
								if($bzn_salida['numcampos']){//YA FIRMO		
									
				

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
										//$templateProcessor->setImg($buscar_firma,$img2);	
					
										$buscar_nombre='n_'.$funcionario_codigo_encriptado;
										$nombre=utf8_encode(html_entity_decode($funcionario[0]['nombres'].' '.$funcionario[0]['apellidos']));
										$nombre=ucwords(strtolower($nombre));
										//$templateProcessor->setValue($buscar_nombre,htmlspecialchars($nombre)); 	
										
										
										$buscar_cargo='c_'.$funcionario_codigo_encriptado;
										
										$carg=busca_filtro_tabla("cargo","vfuncionario_dc","estado_dc=1 AND funcionario_codigo=".$funcionario_codigo,"",$conn);
										$cargo=utf8_encode(html_entity_decode($carg[0]['cargo']));
										$cargo=ucwords(strtolower($cargo));
										//$templateProcessor->setValue($buscar_cargo,htmlspecialchars($cargo)); 	

									
									if($j%2==0 || $j==0){ //columna 1
										$templateProcessor->setImg('mostrar_estado_proceso#'.$izq,$img2);
									
										$templateProcessor->setValue('nombre_funcionario#'.$izq, htmlspecialchars($nombre));
										$templateProcessor->setValue('cargo#'.$izq, htmlspecialchars($cargo));	
										$izq++;						
									}else{	//columna 2
										$templateProcessor->setValue('mostrar_estado_proceso1#'.$der, htmlspecialchars($firma));
										$templateProcessor->setValue('nombre_funcionario1#'.$der, htmlspecialchars($nombre));
										$templateProcessor->setValue('cargo1#'.$der, htmlspecialchars($cargo));		
										$der++;				
									}	
									
									imagedestroy($im);										
								}else{
									$funcionario_codigo_encriptado=encrypt_md5($funcionario_codigo);
				
									$firma='${f_'.$funcionario_codigo_encriptado.'}';	
									$nombre='${n_'.$funcionario_codigo_encriptado.'}';
									$cargo='${c_'.$funcionario_codigo_encriptado.'}';
									
									if($j%2==0 || $j==0){ //columna 1
										$templateProcessor->setValue('mostrar_estado_proceso#'.$izq, htmlspecialchars($firma));
										$templateProcessor->setValue('nombre_funcionario#'.$izq, htmlspecialchars($nombre));
										$templateProcessor->setValue('cargo#'.$izq, htmlspecialchars($cargo));	
										$izq++;						
									}else{	//columna 2
										$templateProcessor->setValue('mostrar_estado_proceso1#'.$der, htmlspecialchars($firma));
										$templateProcessor->setValue('nombre_funcionario1#'.$der, htmlspecialchars($nombre));
										$templateProcessor->setValue('cargo1#'.$der, htmlspecialchars($cargo));		
										$der++;				
									}									
								}				

								if( ($j+1)== $ruta['numcampos']){
									if($j%2==0){
										$templateProcessor->setValue('mostrar_estado_proceso1#'.$der,'');
										$templateProcessor->setValue('nombre_funcionario1#'.$der,'');
										$templateProcessor->setValue('cargo1#'.$der, '');
										$der++;										
									}			
								}
							} //fin for ruta							
						}

						//DESAROLLO REVISADO
						$izq=$izq;
						$der=$der;
						$revisado='Revisado: ';
						for($j=0;$j<$ruta_revisado['numcampos'];$j++){
							
							$funcionario_codigo=$ruta_revisado[$j]['origen'];
							
							if($ruta_revisado[$j]['tipo_origen']!=1){
								$fun_code=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","iddependencia_cargo=".$ruta_revisado[$j]['origen'],"",$conn);
								$funcionario_codigo=$fun_code[0]['funcionario_codigo'];
					  		}
							
							
							$bzn_salida=busca_filtro_tabla("","buzon_salida","ruta_idruta='".$ruta_revisado[$j]['idruta']."' AND archivo_idarchivo=".$_REQUEST["iddoc"]." AND lower(nombre) NOT IN ('borrador','leido') ","",$conn);
																		
							
							if(!$bzn_salida['numcampos']){
								$funcionario_codigo_encriptado=encrypt_md5($funcionario_codigo);
								if( ( $j+1 )== $ruta_revisado['numcampos']){
									$revisado.='${r_'.$funcionario_codigo_encriptado.'}';	
								}else{
									$revisado.='${r_'.$funcionario_codigo_encriptado.'} , ';	
								}								
							}else{
								
								$funcionario=busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".$funcionario_codigo,"",$conn);
								$nombre=utf8_encode(html_entity_decode($funcionario[0]['nombres'].' '.$funcionario[0]['apellidos']));
								$nombre=ucwords(strtolower($nombre));
																
								if( ( $j+1 )== $ruta_revisado['numcampos']){
									$revisado.=$nombre;	
								}else{
									$revisado.=$nombre.', ';	
								}								
							}
							

							
						} //fin for ruta revisado
						
						
						if($ruta_revisado['numcampos']){
							$templateProcessor->setValue('mostrar_estado_proceso#'.$izq, htmlspecialchars($revisado));
							$templateProcessor->setValue('nombre_funcionario#'.$izq, '');
							$templateProcessor->setValue('cargo#'.$izq, '');	
													
								//columna 2
							$templateProcessor->setValue('mostrar_estado_proceso1#'.$der, '');
							$templateProcessor->setValue('nombre_funcionario1#'.$der, '');
							$templateProcessor->setValue('cargo1#'.$der, '');								
						}					
					
						break;
					case 'logo_empresa':
						 $logo_empresa = busca_filtro_tabla("valor","configuracion","nombre='logo'","",$conn);
						 $ruta_logo=$ruta_db_superior.$logo_empresa[0]['valor'];
						 $img=array(array('img' => htmlspecialchars($ruta_logo),'size' => array(170, 100)));
						 $templateProcessor->setImg('logo_empresa',$img);							
						break;	
					case 'ciudad_fecha':
						$fecha_radicado=busca_filtro_tabla(fecha_db_obtener('fecha','Y-m-d')." as fecha","documento","iddocumento=".$_REQUEST['iddoc'],"",$conn);
						$config_ciudad=busca_filtro_tabla("","configuracion","nombre='ciudad'","",$conn);
						$ciudad=busca_filtro_tabla("nombre","municipio","idmunicipio=".$config_ciudad[0]['valor'],"",$conn);
						$meses=array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');
						$vector_fecha=explode('-',$fecha_radicado[0]['fecha']);
						$vector_fecha=array_map('intval', $vector_fecha);
						$cadena_fecha=$vector_fecha[2].' de '.$meses[$vector_fecha[1]].' de '.$vector_fecha[0];						
						$cadena=ucwords(strtolower($ciudad[0]['nombre'])).', '.$cadena_fecha;
						$templateProcessor->setValue('ciudad_fecha',$cadena);  	
						break;	
					case 'nombre_formato':
						$templateProcessor->setValue('nombre_formato',$formato[0]['etiqueta']);  
						break;	
						
				} //fin switch
				
			} //fin if existe en las funciones del word
	
		} //fin for funciones_ejecutar

	  } //fin if ejecutar
	} //fin if request iddoc y campos_word numcampos
		
	if($ejecutar){
		$marca_agua=mostrar_estado_documento($_REQUEST['iddoc']);
		$templateProcessor->setTextWatermark($marca_agua);
		$directorio_out=$ruta_docx;
		$archivo_out='documento_word';
		$extension_doc='.docx';
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

					
	}
} //fin if ruta_procesar


?>