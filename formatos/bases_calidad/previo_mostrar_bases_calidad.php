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
include_once($ruta_db_superior."librerias_saia.php");
echo(estilo_bootstrap());

if(@$_REQUEST['id']){
    
    $datos_documento=explode('-',$_REQUEST['id']);
    $idformato=$datos_documento[0];
    $idft=$datos_documento[1];
    $idft_bases_calidad=$datos_documento[2];
    $iddoc=$datos_documento[3];
    
    
    
    
}

die();
?>