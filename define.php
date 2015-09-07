<?php
define("ewAllowAdd", 1, true);
define("ewAllowDelete", 2, true);
define("ewAllowEdit", 4, true);
define("ewAllowView", 8, true);
define("ewAllowList", 8, true);
define("ewAllowReport", 8, true);
define("ewAllowSearch",8, true);
define("ewAllowAdmin", 16, true);
if(!defined("HOST"))	
  define("HOST", "saia-aguas.ct00qljbq3lp.us-east-1.rds.amazonaws.com");
if(!defined("USER"))
  define("USER", "saia");
if(!defined("PASS"))
  define("PASS", "cerok_saia421_5"); 
if(!defined("DB"))
  define("DB", "saia_release1");//INSTANCIA
define("MOTOR","MySql");
if(!defined("BASEDATOS"))
  define("BASEDATOS","saia_release1");//BASE DE DATOS
if(!defined("TABLESPACE"))
  define("TABLESPACE","saia_release1");//TABLESPACE
if(!defined("PORT"))
  define("PORT", 3306);
$acceso=explode(".",$_SERVER["REMOTE_ADDR"]);
//print_r($acceso);
if($acceso[0]==192 || $acceso[0]==172){
  $ruta="75.101.166.85";
}
else{
  $ruta="75.101.166.85";
}
if(!defined("RUTA_PDF")){
  define("RUTA_PDF", $ruta."/saia_release1/saia");
}
if(!defined("RUTA_PDF_LOCAL")){
  define("RUTA_PDF_LOCAL", "75.101.166.85/saia_release1/saia");
}
if(!defined("PERMISOS_CARPETAS"))
  define("PERMISOS_CARPETAS",0777);
if(!defined("PERMISOS_ARCHIVOS"))
  define("PERMISOS_ARCHIVOS",0777);
define("DEBUGEAR",1);
//ini_set(magic_quotes_gpc,0);
ini_set("memory_limit","400M");
//ini_set('default_charset','utf8'); DESCOMENTAR CUANDO SE TENGAN PROBLEMA DE CARACTERES ESPECIALES
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_WARNING);  
ini_set("display_errors",false);
ini_set("safe_mode",false);
/**************Soluciona limite de texto a mostrar con BD SQL SERVER*************/
/*ini_set ( 'mssql.textlimit' , '65536' );
ini_set ( 'mssql.textsize' , '65536' );*/

define("RUTA_SCRIPT","saia_release1");
date_default_timezone_set ("America/Bogota");
define("RUTA_DISCO","..");  
define("SO","linux");
define("CARPETA_SAIA","saia_release1");
define("LLAVE_SAIA_CRYPTO","cerok_saia421_5");

define("RUTA_ARCHIVOS","../almacenamiento/");
define("RUTA_PDFS","../almacenamiento/");
define("RUTA_IMAGENES","../almacenamiento/");
define("RUTA_QR","../almacenamiento/");
define("RUTA_INFO_QR","http://75.101.166.85/info_doc.php");

define("RUTA_BACKUP","../backup/");
define("RUTA_BACKUP_ELIMINADOS",RUTA_BACKUP."eliminados/");

define("LLAVE_SAIA","SAIA_PRODUCTIVO_RELEASE");

if(@$_SERVER["HTTPS"]=='on'){
	define("PROTOCOLO_CONEXION","https://");//Sitio seguro
}  
else{
	define("PROTOCOLO_CONEXION","http://");
}
?>