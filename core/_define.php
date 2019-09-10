<?php
date_default_timezone_set("America/Bogota");
ini_set("memory_limit", "400M");
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
ini_set("display_errors", true);
ini_set('pcre.backtrack_limit', '200000');
ini_set('pcre.recursion_limit', '200000');

define("HOST", "localhost");
define("USER", "root");
define("PASS", "Cerok_saia421_5");
define("DB", "saia");
define("MOTOR", "MySql"); //MySql-Oracle-SqlServer
define("PORT", 3306);
define("SO", "linux");
define("CONTENEDOR_SAIA", "saia_2019");
define("LLAVE_SAIA_CRYPTO", "cerok_saia421_5");
define("RUTA_SAIA", CONTENEDOR_SAIA . "/saia");
define("RUTA_DISCO", "..");
define("RUTA_ABS_SAIA", __DIR__ . "/../");

if (isset($_SERVER["REMOTE_ADDR"])) {
    $acceso = explode(".", $_SERVER["REMOTE_ADDR"]);
    if ($acceso[0] == 192 || $acceso[0] == 172) {
        $ruta = "localhost";
    } else {
        $ruta = "localhost";
    }
} else {
    $ruta = "localhost";
}

define("RUTA_PDF", $ruta . "/" . RUTA_SAIA);
define("RUTA_PDF_LOCAL", "localhost/" . RUTA_SAIA);
define("PERMISOS_CARPETAS", 0777);
define("PERMISOS_ARCHIVOS", 0777);

if ($_SERVER["HTTPS"] == 'on') {
    define("PROTOCOLO_CONEXION", "https://");
} else {
    define("PROTOCOLO_CONEXION", "http://");
}

define("RUTA_INFO_QR", PROTOCOLO_CONEXION . $ruta . "/" . RUTA_SAIA . "/webservice_saia_clientes/info_qr_cliente/");

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
define("RUTA_ANEXOS_TAREAS", RUTA_ARCHIVOS . "tareas/");
define("RUTA_MANUAL", RUTA_CONFIGURACION . "manual/");
define("RUTA_PLANTILLA_WORD", RUTA_CONFIGURACION . "plantilla_word/");
define("RUTA_NOTICIA_IMAGENES", RUTA_CONFIGURACION . "noticia_imagenes/");
//Imagenes cargadas en las noticias que se visualizan en el login
define("RUTA_LOGO_SAIA", RUTA_CONFIGURACION . "logo_saia/");
define("RUTA_CARRUSEL_IMAGENES", RUTA_CONFIGURACION . "imagenes_carrusel/");
define("LLAVE_SAIA", "SAIA_DEV");

/*CONFIGURAR EL CORREO ELECTRONICO PARA ROUNDCUBE*/
define("SERVIDOR_CORREO_SALIDA", "ssl://smtp.gmail.com");
define("SERVIDOR_CORREO_IMAP", "ssl://imap.gmail.com");
define("PUERTO_SERVIDOR_CORREO", 993);
define("PUERTO_CORREO_SALIDA", 465);