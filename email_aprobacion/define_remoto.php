<?php
ini_set("display_errors",true);
if(!defined("SERVIDOR_REMOTO")){
	define("SERVIDOR_REMOTO",'http://52.205.58.68/saia_release1/saia/webservice_saia');
}


if(@$_SERVER["HTTPS"]=='on'){
	define("PROTOCOLO_CONEXION","https://");//Sitio seguro
}else{
	define("PROTOCOLO_CONEXION","http://");
}

if(!defined("RUTA_PDF_LOCAL")){
  define("RUTA_PDF_LOCAL", "52.205.58.68/saia_release1/saia");
}
?>

