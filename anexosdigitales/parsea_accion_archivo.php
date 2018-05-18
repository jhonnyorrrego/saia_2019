<?php
include_once ("funciones_archivo.php");
if (isset($_REQUEST["accion"])) {
	switch($_REQUEST["accion"]) {
		case "descargar" :
			$idanexo = $_REQUEST["idanexo"];
			descargar_archivo($idanexo);
			exit();
			break;
		case "descargar_ruta_json" :
			$ruta_json = base64_decode($_REQUEST["ruta"]);
			descargar_archivo(NULL,NULL,$ruta_json);
			exit();
			break;
	}
}
?>
