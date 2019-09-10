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
$funcionario = $_REQUEST['funcionario'];
$consultaDatos = "SELECT idpretexto,asunto,imagen FROM pretexto,entidad_pretexto";
$consultaDatos = StaticSql::search($consultaDatos);
//print_r($consultaDatos);
$table= '<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
<body>
<div class="container">
</div>';