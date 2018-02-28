<<<<<<< HEAD
<?
=======
<?php
die();
define("ewAllowAdd", 1, true);
define("ewAllowDelete", 2, true);
define("ewAllowEdit", 4, true);
define("ewAllowView", 8, true);
define("ewAllowList", 8, true);
define("ewAllowReport", 8, true);
define("ewAllowSearch",8, true);
define("ewAllowAdmin", 16, true);
if(!defined("HOST")) {
	//google cloud
  //define("HOST", "35.185.11.75");
  //amazon cloud
  //define("HOST", "54.84.23.212");
  define("HOST", "{{dbhost}}");
}
if(!defined("USER"))
  define("USER", "{{dbuser}}");
if(!defined("PASS"))
  define("PASS", "{{dbpass}}");
if(!defined("DB"))
  define("DB", "{{dbname}}");//INSTANCIA
define("MOTOR","{{dbengine}}");
if(!defined("BASEDATOS"))
  define("BASEDATOS","{{dbschema}}");//ESQUEMA
if(!defined("TABLESPACE"))
  define("TABLESPACE","{{tablespace}}");//TABLESPACE
if(!defined("PORT")) {
    define("PORT", "{{dbport}}");
  //amazon cloud
  //define("PORT", 3308);
}
$acceso=explode(".",$_SERVER["REMOTE_ADDR"]);
//print_r($acceso);
if($acceso[0]==192 || $acceso[0]==172){
  $ruta="saia-release.netsaia.com:82";
}
else{
  $ruta="saia-release.netsaia.com:82";
}
if(!defined("RUTA_PDF")){
  define("RUTA_PDF", $ruta."/saia_release1/saia");
}
if(!defined("RUTA_PDF_LOCAL")){
  define("RUTA_PDF_LOCAL", "saia-release.netsaia.com:82/saia_release1/saia");
}
if(!defined("PERMISOS_CARPETAS"))
  define("PERMISOS_CARPETAS",0777);
if(!defined("PERMISOS_ARCHIVOS"))
  define("PERMISOS_ARCHIVOS",0777);
define("DEBUGEAR",1);
define("DEBUGEAR_FLUJOS",0);
//ini_set(magic_quotes_gpc,0);
ini_set("memory_limit","400M");
//ini_set('default_charset','utf8'); DESCOMENTAR CUANDO SE TENGAN PROBLEMA DE CARACTERES ESPECIALES
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
ini_set("display_errors",true);
ini_set("safe_mode",false);
/**************Soluciona limite de texto a mostrar con BD SQL SERVER*************/
/*ini_set ( 'mssql.textlimit' , '65536' );
ini_set ( 'mssql.textsize' , '65536' );*/
//Solucion error pcre con cadenas grandes devuelve array vacio
//100000  para PHP < 5.3.7
//1000000 para PHP >= 5.3.7
ini_set('pcre.backtrack_limit','200000');
//Por defecto 100000
ini_set('pcre.recursion_limit = 200000');
if(@$_SERVER["HTTPS"]=='on'){
	define("PROTOCOLO_CONEXION","https://");//Sitio seguro
} else {
	define("PROTOCOLO_CONEXION","http://");
}
>>>>>>> origin/saia_redir


