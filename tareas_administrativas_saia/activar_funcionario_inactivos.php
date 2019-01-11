<?php
@set_time_limit(0);
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
if (!@$_SESSION["LOGIN" . LLAVE_SAIA]) {
	logear_funcionario_webservice("cerok");
}

$fecha_hoy = date("Y-m-d");
$funcionarios_inactivos = busca_filtro_tabla("", "funcionario a", "a.estado='0' and " . fecha_db_obtener('fecha_fin_inactivo', 'Y-m-d') . "<='" . $fecha_hoy . "'", "", $conn);
$ids = array();
for ($i = 0; $i < $funcionarios_inactivos["numcampos"]; $i++) {
	$sql1 = "update funcionario set estado='1' where idfuncionario=" . $funcionarios_inactivos[$i]["idfuncionario"];
	phpmkr_query($sql1);
	$ids[] = $funcionarios_inactivos[$i]["idfuncionario"];
}
$abrir = fopen("logs/log_activacion_funcionario.txt", "a+");
fwrite($abrir, date('Y-m-d H:i:s') . " idfuncionario=" . implode(", ", $ids) . " \n");
fclose($abrir);
?>