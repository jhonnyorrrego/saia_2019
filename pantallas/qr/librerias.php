<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if(is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");

function mostrar_codigo_qr($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
  include_once($ruta_db_superior."StorageUtils.php");
  require_once $ruta_db_superior.'filesystem/SaiaStorage.php';

	$codigo_qr = busca_filtro_tabla("", "documento_verificacion", "documento_iddocumento=" . $iddoc, "", $conn);
	if($codigo_qr['numcampos']) {
    $archivo_binario=StorageUtils::get_binary_file($codigo_qr[0]['ruta_qr']);
		$img='<img src="'.$archivo_binario.'" />';
	}
	echo $qr;	
}

function generar_codigo_qr($idformato, $iddoc, $idfunc = 0) {
	global $conn, $ruta_db_superior;
	include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");
	include_once ($ruta_db_superior . "pantallas/lib/librerias_cripto.php");
	include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
	
	$codigo_qr = busca_filtro_tabla("ruta_qr, iddocumento_verificacion", "documento_verificacion", "documento_iddocumento=" . $iddoc, "", $conn);
	$datos = busca_filtro_tabla("A.fecha,A.estado,A.numero", "documento A", "A.iddocumento=" . $iddoc, "", $conn);
	$idfun = "";
	if(@$_REQUEST['tipo'] == 5) {
		$idfun = $_REQUEST['idfunc'];
	} else {
		$idfun = usuario_actual('idfuncionario');
		if(!$idfun){
		    $idfun=1;
		}
	}
	
	if($idfunc) {
		$idfun = $idfunc;
	}
	
	$fecha = date_parse($datos[0]['fecha']);
	$datos_qr = "";
	$cadena = "id=" . $iddoc;
	$codificada = encrypt_blowfish($cadena, LLAVE_SAIA_CRYPTO);
	// $datos_qr=PROTOCOLO_CONEXION.RUTA_PDF."/informacion_documento.php?key_cripto=".$codificada;
	// $datos_qr=PROTOCOLO_CONEXION.RUTA_PDF."/info.php?".$cadena;
	$datos_qr = RUTA_INFO_QR . "?key_cripto=" . $codificada;
	
	// $datos_qr="Radicado No: ".$datos[0]["numero"]."\n";
	// $datos_qr.="Fecha: ".$fecha["day"]." de ".mes($fecha["month"])." del ".$fecha["year"]." a las ".$fecha["hour"].":".$fecha["minute"]."\n";
	// $firmas = busca_filtro_tabla("CONCAT(B.nombres,CONCAT(' ',B.apellidos)) AS nombre","buzon_salida A, funcionario B","A.origen=B.funcionario_codigo AND (A.nombre LIKE 'APROBADO' OR A.nombre LIKE 'REVISADO')AND A.archivo_idarchivo=".$iddoc,"", $conn);
	// $datos_qr.="Firman: \n";
	//for($i = 0; $i < $firmas['numcampos']; $i++) {
		// $datos_qr .= codifica_encabezado(html_entity_decode($firmas[$i]['nombre']))." \n";
	//}
	
	$formato_ruta = aplicar_plantilla_ruta_documento($iddoc);
	$almacenamiento = new SaiaStorage(RUTA_QR);

	$ruta = $formato_ruta . '/qr/';
	$imagen = generar_qr_bin($datos_qr, 3);

	$filename = $ruta . 'qr' . date('Y_m_d_H_m_s') . '.png';
	
	if($imagen == false) {
		alerta("Error al tratar de crear el codigo qr");
	} else {
		$almacenamiento->almacenar_contenido($filename, $imagen);
		$ruta_qr = array ("servidor" => $almacenamiento->get_ruta_servidor(), "ruta" => $filename);
		$sql_documento_qr = "INSERT INTO documento_verificacion(documento_iddocumento,funcionario_idfuncionario,fecha,ruta_qr,verificacion) VALUES (" . $iddoc . "," . $idfun . "," . fecha_db_almacenar(date("Y-m-d H:m:s"), 'Y-m-d H:i:S') . ",'" . json_encode($ruta_qr) . "','vacio')";
		phpmkr_query($sql_documento_qr);
	}
}

function generar_qr($filename, $datos, $matrixPointSize = 2, $errorCorrectionLevel = 'L') {
	global $ruta_db_superior;
	include_once ($ruta_db_superior . "phpqrcode/qrlib.php");
	if($datos) {
		if(trim($datos) == '') {
			return false;
		} else {
			crear_destino($ruta_db_superior . $filename);
			$filename .= 'qr' . date('Y_m_d_H_m_s') . '.png';
			if(file_exists($ruta_db_superior . $filename)) {
			}
			QRcode::png($datos, $ruta_db_superior . $filename, $errorCorrectionLevel, $matrixPointSize, 0);
			return $filename;
		}
	} else {
		return false;
	}
}
function generar_qr_bin($datos, $matrixPointSize = 2, $errorCorrectionLevel = 'L') {
	global $ruta_db_superior;
	include_once ($ruta_db_superior . "phpqrcode/qrlib.php");
	if($datos) {
		if(trim($datos) == '') {
			return false;
		} else {
			$filename = StorageUtils::obtener_archivo_temporal("qr");
			//ob_implicit_flush(false);
			//ob_start('callback');
			QRcode::png($datos, $filename, $errorCorrectionLevel, $matrixPointSize, 0);
			//$imageString = base64_encode( ob_get_contents() );
			//$imageString = ob_get_contents();
			//ob_end_clean();
			$imageString = file_get_contents($filename);
			unlink($filename);
			return $imageString;
		}
	} else {
		return false;
	}
}
?>
