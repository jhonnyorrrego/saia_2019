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

include_once $ruta_db_superior . "core/autoload.php";
include_once $ruta_db_superior . "pantallas/lib/librerias_cripto.php";

$validar_enteros = array("idbusqueda_componente");
$filtro = '';
$idbusqueda_temp = '';
$retorno = array();
$retorno["exito"] = 0;
$retorno["mensaje"] = "Existe un error al tratar de procesar la busqueda";
if (@$_REQUEST["idbusqueda_componente"]) {
	$cadena_adicional = '';
	if (@$_REQUEST["adicionar_consulta"]) {
		$arreglo = array();
		$consulta_adicional = campos_especiales();
		$componente = busca_filtro_tabla("", "busqueda_componente a", "a.idbusqueda_componente=" . $_REQUEST["idbusqueda_componente"], "");
		if ($componente["numcampos"] && $componente[0]["nombre"] == 'listado_documentos') {
			$arreglo_sub = array();
			$conta = 0;
			$datos = '';
			foreach ($_REQUEST as $key => $valor) {
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
		foreach ($_REQUEST as $key => $valor) {
			$entra = strpos($key, "bqsaia_");
			if ($entra !== FALSE && $valor != '') {
				$cantidad_campos++;
			}
		}
		foreach ($_REQUEST as $key => $valor) {
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

			$idbusqueda_temp = BusquedaFiltroTemp::newRecord([
				'fk_busqueda_componente' => $_REQUEST["idbusqueda_componente"],
				'funcionario_idfuncionario' => $_SESSION["idfuncionario"],
				'detalle' => $cadena . $consulta_adicional . $cadena_adicional,
				'fecha' => date("Y-m-d H:i:s")
			]);


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
	if (@$_REQUEST["idbusqueda_grafico"] != "") {
		$url .= "&idbusqueda_grafico=" . $_REQUEST['idbusqueda_grafico'];
	}
	// Procesar parametros adicionales
	if (@$_REQUEST["parametros_adicionales_buscador"]) {
		$complemento = explode("|", $_REQUEST["parametros_adicionales_buscador"]);
		foreach ($complemento as $key => $valor) {
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

function parsear_cadena_temporal($key, $valor, $contador_campos)
{
	$key = str_replace("bqsaia_", "", $key);
	$valor = str_replace("@", "%", $valor);
	// Cuando quieren buscar una cadena con @ no estaba buscando, esto soluciona el problema
	$valor = parsear_cadena_tildes($valor);
	$req_condicion_llave = $_REQUEST["bksaiacondicion_" . $key];
	$cadena = parsear_consulta($key, $valor, $req_condicion_llave);
	$enlace = @$_REQUEST["bqsaiaenlace_" . $key];
	$conector = '';
	if ($enlace) {
		switch ($enlace) {
			case 'y':
				$conector = '|+|';
				break;
			case 'o':
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

function limpiar_cadena($cadena)
{
	$cadena_aux = substr($cadena, -3);
	$tamano = strlen($cadena);
	if ($cadena_aux == '|+|' || $cadena_aux == '|-|') {
		$cadena = substr($cadena, 0, ($tamano - 3));
	}
	return $cadena;
}

function valor_dato($campo, $valor)
{
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
			$retorno_ = $valor;
		}
	} else if ($cant_datetime > 0) {
		if (in_array($campo, $datetime)) {
			$retorno_ = $valor;
		}
	}

	return $retorno_ ? $retorno_ : false;
}

function filtros_adicionales()
{
	if (@$_REQUEST["filtro_adicional"]) {
		$datos = $_REQUEST["filtro_adicional"];
		$idbusqueda_componente = $_REQUEST["idbusqueda_componente"];
		$usuario = $_SESSION["idfuncionario"];
		$valores = explode("@", $datos);
		$tablas = stripslashes($valores[0]);
		$where = stripslashes($valores[1]);

		$Connection = Connection::getInstance();
		$Connection->createQueryBuilder()
			->insert('busqueda_filtro')
			->setValue('fk_busqueda_componente', $idbusqueda_componente)
			->setValue('funcionario_idfuncionario', $usuario)
			->setValue('fk_busqueda_componente', $tablas)
			->setValue('fk_busqueda_componente', $where)
			->execute();

		return $Connection->lastInsertId();
	}
}

function campos_especiales()
{
	if (@$_REQUEST["campos_especiales"]) {
		$campos = explode(",", $_REQUEST["campos_especiales"]);
		$cantidad = count($campos);
		$retorno = array();
		$a = 0;
		for ($i = 0; $i < $cantidad; $i++) {
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
					$_REQUEST[$tipo[2] . $tipo[0]] = $_REQUEST[$tipo[0]];
					// utilizado para los reportes
				}
				if ($_REQUEST[$tipo[2] . $tipo[0]] != "") {
					$tipo[0] = strtolower($tipo[0]);
					$valor_campo = $_REQUEST[$tipo[2] . $tipo[0]];
					$varios = explode(",", $valor_campo);
					$cuantos = count($varios);
					$cadena = array();
					for ($j = 0; $j < $cuantos; $j++) {
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
					for ($j = 0; $j < $cuantos; $j++) {
						if ($varios[$j] != '') {
							$where[] = "lower(a.nombre) like '%" . str_replace(" ", "%", strtolower(parsear_cadena_tildes($varios[$j]))) . "%'";
						}
					}
					for ($j = 0; $j < $cuantos2; $j++) {
						if ($varios2[$j] != '') {
							$where[] = "lower(a.identificacion) like '%" . str_replace(" ", "%", strtolower(parsear_cadena_tildes($varios2[$j]))) . "%'";
						}
					}
					for ($j = 0; $j < $cuantos3; $j++) {
						if ($varios3[$j] != '') {
							$where[] = "lower(b.empresa) like '%" . str_replace(" ", "%", strtolower(parsear_cadena_tildes($varios3[$j]))) . "%'";
						}
					}
					$datos_ejecutor = busca_filtro_tabla("distinct iddatos_ejecutor", "ejecutor a, datos_ejecutor b", "a.idejecutor=b.ejecutor_idejecutor and (" . implode(" and ", $where) . ")", "");

					for ($k = 0; $k < $datos_ejecutor["numcampos"]; $k++) {
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

function realizar_consulta()
{
	$tablas = array();
	$datos_busqueda = busca_filtro_tabla("", "busqueda A, busqueda_componente B", "A.idbusqueda=B.busqueda_idbusqueda AND B.idbusqueda_componente=" . @$_REQUEST["idbusqueda_componente"], "orden");
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
	$condicion = crear_condicion_sql($datos_busqueda[0]["idbusqueda"], $datos_busqueda[0]["idbusqueda_componente"], '');
	$tablas_consulta = strtolower(implode(",", array_unique($tablas)));
	$campos2 = explode(",", $campos);
	foreach ($campos2 as $valor) {
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
	$variables_final = [];
	if ($datos_busqueda[0]["ruta_libreria"]) {
		$librerias = array_unique(explode(",", $datos_busqueda[0]["ruta_libreria"]));
		array_walk($librerias, "incluir_librerias_busqueda");
	}
	foreach ($funciones_condicion as $key => $valor) {
		unset($valor_variables);
		$valor_variables = array();
		$funcion = explode("@", $valor);
		$variables = explode(",", $funcion[1]);
		$cant_variables = count($variables);
		for ($h = 0; $h < $cant_variables; $h++) {
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
		$sord = " DESC ";
	}
	if ($sidx && $sord) {
		if ($datos_busqueda[0]["direccion"] != '') {
			$sord = $datos_busqueda[0]["direccion"];
		}
		$ordenar_consulta = $sidx . " " . $sord;
	}
	$condicion = strtolower($condicion);
	$ordenar_consulta = strtolower($ordenar_consulta);
	return array(
		$tablas_consulta,
		$condicion,
		$ordenar_consulta
	);
}

function crear_condicion_sql($idbusqueda, $idcomponente, $filtros = '')
{
	$condicion_filtro = '';
	$datos_condicion = busca_filtro_tabla("", "busqueda_condicion_enlace A, busqueda_condicion B", "B.idbusqueda_condicion=A.fk_busqueda_condicion AND (B.fk_busqueda_componente=" . $idcomponente . " or B.busqueda_idbusqueda=" . $idbusqueda . ") AND cod_padre IS NULL " . $condicion_filtro, "orden");
	if (!$datos_condicion["numcampos"]) {
		$datos_condicion = busca_filtro_tabla("", "busqueda_condicion B", "B.fk_busqueda_componente=" . $idcomponente . " or B.busqueda_idbusqueda=" . $idbusqueda . $condicion_filtro, "");
		$condicion = $datos_condicion[0]["codigo_where"];
	} else {
		if ($filtros != '') {
			$condicion_filtro = "AND (A.estado=1 OR (A.estado=2 AND A.condicion_idcondicion IN(" . $filtros . ")))";
		} else
			$condicion_filtro = " AND estado=1 ";
		for ($i = 0; $i < $datos_condicion["numcampos"]; $i++) {
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

function parsear_datos_plantilla_visual($cadena, $campos = array())
{
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

function incluir_librerias_busqueda($elemento, $indice)
{
	global $ruta_db_superior;
	include_once($ruta_db_superior . $elemento);
}

function parsear_subconsulta($key, $valor, $contador_campos)
{
	$key = str_replace("subsaia_", "", $key);
	$key_aux = $key;
	$valor = parsear_cadena_tildes($valor);
	$req_condicion_llave = $_REQUEST["subcondicion_" . $key];
	$cadena = parsear_consulta($key, $valor, $req_condicion_llave);
	$enlace = @$_REQUEST["subsaiaenlace_" . $key_aux];
	$conector = '';
	if ($enlace) {
		switch ($enlace) {
			case 'y':
				$conector = '|+|';
				break;
			case 'o':
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

function parsear_consulta($key, $valor, $req_condicion_llave)
{
	$valor = parsear_cadena_tildes($valor);
	$fin = strpos($key, "__");
	if ($fin) {
		$key = substr($key, 0, $fin);
	}
	$condicion_min = strtolower($req_condicion_llave);
	switch ($condicion_min) {
		case '=':
			$condicion = '|' . $req_condicion_llave . '|';
			$valor_ = $valor;
			$escaped_val = ($valor);
			$str_quote1 = "'";
			$str_quote2 = "'";
			$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
			$cadena = $key . $condicion . $valor;

			break;

		case 'like':
			$condicion = "|" . $req_condicion_llave . "|";
			$str_quote1 = "'%";
			$str_quote2 = "%'";
			if (strpos($valor, ",") === false) {
				$valor_ = $valor;
				$escaped_val = strtolower(trim($valor));
				$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
				// $key se puede calcular fuera del switch
				$cadena = "lower(" . $key . ")" . $condicion . $valor;
			} else {
				$valores = explode(",", $valor);
				$cant = count($valores);
				for ($j = 0; $j < $cant; $j++) {
					$valor_ = $valores[$j];
					$escaped_val = strtolower(trim($valor_));
					$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
					// $key se puede calcular fuera del switch
					$cadena .= "lower(" . $key . ")" . $condicion . $valor;
					if (($j + 1) < $cant) {
						$cadena .= "|-|";
					}
				}
				$cadena = "($cadena)";
			}

			break;

		case 'like_comas':
			$condicion = "|" . str_replace("like_comas", "like", $req_condicion_llave) . "|";
			$str_quote1 = "'%,";
			$str_quote2 = ",%'";
			if (strpos($valor, ",") === false) {
				$valor_ = $valor;
				$escaped_val = strtolower(trim($valor));
				$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
				// $key se puede calcular fuera del switch
				$cadena = "LOWER(CONCAT(',',CONCAT({$key},','))) {$condicion} " . str_replace(" ", "%", $valor);
			} else {
				$valores = explode(",", $valor);
				$cant = count($valores);
				for ($j = 0; $j < $cant; $j++) {
					$valor_ = $valores[$j];
					$escaped_val = strtolower(trim($valor_));
					$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
					// $key se puede calcular fuera del switch
					$cadena .= "LOWER(CONCAT(',',CONCAT({$key},','))) {$condicion} " . str_replace(" ", "%", $valor);

					if (($j + 1) < $cant) {
						$cadena .= "|-|";
					}
				}
				$cadena = "($cadena)";
			}


			break;

		case 'like_total':
			$condicion = "|" . str_replace("like_total", "like", $req_condicion_llave) . "|";
			$str_quote1 = "'%";
			$str_quote2 = "%'";
			if (strpos($valor, ",") === false) {
				$valor_ = $valor;
				$escaped_val = strtolower(trim($valor));
				$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
				// $key se puede calcular fuera del switch
				$cadena = "lower(" . $key . ")" . $condicion . str_replace(" ", "%", $valor);
			} else {
				$valores = explode(",", $valor);
				$cant = count($valores);
				for ($j = 0; $j < $cant; $j++) {
					$valor_ = $valores[$j];
					$escaped_val = strtolower(trim($valor_));
					$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
					// $key se puede calcular fuera del switch
					$cadena .= "lower(" . $key . ")" . $condicion . str_replace(" ", "%", $valor);
					if (($j + 1) < $cant) {
						$cadena .= "|-|";
					}
				}
				$cadena = "($cadena)";
			}

			break;

		case 'in':
		case 'in_enteros':
			//$condicion = "|" . $req_condicion_llave . "|";
			$condicion = "|" . str_replace("in_enteros", "in", $req_condicion_llave) . "|";
			if ($condicion_min === 'in_enteros') {
				$funcion_campo = $key . " ";
			} else {
				$funcion_campo = "lower(" . $key . ")";
			}
			$str_quote1 = "(";
			$str_quote2 = ")";
			if ($condicion_min == 'in') {
				$valor = ajustar_lista_valores($valor);
			}
			$valor_ = $valor;
			$escaped_val = strtolower($valor);
			$valor = get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
			// $key se puede calcular fuera del switch
			$cadena = "lower(" . $key . ")" . $condicion . $valor;

			break;
		case 'date':
			$condicion = "|" . $req_condicion_llave . "|";
			if (substr($valor, -1) == ",") {
				$valor = substr($valor, 0, -1);
			}
			if (!valor_dato($key, $valor)) {
				$valor = str_replace("'", "''", $valor);
				$valor = strtolower($valor);
			} else {
				$valor = valor_dato($key, $valor);
			}
			// $key se puede calcular fuera del switch
			$cadena = "date_format(" . $key . ",'%Y-%m-%d')='" . $valor . "'";
			break;

		default:
			$condicion = "|" . $req_condicion_llave . "|";
			$tipodate = False;
			$str_quote1 = "'%";
			$str_quote2 = "%'";
			$valor_ = $valor;
			$escaped_val = strtolower($valor);
			if (!valor_dato($key, $valor_)) {
				$valor = $str_quote1 . $escaped_val . $str_quote2;
			} else {
				$valor = valor_dato($key, $valor);
				$tipodate = True;
			}

			if ($tipodate) {
				$key = "date_format(" . $key . ",\'%Y-%m-%d\')";
				$cadena = $key . $condicion . $valor;
			} else {
				$cadena = $key . $condicion . $valor;
			}
	}
	return $cadena;
}

function ajustar_lista_valores($valor)
{
	if (substr($valor, -1) == ",") {
		$valor = substr($valor, 0, -1);
	}
	$aux_val = explode(",", $valor);
	$valor = "'" . implode("','", $aux_val) . "'";
	$valor = str_replace("''", "'", $valor);
	return $valor;
}

function get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2)
{
	$valor = "";
	if (!valor_dato($key, $valor_)) {
		$valor = $str_quote1 . $escaped_val . $str_quote2;
	} else {
		$valor = valor_dato($key, $valor_);
	}
	return $valor;
}

function procesar_filtro_like_general($key, $valor, $condicion)
{
	if (strpos($valor, ",") === false) {
		if (!valor_dato($key, $valor)) {
			$valor = "''%" . strtolower($valor) . "%''";
		} else {
			$valor = valor_dato($key, $valor);
		}
		// $key se puede calcular fuera del switch
		$cadena = ("lower(" . $key . ")" . $condicion . str_replace(" ", "%", $valor));
	} else {
		$valores = explode(",", $valor);
		$cant = count($valores);
		for ($j = 0; $j < $cant; $j++) {
			$valor_ = $valores[$j];
			if (!valor_dato($key, $valor_)) {
				$valor = "''%" . ((strtolower(trim($valor_)))) . "%''";
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

function parsear_cadena_tildes($cadena)
{
	$texto = ($cadena);
	$buscar = array(
		'á',
		'é',
		'í',
		'ó',
		'ú',
		'ñ',
		'Á',
		'É',
		'Í',
		'Ó',
		'Ú',
		'Ñ'
	);
	$reemplazar = array(
		'%',
		'%',
		'%',
		'%',
		'%',
		'%',
		'%',
		'%',
		'%',
		'%',
		'%',
		'%'
	);
	$texto = str_replace($buscar, $reemplazar, $texto);
	return $texto;
}
