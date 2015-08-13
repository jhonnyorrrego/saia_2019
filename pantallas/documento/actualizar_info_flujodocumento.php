<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior="";
$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}   
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");
estado_flujo_actual(@$_REQUEST["idpaso_doc"]);
tareas_flujo(@$_REQUEST["idpaso_doc"]);
function estado_flujo_actual($idpaso_documento){
global $conn;
$flujo=estado_flujo_instancia($idpaso_documento);
$porcentaje=$flujo["porcentaje"];
$fecha_final_diagram=$flujo["fecha_final_diagrama"];
$fecha_inicio = busca_filtro_tabla(fecha_db_obtener('b.fecha','Y-m-d H:i:s')." as fecha_inicio","paso_documento a, diagram_instance b","idpaso_documento=".$idpaso_documento." and diagram_iddiagram_instance=iddiagram_instance","",$conn);
$dia = busca_filtro_tabla(resta_fechas(fecha_db_almacenar($fecha_final_diagram,'Y-m-d'),fecha_db_almacenar(date('Y-m-d'),'Y-m-d'))."as dias","dual","","",$conn);
  $dias = $dia[0]["dias"];
   if($flujo["devueltos"]){
     $flujo[0]["estado_diagram_instance"]=7;
   }
   	if($dias < 0){
   		$color = 'alert-error';
   	}
	else if($dias >= 0 && $dias <=1){
		$color = 'alert-warning';
	}
	else if($dias > 1){
		$color = 'alert-success';
	}
   
  $texto="<div class='alert ".$color."'><b>Informaci&oacute;n del Flujo</b><br /><b>Paso Actual:</b> ".$flujo[0]["nombre_paso"]."<br /><b>Inicio: </b>".$fecha_inicio[0]["fecha_inicio"]."</br><b>Terminados:</b> (".(($flujo["numcampos"]))."/".$flujo["pasos_flujo"]."):".$porcentaje."%<br /><b>Fecha limite: </b>".$fecha_final_diagram."<br /><b>Estado: </b>Vence en ".$dias." dia(s)<br /></div>";
  
    echo ($texto);
}
function estado_flujo_instancia($idpaso_documento){
global $conn;
$paso_documento=busca_filtro_tabla("","paso_documento","idpaso_documento=".$idpaso_documento,"idpaso_documento DESC",$conn);
$flujo=busca_filtro_tabla("A.idpaso_documento, A.estado_paso_documento,B.diagram_iddiagram,B.plazo_paso, ".fecha_db_obtener("fecha_asignacion","Y-m-d H:i:s")." AS fecha_asignacion, C.estado_diagram_instance, C.fecha AS fecha_diagram,B.nombre_paso,C.iddiagram_instance,paso_idpaso,A.documento_iddocumento","paso_documento A,paso B, diagram_instance C","A.paso_idpaso=B.idpaso AND A.diagram_iddiagram_instance=C.iddiagram_instance AND A.diagram_iddiagram_instance=".$paso_documento[0]["diagram_iddiagram_instance"]." AND estado_paso_documento<>7","idpaso_documento DESC",$conn);
$plazo=explode("@",$flujo[0]["plazo_paso"]);
$fecha_final=dias_habiles(($plazo[0]/24),"Y-m-d",$flujo[0]["fecha_asignacion"]);
$fecha_fina2=dias_habiles((($plazo[0]/24)),"Y-m-d",$flujo[0]["fecha_asignacion"]);
$hoy=date("Y-m-d H:i:s");
$diferencia=compara_fechas($fecha_final,$hoy);
if($flujo[0]["estado_paso_documento"]>3){
  //Verifica si el estado del paso del documento es Pendiente(4) o Iniciado(6) y esta atrasado actualiza el estado del paso
  if($diferencia["tiempo"] && in_array($flujo[0]["estado_paso_documento"],array(4,6))){
    $sql_paso="UPDATE paso_documento SET estado_paso_documento=5 WHERE idpaso_documento=".$idpaso_documento;
    phpmkr_query($sql_paso);
    $flujo[0]["estado_paso_documento"]=5;
  }
}     
$estado="";
$estadod="";
$pasos_flujo=busca_filtro_tabla("","paso","diagram_iddiagram=".$flujo[0]["diagram_iddiagram"],"",$conn);
$pasos_devueltos=busca_filtro_tabla("idpaso_documento","paso_documento","diagram_iddiagram_instance=".$paso_documento[0]["diagram_iddiagram_instance"]." AND estado_paso_documento=7","",$conn);
$total_restrictivos=0;
$total_paso=0;
for($i=0;$i<$pasos_flujo["numcampos"];$i++){
  $peso=explode("@",$pasos_flujo[$i]["plazo_paso"]);
  $total_restrictivos+=$peso[0];
  $total_paso+=$peso[1];
}
$fecha_final_diagram=dias_habiles((($total_restrictivos)/24),"Y-m-d",$flujo[0]["fecha_diagram_instance"]);
$diferenciad=compara_fechas($fecha_final_diagram,$hoy);
if($flujo[0]["estado_diagram_instance"]>3){
  if($diferenciad["tiempo"]&& in_array($flujo[0]["estado_paso_documento"],array(4,6))){
    $sql_diagram="UPDATE diagram_instance SET estado_diagram_instance=5 WHERE iddiagram_instance=".$flujo[0]["diagram_iddiagram"];
    phpmkr_query($sql_diagram);
    $flujo[0]["estado_diagram_instance"]=5;
  }
}
if($flujo["numcampos"] && !in_array($flujo[0]["estado_paso_documento"],array(1,2))){
  $flujo["numcampos"]--;
}      
if($pasos_flujo["numcampos"])
  $porcentaje=round((($flujo["numcampos"])*100)/$pasos_flujo["numcampos"],2);
else 
  $porcentaje=0;
$flujo["devueltos"]=$pasos_devueltos["numcampos"];  
$flujo["porcentaje"]=$porcentaje;
$flujo["pasos_flujo"]=$pasos_flujo["numcampos"];
$flujo["fecha_final_diagrama"]=$fecha_final_diagram;
$flujo["fecha_final_paso"]=$fecha_final;
$flujo["diferencia"]=$diferencia;
$flujo["diferenciad"]=$diferenciad;
$flujo["fecha_final_paso"]=$fecha_fina2;
return($flujo);
}
function tareas_flujo($idpaso_documento){
global $conn;
$flujo=estado_flujo_instancia($idpaso_documento);
$paso = busca_filtro_tabla("","paso_documento","diagram_iddiagram_instance=".$flujo[0]["iddiagram_instance"]." and paso_idpaso=".$flujo[0]["paso_idpaso"],"idpaso_documento desc",$conn);
$restringido = false;
$terminados = 0;
$actividades = busca_filtro_tabla("","paso_actividad","paso_idpaso=".$paso[0]["paso_idpaso"],"",$conn);
for($i=0;$i<$actividades["numcampos"];$i++){
  $terminada = busca_filtro_tabla("","paso_instancia_terminada","actividad_idpaso_actividad=".$actividades[$i]["idpaso_actividad"]." and documento_iddocumento=".$paso[0]["documento_iddocumento"],"",$conn);
	if($terminada["numcampos"] > 0){
		$terminados++;
	}
}  
$porcentaje = round((($terminados*100)/$actividades["numcampos"]),2);
$pocentaje_tarea = '('.$terminados.'/'.$actividades["numcampos"].'):'.$porcentaje.'%';	
$tareas = busca_filtro_tabla("","paso_actividad","paso_idpaso=".$flujo[0]["paso_idpaso"],"idpaso_actividad asc",$conn);
for($i=0;$i<$tareas["numcampos"];$i++){
	$tarea .= ($i+1).". ".$tareas[$i]["descripcion"]."<br>";
}
$dia = busca_filtro_tabla(resta_fechas(fecha_db_almacenar($flujo["fecha_final_paso"],'Y-m-d'),fecha_db_almacenar(date('Y-m-d'),'Y-m-d'))."as dias","dual","","",$conn);  
$dias = $dia[0]["dias"]; 
if($dias < 0){
  $color = 'alert-error';
}
else if($dias >= 0 && $dias <=1){
	$color = 'alert-warning';
}
else if($dias > 1){
	$color = 'alert-success';
}
	//print_r($d);
$fecha_inicio=date_parse($paso[0]["fecha_asignacion"]);
$anioinicial=$fecha_inicio["year"];
$mesinicial=$fecha_inicio["month"];
$diainicial=$fecha_inicio["day"];
if($mesinicial < 10)
  $mesinicial = '0'.$mesinicial;
if($diainicial < 10)
  $diainicial = '0'.$diainicial;
$paso[0]["fecha_asignacion"] = $anioinicial.'-'.$mesinicial.'-'.$diainicial;
$texto = '';  
$texto.= '<b>Inicio:</b> '.$paso[0]["fecha_asignacion"].'<br /><b>Terminados:</b>'.$pocentaje_tarea.'<br /><b>Fecha l&iacute;mite: </b>'.$flujo["fecha_final_paso"].'<br /><b>Tareas: </b><br />'.$tarea; 
	echo ("<div class='alert ".$color."'><b>Informaci&oacute;n Paso Actual</b><br />".$texto."</div>"); 
}
?>