<?php
use PhpOffice\PhpWord\Exception\Exception;

$max_salida = 6;
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
?>
<?php
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");
include_once ($ruta_db_superior . "pantallas/lib/elasticsearch/class_elasticsearch.php");

class DocumentoElastic {
	var $datos_ft;
	private $cliente_elasticsearch;
	var $iddocumento;
	var $mensaje;
	var $estado_mensaje;
	var $documento;
	var $idformato;
	var $nombre_formato;

	public function __construct($iddocumento) {
		$this->iddocumento = $iddocumento;
		$this->asignar_iddocumento($iddocumento);
	}

	private function get_documento($iddocumento) {
		$this->iddocumento = $iddocumento;
		$this->documento = busca_filtro_tabla("", "documento", "iddocumento=" . $this->iddocumento, "", $conn);
		if ($this->documento["numcampos"]) {
			$formato = busca_filtro_tabla("", "formato", "lower(nombre) LIKE '" . strtolower($this->documento[0]["plantilla"]) . "'", "", $conn);
			if ($formato["numcampos"]) {
				$this->idformato = $formato[0]["idformato"];
				$this->nombre_formato = $formato[0]["nombre"];
			}
		}
	}

	public static function obtener_documento($iddocumento) {
		$resp = array();
		$documento = busca_filtro_tabla("", "documento", "iddocumento=" . $iddocumento, "", $conn);
		if ($documento["numcampos"]) {
			$resp["documento"] = $documento;
			$formato = busca_filtro_tabla("", "formato", "lower(nombre) LIKE '" . strtolower($documento[0]["plantilla"]) . "'", "", $conn);
			if ($formato["numcampos"]) {
				$resp["idformato"] = $formato[0]["idformato"];
				$resp["nombre_formato"] = $formato[0]["nombre"];
			}
		}
		return $resp;
	}

	public function asignar_iddocumento($iddocumento) {
		if ($this->iddocumento && $this->iddocumento != $iddocumento) {
			$this->mensaje = "El documento esta relacionado con el id " . $this->iddocumento . " se ha reemplazado por " . $iddocumento;
			$this->estado_mensaje = "warning";
			$this->iddocumento = $iddocumento;
			if ($this->documento["numcampos"])
				$this->get_documento($this->iddocumento);
			if (!$this->datos_ft["numcampos"]) {
				$this->datos_ft = $this->cargar_informacion_ft($this->documento[0]["plantilla"]);
			}
		} else {
			$this->iddocumento = $iddocumento;
			$this->mensaje = "El documento con id " . $this->iddocumento . " asignado correctamente";
			$this->estado_mensaje = "success";
		}
	}

	private function cargar_informacion_ft($plantilla) {
		if (@$this->documento["numcampos"]) {
			$datos_ft = busca_filtro_tabla('', 'ft_' . strtolower($plantilla) . " A", 'A.documento_iddocumento=' . $this->iddocumento, '', conn);
			return $datos_ft;
		}
		return false;
	}

	private function cargar_informacion_ft2($plantilla, $iddocumento) {
		if ($iddocumento) {
			$datos_ft = busca_filtro_tabla('', 'ft_' . strtolower($plantilla) . " A", 'A.documento_iddocumento=' . $iddocumento, '', conn);
			return $datos_ft;
		}
		return false;
	}

	public function exportar_informacion($tipo_export = "") {
		$datos_temporal = array();
		if (!@$this->documento["numcampos"]) {
			$this->get_documento($this->iddocumento);
			if (!$this->documento["numcampos"]) {
				die("Existe un error al tratar de buscar el documento con id " . $this->iddocumento);
			}
		}
		if (!@$this->datos_ft["numcampos"]) {
			$this->datos_ft = $this->cargar_informacion_ft($this->documento[0]["plantilla"]);
		}
		$this->cargar_adicional_documento();
		if (@$this->documento["numcampos"]) {
			foreach ( $this->documento[0] as $key => $valor ) {
				if (!is_int($key)) {
					$datos_temporal["documento"][$key] = $valor;
				}
			}
		}
		if (@$this->datos_ft["numcampos"]) {
			foreach ( $this->datos_ft[0] as $key => $valor ) {
				if (!is_int($key)) {
					$datos_temporal["datos_ft"][$key] = mostrar_valor_campo($key, $this->idformato, $this->iddocumento, 1);
				}
			}
		}
		// aqui debe ir las diferentes formas de exportar un documento json, csv, array, etc y cuando exista otro metodo como isadg o chicago aqui es donde debe quedar
		switch ($tipo_export) {
			case "json" :
				return (json_encode($datos_temporal));
				break;
			default :
				return ($datos_temporal);
				break;
		}
	}

	function cargar_adicional_documento() {
		if ($this->documento["numcampos"]) {
			if ($this->datos_ft["numcampos"] && $this->datos_ft[0]["serie_idserie"]) {
				$this->documento[0]["serie"] = $this->datos_ft[0]["serie_idserie"];
			}
			$serie = busca_filtro_tabla('', 'serie', 'idserie=' . $this->documento[0]["serie"], '', conn);
			if ($serie["numcampos"]) {
				$this->documento[0]["nombre_serie"] = $serie[0]["nombre"];
			} else {
				$this->documento[0]["nombre_serie"] = '';
			}
			$tipo_documento = busca_filtro_tabla('', 'contador', 'idcontador=' . $this->documento[0]["tipo_radicado"], '', conn);
			if ($tipo_documento["numcampos"]) {
				$this->documento[0]["nombre_contador"] = $tipo_documento[0]["nombre"];
			} else {
				$this->documento[0]["nombre_contador"] = '';
			}
		}
	}

	// Se debe tener en cuenta que el documento ya debe estar cargado
	public function indexar_elasticsearch($iddocumento) {
		$this->asignar_iddocumento($iddocumento);
		$arreglo_datos = $this->exportar_informacion();
		if ($this->documento["numcampos"]) {
			$indice = "documentos";
			$tipo_dato = $this->documento[0]["plantilla"];
			$id = $this->documento[0]["iddocumento"];
			return ($this->get_cliente_elasticsearch()->adicionar_indice_simple($indice, $id, $arreglo_datos, $tipo_dato));
		}
		return (false);
	}

	// $parametros= arreglo asociativo de valores a buscar ejemplo numero=>234, descripcion=>constituci&oacute;n pol&iacute;tica de COLOMBIA,
	// en cualquier caso se debe enviar sin comilllas adicionales a las definidas por la cadena
	public function buscar_elasticsearch($param_busqueda, $from = 0, $size = 20, $parametros = "") {
		$cadena = array();
		foreach ( $param_busqueda as $key => $valor ) {
			array_push($cadena, '"' . $key . '" : "' . $valor . '"');
		}
		$json = '{
            "from" : ' . $from . ', "size" : ' . $size . ',
            "query" : {
                "match" : {
                    ' . implode(",", $cadena) . '
                }
            }
        }';
		if ($parametros == '') {
			$parametros = array(
					"index" => "documentos"
			);
		}
		$response = $this->get_cliente_elasticsearch()->buscar_item_elastic($parametros, $json);
		return ($response);
	}

	public function buscar_elasticsearch_all($parametros = '') {
		$json = '{
		    "query": {
		        "match_all": {}
		    }
		}';
		if ($parametros == '') {
			$parametros = array(
					"index" => "documentos"
			);
		}
		$response = $this->get_cliente_elasticsearch()->buscar_item_elastic($parametros, $json);
		return ($response);
	}

	public function borrar_elasticsearch_all($parametros = '') {
		$json = '{
		    "query": {
		        "match_all": {}
		    }
		}';
		if ($parametros == '') {
			$parametros = array(
					"index" => "documentos"
			);
		}
		$response = $this->get_cliente_elasticsearch()->buscar_item_elastic($parametros, $json);
		$response_borrar = array();
		foreach ( $response["hits"]["hits"] as $key => $valor ) {
			array_push($response_borrar, $this->cliente_elasticsearch->borrar_indice($valor["_index"], $valor["_id"], $valor["_type"]));
		}
		return ($response_borrar);
	}

	public function get_cliente_elasticsearch() {
		if (!@$this->cliente_elasticsearch) {
			$this->cliente_elasticsearch = new elasticsearch_saia();
		}
		return $this->cliente_elasticsearch;
	}

	public function get_iddocumento() {
		return $this->iddocumento;
	}

	private function obtener_info_doc($iddocumento) {
		$datos_temporal = array();
		$info_doc = static::obtener_documento($iddocumento);
		if (!$info_doc["documento"]["numcampos"]) {
			throw new \Exception("Existe un error al tratar de buscar el documento con id " . $iddocumento);
		}
		$documento = $info_doc["documento"];
		$datos_ft = $this->cargar_informacion_ft2($documento[0]["plantilla"], $iddocumento);
		// $this->cargar_adicional_documento();

		if ($documento["numcampos"]) {
			if ($datos_ft["numcampos"] && $datos_ft[0]["serie_idserie"]) {
				$documento[0]["serie"] = $datos_ft[0]["serie_idserie"];
			}
			$serie = busca_filtro_tabla('', 'serie', 'idserie=' . $documento[0]["serie"], '', conn);
			if ($serie["numcampos"]) {
				$documento[0]["nombre_serie"] = $serie[0]["nombre"];
			} else {
				$documento[0]["nombre_serie"] = '';
			}
			$tipo_documento = busca_filtro_tabla('', 'contador', 'idcontador=' . $documento[0]["tipo_radicado"], '', conn);
			if ($tipo_documento["numcampos"]) {
				$documento[0]["nombre_contador"] = $tipo_documento[0]["nombre"];
			} else {
				$documento[0]["nombre_contador"] = '';
			}
		}

		if (@$documento["numcampos"]) {
			foreach ( $documento[0] as $key => $valor ) {
				if (!is_int($key)) {
					$datos_temporal["documento"][$key] = $valor;
				}
			}
		}
		if (@$datos_ft["numcampos"]) {
			foreach ( $datos_ft[0] as $key => $valor ) {
				if (!is_int($key)) {
					$datos_temporal["datos_ft"][$key] = mostrar_valor_campo($key, $info_doc["idformato"], $iddocumento, 1);
				}
			}
		}
		return ($datos_temporal);
	}

	private function obtener_info_hijos($iddocumento, &$datos_hijos) {
		if (empty($iddocumento)) {
			return;
		}
		$info_doc = static::obtener_documento($iddocumento);

		$plantilla_padre = $info_doc["nombre_formato"];
		$idplantilla_padre = $info_doc["idformato"];
		$formatos_hijos = busca_filtro_tabla("h.nombre, h.nombre_tabla", "formato h", "h.item = 0 and h.cod_padre = $idplantilla_padre", "", $conn);

		$datos_ft = $this->cargar_informacion_ft2($plantilla_padre, $iddocumento);

		// print_r($plantilla_padre);die();
		// print_r($datos_ft[0]);die();
		// $datos_hijos = array();
		for($i = 0; $i < $formatos_hijos["numcampos"]; $i++) {
			$plantilla = strtolower($formatos_hijos[$i]["nombre"]);
			$tabla = $formatos_hijos[$i]["nombre_tabla"];
			$documentos_hijos = busca_filtro_tabla("", $tabla, "ft_" . $plantilla_padre . " = " . $datos_ft[0]["idft_" . $plantilla_padre], "", $conn);
			// print_r($documentos_hijos);die();
			if ($documentos_hijos["numcampos"]) {
				for($h = 0; $h < $documentos_hijos["numcampos"]; $h++) {
					$id_hijo = $documentos_hijos[$h]["documento_iddocumento"];
					if ($id_hijo) {
						$relacion = new StdClass();
						$relacion->id_padre = $iddocumento;
						$relacion->id_hijo = $id_hijo;
						$relacion->tipo_padre = $plantilla_padre;
						$relacion->tipo_hijo = $plantilla;
						$datos_hijos[] = $relacion;
						// $datos_hijos[$iddocumento] = $id_hijo;
						// print_r($documentos_hijos[$h]);echo "<br>";
						$this->obtener_info_hijos($id_hijo, $datos_hijos);
					}
				}
			}
		}
	}

	// Se debe tener en cuenta que el documento ya debe estar cargado
	public function indexar_elasticsearch_completo() {
		// $this->asignar_iddocumento();
		// $this->obtener_info_hijos($this->iddocumento);
		$doc_ppal = $this->iddocumento;
		$arreglo_datos = $this->obtener_info_doc($doc_ppal);

		if ($arreglo_datos) {
			$hijos = array();

			$this->obtener_info_hijos($doc_ppal, $hijos);
			if (count($hijos) > 0) {

				/*
				 * $params['index'] = "documentos";
				 * $params['id'] = $id;
				 * $params['body'] = $arreglo_datos;
				 * $params['type'] = $arreglo_datos["documento"]["plantilla"];
				 */
				$params = [
						"mappings" => [
								$arreglo_datos["documento"]["plantilla"] => []/*,
								"employee" => [
										"_parent" => [
												"type" => $arreglo_datos["documento"]["plantilla"]
										]
								] */
						]
				];

				$total = count($hijos);
				$arreglo_hijos = array();
				// Primero es necesario crear el mapeo entre el documento padre y sus hijos
				foreach ( $hijos as $key => $hijo ) {
					if ($key) {
						$datos_hijo = $this->obtener_info_doc($hijo->id_hijo);

						if ($datos_hijo) {
							$params["mappings"][$hijo->tipo_hijo] = [
									"_parent" => [
											"type" => $hijo->tipo_padre
									]

							];
							$datos_hijo["parent"] = $hijo->id_padre;
							$arreglo_hijos[] = $datos_hijo;
						}
					}
				}
				$this->guardar_indice($params);
				//Se debe indexar el documento padre
				$this->guardar_indice_simple($arreglo_datos);
				if(count($arreglo_hijos) > 0) {
					foreach ( $arreglo_hijos as $key => $hijo ) {
						$this->guardar_indice_simple($hijo);
					}
				}

			} else {
				$this->guardar_indice_simple($arreglo_datos);
			}
		} else {
			throw new \Exception("Error al tomar los datos del registro " . $this->iddocumento);
		}

		return (true);
	}

	private function guardar_indice_simple($arreglo_datos, $id_padre) {
		if ($arreglo_datos) {
			$datos_json = json_encode($arreglo_datos);
			$indice = "documentos";
			$tipo_dato = $arreglo_datos["documento"]["plantilla"];
			$id = $arreglo_datos["documento"]["iddocumento"];
			/*
			 * print_r("Tipo: $tipo_dato");
			 * echo "<br>";
			 * print_r("ID: $id, Padre: $id_padre");
			 * echo "<br>";
			 * echo ("Datos: ");
			 * print_r($arreglo_datos);
			 * echo "<br>";
			 */
			return ($this->get_cliente_elasticsearch()->adicionar_indice_simple($indice, $id, $arreglo_datos, $tipo_dato, $id_padre));
		}
	}

	private function guardar_indice($params) {
		if ($arreglo_datos) {
			return ($this->get_cliente_elasticsearch()->adicionar_indice($params));
		}
	}
}
?>