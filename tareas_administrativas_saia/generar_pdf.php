<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';
while ($max_salida > 0) {
	if (is_file($ruta . 'db.php')) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= '../';
	--$max_salida;
}
include_once $ruta_db_superior . 'db.php';
if (!$_SESSION["LOGIN" . LLAVE_SAIA]) {
	logear_funcionario_webservice("radicador_web");
}

$documentos = busca_filtro_tabla_limit("iddocumento", "documento", "pdf IS NULL AND estado='APROBADO'", "", 0, 4, $conn);
if ($documentos['numcampos']) {
	for ($i = 0; $i < $documentos['numcampos']; $i++) {
		/*GENERACION DEL PDF*/
		$ch = curl_init();
		$fila = "http://" . RUTA_PDF_LOCAL . "/class_impresion.php?plantilla=carta&iddoc=" . $documentos[$i]['iddocumento'] . "&conexion_remota=1&conexio_usuario=" . $_SESSION["LOGIN" . LLAVE_SAIA] . "&usuario_actual=" . $_SESSION["usuario_actual"] . "&LOGIN=" . $_SESSION["LOGIN" . LLAVE_SAIA] . "&LLAVE_SAIA=" . LLAVE_SAIA;
		curl_setopt($ch, CURLOPT_URL, $fila);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$contenido = curl_exec($ch);
		curl_close($ch);
		/*TERMINA GENERACION*/
	}
	@session_destroy();
	unset($_SESSIONS);
	redirecciona("http://" . RUTA_PDF_LOCAL . "/tareas_administrativas_saia/generar_pdf.php");
} else {
	die("Termino");
}
?>