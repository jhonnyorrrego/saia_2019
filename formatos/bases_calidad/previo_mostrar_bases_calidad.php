<?php

print_r($_REQUEST);

if(@$_REQUEST['id']){
    
    $datos_documento=explode('-',$_REQUEST['id']);
    $idformato=$datos_documento[0];
    $idft=$datos_documento[1];
    $idft_bases_calidad=$datos_documento[2];
    $iddoc=$datos_documento[3];
    
    
    
    
}

die();
?>