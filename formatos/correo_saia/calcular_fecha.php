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
include_once($ruta_db_superior . "db.php");

$retorno['fecha_venc'] = strtotime ( "+".@$_REQUEST['dias']." days" , strtotime ( @$_REQUEST['fecha'] ) ) ;

$retorno['fecha_venc'] = date('Y-m-d', $retorno['fecha_venc']);

echo (json_encode($retorno));
?>