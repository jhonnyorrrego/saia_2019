<?php
if(!defined("HOST"))	
define("HOST", "<*HOST*>");
if(!defined("USER"))
define("USER", "<*USER*>");
if(!defined("PASS"))
define("PASS", "<*PASS*>");
if(!defined("DB"))
define("DB", "<*DB*>");//INSTANCIA
define("MOTOR","<*MOTOR*>");
if(!defined("BASEDATOS"))
define("BASEDATOS","<*BASEDATOS*>");//BASE DE DATOS
if(!defined("TABLESPACE"))
define("TABLESPACE","<*TABLESPACE*>");//TABLESPACE
if(!defined("PORT"))
define("PORT", "<*PORT*>");
if(!defined("RUTA_PDF"))
define("RUTA_PDF", "<*RUTA_PDF*>");
define("DEBUGEAR",1);
ini_set(magic_quotes_gpc,0);
ini_set("memory_limit","400M");
ini_set("display_errors",false);
ini_set("safe_mode",false);
define("RUTA_SCRIPT","<*RUTA_SCRIPT*>");
date_default_timezone_set ("America/Bogota");
define("RUTA_DISCO","..");  
define("SO","<*SO*>");
define("CARPETA_SAIA","saia1.06");
?>
