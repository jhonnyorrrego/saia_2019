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

function creador_documento($idformato, $iddoc, $retorno = 0) {
	global $conn;
	$html = "";
	$func = busca_filtro_tabla("f.nombres,f.apellidos", "funcionario f,documento d", "f.funcionario_codigo=d.ejecutor and d.iddocumento=" . $iddoc, "", $conn);
	if ($func["numcampos"]) {
		$html = ucwords(strtolower($func[0]["nombres"] . " " . $func[0]["apellidos"]));
	}
	if ($retorno) {
		return $html;
	} else {
		echo $html;
	}
}

function creador_documento_rol($idformato, $iddoc, $retorno = 0) {
	global $conn;
	$html = "";
	$formato = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $idformato, "", $conn);
	if ($formato["numcampos"]) {
		$datos = busca_filtro_tabla("v.nombres,v.apellidos,v.dependencia,v.cargo", $formato[0]["nombre_tabla"] . " ft,vfuncionario_dc v", "v.iddependencia_cargo=ft.dependencia and ft.documento_iddocumento=" . $iddoc, "", $conn);
		if ($datos["numcampos"]) {
			$html = ucwords(strtolower($datos[0]["nombres"] . " " . $datos[0]["apellidos"]) . " - " . $datos[0]["dependencia"] . " (" . $datos[0]["cargo"] . ")");
		}
	}
	if ($retorno) {
		return $html;
	} else {
		echo $html;
	}
}

function ver_nombre_empresa($idformato, $iddoc, $retorno = 0) {
	global $conn;
	$html = "";
	$nombre = busca_filtro_tabla("valor", "configuracion", "nombre='nombre'", "", $conn);
	if ($nombre["numcampos"]) {
		$html = $nombre[0]["valor"];
	}
	if ($retorno) {
		return $html;
	} else {
		echo $html;
	}
}

function fecha_creacion($idformato, $iddoc, $retorno = 0) {
	global $conn;
	$html = "";
	$fecha = busca_filtro_tabla(fecha_db_obtener("fecha_creacion", "Y-m-d H:i:s"), "documento", "iddocumento=" . $iddoc, "", $conn);
	if ($fecha["numcampos"]) {
		$html = $fecha[0][0];
	}
	if ($retorno) {
		return $html;
	} else {
		echo $html;
	}
}

function fecha_aprobacion($idformato, $iddoc, $retorno = 0) {
	global $conn;
	$html = "";
	$fecha = busca_filtro_tabla(fecha_db_obtener("fecha", "Y-m-d H:i:s"), "documento", "iddocumento=" . $iddoc, "", $conn);
	if ($fecha["numcampos"]) {
		$html = $fecha[0][0];
	}
	if ($retorno) {
		return $html;
	} else {
		echo $html;
	}
}

function ver_anexos_documento($idformato, $iddoc, $retorno = 0) {
	global $conn, $ruta_db_superior;
	$tipo_almacenamiento = new SaiaStorage("archivos");
	$array_tipos = array(
		'jpg',
		'jpeg',
		'bmp',
		'tif',
		'tiff',
		'pdf',
		'png',
		'gif'
	);
	$html = "";
	$anexos = busca_filtro_tabla("idanexos,ruta,etiqueta,tipo", "anexos", "documento_iddocumento=" . $iddoc, "", $conn);
	if ($anexos["numcampos"]) {
		$fila = array();
		for ($i = 0; $i < $anexos["numcampos"]; $i++) {
			if ($_REQUEST["tipo"] != 5) {
				$target = '';
				if (in_array($anexos[$i]["tipo"], $array_tipos)) {
					$ruta_imagen = json_decode($anexos[$i]['ruta']);
					if (is_object($ruta_imagen)) {
						if ($tipo_almacenamiento -> get_filesystem() -> has($ruta_imagen -> ruta)) {
							$ruta64 = base64_encode($anexos[$i]["ruta"]);
							$href = $ruta_db_superior . "filesystem/mostrar_binario.php?ruta=" . $ruta64;
						}
					}
					$target = 'target="_self"';
				} else {
					$href = $ruta_db_superior . "anexosdigitales/parsea_accion_archivo.php?idanexo=" . $anexos[$i]['idanexos'] . "&accion=descargar";
				}
				$fila[] = '<a href="' . $href . '" ' . $target . '>' . $anexos[$i]['etiqueta'] . '</a>';
			} else {
				$fila[] = $anexos[$i]['etiqueta'];
			}
		}
		$html = "<ul><li>" . implode("</li><li>", $fila) . "</li></ul>";
	}
	if ($retorno) {
		return $html;
	} else {
		echo $html;
	}
}
