<?php
date_default_timezone_set("America/Bogota");
/*define("ewAllowAdd", 1, true);
define("ewAllowDelete", 2, true);
define("ewAllowEdit", 4, true);
define("ewAllowView", 8, true);
define("ewAllowList", 8, true);
define("ewAllowReport", 8, true);
define("ewAllowSearch", 8, true);
define("ewAllowAdmin", 16, true);*/
if (!defined("HOST")) {
	define("HOST", "localhost");
}
if (!defined("USER")) {
	define("USER", "saia");
}
if (!defined("PASS")) {
	define("PASS", "cerok_saia");
}
if (!defined("DB")) {
	define("DB", "saia_ig");
	//INSTANCIA
}
define("MOTOR", "MySql");
if (!defined("BASEDATOS")) {
	define("BASEDATOS", "saia_ig");
	//BASE DE DATOS
}
if (!defined("TABLESPACE")) {
	define("TABLESPACE", "saia_ig");
	//TABLESPACE
}
if (!defined("PORT")) {
	define("PORT", 3306);
}

define("SO", "linux");
define("RUTA_SAIA", "saia_ig/saia");
define("CARPETA_SAIA", "saia_ig");
define("RUTA_SCRIPT", "saia_ig");
define("RUTA_DISCO", "..");
define("LLAVE_SAIA_CRYPTO", "cerok_saia421_5");

$acceso = explode(".", $_SERVER["REMOTE_ADDR"]);
if ($acceso[0] == 192 || $acceso[0] == 172) {
	$ruta = "ig.netsaia.loc:82";
} else {
	$ruta = "ig.netsaia.loc:82";
}
//$_SERVER["DOCUMENT_ROOT"] no esta disponible como cgi. Usar la ruta del define.php
define("RUTA_ABS_SAIA", __DIR__ . "/");
if (!defined("RUTA_PDF")) {
	define("RUTA_PDF", $ruta . "/" . RUTA_SAIA);
}
if (!defined("RUTA_PDF_LOCAL")) {
	define("RUTA_PDF_LOCAL", "ig.netsaia.loc:82/" . RUTA_SAIA);
}
if (!defined("PERMISOS_CARPETAS")) {
	define("PERMISOS_CARPETAS", 0777);
}
if (!defined("PERMISOS_ARCHIVOS")) {
	define("PERMISOS_ARCHIVOS", 0777);
}
define("DEBUGEAR", 0);
define("DEBUGEAR_FLUJOS", 0);
//ini_set(magic_quotes_gpc,0);
ini_set("memory_limit", "400M");
//ini_set('default_charset','utf8'); DESCOMENTAR CUANDO SE TENGAN PROBLEMA DE CARACTERES ESPECIALES
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
//Por defecto 100000
ini_set('pcre.recursion_limit', '200000');
if (@$_SERVER["HTTPS"] == 'on') {
	define("PROTOCOLO_CONEXION", "https://"); //Sitio seguro
} else {
	define("PROTOCOLO_CONEXION", "http://");
}

define("RUTA_INFO_QR", PROTOCOLO_CONEXION . "ig.netsaia.loc:82/" . RUTA_SAIA . "/webservice_saia_clientes/info_qr_cliente/");

define("TIPO_ALM", "local://../");
define("RUTA_ARCHIVOS", TIPO_ALM . "almacenamiento/");
define("RUTA_PDFS", TIPO_ALM . "almacenamiento/");
define("RUTA_IMAGENES", TIPO_ALM . "almacenamiento/");
define("RUTA_QR", TIPO_ALM . "almacenamiento/");
define("RUTA_VERSIONES", TIPO_ALM . "almacenamiento/VERSIONES/");
define("RUTA_HISTORIAL_IMPRESION", TIPO_ALM . "almacenamiento/HISTORIAL_IMPRESION/");

define("RUTA_BACKUP", TIPO_ALM . "almacenamiento/backup/");
define("RUTA_BACKUP_ELIMINADOS", RUTA_BACKUP . "eliminados/");
define("RUTA_BACKUP_EVENTO", RUTA_BACKUP . "evento/");
define("RUTA_BACKUP_SESION", RUTA_BACKUP . "sesiones/");

define("RUTA_CONFIGURACION", TIPO_ALM . "almacenamiento/configuracion/");
define("RUTA_PLANOS", RUTA_CONFIGURACION . "planos/");
define("RUTA_EVENTO_FORMATO", RUTA_CONFIGURACION . "evento_formato/");
define("RUTA_ARCHIVOS_BPMN", RUTA_CONFIGURACION . "archivos_bpmn/");
define("RUTA_ANEXOS_TAREAS", RUTA_CONFIGURACION . "anexos_tareas/");
define("RUTA_MANUAL", RUTA_CONFIGURACION . "manual/");
define("RUTA_PLANTILLA_WORD", RUTA_CONFIGURACION . "plantilla_word/");
define("RUTA_FOTOGRAFIA_FUNCIONARIO", RUTA_CONFIGURACION . "adicionales_funcionario/fotografia/");
define("RUTA_NOTICIA_IMAGENES", RUTA_CONFIGURACION . "noticia_imagenes/"); //Imagenes cargadas en las noticias que se visualizan en el login
define("RUTA_LOGO_SAIA", RUTA_CONFIGURACION . "logo_saia/"); //No es posible modificar la carga de imagenes del tiny. Se usa la ruta local
define("RUTA_TINY_IMAGENES", RUTA_CONFIGURACION . "imagenes_areatexto/"); //Imagenes cargadas a travez del tiny
define("RUTA_CARRUSEL_IMAGENES", RUTA_CONFIGURACION . "imagenes_carrusel/"); //Carrusel saia

define("LLAVE_SAIA", "SAIA_IG");
/*EVITA PROBLEMA DE CODIFICACION DE LOS FORMATOS, SE HABILITA O DESHABILITA SEGUN SE PRESENTE EL ERROR*/
define("CODIFICA_ENCABEZADO", false);

define("FORMATOS_CLIENTE", "formatos/");
define("FORMATOS_SAIA", "formatos/");

if (!defined("TESTING")) {
	define("TESTING", true);
}

/*CONFIGURAR EL CORREO ELECTRONICO PARA ROUNDCUBE*/
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
?>
