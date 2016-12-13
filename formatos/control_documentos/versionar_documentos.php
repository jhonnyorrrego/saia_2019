<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."formatos/mod_autocomisorio/funciones.php");

$iddoc = $_REQUEST['iddoc'];

$documento_calidad = busca_filtro_tabla("documento_calidad","ft_control_documentos","documento_iddocumento=".$iddoc,"",$conn);	

	$documento_calidad = str_replace("##","_",$documento_calidad[0]['documento_calidad']);
	
	$documento_calidad = explode('-',$documento_calidad);
	
	$datos_documento_calidad = busca_filtro_tabla("",$documento_calidad[1]." A, documento B","B.iddocumento=A.documento_iddocumento AND A.documento_iddocumento=".$documento_calidad[0],"",$conn);
	
	if(!$datos_documento_calidad['numcampos']){
		$datos_documento_calidad = busca_filtro_tabla("",$documento_calidad[1]." A, documento B","A.documento_iddocumento=B.iddocumento AND id".$documento_calidad[1]."=".$documento_calidad[0],"",$conn);
	}		
	
	if($datos_documento_calidad[0]['iddocumento']){		
		
		$nuevo_anexo = busca_filtro_tabla("","anexos","documento_iddocumento=".$iddoc,"",$conn);				
		if(file_exists($ruta_db_superior.$nuevo_anexo[0]['ruta'])){
			
			$anexo = busca_filtro_tabla("","anexos","documento_iddocumento=".$datos_documento_calidad[0]['iddocumento'],"",$conn);			
			
			$nombre_anexo_nuevo = explode('/',$nuevo_anexo[0]['ruta']);				
			$nombre_anexo_nuevo = $nombre_anexo_nuevo[(sizeof($nombre_anexo_nuevo)-1)];				
			
			$ruta_anexo = explode('/',$anexo[0]['ruta']);			
			
			//$nombre_anexo_nuevo = $ruta_anexo[(sizeof($ruta_anexo)-1)];				
			
			
			unset($ruta_anexo[(sizeof($ruta_anexo)-1)]);
			$ruta_anexo = implode('/',$ruta_anexo);		
			
			$comando = "cp ".$ruta_db_superior.$nuevo_anexo[0]['ruta']." ".$ruta_db_superior.$ruta_anexo;
			exec($comando);							
			
			$insert_anexos = "INSERT INTO anexos(documento_iddocumento,ruta,tipo,etiqueta,campos_formato,formato,fecha) values(".$datos_documento_calidad[0]['iddocumento'].", '".$ruta_anexo."/".$nombre_anexo_nuevo."', '".$nuevo_anexo[0]['tipo']."', '".$nuevo_anexo[0]['etiqueta']."', '".$anexo[0]['campos_formato']."', '".$anexo[0]['formato']."', ".fecha_db_almacenar(date('Y-m-d'),'Y-m-d').")";								
			
			phpmkr_query($insert_anexos);		
			
			if(phpmkr_insert_id()){					
				
				$ch = curl_init();

				// Establecer URL y otras opciones apropiadas
				curl_setopt($ch, CURLOPT_URL, "http://52.205.58.68/saia_release1/saia/versionamiento/crear_version.php?key=".$datos_documento_calidad[0]['iddocumento']."&no_menu=1&no_redirecciona=1&eliminar_anexo=".$anexo[0]['idanexos']);
				curl_setopt($ch, CURLOPT_HEADER, 0);

				// Capturar la URL y pasarla al navegador
				curl_exec($ch);
				// Cerrar el recurso cURL y liberar recursos del sistema
				curl_close($ch);		
				
				//$delete_anexo = "DELETE FROM anexos WHERE idanexos=".$anexo[0]['idanexos'];
				
				//print_r($delete_anexo);
				//phpmkr_query($delete_anexo);
			}
			
		
		}	
	}


?>