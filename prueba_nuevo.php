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
include($ruta_db_superior.'db.php');
include_once($ruta_db_superior."workflow/libreria_paso.php");

$idpaso=91;

print_r(listado_pasos_anteriores_admin($idpaso));




?>