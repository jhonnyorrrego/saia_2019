<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
;
include_once ($ruta_db_superior . "librerias_saia.php");
include_once ($ruta_db_superior . "formatos/generar_formato.php");

if (@$_REQUEST["accion"] == "generar") {
	if (!@$_REQUEST["condicion"]) {
		$_REQUEST["condicion"] = '';
	} else {
		$_REQUEST["condicion"] = str_replace("@", "=", $_REQUEST["condicion"]);
	}
	if (!@$_REQUEST["registro"]) {
		$registro = 0;
	} else {
		$registro = $_REQUEST["registro"];
	}
	$formatos = busca_filtro_tabla("", "formato", $_REQUEST["condicion"], "", $conn);
	$formato = $formatos[$registro];
	$acciones = explode(",", $_REQUEST["acciones_formato"]);
	$cant_acciones = count($acciones);
	if ($formatos["numcampos"] && $cant_acciones && $registro < $formatos["numcampos"]) {
		// $abrir=fopen($ruta_db_superior."../log_creacion_formatos3.txt","a+");
		$redirecciona = PROTOCOLO_CONEXION . RUTA_PDF . '/formatos/llamado_formatos.php?acciones_formato=' . $_REQUEST["acciones_formato"] . '&registro=' . ($registro + 1);
		if (@$_REQUEST["condicion"]) {
			$redirecciona .= '&condicion=' . str_replace("=", "@", $_REQUEST["condicion"]);
		}
		if ($_REQUEST["accion"] == "generar") {
			$redirecciona .= '&accion=' . $_REQUEST["accion"];
		}
		// $ch = curl_init();
		for($i = 0; $i < $cant_acciones; $i++) {
			$generar = new GenerarFormato($formato["idformato"], $acciones[$i], '');
			$redireccion = $generar->ejecutar_accion();

			if ($contenido === false) {
				alerta_formatos("No se puede generar el formato por favor verifique la generaci&oacute;n manual del formato");
			} else {
				$creados .= 'Formato ' . $acciones[$i] . " " . $formato["nombre"] . " <br>";
			}
			// fwrite($abrir,"En la fecha ".date('Y-m-d H:i:s')." Termina el proceso ".$fila." => ".$contenido." \n \n");
		}
		// curl_close ($ch);
		echo ($creados);
		// fclose($abrir);
		if ($formatos["numcampos"] == 1) {
			alerta_formatos("Formato " . $formatos[0]["nombre"] . " creado con exito");
			// die("AQUI");
			redirecciona(PROTOCOLO_CONEXION . RUTA_PDF . "/formatos/formatoview.php?key=" . $formatos[0]["idformato"]);
		}
		redirecciona($redirecciona);
	} else {
		if ($registro >= $formatos["numcampos"]) {
			alerta_formatos($formatos["numcampos"] . " Formatos Creados con exito");
			die("<hr>PRUEBA");
			redirecciona(PROTOCOLO_CONEXION . RUTA_PDF . "/formatos/formatolist.php");
		}
		alerta_formatos("No se puede realizar (" . $cant_acciones . ") en " . $formatos["numcampos"] . " formatos ");
	}

}
?>
