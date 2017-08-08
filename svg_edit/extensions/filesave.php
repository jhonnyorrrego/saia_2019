<?php
/*
 * filesave.php
 * To be used with ext-server_opensave.js for SVG-edit
 *
 * Licensed under the MIT License
 *
 * Copyright(c) 2010 Alexis Deveria
 *
 */
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if(is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "pantallas/lib/librerias_cripto.php");
include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");

require ($ruta_db_superior . 'vendor/autoload.php');
require_once $ruta_db_superior . 'filesystem/SaiaStorage.php';
include_once $ruta_db_superior . "StorageUtils.php";

if(!isset($_POST['output_svg']) && !isset($_POST['output_png'])) {
	die('post fail');
}

$file = '';

$suffix = isset($_POST['output_svg']) ? '.svg' : '.png';

if(isset($_POST['filename']) && strlen($_POST['filename']) > 0) {
	$file = $_POST['filename'] . $suffix;
} else {
	$file = 'image' . $suffix;
}

if($suffix == '.svg') {
	$mime = 'image/svg+xml';
	$contents = rawurldecode($_POST['output_svg']);
} else {
	$mime = 'image/png';
	$contents = $_POST['output_png'];
	$pos = (strpos($contents, 'base64,') + 7);
	$contents = base64_decode(substr($contents, $pos));
	
	$doc = busca_filtro_tabla(fecha_db_obtener('a.fecha', 'Y-m') . " as x_fecha, estado, iddocumento", "documento a", "a.iddocumento=" . $_REQUEST["iddoc"], "", $conn);
	$formato_ruta = aplicar_plantilla_ruta_documento($doc[0]["iddocumento"]);
	//$ruta_archivos = ruta_almacenamiento("archivos");
	$alm_archivos = new SaiaStorage("archivos");
	// $ruta_guardar=RUTA_ARCHIVOS.$doc[0]["estado"]."/".$doc[0]["x_fecha"]."/".$doc[0]["iddocumento"]."/firma_externa/";
	$ruta_guardar = $formato_ruta . "/firma_externa/";
	//crear_destino($ruta_guardar);
	$aleatorio = rand(1, 5999);
	$ruta_guardar2 = $ruta_guardar . $aleatorio . ".png";
	
	$alm_archivos->almacenar_contenido($ruta_guardar2, $contents);
	//file_put_contents($ruta_guardar2, $contents);
	
	$tmpfs = StorageUtils::get_memory_filesystem("imagen", "saia");
	$tmpfs->write("firma_externa/" . $aleatorio . ".png", $contents); //se usa para crear directorio temporal
	$ruta_temporal='saia://imagen/firma_externa/';

	$input_file = $ruta_temporal . $aleatorio . ".png";
	$output_file = $ruta_temporal . $aleatorio . ".jpg";
	$input = imagecreatefrompng($input_file);
	list($width, $height) = getimagesize($input_file);
	$output = imagecreatetruecolor($width, $height);
	$white = imagecolorallocate($output, 255, 255, 255);
	imagefilledrectangle($output, 0, 0, $width, $height, $white);
	imagecopy($output, $input, 0, 0, 0, 0, $width, $height);
	imagejpeg($output, $output_file);
	
	$contenido_archivo = file_get_contents($output_file);
	//file_put_contents($output_file, encrypt_blowfish($contenido_archivo, LLAVE_SAIA_CRYPTO));

	$output_file_final = $ruta_guardar . $aleatorio . ".jpg";
	$alm_archivos->almacenar_contenido($output_file_final, encrypt_blowfish($contenido_archivo, LLAVE_SAIA_CRYPTO));
	
	unlink($input_file);
	
	$campo = "firma_externa";
	if(@$_REQUEST["campo_modificar"]) {
		$campo = $_REQUEST["campo_modificar"];
	}
	$formato = busca_filtro_tabla("", "formato a", "a.idformato=" . $_REQUEST["idformato"], "", $conn);
	$tabla = $formato[0]["nombre_tabla"];
	if(@$_REQUEST["tabla"]) {
		$tabla = $_REQUEST["tabla"];
	}
	$campo_tabla = "documento_iddocumento";
	if(@$_REQUEST["campo_tabla"]) {
		$campo_tabla = $_REQUEST["campo_tabla"];
	}
	$llave_modificar = $_REQUEST["iddoc"];
	if(@$_REQUEST["llave_modificar"]) {
		$llave_modificar = $_REQUEST["llave_modificar"];
	}
	$ruta_alm = substr($ruta_guardar, strlen($ruta_db_superior));
	$sql1 = "update " . $tabla . " set " . $campo . "='" . $ruta_alm . $aleatorio . ".jpg" . "' where " . $campo_tabla . "=" . $llave_modificar;
	phpmkr_query($sql1);
}

function guardar_lob2($campo, $tabla, $condicion, $contenido, $tipo, $conn, $log = 1) {
	$sql = "SELECT " . $campo . " FROM " . $tabla . " WHERE " . $condicion . " FOR UPDATE";
	// echo $sql.'<br /> ';
	$stmt = OCIParse($conn->Conn->conn, $sql) or print_r(OCIError($stmt));
	// Execute the statement using OCI_DEFAULT (begin a transaction)
	OCIExecute($stmt, OCI_DEFAULT) or print_r(OCIError($stmt));
	// Fetch the SELECTed row
	OCIFetchInto($stmt, $row, OCI_ASSOC);
	if(FALSE === $row) {
		OCIRollback($conn->Conn->conn);
		alerta("No se pudo modificar el campo.");
		$resultado = FALSE;
	} else { // Now save a value to the LOB
		if($row[strtoupper($campo)]->size() > 0)
			$contenido_actual = htmlspecialchars_decode($row[strtoupper($campo)]->read($row[strtoupper($campo)]->size()));
		else
			$contenido_actual = "";
		if($contenido_actual != $contenido) {
			if($row[strtoupper($campo)]->size() > 0 && !$row[strtoupper($campo)]->truncate()) {
				oci_rollback($conn->Conn->conn);
				alerta("No se pudo modificar el campo.");
				$resultado = FALSE;
			} else {
				if(!$row[strtoupper($campo)]->save(trim((($contenido))))) {
					oci_rollback($conn->Conn->conn);
					$resultado = FALSE;
				} else
					oci_commit($conn->Conn->conn);
					// *********** guardo el log en la base de datos **********************
				preg_match("/.*=(.*)/", strtolower($condicion), $resultados);
			}
		}
		oci_free_statement($stmt);
		$row[strtoupper($campo)]->free();
	}
}
?>
