<?php
include_once("define.php");
/*$dominio_servidor="190.145.1.221";
$usuario_ftp="ftpuser";
$clave_ftp="sigma2011**";
$ruta_origen_datos="../saia/imagenes";  //debe ser una ruta relativa.      
$ruta_destino_datos="sigma2/saia_core"; //ruta desde la raiz del ftp.
$borrar_origen=0;   */
$conn_id = ftp_connect($dominio_servidor); 
$login_result = ftp_login($conn_id, $usuario_ftp, $clave_ftp);
if ((!$conn_id) || (!$login_result)) {  
    echo "¡La conexion FTP ha fallado!<br />";
    echo "datos de conexion usuario:$usuario_ftp clave:$clave_ftp servidor:$dominio_servidor"; 
    exit; 
} else {
    echo "Conexion al sevidor realizada con exito, por el usuario ".$usuario_ftp."<br />";  
    copiar_archivos_carpeta($conn_id, $ruta_origen_datos, $ruta_destino_datos,$borrar_origen) ;
    ftp_close($conn_id);
}

//copiar lo que haya en la carpeta especificada  
function copiar_archivos_carpeta($conn_id,$origen,$destino,$borrar_origen=0)
{
if(is_dir($origen))
    {ftp_mkdir($conn_id, $destino);
     ftp_chmod($conn_id, PERMISOS_CARPETAS, $destino);
    }  
    if(!$dh = @opendir($origen))
    { 
        return;
    } 
    while (false !== ($obj = readdir($dh))) 
    { 
        if($obj == '.' || $obj == '..') 
        { 
            continue; 
        } 
        if(is_file($origen.'/'.$obj))
          {if(ftp_put($conn_id, $destino.'/'.$obj,$origen.'/'.$obj, FTP_BINARY))
             {ftp_chmod($conn_id, PERMISOS_ARCHIVOS, $destino.'/'.$obj);
              echo "copiado ".$origen . '/' . $obj."<br />";
              if($borrar_origen)
                unlink($origen . '/' . $obj);
             }
           else
             echo "error copiando ".$origen . '/' . $obj."<br />";    
          }
        else
         copiar_archivos_carpeta($conn_id,$origen.'/'.$obj, $destino.'/' . $obj,$borrar_origen); 
               
    } 
   closedir($dh);
   if($borrar_origen)
     @rmdir($origen);   
   return;
} 

?>