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
include_once ($ruta_db_superior . "pantallas/caja/librerias.php");

if (@$_REQUEST["ejecutar_caja"]) {
	if (!@$_REQUEST["tipo_retorno"]) {
		$_REQUEST["tipo_retorno"] = 1;
	}
	if ($_REQUEST["tipo_retorno"]) {
		echo(json_encode($_REQUEST["ejecutar_caja"]()));
	} else {
		$_REQUEST["ejecutar_caja"]();
	}
}
function set_caja() {
	$retorno = new stdClass;
	$retorno -> exito = 0;
	$retorno -> mensaje = "Error al guardar";
	$exito = 0;
	$campos = array("fondo", "seccion", "subseccion", "division", "codigo", "serie_idserie", "no_carpetas", "no_cajas", "no_consecutivo", "no_correlativo", "fecha_extrema_i", "fecha_extrema_f", "estanteria", "panel", "material", "seguridad", "funcionario_idfuncionario", "modulo", "nivel", "codigo_serie", "codigo_dependencia", "dependencia_iddependencia");
	$valores = array();
	foreach ($campos AS $key => $campo) {
		if (@$_REQUEST[$campo]) {
			array_push($valores, $_REQUEST[$campo]);
		} else {
			array_push($valores, "");
		}
	}
	$sql2 = "INSERT INTO caja(" . implode(",", $campos) . ") VALUES('" . implode("','", $valores) . "')";
	phpmkr_query($sql2);
	$idcaja = phpmkr_insert_id();
	if ($idcaja) {
		if (asignar_caja($idcaja, 1, usuario_actual("idfuncionario"))) {
			$exito = 1;
		}
	}
	if ($exito) {
		$retorno -> idcaja = $idcaja;
		$retorno -> exito = 1;
		$retorno -> mensaje = "Caja guardado con &eacute;xito";
	}
	return ($retorno);
}

function update_caja() {
	$retorno = new stdClass;
	$retorno -> exito = 0;
	$retorno -> mensaje = "Error al guardar";
	$exito = 0;
	$campos = array("fondo", "seccion", "subseccion", "division", "codigo", "serie_idserie", "no_carpetas", "no_cajas", "no_consecutivo", "no_correlativo", "fecha_extrema_i", "fecha_extrema_f", "estanteria", "panel", "material", "seguridad", "funcionario_idfuncionario", "dependencia_iddependencia");
	$valores = array();
	$update = array();
	foreach ($campos AS $key => $campo) {
		$update[] = $campo . "='" . $_REQUEST[$campo] . "'";
	}
	$sql2 = "UPDATE caja SET " . implode(",", $update) . " WHERE idcaja=" . $_REQUEST["idcaja"];
	phpmkr_query($sql2);
	$idcaja = $_REQUEST["idcaja"];
	$retorno -> sql = $sql2;
	if ($idcaja) {
		$exito = 1;
	}
	if ($exito) {
		$retorno -> idcaja = $idcaja;
		$retorno -> exito = 1;
		$retorno -> mensaje = "Caja actualizado con &eacute;xito";
	}
	return ($retorno);
}

function delete_caja() {
	$retorno = new stdClass;
	$retorno -> exito = 0;
	$retorno -> mensaje = "Error al eliminar";
	$exito = 0;

	$sql2 = "DELETE FROM caja WHERE idcaja=" . $_REQUEST["idcaja"];
	phpmkr_query($sql2);
	$idcaja = $_REQUEST["idcaja"];
	$retorno -> sql = $sql2;
	if ($idcaja) {
		$exito = 1;
	}
	if ($exito) {
		$retorno -> idcaja = $idcaja;
		$retorno -> exito = 1;
		$retorno -> mensaje = "Caja eliminado con &eacute;xito";
	}
	return ($retorno);
}

function asignar_permiso_caja() {
	global $conn;
	$retorno = array("exito" => 0, "mensaje" => "Error al asignar el permiso");
	$cant_func = count($_REQUEST["idfuncionario"]);
	if ($cant_func) {
		if ($_REQUEST["idcaja"] && $_REQUEST["accion_caja"] == 1) {
			$sql1 = "DELETE FROM entidad_caja WHERE caja_idcaja=" . $_REQUEST["idcaja"] . " AND entidad_identidad=" . $_REQUEST["tipo_entidad"] . " AND llave_entidad NOT IN(" . implode(",", $_REQUEST["idfuncionario"]) . "," . $_REQUEST["propietario"] . ")";
			phpmkr_query($sql1) or die(json_encode($retorno));
			$error = 0;
			$ins = 0;
			foreach ($_REQUEST["idfuncionario"] as $idfunc) {
				$permiso = "";
				if (isset($_REQUEST["permisos_" . $idfunc])) {
					$permiso = implode(",", $_REQUEST["permisos_" . $idfunc]);
				}
				$ok = asignar_caja($_REQUEST["idcaja"], $_REQUEST["tipo_entidad"], $idfunc, $permiso);
				if ($ok === false) {
					$error++;
				} else {
					$ins++;
				}
			}

			if ($error == $cant_func) {
				$retorno["mensaje"] = "Se presentaron errores al asignar la caja, por favor intente de nuevo";
			} elseif ($ins == $cant_func) {
				$retorno["exito"] = 1;
				$retorno["mensaje"] = "Asignaciones realizadas con &eacute;xito";
			} else {
				$retorno["mensaje"] = "Se realizan algunas asignaciones a la caja";
			}
		} else if ($_REQUEST["idcaja"] && $_REQUEST["accion_caja"] == 2) {
			$sql1 = "DELETE FROM entidad_caja WHERE caja_idcaja=" . $_REQUEST["idcaja"] . " AND entidad_identidad=" . $_REQUEST["tipo_entidad"] . " AND llave_entidad IN(" . implode(",", $_REQUEST["idfuncionario"]) . ")";
			phpmkr_query($sql1) or die(json_encode($retorno));
			$retorno["exito"] = 1;
			$retorno["mensaje"] = "Se han eliminado los permiso con &eacute;xito";
		}
	} else if ($_REQUEST["idcaja"] != "" && $_REQUEST["tipo_entidad"] && trim($_REQUEST["idfuncionario_sel"]) == "") {
		$sql1 = "DELETE FROM entidad_caja WHERE caja_idcaja=" . $_REQUEST["idcaja"] . " AND entidad_identidad=" . $_REQUEST["tipo_entidad"];
		phpmkr_query($sql1) or die(json_encode($retorno));
		$retorno["exito"] = 1;
		$retorno["mensaje"] = "Se han eliminado los permiso con &eacute;xito";
	}
	return ($retorno);
}
?>