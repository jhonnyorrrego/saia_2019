<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."assets/librerias.php");

$idft=$_REQUEST['idft'];
$tabla=$_REQUEST['tabla'];

		$delete="delete from ".$tabla." where id".$tabla."=".$idft;
		phpmkr_query($delete);
