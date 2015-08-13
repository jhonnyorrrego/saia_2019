<?php
include_once("../db.php");
if(@$_REQUEST["delta"] && $_REQUEST["idtarea"]){
  $sql='UPDATE asignacion SET fecha_inicial='.suma_fechas('fecha_inicial',$_REQUEST["delta"]).', fecha_final='.suma_fechas('fecha_final',$_REQUEST["delta"]).' WHERE idasignacion='.$_REQUEST["idtarea"];
ejecuta_filtro_tabla($sql,$conn);
}
?>