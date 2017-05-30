<?php
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
  define("HOST", "192.168.101.82");
}
if(!defined("USER"))
  define("USER", "saia");
if(!defined("PASS"))
  define("PASS", "cerok_saia421_5");
if(!defined("DB"))
  define("DB", "xe");//INSTANCIA
define("MOTOR","Oracle");
if(!defined("BASEDATOS"))
  define("BASEDATOS","xe");//BASE DE DATOS
if(!defined("TABLESPACE"))
  define("TABLESPACE","xe");//TABLESPACE
if(!defined("PORT")) {
  //define("PORT", 3306);
  //amazon cloud
  define("PORT", 1521);
}
$acceso=explode(".",$_SERVER["REMOTE_ADDR"]);
//print_r($acceso);
if($acceso[0]==192 || $acceso[0]==172){
  $ruta="saia-release.netsaia.com";
}
else{
  $ruta="saia-release.netsaia.com";
}
if(!defined("RUTA_PDF")){
  define("RUTA_PDF", $ruta."/saia_release1/saia");
}
if(!defined("RUTA_PDF_LOCAL")){
  define("RUTA_PDF_LOCAL", "saia-release.netsaia.com/saia_release1/saia");
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
ini_set('pcre.backtrack_limit','200000');

define("RUTA_SCRIPT","saia_release1");
date_default_timezone_set ("America/Bogota");
define("RUTA_DISCO","..");
define("SO","linux");
define("CARPETA_SAIA","saia_release1");
define("LLAVE_SAIA_CRYPTO","cerok_saia421_5");
define("RUTA_VERSIONES","../almacenamiento/VERSIONES/");
define("RUTA_ARCHIVOS","../almacenamiento/");
define("RUTA_PDFS","../almacenamiento/");
define("RUTA_IMAGENES","../almacenamiento/");
define("RUTA_QR","../almacenamiento/");
define("RUTA_INFO_QR","http://saia-release.netsaia.com/saia_release1/info_doc.php");

define("RUTA_BACKUP","../almacenamiento/backup/");
define("RUTA_BACKUP_ELIMINADOS",RUTA_BACKUP."eliminados/");
define("RUTA_BACKUP_EVENTO",RUTA_BACKUP."evento/");
define("RUTA_BACKUP_SESION",RUTA_BACKUP."sesiones/");
define("RUTA_FOTOGRAFIA_FUNCIONARIO","../almacenamiento/configuracion/adicionales_funcionario/fotografia/");
define("RUTA_NOTICIA_IMAGENES","../almacenamiento/configuracion/noticia_imagenes/"); //Imagenes cargadas en las noticias que se visualizan en el login
define("RUTA_ARCHIVOS_BPMN","../almacenamiento/configuracion/archivos_bpmn/"); //Flujos saia
define("RUTA_CARRUSEL_IMAGENES","../almacenamiento/configuracion/imagenes_carrusel/"); //Carrusel saia
define("RUTA_TINY_IMAGENES","../almacenamiento/configuracion/imagenes_areatexto/"); //Imagenes cargadas a travez del tiny
define("RUTA_EVENTO_FORMATO","../almacenamiento/configuracion/evento_formato/");
define("RUTA_LOGO_SAIA","../almacenamiento/configuracion/logo_saia/");
define("RUTA_ANEXOS_TAREAS","../almacenamiento/anexos_tareas/");

define("LLAVE_SAIA","SAIA_RELEASE1");
/*EVITA PROBLEMA DE CODIFICACION DE LOS FORMATOS, SE HABILITA O DESHABILITA SEGUN SE PRESENTE EL ERROR*/
define("CODIFICA_ENCABEZADO", false);
if(@$_SERVER["HTTPS"]=='on'){
	define("PROTOCOLO_CONEXION","https://");//Sitio seguro
} else {
	define("PROTOCOLO_CONEXION","http://");
}

/*CONFIGURAR EL CORREO ELECTRONICO PARA ROUNDCUBE*/
if(!defined("SERVIDOR_CORREO_SALIDA"))
  define("SERVIDOR_CORREO_SALIDA","ssl://smtp.gmail.com");
if(!defined("SERVIDOR_CORREO_IMAP"))
  define("SERVIDOR_CORREO_IMAP","ssl://imap.gmail.com");
if(!defined("PUERTO_SERVIDOR_CORREO"))
  define("PUERTO_SERVIDOR_CORREO",993);
if(!defined("PUERTO_CORREO_SALIDA"))
  define("PUERTO_CORREO_SALIDA",465);
if(!defined("LLAVE_SAIA_EDITOR")){
    define("LLAVE_SAIA_EDITOR", "SAIA_EDITOR");
}

//indica si los archivos se guardan remotamente. Si es un recurso en red, esto debe ser false. Se trata como local
//define("REMOTE_STORAGE", false);
//define("STORAGE_TYPE", "LOCAL");
//define("STORAGE_TYPE", "NETWORK");
?>
