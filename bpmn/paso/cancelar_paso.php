<?php 


if(@$_REQUEST['iddocumento'] && @$_REQUEST['idpaso_documento'] && @$_REQUEST['idpaso']){
		$retorno["exito"]=0;
  		$actividades_paso=busca_filtro_tabla("","paso_actividad a, paso_instancia_terminada b","a.paso_idpaso=".$_REQUEST['idpaso']." AND a.idpaso_actividad=b.actividad_idpaso_actividad AND b.estado_actividad IN(1,2,6) AND a.estado=1 AND b.documento_iddocumento=".$_REQUEST['iddocumento'],"",$conn);  //obtengo las actividades iniciadas, cerradas, terminadas
  				  		
  		//VERIFICACION DE CADA ACTIVIDAD
  		
  		if($actividades_paso['numcampos']){ //SI el paso tiene actividades
  			
  			$vector_actividades_paso_instancia=extrae_campo($actividades_paso,'idpaso_instancia');
			$vector_actividades_paso=extrae_campo($actividades_paso,'idpaso_actividad');

			//SI LA ACTIVIDAD ES MANUAL
			
			$vector_actividades_paso_manuales_instancia=array();
			$vector_actividades_paso_manuales=array();
			for($i=0;$i<$actividades_paso['numcampos'];$i++){
				if($actividades_paso[$i]['tipo']==0){
					$vector_actividades_paso_manuales_instancia[]=$actividades_paso[$i]['idpaso_instancia']; //Almaceno actividades manuales
					$vector_actividades_paso_manuales[]=$actividades_paso[$i]['idpaso_actividad'];
				}
			}						
			
			$anexos_actividades_manuales=busca_filtro_tabla("","paso_actividad_anexo","actividad_idactividad IN(".implode(',',$vector_actividades_paso_manuales).") AND documento_iddocumento=".$_REQUEST['iddocumento'],"",$conn);
			
			if($anexos_actividades_manuales['numcampos']){   //Si las actividades manuales tienen anexos

				for($i=0;$i<$anexos_actividades_manuales['numcampos'];$i++){  //MOVER: eliminados_actividades/idpaso_actividad_anexo _ actividad_idactividad _ etiqueta
				
					$ruta=$ruta_db_superior.$anexos_actividades_manuales[$i]['ruta'];
					if( is_file($ruta) ){  
						$etiqueta=basename($ruta);
						$ruta_eliminado=str_replace('anexos_actividades/'.$etiqueta,'eliminados_actividades/',$anexos_actividades_manuales[$i]['ruta']);
						crear_destino($ruta_db_superior.$ruta_eliminado);
						chmod($ruta_db_superior.$ruta_eliminado,0777);
						$ruta_eliminado.=$anexos_actividades_manuales[$i]['idpaso_actividad_anexo'].'_'.$anexos_actividades_manuales[$i]['actividad_idactividad'].'_'.$anexos_actividades_manuales[$i]['etiqueta'];
						copy($ruta,$ruta_db_superior.$ruta_eliminado);
						chmod($ruta_db_superior.$ruta_eliminado,0777);
						unlink($ruta);
					}
				}
				$sql3="DELETE FROM paso_actividad_anexo WHERE actividad_idactividad IN(".implode(',',$vector_actividades_paso_manuales).") AND documento_iddocumento=".$_REQUEST['iddocumento']; //Elimino registro de anexos de actividades manuales
				phpmkr_query($sql3);	
				
			} //--FIN: Si las actividades manuales tienen anexos						
			
			if(count($vector_actividades_paso_manuales_instancia)>0){ 
				$comentarios_actividades_manuales=busca_filtro_tabla("","paso_inst_terminacion a, paso_instancia_terminada b","a.instancia_idpaso_instancia=b.idpaso_instancia AND a.documento_idpaso_documento=".$_REQUEST['idpaso_documento']." AND a.instancia_idpaso_instancia IN(".implode(',',$vector_actividades_paso_manuales_instancia).")","",$conn);	

				if($comentarios_actividades_manuales['numcampos']){
					$rastro_actividades_manuales="INSERT INTO paso_instancia_rastro (estado_original,estado_final,fecha_cambio,inst_idpaso_inst,instancia_idpaso_instancia,documento_idpaso_documento,funcionario_codigo,observaciones) VALUES ";
					for($i=0;$i<$comentarios_actividades_manuales['numcampos'];$i++){
						$rastro_actividades_manuales.="('".$comentarios_actividades_manuales[$i]['estado_actividad']."','3','".date('Y-m-d H:i:s')."','".$comentarios_actividades_manuales[$i]['idpaso_inst_terminacion']."','".$comentarios_actividades_manuales[$i]['instancia_idpaso_instancia']."','".$comentarios_actividades_manuales[$i]['documento_idpaso_documento']."','".$comentarios_actividades_manuales[$i]['funcionario_codigo']."','".$comentarios_actividades_manuales[$i]['observaciones']."' )";	
						
						if( !($i+1)==$comentarios_actividades_manuales['numcampos'] ){
							$rastro_actividades_manuales=', ';
						}		
					}
					$sql4=$rastro_actividades_manuales;   
					phpmkr_query($sql4); //ALMACENAMOS RASTRO DEL REGISTRO DE COMENTARIOS	
					$sql5="DELETE FROM paso_inst_terminacion WHERE documento_idpaso_documento=".$_REQUEST['idpaso_documento']." AND instancia_idpaso_instancia IN(".implode(',',$vector_actividades_paso_manuales_instancia).")";
					phpmkr_query($sql5);	   //ELIMINAMOS REGISTRO DE COMENTARIOS
					
				}  //FIN: $comentarios_actividades_manuales['numcampos']
										
			}

			//SI LA ACTIVIDAD ES DEL SISTEMA		
					
			$vector_actividades_paso_sistema_instancia=array_diff($vector_actividades_paso_instancia,$vector_actividades_paso_manuales_instancia); //Almaceno actividades del sistema	
			$vector_actividades_paso_sistema=array_diff($vector_actividades_paso,$vector_actividades_paso_manuales); //Almaceno actividades del sistema	

			
			$actividades_paso_sistema=busca_filtro_tabla("","paso_actividad a, paso_instancia_terminada b","a.paso_idpaso=".$_REQUEST['idpaso']."  AND  a.idpaso_actividad=b.actividad_idpaso_actividad AND a.estado=1 AND a.idpaso_actividad IN(".implode(',',$vector_actividades_paso_sistema).") AND b.estado_actividad IN(1,2,6) AND b.documento_iddocumento=".$_REQUEST['iddocumento'],"",$conn);  //obtengo las actividades iniciadas, cerradas, terminadas //obtengo las actividades iniciadas, cerradas, terminadas
			$vector_actividades_no_cancelar=array();
			
			//$retorno['actividades_paso_terminadas']=$actividades_paso_sistema;
			if($actividades_paso_sistema['numcampos']){ //SI EXISTEN ACTIVIDADES DEL SISTEMA
				
				for($i=0;$i<$actividades_paso_sistema['numcampos'];$i++){
								
					switch(intval($actividades_paso_sistema[$i]['accion_idaccion'])){
						case 1: //ADICIONAR
							$datos_documento_adicionar=busca_filtro_tabla("iddocumento","documento","estado='APROBADO' AND iddocumento=".$_REQUEST['iddocumento'],"",$conn);
							
							if(!$datos_documento_adicionar['numcampos']){
								$sql6="UPDATE documento SET estado='ELIMINADO' WHERE iddocumento=".$_REQUEST['iddocumento'];
								phpmkr_query($sql6);		
								
								//TODO: validar que hacer con el usuario que radico el documento							
							}else{
								$vector_actividades_no_cancelar[]=$actividades_paso_sistema[$i]['idpaso_actividad'];
							}

							break;
							
						case 3:  //APROBAR
							//NO SE REALIZA NINGUNA ACCION, YA QUE EL DOCUMENTO ESTA APROBADO
							$retorno["doc_aprobado"]=1;
							$vector_actividades_no_cancelar[]=$actividades_paso_sistema[$i]['idpaso_actividad'];
							break;	
							
						case 7: //CONFIRMAR
							$datos_documento_confirmar=busca_filtro_tabla("iddocumento","documento","estado='APROBADO' AND iddocumento=".$_REQUEST['iddocumento'],"",$conn);

							if(!$datos_documento_confirmar['numcampos']){
								
								$existe_ruta=busca_filtro_tabla("","ruta","destino<>18 AND documento_iddocumento=".$_REQUEST['iddocumento'],"",$conn);	
								
								if($existe_ruta['numcampos']){
									//INICIO DESARROLLO CANCELAR RUTA
									
										$iddoc=$_REQUEST['iddocumento'];
										
										$ruta=busca_filtro_tabla("a.idruta,a.origen,a.tipo_origen","ruta a","a.origen<>-1 AND a.documento_iddocumento=".$iddoc,"a.idruta ASC",$conn);
										
										$vector_ruta=array('idruta'=>array(),'funcionario_codigo'=>array());
										
										for($i=0;$i<$ruta['numcampos'];$i++){
											if($ruta[$i]['tipo_origen']==1){ //funcionario_codigo
												$funcionario=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc a, ruta b","a.estado_dc=1 AND a.funcionario_codigo=b.origen AND b.documento_iddocumento=".$iddoc." AND a.funcionario_codigo=".$ruta[$i]['origen'],"",$conn);
												$vector_ruta['idruta'][]=$ruta[$i]['idruta'];
												$vector_ruta['funcionario_codigo'][]=$funcionario[0]['funcionario_codigo'];
												
											}else{ //iddependencia_cargo
												$funcionario=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc a, ruta b","b.documento_iddocumento=".$iddoc." AND  a.iddependencia_cargo=b.origen AND a.iddependencia_cargo=".$ruta[$i]['origen'],"",$conn);
												$vector_ruta['idruta'][]=$ruta[$i]['idruta'];
												$vector_ruta['funcionario_codigo'][]=$funcionario[0]['funcionario_codigo'];
											}
										}
										
										$bzn_salida=busca_filtro_tabla("a.origen,a.ruta_idruta","buzon_salida a, ruta b","a.ruta_idruta=b.idruta AND a.nombre='REVISADO' AND a.ruta_idruta IN(".implode(',',$vector_ruta['idruta']).") AND a.archivo_idarchivo=".$iddoc,"a.idtransferencia ASC",$conn);
										//$retorno["consulta_bzn_salida"]=$bzn_salida;
										if($bzn_salida['numcampos']){
											
											$bzn_entrada=busca_filtro_tabla("a.destino,a.origen,a.idtransferencia,a.ruta_idruta","buzon_entrada a, ruta b","a.ruta_idruta=b.idruta AND a.nombre='POR_APROBAR' AND a.destino='".$bzn_salida[$bzn_salida['numcampos']-1]['origen']."' AND a.archivo_idarchivo=".$iddoc,"a.idtransferencia ASC",$conn);
											
											$bzn_entrada_anterior=busca_filtro_tabla("a.origen,a.idtransferencia,a.ruta_idruta","buzon_entrada a","a.nombre='POR_APROBAR' AND a.origen='".$bzn_entrada[  $bzn_entrada['numcampos']-1 ]['destino']."' AND a.archivo_idarchivo=".$iddoc,"a.idtransferencia ASC",$conn);	
											
											
											//RUTA
											
											if($bzn_entrada['numcampos']){
												$sql7="UPDATE ruta SET origen='-1' WHERE idruta=".$bzn_entrada[  $bzn_entrada['numcampos']-1 ]['ruta_idruta'];	
												phpmkr_query($sql7);	
												//$retorno["sql7"]=$sql7;
											}
											if($bzn_entrada_anterior['numcampos']){
												$sql8="UPDATE ruta SET destino='-1' WHERE idruta=".$bzn_entrada_anterior[  $bzn_entrada_anterior['numcampos']-1 ]['ruta_idruta'];
												phpmkr_query($sql8);	
												//$retorno["sql8"]=$sql8;
											}	
											
											//BUZON SALIDA
											if($bzn_entrada_anterior['numcampos']){
												$idruta_anterior=busca_filtro_tabla("","ruta","idruta<'".$bzn_entrada_anterior[  $bzn_entrada_anterior['numcampos']-1 ]['ruta_idruta']."' AND documento_iddocumento='".$iddoc."' AND condicion_transferencia='POR_APROBAR' ","",$conn);
										
												if($idruta_anterior['numcampos']){
													$bzn_salida_partir=busca_filtro_tabla("","buzon_salida","ruta_idruta='".$idruta_anterior[ $idruta_anterior['numcampos']-1 ]['idruta']."' AND  archivo_idarchivo=".$iddoc,"",$conn);
													if($bzn_salida_partir['numcampos']){
														$sql9="DELETE FROM buzon_salida WHERE idtransferencia>'".$bzn_salida_partir[ $bzn_salida_partir['numcampos']-1 ]['idtransferencia']."' AND nombre<>'TRANSFERIDO' AND archivo_idarchivo=".$iddoc;
														phpmkr_query($sql9);	
														//$retorno["sql9"]=$sql9;
													}
												}
											}
										
											//BUZON ENTRADA
											
											if($bzn_entrada_anterior['numcampos']){
												$sql10="UPDATE buzon_entrada SET origen='-1',activo='1' WHERE archivo_idarchivo='".$iddoc."' AND ruta_idruta='".$bzn_entrada_anterior[  $bzn_entrada_anterior['numcampos']-1 ]['ruta_idruta']."'  ";
												phpmkr_query($sql10);
												//$retorno["sql10"]=$sql10;	
											}	
											if($bzn_entrada['numcampos']){
												$sql11="UPDATE buzon_entrada SET destino='-1',activo='1' WHERE archivo_idarchivo='".$iddoc."' AND ruta_idruta='".$bzn_entrada[  $bzn_entrada['numcampos']-1 ]['ruta_idruta']."'  ";
												phpmkr_query($sql11);
												//$retorno["sql11"]=$sql11;		
											}
											
											if($bzn_entrada_anterior['numcampos']){
												$idruta_anterior2=busca_filtro_tabla("","ruta","idruta<'".$bzn_entrada_anterior[  $bzn_entrada_anterior['numcampos']-1 ]['ruta_idruta']."' AND documento_iddocumento='".$iddoc."' AND condicion_transferencia='POR_APROBAR' ","",$conn);
												
												if($idruta_anterior2['numcampos']){
													$bzn_entrada_partir=busca_filtro_tabla("","buzon_entrada","ruta_idruta='".$idruta_anterior2[ $idruta_anterior2['numcampos']-1 ]['idruta']."' AND  archivo_idarchivo=".$iddoc,"",$conn);
													if($bzn_entrada_partir['numcampos']){
														$sql12="DELETE FROM buzon_entrada WHERE idtransferencia>'".$bzn_entrada_partir[ $bzn_entrada_partir['numcampos']-1 ]['idtransferencia']."' AND nombre<>'TRANSFERIDO' AND archivo_idarchivo=".$iddoc;
														phpmkr_query($sql12);	
														//$retorno["sql12"]=$sql12;		
													}
												}		
												
											}
										}
										
										$diagram_iddiagram=busca_filtro_tabla("diagram_iddiagram","paso","idpaso=".$_REQUEST['idpaso'],"",$conn);
										$idpaso_anterior=paso_anterior($_REQUEST['idpaso'],$diagram_iddiagram[0]['diagram_iddiagram']);	
										if($idpaso_anterior!=0){
											$sql13="UPDATE paso_documento SET estado_paso_documento=4 WHERE paso_idpaso=".$idpaso_anterior." AND documento_iddocumento=".$iddoc;
											
											phpmkr_query($sql13);
											//$retorno["sql13"]=$sql13;		
											$actividades_paso_anterior=busca_filtro_tabla("","paso_actividad","paso_idpaso='".$idpaso_anterior."' AND accion_idaccion=7 AND estado=1 ","",$conn);
										
											$sql14="DELETE FROM paso_instancia_terminada WHERE actividad_idpaso_actividad IN(".implode(',',extrae_campo($actividades_paso_anterior,'idpaso_actividad')).") AND documento_iddocumento=".$iddoc;
											phpmkr_query($sql14);
											//$retorno["sql14"]=$sql14;		
										}																	
									
									//FIN DESARROLLO CANCELAR RUTA
	
								}else{
									//
								}
								
							}else{
								$retorno["doc_aprobado"]=1;
								$vector_actividades_no_cancelar[]=$actividades_paso_sistema[$i]['idpaso_actividad'];
							}							
							
							break;	
					}		
						
						
				}				
			} //FIN SI EXISTEN ACTIVIDADES DEL SISTEMA

			
	  		//$sql1="UPDATE paso_documento SET estado_paso_documento=3 WHERE paso_idpaso=".$_REQUEST['idpaso']." AND documento_iddocumento=".$_REQUEST['iddocumento'];   //Pongo el paso cancelado 
	  		$sql1="DELETE FROM paso_documento WHERE paso_idpaso=".$_REQUEST['idpaso']." AND documento_iddocumento=".$_REQUEST['iddocumento'];
	  		phpmkr_query($sql1);

			$vector_actividades_paso=array_diff($vector_actividades_paso,$vector_actividades_no_cancelar); //retiro las actividades que no se pueden cancelar
	  		
	  		$sql2="DELETE FROM paso_instancia_terminada WHERE actividad_idpaso_actividad IN(".implode(',',$vector_actividades_paso).") AND documento_iddocumento=".$_REQUEST['iddocumento'];   //ELIMINO LA INSTANCIA DE LAS ACTIVIDADES
	  		phpmkr_query($sql2);	
							
			$retorno["exito"]=1;    
  		}   //--FIN: SI el paso tiene actividades
	
	 
	 

} //FIN: si llegan variables

?>