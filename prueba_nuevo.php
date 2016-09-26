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


$_REQUEST['no_redirecciona']=1;
$_REQUEST['iddocumento']=370;
$_REQUEST['tipo_versionamiento']=1;
$_REQUEST['version_numero']=0;
$_REQUEST['iddocumento_anexo']=369;
$_REQUEST['funcionario_codigo']=1;

$datos_documento = obtener_datos_documento(365);


crear_pdf_documento_tcpdf($datos_documento);

print_r($datos_documento);






?>