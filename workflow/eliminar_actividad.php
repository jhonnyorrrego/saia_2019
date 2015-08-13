<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
global $conn;
$idactividad = $_REQUEST["idactividad"];

if($idactividad > 0){
	$sql = "UPDATE paso_actividad SET estado='0' WHERE idpaso_actividad=".$idactividad;
	phpmkr_query($sql);
	
}
?>