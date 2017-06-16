<?php

class FiltroBusquedaElastic {

	private $parametros;

	public function __construct($parametros) {
		$this->parametros = $parametros;
	}

	public function procesar_componente_elastic() {
		$filtro = '';
		$idbusqueda_temp = '';
		$retorno = array();
		$retorno["exito"] = 0;
		$retorno["mensaje"] = "Existe un error al tratar de procesar la b&uacute;squeda";

		$cadena_adicional = '';
		if (@$this->parametros["adicionar_consulta"]) {
			$arreglo = array();
			$consulta_adicional = $this->campos_especiales();
			$componente = busca_filtro_tabla("", "busqueda_componente a", "a.idbusqueda_componente=" . $this->parametros["idbusqueda_componente"], "", $conn);

			// Todos los componentes que se deben considerar en el request como componentes o criterios de busqueda para el filtro deben tener el prefijo bqsaia_
			$cantidad_campos = 0;

			$campos_req = preg_grep("/^bqsaia_/", array_keys($this->parametros));
			$cantidad_campos = count($cantidad_campos);
			foreach ($campos_req as $key) {
				$valor = $this->parametros[$key];
				if(!empty($valor)) {
					//Devuelve un array must o should que se mezcla con las condiciones existentes
					$cadena = $this->parsear_cadena_temporal($key, $valor, $cantidad_campos);
					$arreglo[] = array_merge_recursive($arreglo, $cadena);
				}
			}

			$cadena = json_encode($arreglo);

			if (count($arreglo)) {
				$cadena = str_replace("@", ".", $cadena);
				$cadena_adicional = str_replace("@", ".", $cadena_adicional);

				if (($cadena || $consulta_adicional) && $cadena_adicional) {
					$cadena_adicional = " and " . $cadena_adicional;
				}
				if (MOTOR == "Oracle") {
					$sql2 = "INSERT INTO busqueda_filtro_temp(fk_busqueda_componente,funcionario_idfuncionario,fecha) VALUES(" .
					$this->parametros["idbusqueda_componente"] . "," . usuario_actual("idfuncionario") . "," . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . ")";
					$conn->Ejecutar_Sql($sql2);
					$idbusqueda_temp = $conn->Ultimo_Insert();
					guardar_lob2('detalle', 'busqueda_filtro_temp', 'idbusqueda_filtro_temp=' . $idbusqueda_temp, $cadena, "texto", $conn);
				} else {
					$sql2 = "INSERT INTO busqueda_filtro_temp(fk_busqueda_componente,funcionario_idfuncionario,detalle,fecha) VALUES(" .
					$this->parametros["idbusqueda_componente"] . "," . usuario_actual("idfuncionario") . ",'" . $cadena . "'," . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . ")";
					$conn->Ejecutar_Sql($sql2);
					$idbusqueda_temp = $conn->Ultimo_Insert();
				}
				//TODO: Revisar para convertir en elastic
				$idbusqueda_fil = $this->filtros_adicionales();
			}
		} else if (@$this->parametros["idbusqueda_filtro"]) {
			$filtro = "&idbusqueda_filtro=" . $this->parametros["idbusqueda_filtro"];
		} else if (@$this->parametros['idbusqueda_filtro_temp']) {
			if ($idbusqueda_temp != '')
				$idbusqueda_temp .= "," . $this->parametros['idbusqueda_filtro_temp'];
			else
				$idbusqueda_temp = $this->parametros['idbusqueda_filtro_temp'];
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
			$url = $componente[0]["url"] . "idbusqueda_componente=" . $this->parametros["idbusqueda_componente"] . "&idbusqueda_filtro_temp=" . $idbusqueda_temp . $filtro;
		} elseif ($componente[0]["ruta_visualizacion"]) {
			if (strpos($componente[0]["ruta_visualizacion"], "?")) {
				$componente[0]["ruta_visualizacion"] .= '&';
			} else {
				$componente[0]["ruta_visualizacion"] .= '?';
			}
			$url = $componente[0]["ruta_visualizacion"] . "idbusqueda_componente=" . $this->parametros["idbusqueda_componente"] . "&idbusqueda_filtro_temp=" . $idbusqueda_temp . $filtro;
		} else {
			$url = "pantallas/busquedas/consulta_busqueda.php?idbusqueda_componente=" . $this->parametros["idbusqueda_componente"] . "&idbusqueda_filtro_temp=" . $idbusqueda_temp . $filtro;
		}
		if (@$this->parametros["variable_busqueda"] != "") {
			$url .= "&variable_busqueda=" . $this->parametros['variable_busqueda'];
		}
		if (@$this->parametros["idbusqueda_grafico"] != "") {
			$url .= "&idbusqueda_grafico=" . $this->parametros['idbusqueda_grafico'];
		}
		// Procesar parametros adicionales
		if (@$this->parametros["parametros_adicionales_buscador"]) {
			$complemento = explode("|", $this->parametros["parametros_adicionales_buscador"]);
			foreach ( $complemento as $key => $valor ) {
				$complemento2 = explode("@", $valor);
				$url .= "&" . $complemento2[0] . "=" . $complemento2[1];
			}
		}

		$retorno["exito"] = 1;
		$retorno["url"] = $url;
		$retorno["filtro"] = "&idbusqueda_filtro_temp=" . $idbusqueda_temp . $filtro;
		$retorno["mensaje"] = 'Filtro procesado con exito';
		return $retorno;
	}

	function parsear_cadena_temporal($key, $valor, $contador_campos) {
		$key = str_replace("bqsaia_", "", $key);
		$req_condicion_llave = $this->parametros["bksaiacondicion_" . $key];
		$key = str_replace("_x", "", $key);
		$key = str_replace("_y", "", $key);
		$cadena = $this->parsear_consulta($key, $valor, $req_condicion_llave);
		$enlace = @$this->parametros["bqsaiaenlace_" . $key];
		$conector = 'must';
		if ($enlace) {
			switch ($enlace) {
				case 'y' :
					$conector = 'must';
					break;
				case 'o' :
					$conector = 'should';
					break;
			}
		}
		if ($contador_campos > 1 && $conector == '') {
			$conector = 'must';
		}
		return [$conector => $cadena];
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
		$bqtipodato = array();
		$bqtipodato_plantilla = array();
		if ($this->parametros["bqtipodato"]) {
			$bqtipodato = explode(",", str_replace("date|", "", @$this->parametros["bqtipodato"]));
		}
		if ($this->parametros["bqtipodato_plantilla"]) {
			$bqtipodato_plantilla = explode(",", str_replace("date|", "", @$this->parametros["bqtipodato_plantilla"]));
		}
		$date = array_merge($bqtipodato, $bqtipodato_plantilla);
		$cant_date = count($date);
		$datetime = explode(",", str_replace("datetime|", "", @$this->parametros["bqtipodato"]));
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
		$retorno = addslashes($retorno_);

		if ($retorno_ != '') {
			return (($retorno));
		}
		return false;
	}

	function filtros_adicionales() {
		global $conn;
		if (@$this->parametros["filtro_adicional"]) {
			$datos = $this->parametros["filtro_adicional"];
			$idbusqueda_componente = $this->parametros["idbusqueda_componente"];
			$usuario = usuario_actual("idfuncionario");
			$fecha = fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s");
			$valores = explode("@", $datos);

			$tablas = stripslashes($valores[0]);
			$where = stripslashes($valores[1]);

			$sql1 = "INSERT INTO busqueda_filtro (fk_busqueda_componente, funcionario_idfuncionario, tabla_adicional, where_adicional) VALUES (" . $idbusqueda_componente . "," . $usuario . ",'" . $tablas . "','" . $where . "')";
			$conn->Ejecutar_Sql($sql1);
			$idbusqueda = $conn->Ultimo_Insert();
			return $idbusqueda;
		}
	}

	function campos_especiales() {
		global $conn, $ruta_db_superior;
		if (@$this->parametros["campos_especiales"]) {
			$campos = explode(",", $this->parametros["campos_especiales"]);
			$cantidad = count($campos);
			$retorno = array();
			$a = 0;
			for($i = 0; $i < $cantidad; $i++) {
				$documentos = array();
				$tipo = explode("@", $campos[$i]);
				// serie@arbol@alias
				if (!isset($tipo[2])) {
					$alias = "g.";
					$tipo[2] = "g@";
				} else {
					$alias = $tipo[2] . ".";
					$tipo[2] = $tipo[2] . "@";
				}
				if ($tipo[1] == "arbol") {
					if (!isset($this->parametros[$tipo[2] . $tipo[0]])) {
						$this->parametros[$tipo[2] . $tipo[0]] = $this->parametros[$tipo[0]]; // utilizado para los reportes
					}
					if ($this->parametros[$tipo[2] . $tipo[0]] != "") {
						$tipo[0] = strtolower($tipo[0]);
						$valor_campo = $this->parametros[$tipo[2] . $tipo[0]];
						$varios = explode(",", $valor_campo);
						$cuantos = count($varios);
						$cadena = array();
						foreach ( $varios as $val ) {
							if ($varios[$j]) {
								$cadena[] = ["match" => [$alias . $tipo[0] => $varios[$j]
								]
								];
								$cadena[] = ["match" => [$alias . $tipo[0] => "," . $varios[$j]
								]
								];
								$cadena[] = ["match" => [$alias . $tipo[0] => $varios[$j] . ","
								]
								];
								$cadena[] = ["match" => [$alias . $tipo[0] => "," . $varios[$j] . ","
								]
								];
							}
						}

						$cantidad_cadena = count($cadena);
						if ($cantidad_cadena) {
							$retorno[$a]["should"] = $cadena;
						} else {
							$retorno[$a]["match"] = [$alias . $tipo[0] => "0"
							];
						}
					}
				} else if ($tipo[1] == "ejecutor") {
					if ($this->parametros[$tipo[2] . $tipo[0] . "-nombre"] != '' || $this->parametros[$tipo[2] . $tipo[0] . "-identificacion"] != '' || $this->parametros[$tipo[2] . $tipo[0] . "-empresa"] != '') {
						$tipo[0] = strtolower($tipo[0]);
						$valor_campo1 = $this->parametros[$tipo[2] . $tipo[0] . "-nombre"];
						$valor_campo2 = $this->parametros[$tipo[2] . $tipo[0] . "-identificacion"];
						$valor_campo3 = $this->parametros[$tipo[2] . $tipo[0] . "-empresa"];
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
								$where[] = ["match" => ["ejecutor.nombre" => $varios[$j]
								]
								];
							}
						}
						for($j = 0; $j < $cuantos2; $j++) {
							if ($varios2[$j] != '') {
								$where[] = ["match" => ["ejecutor.identificacion" => $varios2[$j]
								]
								];
							}
						}
						for($j = 0; $j < $cuantos3; $j++) {
							if ($varios3[$j] != '') {
								$where[] = ["match" => ["datos_ejecutor.empresa" => $varios3[$j]
								]
								];
							}
						}
						// TODO: Esto se tiene que revisar para adaptarlo a elastic
						$datos_ejecutor = busca_filtro_tabla("distinct iddatos_ejecutor", "ejecutor a, datos_ejecutor b", "a.idejecutor=b.ejecutor_idejecutor and (" . implode(" and ", $where) . ")", "", $conn);

						for($k = 0; $k < $datos_ejecutor["numcampos"]; $k++) {
							$cadena[] = "(" . $alias . $tipo[0] . "|like|''" . $datos_ejecutor[$k]["iddatos_ejecutor"] . "''|-|" . $alias . $tipo[0] . "|like|''%," . $datos_ejecutor[$k]["iddatos_ejecutor"] . "''|-|" . $alias . $tipo[0] . "|like|''" . $datos_ejecutor[$k]["iddatos_ejecutor"] . ",%''|-|" . $alias . $tipo[0] . "|like|''%," . $datos_ejecutor[$k]["iddatos_ejecutor"] . ",%'')";
						}
						$cantidad_cadena = count($cadena);
						if ($cantidad_cadena) {
							$retorno[$a] = "(" . implode("|-|", $cadena) . ")";
						} else {
							$retorno[$a] = "(" . $alias . $tipo[0] . "|like|''0'')";
						}
					}
				}
				$a++;
			}
			$cant = count($retorno);
			if ($cant) {
				return ["must" => $retorno
				];
			}
			return false;
		}
	}

	function crear_condicion_sql($idbusqueda, $idcomponente, $filtros = '') {
		global $conn;
		$datos_condicion = busca_filtro_tabla("", "busqueda_condicion_enlace A, busqueda_condicion B", "B.idbusqueda_condicion=A.fk_busqueda_condicion AND (B.fk_busqueda_componente=" . $idcomponente . " or B.busqueda_idbusqueda=" . $idbusqueda . ") AND cod_padre IS NULL ", "orden", $conn);
		if (!$datos_condicion["numcampos"]) {
			$datos_condicion = busca_filtro_tabla("", "busqueda_condicion B", "B.fk_busqueda_componente=" . $idcomponente . " or B.busqueda_idbusqueda=" . $idbusqueda, "", $conn);
			$condicion = $datos_condicion[0]["codigo_where"];
		} else {
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
			if (@$this->parametros["condicion_adicional"]) {
				$condicion = $this->parametros["condicion_adicional"];
			} else {
				$condicion = ' 1=1 ';
			}
			return ('(' . $condicion . ')');
		}
		if (@$this->parametros["condicion_adicional"]) {
			$condicion .= $this->parametros["condicion_adicional"];
		}
		return ('(' . $condicion . ')');
	}

	function parsear_datos_plantilla_visual($cadena, $campos = array()) {
		$result = preg_match_all('({\*([a-z]+[0-9]*[_]*[a-z]*[0-9]*[.]*[,]*[@]*)+\*})', $cadena, $resultado);
		if ($result !== FALSE) {
			$patrones = str_replace(array("{*","*}"
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
		$valor = $this->parsear_cadena_tildes($valor);
		$req_condicion_llave = $this->parametros["subcondicion_" . $key];
		$cadena = $this->parsear_consulta($key, $valor, $req_condicion_llave);
		$enlace = @$this->parametros["subsaiaenlace_" . $key_aux];
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
		$valor = $this->parsear_cadena_tildes($valor);
		$fin = strpos($key, "__");
		if ($fin) {
			$key = substr($key, 0, $fin);
		}

		$cadena_elastic = array();
		$condicion_min = strtolower($req_condicion_llave);
		switch ($condicion_min) {
			case '=' :
				$condicion = '|' . $req_condicion_llave . '|';
				$valor_ = $valor;
				$escaped_val = $valor;
				$str_quote1 = "''";
				$str_quote2 = "''";
				$valor = $this->get_valor_condicion($key, $valor_, $escaped_val);
				$cadena_elastic["term"] = [$key => $valor];
				$cadena = ($key . $condicion . $valor);
				break;

			case 'like' :
				$condicion = "|" . $req_condicion_llave . "|";
				$valor_ = $valor;
				$escaped_val = strtolower($valor);
				$valor = $this->get_valor_condicion($key, $valor_, $escaped_val);
				$cadena_elastic["match"] = [$key => $valor];
				$cadena = ("lower(" . $key . ")" . $condicion . $valor);
				break;

			case 'like_comas' :
				$condicion = "|" . str_replace("like_comas", "like", $req_condicion_llave) . "|";
				$str_quote1 = "''%,";
				$str_quote2 = ",%''";
				$valores = explode(",", $valor);
				$cant = count($valores);
				for($j = 0; $j < $cant; $j++) {
					$valor_ = $valores[$j];
					$escaped_val = ((strtolower(trim($valor_))));
					$valor = $this->get_valor_condicion($key, $valor_, $escaped_val, $str_quote1, $str_quote2);
					$cadena .= ("lower(" . concatenar_cadena_sql(array("'',''","CAST(" . $key . " AS CHAR(255))","'',''"
					)) . ")" . $condicion . str_replace(" ", "%", $valor));
					if (($j + 1) < $cant) {
						$cadena .= "|-|";
					}
				}
				$cadena = "($cadena)";
				break;
			case 'like_total' :
				//TODO: Esto es un match
				$condicion = "|" . str_replace("like_total", "like", $req_condicion_llave) . "|";
				$str_quote1 = "'%";
				$str_quote2 = "%'";
				$valores = explode(",", $valor);
				$cant = count($valores);
				for($j = 0; $j < $cant; $j++) {
					$valor_ = $valores[$j];
					$escaped_val = strtolower(trim($valor_));
					$valor = $this->get_valor_condicion($key, $valor_, $escaped_val);
					$cadena .= addslashes("lower(" . $key . ")" . $condicion . str_replace(" ", "%", $valor));
					if (($j + 1) < $cant) {
						$cadena .= "|-|";
					}
				}
				$cadena = "($cadena)";
				break;
			case 'in' :
			case 'in_enteros' :
				$condicion = "|" . str_replace("in_enteros", "in", $req_condicion_llave) . "|";
				$funcion_campo = $key . " ";

				$valor = $this->ajustar_lista_valores($valor);
				$valor_fecha = $this->valor_dato($key, $valor);
				if ($valor_fecha) {
					$valor = $valor_fecha;
				}
				$lista_valores = explode(",", $valor);
				foreach ($lista_valores as $value) {
					$lista_elastic[] = $value;
				}
				if(!empty($lista_elastic)) {
					$cadena_elastic["terms"] = [$funcion_campo => $lista_elastic];
				}

				$cadena = ($funcion_campo . $condicion . $valor);
				break;
			case 'date' :
				$condicion = "|" . $req_condicion_llave . "|";
				if (substr($valor, -1) == ",") {
					$valor = substr($valor, 0, -1);
				}
				$valor_fecha = $this->valor_dato($key, $valor);
				if (!$valor_fecha) {
					$valor = strtolower($valor);
				} else {
					$valor = $valor_fecha;
				}

				$fecha=date_create($valor);
				$cadena_elastic["term"] = [$key => $fecha->format("c")];
				$cadena = addslashes("date_format(" . $key . ",'%Y-%m-%d')='" . $valor . "'");
				break;

			default :
				$condicion = "|" . $req_condicion_llave . "|";
				$tipodate = False;
				$valor_ = $valor;
				$escaped_val = ((strtolower($valor)));
				$valor_fecha = $this->valor_dato($key, $valor_);
				if (!$valor_fecha) {
					$valor = $escaped_val;
				} else {
					$valor = $valor_fecha;
				}
				$cadena_elastic["match"] = [$key => $valor];
				$cadena = ($key . $condicion . $valor);
		}
		return $cadena;
	}

	/**
	 *
	 * @param
	 *        	valor
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

	function parsear_cadena_tildes($cadena) {
		$texto = ($cadena);
		$buscar = array('á','é','í','ó','ú','ñ','Á','É','Í','Ó','Ú','Ñ'
		);
		$reemplazar = array('%','%','%','%','%','%','%','%','%','%','%','%'
		);
		$texto = str_replace($buscar, $reemplazar, $texto);
		return $texto;
	}

	function get_valor_condicion($key, $valor_, $escaped_val) {
		$valor = "";
		$valor_fecha = $this->valor_dato($key, $valor_);
		if (!$valor_fecha) {
			$valor = $escaped_val;
		} else {
			$valor = $valor_fecha;
		}
		return $valor;
	}

	function valor_dato($campo, $valor) {
		$bqtipodato = array();
		$bqtipodato_plantilla = array();
		if ($this->parametros["bqtipodato"]) {
			$bqtipodato = explode(",", str_replace("date|", "", @$this->parametros["bqtipodato"]));
		}
		if ($this->parametros["bqtipodato_plantilla"]) {
			$bqtipodato_plantilla = explode(",", str_replace("date|", "", @$this->parametros["bqtipodato_plantilla"]));
		}
		$date = array_merge($bqtipodato, $bqtipodato_plantilla);
		$cant_date = count($date);
		$datetime = explode(",", str_replace("datetime|", "", @$this->parametros["bqtipodato"]));
		$cant_datetime = count($date);
		$retorno_ = false;
		if ($cant_date > 0) {
			if (in_array($campo, $date)) {
					$retorno_ = $valor;
			}
		} else if ($cant_datetime > 0) {
			if (in_array($campo, $datetime)) {
					$retorno_ = $valor;
			}
		}
		$retorno = addslashes($retorno_);

		if ($retorno_ != '') {
			return (($retorno));
		}
		return false;
	}

}