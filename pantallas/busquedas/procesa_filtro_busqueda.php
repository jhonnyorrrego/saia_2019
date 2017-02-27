<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "sql.php");
usuario_actual("login");

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
desencriptar_sqli('form_info');

$filtro = '';
$idbusqueda_temp = '';
$retorno = array();
$retorno["exito"] = 0;
$retorno["mensaje"] = "Existe un error al tratar de procesar la b&uacute;squeda";
if (@$_REQUEST["idbusqueda_componente"]) {
	$cadena_adicional = '';
	if (@$_REQUEST["adicionar_consulta"]) {
		$arreglo = array();
		$consulta_adicional = campos_especiales();
		$componente = busca_filtro_tabla("", "busqueda_componente a", "a.idbusqueda_componente=" . $_REQUEST["idbusqueda_componente"], "", $conn);
		if ($componente["numcampos"] && $componente[0]["nombre"] == 'listado_documentos') {
			$arreglo_sub = array();
			$conta = 0;
			$datos = '';
			foreach ( $_REQUEST as $key => $valor ) {
				$entra = strpos($key, "subsaia_");
				if ($entra !== FALSE && $valor != '') {
					$conta++;
					$datos .= parsear_subconsulta($key, $valor, $cantidad_campos);
					if (($conta % 2) == 0) {
						$datos2 = " iddocumento in(select archivo_idarchivo from buzon_salida z where " . $datos . ")";
						array_push($arreglo_sub, $datos2);
						$datos = '';
					}
				}
			}
			$cadena_adicional = implode(" and ", $arreglo_sub);
			$cadena_adicional = limpiar_cadena($cadena_adicional);
		}
		// Todos los componentes que se deben considerar en el request como componentes o criterios de busqueda para el filtro deben tener el prefijo bqsaia_
		$cantidad_campos = 0;
		foreach ( $_REQUEST as $key => $valor ) {
			$entra = strpos($key, "bqsaia_");
			if ($entra !== FALSE && $valor != '') {
				$cantidad_campos++;
			}
		}
		foreach ( $_REQUEST as $key => $valor ) {
			$entra = strpos($key, "bqsaia_");
			if ($entra !== FALSE && $valor != '') {
				$contador_campos++;
				$cadena = parsear_cadena_temporal($key, $valor, $cantidad_campos);
				array_push($arreglo, $cadena);
			}
		}
		$cadena = implode("", $arreglo);
		if ($cadena_adicional == '')
			$cadena = limpiar_cadena($cadena);
		if (count($arreglo) || count($arreglo_sub)) {
			$cadena = str_replace("@", ".", $cadena);
			$cadena_adicional = str_replace("@", ".", $cadena_adicional);
			
			if (($cadena || $consulta_adicional) && $cadena_adicional) {
				$cadena_adicional = " and " . $cadena_adicional;
			}
			if ($cadena && $consulta_adicional && ($componente[0]["nombre"] == "todos_documentos" || $componente[0]["nombre"] == "listado_documentos")) {
				$consulta_adicional = " and " . $consulta_adicional;
			}
			if (MOTOR == "Oracle") {
				$sql2 = "INSERT INTO busqueda_filtro_temp(fk_busqueda_componente,funcionario_idfuncionario,fecha) VALUES(" . $_REQUEST["idbusqueda_componente"] . "," . usuario_actual("idfuncionario") . "," . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . ")";
				$conn->Ejecutar_Sql($sql2);
				$idbusqueda_temp = $conn->Ultimo_Insert();
				guardar_lob2('detalle', 'busqueda_filtro_temp', 'idbusqueda_filtro_temp=' . $idbusqueda_temp, str_replace("''", "'", $cadena . $consulta_adicional . $cadena_adicional), "texto", $conn);
			} else {
				$sql2 = "INSERT INTO busqueda_filtro_temp(fk_busqueda_componente,funcionario_idfuncionario,detalle,fecha) VALUES(" . $_REQUEST["idbusqueda_componente"] . "," . usuario_actual("idfuncionario") . ",'" . $cadena . $consulta_adicional . $cadena_adicional . "'," . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . ")";
				$conn->Ejecutar_Sql($sql2);
				$idbusqueda_temp = $conn->Ultimo_Insert();
			}
			
			$idbusqueda_fil = filtros_adicionales();
		}
	} else if (@$_REQUEST["idbusqueda_filtro"]) {
		$filtro = "&idbusqueda_filtro=" . $_REQUEST["idbusqueda_filtro"];
	} else if (@$_REQUEST['idbusqueda_filtro_temp']) {
		if ($idbusqueda_temp != '')
			$idbusqueda_temp .= "," . $_REQUEST['idbusqueda_filtro_temp'];
		else
			$idbusqueda_temp = $_REQUEST['idbusqueda_filtro_temp'];
	}
	if ($idbusqueda_fil) {
		$filtro .= "&idbusqueda_temporal=" . $idbusqueda_fil;
	}
	if ($componente[0]["url"]) {
		if (strpos($componente[0]["url"], "?")) {
			$componente[0]["url"] .= '&';
		} else {
			$componente[0]["url"] .= '?';
		}
		$url = $componente[0]["url"] . "idbusqueda_componente=" . $_REQUEST["idbusqueda_componente"] . "&idbusqueda_filtro_temp=" . $idbusqueda_temp . $filtro;
	} elseif ($componente[0]["ruta_visualizacion"]) {
		if (strpos($componente[0]["ruta_visualizacion"], "?")) {
			$componente[0]["ruta_visualizacion"] .= '&';
		} else {
			$componente[0]["ruta_visualizacion"] .= '?';
		}
		$url = $componente[0]["ruta_visualizacion"] . "idbusqueda_componente=" . $_REQUEST["idbusqueda_componente"] . "&idbusqueda_filtro_temp=" . $idbusqueda_temp . $filtro;
	} else {
		$url = "pantallas/busquedas/consulta_busqueda.php?idbusqueda_componente=" . $_REQUEST["idbusqueda_componente"] . "&idbusqueda_filtro_temp=" . $idbusqueda_temp . $filtro;
	}
	if (@$_REQUEST["variable_busqueda"] != "") {
		$url .= "&variable_busqueda=" . $_REQUEST['variable_busqueda'];
	}
	// Procesar parametros adicionales
	if (@$_REQUEST["parametros_adicionales_buscador"]) {
		$complemento = explode("|", $_REQUEST["parametros_adicionales_buscador"]);
		foreach ( $complemento as $key => $valor ) {
			$complemento2 = explode("@", $valor);
			$url .= "&" . $complemento2[0] . "=" . $complemento2[1];
		}
	}
	
	$retorno["exito"] = 1;
	$retorno["url"] = $url;
	$retorno["filtro"] = "&idbusqueda_filtro_temp=" . $idbusqueda_temp . $filtro;
	$retorno["mensaje"] = 'Filtro procesado con exito';
} else {
	$retorno["exito"] = 0;
	$retoro["mensaje"] = "Existe un problema con la identificaci&oacuete;n de su componente de b&uacute;squeda";
}
echo (json_encode($retorno));

// $url="pantallas/busquedas/consulta_busqueda.php?idbusqueda_componente=".$_REQUEST["idbusqueda_componente"]."&idbusqueda_filtro_temp=".$idbusqueda_temp.$filtro;
// redirecciona($ruta_db_superior.$url);

function parsear_cadena_temporal($key, $valor, $contador_campos) {
	$key = str_replace("bqsaia_", "", $key);
	$valor = str_replace("@", "%", $valor); // Cuando quieren buscar una cadena con @ no estaba buscando, esto soluciona el problema
	$valor = parsear_cadena_tildes($valor);
	$req_condicion_llave = $_REQUEST["bksaiacondicion_" . $key];
	$cadena = parsear_consulta($key, $valor, $req_condicion_llave);
	$enlace = @$_REQUEST["bqsaiaenlace_" . $key];
	$conector = '';
	if ($enlace) {
		switch ($enlace) {
			case 'y' :
				$conector = '|+|';
				break;
			case 'o' :
				$conector = '|-|';
				break;
		}
	}
	if ($contador_campos > 1 && $conector == '') {
		$conector = '|+|';
	}
	$cadena = str_replace("_x", "", $cadena);
	$cadena = str_replace("_y", "", $cadena);
	return $cadena . $conector;
}

function limpiar_cadena($cadena) {
	$cadena_aux = substr($cadena, -3);
	$tamano = strlen($cadena);
	if ($cadena_aux == '|+|' || $cadena_aux == '|-|') {
		$cadena = substr($cadena, 0, ($tamano - 3));
	}
	return $cadena;
}

function valor_dato($campo, $valor) {
	$valor = "'" . $valor . "'";
	$bqtipodato = array();
	$bqtipodato_plantilla = array();
	if ($_REQUEST["bqtipodato"]) {
		$bqtipodato = explode(",", str_replace("date|", "", @$_REQUEST["bqtipodato"]));
	}
	if ($_REQUEST["bqtipodato_plantilla"]) {
		$bqtipodato_plantilla = explode(",", str_replace("date|", "", @$_REQUEST["bqtipodato_plantilla"]));
	}
	$date = array_merge($bqtipodato, $bqtipodato_plantilla);
	$cant_date = count($date);
	$datetime = explode(",", str_replace("datetime|", "", @$_REQUEST["bqtipodato"]));
	$cant_datetime = count($date);
	$retorno_ = False;
	if ($cant_date > 0) {
		if (in_array($campo, $date)) {
			if (MOTOR == "Oracle") {
				$retorno_ = $valor;
			} else {
				$retorno_ = $valor;
			}
		}
	} else if ($cant_datetime > 0) {
		if (in_array($campo, $datetime)) {
			if (MOTOR == "Oracle") {
				$retorno_ = $valor;
			} else {
				$retorno_ = $valor;
			}
		}
	}
	if (MOTOR == "MySql") {
		$retorno = addslashes($retorno_);
	} else if (MOTOR == "Oracle") {
		$retorno = ($retorno_);
	} else if (MOTOR == "SqlServer") {
		$retorno = ($retorno_);
	} else {
		$retorno = ($retorno_);
	}
	
	if ($retorno_ != '')
		return htmlentities(utf8_decode($retorno));
	else {
		return false;
	}
}

function filtros_adicionales() {
	global $conn;
	if (@$_REQUEST["filtro_adicional"]) {
		$datos = $_REQUEST["filtro_adicional"];
		$idbusqueda_componente = $_REQUEST["idbusqueda_componente"];
		$usuario = usuario_actual("idfuncionario");
		$fecha = fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s");
		$valores = explode("@", $datos);
		if (MOTOR == "MySql") {
			$tablas = stripslashes($valores[0]);
			$where = stripslashes($valores[1]);
		} else if (MOTOR == "Oracle") {
			$tablas = str_replace("'", "''", $valores[0]);
			$where = $valores[1];
		} else {
			$tablas = stripslashes($valores[0]);
			$where = stripslashes($valores[1]);
		}
		$sql1 = "INSERT INTO busqueda_filtro (fk_busqueda_componente, funcionario_idfuncionario, tabla_adicional, where_adicional) VALUES (" . $idbusqueda_componente . "," . $usuario . ",'" . $tablas . "','" . $where . "')";
		$conn->Ejecutar_Sql($sql1);
		$idbusqueda = $conn->Ultimo_Insert();
		return $idbusqueda;
	}
}

function campos_especiales() {
	global $conn, $ruta_db_superior;
	if (@$_REQUEST["campos_especiales"]) {
		$campos = explode(",", $_REQUEST["campos_especiales"]);
		$cantidad = count($campos);
		$retorno = array();
		$a = 0;
		for($i = 0; $i < $cantidad; $i++) {
			$documentos = array();
			$tipo = explode("@", $campos[$i]);
			if (!isset($tipo[2])) {
				$alias = "g.";
				$tipo[2] = "g@";
			} else {
				$alias = $tipo[2] . ".";
				$tipo[2] = $tipo[2] . "@";
			}
			if ($tipo[1] == "arbol") {
				if (!isset($_REQUEST[$tipo[2] . $tipo[0]])) {
					$_REQUEST[$tipo[2] . $tipo[0]] = $_REQUEST[$tipo[0]]; // utilizado para los reportes
				}
				if ($_REQUEST[$tipo[2] . $tipo[0]] != "") {
					$tipo[0] = strtolower($tipo[0]);
					$valor_campo = $_REQUEST[$tipo[2] . $tipo[0]];
					$varios = explode(",", $valor_campo);
					$cuantos = count($varios);
					$cadena = array();
					for($j = 0; $j < $cuantos; $j++) {
						if ($varios[$j]) {
							$cadena[] = "(" . $alias . $tipo[0] . "|like|''" . $varios[$j] . "''|-|" . $alias . $tipo[0] . "|like|''%," . $varios[$j] . "''|-|" . $alias . $tipo[0] . "|like|''" . $varios[$j] . ",%''|-|" . $alias . $tipo[0] . "|like|''%," . $varios[$j] . ",%'')";
						}
					}
					$cantidad_cadena = count($cadena);
					if ($cantidad_cadena)
						$retorno[$a] = "(" . implode("|-|", $cadena) . ")";
					else {
						$retorno[$a] = "(" . $alias . $tipo[0] . "|like|''0'')";
					}
				}
			} else if ($tipo[1] == "ejecutor") {
				if ($_REQUEST[$tipo[2] . $tipo[0] . "-nombre"] != '' || $_REQUEST[$tipo[2] . $tipo[0] . "-identificacion"] != '' || $_REQUEST[$tipo[2] . $tipo[0] . "-empresa"] != '') {
					$tipo[0] = strtolower($tipo[0]);
					$valor_campo1 = $_REQUEST[$tipo[2] . $tipo[0] . "-nombre"];
					$valor_campo2 = $_REQUEST[$tipo[2] . $tipo[0] . "-identificacion"];
					$valor_campo3 = $_REQUEST[$tipo[2] . $tipo[0] . "-empresa"];
					$varios = explode(",", $valor_campo1);
					$varios2 = explode(",", $valor_campo2);
					$varios3 = explode(",", $valor_campo3);
					$cuantos = count($varios);
					$cuantos2 = count($varios2);
					$cuantos3 = count($varios3);
					$cadena = array();
					$where = array();
					for($j = 0; $j < $cuantos; $j++) {
						if ($varios[$j] != '') {
							$where[] = "lower(a.nombre) like '%" . str_replace(" ", "%", strtolower(parsear_cadena_tildes($varios[$j]))) . "%'";
						}
					}
					for($j = 0; $j < $cuantos2; $j++) {
						if ($varios2[$j] != '') {
							$where[] = "lower(a.identificacion) like '%" . str_replace(" ", "%", strtolower(parsear_cadena_tildes($varios2[$j]))) . "%'";
						}
					}
					for($j = 0; $j < $cuantos3; $j++) {
						if ($varios3[$j] != '') {
							$where[] = "lower(b.empresa) like '%" . str_replace(" ", "%", strtolower(parsear_cadena_tildes($varios3[$j]))) . "%'";
						}
					}
					$datos_ejecutor = busca_filtro_tabla("distinct iddatos_ejecutor", "ejecutor a, datos_ejecutor b", "a.idejecutor=b.ejecutor_idejecutor and (" . implode(" and ", $where) . ")", "", $conn);
					
					for($k = 0; $k < $datos_ejecutor["numcampos"]; $k++) {
						$cadena[] = "(" . $alias . $tipo[0] . "|like|''" . $datos_ejecutor[$k]["iddatos_ejecutor"] . "''|-|" . $alias . $tipo[0] . "|like|''%," . $datos_ejecutor[$k]["iddatos_ejecutor"] . "''|-|" . $alias . $tipo[0] . "|like|''" . $datos_ejecutor[$k]["iddatos_ejecutor"] . ",%''|-|" . $alias . $tipo[0] . "|like|''%," . $datos_ejecutor[$k]["iddatos_ejecutor"] . ",%'')";
					}
					$cantidad_cadena = count($cadena);
					if ($cantidad_cadena)
						$retorno[$a] = "(" . implode("|-|", $cadena) . ")";
					else {
						$retorno[$a] = "(" . $alias . $tipo[0] . "|like|''0'')";
					}
				}
			}
			$a++;
		}
		$cant = count($retorno);
		if ($cant)
			return " " . implode("|+|", $retorno);
	}
}

function realizar_consulta() {
	global $conn, $ruta_db_superior;
	$tablas = array();
	$datos_busqueda = busca_filtro_tabla("", "busqueda A, busqueda_componente B", "A.idbusqueda=B.busqueda_idbusqueda AND B.idbusqueda_componente=" . @$_REQUEST["idbusqueda_componente"], "orden", $conn);
	if ($datos_busqueda[0]["tablas"] != '' && $datos_busqueda[0]["tablas_adicionales"] != '') {
		$datos_busqueda[0]["tablas"] = $datos_busqueda[0]["tablas"] . "," . $datos_busqueda[0]["tablas_adicionales"];
	}
	if ($datos_busqueda[0]["campos"] != '' && $datos_busqueda[0]["campos_adicionales"] != '') {
		$datos_busqueda[0]["campos"] = $datos_busqueda[0]["campos"] . "," . $datos_busqueda[0]["campos_adicionales"];
	}
	$campos = $datos_busqueda[0]["campos"];
	if ($datos_busqueda[0]["campos_adicionales"] != '') {
		$campos .= "," . $datos_busqueda[0]["campos_adicionales"];
	}
	$campos .= "," . $datos_busqueda[0]["llave"];
	$tablas = explode(",", $datos_busqueda[0]["tablas"]);
	$condicion = crear_condicion_sql($datos_busqueda[0]["idbusqueda"], $datos_busqueda[0]["idbusqueda_componente"], @$filtro);
	$tablas_consulta = strtolower(implode(",", array_unique($tablas)));
	$campos2 = explode(",", $campos);
	foreach ( $campos2 as $valor ) {
		$as = strpos(strtolower($valor), " as ");
		if ($as !== false) {
			$agrupacion[] = substr($valor, 0, ($as));
			continue;
		}
		$agrupacion[] = $valor;
	}
	$agrupar_consulta = $datos_busqueda[0]["agrupado_por"];
	if ($agrupar_consulta != "") {
		// $ordenar_consulta.=" GROUP BY ".implode(",",$agrupacion);
	}
	$funciones_condicion = parsear_datos_plantilla_visual($condicion);
	if ($datos_busqueda[0]["ruta_libreria"]) {
		$librerias = array_unique(explode(",", $datos_busqueda[0]["ruta_libreria"]));
		array_walk($librerias, "incluir_librerias_busqueda");
	}
	foreach ( $funciones_condicion as $key => $valor ) {
		unset($valor_variables);
		$valor_variables = array();
		$funcion = explode("@", $valor);
		$variables = explode(",", $funcion[1]);
		$cant_variables = count($variables);
		for($h = 0; $h < $cant_variables; $h++) {
			if (@$variables_final[$variables[$h]])
				array_push($valor_variables, $variables_final[$variables[$h]]);
			else
				array_push($valor_variables, $variables[$h]);
		}
		$resultado = call_user_func_array($funcion[0], $valor_variables);
		$condicion = str_replace("{*" . $valor . "*}", $resultado, $condicion);
	}
	if ($datos_busqueda[0]["ordenado_por"]) {
		$sidx = $datos_busqueda[0]["ordenado_por"];
		if (!$sord) {
			$sord = " DESC ";
		}
	}
	if ($sidx && $sord) {
		if ($datos_busqueda[0]["direccion"] != '') {
			$sord = $datos_busqueda[0]["direccion"];
		}
		$ordenar_consulta .= $sidx . " " . $sord;
	}
	$condicion = strtolower($condicion);
	$ordenar_consulta = strtolower($ordenar_consulta);
	return array(
			$tablas_consulta,
			$condicion,
			$ordenar_consulta 
	);
}

function crear_condicion_sql($idbusqueda, $idcomponente, $filtros = '') {
	global $conn;
	$condicion_filtro = '';
	$datos_condicion = busca_filtro_tabla("", "busqueda_condicion_enlace A, busqueda_condicion B", "B.idbusqueda_condicion=A.fk_busqueda_condicion AND (B.fk_busqueda_componente=" . $idcomponente . " or B.busqueda_idbusqueda=" . $idbusqueda . ") AND cod_padre IS NULL " . $condicion_filtro, "orden", $conn);
	if (!$datos_condicion["numcampos"]) {
		$datos_condicion = busca_filtro_tabla("", "busqueda_condicion B", "B.fk_busqueda_componente=" . $idcomponente . " or B.busqueda_idbusqueda=" . $idbusqueda . $condicion_filtro, "", $conn);
		$condicion = $datos_condicion[0]["codigo_where"];
	} else {
		if ($filtros != '') {
			$condicion_filtro = "AND (A.estado=1 OR (A.estado=2 AND A.condicion_idcondicion IN(" . $filtros . ")))";
		} else
			$condicion_filtro = " AND estado=1 ";
		for($i = 0; $i < $datos_condicion["numcampos"]; $i++) {
			if (@$datos_condicion[$i]["comparacion"] == '') {
				$datos_condicion[$i]["comparacion"] = "AND";
			}
			if (@$datos_condicion[$i]["fk_busqueda_condicion"]) {
				if ($i > 0)
					$condicion .= " " . $datos_condicion[$i]["comparacion"] . " ";
				$condicion .= $datos_condicion[$i]["codigo_where"];
			}
		}
	}
	if ($condicion == "") {
		if (@$_REQUEST["condicion_adicional"]) {
			$condicion = $_REQUEST["condicion_adicional"];
		} else {
			$condicion = ' 1=1 ';
		}
		return ('(' . $condicion . ')');
	}
	if (@$_REQUEST["condicion_adicional"]) {
		$condicion .= $_REQUEST["condicion_adicional"];
	}
	return ('(' . $condicion . ')');
}

function parsear_datos_plantilla_visual($cadena, $campos = array()) {
	$result = preg_match_all('({\*([a-z]+[0-9]*[_]*[a-z]*[0-9]*[.]*[,]*[@]*)+\*})', $cadena, $resultado);
	if ($result !== FALSE) {
		$patrones = str_replace(array(
				"{*",
				"*}" 
		), "", $resultado[0]);
		if ($campos) {
			$listado_campos = array_unique(explode(",", $campos));
			$listado_funciones = array_diff($patrones, $listado_campos);
		} else {
			$listado_funciones = $patrones;
		}
	}
	return ($listado_funciones);
}

function incluir_librerias_busqueda($elemento, $indice) {
	global $ruta_db_superior;
	include_once ($ruta_db_superior . $elemento);
}

function parsear_subconsulta($key, $valor, $contador_campos) {
	$key = str_replace("subsaia_", "", $key);
	$key_aux = $key;
	$valor = parsear_cadena_tildes($valor);
	$req_condicion_llave = $_REQUEST["subcondicion_" . $key];
	$cadena = parsear_consulta($key, $valor, $req_condicion_llave);
	$enlace = @$_REQUEST["subsaiaenlace_" . $key_aux];
	$conector = '';
	if ($enlace) {
		switch ($enlace) {
			case 'y' :
				$conector = '|+|';
				break;
			case 'o' :
				$conector = '|-|';
				break;
		}
	}
	if ($contador_campos > 1 && $conector == '') {
		$conector = '|+|';
	}
	$cadena = str_replace("_x", "", $cadena);
	$cadena = str_replace("_y", "", $cadena);
	return $cadena . $conector;
}

function parsear_consulta($key, $valor, $req_condicion_llave) {
	$valor = parsear_cadena_tildes($valor);
	$fin = strpos($key, "__");
	if ($fin) {
		$key = substr($key, 0, $fin);
	}
	
	$condicion_min = strtolower($req_condicion_llave);
	switch ($condicion_min) {
		case '=' :
			$condicion = '|' . $req_condicion_llave . '|';
			$valor_ = $valor;
			$escaped_val = htmlentities(utf8_decode($valor));
			if (MOTOR == "MySql") {
				$str_quote1 = "'";
				$str_quote2 = "'";
				$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
				// $key se puede calcular fuera del switch
				$cadena = addslashes($key . $condicion . $valor);
			} else {
				$str_quote1 = "''";
				$str_quote2 = "''";
				$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
				// $key se puede calcular fuera del switch
				$cadena = ($key . $condicion . $valor);
			}
			break;
		
		case 'like' :
			$condicion = "|" . $req_condicion_llave . "|";
			if (MOTOR == "MySql") {
				$str_quote1 = "'%";
				$str_quote2 = "%'";
				if (strpos($valor, ",") === false) {
					$valor_ = $valor;
					$escaped_val = htmlentities(utf8_decode(strtolower(trim($valor))));
					$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
					// $key se puede calcular fuera del switch
					$cadena = addslashes("lower(" . $key . ")" . $condicion . $valor);
				} else {
					$valores = explode(",", $valor);
					$cant = count($valores);
					for($j = 0; $j < $cant; $j++) {
						$valor_ = $valores[$j];
						$escaped_val = htmlentities(utf8_decode(strtolower(trim($valor_))));
						$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
						// $key se puede calcular fuera del switch
						$cadena .= addslashes("lower(" . $key . ")" . $condicion . $valor);
						if (($j + 1) < $cant) {
							$cadena .= "|-|";
						}
					}
					$cadena = "($cadena)";
				}
			} else if (MOTOR == "Oracle") {
				$str_quote1 = "''%";
				$str_quote2 = "%''";
				$valor_ = $valor;
				$escaped_val = htmlentities(utf8_decode(strtolower($valor)));
				$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
				// $key se puede calcular fuera del switch
				$cadena = ("lower(" . $key . ")" . $condicion . $valor);
			} else if (MOTOR == "MSSql" || MOTOR == "SqlServer") {
				$str_quote1 = "''%";
				$str_quote2 = "%''";
				$valor_ = $valor;
				$escaped_val = htmlentities(utf8_decode(strtolower($valor)));
				$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
				// $key se puede calcular fuera del switch
				$cadena = ("lower(cast(" . $key . " as varchar(max)))" . $condicion . $valor);
			} else {
				$str_quote1 = "''%";
				$str_quote2 = "%''";
				$valor_ = $valor;
				$escaped_val = htmlentities(utf8_decode(strtolower($valor)));
				$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
				// $key se puede calcular fuera del switch
				$cadena = ("lower(" . $key . ")" . $condicion . $valor);
			}
			break;
		
		case 'like_comas' :
			$condicion = "|" . str_replace("like_comas", "like", $req_condicion_llave) . "|";
			if (MOTOR == "MySql") {
				$str_quote1 = "'%,";
				$str_quote2 = ",%'";
				if (strpos($valor, ",") === false) {
					$valor_ = $valor;
					$escaped_val = htmlentities(utf8_decode(strtolower(trim($valor))));
					$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
					// $key se puede calcular fuera del switch
					$cadena = addslashes("lower(" . concatenar_cadena_sql(array(
							"'',''",
							"CAST(" . $key . " AS CHAR(255))",
							"'',''" 
					)) . ")" . $condicion . str_replace(" ", "%", $valor));
				} else {
					$valores = explode(",", $valor);
					$cant = count($valores);
					for($j = 0; $j < $cant; $j++) {
						$valor_ = $valores[$j];
						$escaped_val = htmlentities(utf8_decode(strtolower(trim($valor_))));
						$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
						// $key se puede calcular fuera del switch
						$cadena .= addslashes("lower(" . concatenar_cadena_sql(array(
								"'',''",
								"CAST(" . $key . " AS CHAR(255))",
								"'',''" 
						)) . ")" . $condicion . str_replace(" ", "%", $valor));
						if (($j + 1) < $cant) {
							$cadena .= "|-|";
						}
					}
					$cadena = "($cadena)";
				}
			} else {
				$str_quote1 = "''%,";
				$str_quote2 = ",%''";
				if (MOTOR == "Oracle") {
					if (strpos($valor, ",") === false) {
						$valor_ = $valor;
						$escaped_val = htmlentities(utf8_decode(strtolower($valor)));
						$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
						// $key se puede calcular fuera del switch
						$cadena = ("lower(" . concatenar_cadena_sql(array(
								"'',''",
								"CAST(" . $key . " AS CHAR(255))",
								"'',''" 
						)) . ")" . $condicion . str_replace(" ", "%", $valor));
					} else {
						$valores = explode(",", $valor);
						$cant = count($valores);
						for($j = 0; $j < $cant; $j++) {
							$valor_ = $valores[$j];
							$escaped_val = htmlentities(utf8_decode(strtolower(trim($valor_))));
							$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
							// $key se puede calcular fuera del switch
							$cadena .= ("lower(" . concatenar_cadena_sql(array(
									"'',''",
									"CAST(" . $key . " AS CHAR(255))",
									"'',''" 
							)) . ")" . $condicion . str_replace(" ", "%", $valor));
							if (($j + 1) < $cant) {
								$cadena .= "|-|";
							}
						}
						$cadena = "($cadena)";
					}
				} else if (MOTOR == "MSSql" || MOTOR == "SqlServer") {
					if (strpos($valor, ",") === false) {
						$valor_ = $valor;
						$escaped_val = htmlentities(utf8_decode(strtolower($valor)));
						$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
						// $key se puede calcular fuera del switch
						$cadena = ("lower(cast(" . concatenar_cadena_sql(array(
								"'',''",
								"CONVERT(VARCHAR(MAX)," . $key . ")",
								"'',''" 
						)) . " as varchar(max)))" . $condicion . str_replace(" ", "%", $valor));
					} else {
						$valores = explode(",", $valor);
						$cant = count($valores);
						for($j = 0; $j < $cant; $j++) {
							$valor_ = $valores[$j];
							$escaped_val = htmlentities(utf8_decode(strtolower(trim($valor_))));
							$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
							// $key se puede calcular fuera del switch
							$cadena = ("lower(cast(" . concatenar_cadena_sql(array(
									"'',''",
									"CONVERT(VARCHAR(MAX)," . $key . ")",
									"'',''" 
							)) . " as varchar(max)))" . $condicion . str_replace(" ", "%", $valor));
							if (($j + 1) < $cant) {
								$cadena .= "|-|";
							}
						}
						$cadena = "($cadena)";
					}
				} else {
					$cadena = procesar_filtro_like_general($key, $valor, $condicion);
				}
			}
			
			break;
		
		case 'like_total' :
			$condicion = "|" . str_replace("like_total", "like", $req_condicion_llave) . "|";
			if (MOTOR == "MySql") {
				$str_quote1 = "'%";
				$str_quote2 = "%'";
				if (strpos($valor, ",") === false) {
					$valor_ = $valor;
					$escaped_val = htmlentities(utf8_decode(strtolower(trim($valor))));
					$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
					// $key se puede calcular fuera del switch
					$cadena = addslashes("lower(" . $key . ")" . $condicion . str_replace(" ", "%", $valor));
				} else {
					$valores = explode(",", $valor);
					$cant = count($valores);
					for($j = 0; $j < $cant; $j++) {
						$valor_ = $valores[$j];
						$escaped_val = htmlentities(utf8_decode(strtolower(trim($valor_))));
						$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
						// $key se puede calcular fuera del switch
						$cadena .= addslashes("lower(" . $key . ")" . $condicion . str_replace(" ", "%", $valor));
						if (($j + 1) < $cant) {
							$cadena .= "|-|";
						}
					}
					$cadena = "($cadena)";
				}
			} else if (MOTOR == "MSSql" || MOTOR == "SqlServer") {
				$str_quote1 = "''%";
				$str_quote2 = "%''";
				if (strpos($valor, ",") === false) {
					$valor_ = $valor;
					$escaped_val = htmlentities(utf8_decode(strtolower($valor)));
					$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
					// $key se puede calcular fuera del switch
					$cadena = ("lower(cast(" . $key . " as varchar(max)))" . $condicion . str_replace(" ", "%", $valor));
				} else {
					$valores = explode(",", $valor);
					$cant = count($valores);
					for($j = 0; $j < $cant; $j++) {
						$valor_ = $valores[$j];
						$escaped_val = htmlentities(utf8_decode(strtolower(trim($valor_))));
						$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
						// $key se puede calcular fuera del switch
						$cadena = ("lower(cast(" . $key . " as varchar(max)))" . $condicion . str_replace(" ", "%", $valor));
						if (($j + 1) < $cant) {
							$cadena .= "|-|";
						}
					}
					$cadena = "($cadena)";
				}
			} else {
				$cadena = procesar_filtro_like_general($key, $valor, $condicion);
			}
			break;
		
		case 'in' :
		case 'in_enteros':
			//$condicion = "|" . $req_condicion_llave . "|";
			$condicion = "|" . str_replace("in_enteros", "in", $req_condicion_llave) . "|";
			if($condicion_min === 'in_enteros') {
				$funcion_campo = $key . " ";
			} else {
				$funcion_campo = "lower(" . $key . ")";
			}
			$str_quote1 = "(";
			$str_quote2 = ")";
			if (MOTOR == "MySql") {
				$valor = ajustar_lista_valores($valor);
				$valor_ = $valor;
				$escaped_val = htmlentities(utf8_decode(strtolower($valor)));
				$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
				// $key se puede calcular fuera del switch
				$cadena = addslashes("lower(" . $key . ")" . $condicion . $valor);
			} else if (MOTOR == "Oracle") {
				$valor = str_replace("\'", "'", $valor);
				$valor = ajustar_lista_valores($valor);
				if (!valor_dato($key, $valor)) {
					$valor = str_replace("'", "''", $valor);
					$valor = $str_quote1 . htmlentities(utf8_decode(strtolower($valor))) . $str_quote2;
				} else {
					$valor = valor_dato($key, $valor);
				}
				// $key se puede calcular fuera del switch
				$cadena = ($funcion_campo . $condicion . $valor);
			} else {
				$valor = ajustar_lista_valores($valor);
				if (!valor_dato($key, $valor)) {
					$valor = str_replace("'", "''", $valor);
					$valor = $str_quote1 . htmlentities(utf8_decode(strtolower($valor))) . $str_quote2;
				} else {
					$valor = valor_dato($key, $valor);
				}
				// $key se puede calcular fuera del switch
				$cadena = ($funcion_campo . $condicion . $valor);
			}
			break;
		case 'date' :
			$condicion = "|" . $req_condicion_llave . "|";
			if (MOTOR == "MySql") {
				if (substr($valor, -1) == ",") {
					$valor = substr($valor, 0, -1);
				}
				if (!valor_dato($key, $valor)) {
					$valor = str_replace("'", "''", $valor);
					$valor = htmlentities(utf8_decode(strtolower($valor)));
				} else {
					$valor = valor_dato($key, $valor);
				}
				// $key se puede calcular fuera del switch
				$cadena = addslashes("date_format(" . $key . ",'%Y-%m-%d')='" . $valor . "'");
			} else if (MOTOR == "Oracle") {
				if (substr($valor, -1) == ",") {
					$valor = substr($valor, 0, -1);
				}
				if (!valor_dato($key, $valor)) {
					$valor = str_replace("'", "''", $valor);
					$valor = htmlentities(utf8_decode(strtolower($valor)));
				} else {
					$valor = valor_dato($key, $valor);
				}
				// $key se puede calcular fuera del switch
				$cadena = ("CONVERT(date," . $key . ",20)='" . $valor . "'");
			} else if (MOTOR == "MSSql" || MOTOR == "SqlServer") {
				if (substr($valor, -1) == ",") {
					$valor = substr($valor, 0, -1);
				}
				if (!valor_dato($key, $valor)) {
					$valor = str_replace("'", "''", $valor);
					$valor = htmlentities(utf8_decode(strtolower($valor)));
				} else {
					$valor = valor_dato($key, $valor);
				}
				// $key se puede calcular fuera del switch
				$cadena = ("CONVERT(date," . $key . ",20)=''" . $valor . "''");
			} else {
				if (substr($valor, -1) == ",") {
					$valor = substr($valor, 0, -1);
				}
				if (!valor_dato($key, $valor)) {
					$valor = str_replace("'", "''", $valor);
					$valor = htmlentities(utf8_decode(strtolower($valor)));
				} else {
					$valor = valor_dato($key, $valor);
				}
				// $key se puede calcular fuera del switch
				$cadena = ("CONVERT(date," . $key . ",20)='" . $valor . "'");
			}
			break;
		
		default :
			$condicion = "|" . $req_condicion_llave . "|";
			$tipodate = False;
			if (MOTOR == "MySql") {
				$str_quote1 = "'%";
				$str_quote2 = "%'";
				$valor_ = $valor;
				$escaped_val = htmlentities(utf8_decode(strtolower($valor)));
				if (!valor_dato($key, $valor_)) {
					$valor = $str_quote1 . $escaped_val . $str_quote2;
				} else {
					$valor = valor_dato($key, $valor);
					$tipodate = True;
				}
				// $key se puede calcular fuera del switch
				if ($tipodate) {
					$key = "date_format(" . $key . ",\'%Y-%m-%d\')";
					$cadena = addslashes($key . $condicion . $valor);
				} else {
					$cadena = addslashes($key . $condicion . $valor);
				}
			} else {
				$str_quote1 = "''%";
				$str_quote2 = "%''";
				$valor_ = $valor;
				$escaped_val = htmlentities(utf8_decode(strtolower($valor)));
				if (!valor_dato($key, $valor_)) {
					$valor = $str_quote1 . $escaped_val . $str_quote2;
				} else {
					$valor = valor_dato($key, $valor);
				}
				// $key se puede calcular fuera del switch
				$cadena = ($key . $condicion . $valor);
			}
	}
	return $cadena;
}


/**
 * @param valor
 */

function ajustar_lista_valores($valor) {
	if (substr($valor, -1) == ",") {
		$valor = substr($valor, 0, -1);
	}
	$aux_val = explode(",", $valor);
	$valor = "'" . implode("','", $aux_val) . "'";
	$valor = str_replace("''", "'", $valor);
	return $valor;
}

/**
 *
 * @param
 *        	key
 * @param
 *        	valor_
 * @param
 *        	escaped_val
 * @param
 *        	str_quote1
 * @param
 *        	str_quote2
 */
function get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2) {
	$valor = "";
	if (!valor_dato($key, $valor_)) {
		$valor = $str_quote1 . $escaped_val . $str_quote2;
	} else {
		$valor = valor_dato($key, $valor_);
	}
	return $valor;
}

/**
 *
 * @param
 *        	key
 * @param
 *        	valor
 * @param
 *        	condicion
 */
function procesar_filtro_like_general($key, $valor, $condicion) {
	if (strpos($valor, ",") === false) {
		if (!valor_dato($key, $valor)) {
			$valor = "''%" . htmlentities(utf8_decode(strtolower($valor))) . "%''";
		} else {
			$valor = valor_dato($key, $valor);
		}
		// $key se puede calcular fuera del switch
		$cadena = ("lower(" . $key . ")" . $condicion . str_replace(" ", "%", $valor));
	} else {
		$valores = explode(",", $valor);
		$cant = count($valores);
		for($j = 0; $j < $cant; $j++) {
			$valor_ = $valores[$j];
			if (!valor_dato($key, $valor_)) {
				$valor = "''%" . htmlentities(utf8_decode(strtolower(trim($valor_)))) . "%''";
			} else {
				$valor = valor_dato($key, $valor_);
			}
			// $key se puede calcular fuera del switch
			$cadena .= ("lower(" . $key . ")" . $condicion . str_replace(" ", "%", $valor));
			if (($j + 1) < $cant) {
				$cadena .= "|-|";
			}
		}
		$cadena = "($cadena)";
	}
	return $cadena;
}

function guardar_lob2($campo, $tabla, $condicion, $contenido, $tipo, $conn, $log = 1) {
	$sql = "SELECT " . $campo . " FROM " . $tabla . " WHERE " . $condicion . " FOR UPDATE";
	// echo $sql.'<br /> ';
	$stmt = OCIParse($conn->Conn->conn, $sql) or print_r(OCIError($stmt));
	// Execute the statement using OCI_DEFAULT (begin a transaction)
	OCIExecute($stmt, OCI_DEFAULT) or print_r(OCIError($stmt));
	// Fetch the SELECTed row
	OCIFetchInto($stmt, $row, OCI_ASSOC);
	if (FALSE === $row) {
		OCIRollback($conn->Conn->conn);
		alerta("No se pudo modificar el campo.");
		$resultado = FALSE;
	} else { // Now save a value to the LOB
		if ($row[strtoupper($campo)]->size() > 0)
			$contenido_actual = htmlspecialchars_decode($row[strtoupper($campo)]->read($row[strtoupper($campo)]->size()));
		else
			$contenido_actual = "";
		if ($contenido_actual != $contenido) {
			if ($row[strtoupper($campo)]->size() > 0 && !$row[strtoupper($campo)]->truncate()) {
				oci_rollback($conn->Conn->conn);
				alerta("No se pudo modificar el campo.");
				$resultado = FALSE;
			} else {
				if (!$row[strtoupper($campo)]->save(trim((($contenido))))) {
					oci_rollback($conn->Conn->conn);
					$resultado = FALSE;
				} else
					oci_commit($conn->Conn->conn);
					// *********** guardo el log en la base de datos **********************
				preg_match("/.*=(.*)/", strtolower($condicion), $resultados);
			}
		}
		oci_free_statement($stmt);
		$row[strtoupper($campo)]->free();
	}
}

function parsear_cadena_tildes($cadena) {
	$texto = ($cadena);
	$buscar=array('á','é','í','ó','ú','ñ','Á','É','Í','Ó','Ú','Ñ');
	$reemplazar=array('%','%','%','%','%','%','%','%','%','%','%','%');
	$texto = str_replace($buscar, $reemplazar, $texto);
	return $texto;
}
?>
