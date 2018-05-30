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
global $conn;

$func = busca_filtro_tabla("firma", "funcionario", "funcionario_codigo=" . $_REQUEST["codigo"], "", $conn);
$func[0]['firma'] = trim($func[0]['firma']);
if ($func[0]['firma'] == "null" || $func[0]['firma'] == "" || is_null($func[0]['firma']) || !$func[0]['firma']) {//si no tiene firma (corrige error en pdf cuando el fun no tiene firma)
	$fileHandle = fopen($ruta_db_superior . 'firmas/blanco.jpg', "rb");
	$fileContent = fread($fileHandle, filesize($ruta_db_superior . 'firmas/blanco.jpg'));
	fclose($fileHandle);
	$func[0]["firma"] = $fileContent;
}
header("Content-Type: image/jpeg");
echo $func[0]["firma"];
?>
