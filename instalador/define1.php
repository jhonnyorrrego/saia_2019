<?php
if(!defined("HOST"))	
define("HOST", "localhost");
if(!defined("USER"))
define("USER", "cerokcom");
if(!defined("PASS"))
define("PASS", "edison01");
if(!defined("DB"))
define("DB", "prueba");//INSTANCIA
define("MOTOR","MySql");
if(!defined("BASEDATOS"))
define("BASEDATOS","prueba");//BASE DE DATOS
if(!defined("TABLESPACE"))
define("TABLESPACE","prueba");//TABLESPACE
if(!defined("PORT"))
define("PORT", "3306");
if(!defined("RUTA_PDF"))
define("RUTA_PDF", "www.cerok.com/prueba/saia1.06");
define("DEBUGEAR",1);
ini_set(magic_quotes_gpc,0);
ini_set("memory_limit","400M");
ini_set("display_errors",false);
ini_set("safe_mode",false);
define("RUTA_SCRIPT","/prueba/saia1.06");
date_default_timezone_set ("America/Bogota");
define("RUTA_DISCO","..");  
define("SO","Linux");
define("CARPETA_SAIA","saia1.06");
?>
