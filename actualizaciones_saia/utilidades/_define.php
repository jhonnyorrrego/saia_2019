<?php
define("ewAllowAdd", 1, true);
define("ewAllowDelete", 2, true);
define("ewAllowEdit", 4, true);
define("ewAllowView", 8, true);
define("ewAllowList", 8, true);
define("ewAllowReport", 8, true);
define("ewAllowSearch", 8, true);																														
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
if(!defined("RUTA_PDF"))
  //define("RUTA_PDF", "190.14.226.146:8085/multiproposito/saia1.06");
  define("RUTA_PDF", "75.101.166.85/saia_release1/saia1.06");
if(!defined("PERMISOS_CARPETAS"))
  define("PERMISOS_CARPETAS",0777);
if(!defined("PERMISOS_ARCHIVOS"))
  define("PERMISOS_ARCHIVOS",0777);
define("DEBUGEAR",1);
//ini_set(magic_quotes_gpc,0);
ini_set("memory_limit","400M");
//ini_set('error_reporting', E_ALL);
ini_set("display_errors",TRUE);
ini_set("safe_mode",false);
define("RUTA_SCRIPT","saia_release1/saia1.06");
date_default_timezone_set ("America/Bogota");
define("RUTA_DISCO","..");  
define("SO","linux");
define("CARPETA_SAIA","saia1.06");

define("RUTA_ARCHIVOS","../almacenamiento/");
define("RUTA_PDFS","../almacenamiento/");
define("RUTA_IMAGENES","../almacenamiento/");
?>
