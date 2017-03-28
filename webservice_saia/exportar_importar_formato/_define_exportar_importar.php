<?php 
/*
	ESTE ARCHIVO SE DEBE CREAR EN ESTE MISMO NIVEL CON EL NOMBRE define_exportar_importar.php
	
	- LOGIN_LOGIN = login que se usa para loguear los webservice
	- FUNCIONARIO_CODIGO_LOGIN = funcionario_codigo del login utilizado para loguear los webservice
	- PROTOCOLO_CONEXION = https o http
	- SERVIDOR_EXPORTAR = ruta del saia donde se va a extraer el formato  
	- SERVIDOR_MEDIO = ruta del saia que sirve como intermediario entre la exportacion y la importacion (se usa cuando no hay conexion directa entre origen y destino (exportar e importar))
	-  SERVIDOR_IMPORTAR = ruta del saia donde sera insertado el formato
*/
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

if(!defined("SERVIDOR_EXPORTAR")){
	define("SERVIDOR_EXPORTAR",PROTOCOLO_CONEXION.'52.205.58.68/saia_release1/saia/webservice_saia/exportar_importar_formato/exportar_formato/receptor_exportar.php');
}
if(!defined("SERVIDOR_MEDIO")){
	define("SERVIDOR_MEDIO",PROTOCOLO_CONEXION.'52.205.58.68/saia_release1/saia/webservice_saia/exportar_importar_formato/exportar_importar_medio/exportar_importar_medio.php');
}
if(!defined("SERVIDOR_IMPORTAR")){
	define("SERVIDOR_IMPORTAR",PROTOCOLO_CONEXION."sgddesarrollo.ucm.edu.co/saia/webservice_saia/exportar_importar_formato/webservice_saia/exportar_importar_formato/importar_formato/receptor_importar.php");
}
?>