<?php
include_once("funciones_archivo.php");
// Se mantien este archivo por futura funcionalidad que incluira previsualizacion

if (isset($_REQUEST["accion"])) {
	$idanexo = $_REQUEST["accion"];
	switch ($_REQUEST["accion"]) {
  case "descargar":
	$idanexo=$_REQUEST["idanexo"];
	descargar_archivo($idanexo);
	exit();
  break;
  }
} 

?>
