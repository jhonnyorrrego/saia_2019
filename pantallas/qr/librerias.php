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
/*
 * $idformato: id unico del formato
 * $iddoc: id unico que identifica al documento
 * $retorno: false: hace echo de <img>, true: hace return del <img>
 * Se usa para mostrar el qr en los formatos.
 */
function mostrar_codigo_qr($idformato, $iddoc,$retorno=false) {
	global $conn, $ruta_db_superior;

	include_once($ruta_db_superior."StorageUtils.php");
	require_once $ruta_db_superior.'filesystem/SaiaStorage.php';
	$codigo_qr = busca_filtro_tabla("ruta_qr", "documento_verificacion", "documento_iddocumento=" . $iddoc, "", $conn);
	$img='';
	if($codigo_qr['numcampos']) {
		$ruta_qr=json_decode($codigo_qr[0]['ruta_qr']);
		if(is_object($ruta_qr)){
			$tipo_almacenamiento = new SaiaStorage(RUTA_QR);
			if($tipo_almacenamiento->get_filesystem()->has($ruta_qr->ruta)){
    			$archivo_binario=StorageUtils::get_binary_file($codigo_qr[0]['ruta_qr']);
				$img='<img src="'.$archivo_binario.'" />';
			}
		}
	}
	if($img=='') {
		generar_codigo_qr($idformato,$iddoc);
		$img=mostrar_codigo_qr($idformato,$iddoc,true);
	}
	if($retorno){
		return $img;
	}else{
		echo($img);
	}

}

function generar_codigo_qr($idformato, $iddoc, $idfunc = 0) {
	global $conn, $ruta_db_superior;
	include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");
	include_once ($ruta_db_superior . "pantallas/lib/librerias_cripto.php");
	include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");

	$codigo_qr = busca_filtro_tabla("ruta_qr, iddocumento_verificacion", "documento_verificacion", "documento_iddocumento=" . $iddoc, "", $conn);
	if($codigo_qr['numcampos']){
		$sqld="DELETE FROM documento_verificacion WHERE documento_iddocumento=".$iddoc;
		phpmkr_query($sqld);
	}

	$datos = busca_filtro_tabla("A.fecha,A.estado,A.numero", "documento A", "A.iddocumento=" . $iddoc, "", $conn);
	$idfun = "";
	if(@$_REQUEST['tipo'] == 5) {
		$idfun = $_REQUEST['idfunc'];
	} else {
		$idfun = $_SESSION["idfuncionario"];
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
	$datos_qr = RUTA_INFO_QR . "?key_cripto=" . $codificada;
	$formato_ruta = aplicar_plantilla_ruta_documento($iddoc);
	$almacenamiento = new SaiaStorage(RUTA_QR);

	$ruta = $formato_ruta . '/qr/';
	$imagen = generar_qr_bin($datos_qr, 3);

	$filename = $ruta . 'qr' . date('Y_m_d_H_m_s') . '.png';

	if($imagen == false) {
		alerta("Error al tratar de crear el codigo QR");
	} else {
		$almacenamiento->almacenar_contenido($filename, $imagen);
		$ruta_qr = array ("servidor" => $almacenamiento->get_ruta_servidor(), "ruta" => $filename);
		$sql_documento_qr = "INSERT INTO documento_verificacion(documento_iddocumento,funcionario_idfuncionario,fecha,ruta_qr,verificacion) VALUES (" . $iddoc . "," . $idfun . "," . fecha_db_almacenar(date("Y-m-d H:m:s"), 'Y-m-d H:i:S') . ",'" . json_encode($ruta_qr) . "','vacio')";
		phpmkr_query($sql_documento_qr) or die("Error al insertar la ruta del QR");
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
