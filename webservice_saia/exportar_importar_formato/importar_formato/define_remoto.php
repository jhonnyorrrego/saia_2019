<?php
if(@$_SERVER["HTTPS"]=='on'){
	define("PROTOCOLO_CONEXION","https://");//Sitio seguro
}else{
	define("PROTOCOLO_CONEXION","http://");
}

if(!defined("SERVIDOR_IMPORTAR")){
	define("SERVIDOR_IMPORTAR",PROTOCOLO_CONEXION.'75.101.166.85/saia_release1/saia/webservice_saia/exportar_importar_formato/importar_formato/');
}

?> 