<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ( $max_salida > 0 ) {
	if (is_file ( $ruta . "db.php" )) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida --;
}

include_once ($ruta_db_superior . "db.php");

$dir_ip = @$_REQUEST["ipaddr"];
$iddoc= @$_REQUEST["doc"];
$idfunc= @$_REQUEST["func"];
$resp = array("estado" => 0, "mensaje" => "No se pudo crear el registro para su dirección IP");

//Cancelar las tareas pendientes de la misma ip
$buscar_tarea = busca_filtro_tabla("", "tarea_dig", "estado=1 and direccion_ip='$dir_ip' and idfuncionario=$idfunc", "", $conn);
if($buscar_tarea["numcampos"]) {
	$ids_tareas = array();
	for ($i = 0; $i < $buscar_tarea["numcampos"]; $i++) {
		$ids_tareas[] = $buscar_tarea[$i]["idtarea_dig"];
	}
	if(!empty($ids_tareas)) {
		$qry_del = "update tarea_dig set estado=0 where idtarea_dig in (" . implode(", ", $ids_tareas) . ")";
		phpmkr_query($qry_del);
	}
}
if($dir_ip && $iddoc && $idfunc) {
	$qry = "insert into tarea_dig (idfuncionario, iddocumento, estado, direccion_ip) values ($idfunc, $iddoc, 1, '$dir_ip')";
	phpmkr_query($qry);
	$id_tarea = phpmkr_insert_id();

	$resp["estado"] = 1;
	$resp["mensaje"] = "Correcto";
	$resp["idtarea"] = $id_tarea;
} else {
	$resp["mensaje"] = "Datos insuficientes para registrar la tarea";
}
echo json_encode($resp);
