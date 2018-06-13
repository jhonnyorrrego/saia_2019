<?php
include ("db.php");
include ("class_transferencia.php");
$tipo_almacenamiento = new SaiaStorage("archivos");

if (@$_REQUEST["id"]) {
	$datos = parsea_idformato($_REQUEST["id"]);
	$formato["numcampos"] = 0;
	if ($datos[0] == "p") {
		if (intval($datos[1])) {
			$datos_pagina = busca_filtro_tabla("", "pagina", "consecutivo=" . $datos[1], "", $conn);
			if ($datos_pagina["numcampos"]) {
				$ruta_pag = $datos_pagina[0]["ruta"];
				$ruta_imagen = json_decode($datos_pagina[0]["ruta"]);
				if (is_object($ruta_imagen)) {
					$ruta_pag = StorageUtils::get_binary_file($ruta_pag);
					echo('<img src="' . $ruta_pag . '">');
				}
			} else {
				alerta("Pagina no encontrada");
			}
		} else {
			$datos_pagina = busca_filtro_tabla("", "pagina", "id_documento=" . $datos[2], "pagina", $conn);
			if ($datos_pagina["numcampos"]) {
				echo('<table border="1" height="100%" width="100%" style="border-collapse:collapse;" valign="top" >');
				for ($i = 0, $j = 0; $i < $datos_pagina["numcampos"]; $i++, $j++) {
					if ($i % 4 == 0) {
						echo('<tr>');
					}

					$ruta_img = $datos_pagina[$i]["imagen"];
					$ruta_imagen = json_decode($datos_pagina[$i]["imagen"]);
					if (is_object($ruta_imagen)) {
						$ruta_img = StorageUtils::get_binary_file($ruta_img);
					}

					echo('<td valign="top" width="25%" align="center" ><span class="phpmaker">Pagina ' . ($i + 1) . '</span><br /><img src="' . $ruta_img . '"></td>');
					if ($i % 4 == 0 && $i != $j) {
						echo('</tr>');
					}
				}
				for ($i; $i % 4 != 0; $i++) {
					echo('<td valign="top" width="25%" align="center">&nbsp;</td>');
				}
				echo('</table>');
			}
		}
	} else {
		$formato = busca_filtro_tabla("", "formato", "idformato=" . $datos[0], "", $conn);
	}
	if ($formato["numcampos"]) {
		$ruta = "";
		$alerta = "existe problema para redireccionar";
		if ($datos[1] && $datos[2]) {
			$datos_formato = busca_filtro_tabla("", $formato[0]["nombre_tabla"], "id" . $formato[0]["nombre_tabla"] . "=" . $datos[2], "", $conn);
		}
		switch($datos[3]) {
			case "mostrar" :
				if ($datos[2]) {
					$ruta = FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $formato[0]["ruta_mostrar"] . "?iddoc=" . $datos_formato[0]["documento_iddocumento"] . "&idformato=" . $formato[0]["idformato"] . "&menu_principal_inactivo=1";
					if (is_file(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $formato[0]["ruta_mostrar"])) {
						redirecciona($ruta);
					} else if (is_file(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/previo_" . $formato[0]["ruta_mostrar"])) {
						redirecciona(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/previo_" . $formato[0]["ruta_mostrar"]);
					}
				}
				break;
		}
		if ($ruta != "") {
			redirecciona($ruta);
		} else {
			alerta($alerta);
			redirecciona("vacio.php");
		}
	}
} else {
	alerta("El formato No se ha podido capturar");
}

function parsea_idformato($id = 0) {
	$arreglo = array();
	if ($id) {
		$arreglo = explode("-", $id);
	} else if ($_REQUEST["id"]) {
		$arreglo = explode("-", $_REQUEST["id"]);
	} else {
		return ($arreglo);
	}
	if ($arreglo[2][0] == "r") {
		$arreglo[2] = 0;
	}
	if ($_REQUEST["accion"]) {
		$arreglo[3] = $_REQUEST["accion"];
	} else {
		$arreglo[3] = "mostrar";
	}
	return ($arreglo);
}
?>