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
if (!$_SESSION["LOGIN" . LLAVE_SAIA]) {
	logear_funcionario_webservice("radicador_web");
}
include_once ($ruta_db_superior . 'pantallas/lib/librerias_cripto.php');
include_once ($ruta_db_superior . 'formatos/librerias/funciones_generales.php');

function generar_html_info_qr($datos) {
	global $conn, $ruta_db_superior;
	$datos = json_decode($datos, true);
	$retorno = array();
	$retorno['exito'] = 0;

	$_REQUEST['key_cripto'] = $datos;
	$datos_decrypt = request_encriptado('key_cripto');
	$iddoc = intval($datos_decrypt['id']);
	if (!is_numeric($iddoc)) {
		session_destroy();
		return (json_encode($retorno));
	} else {
		$documento = busca_filtro_tabla("", "documento A", "A.iddocumento=" . $iddoc, "", $conn);
		if ($documento["numcampos"]) {

			$retorno["info_tabla"]["N&uacute;mero_de_radicado"] = $documento[0]["numero"];
			$retorno["info_tabla"]["Estado_del_documento"] = $documento[0]["estado"];
			if (is_object($documento[0]["fecha"])) {
				$documento[0]["fecha"] = $documento[0]["fecha"] -> format("Y-m-d H:i:s");
			}
			$retorno["info_tabla"]["Fecha_de_aprobaci&oacute;n"] = $documento[0]["fecha"];
			if (is_object($documento[0]["fecha_creacion"])) {
				$documento[0]["fecha_creacion"] = $documento[0]["fecha_creacion"] -> format("Y-m-d H:i:s");
			}
			$retorno["info_tabla"]["Fecha_de_creaci&oacute;n"] = $documento[0]["fecha_creacion"];
			$creador = busca_filtro_tabla("nombres,apellidos", "funcionario", "funcionario_codigo=" . $documento[0]["ejecutor"], "", $conn);
			if ($creador["numcampos"]) {
				$retorno["info_tabla"]["Creador_del_documento"] = $creador[0]["nombres"] . " " . $creador[0]["apellidos"];
			}
			$conf = busca_filtro_tabla("valor", "configuracion", "nombre='nombre' and tipo='empresa'", "", $conn);
			if ($conf["numcampos"]) {
				$retorno["title"] = $conf[0]["valor"];
			}
			$logo = busca_filtro_tabla("valor", "configuracion", "nombre='logo' and tipo='empresa'", "", $conn);
			if ($logo["numcampos"]) {
				$path = $ruta_db_superior . $logo[0]["valor"];
				if (is_file($path)) {
					$type = pathinfo($path, PATHINFO_EXTENSION);
					$data = file_get_contents($path);
					$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
					$retorno["logo"] = $base64;
				}
			}
			$conf_color = busca_filtro_tabla("valor", "configuracion", "nombre='barra_inferior' and tipo='temas_main'", "", $conn);
			if ($conf_color["numcampos"]) {
				$retorno["color_saia"] = $conf_color[0]["valor"];
			}

			$formato = busca_filtro_tabla("", "formato A", "A.nombre='" . strtolower($documento[0]["plantilla"]) . "'", "", $conn);
			if ($formato["numcampos"]) {
				$retorno["title"] .= " - " . $formato[0]["etiqueta"];
				$campos_descrip = busca_filtro_tabla("idcampos_formato,nombre,etiqueta,formato_idformato", "campos_formato cf", "cf.formato_idformato='" . $formato[0]["idformato"] . "' AND (acciones like 'p' or acciones like '%,p' or acciones like 'p,%' or acciones like '%,p,%')", "", $conn);
				if ($campos_descrip["numcampos"]) {
					for ($i = 0; $i < $campos_descrip["numcampos"]; $i++) {
						$etiqueta = str_replace(" ", "_", $campos_descrip[$i]["etiqueta"]);
						$retorno["info_tabla"][$etiqueta] = mostrar_valor_campo($campos_descrip[$i]["nombre"], $campos_descrip[$i]["formato_idformato"], $iddoc, 1);
					}
				}
			}
			$retorno["exito"] = 1;
		}
	}
	session_destroy();
	return (json_encode($retorno));
}

session_destroy();
?>