<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once $ruta_db_superior . 'core/autoload.php';
include_once $ruta_db_superior . 'librerias_saia.php';
$retorno="";
if(@$_REQUEST["librerias"]){
  $librerias=array_unique(explode(";",$_REQUEST["librerias"]));
  array_walk($librerias,"incluir_librerias_ajax");
}    
function incluir_librerias_ajax($elemento,$indice){
  global $ruta_db_superior;
  include_once($ruta_db_superior.$elemento);
}
if(@$_REQUEST["funcion"]){
    $retorno=call_user_func_array ( $_REQUEST["funcion"], explode(";",@$_REQUEST["parametros"]));
}
if($retorno){
    echo json_encode($retorno);
}
?>