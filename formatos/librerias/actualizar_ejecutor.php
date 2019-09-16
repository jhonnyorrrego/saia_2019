<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';
foreach ($_REQUEST as $key => $valor) {
	if ($valor == 'undefined') {
		unset($_REQUEST[$key]);
	}
}
/*
 Si la identificacion llega y es valida se mira si existe alg�n ejecutor que
 la tenga asignada, si es asi, se actualizan los datos de la tabla ejecutor
 con los que vengan del formulario, de lo contrario se crea
 un registro nuevo en la tabla ejecutor
 */
$condicion = "";
$insertado = 0;
if (@$_REQUEST["nombre"]) {
	$nombre = trim(str_replace(",", "", @$_REQUEST["nombre"]));
}
if (@$_REQUEST["identificacion"]) {
	$identificacion = trim(str_replace(",", "", @$_REQUEST["identificacion"]));
}
$ejecutor["numcampos"] = 0;

if (trim(@$_REQUEST["identificacion"]) <> "") {
	$ejecutor = busca_filtro_tabla("", "ejecutor", "identificacion LIKE '" . @$identificacion . "'", "", $conn);
	if (!$ejecutor["numcampos"]) {
		$ejecutor = busca_filtro_tabla("", "ejecutor", "lower(nombre) LIKE lower('" . @$nombre . "') and (identificacion is null or identificacion='')", "", $conn);
	}
} elseif (trim(@$_REQUEST["nombre"]) <> "") {
	$ejecutor = busca_filtro_tabla("", "ejecutor", "lower(nombre) LIKE lower('" . @$nombre . "')", "", $conn);
}

if ($ejecutor["numcampos"]) {
	$otros = "";
	if (isset($_REQUEST["tipo_documento"]) && $_REQUEST["tipo_documento"] <> "" && $_REQUEST["tipo_documento"] <> "undefined")
		$otros .= ",tipo_documento=" . $_REQUEST["tipo_documento"];
	if (isset($_REQUEST["lugar_expedicion"]) && $_REQUEST["lugar_expedicion"] && $_REQUEST["lugar_expedicion"] <> "undefined")
		$otros .= ",lugar_expedicion='" . $_REQUEST["lugar_expedicion"] . "'";
	if (isset($_REQUEST["identificacion"]) && $_REQUEST["identificacion"] && $_REQUEST["identificacion"] <> "undefined")
		$otros .= ",identificacion='" . $_REQUEST["identificacion"] . "'";
	if (isset($_REQUEST["tipo_ejecutor"]) && $_REQUEST["tipo_ejecutor"] && $_REQUEST["tipo_ejecutor"] <> "undefined")
		$otros .= ",tipo_ejecutor='" . $_REQUEST["tipo_ejecutor"] . "'";

	$sql = "UPDATE ejecutor SET nombre ='" . @$_REQUEST["nombre"] . "'" . $otros . " WHERE idejecutor=" . $ejecutor[0]["idejecutor"];
	phpmkr_query($sql, $conn);
	$idejecutor = $ejecutor[0]["idejecutor"];
} else {
	$sql = "INSERT INTO ejecutor(nombre,identificacion)VALUES('" . @$nombre . "','" . @$identificacion . "')";
	phpmkr_query($sql, $conn);
	$idejecutor = phpmkr_insert_id();
	if (isset($_REQUEST["tipo_ejecutor"]) && $_REQUEST["tipo_ejecutor"])
		phpmkr_query("update ejecutor set tipo_ejecutor='" . $_REQUEST["tipo_ejecutor"] . "' where idejecutor=$idejecutor", $conn);

	if (isset($_REQUEST["lugar_expedicion"]) && $_REQUEST["lugar_expedicion"])
		phpmkr_query("update ejecutor set lugar_expedicion='" . $_REQUEST["lugar_expedicion"] . "' where idejecutor=$idejecutor", $conn);

	if (isset($_REQUEST["tipo_documento"]) && $_REQUEST["tipo_documento"])
		phpmkr_query("update ejecutor set tipo_documento='" . $_REQUEST["tipo_documento"] . "' where idejecutor=$idejecutor", $conn);

	$insertado = 1;
}
/*
 se busca con el idejecutor si ya existen datos en la tabla datos_ejecutor,
 */
$campos_ejecutor = explode(",", $_REQUEST["campos"]);
$campos_excluidos = array("nombre", "identificacion");
$campos_ejecutor = array_diff($campos_ejecutor, $campos_excluidos);
sort($campos_ejecutor);
$campos_todos = array("direccion", "telefono", "email", "cargo", "empresa", "ciudad", "titulo", "codigo");

$condicion_actualiza = "";
for ($i = 0; $i < count($campos_ejecutor); $i++) {
	if (isset($_REQUEST[$campos_ejecutor[$i]])) {
		$_REQUEST[$campos_ejecutor[$i]] = ($_REQUEST[$campos_ejecutor[$i]]);
		if ($campos_ejecutor[$i] == "fecha_nacimiento")
			$condicion_actualiza .= ' AND ' . fecha_db_obtener($campos_ejecutor[$i], "Y-m-d") . "='" . $_REQUEST[$campos_ejecutor[$i]] . "'";
		elseif ($_REQUEST[$campos_ejecutor[$i]])
			$condicion_actualiza .= ' AND ' . $campos_ejecutor[$i] . "='" . $_REQUEST[$campos_ejecutor[$i]] . "'";
		else {
			$condicion_actualiza .= ' AND (' . $campos_ejecutor[$i] . " IS NULL or " . $campos_ejecutor[$i] . "='')";
		}
	}
}
$datos_ejecutor = busca_filtro_tabla("", "datos_ejecutor", "ejecutor_idejecutor=" . $idejecutor . $condicion_actualiza, "", $conn);

if ((!$datos_ejecutor["numcampos"] || $insertado) && $condicion_actualiza != "") {
	$datos_ejecutor = busca_filtro_tabla("", "datos_ejecutor", "ejecutor_idejecutor=" . $idejecutor, "iddatos_ejecutor desc", $conn);

	$campos = array();
	$valores = array();
	$insertcolumns = [];
	$insertvalues = [];
	if (!isset($_REQUEST["ciudad"]) || strtolower($_REQUEST["ciudad"]) == "undefined") {
		$config = busca_filtro_tabla("valor", "configuracion", "lower(nombre) like 'ciudad'", "", $conn);
		if ($config["numcampos"])
			$_REQUEST["ciudad"] = $config[0][0];
		else
			$_REQUEST["ciudad"] = 658;
	}
	for ($i = 0; $i <= count($campos_todos); $i++) {
		if ($campos_todos[$i] <> "fecha_nacimiento") {
			if (isset($_REQUEST[$campos_todos[$i]]) && in_array($campos_todos[$i], $campos_ejecutor)) {
				array_push($valores, $_REQUEST[$campos_todos[$i]]);
				array_push($campos, $campos_todos[$i]);
				$insertcolumns[$campos_todos[$i]] = ":" . $campos_todos[$i];
				$insertvalues[$campos_todos[$i]] = $_REQUEST[$campos_todos[$i]];

				$actualizado = 1;
			} elseif ($datos_ejecutor["numcampos"] && $datos_ejecutor[0][$campos_todos[$i]] <> "") {
				array_push($valores, $datos_ejecutor[0][$campos_todos[$i]]);
				array_push($campos, $campos_todos[$i]);
				$insertcolumns[$campos_todos[$i]] = ":" . $campos_todos[$i];
				$insertvalues[$campos_todos[$i]] =  $datos_ejecutor[0][$campos_todos[$i]];
			}
		}
	}

	if ($actualizado) {
		$valor_insertar = "'" . implode("','", $valores) . "',";
		$campos_insertar = implode(",", $campos) . ",";
	}

	throw new Exception('se debe cambiar remitente', 1);



	$sql = 'INSERT INTO datos_ejecutor(' . $campos_insertar . "ejecutor_idejecutor,fecha) VALUES(" . $valor_insertar . $idejecutor . "," . date("Y-m-d H:i:s") . ")";
	$municipio = Model::getQueryBuilder()
		->insert("datos_ejecutor");
	$municipio->values(
		$insertcolumns
	);
	foreach ($insertvalues as $key => $value) {
		$municipio->setParameter(":" . $key, $value);
	}
	$municipio->execute();

	phpmkr_query($sql, $conn);
	$iddatos_ejecutor = phpmkr_insert_id();
	if (isset($_REQUEST["codigo"]) && $_REQUEST["codigo"]) {
		$datos = busca_filtro_tabla("", "datos_ejecutor", "ejecutor_idejecutor=" . $idejecutor, "", $conn);
		if ($datos["numcampos"] > 0)
			phpmkr_query("UPDATE datos_ejecutor SET codigo=" . $_REQUEST["codigo"] . " where ejecutor_idejecutor=" . $idejecutor);
	}
} else if ($datos_ejecutor["numcampos"]) {
	$iddatos_ejecutor = $datos_ejecutor[0]["iddatos_ejecutor"];
}
/*Pilas Validad que si se haga la accion*/
echo ($iddatos_ejecutor . '|' . delimita($nombre, 50));
