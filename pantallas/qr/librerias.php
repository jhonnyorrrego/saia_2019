<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");

function mostrar_codigo_qr_encabezado($idformato, $iddoc) {
	return mostrar_codigo_qr($idformato, $iddoc, 1);
}

function mostrar_codigo_qr($idformato, $iddoc, $retorno = 0, $width = 60, $height = 60) {
	global $conn, $ruta_db_superior;
	if (isset($_REQUEST["height_qr"])) {
		$height = $_REQUEST["height_qr"];
	}
	if (isset($_REQUEST["width_qr"])) {
		$width = $_REQUEST["height_qr"];
	}

	$codigo_qr = busca_filtro_tabla("ruta_qr", "documento_verificacion", "documento_iddocumento=" . $iddoc, "", $conn);
	if ($codigo_qr['numcampos']) {
		$qr = '<img src="' . PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . '/' . $codigo_qr[0]['ruta_qr'] . '" width="' . $width . 'px" height="' . $height . 'px" >';
	} else {
		$respuesta = generar_codigo_qr($idformato, $iddoc);
		if ($respuesta["exito"]) {
			$qr = '<img src="' . PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . '/' . $respuesta['ruta_qr'] . '" width="' . $width . 'px" height="' . $height . 'px" >';
		} else {
			$qr = $respuesta["msn"];
		}
	}
	if ($retorno) {
		return ($qr);
	} else {
		echo $qr;
	}
}

function generar_codigo_qr($idformato, $iddoc, $idfunc = 0) {
	global $conn, $ruta_db_superior;
	include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");
	include_once ($ruta_db_superior . "pantallas/lib/librerias_cripto.php");
	include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");

	$retorno = array("exito" => 0, "msn" => "");
	if ($idfunc == 0) {
		$idfunc = $_SESSION["idfuncionario"];
		if (!$idfunc && isset($_REQUEST["idfunc"])) {
			$idfunc = $_REQUEST['idfunc'];
		}
	}

	$codigo_qr = busca_filtro_tabla("ruta_qr, iddocumento_verificacion", "documento_verificacion", "documento_iddocumento=" . $iddoc, "", $conn);
	if ($codigo_qr["numcampos"]) {
		$retorno["exito"] = 1;
		$retorno["msn"] = "El QR ya existe";
		$retorno["ruta_qr"] = $codigo_qr[0]["ruta_qr"];
	} else {
		$codificada = encrypt_blowfish("id=" . $iddoc, LLAVE_SAIA_CRYPTO);
		$datos_qr = RUTA_INFO_QR . "?key_cripto=" . $codificada;

		$formato_ruta = aplicar_plantilla_ruta_documento($iddoc);
		$ruta = RUTA_QR . $formato_ruta . '/qr/';
		$imagen = generar_qr($ruta, $datos_qr, 3);
		if (!$imagen) {
			$retorno["msn"] = "Error al tratar de crear el codigo QR";
		} else {
			$sql_documento_qr = "INSERT INTO documento_verificacion(documento_iddocumento,funcionario_idfuncionario,fecha,ruta_qr,verificacion) VALUES (" . $iddoc . "," . $idfunc . "," . fecha_db_almacenar(date("Y-m-d"), 'Y-m-d') . ",'" . $imagen . "','vacio')";
			phpmkr_query($sql_documento_qr) or die("Error al insertar la ruta del QR");
			$retorno["exito"] = 1;
			$retorno["msn"] = "QR generado con exito";
			$retorno["ruta_qr"] = $imagen;
		}
	}
	return $retorno;
}

function generar_qr($filename, $datos, $matrixPointSize = 2, $errorCorrectionLevel = 'L') {
	global $ruta_db_superior;
	include_once ($ruta_db_superior . "phpqrcode/qrlib.php");
	if (trim($datos) != "") {
		crear_destino($ruta_db_superior . $filename);
		$filename .= 'qr' . date('Y_m_d_H_m_s') . '.png';
		QRcode::png($datos, $ruta_db_superior . $filename, $errorCorrectionLevel, $matrixPointSize, 0);
		if (file_exists($ruta_db_superior . $filename)) {
			return $filename;
		} else {
			return false;
		}
	} else {
		return false;
	}
}
?>
