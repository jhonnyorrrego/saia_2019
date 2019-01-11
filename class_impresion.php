<?php
set_time_limit(0);
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}

include_once ($ruta_db_superior . "db.php");
if (!$_SESSION["LOGIN" . LLAVE_SAIA] && isset($_REQUEST["LOGIN"]) && @$_REQUEST["conexion_remota"]) {
	logear_funcionario_webservice($_REQUEST["LOGIN"]);
}

if (@$_REQUEST['iddoc']) {
	$iddoc = $_REQUEST['iddoc'];
	$tipo_exportacion = busca_filtro_tabla("exportar", "formato a, documento b", "lower(a.nombre)=lower(b.plantilla) AND b.iddocumento=" . $iddoc, "", $conn);
	$existe = false;
	if ($tipo_exportacion['numcampos']) {
		if (file_exists($ruta_db_superior . 'class_impresion_' . $tipo_exportacion[0]['exportar'] . '.php')) {
			$_REQUEST['tipo_pdf'] = $tipo_exportacion[0]['exportar'];
			$existe = true;
			include_once ($ruta_db_superior . 'class_impresion_' . $tipo_exportacion[0]['exportar'] . '.php');
		}
	}
	if (!$existe) {
		echo('<cente>No se ha definido un M&eacute;todo Exportaci&oacute;n para esta plantilla, favor contactar al administrador del sistema! </center>');
	}
}
?>