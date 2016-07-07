<?php

$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");


                $iddocumento=11561;

					if($iddocumento){
																												
						//$update_documento_creado = "UPDATE ft_control_documentos SET iddocumento_calidad=".$iddocumento.", iddocumento_creado=".$iddocumento." WHERE documento_iddocumento=".$iddoc;				
						//phpmkr_query($update_documento_creado);						
						$datos_documento_nuevo = obtener_datos_documento($iddocumento);						
						
						$fecha_ruta = date("Y-m", strtotime($datos_documento_nuevo["fecha"]));						
						$ruta_anexos = RUTA_ARCHIVOS.$datos_documento_nuevo["estado"]."/".$fecha_ruta."/".$datos_documento_nuevo["iddocumento"]."/anexos";
						
						if(!is_dir($ruta_db_superior.$ruta_anexos)){				
							if(!crear_destino($ruta_db_superior.$ruta_anexos)){
								notificaciones("<b>Error al crear la carpeta del anexo.</b>","warning",8500);
								return(false);			
							}
						}					
						
						$anexos = busca_filtro_tabla("","anexos","documento_iddocumento=".$iddoc,"",$conn);
						
						$array_anexos = array();
													
						for ($i=0; $i < $anexos["numcampos"]; $i++) {
							$nombre_anexo = explode("/", $anexos[$i]['ruta']);
							$nombre_anexo = $nombre_anexo[sizeof($nombre_anexo)-1];	
							
							$ruta_origen  = $ruta_db_superior.$anexos[$i]['ruta'];
							$ruta_destino = $ruta_anexos."/".$nombre_anexo; 					
																
							if(!copy($ruta_origen, $ruta_db_superior.$ruta_destino)){
								notificaciones("<b>Error al pasar el anexo ".$anexos[$i]["etiqueta"]." a la carpeta del documento.</b>","warning",8500);											
							}else{								
								$sql_anexo = "INSERT INTO anexos(documento_iddocumento, ruta, tipo, etiqueta, formato, fecha) VALUES(".$iddocumento.",'".$ruta_destino."','".$anexos[$i]['tipo']."','".$anexos[$i]['etiqueta']."',".$datos_formato['idformato'].",".fecha_db_almacenar(date("Y-m-d"),"Y-m-d").")";							
								
								print_r($sql_anexo);die();
													
								phpmkr_query($sql_anexo);								
								$idanexo = phpmkr_insert_id();							 
								
								$array_anexos[] = $idanexo;
								
								if(!$idanexo){
									notificaciones("<b>Error al registrar el anexo ".$anexos[$i]["etiqueta"]."</b>","warning",8500);
								}else{
									$permiso_anexo = busca_filtro_tabla("","permiso_anexo","anexos_idanexos=".$anexos[$i]["idanexos"],"",$conn);
									
									$sql_permiso_anexo = "INSERT INTO permiso_anexo(anexos_idanexos, idpropietario, caracteristica_propio, caracteristica_dependencia, caracteristica_cargo, caracteristica_total) VALUES(".$idanexo.",'".$permiso_anexo[0]['idpropietario']."','".$permiso_anexo[0]['caracteristica_propio']."','".$permiso_anexo[0]['caracteristica_dependencia']."','".$permiso_anexo[0]['caracteristica_cargo']."','".$permiso_anexo[0]["caracteristica_total"]."')";					
									phpmkr_query($sql_permiso_anexo);						
									$idpermiso_anexo = phpmkr_insert_id();							
							
									if(!$idpermiso_anexo){
										notificaciones("<b>Error al registrar los permisos del anexo ".$anexos[$i]["etiqueta"]."</b>","warning",8500);
									}									
								}															
							}	
						}	
					}	
						
						?>