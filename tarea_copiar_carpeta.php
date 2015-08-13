<?php
include_once("define.php");
copiar_archivos_carpeta("../saia1.06","../../camara_nuevo/saia1.06");
//copiar lo que haya en la carpeta especificada  
function copiar_archivos_carpeta($origen,$destino)
{ if(!is_dir($destino))
    {mkdir($destino);
     chmod($destino,PERMISOS_CARPETAS);
    }  
    if(!$dh = @opendir($origen))
    { 
        return;
    } 
    while (false !== ($obj = readdir($dh))) 
    { //echo $origen . '/' . $obj."<br />";
        if($obj == '.' || $obj == '..') 
        { 
            continue; 
        } 
 
       if (!@copy($origen . '/' . $obj,$destino. '/' . $obj))
         {copiar_archivos_carpeta($origen.'/'.$obj, $destino.'/' . $obj); 
         }
        else
         echo "copiado ".$origen . '/' . $obj."<br />";       
    } 

    closedir($dh);   
    return;
} 

?>