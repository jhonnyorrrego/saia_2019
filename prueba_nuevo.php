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
include($ruta_db_superior.'formatos/librerias/funciones_generales.php');


$valor_campo_ruta=mostrar_valor_campo('arbol_funs',218,232,1);
echo($datos_formato_ruta.'<--- FIN'); die();



?>