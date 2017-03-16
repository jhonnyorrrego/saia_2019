<?php 
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."workflow/libreria_paso.php");
$retorno=array();
$retorno["exito"]=0;
$retorno["html"]='';
switch($_REQUEST["tipo_accion"]){
	case 0://formulario para cancelar la tarea
		if($_REQUEST["idactividad_instancia"] && $_REQUEST["idpaso_documento"]){
			$actividad=busca_filtro_tabla("","paso_instancia_terminada A, paso_documento B, paso_actividad C","C.estado=1 AND A.documento_iddocumento=B.documento_iddocumento AND A.actividad_idpaso_actividad=C.idpaso_actividad AND  B.idpaso_documento=".$_REQUEST["idpaso_documento"]." AND A.idpaso_instancia=".$_REQUEST["idactividad_instancia"],"",$conn);
			if($actividad["numcampos"]){
				//array 1,2 son los estados validos para cambiar los valores de los id
				if(in_array($actividad[0]["estado_paso_documento"],array(1,2))){
					$retorno["exito"]=1;
					$retorno["html"]='<div class="well">';
					$retorno["html"].='<form class="horizontal-form">';
					$retorno["html"].='<div class="btn btn-mini btn-primary">Reactivar Actividad</div>';
					$retorno["html"].='</form>';
					$retorno["html"].='</div>';
				}
			}
		}
	break;
	case 1://Informacion de la actividad instanciada
		if($_REQUEST["idactividad_instancia"] && $_REQUEST["idpaso_documento"]){
			$actividad=busca_filtro_tabla("","paso_instancia_terminada A, paso_documento B, paso_actividad C","C.estado=1 AND A.documento_iddocumento=B.documento_iddocumento AND A.actividad_idpaso_actividad=C.idpaso_actividad AND  B.idpaso_documento=".$_REQUEST["idpaso_documento"]." AND A.idpaso_instancia=".$_REQUEST["idactividad_instancia"],"",$conn);
			if($actividad["numcampos"]){
				$retorno["exito"]=1;
				$retorno["responsable"]=$actividad[0]["responsable"];
				$responsable=busca_filtro_tabla("","vfuncionario_dc","funcionario_codigo=".$actividad[0]["responsable"],"",$conn);
				$retorno["dato_responsable"]=$responsable[0]["nombres"]." ".$responsable[0]["apellidos"];
				$retorno["fecha"]=$actividad[0]["fecha"];
				switch($actividad[0]["tipo_terminacion"]){
					case 2: 
						$retorno["tipo_terminado"]='Manual';
					break;
					case 1:
						$retorno["tipo_terminado"]='Automatico';
					break;			
				}
				$retorno["html"]='<div class="well alert-info">';
				$retorno["html"].='<div class="pull-left"><b>'.$actividad[0]["descripcion"].'</b></div><div class="pull-right">'.$actividad[0]["fecha_asignacion"].'</div><br>';
				$retorno["html"].='<div class="pull-left">Ejecutada  por '.$retorno["dato_responsable"].'</div><div class="pull-right">'.$actividad[0]["fecha"].'</div><br>';
				$retorno["html"].='<div class="pull-left">Terminaci&oacute;n '.$retorno["tipo_terminado"].'</div><br>';
				
				
				if($actividad[0]["tipo_terminacion"]==2){ //confirma si la actividad manual tiene anexos para visualizarlos
					$anexos_manual=busca_filtro_tabla('','paso_actividad_anexo','actividad_idactividad='.$actividad[0]["idpaso_actividad"].' AND documento_iddocumento='.$actividad[0]['documento_iddocumento'],'',$conn);
					$retorno['sql']=$anexos_manual;
					
					if($anexos_manual['numcampos']){			
						$retorno["html"].='<div class="pull-left">Anexos: <a href="'.$ruta_db_superior.$anexos_manual[0]['ruta'].'" target="_blank"><b>'.$anexos_manual[0]['etiqueta'].'</b></a>  </div>';
						$retorno["html"].='</div>';
									
					}
				}else{
					$retorno["html"].='</div>';
				}
				
			}
		}
	break;
	case 2: //formulario para ejecutar la actividad de forma manual.
		if($_REQUEST["idactividad"] && $_REQUEST["idpaso_documento"]){
			$actividad=busca_filtro_tabla("","paso_documento B, paso_actividad C","C.estado=1 AND B.idpaso_documento=".$_REQUEST["idpaso_documento"]." AND C.idpaso_actividad=".$_REQUEST["idactividad"],"",$conn);
			if($actividad["numcampos"]){
				//array 1,2 son los estados validos para cambiar los valores de los id
				if(!in_array($actividad[0]["estado_paso_documento"],array(1,2))){
					$retorno["exito"]=1;
					$retorno["html"]='<div class="well">';
					$retorno["html"].='<form class="horizontal-form">';
					$retorno["html"].='<div class="btn btn-mini btn-primary">Terminar Actividad</div>';
					$retorno["html"].='</form>';
					$retorno["html"].='</div>';
				}
			}
		}
		
	break;
	case 3: //Informacion de la actividad no ejecutada
		if($_REQUEST["idactividad"] && $_REQUEST["idpaso_documento"]){
			$actividad=busca_filtro_tabla("","paso_documento B, paso_actividad C","C.estado=1 AND B.idpaso_documento=".$_REQUEST["idpaso_documento"]." AND C.idpaso_actividad=".$_REQUEST["idactividad"],"",$conn);
			if($actividad["numcampos"]){
				$retorno["exito"]=1;
				$retorno["responsable"]=$actividad[0]["responsable"];
				
				if($actividad[0]["llave_entidad"]==-2){
					$campo_formato=busca_filtro_tabla("a.nombre,a.etiqueta,b.nombre_tabla,a.banderas,b.etiqueta as etiqueta_formato","campos_formato a,formato b","a.formato_idformato=b.idformato AND a.idcampos_formato=".$actividad[0]["fk_campos_formato"],"",$conn);
					$tomado_campo=busca_filtro_tabla($campo_formato[0]['nombre'],$campo_formato[0]['nombre_tabla'],"documento_iddocumento=".$actividad[0]["documento_iddocumento"],"",$conn);

					$vector_banderas=explode(',',$campo_formato[0]['banderas']);
					$vector_banderas_validar=array('ffc','fdc','fid','fc');//funcionario_codigo,iddependencia_cargo,idfuncionario,idcargo
					$definicion_bandera=
            		$bandera_validar='';
            		for($i=0;$i<count($vector_banderas_validar);$i++){
						if(in_array($vector_banderas_validar[$i],$vector_banderas)){
                    		$bandera_validar=$vector_banderas_validar[$i];
                    		$i=count($vector_banderas_validar); //corto el ciclo
                		}
            		}
					$condicion_tomado_campo='';
		            if($bandera_validar!=''){
						switch($bandera_validar){
		                                    case 'ffc': //funcionario_codigo
		                                        $condicion_tomado_campo="funcionario_codigo='".$tomado_campo[0][$campo_formato[0]['nombre']]."'";
		                                        break;
		                                    case 'fdc': //iddependencia_cargo
		                                        $condicion_tomado_campo="iddependencia_cargo='".$tomado_campo[0][$campo_formato[0]['nombre']]."'";
		                                        break;
		                                    case 'fid': //idfuncionario
		                                        $condicion_tomado_campo="idfuncionario='".$tomado_campo[0][$campo_formato[0]['nombre']]."'";
		                                        break;
		                                    case 'cargo': //idcargo
		                                        $condicion_tomado_campo="idcargo='".$tomado_campo[0][$campo_formato[0]['nombre']]."'";
		                                        break;                                        
		                }
		                
		                               
		            }
		            if($condicion_tomado_campo!=''){
		            						$busca_tomado_fc=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc",$condicion_tomado_campo,"",$conn);
						if($busca_tomado_fc['numcampos']){
							$actividad[0]["responsable"]=$busca_tomado_fc[0]['funcionario_codigo'];
						}
		            	//print_r($busca_tomado_fc);
		            }										
					
				}
				
				$responsable=busca_filtro_tabla("","vfuncionario_dc","funcionario_codigo=".$actividad[0]["responsable"],"",$conn);
				$retorno["dato_responsable"]=$responsable[0]["nombres"]." ".$responsable[0]["apellidos"];
				$retorno["fecha"]=$actividad[0]["fecha"];
				$obj_fecha_asignacion=new DateTime($actividad[0]["fecha_asignacion"]);
				$cad_interval="P";
				if($actividad[0]["tipo_plazo"]=="hour"){
					$cad_interval.="T";
				}
				$plazo=new DateInterval($cad_interval.$actividad[0]["plazo"].strtoupper($actividad[0]["tipo_plazo"][0]));
				if($actividad[0]["fecha_limite"]){
					$obj_fecha_limite=new DateTime($actividad[0]["fecha_limite"]);
				}
				else{
					$obj_fecha_limite=new DateTime($actividad[0]["fecha_asignacion"]);
					$obj_fecha_limite->add($plazo);
				}
				$obj_hoy=new DateTime();
				
				$diff=resta_dos_fechas_saia('',$obj_fecha_limite->format("Y-m-d H:i:s"));
				$class_div='well alert-info';
				$encabezado='';
				$vencimiento='';
				if($diff->invert){
					//define si la fecha es negativa es decir se pasa de la fecha limite
					$class_div='well alert-error';
					$encabezado='<b>Actividad Atrasada</b><br>';
					$vencimiento.=" <b>Vencido</b> ";
				}
				else{
					$class_div='well alert-info';
					$vencimiento.=" <b>Vence en</b> ";
				}
				$texto_vencido=texto_atraso_saia($diff,"ymdhi");
				$vencimiento.=$texto_vencido;
				$retorno["html"]='<div class="'.$class_div.'" id="'.$actividad[0]["idactividad"].'">';
				$retorno["html"].=$encabezado;
				$retorno["html"].='<div class="pull-left"><b>'.$actividad[0]["descripcion"].'</b></div><div class="pull-right">'.$actividad[0]["fecha_asignacion"].'</div><br>';
				if($retorno["dato_responsable"]!=''){
					$retorno["html"].='<div ><b>Responsable:</b> '.$retorno["dato_responsable"].'</div>';
					if($actividad[0]["llave_entidad"]==-2){
						$retorno["html"].='<div ><b>Formato:</b> '.$campo_formato[0]["etiqueta_formato"].'</div>';
						$retorno["html"].='<div ><b>Campo:</b> '.$campo_formato[0]["etiqueta"].'</div>';
					}
					
				}
				$retorno["html"].='<div class="pull-left"><b>Fecha L&iacute;mite:</b> '.$obj_fecha_limite->format("Y-m-d H:i:s").'</div>';
				$retorno["html"].='<div class="pull-right">'.$vencimiento.'</div>';
				$retorno["html"].='</div>';
			}
		}
	break;
  case 4:
    //Listado de los funcionarios que poseen los cargos seleccionados
    if($_REQUEST["idcargo"]){
      $funcionario=busca_filtro_tabla("","vfuncionario_dc","idcargo=".$_REQUEST["idcargo"]." AND estado_dc=1 AND estado_dep=1 AND estado=1","",$conn);
      $retorno["exito"]=1;
      $retorno["html"]='';
      for($i=0;$i<$funcionario["numcampos"];$i++){
        $retorno["html"].='<div class="well alert alert-info" id="'.$funcionario[$i]["idfuncionario"].'">';
        $retorno["html"].='<div class="pull-left"><b>'.$funcionario[$i]["nombres"]." ".$funcionario[$i]["apellidos"].'</b></div><div class="pull-right">'.$funcionario[$i]["dependencia"].'</div><br>';
        $retorno["html"].='</div>';
      }
    }
  break;
  case 5:
	  //cancelacion de paso desde la pantalla de usuario final
	  $retorno["exito"]=0;
	  if(@$_REQUEST['iddocumento'] && @$_REQUEST['idpaso_documento'] && @$_REQUEST['idpaso']){
			
	  	//CANCELO ACTIVIDADES
	  	
	  		$actividades=busca_filtro_tabla("idpaso_actividad","paso_actividad","estado=1 AND paso_idpaso=".$_REQUEST['idpaso'],"",$conn);
			
			$actividades_cancelar=implode(',',extrae_campo($actividades,'idpaso_actividad'));
		
		//CANCELO PASO
		
		
		
		//VERIFICAR QUE HACER CON CADA ACTIVIDAD CANCELADA
		
		/*
		 * 
		$ruta=busca_filtro_tabla("","ruta","documento_iddocumento=".$_REQUEST['iddocumento'],"",$conn);   //VALIDO SI EXISTE RUTA
		if($ruta['numcampos']){  //SI EXISTE RUTA
			$sql1="UPDATE  ruta SET tipo='INACTIVO' WHERE documento_iddocumento=".$_REQUEST['iddocumento'];   //DESACTIVO RUTA
			phpmkr_query($sql1);
			$sql2= "UPDATE buzon_entrada SET activo=0, nombre=".concatenar_cadena_sql(array("'ELIMINA_'","nombre"))." WHERE archivo_idarchivo='".$_REQUEST['iddocumento']."' AND nombre NOT LIKE 'ELIMINA_%' ";  //DESACTIVO BZN ENTRADA
			phpmkr_query($sql2);
		}  
		
		$pasos_anteriores=listado_pasos_anteriores_admin($_REQUEST['idpaso'],$tipo_paso="bpmn_tarea");   //OBTENGO PASOS ANTERIORES
		$paso_anterior=$pasos_anteriores[ count($pasos_anteriores)-1 ];  //OBTENGO EL PASO ANTERIOR
		
		
		$actividades_paso_anterior=busca_filtro_tabla("paso_idpaso","paso_actividad","estado=1 AND paso_anterior=".$paso_anterior,"",$conn);  //obtendo los pasos que dependen del paso anterior
		$pasos_cancelar=implode(',',extrae_campo($actividades_paso_anterior,'paso_idpaso'));
		
		
		$sql3="UPDATE paso_documento SET estado_paso_documento=3 WHERE paso_idpaso IN(".$pasos_cancelar.") AND documento_iddocumento=".$_REQUEST['iddocumento'];   //cancelamos los pasos que dependian del paso anterior
		//phpmkr_query($sql3);
		
		$sql4="UPDATE paso_documento SET estado_paso_documento=4 WHERE paso_idpaso=".$paso_anterior." AND documento_iddocumento=".$_REQUEST['iddocumento']; //activa paso anterior a estado pendiente
		//phpmkr_query($sql4);
		
		//falta averiguar como reiniciar la ruta 
		*/
		
		//$retorno["verifica"]=$sql_acpa;
		
		/*
		 * CANCELAR TODAS LAS ACTIVDADES
		 * CANCELAR EL PASO
		 * SI ES RUTA DEVOLVER AL PASO ANTERIOR (NO TODA LA RUTA) ()
		 * EMPEZAR A VALIDAR UNA A UNA LAS ACTIVIDADES QUE PASA SI SE CANCELA
		 * */
		
		

		$retorno["exito"]=1;  
		  
	  }

	break;
}
echo(json_encode($retorno));
?>