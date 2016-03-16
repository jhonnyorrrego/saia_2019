<?php 


if(@$_REQUEST['iddocumento'] && @$_REQUEST['idpaso_documento'] && @$_REQUEST['idpaso']){
		
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
			if($actividades_paso_sistema['numcampos']){ //SI EXISTEN ACTIVIDADES DEL SISTEMA
				
				for($i=0;$i<$actividades_paso_sistema['numcampos'];$i++){
								
					switch(intval($actividades_paso_sistema[$i]['accion_idaccion'])){
						case 1: //ADICIONAR
							$datos_documento_adicionar=busca_filtro_tabla("iddocumento","documento","estado='APROBADO' AND iddocumento=".$_REQUEST['iddocumento'],"",$conn);
							
							if(!$datos_documento_adicionar['numcampos']){
								$sql6="UPDATE documento SET estado='ELIMINADO' WHERE iddocumento=".$_REQUEST['iddocumento'];
								//phpmkr_query($sql6);		
								
								//TODO: validar que hacer con el usuario que radico el documento							
							}else{
								$vector_actividades_no_cancelar[]=$actividades_paso_sistema[$i]['idpaso_actividad'];
							}

							break;
							
						case 3:  //APROBAR
							//NO SE REALIZA NINGUNA ACCION, YA QUE EL DOCUMENTO ESTA APROBADO
							$vector_actividades_no_cancelar[]=$actividades_paso_sistema[$i]['idpaso_actividad'];
							break;	
							
						case 4: //CONFIRMAR
							$datos_documento_confirmar=busca_filtro_tabla("iddocumento","documento","estado='APROBADO' AND iddocumento=".$_REQUEST['iddocumento'],"",$conn);
							
							if(!$datos_documento_confirmar['numcampos']){
								
								$existe_ruta=busca_filtro_tabla("","ruta","destino<>18 AND documento_iddocumento=".$_REQUEST['iddocumento'],"",$conn);	
								
								if($existe_ruta['numcampos']){
									//hacer la parte d ela ruta
									
									
									
								}else{
									//
								}
								
							}else{
								$vector_actividades_no_cancelar[]=$actividades_paso_sistema[$i]['idpaso_actividad'];
							}							
							
							break;	
					}		
						
						
				}				
			} //FIN SI EXISTEN ACTIVIDADES DEL SISTEMA

			
	  		$sql1="UPDATE paso_documento SET estado_paso_documento=3 WHERE paso_idpaso=".$_REQUEST['idpaso']." AND documento_iddocumento=".$_REQUEST['iddocumento'];   //Pongo el paso cancelado
	  		//phpmkr_query($sql1);

			$vector_actividades_paso=array_diff($vector_actividades_paso,$vector_actividades_no_cancelar); //retiro las actividades que no se pueden cancelar
	  		
	  		$sql2="DELETE FROM paso_instancia_terminada WHERE actividad_idpaso_actividad IN(".implode(',',$vector_actividades_paso).") AND documento_iddocumento=".$_REQUEST['iddocumento'];   //ELIMINO LA INSTANCIA DE LAS ACTIVIDADES
	  		//phpmkr_query($sql2);			
			
			
	
  		}   //--FIN: SI el paso tiene actividades
	
	/*
	 * CANCELAR TODAS LAS ACTIVDADES
	 * CANCELAR EL PASO
	 * SI ES RUTA DEVOLVER AL PASO ANTERIOR (NO TODA LA RUTA) ()
	 * EMPEZAR A VALIDAR UNA A UNA LAS ACTIVIDADES QUE PASA SI SE CANCELA
	 */
	 
	 $retorno["exito"]=1;    

} //FIN: si llegan variables

?>