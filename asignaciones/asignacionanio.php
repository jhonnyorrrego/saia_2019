<?php
  /*
   * Este script recibe como parametro el a�o y el id de un documento para mostrar
   * las asiganciones de dicho a�o, tambien permite recibir la paginacion para mostrar 
   * las asignaciones de diferntes a�os 
   * proiedad : CEROK LTDA
   */
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
  header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
  header("Cache-Control: post-check=0, pre-check=0", false); 
  header("Pragma: no-cache"); // HTTP/1.0 


     
include_once("../db.php");


include ("../calendario/calendario.php");
if(isset($_REQUEST['anio']))
 $anio=$_REQUEST['anio'];
else 
{
	$fecha=getdate();
	$anio=$fecha["year"];
}   

$id_documento=$_REQUEST['key'];
$script = "asignacionlist.php"; // Ruta para usar en la paginacion, para no amarrar la funcion asignacion_anio a este script
if(isset($anio)&&isset($id_documento))
 {
 	calendario_asignaciones_anio($id_documento,$anio,$script,NULL,NULL);
	
 }
else 
 alerta("No se enviaron los parametros anio - identificador documento para efectuar la operaci&oacute;n",'error',5000); 
?>
