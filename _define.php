<?php
die();
define("ewAllowAdd", 1, true);
define("ewAllowDelete", 2, true);
define("ewAllowEdit", 4, true);
define("ewAllowView", 8, true);
define("ewAllowList", 8, true);
define("ewAllowReport", 8, true);
define("ewAllowSearch", 8, true);
define("ewAllowAdmin", 16, true);
if (!defined("HOST")) {
    define("HOST", "{{dbhost}}");
}
if (!defined("USER")) {
    define("USER", "{{dbuser}}");
}
if (!defined("PASS")) {
    define("PASS", "{{dbpass}}");
}
if (!defined("DB")) {
    define("DB", "{{dbname}}"); // INSTANCIA
}
define("MOTOR", "{{dbengine}}");
if (!defined("BASEDATOS")) {
    define("BASEDATOS", "{{dbschema}}"); // ESQUEMA
}
if (!defined("TABLESPACE")) {
    define("TABLESPACE", "{{tablespace}}"); // TABLESPACE
}
if (!defined("PORT")) {
    define("PORT", "{{dbport}}");
}
$acceso = explode(".", $_SERVER["REMOTE_ADDR"]);
if ($acceso[0] == 192 || $acceso[0] == 172) {
    $ruta = "{{urlsaia}}";
} else {
    $ruta = "{{urlsaia}}";
}
define("RUTA_SAIA", "{{carpetasaia}}/saia/");
//$_SERVER["DOCUMENT_ROOT"] no esta disponible como cgi. Usar la ruta del define.php
define("RUTA_ABS_SAIA", __DIR__  . "/");
if (!defined("RUTA_PDF")) {
    define("RUTA_PDF", $ruta . "/{{carpetasaia}}/saia");
}
if (!defined("RUTA_PDF_LOCAL")) {
    define("RUTA_PDF_LOCAL", "{{urlsaia}}/{{carpetasaia}}/saia");
}
if (!defined("PERMISOS_CARPETAS")) {
    define("PERMISOS_CARPETAS", 0777);
}
if (!defined("PERMISOS_ARCHIVOS")) {
    define("PERMISOS_ARCHIVOS", 0777);
}
define("DEBUGEAR", 1);
define("DEBUGEAR_FLUJOS", 0);
// ini_set(magic_quotes_gpc,0);
ini_set("memory_limit", "400M");
// ini_set('default_charset','utf8'); DESCOMENTAR CUANDO SE TENGAN PROBLEMA DE CARACTERES ESPECIALES
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
ini_set("display_errors", true);
ini_set("safe_mode", false);
/**************Soluciona limite de texto a mostrar con BD SQL SERVER*************/
/*ini_set ( 'mssql.textlimit' , '65536' );
ini_set ( 'mssql.textsize' , '65536' );*/
//Solucion error pcre con cadenas grandes devuelve array vacio
//100000  para PHP < 5.3.7
//1000000 para PHP >= 5.3.7
ini_set('pcre.backtrack_limit', '200000');
// Por defecto 100000
ini_set('pcre.recursion_limit = 200000');
if (@$_SERVER["HTTPS"] == 'on') {
    define("PROTOCOLO_CONEXION", "https://"); // Sitio seguro
} else {
    define("PROTOCOLO_CONEXION", "http://");
}

define("RUTA_SCRIPT", "{{carpetasaia}}");
date_default_timezone_set("America/Bogota");
define("RUTA_DISCO", "..");
define("SO", "linux");
define("CARPETA_SAIA", "{{carpetasaia}}");
define("LLAVE_SAIA_CRYPTO", "cerok_saia421_5");
define("RUTA_VERSIONES", "{{almacenamientosaia}}/VERSIONES/");
define("RUTA_ARCHIVOS", "{{almacenamientosaia}}/");
define("RUTA_PDFS", "{{almacenamientosaia}}/");
define("RUTA_IMAGENES", "{{almacenamientosaia}}/");
define("RUTA_QR", "{{almacenamientosaia}}/");
define("RUTA_INFO_QR", PROTOCOLO_CONEXION . "{{urlsaia}}/{{carpetasaia}}/info_doc.php");

define("RUTA_BACKUP", "{{almacenamientosaia}}/backup/");
define("RUTA_BACKUP_ELIMINADOS", RUTA_BACKUP . "eliminados/");
define("RUTA_BACKUP_EVENTO", RUTA_BACKUP . "evento/");
define("RUTA_BACKUP_SESION", RUTA_BACKUP . "sesiones/");

/* NO SE TIENE EN CUENTA EN EL NUEVO ESQUEMA DE ALMACENAMIENTO */
define("RUTA_EVENTO_FORMATO", "{{almacenamientosaia}}/configuracion/evento_formato/");

/* NUEVA CONSTANTE PARA CONFIGURACION */
define("RUTA_CONFIGURACION", "{{almacenamientosaia}}/configuracion/");

/* CONSTANTES QUE DEPENDEN DE LA CONSTANTE "RUTA_CONFIGURACION" */
define("RUTA_ARCHIVOS_BPMN", "{{almacenamientosaia}}/configuracion/archivos_bpmn/"); // Flujos saia

/* CONSTANTES QUE DEPENDEN DE LA CONSTANTE "RUTA_ARCHIVOS" */
//define("RUTA_ANEXOS_TAREAS", "anexos_tareas/");
define("RUTA_ANEXOS_TAREAS", "{{almacenamientosaia}}/anexos_tareas/");

/* CONSTANTES QUE DEPENDEN DE LA CONSTANTE "RUTA_IMAGENES" */
define("RUTA_FOTOGRAFIA_FUNCIONARIO", "{{almacenamientosaia}}/configuracion/adicionales_funcionario/fotografia/");
define("RUTA_NOTICIA_IMAGENES", "{{almacenamientosaia}}/configuracion/noticia_imagenes/"); // Imagenes cargadas en las noticias que se visualizan en el login
define("RUTA_LOGO_SAIA", "{{almacenamientosaia}}/configuracion/logo_saia/");
// No es posible modificar la carga de imagenes del tiny. Se usa la ruta local
define("RUTA_TINY_IMAGENES", "{{almacenamientosaia}}/configuracion/imagenes_areatexto/"); // Imagenes cargadas a travez del tiny
define("RUTA_CARRUSEL_IMAGENES", "{{almacenamientosaia}}/configuracion/imagenes_carrusel/"); // Carrusel saia


define("LLAVE_SAIA", "SAIA_RELEASE1");
/* EVITA PROBLEMA DE CODIFICACION DE LOS FORMATOS, SE HABILITA O DESHABILITA SEGUN SE PRESENTE EL ERROR */
define("CODIFICA_ENCABEZADO", false);

if (!defined("INDEXA_ELASTICSEARCH")) {
	define("INDEXA_ELASTICSEARCH",true);
}
/* CONFIGURAR EL CORREO ELECTRONICO PARA ROUNDCUBE */
if (!defined("SERVIDOR_CORREO_SALIDA")) {
    define("SERVIDOR_CORREO_SALIDA", "ssl://smtp.gmail.com");
}
if (!defined("SERVIDOR_CORREO_IMAP")) {
    define("SERVIDOR_CORREO_IMAP", "ssl://imap.gmail.com");
}
if (!defined("PUERTO_SERVIDOR_CORREO")) {
    define("PUERTO_SERVIDOR_CORREO", 993);
}
if (!defined("PUERTO_CORREO_SALIDA")) {
    define("PUERTO_CORREO_SALIDA", 465);
}
if (!defined("LLAVE_SAIA_EDITOR")) {
    define("LLAVE_SAIA_EDITOR", "SAIA_EDITOR");
}

// indica si los archivos se guardan remotamente. Si es un recurso en red, esto debe ser false. Se trata como local
// define("REMOTE_STORAGE", false);
// define("STORAGE_TYPE", "LOCAL");
// define("STORAGE_TYPE", "NETWORK");

define('FORMATOS_SAIA', 'formatos/');
define('FORMATOS_CLIENTE', 'formatos_cliente/');

define("RUTA_BACKUPS","s3://almacenamiento2");
define("KEY_AWS","AKIAJOOJ3XT673EOK6OQ");
define("SECRET_AWS","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");
define("REGION_AWS","us-east-1");

?>
