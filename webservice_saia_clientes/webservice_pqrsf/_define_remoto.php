<?php
ini_set("display_errors",false);
if(@$_SERVER["HTTPS"]=='on'){
        define("PROTOCOLO_CONEXION","https://");//Sitio seguro
}else{
        define("PROTOCOLO_CONEXION","http://");
}

if(!defined("SERVIDOR_REMOTO"))
  define("SERVIDOR_REMOTO",PROTOCOLO_CONEXION.'52.205.58.68/saia_release1/saia/webservice_saia/pqr');
if(!defined("RUTA_PDF"))
  define("RUTA_PDF",PROTOCOLO_CONEXION.'52.205.58.68/saia_release1/saia/');
?>
