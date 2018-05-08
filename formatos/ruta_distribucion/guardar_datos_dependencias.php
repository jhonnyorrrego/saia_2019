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

$dependencia_asignada = $_REQUEST['dependencia_asignada'];
$descripcion = $_REQUEST['descripcion'];

for ($i = 0; $i < count($dependencia_asignada); $i++) {
	$sql = "UPDATE ft_dependencias_ruta SET descripcion_dependen='{$descripcion[$i]}' WHERE dependencia_asignada={$dependencia_asignada[$i]}";
	phpmkr_query($sql);
}
echo('<script>window.history.back(); window.location.reload();</script>');
