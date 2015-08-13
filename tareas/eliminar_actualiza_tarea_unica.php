<?php
include_once("../db.php");
$tareas=busca_filtro_tabla("","asignacion","idasignacion=".@$_REQUEST["idasignacion"],"",$conn);
$fecha_act=date('Y-m-d H:i:s');
if($tareas["numcampos"]){
  if($fecha_act>$tareas[0]["fecha_final"]){
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