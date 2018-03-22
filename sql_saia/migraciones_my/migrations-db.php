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
include_once ($ruta_db_superior . "define.php");

return [
'dbname' => DB,
'user' => USER,
'password' => PASS,
'host' => HOST,
'driver' => 'pdo_mysql',
'port' => PORT
];