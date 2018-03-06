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

desactivar_reemplazos_menu();
function desactivar_reemplazos_menu() {
	global $conn;
	$fecha_hoy = date("Y-m-d");
	$activos = busca_filtro_tabla("idreemplazo", "reemplazo", "activo='1' and " . fecha_db_obtener("fecha_fin", "Y-m-d") . "<='" . $fecha_hoy . "'", "", $conn);
	$datos = array();
	for ($i = 0; $i < $activos["numcampos"]; $i++) {
		desactivar_reemplazo($activos[$i]["idreemplazo"]);
		$datos[] = $activos[$i]["idreemplazo"];
	}
	$abrir = fopen("logs/log_reemplazo.txt", "a+");
	fwrite($abrir, date('Y-m-d H:i:s') . " idreemplazo=" . implode(", ", $datos) . " \n");
	fclose($abrir);
}

function desactivar_reemplazo($idreemplazo) {
	global $conn;
	$datos = busca_filtro_tabla("", "reemplazo", "idreemplazo=" . $idreemplazo, "", $conn);
	//datos del rol de quien estaba haciendo el reemplazo
	$datos_anteriores = busca_filtro_tabla("*", "dependencia_cargo", "iddependencia_cargo=" . $datos[0]["nuevo"], "", $conn);
	//datos del funcionario que estaba haciendo el reemplazo
	$reemplazo = busca_filtro_tabla("*", "funcionario", "idfuncionario=" . $datos_anteriores[0]["funcionario_idfuncionario"], "", $conn);

	$anio = date("Y");
	$fecha_fin = fecha_db_almacenar(date("Y-m-d", mktime(0, 0, 0, 1, 1, $anio + 1)), "Y-m-d");
	//datos del rol de la persona que sali� temporalmente
	$antiguo = busca_filtro_tabla("*", "dependencia_cargo", "iddependencia_cargo=" . $datos[0]["antiguo"], "iddependencia_cargo DESC", $conn);
	//datos del funcionario que estaba haciendo el reemplazo
	$usuinicial = busca_filtro_tabla("*", "funcionario", "idfuncionario=" . $antiguo[0]["funcionario_idfuncionario"], "", $conn);
	//le pongo el cargo anterior al reemplazo
	$sql = "update dependencia_cargo set estado=0,fecha_final=" . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . " where iddependencia_cargo=" . $datos[0]["cargo_nuevo"];
	phpmkr_query($sql);
	$sql = "INSERT INTO dependencia_cargo (funcionario_idfuncionario,dependencia_iddependencia,cargo_idcargo,estado,fecha_inicial,fecha_final) values (" . $antiguo[0]["funcionario_idfuncionario"] . "," . $antiguo[0]["dependencia_iddependencia"] . "," . $antiguo[0]["cargo_idcargo"] . ",1," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",$fecha_fin)";
	phpmkr_query($sql);
	$sql = "update funcionario set estado=1 where idfuncionario=" . $antiguo[0]["funcionario_idfuncionario"];
	phpmkr_query($sql);
	//actualizo la fecha de finalizacion del reemplazo
	$sql = "update reemplazo set activo=0,fecha_fin=" . fecha_db_almacenar(date("Y-m-d"), "Y-m-d") . " where idreemplazo=" . $idreemplazo;
	phpmkr_query($sql);
	//cambio la fecha de vigencia par compartir los documentos
	$sql = "update permiso_funcionario set vigencia_final=" . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . " where llave_propietaria='" . $reemplazo[0]["idfuncionario"] . "' and llave_compartida='" . $usuinicial[0]["funcionario_codigo"] . "' and entidad_propietaria=1 and entidad_compartida=1";
	phpmkr_query($sql);
}
?>