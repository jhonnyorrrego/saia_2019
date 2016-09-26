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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

$datos_documento=array();
$datos_documento['iddocumento']=365;
/*$datos_documento["plantilla"]=;
$datos_documento["numero"]=;
$datos_documento["fecha"]=;*/
crear_pdf_documento_tcpdf($datos_documento, $datos_ejecutor = null);




?>