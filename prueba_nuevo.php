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
$iddoc=20;
$fun_qr=1;
$imagen='ruta';
$sql="INSERT INTO documento_verificacion(documento_iddocumento,funcionario_idfuncionario,fecha,ruta_qr,verificacion,codigo_hash) VALUES (".$iddoc.",".$fun_qr.",".fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s').",'".$imagen."','vacio','".$codigo_hash."')";

phpmkr_query($sql);
?>
