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



$sql="INSERT INTO documento_verificacion(documento_iddocumento,funcionario_idfuncionario,fecha,ruta_qr,verificacion,codigo_hash) VALUES (555,1,'2016-10-13 15:43:18','../almacenamiento/APROBADO/2016-10-13/555/qr/qr2016_10_13_15_10_18.jpg','vacio','d83d5459')";

phpmkr_query($sql);
?>
