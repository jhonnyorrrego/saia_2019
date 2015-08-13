<?php
include_once("../db.php");
$cadena='';
$tareas=busca_filtro_tabla("*,".resta_fechas("fecha_final","")." AS def_final,".resta_fechas("fecha_inicial","")." AS def_inicial","asignacion","idasignacion=".@$_REQUEST["idasignacion"],"idasignacion DESC",$conn);
//print_r($tareas);
$fecha_act=date('Y-m-d H:i:s');
if($tareas["numcampos"]){
  if($fecha_act>$tareas[0]["fecha_final"] && $tareas[0]["fecha_final"] !='0000-00-00 00:00:00'){
  	  $estado_general="vencida";
  }
  else{
    if($fecha_act>$tareas[0]["fecha_inicial"]){
  	   $estado_general="en_ejecucion";
  	}
    else{
  	   $estado_general="pendiente";
    }
  }
  $cadena=$tareas[0]["descripcion"].' ('.$estado_general.')';
  echo($cadena);
}

?>