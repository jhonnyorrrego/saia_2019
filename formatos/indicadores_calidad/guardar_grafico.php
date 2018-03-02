<?php
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
$exito = 0;
if ($_REQUEST['iddoc']) {
	$configuracion_temporal = busca_filtro_tabla("valor", "configuracion", "nombre='ruta_temporal' AND tipo='ruta'", "", $conn);
	if ($configuracion_temporal["numcampos"]) {
		$ruta_temp = $configuracion_temporal[0]["valor"];
	}
	$ruta_grafico = $ruta_db_superior . $ruta_temp . "_" . usuario_actual("login") . "/" . $_REQUEST['iddoc'] . "/";

	if (!file_exists($ruta_grafico)) {
		crear_destino($ruta_grafico);
	}

	$archivo_eliminar = '';
	if (@$_REQUEST['nombre_imagen'] && @$_REQUEST['extension']) {
		$archivo_eliminar = $_REQUEST['nombre_imagen'] . $_REQUEST['extension'];
		if (file_exists($ruta_grafico . $archivo_eliminar)) {
			unlink($ruta_grafico . $archivo_eliminar);
		}
	}

	if ($_REQUEST['img']) {
		$datoimg = explode(";", $_REQUEST['img']);
		$decode = explode(",", $datoimg[1]);
		$datos = base64_decode($decode[1]);
		$grafico = $_REQUEST['nombre_imagen'] . $_REQUEST['extension'];
		$archivo = fopen($ruta_grafico . $grafico, "w+");
		
		fclose($archivo);
		file_put_contents($ruta_grafico . $grafico, $datos);
		if (file_exists($ruta_grafico . $grafico)) {
			$exito = 1;
		}
	}
}
echo($exito);
?>