<?php 
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");
$retorno=array();
$retorno["exito"]=0;
$retorno["html"]='';
switch($_REQUEST["tipo_accion"]){
	case 0://formulario para cancelar la tarea
		if($_REQUEST["idactividad_instancia"] && $_REQUEST["idpaso_documento"]){
			$actividad=busca_filtro_tabla("","paso_instancia_terminada A, paso_documento B, paso_actividad C","A.documento_iddocumento=B.documento_iddocumento AND A.actividad_idpaso_actividad=C.idpaso_actividad AND  B.idpaso_documento=".$_REQUEST["idpaso_documento"]." AND A.idpaso_instancia=".$_REQUEST["idactividad_instancia"],"",$conn);
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
			$actividad=busca_filtro_tabla("","paso_instancia_terminada A, paso_documento B, paso_actividad C","A.documento_iddocumento=B.documento_iddocumento AND A.actividad_idpaso_actividad=C.idpaso_actividad AND  B.idpaso_documento=".$_REQUEST["idpaso_documento"]." AND A.idpaso_instancia=".$_REQUEST["idactividad_instancia"],"",$conn);
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
					$anexos_manual=busca_filtro_tabla('','paso_actividad_anexo','actividad_idactividad='.$_REQUEST["idactividad"].' AND documento_iddocumento='.$actividad[0]['documento_iddocumento'],'',$conn);
					
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
			$actividad=busca_filtro_tabla("","paso_documento B, paso_actividad C","B.idpaso_documento=".$_REQUEST["idpaso_documento"]." AND C.idpaso_actividad=".$_REQUEST["idactividad"],"",$conn);
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
			$actividad=busca_filtro_tabla("","paso_documento B, paso_actividad C","B.idpaso_documento=".$_REQUEST["idpaso_documento"]." AND C.idpaso_actividad=".$_REQUEST["idactividad"],"",$conn);
			if($actividad["numcampos"]){
				$retorno["exito"]=1;
				$retorno["responsable"]=$actividad[0]["responsable"];
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
}
echo(json_encode($retorno));
?>