<?php
$max_salida = 10;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta;
    //Preserva la ruta superior encontrada
  }
  $ruta .= "../";
  $max_salida--;
}               
include_once ($ruta_db_superior."db.php");
include_once ($ruta_db_superior."phpqrcode/qrlib.php");
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';    
    //ofcourse we need rights to create temp dir
    $errorCorrectionLevel = 'Q';
    //crear_destino($PNG_TEMP_DIR);
    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];    
    $matrixPointSize = 3;
    if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);         
    if (isset($_REQUEST['dato'])) { 
        //it's very important!
        if (trim($_REQUEST['dato']) == '')
            $error=1;
        // user data
        $ruta=busca_filtro_tabla("","configuracion","nombre ='ruta_codigos_qr'","");
        
        //$filename = $ruta_db_superior.$ruta[0]["valor"]."/".$_REQUEST["ruta"].'.png';
        $filename = $ruta_db_superior.$ruta[0]["valor"];
        crear_destino($filename);
        $filename .= "/".$_REQUEST["ruta"].'.png';
        if(file_exists($filename)){
          chmod("777",$filename);
          unlink($filename);
        }
        QRcode::png($_REQUEST['dato'], $filename, $errorCorrectionLevel, $matrixPointSize, 0);    
        
    } else {    
      $error=2;
    }    
    //parametros dato=cadena a convertir;     
    // benchmark
    //QRtools::timeBenchmark();    

    