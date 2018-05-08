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
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "pantallas/manuales/librerias.php");

function add_manual() {
	global $ruta_db_superior;
	$retorno = array(
		"exito" => 0,
		"msn" => ""
	);
	$ok = 1;
	if ($_REQUEST["agrupador"] == 0 && is_uploaded_file($_FILES["anexo"]["tmp_name"])) {
		$nombre = basename($_FILES["anexo"]["name"]);
		$archivo = uniqid() . "_" . $nombre;
		$almacenamiento = new SaiaStorage("ayuda");
		$resultado = $almacenamiento -> copiar_contenido_externo($_FILES['anexo']['tmp_name'], $archivo);
		@unlink($_FILES["anexo"]["tmp_name"]);
		if ($resultado) {
			$dir_ayuda = array(
				"servidor" => $almacenamiento -> get_ruta_servidor(),
				"ruta" => $archivo
			);
			$ruta_anexo = json_encode($dir_ayuda);
		} else {
			$ok = 0;
			$retorno["msn"] = "No es posible procesar el archivo " . $_FILES["anexo"]["tmp_name"] . " posible error al tratar de guardar: " . $nombre;
		}
	} else if ($_REQUEST["agrupador"] == 1) {
		$_REQUEST["descripcion"] = "-";
		$ruta_anexo = "";
	}
	if ($ok) {
		$retorno["msn"] = "Error al guardar el manual";
		$insert = "INSERT INTO manual (etiqueta,descripcion,agrupador,ruta_anexo,cod_padre,funcionario_idfuncionario,estado)	VALUES ('" . htmlentities($_REQUEST["nombre"]) . "','" . htmlentities($_REQUEST["descripcion"]) . "'," . $_REQUEST["agrupador"] . ",'" . $ruta_anexo . "'," . $_REQUEST["cod_padre"] . "," . $_SESSION["idfuncionario"] . ",1)";
		phpmkr_query($insert) or die(json_encode($retorno));
		$retorno["exito"] = 1;
		$retorno["msn"] = "";
		if ($_REQUEST["retorno"]) {
			echo json_encode($retorno);
		} else {
			notificaciones("Datos Guardados!", "success", 4000);
			abrir_url($ruta_db_superior . "pantallas/manuales/", "_self");
		}
	} else {
		if ($_REQUEST["retorno"]) {
			echo json_encode($retorno);
		} else {
			notificaciones($retorno["msn"], "error", 4000);
			abrir_url($ruta_db_superior . "pantallas/manuales/", "_self");
		}
	}

}

function edit_manual() {
	global $ruta_db_superior;
	$retorno = array(
		"exito" => 0,
		"msn" => ""
	);
	if ($_REQUEST["idmanual"]) {
		$almacenamiento = new SaiaStorage("ayuda");
		$ruta_anexo = base64_decode($_REQUEST["ruta_anexo"]);
		if (is_uploaded_file($_FILES["anexo"]["tmp_name"])) {
			$nombre = basename($_FILES["anexo"]["name"]);
			$archivo = uniqid() . "_" . $nombre;
			$resultado = $almacenamiento -> copiar_contenido_externo($_FILES['anexo']['tmp_name'], $archivo);
			@unlink($_FILES["anexo"]["tmp_name"]);
			if ($resultado) {
				$archivo_del = json_decode($ruta_anexo, true);
				if ($archivo_del["ruta"] != "") {
					$delete = $almacenamiento -> eliminar($archivo_del["ruta"]);
				}

				$dir_ayuda = array(
					"servidor" => $almacenamiento -> get_ruta_servidor(),
					"ruta" => $archivo
				);
				$ruta_anexo = json_encode($dir_ayuda);
			}
		}
		if ($_REQUEST["agrupador"] == 1) {
			$_REQUEST["descripcion"] = "-";
			$archivo_del = json_decode($ruta_anexo, true);
			if ($archivo_del["ruta"] != "") {
				$delete = $almacenamiento -> eliminar($archivo_del["ruta"]);
			}
			$ruta_anexo = "";
		}
		$retorno["msn"] = "Error al actualizar el manual";
		$update = "UPDATE manual SET etiqueta='" . htmlentities($_REQUEST["nombre"]) . "',descripcion='" . htmlentities($_REQUEST["descripcion"]) . "',agrupador=" . $_REQUEST["agrupador"] . ",ruta_anexo='" . $ruta_anexo . "',cod_padre=" . $_REQUEST["cod_padre"] . ",estado=" . $_REQUEST["estado"] . " WHERE idmanual=" . $_REQUEST["idmanual"];
		phpmkr_query($update) or die(json_encode($retorno));
		$retorno["exito"] = 1;
		$retorno["msn"] = "";
		if ($_REQUEST["retorno"]) {
			echo json_encode($retorno);
		} else {
			notificaciones("Datos actualizados!", "success", 4000);
			echo "<script>parent.refrescar_panel_kaiten()</script>";
		}
	}
}

if (isset($_REQUEST["accion_manual"])) {
	$_REQUEST["accion_manual"]();
}
