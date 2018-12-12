<?php
// ini_set("display_errors",true);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0 ISO-8859-1
require_once ("../db.php");
if (stristr($_SERVER["HTTP_ACCEPT"], "application/json")) {
	header("Content-type: application/json");
} else {
	header("Content-type: text/x-json");
}

//echo ("<?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">");

$actual = usuario_actual("idfuncionario");
$id = @$_REQUEST["id"];

$padre_dependencia = 0;

if (@$_REQUEST["iddependencia"] != '')
	$padre_dependencia = $_REQUEST["iddependencia"];
if (@$_REQUEST["seleccionado"])
	$seleccionados = explode(",", $_REQUEST["seleccionado"]);
else
	$seleccionados = array();

$funcionarios_sistema = busca_filtro_tabla("A.idfuncionario", "funcionario A", "A.login in('cerok','radicador_salida','mensajero')", "", $conn);
$funcionarios_sistema_array = extrae_campo($funcionarios_sistema, "idfuncionario");
if (@$_REQUEST["excluidos"]) {
	$excluidos = explode(",", $_REQUEST["excluidos"] . implode(",", $funcionarios_sistema_array));
} else if ($actual != 1)
	$excluidos = $funcionarios_sistema_array;
else
	$excluidos = $funcionarios_sistema_array;
$tipo_arbol = "funcionario";
if (@$_REQUEST["rol"])
	$tipo_arbol = "rol";
$no_padre = false;
if (@$_REQUEST["sin_padre"])
	$no_padre = true;
if (@$_REQUEST["series"]) {
	$nuevas = array();
	$series = explode(",", $_REQUEST["series"]);
	for($i = 0; $i < count($series); $i++) { // quito las categorias de la lista de series
		if (strpos($series[$i], "-") == false)
			$nuevas[] = $series[$i];
	}
	$_REQUEST["series"] = implode(",", $nuevas);
	$asignados = busca_filtro_tabla("distinct funcionario_codigo", "entidad_serie,funcionario", "entidad_identidad=1 and llave_entidad=idfuncionario and serie_idserie=" . implode(" and serie_idserie=", $series), "", $conn);
	$seleccionados = extrae_campo($asignados, "funcionario_codigo", "U");
}

if (@$_REQUEST["tipo_entidad"] && @$_REQUEST["llave_entidad"]) {
	$codigo = busca_filtro_tabla("funcionario_codigo", "funcionario", "idfuncionario=" . $_REQUEST["llave_entidad"], "", $conn);
	$seleccionados = array(
			$codigo[0][0]
	);
}

if (@$_REQUEST["expediente"] && @$_REQUEST["accion"]) {
	$asignados = busca_filtro_tabla("funcionario", "permiso_expediente_func", "expediente_idexpediente=" . $_REQUEST["expediente"] . " and " . $_REQUEST["accion"] . "=1", "", $conn);
	$seleccionados = extrae_campo($asignados, "funcionario", "U");
}
if (@$_REQUEST["key"])
	$flujos = busca_filtro_tabla("", "paso_documento A,paso_actividad B", "B.estado=1 AND A.paso_idpaso=B.paso_idpaso AND A.documento_iddocumento=" . @$_REQUEST["key"], "", $conn);
else {
	$flujos["numcampos"] = 0;
}
$funcionarios_flujo = array();
$cargos_flujo = array();
$dependencias_flujo = array();
$verifica_flujo = 0;
$flujos["numcampos"] = 0;
if ($flujos["numcampos"]) {
	for($i = 0; $i < $flujos["numcampos"]; $i++) {
		if ($flujos[$i]["estado_paso_documento"] > 3) {
			// Verifico que existen flujos pendientes
			$verifica_flujo = $verifica_flujo + 1;
			switch ($flujos[$i]["entidad_identidad"]) {
				case 1 : // funcionario
					array_push($funcionarios_flujo, $flujos[$i]["llave_entidad"]);
					break;
				case 2 : // dependencia
					array_push($dependencias_flujo, $flujos[$i]["llave_entidad"]);
					break;
				case 3 : // ejecutor
					break;
				case 4 : // cargo
					array_push($cargos_flujo, $flujos[$i]["llave_entidad"]);
					break;
				case 5 : // dependencia cargo
				        // echo("PPPP");
					break;
			}
		}
	}
	if (@$_REQUEST["accion"] == 1) {
		if (strpos($_REQUEST["dependencias_flujo"], ",")) {
			$dependencias_flujo = explode(",", $_REQUEST["dependencias_flujo"]);
		} else {
			$padre_dependencia = $_REQUEST["dependencias_flujo"];
		}
	}
	// echo($verifica_flujo);
	if (!$verifica_flujo) {
		// Tiene un flujo en un documento pero no tiene un flujo con actividades pendientes
		$verifica_flujo = -1;
	}

	//echo ("<tree id=\"0\">\n");
	$datos = new \stdClass();
	$datos->id= 0;
	$items = array();
	$cadena3 = llena_dependencia($padre_dependencia, 0, 2);
	$entra1 = 0;
	if (!empty((array)$cadena3)) {
		//echo ("<item style=\"font-family:verdana; font-size:7pt;\" ");
		//echo ("text=\"Dependencias\" id=\"dependencias_flujo\" nocheckbox=\"1\" >\n");
		$un_item = new \stdClass();
		$un_item->style="font-family:verdana; font-size:7pt;";
		$un_item->text = "Dependencias";
 		$un_item->id="dependencias_flujo";
 		$un_item->nocheckbox ="1";
 		$un_item->item = $cadena3;
 		$items[] = $un_item;
		//echo ($cadena3);
		//echo ("</item>\n");
		$entra1 = 1;
	}
	$cadena4 = llena_cargos(0, 0, 4);
	if (!empty((array)$cadena4)) {
		$un_item = new \stdClass();
		$un_item->style="font-family:verdana; font-size:7pt;";
		$un_item->text = "Cargos";
		$un_item->id="cargos_flujo";
		$un_item->nocheckbox ="1";
		$un_item->item = $cadena4;
		$items[] = $un_item;
		//echo ("<item style=\"font-family:verdana; font-size:7pt;\" ");
		//echo ("text=\"Cargos\" id=\"cargos_flujo\"  nocheckbox=\"1\" >\n");
		//echo $cadena4;
		//echo ("</item>\n");
		$entra1 = 1;
	}
	$cadena5 = llena_dependencia($padre_dependencia, 0, 1);
	if (!empty((array)$cadena5)) {
		$un_item = new \stdClass();
		$un_item->style="font-family:verdana; font-size:7pt;";
		$un_item->text = "Funcionarios";
		$un_item->id="funcionarios_flujo";
		$un_item->nocheckbox ="1";
		$un_item->item = $cadena5;
		$items[] = $un_item;
		//echo ("<item style=\"font-family:verdana; font-size:7pt;\" ");
		//echo ("text=\"Funcionarios\" id=\"funcionarios_flujo\"  nocheckbox=\"1\">\n");
		//echo $cadena5;
		//echo ("</item>\n");
		$entra1 = 1;
	}
	if (!$entra1) {
		$un_item = new \stdClass();
		$un_item->style="font-family:verdana; font-size:7pt;";
		$un_item->text = "Sin acciones sobre el flujo";
		$un_item->id="sin_flujo";
		$un_item->nocheckbox ="1";
		$items[] = $un_item;
		//echo ("<item style=\"font-family:verdana; font-size:7pt;\" ");
		//echo ("text=\"Sin acciones sobre el flujo\" nocheckbox=\"1\" id=\"sin_flujo\" > \n");
		//echo ("</item>\n");
	}
	$datos->item = $items;
} elseif ($id) {
	$inicio = busca_filtro_tabla("*", "funcionario", "funcionario_codigo='$id'", "", $conn);
	$datos->id = "0";
	$un_item = new \stdClass();
	$un_item->style="font-family:verdana; font-size:7pt;";
	$un_item->text = htmlspecialchars(($inicio[0]["nombres"] . " " . $inicio[0]["apellidos"]));
	$un_item->id = $inicio[0]["funcionario_codigo"];
	$un_item->checked =1;
	$datos->item = $un_item;
	//echo ("<tree id=\"0\">\n");
	//echo ("<item style=\"font-family:verdana; font-size:7pt;\" ");
	//echo ("text=\"" . htmlspecialchars(($inicio[0]["nombres"] . " " . $inicio[0]["apellidos"])) . " \" id=\"" . $inicio[0]["funcionario_codigo"] . "\" checked=\"1\" >\n");
	//echo ("</item>\n");
} else {
	//echo ("<tree id=\"0\">\n");
	$datos->id = "0";
	$items = array();
	$items = llena_dependencia($padre_dependencia, 0);
	if (isset($_REQUEST["inactivos"]) && $_REQUEST["inactivos"]) {
		$un_item = new \stdClass();
		$un_item->style = "font-family:verdana; font-size:7pt;";
		$un_item->text= "Usuarios inactivos";
		$un_item->id="UI#";
		$un_item->item = funcionarios_inactivos();
		$items[] = $un_item;
		//$cadena = ("<item style=\"font-family:verdana; font-size:7pt;\" ");
		//$cadena .= ("text=\"Usuarios inactivos\" id=\"UI#\" >\n");
		//$cadena .= funcionarios_inactivos();
		//$cadena .= ("</item>\n");
		//echo $cadena;
	}
	if (isset($_REQUEST["sin_rol"]) && $_REQUEST["sin_rol"]) {
		$un_item = new \stdClass();
		$un_item->text="Usuarios sin rol activo";
		$un_item->id="RI#";
		$un_item->item = funcionarios_sin_rol();
		$items[] = $un_item;
		//$cadena = ("<item style=\"font-family:verdana; font-size:7pt;\" ");
		//$cadena .= ("text=\"Usuarios sin rol activo\" id=\"RI#\" >\n");
		//$cadena .= funcionarios_sin_rol();
		//$cadena .= ("</item>\n");
		//echo $cadena;
	}
	$datos->item = $items;
}
echo json_encode($datos);

function llena_dependencia($codigo, $ruta, $tipo_llenado = "") {
	global $conn, $sql, $seleccionados, $no_padre, $verifica_flujo;
	if ($verifica_flujo == -1) {
		return array();
	}
	$llenado = FALSE;
	$cadena = "";
	$items = array();
	if ($codigo == 0) {
		$prof = busca_filtro_tabla("", "dependencia", "(cod_padre is null OR cod_padre=0) AND estado=1", "", $conn);
		if ($prof["numcampos"]) {
			$un_item = new \stdClass();
			$un_item->style= "font-family:verdana; font-size:7pt;";
			$un_item->text = ucwords(codifica_encabezado(html_entity_decode($prof[0]["nombre"])));
			$un_item->id = $prof[0]["iddependencia"] . "#";
			//$cadena .= ("<item style=\"font-family:verdana; font-size:7pt;\" ");
			//$cadena .= ("text=\"" . ucwords(codifica_encabezado(html_entity_decode($prof[0]["nombre"]))) . "\" id=\"" . $prof[0]["iddependencia"] . "#\"");
			if ($no_padre || $tipo_llenado == 1) {
				$un_item->nocheckbox =1;
			}
			//$cadena .= " >\n";
			$cadena2 = llena_dependencia($prof[0]["iddependencia"], 0, $tipo_llenado);
			if (empty((array)$cadena2)) {
				return array();
			} else {
				$un_item->item = $cadena2;
			}
			//$cadena .= ("</item>\n");
			$items[] = $un_item;
			return $items;
		}
	} else {
		$prof = busca_filtro_tabla("", "dependencia", "iddependencia=" . $codigo . " AND estado=1", "", $conn);

		if ($prof["numcampos"]) {
			$hijos = busca_filtro_tabla("*", "dependencia A", " estado=1 AND A.cod_padre=" . $prof[0]["iddependencia"], "A.nombre ASC", $conn);
			// print_r($hijos);
			if ($hijos["numcampos"]) {
				for($i = 0; $i < $hijos["numcampos"]; $i++) {
					$valor = in_array($hijos[$i]["iddependencia"] . "d", $seleccionados);
					// alerta($valor);
					// $llenado=llena_dependencia($hijos[$i]["iddependencia"],$ruta);
					$codigo_hijos = llena_dependencia($hijos[$i]["iddependencia"], 0, $tipo_llenado);
					if (!empty($codigo_hijos)) {
						$un_item = new \stdClass();
						$un_item->text= codifica_encabezado(html_entity_decode(formato_cargo($hijos[$i]["nombre"])));
						$un_item->id = $hijos[$i]["iddependencia"] . "#";
						$un_item->style="font-family:verdana; font-size:7pt;";
						//$cadena .= ("<item style=\"font-family:verdana; font-size:7pt;\" $adicional ");
						//$cadena .= ("text=\"" . codifica_encabezado(html_entity_decode(formato_cargo($hijos[$i]["nombre"]))) . "\" id=\"" . $hijos[$i]["iddependencia"] . "#\"");
						if ($no_padre || $tipo_llenado == 1) {
							$un_item->nocheckbox = 1;
						}
						//$cadena .= " >\n";
						$un_item->item = $codigo_hijos;
						if ($valor != "" && $valor != Null) {
							$un_item->checked=1;
						}
						$items[] = $un_item;
					}
				}
			}

			$item_agrupar = new \stdClass();
			//$item_agrupar_fin = '';
			if (@$_REQUEST['agrupar']) {
				$item_agrupar->style= "font-family:verdana; font-size:7pt;";
				$item_agrupar->nocheckbox="1";
				$item_agrupar->id="agrupador_" . $codigo;
				$item_agrupar->text=codifica_encabezado(html_entity_decode($prof[0]['nombre']));
				$item_agrupar->child="1";
				//$item_agrupar_fin .= "</item>\n";
			}

			$funcionarios = llena_funcionarios($codigo, $ruta, $tipo_llenado);
			if (empty($items) && empty($funcionarios)) {
				return array();
			} else {
				if(!empty((array)$item_agrupar)) {
					$items[] = $item_agrupar;
				}
				$items = array_merge($items, $funcionarios);
				//$items[] = $funcionarios;
				//return $item_agrupar . $funcionarios . $cadena . $item_agrupar_fin;
				return $items;
			}
		}
	}
}

function llena_cargos($codigo, $ruta, $tipo_llenado = "") {
	global $conn, $seleccionados, $no_padre, $verifica_flujo;
	if ($verifica_flujo == -1) {
		return array();
	}
	$llenado = false;
	$cadena = "";
	$items = array();
	if ($codigo == 0) {
		$prof = busca_filtro_tabla("", "cargo", "cod_padre is null AND estado=1", "", $conn);
		for($i = 0; $i < $prof["numcampos"]; $i++) {
			$un_item = new \stdClass();

			$un_item->style= "font-family:verdana; font-size:7pt;";
			$un_item->text= ucwords(codifica_encabezado(html_entity_decode(strtolower($prof[$i]["nombre"]))));
			$un_item->id=  $prof[$i]["idcargo"] . "*";
			//$cadena .= ("<item style=\"font-family:verdana; font-size:7pt;\" ");
			//$cadena .= ("text=\"" . ucwords(codifica_encabezado(html_entity_decode(strtolower($prof[$i]["nombre"])))) . "\" id=\"" . $prof[$i]["idcargo"] . "*\" ");
			//$cadena .= " >\n";
			$cadena2 = llena_cargos($prof[$i]["idcargo"], 0, $tipo_llenado);
			if (empty($cadena2)) {
				return array();
			} else {
				$un_item->item = $cadena2;
			}
			//$cadena .= ("</item>\n");
			//return $cadena;
			$items[] = $un_item;
		}
		return  $items;
	} else {
		$prof = busca_filtro_tabla("", "cargo", "idcargo=" . $codigo . " AND estado=1", "", $conn);
		if ($prof["numcampos"]) {
			$hijos = busca_filtro_tabla("*", "cargo A", " estado=1 AND A.cod_padre=" . $prof[0]["idcargo"], "A.nombre ASC", $conn);
			// print_r($hijos);
			if ($hijos["numcampos"]) {
				for($i = 0; $i < $hijos["numcampos"]; $i++) {
					$valor = in_array($hijos[$i]["idcargo"] . "c", $seleccionados);
					// alerta($valor);
					// $llenado=llena_dependencia($hijos[$i]["iddependencia"],$ruta);
					$codigo_hijos = llena_cargos($hijos[$i]["idcargo"], 0, $tipo_llenado);
					if ($codigo_hijos != "") {
						$un_item = new \stdClass();
						$un_item->style="font-family:verdana; font-size:7pt;";
						$un_item->text= codifica_encabezado(html_entity_decode(formato_cargo(strtolower($hijos[$i]["nombre"]))));
						$un_item->id= $hijos[$i]["idcargo"] . "*";
						//$cadena .= ("<item style=\"font-family:verdana; font-size:7pt;\" $adicional ");
						//$cadena .= ("text=\"" . codifica_encabezado(html_entity_decode(formato_cargo(strtolower($hijos[$i]["nombre"])))) . "\" id=\"" . $hijos[$i]["idcargo"] . "*\"");
						if ($no_padre) {
							$un_item->nocheckbox=1;
						}
						if ($valor != "" && $valor != Null)
							$un_item->checked="1";

						//$cadena .= " >\n";
						//$cadena .= $codigo_hijos . "</item>\n";
						$un_item->item = $codigo_hijos;
						$items[] = $un_item;
					}
				}
			}
			$funcionarios = llena_funcionarios($codigo, $ruta, $tipo_llenado);
			if (empty($items) && empty($funcionarios)) {
				return array();
			} else {
				//return $cadena . $funcionarios;
				$items = array_merge($items, $funcionarios);
				//$items[] = $funcionarios;
				return $items;
			}
		}
	}
}

function llena_funcionarios($codigo, $ruta, $tipo_llenado) {
	global $conn, $seleccionados, $excluidos, $tipo_arbol, $funcionarios_flujo, $dependencias_flujo, $cargos_flujo, $verifica_flujo;
	// Bandera que se utiliza para verificar que tipo de llenado sea diferente de 0 y que cumpla por lo menos con 1 de los datos
	$ingreso = 0;
	if ($verifica_flujo == -1) {
		return array();
	}
	$func = "";
	$items = array();
	// GROUP BY funcionario_codigo
	$where_usuarios = "C.tipo_cargo=1 AND B.cargo_idcargo=C.idcargo AND B.funcionario_idfuncionario=A.idfuncionario  AND B.dependencia_iddependencia <> 1 AND A.estado=1 AND B.estado=1 and C.estado=1 AND B.dependencia_iddependencia=" . $codigo;
	// Tipo de LLenado =1 es para los funcionarios
	if ($tipo_llenado == 2 && !empty($dependencias_flujo)) {
		if (!in_array($codigo, $dependencias_flujo)) {
			// return("");
			// print_r($dependencias_flujo);
			$where_usuarios .= " AND dependencia_iddependencia IN(" . implode(",", $dependencias_flujo) . ")";
			$ingreso = 1;
		}
		$ingreso = 1;
	} elseif (!empty($funcionarios_flujo) && $tipo_llenado == 1) {
		$where_usuarios .= " AND funcionario_codigo IN(" . implode(",", $funcionarios_flujo) . ")";
		$ingreso = 1;
	} elseif (!empty($cargos_flujo) && $tipo_llenado == 4) {
		$where_usuarios .= " AND cargo_idcargo IN(" . implode(",", $cargos_flujo) . ")";
		$ingreso = 1;
	}
	if (($tipo_llenado && $ingreso) || $verifica_flujo == 0) {
		if (count($excluidos)) {
			$where_usuarios .= " AND idfuncionario NOT IN (" . implode(",", $excluidos) . ")";
		}
		$usuarios = busca_filtro_tabla("distinct B.iddependencia_cargo,A.login,A.funcionario_codigo,UPPER(A.nombres) AS nombres_ord,UPPER(A.apellidos) AS apellidos,A.sistema,C.nombre AS cargo", "funcionario A,dependencia_cargo B, cargo C", $where_usuarios, "nombres_ord ASC", $conn);
	} else
		return array();
	// print_r($usuarios);
	$tipo_id = "funcionario_codigo";
	if ($tipo_arbol == 'rol')
		$tipo_id = "iddependencia_cargo";
	if ($ruta == 0)
		$ruta = "";
	else
		$ruta = "%" . $ruta;
	for($j = 0; $j < $usuarios["numcampos"]; $j++) {
		$sistema = "";
		if ($usuarios[$j]["sistema"] == 0)
			$sistema = "(Sin SAIA)";
		$valor = in_array($usuarios[$j][$tipo_id], $seleccionados);
		// alerta($valor);
		$adicional = "";
		$un_item = new \stdClass();
		$un_item->style="font-family:verdana; font-size:7pt;";
		//$func .= ("<item style=\"font-family:verdana; font-size:7pt;\" $adicional ");
		if ($valor != "" && $valor != Null) {
			//$adicional = " checked=\"1\" ";
			$un_item->checked = 1;
		}
		if ($usuarios[$j]["nombres_ord"]) {
			$un_item->text = ucwords(codifica_encabezado(html_entity_decode(strtolower($usuarios[$j]["nombres_ord"] . " " . $usuarios[$j]["apellidos"])))) . "-" . codifica_encabezado(html_entity_decode(formato_cargo(strtolower($usuarios[$j]["cargo"])))) . $sistema;
			$un_item->id= $usuarios[$j][$tipo_id] . $ruta;
 			$un_item->ruta=$ruta;
			//$func .= ("text=\"" . ucwords(codifica_encabezado(html_entity_decode(strtolower($usuarios[$j]["nombres_ord"] . " " . $usuarios[$j]["apellidos"])))) . "-" . codifica_encabezado(html_entity_decode(formato_cargo(strtolower($usuarios[$j]["cargo"])))) . "  $sistema\" id=\"" . $usuarios[$j][$tipo_id] . "$ruta\" ruta=\"$ruta\" >");
		} else {
			$un_item->text = codifica_encabezado(html_entity_decode($usuarios[$j]["login"]));
			$un_item->id= $usuarios[$j]["funcionario_codigo"] . "$ruta";
			$un_item->ruta = $ruta;
			//$func .= ("text=\"" . codifica_encabezado(html_entity_decode($usuarios[$j]["login"])) . "\" id=\"" . $usuarios[$j]["funcionario_codigo"] . "$ruta\" ruta=\"$ruta\" >");
		}
		//$func .= ("</item>\n");
		$items[] = $un_item;
	}
	return $items;
}

function llena_funcionario($codigo, $ruta) {
	global $conn, $sql, $verifica_flujo;
	if ($verifica_flujo == -1) {
		return array();
	}
	$usuarios = busca_filtro_tabla("*", "funcionario A", "A.estado=1 AND A.funcionario_codigo=" . $codigo, "", $conn);
	if ($usuarios["numcampos"]) {
		$sistema = "";
		if ($usuarios[0]["sistema"] == 0)
			$sistema = "Sin SAIA";
		//echo ("<item style=\"font-family:verdana; font-size:7pt;\" ");
		$un_item = new \stdClass();
		$un_item->style="font-family:verdana; font-size:7pt;";
		if ($usuarios[0]["nombres_ord"]) {
			$un_item->text = ucwords(codifica_encabezado(html_entity_decode())) . " (" . $usuarios[0]["funcionario_codigo"] . ")" . $sistema;
 			$un_item->id= $usuarios[0]["funcionario_codigo"] . "%" . $ruta;
 			$un_item->ruta=$ruta;
			//echo ("text=\"" . ucwords(codifica_encabezado(html_entity_decode(strtolower($usuarios[0]["nombres_ord"] . " " . $usuarios[0]["apellidos"])))) . " (" . $usuarios[0]["funcionario_codigo"] . ") $sistema\" id=\"" . $usuarios[0]["funcionario_codigo"] . "%$ruta\" ruta=\"$ruta\">");
		} else {
			$un_item["text"] = codifica_encabezado(html_entity_decode($usuarios[0]["login"]));
			$un_item["id"]= $usuarios[0]["funcionario_codigo"];
			$un_item["ruta"]= $ruta;
			//echo ("text=\"" . codifica_encabezado(html_entity_decode($usuarios[0]["login"] . "\" id=\"" . $usuarios[0]["funcionario_codigo"])) . "\" ruta=\"$ruta\">");
		}
		return $un_item;
	}
	return array();
}

function funcionarios_inactivos() {
	global $conn, $verifica_flujo;
	if ($verifica_flujo == -1) {
		return array();
	}
	$usuarios = busca_filtro_tabla("A.login,A.funcionario_codigo,TRIM(UPPER(A.nombres)) AS nombres_ord,TRIM(UPPER(A.apellidos)) AS apellidos", "funcionario A", "estado=0", "nombres_ord,apellidos ASC", $conn);
	$func = "";
	$items = array();
	for($j = 0; $j < $usuarios["numcampos"]; $j++) {
		$un_item = new \stdClass();
		$un_item->style="font-family:verdana; font-size:7pt;";
		//$func .= ("<item style=\"font-family:verdana; font-size:7pt;\" ");
		if ($usuarios[$j]["nombres_ord"]) {
			$un_item->text = ucwords(codifica_encabezado(html_entity_decode(strtolower($usuarios[$j]["nombres_ord"] . " " . $usuarios[$j]["apellidos"]))));
			$un_item->id = $usuarios[$j]["funcionario_codigo"];
			//$func .= ("text=\"" . ucwords(codifica_encabezado(html_entity_decode(strtolower($usuarios[$j]["nombres_ord"] . " " . $usuarios[$j]["apellidos"])))) . "\" id=\"" . $usuarios[$j]["funcionario_codigo"] . "\" >");
		} else {
			$un_item->text = ucwords(codifica_encabezado(html_entity_decode($usuarios[$j]["login"])));
			$un_item->id = $usuarios[$j]["funcionario_codigo"];
			//$func .= ("text=\"" . ucwords(codifica_encabezado(html_entity_decode($usuarios[$j]["login"]))) . "\" id=\"" . $usuarios[$j]["funcionario_codigo"] . "\" >");
		}
		//$func .= ("</item>\n");
		$items[] = $un_item;
	}
	return $items;
}

function funcionarios_sin_rol() {
	global $conn, $seleccionados, $verifica_flujo;
	if ($verifica_flujo == -1) {
		return array();
	}
	$usuarios = busca_filtro_tabla("A.login,A.funcionario_codigo,TRIM(UPPER(A.nombres)) AS nombres_ord,TRIM(UPPER(A.apellidos)) AS apellidos", "funcionario A", "estado=1 and idfuncionario not in(select funcionario_idfuncionario from dependencia_cargo where estado=1)", "nombres_ord,apellidos ASC", $conn);
	$func = "";
	$items = array();
	for($j = 0; $j < $usuarios["numcampos"]; $j++) {
		$un_item = new \stdClass();
		$un_item->style="font-family:verdana; font-size:7pt;";
		//$func .= ("<item style=\"font-family:verdana; font-size:7pt;\" ");
		if ($usuarios[$j]["nombres_ord"]) {
			$un_item->text= ucwords(codifica_encabezado(html_entity_decode(strtolower($usuarios[$j]["nombres_ord"] . " " . $usuarios[$j]["apellidos"]))));
			$un_item->id= $usuarios[$j]["funcionario_codigo"];
			//$func .= ("text=\"" . ucwords(codifica_encabezado(html_entity_decode(strtolower($usuarios[$j]["nombres_ord"] . " " . $usuarios[$j]["apellidos"])))) . "\" id=\"" . $usuarios[$j]["funcionario_codigo"] . "\" ");
		} else {
			$un_item->text= ucwords(codifica_encabezado(html_entity_decode($usuarios[$j]["login"])));
			$un_item->id= $usuarios[$j]["funcionario_codigo"];
			//$func .= ("text=\"" . ucwords(codifica_encabezado(html_entity_decode($usuarios[$j]["login"]))) . "\" id=\"" . $usuarios[$j]["funcionario_codigo"] . "\" ");
		}
		if (in_array($usuarios[$j]["funcionario_codigo"], $seleccionados)) {
			$un_item->checked="true";
		}
		$items[] = $un_item;
	}
	return $items;
}

function llena_ruta($doc) {
	global $conn, $sql;
	if ($verifica_flujo == -1) {
		return array();
	}
	$llenado = FALSE;
	$origen = usuario_actual("funcionario_codigo");
	$documento = busca_filtro_tabla("", "documento", "iddocumento=" . $doc, "", $conn);
	if ($documento["numcampos"]) {
		$listado = busca_filtro_tabla("DISTINCT A.idruta,A.origen,A.destino,A.condicion_transferencia,A.tipo_destino", "ruta A", "A.idtipo_documental=" . $documento[0]["serie"] . " AND A.origen=" . $origen . " AND A.tipo_origen=1 AND A.tipo='ACTIVO'", "", $conn);
		for($i = 0; $i < $listado["numcampos"]; $i++) {

			$tipo_destino = $listado[$i]["tipo_destino"];
			if ($tipo_destino == 1)
				$destino = busca_cargo_funcionario($listado[$i]["tipo_destino"], $listado[$i]["destino"], '', $conn);
			else if ($tipo_destino == 2)
				$destino = busca_filtro_tabla("", "dependencia", "iddependenica=" . $listado[$i]["destino"], "", $conn);
			if ($destino["numcampos"]) {
				if ($tipo_destino == 2)
					$llenado = llena_dependencia($destino[0]["iddependencia"], $listado[$i]["idruta"]);
				else
					$llenado = llena_funcionario($destino[0]["funcionario_codigo"], $listado[$i]["idruta"]);
			}
		}
	}
	return $llenado;
}

function codifica_caracteres($original) {
	$codificada = str_replace("ACUTE;", "acute;", $original);
	$codificada = str_replace("TILDE;", "tilde;", $codificada);
	return ($codificada);
}