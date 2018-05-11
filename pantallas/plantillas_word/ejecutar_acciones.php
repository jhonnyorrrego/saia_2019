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

function add_plantilla_word() {
	global $ruta_db_superior;
	$retorno = array(
		"exito" => 0,
		"msn" => ""
	);
	$ok = 1;
	if (is_uploaded_file($_FILES["anexo"]["tmp_name"])) {
		$nombre = basename($_FILES["anexo"]["name"]);
		$archivo = uniqid() . "_" . $nombre;
		$almacenamiento = new SaiaStorage("plantilla_word");
		$resultado = $almacenamiento -> copiar_contenido_externo($_FILES['anexo']['tmp_name'], $archivo);
		@unlink($_FILES["anexo"]["tmp_name"]);
		if ($resultado) {
			$dir_anexo = array(
				"servidor" => $almacenamiento -> get_ruta_servidor(),
				"ruta" => $archivo
			);
			$ruta_anexo = json_encode($dir_anexo);
		} else {
			$ok = 0;
			$retorno["msn"] = "No es posible procesar el archivo " . $_FILES["anexo"]["tmp_name"] . " posible error al tratar de guardar: " . $nombre;
		}
	}
	if ($ok) {
		$retorno["msn"] = "Error al guardar la plantilla";
		$insert = "INSERT INTO plantilla_word (nombre,descripcion,ruta_anexo,funcionario_idfuncionario,estado)	VALUES ('" . htmlentities($_REQUEST["nombre"]) . "','" . htmlentities($_REQUEST["descripcion"]) . "','" . $ruta_anexo . "'," . $_SESSION["idfuncionario"] . "," . $_REQUEST["estado"] . ")";
		phpmkr_query($insert) or die(json_encode($retorno));
		$retorno["exito"] = 1;
		$retorno["msn"] = "";
		if ($_REQUEST["retorno"]) {
			echo json_encode($retorno);
		} else {
			notificaciones("Datos Guardados!", "success", 4000);
			abrir_url($ruta_db_superior . "pantallas/plantillas_word/", "_self");
		}
	} else {
		if ($_REQUEST["retorno"]) {
			echo json_encode($retorno);
		} else {
			notificaciones($retorno["msn"], "error", 4000);
			abrir_url($ruta_db_superior . "pantallas/plantillas_word/", "_self");
		}
	}

}

function edit_plantilla_word() {
	global $ruta_db_superior;
	$retorno = array(
		"exito" => 0,
		"msn" => ""
	);
	if ($_REQUEST["id"]) {
		$almacenamiento = new SaiaStorage("plantilla_word");
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

				$dir_anexo = array(
					"servidor" => $almacenamiento -> get_ruta_servidor(),
					"ruta" => $archivo
				);
				$ruta_anexo = json_encode($dir_anexo);
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

if (isset($_REQUEST["accion"])) {
	$_REQUEST["accion"]();
}
