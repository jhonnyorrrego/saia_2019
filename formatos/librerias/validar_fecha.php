<?php 
if(@$_REQUEST["formato"] && @$_REQUEST["valor"]){
include_once("../../db.php");
$fecha="SELECT DATE_FORMAT('".$_REQUEST["valor"]."','".$_REQUEST["formato"]."') AS fecha";
$dato=ejecuta_filtro_tabla($fecha);
if($dato[0][0]!="")
  echo(1);
else echo(0);  
}
?>
