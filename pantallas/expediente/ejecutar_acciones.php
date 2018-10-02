<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) { $ruta_db_superior = $ruta;
	} $ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "pantallas/expediente/librerias.php");

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("iddoc");
desencriptar_sqli('form_info');

if (@$_REQUEST["ejecutar_expediente"]) {
	if (!@$_REQUEST["tipo_retorno"]) {
		$_REQUEST["tipo_retorno"] = 1;
	}
	if ($_REQUEST["tipo_retorno"]) {
		echo(json_encode($_REQUEST["ejecutar_expediente"]()));
	} else {
		$_REQUEST["ejecutar_expediente"]();
	}
}
function set_expediente() {
	global $conn;
	$retorno = new stdClass;
	$retorno -> exito = 0;
	$retorno -> mensaje = "Error al guardar expediente";
	$exito = 0;
	$campos = array(
		"nombre",
		"cod_padre",
		"codigo",
		"fecha",
		"serie_idserie",
		"dependencia_iddependencia",
		"codigo_numero",
		"fondo",
		"proceso",
		"fecha_extrema_i",
		"fecha_extrema_f",
		"no_unidad_conservacion",
		"no_folios",
		"no_carpeta",
		"soporte",
		"frecuencia_consulta",
		"ubicacion",
		"unidad_admin",
		"estado_archivo",
		"estado_cierre",
		"fk_idcaja",
		"agrupador",
		"propietario",
		"tomo_no",
		"indice_uno",
		"indice_dos",
		"indice_tres",
		"consecutivo_inicial",
		"consecutivo_final"
	);
	$array_vacios = array(
		'cod_padre',
		'serie_idserie',
		'dependencia_iddependencia',
		'soporte',
		'frecuencia_consulta',
		'ubicacion',
		'estado_archivo',
		'estado_cierre',
		'estado_cierre',
		'fk_idcaja',
		'agrupador'
	);
	for ($i = 0; $i < count($array_vacios); $i++) {
		if (!@$_REQUEST[$array_vacios[$i]] || @$_REQUEST[$array_vacios[$i]] == '') {
			$_REQUEST[$array_vacios[$i]] = 0;
		}
	}

	$sql2 = "INSERT INTO expediente(" . implode(",", $campos) . ") VALUES (
			'" . @$_REQUEST['nombre'] . "',
			" . @$_REQUEST['cod_padre'] . ",
			'" . @$_REQUEST['codigo'] . "',
			" . fecha_db_almacenar(@$_REQUEST['fecha'], 'Y-m-d') . ",
			" . @$_REQUEST['serie_idserie'] . ",
			" . @$_REQUEST['dependencia_iddependencia'] . ",
			'" . @$_REQUEST['codigo_numero'] . "',
			'" . @$_REQUEST['fondo'] . "',
			'" . @$_REQUEST['proceso'] . "',
			" . fecha_db_almacenar(@$_REQUEST['fecha_extrema_i'], 'Y-m-d') . ",
			" . fecha_db_almacenar(@$_REQUEST['fecha_extrema_f'], 'Y-m-d') . ",
			'" . @$_REQUEST['no_unidad_conservacion'] . "',
			'" . @$_REQUEST['no_folios'] . "',
			'" . @$_REQUEST['no_carpeta'] . "',
			" . @$_REQUEST['soporte'] . ",
			" . @$_REQUEST['frecuencia_consulta'] . ",
			" . @$_REQUEST['ubicacion'] . ",
			'" . @$_REQUEST['unidad_admin'] . "',
			" . @$_REQUEST['estado_archivo'] . ",
			" . @$_REQUEST['estado_cierre'] . ",
			" . @$_REQUEST['fk_idcaja'] . ",
			" . @$_REQUEST['agrupador'] . ",
			" . usuario_actual("funcionario_codigo") . ",
			1,
			'" . @$_REQUEST['indice_uno'] . "',
			'" . @$_REQUEST['indice_dos'] . "',
			'" . @$_REQUEST['indice_tres'] . "',
			'" . @$_REQUEST['consecutivo_inicial'] . "',
			'" . @$_REQUEST['consecutivo_final'] . "'
		)";
	phpmkr_query($sql2) or die($sql2);
	$idexpediente = phpmkr_insert_id();
	guardar_lob('descripcion', 'expediente', "idexpediente=" . $idexpediente, @$_REQUEST['descripcion'], 'texto', $conn, 0);
	guardar_lob('notas_transf', 'expediente', "idexpediente=" . $idexpediente, @$_REQUEST['notas_transf'], 'texto', $conn, 0);

	$cod_padre = busca_filtro_tabla("cod_arbol", "expediente A", "A.idexpediente=" . $_REQUEST["cod_padre"], "", $conn);
	if ($cod_padre["numcampos"]) {
		$codigo_arbol = $cod_padre[0]["cod_arbol"] . "." . $idexpediente;
	} else {
		$codigo_arbol = $idexpediente;
	}
	$sql3 = "UPDATE expediente SET cod_arbol='" . $codigo_arbol . "' where idexpediente=" . $idexpediente;
	phpmkr_query($sql3) or die($sql3);
	$retorno -> sql = $sql2;
	if ($idexpediente) {
		if (asignar_expediente($idexpediente, 1, usuario_actual("idfuncionario"), "m,e,p")) {
			$exito = 1;
		}
	}
	if ($exito) {
		$retorno -> idexpediente = $idexpediente;
		$retorno -> exito = 1;
		$retorno -> mensaje = "Expediente guardado con &eacute;xito";
	}
	return ($retorno);
}

function set_expediente_documento() {
	global $conn;

	$retorno = new stdClass;
	$retorno -> exito = 0;
	$retorno -> mensaje = "Error al guardar/vincular expediente";
	$exito = 0;
	$campos = array(
		"nombre",
		"cod_padre",
		"codigo",
		"fecha",
		"propietario",
		"estado_archivo",
		"serie_idserie"
	);
	$array_vacios = array('cod_padre');
	for ($i = 0; $i < count($array_vacios); $i++) {
		if (!@$_REQUEST[$array_vacios[$i]] || @$_REQUEST[$array_vacios[$i]] == '') {
			$_REQUEST[$array_vacios[$i]] = 0;
		}
	}
	$sql2 = "INSERT INTO expediente(" . implode(",", $campos) . ") VALUES
	(
		'" . @$_REQUEST['nombre'] . "',
		" . @$_REQUEST['cod_padre'] . ",
		'" . @$_REQUEST['codigo'] . "',
		" . fecha_db_almacenar(@$_REQUEST['fecha'], 'Y-m-d') . ",
		" . usuario_actual("funcionario_codigo") . ",
		1,". @$_REQUEST['serie_idserie'] . "
	)";
	phpmkr_query($sql2);
	$idexpediente = phpmkr_insert_id();
	guardar_lob('descripcion', 'expediente', "idexpediente=" . $idexpediente, @$_REQUEST['descripcion'], 'texto', $conn, 0);
	$cod_padre = busca_filtro_tabla("cod_arbol", "expediente A", "A.idexpediente=" . $_REQUEST["cod_padre"], "", $conn);
	$sql3 = "UPDATE expediente SET cod_arbol='" . $cod_padre[0]["cod_arbol"] . "." . $idexpediente . "' where idexpediente=" . $idexpediente;
	phpmkr_query($sql3);
	$retorno -> sql = $sql2;
	$busqueda = busca_filtro_tabla("", "expediente_doc A", "A.documento_iddocumento=" . @$_REQUEST["iddoc"], "", $conn);
     if ($busqueda["numcampos"]) {
     	$sqlus = "UPDATE expediente_doc SET expediente_idexpediente='" . $idexpediente . "' WHERE idexpediente_doc=" . $busqueda[0]["idexpediente_doc"];
        phpmkr_query($sqlus) or die($sqlus);
	}
	 else{
		$sql4 = "INSERT INTO expediente_doc(expediente_idexpediente,documento_iddocumento,fecha) VALUES('" . $idexpediente . "', '" . @$_REQUEST["iddoc"] . "'," . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . ")";
		phpmkr_query($sql4);
	}
	//update documento serie_idserie
	$sqlus = "UPDATE documento SET serie=" . @$_REQUEST['serie_idserie'] . " WHERE iddocumento=" . $_REQUEST["iddoc"];
        phpmkr_query($sqlus) or die($sqlus);
	if ($idexpediente) {
		if (asignar_expediente($idexpediente, 1, usuario_actual("idfuncionario"))) {
			$exito = 1;
		}
	}
	if ($exito) {
		$retorno -> idexpediente = $idexpediente;
		$retorno -> exito = 1;
		$retorno -> mensaje = "Expediente guardado con &eacute;xito";
	}
	return ($retorno);
}

function update_expediente() {
	global $conn;
	$retorno = new stdClass;
	$retorno -> exito = 0;
	$retorno -> mensaje = "Error al guardar";
	$exito = 0;
	$array_vacios = array(
		'cod_padre',
		'serie_idserie',
		'soporte',
		'frecuencia_consulta',
		'ubicacion',
		'estado_archivo',
		'estado_cierre',
		'estado_cierre',
		'fk_idcaja',
		'agrupador'
	);
	for ($i = 0; $i < count($array_vacios); $i++) {
		if (!@$_REQUEST[$array_vacios[$i]] || @$_REQUEST[$array_vacios[$i]] == '') {
			$_REQUEST[$array_vacios[$i]] = 0;
		}
	}
	$update = array();
	$update[] = " nombre='" . @$_REQUEST['nombre'] . "' ";
	$update[] = " fecha=" . fecha_db_almacenar(@$_REQUEST['fecha'], 'Y-m-d');
	$update[] = " fk_idcaja=" . @$_REQUEST['fk_idcaja'];
	$update[] = " cod_padre=" . @$_REQUEST['cod_padre'];
	$update[] = " codigo_numero='" . @$_REQUEST['codigo_numero'] . "' ";
	$update[] = " fondo='" . @$_REQUEST['fondo'] . "' ";
	$update[] = " proceso='" . @$_REQUEST['proceso'] . "' ";
	$update[] = " fecha_extrema_i=" . fecha_db_almacenar(@$_REQUEST['fecha_extrema_i'], 'Y-m-d');
	$update[] = " fecha_extrema_f=" . fecha_db_almacenar(@$_REQUEST['fecha_extrema_f'], 'Y-m-d');
	$update[] = " no_unidad_conservacion='" . @$_REQUEST['no_unidad_conservacion'] . "' ";
	$update[] = " no_folios='" . @$_REQUEST['no_folios'] . "' ";
	$update[] = " no_carpeta='" . @$_REQUEST['no_carpeta'] . "' ";
	$update[] = " soporte=" . @$_REQUEST['soporte'];
	$update[] = " frecuencia_consulta=" . @$_REQUEST['frecuencia_consulta'];
	$update[] = " ubicacion=" . @$_REQUEST['ubicacion'];
	$update[] = " serie_idserie=" . @$_REQUEST['serie_idserie'];
	$update[] = " dependencia_iddependencia=" . @$_REQUEST['dependencia_iddependencia'];
	$update[] = " indice_uno='" . @$_REQUEST['indice_uno'] . "'";
	$update[] = " indice_dos='" . @$_REQUEST['indice_dos'] . "'";
	$update[] = " indice_tres='" . @$_REQUEST['indice_tres'] . "'";
	$update[] = " consecutivo_inicial='" . @$_REQUEST['consecutivo_inicial'] . "'";
	$update[] = " consecutivo_final='" . @$_REQUEST['consecutivo_final'] . "'";
	//$update[]=" unidad_admin='".@$_REQUEST['unidad_admin']."' ";

	$antiguo = busca_filtro_tabla("cod_padre", "expediente A", "A.idexpediente=" . $_REQUEST["idexpediente"], "", $conn);
	$antiguo_padre = busca_filtro_tabla("idexpediente,cod_arbol", "expediente A", "A.idexpediente=" . $antiguo[0]["cod_padre"], "", $conn);

	$sql2 = "UPDATE expediente SET " . implode(",", $update) . " WHERE idexpediente=" . $_REQUEST["idexpediente"];
	phpmkr_query($sql2);
	$idexpediente = $_REQUEST["idexpediente"];
	guardar_lob('descripcion', 'expediente', "idexpediente=" . $idexpediente, @$_REQUEST['descripcion'], 'texto', $conn, 0);
	guardar_lob('notas_transf', 'expediente', "idexpediente=" . $idexpediente, @$_REQUEST['notas_transf'], 'texto', $conn, 0);

	$cod_padre = busca_filtro_tabla("cod_arbol", "expediente A", "A.idexpediente=" . $_REQUEST["cod_padre"], "", $conn);
	if ($cod_padre["numcampos"]) {
		$codigo_arbol = $cod_padre[0]["cod_arbol"] . "." . $idexpediente;
	} else {
		$codigo_arbol = $idexpediente;
	}
	$sql3 = "UPDATE expediente SET cod_arbol='" . $codigo_arbol . "' where idexpediente=" . $idexpediente;
	phpmkr_query($sql3);
	if ($_REQUEST["cod_padre"] != $antiguo[0]["cod_padre"]) {
		$cod_nuevo = $codigo_arbol . ".";
		if ($antiguo_padre[0]["cod_arbol"]) {
			$cod_antiguo = $antiguo_padre[0]["cod_arbol"] . "." . $idexpediente . ".";
		} else {
			$cod_antiguo = $idexpediente . ".";
		}
		$sql4 = "update expediente set cod_arbol=replace(cod_arbol,'" . $cod_antiguo . "','" . $cod_nuevo . "') where cod_arbol like '" . $cod_antiguo . "%'";
		phpmkr_query($sql4);
	}
	//$retorno -> sql = $sql2;
	if ($idexpediente) {
		$exito = 1;
	}
	if ($exito) {
		$retorno -> idexpediente = $idexpediente;
		$retorno -> exito = 1;
		$retorno -> mensaje = "Expediente actualizado con &eacute;xito";
	}
	return ($retorno);
}

function delete_expediente() {
	global $conn;
	$retorno = new stdClass;
	$retorno -> exito = 0;
	$retorno -> mensaje = "Error al eliminar";
	$exito = 0;

	$sql2 = "DELETE FROM expediente WHERE idexpediente=" . $_REQUEST["idexpediente"];
	phpmkr_query($sql2);
	$sql3 = "DELETE FROM expediente_doc WHERE expediente_idexpediente=" . $_REQUEST["idexpediente"];
	phpmkr_query($sql3);
	$sql4 = "DELETE FROM entidad_expediente WHERE expediente_idexpediente=" . $_REQUEST["idexpediente"];
	phpmkr_query($sql4);
	$idexpediente = $_REQUEST["idexpediente"];
	$retorno -> sql = $sql2;
	if ($idexpediente) {
		$exito = 1;
	}
	if ($exito) {
		$retorno -> idexpediente = $idexpediente;
		$retorno -> exito = 1;
		$retorno -> mensaje = "Expediente eliminado con &eacute;xito";
	}
	return ($retorno);
}

function crear_tomo_expediente() {
	global $conn, $ruta_db_superior;

	$retorno = new stdClass;
	$retorno -> exito = 0;
	$retorno -> mensaje = "Error al crear tomo";

	$idexpediente = $_REQUEST["idexpediente"];
	$expediente_actual = busca_filtro_tabla("tomo_padre,estado_archivo,serie_idserie,fk_idcaja, dependencia_iddependencia, codigo_numero, fondo, proceso, fecha_extrema_i, fecha_extrema_f, no_unidad_conservacion, no_folios, no_carpeta, soporte, frecuencia_consulta, ubicacion, notas_transf, indice_uno, indice_dos, indice_tres", "expediente", "idexpediente=" . $idexpediente, "", $conn);
	$tomo_padre = $idexpediente;
	if ($expediente_actual[0]['tomo_padre']) {
		$tomo_padre = $expediente_actual[0]['tomo_padre'];
	}

	$ccantidad_tomos = busca_filtro_tabla("idexpediente", "expediente", "tomo_padre=" . $tomo_padre, "", $conn);
	$cantidad_tomos = $ccantidad_tomos['numcampos'] + 1;
	//tomos + el padre
	$tomo_siguiente = $cantidad_tomos + 1;
	//tomo siguiente

	$datos_padre = busca_filtro_tabla("nombre,serie_idserie,tomo_no,estado_archivo,descripcion,cod_padre,cod_arbol", "expediente", "idexpediente=" . $tomo_padre, "", $conn);
	if (!$datos_padre[0]['tomo_no']) {
		$up = "UPDATE expediente SET tomo_no=1 WHERE idexpediente=" . $tomo_padre;
		phpmkr_query($up);
	}

	if (!is_numeric($expediente_actual[0]['serie_idserie'])) {
		$expediente_actual[0]['serie_idserie'] = 0;
	}
	$sql = "INSERT INTO expediente (serie_idserie,nombre,fecha,propietario,ver_todos,editar_todos,tomo_padre,tomo_no,estado_archivo,descripcion,cod_padre, fk_idcaja, dependencia_iddependencia, codigo_numero, fondo, proceso, fecha_extrema_i, fecha_extrema_f,no_unidad_conservacion, no_folios, no_carpeta, soporte, frecuencia_consulta, ubicacion, notas_transf, indice_uno, indice_dos, indice_tres,cod_arbol,consecutivo_inicial,consecutivo_final) VALUES (" . $expediente_actual[0]['serie_idserie'] . ",'" . $datos_padre[0]['nombre'] . "'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . "," . usuario_actual('funcionario_codigo') . ",0,0," . $tomo_padre . "," . $tomo_siguiente . "," . $expediente_actual[0]['estado_archivo'] . ",'" . $datos_padre[0]['descripcion'] . "'," . $datos_padre[0]['cod_padre'] . "," . $expediente_actual[0]['fk_idcaja'] . "," . $expediente_actual[0]['dependencia_iddependencia'] . ",'" . $expediente_actual[0]['codigo_numero'] . "','" . $expediente_actual[0]['fondo'] . "','" . $expediente_actual[0]['proceso'] . "','" . $expediente_actual[0]['fecha_extrema_i'] . "','" . $expediente_actual[0]['fecha_extrema_f'] . "','" . $expediente_actual[0]['no_unidad_conservacion'] . "','" . $expediente_actual[0]['no_folios'] . "','" . $expediente_actual[0]['no_carpeta'] . "'," . $expediente_actual[0]['soporte'] . "," . $expediente_actual[0]['frecuencia_consulta'] . "," . $expediente_actual[0]['ubicacion'] . ",'" . $expediente_actual[0]['notas_transf'] . "','" . $expediente_actual[0]['indice_uno'] . "','" . $expediente_actual[0]['indice_dos'] . "','" . $expediente_actual[0]['indice_tres'] . "','".$datos_padre[0]['cod_arbol']."','".$datos_padre[0]['consecutivo_inicial']."','".$datos_padre[0]['consecutivo_final']."')";
	phpmkr_query($sql);
	$id_insertado = phpmkr_insert_id();
	if ($id_insertado) {

		if ($id_insertado) {
			if (asignar_expediente($id_insertado, 1, usuario_actual("idfuncionario"), "m,e,p")) {
				$exito = 1;
			}
		}

		$retorno -> exito = 1;
		$retorno -> mensaje = "Tomo creado con exito";
		$retorno -> insertado = $id_insertado;
	}
	return ($retorno);
}

function vincular_expediente_documento() {
	global $conn;
	$retorno = new stdClass;
	$retorno -> exito = 0;
	$retorno -> mensaje = "Error al vincular el expediente al documento";
	$exito = 1;
	if (!@$_REQUEST["expedientes"]) {
		$retorno -> exito = 0;
		$retorno -> mensaje = "Debe seleccionar al menos 1 expediente";
	} elseif (!@$_REQUEST["iddoc"]) {
		$retorno -> exito = 0;
		$retorno -> mensaje = "Debe seleccionar al menos 1 documento";
	} else {
		$lexpedientes = explode(",", $_REQUEST["expedientes"]);
		$cant_expedientes = count($lexpedientes);
		for ($i = 0; $i < $cant_expedientes; $i++) {
			$expediente = busca_filtro_tabla("", "expediente_doc", "expediente_idexpediente=" . $lexpedientes[$i] . " AND documento_iddocumento=" . $_REQUEST["iddoc"], "", $conn);
			if (!$expediente["numcampos"]) {
				$sql2 = "INSERT INTO expediente_doc(expediente_idexpediente,documento_iddocumento,fecha) VALUES(" . $lexpedientes[$i] . "," . $_REQUEST["iddoc"] . "," . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . ")";
				phpmkr_query($sql2);
				if (!phpmkr_insert_id()) {
					$exito = 0;
				}
			}
		}
		if ($exito) {
			$retorno -> exito = 1;
			$retorno -> mensaje = "Todos los expedientes han sido vinculados";
		} else {
			$retorno -> exito = 1;
			$retorno -> mensaje = "Algunos expedientes han sido vinculados";
		}
	}
	return ($retorno);
}

function asignar_permiso_expediente() {
	global $conn;
	$retorno = new stdClass;
	$retorno -> exito = 0;
	$retorno -> mensaje = "Error al asignar el expediente";
	if (@$_REQUEST["idexpediente"] && @$_REQUEST["tipo_entidad"] && $_REQUEST["idfuncionario"] && $_REQUEST["propietario"] != "") {
		if ($_REQUEST["tipo_entidad"] == 5) {
			$_REQUEST["tipo_entidad"] = 1;
		}
		$sql1 = "DELETE FROM entidad_expediente WHERE expediente_idexpediente IN(" . $_REQUEST["idexpediente"] . ") AND entidad_identidad=1 AND llave_entidad NOT IN(" . implode(",", $_REQUEST["idfuncionario"]) . "," . $_REQUEST["propietario"] . ")";
		phpmkr_query($sql1) or die($retorno);
		foreach ($_REQUEST["idfuncionario"] as $idfunc) {
			$permiso = "";
			if (isset($_REQUEST["permisos_" . $idfunc])) {
				$permiso = implode(",", $_REQUEST["permisos_" . $idfunc]);
			}

			$vector_expedientes = explode(',', $_REQUEST["idexpediente"]);
			for ($j = 0; $j < count($vector_expedientes); $j++) {
				asignar_expediente($vector_expedientes[$j], $_REQUEST["tipo_entidad"], $idfunc, $permiso);
			}
		}
		$exito = 1;
		if ($exito) {
			$retorno -> exito = 1;
			$retorno -> mensaje = "Asignaciones al expediente realizadas con &eacute;xito";
		} else if ($exito == 0) {
			$retorno -> exito = 0;
			$retorno -> mensaje = "No se realizan asignaciones al expediente";
		} else {
			$retorno -> exito = 0;
			$retorno -> mensaje = "Se realizan algunas asignaciones al expediente se presentan errores";
		}
	} else if (!$_REQUEST["idfuncionario"] && @$_REQUEST["idexpediente"] && @$_REQUEST['propietario']) {

		$sql1 = "DELETE FROM entidad_expediente WHERE expediente_idexpediente IN(" . $_REQUEST["idexpediente"] . ") AND entidad_identidad=1 AND llave_entidad NOT IN(" . $_REQUEST["propietario"] . ")";
		phpmkr_query($sql1) or die($retorno);

		$retorno -> exito = 1;
		$retorno -> mensaje = "Des-Asignaciones al expediente realizadas con &eacute;xito";
	}
	return ($retorno);
}

function delete_documento_expediente() {
	global $conn;
	$retorno = new stdClass;
	$retorno -> exito = 0;
	$retorno -> mensaje = "Error al eliminar";
	$exito = 0;

	$sql3 = "DELETE FROM expediente_doc WHERE documento_iddocumento=" . $_REQUEST["iddocumento"] . " AND expediente_idexpediente=" . $_REQUEST["idexpediente"];
	phpmkr_query($sql3);
	$idexpediente = $_REQUEST["idexpediente"];
	$retorno -> sql = $sql3;
	if ($idexpediente) {
		$exito = 1;
	}
	if ($exito) {
		$retorno -> idexpediente = $idexpediente;
		$retorno -> exito = 1;
		$retorno -> mensaje = "Documento eliminado de este expediente con exito";
	}
	return ($retorno);
}

function abrir_cerrar_expediente() {
	global $conn;

	$retorno = new stdClass;
	$retorno -> exito = 0;
	$retorno -> mensaje = "Error al realizar la accion";

	$idexpediente = @$_REQUEST["idexpediente"];
	$accion = @$_REQUEST["accion"];
	$update_adicional = '';
	if (intval($accion) == 1) {//si abren expedidiente se retira de proxima transferencia documental
		$update_adicional = "prox_estado_archivo=0, ";
	}

	$sql1 = "update expediente set " . $update_adicional . "estado_cierre='" . $accion . "', fecha_cierre=" . fecha_db_almacenar(date('Y-m-d'), 'Y-m-d') . ", funcionario_cierre='" . usuario_actual('idfuncionario') . "' where idexpediente=" . $idexpediente;
	phpmkr_query($sql1);

	$sql2 = "INSERT INTO expediente_abce (expediente_idexpediente,estado_cierre,fecha_cierre,funcionario_cierre,observaciones) VALUES (" . $idexpediente . "," . $accion . "," . fecha_db_almacenar(date('Y-m-d'), 'Y-m-d') . "," . usuario_actual('idfuncionario') . ",'" . @$_REQUEST['observaciones'] . "')";
	phpmkr_query($sql2);

	$retorno -> idexpediente = $idexpediente;
	$retorno -> exito = 1;
	$retorno -> mensaje = "Accion realizada";

	return ($retorno);
}

function obtener_rastro_documento_expediente() {
	global $conn;

	$funcionario_radicador = busca_filtro_tabla("funcionario_codigo", "funcionario", "login='radicador_salida'", "", $conn);
	$estados_validar = array(
		"'borrador'",
		"'transferido'",
		"'revisado'",
		"'aprobado'"
	);
	$consulta = busca_filtro_tabla("destino", "buzon_salida", "archivo_idarchivo=" . @$_REQUEST['iddoc'] . " AND tipo_destino=1 AND lower(nombre) IN(" . implode(',', $estados_validar) . ") AND destino NOT IN(" . $funcionario_radicador[0]['funcionario_codigo'] . ")", "", $conn);

	$funs = busca_filtro_tabla("CONCAT(nombres,' ', apellidos)as nombre_funcionario", "funcionario", "funcionario_codigo IN(" . implode(',', extrae_campo($consulta, 'destino')) . ")", "", $conn);

	$vector_nombres = extrae_campo($funs, 'nombre_funcionario');
	$vector_nombres = array_map('strtolower', $vector_nombres);
	$vector_nombres = array_map('html_entity_decode', $vector_nombres);
	$vector_nombres = array_map('ucwords', $vector_nombres);
	$cadena_nombres = implode(', ', $vector_nombres);

	$retorno = new stdClass;
	$retorno -> exito = 1;
	$retorno -> msn = $cadena_nombres;
	return ($retorno);

}

function cambiar_responsable_expediente() {
	global $conn;
	$retorno = new stdClass;
	$funcionario_codigo = $_REQUEST['funcionario_codigo'];
	$idexpediente = $_REQUEST['idexpediente'];
	if (@$_REQUEST['tomos_asociados'] != '') {
		$idexpediente .= ',' . $_REQUEST['tomos_asociados'];
	}
	$exp_res_actual = busca_filtro_tabla("propietario", "expediente", "idexpediente=" . $_REQUEST['idexpediente'], "", $conn);
	$idfuncionario_antiguo = busca_filtro_tabla("idfuncionario", "funcionario", "funcionario_codigo=" . $exp_res_actual[0]['propietario'], "", $conn);
	$idfuncionario_nuevo = busca_filtro_tabla("idfuncionario", "funcionario", "funcionario_codigo=" . $funcionario_codigo, "", $conn);

	$permisos_expedientes_antiguo = busca_filtro_tabla("identidad_expediente", "entidad_expediente", "estado=1 AND entidad_identidad=1 AND llave_entidad=" . $idfuncionario_antiguo[0]['idfuncionario'] . " AND expediente_idexpediente IN(" . $idexpediente . ")", "", $conn);
	$identidad_expediente = implode(",", extrae_campo($permisos_expedientes_antiguo, 'identidad_expediente'));

	$sql = "UPDATE expediente SET propietario='" . $funcionario_codigo . "' WHERE idexpediente IN(" . $idexpediente . ")";
	phpmkr_query($sql);

	$sql4 = "UPDATE entidad_expediente SET llave_entidad=" . $idfuncionario_nuevo[0]['idfuncionario'] . " WHERE identidad_expediente IN(" . $identidad_expediente . ")";
	phpmkr_query($sql4);

	$retorno -> exito = 1;
	return ($retorno);
}
?>