<?php
function transferir_archivo_prueba($datos, $destino, $adicionales) {
	global $conn;
	sort($destino);
	$idarchivo = $datos["archivo_idarchivo"];
	if (!isset($datos["ruta_idruta"]))
		$datos["ruta_idruta"] = "";
	if (array_key_exists("origen", $datos))
		$origen = $datos["origen"];
	else if (@$_SESSION["usuario_actual"])
		$origen = $_SESSION["usuario_actual"];
	else
		$origen = usuario_actual("funcionario_codigo");
	
	
	$doc = busca_filtro_tabla("B.idformato", "documento A,formato B", "A.plantilla=B.nombre AND iddocumento=" . $idarchivo, "", $conn);
	$idformato = @$doc[0]["idformato"];
	llama_funcion_accion($idarchivo, $idformato, "transferir", "ANTERIOR");
	if ($adicionales <> Null && $adicionales <> "" && is_array($adicionales)) {
		$otras_llaves = "," . implode(",", array_keys($adicionales));
		$otros_valores = "," . implode(",", array_values($adicionales));
		if ($otros_valores == ",")
			$otros_valores = ",";
	} else {
		$otras_llaves = "";
		$otros_valores = "";
	}
	if ($destino <> "" && $origen <> "") {
		$values_out = "$idarchivo,'" . $datos["nombre"] . "'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",";
		if ($datos["tipo_destino"] == "1" || $datos["tipo_destino"] == "4" || $datos["tipo_destino"] == "5") {
			$tipo_destino = 1;
			$datos_origen = "";
			if ($datos["tipo_destino"] == "4" && count($destino) == 1) {
				$dependencia = busca_filtro_tabla("d.dependencia_iddependencia as dep", "dependencia_cargo d,funcionario f", "d.funcionario_idfuncionario=f.idfuncionario and f.funcionario_codigo=$origen", "", $conn);
				$datos_destino = busca_cargofuncionario(4, $destino[0], $dependencia[0]["dep"]);
				if ($datos_destino <> "") {
					$destino[0] = $datos_destino[0]["funcionario_codigo"];
				}
			} else if ($datos["tipo_destino"] == "5" && count($destino) == 1) {
				$datos_destino = busca_cargofuncionario(5, $destino[0], "");
				if ($datos_destino <> "") {
					$destino[0] = $datos_destino[0]["funcionario_codigo"];
				}
			}
			if ($datos["ruta_idruta"] == "") {
				$datos["ruta_idruta"] = 0;
			}
			
			$values_out .= "'" . $origen . "',1,1" . $otros_valores . ",'" . @$datos["ver_notas"] . "'";
			foreach ($destino as $user) {
				if ($datos["nombre"] != "POR_APROBAR") {
					$sql = "INSERT INTO buzon_salida (archivo_idarchivo,nombre,fecha,origen,tipo_origen,tipo_destino" . $otras_llaves . ",ver_notas,destino) values (" . $values_out . "," . $user . ")";
					phpmkr_query($sql, $conn);
				}
				if ($datos["nombre"] == "POR_APROBAR") {
					$sql = "INSERT INTO ruta(origen,tipo,destino,idtipo_documental,condicion_transferencia,documento_iddocumento,tipo_origen,tipo_destino,obligatorio) VALUES(" . $origen . ",'ACTIVO'," . $user . ",NULL,'POR_APROBAR'," . $idarchivo . ",1,1,1)";
					phpmkr_query($sql, $conn) or error("No se puede Generar una Ruta");
					$idruta = phpmkr_insert_id();
					$datos["ruta_idruta"] = $idruta;
				}
				$values_in = "$idarchivo,'" . $datos["nombre"] . "'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",'$origen',1," . $datos["ruta_idruta"] . ",$tipo_destino" . $otros_valores . ",'" . @$datos["ver_notas"] . "'";
				$sql = "INSERT INTO buzon_entrada(archivo_idarchivo,nombre,fecha,destino,tipo_origen,ruta_idruta,tipo_destino" . $otras_llaves . ",ver_notas,origen) values(" . $values_in . "," . $user . ")";
				phpmkr_query($sql, $conn);
				procesar_estados($origen, $user, $datos["nombre"], $idarchivo);
			}
		} else if ($datos["tipo_destino"] == "2") {
			if ($datos["nombre"] != "POR_APROBAR")
				$destinos = buscar_funcionarios(str_replace("#", "", $fila), $destino);
			for ($i = 0; $i < count($destinos); $i++) {//buzon de entrada
				$values = "$idarchivo,'" . $datos["nombre"] . "'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",$origen," . $destinos[$i] . ",1,1" . $otros_valores . ",'" . @$datos["ver_notas"] . "'";
				$values1 = "$idarchivo,'" . $datos["nombre"] . "'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . "," . $destinos[$i] . ",$origen,1,1" . $otros_valores;
				
				$enlace = busca_filtro_tabla("descripcion", "documento", "iddocumento=$idarchivo", "", $conn);
				$enlace = $enlace[0]["descripcion"];
				$sql = "INSERT INTO buzon_entrada(archivo_idarchivo,nombre,fecha,destino,origen,tipo_origen,tipo_destino" . $otras_llaves . ",ver_notas) values(" . $values . ")";
				phpmkr_query($sql, $conn);
				
				$sql = "INSERT INTO buzon_salida(archivo_idarchivo,nombre,fecha,origen,destino,tipo_origen,tipo_destino" . $otras_llaves . ") values(" . $values1 . ")";
				phpmkr_query($sql, $conn);
			}
		} else {
			$values = "$idarchivo,'" . $datos["nombre"] . "'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",$origen,$destino,$tipo_origen,$tipo_destino" . $otros_valores . ",'" . @$datos["ver_notas"] . "'";
			$sql = "insert into buzon_entrada(archivo_idarchivo,nombre,fecha,destino,origen,tipo_origen,tipo_destino" . $otras_llaves . ",ver_notas) values (" . $values . ")";
			phpmkr_query($sql, $conn);
		}
	}
	
	llama_funcion_accion($idarchivo, $idformato, "transferir", "POSTERIOR");
	return (TRUE);
}
