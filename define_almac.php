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
  define("HOST", "saia-laboratorio.ct00qljbq3lp.us-east-1.rds.amazonaws.com");
}
if(!defined("USER"))
  define("USER", "saia");
if(!defined("PASS"))
  define("PASS", "cerok_saia421_5");
if(!defined("DB"))
  define("DB", "saia_test_almac");//INSTANCIA
define("MOTOR","MySql");
if(!defined("BASEDATOS"))
  define("BASEDATOS","saia_test_almac");//BASE DE DATOS
if(!defined("TABLESPACE"))
  define("TABLESPACE","saia_test_almac");//TABLESPACE
if(!defined("PORT"))
  define("PORT", 3306);
$acceso=explode(".",$_SERVER["REMOTE_ADDR"]);
//print_r($acceso);
if($acceso[0]==192 || $acceso[0]==172){
  $ruta="52.205.58.68";
} else {
  $ruta="52.205.58.68";
}
if(!defined("RUTA_PDF")){
  define("RUTA_PDF", $ruta."/saia_almac/saia");
}
if(!defined("RUTA_PDF_LOCAL")){
  define("RUTA_PDF_LOCAL", "52.205.58.68/saia_almac/saia");
}
if(!defined("PERMISOS_CARPETAS"))
  define("PERMISOS_CARPETAS",0777);
if(!defined("PERMISOS_ARCHIVOS"))
  define("PERMISOS_ARCHIVOS",0777);
define("DEBUGEAR",0);
define("DEBUGEAR_FLUJOS",0);
//ini_set(magic_quotes_gpc,0);
ini_set("memory_limit","400M");
//ini_set('default_charset','utf8'); DESCOMENTAR CUANDO SE TENGAN PROBLEMA DE CARACTERES ESPECIALES
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
ini_set("display_errors",false);
ini_set("safe_mode",false);
/**************Soluciona limite de texto a mostrar con BD SQL SERVER*************/
/*ini_set ( 'mssql.textlimit' , '65536' );
ini_set ( 'mssql.textsize' , '65536' );*/
//Solucion error pcre con cadenas grandes devuelve array vacio
ini_set('pcre.backtrack_limit','200000');

define("RUTA_SCRIPT","saia_almac");
date_default_timezone_set ("America/Bogota");
define("RUTA_DISCO","..");
define("SO","linux");
define("CARPETA_SAIA","saia_almac");
define("LLAVE_SAIA_CRYPTO","cerok_saia421_5");
define("RUTA_VERSIONES","local://../almacenamiento/VERSIONES/");
define("RUTA_ARCHIVOS","local://../almacenamiento/");
define("RUTA_PDFS","local://../almacenamiento/");
define("RUTA_IMAGENES","local://../almacenamiento/");
define("RUTA_QR","local://../almacenamiento/");
define("RUTA_INFO_QR","http://52.205.58.68/saia_almac/info_doc.php"); //codigo qr

define("RUTA_BACKUP","local://../almacenamiento/backup/");
define("RUTA_BACKUP_ELIMINADOS",RUTA_BACKUP."eliminados/");
define("RUTA_BACKUP_EVENTO",RUTA_BACKUP."evento/");
define("RUTA_BACKUP_SESION",RUTA_BACKUP."sesiones/");

/* NO SE TIENE EN CUENTA EN EL NUEVO ESQUEMA DE ALMACENAMIENTO*/
define("RUTA_EVENTO_FORMATO","../almacenamiento/configuracion/evento_formato/");

/* NUEVA CONSTANTE PARA CONFIGURACION */
define("RUTA_CONFIGURACION","local://../almacenamiento/configuracion/");

/* CONSTANTES QUE DEPENDEN DE LA CONSTANTE "RUTA_CONFIGURACION" */

define("RUTA_ARCHIVOS_BPMN","local://../almacenamiento/configuracion/archivos_bpmn/"); //Flujos saia

/* CONSTANTES QUE DEPENDEN DE LA CONSTANTE "RUTA_ARCHIVOS" */

define("RUTA_ANEXOS_TAREAS","anexos_tareas/");

/* CONSTANTES QUE DEPENDEN DE LA CONSTANTE "RUTA_IMAGENES" */	

define("RUTA_FOTOGRAFIA_FUNCIONARIO","configuracion/adicionales_funcionario/fotografia/");
define("RUTA_NOTICIA_IMAGENES","configuracion/noticia_imagenes/"); //Imagenes cargadas en las noticias que se visualizan en el login
define("RUTA_LOGO_SAIA","configuracion/logo_saia/");
//No es posible modificar la carga de imagenes del tiny. Se usa la ruta local
define("RUTA_TINY_IMAGENES","../almacenamiento/configuracion/imagenes_areatexto/"); //Imagenes cargadas a travez del tiny 
define("RUTA_CARRUSEL_IMAGENES","configuracion/imagenes_carrusel/"); //Carrusel saia

define("LLAVE_SAIA","SAIA_ALMACENAMIENTO");
/*EVITA PROBLEMA DE CODIFICACION DE LOS FORMATOS, SE HABILITA O DESHABILITA SEGUN SE PRESENTE EL ERROR*/
define("CODIFICA_ENCABEZADO", false);
if(@$_SERVER["HTTPS"]=='on'){
        define("PROTOCOLO_CONEXION","https://");//Sitio seguro
}else{
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
?>
