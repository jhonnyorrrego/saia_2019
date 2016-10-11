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
ini_set("display_errors",true);

$cadena='

<div class="link kenlace_saia pull-left" enlace="ordenar.php?key=492&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="Documento No.44" onclick=" "><b>44-Cero K LTDA-Comunicaciones Oficiales</b></div>
';


$cadena2=preg_replace("class=[\"\'][^\"\']+[\"\']","",$cadena);
        //preg_replace("([0-9]+)", "2000", $copy_date);

print_r($cadena2);
echo('<---- qui');

?>
