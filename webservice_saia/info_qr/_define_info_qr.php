<?php 
if(!defined("LOGIN_LOGIN")){
	define("LOGIN_LOGIN",'radicador_web');
}
if(!defined("FUNCIONARIO_CODIGO_LOGIN")){
	define("FUNCIONARIO_CODIGO_LOGIN",'111222333');
}

if(!defined("PROTOCOLO_CONEXION")){
	if(@$_SERVER["HTTPS"]=='on'){
		define("PROTOCOLO_CONEXION","https://");//Sitio seguro
	}else{
		define("PROTOCOLO_CONEXION","http://");
	}
}

if(!defined("SERVIDOR_INFO_QR")){
	define("SERVIDOR_INFO_QR",PROTOCOLO_CONEXION.'52.205.58.68/saia_release1/saia/webservice_saia/info_qr/receptor_info_qr.php');
}

?>