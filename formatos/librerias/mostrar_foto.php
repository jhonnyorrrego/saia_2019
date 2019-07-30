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

include_once $ruta_db_superior . "core/autoload.php";

$Funcionario = Funcionario::findByAttributes(['funcionario_codigo' => $_REQUEST["codigo"]]);

if (!$Funcionario->firma) {
	$route = $ruta_db_superior . 'assets/images/firmas/blanco.jpg';
} else {
	$route = $ruta_db_superior . $Funcionario->getImage('firma');
}

$fileHandle = fopen($route, 'rb');
$fileContent = fread($fileHandle, filesize($route));
fclose($fileHandle);

header("Content-Type: image/jpeg");
echo $fileContent;
