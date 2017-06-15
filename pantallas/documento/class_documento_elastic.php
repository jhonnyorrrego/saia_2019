<?php
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
	private $datos_ft;
	private $cliente_elasticsearch;
	private $iddocumento;
	private $mensaje;
	private $estado_mensaje;
	private $documento;
	private $idformato;
	private $nombre_formato;
	private $nombre_tabla;

	public function __construct($iddocumento) {
		$this->iddocumento = $iddocumento;
		if($iddocumento) {
			$this->asignar_iddocumento($iddocumento);
		}
	}

	private function get_documento($iddocumento) {
		$this->iddocumento = $iddocumento;
		$this->documento = busca_filtro_tabla("", "documento", "iddocumento=" . $this->iddocumento, "", $conn);
		if ($this->documento["numcampos"]) {
			$formato = busca_filtro_tabla("", "formato", "lower(nombre) LIKE '" . strtolower($this->documento[0]["plantilla"]) . "'", "", $conn);
			if ($formato["numcampos"]) {
				$this->idformato = $formato[0]["idformato"];
				$this->nombre_formato = $formato[0]["nombre"];
				$this->nombre_tabla = $formato[0]["nombre_tabla"];
			}
		}
	}

	protected static function obtener_documento($iddocumento) {
		$resp = array();
		$documento = busca_filtro_tabla("", "documento", "iddocumento=" . $iddocumento, "", $conn);
		if ($documento["numcampos"]) {
			if(@$documento[0]["fecha_creacion"]) {
				$date=date_create($documento[0]["fecha_creacion"]);
				$documento[0]["fecha_creacion"] = $date->format("c");
			}
			if(@$documento[0]["fecha"]) {
				$date=date_create($documento[0]["fecha"]);
				$documento[0]["fecha"] = $date->format("c");
			}
			$resp["documento"] = $documento;
			$formato = busca_filtro_tabla("", "formato", "lower(nombre) LIKE '" . strtolower($documento[0]["plantilla"]) . "'", "", $conn);
			if ($formato["numcampos"]) {
				$resp["idformato"] = $formato[0]["idformato"];
				$resp["nombre_formato"] = $formato[0]["nombre"];
				$resp["nombre_tabla"] = $formato[0]["nombre_tabla"];
			}
		}
		return $resp;
	}

	private function asignar_iddocumento($iddocumento) {
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
			$datos_ft = busca_filtro_tabla('', 'ft_' . strtolower($plantilla) . " A", 'A.documento_iddocumento=' . $this->iddocumento, '', $conn);
			return $datos_ft;
		}
		return false;
	}

	private function cargar_informacion_ft2($tabla_ft, $iddocumento) {
		if ($iddocumento) {
			//$tabla_ft= 'ft_' . strtolower($plantilla);
			$datos_ft = busca_filtro_tabla("", "$tabla_ft a", "a.documento_iddocumento = $iddocumento", "", $conn);
			return $datos_ft;
		}
		return false;
	}

	private function cargar_informacion_item($tabla_ft, $iddocumento) {
		if ($iddocumento) {
			//$tabla_ft= 'ft_' . strtolower($plantilla);
			$datos_ft = busca_filtro_tabla("", "$tabla_ft a", "a.id$tabla_ft= $iddocumento", "", $conn);
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
					$datos_temporal[$this->nombre_tabla][$key] = $this->obtener_valor_campo($key, $this->idformato, $this->iddocumento);
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

	public function ejecutar_consulta_elasticsearch($body, $indice="_all", $tipo=null) {
		if (empty($body)) {
			$body = '{
		    	"query": {
		        "match_all": {}
		    	}
				}';
		}
		$parametros = array(
				"index" => $indice,
				"body" => $body
		);
		if(!empty($tipo)) {
			$parametros["type"] = $tipo;
		}

		$response = $this->get_cliente_elasticsearch()->ejecutar_consulta($parametros);
		return ($response);
	}

	public function contar_resultados_elasticsearch($body) {
		$parametros = array(
				"index" => "documentos",
				"body" => $body
		);

		$response = $this->get_cliente_elasticsearch()->contar_resultados($parametros);
		return ($response);
	}

	public function validar_consulta_elasticsearch($body, $indice="_all", $tipo=null) {
		$parametros = array(
				"index" => $indice,
				"body" => $body
		);
		if(!empty($tipo)) {
			$parametros["type"] = $tipo;
		}

		$response = $this->get_cliente_elasticsearch()->contar_resultados($parametros);
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
			$config = busca_filtro_tabla("", "configuracion", "tipo='elasticsearch'", "", $conn);
			if($config["numcampos"]) {
				for($i = 0; $i < $config["numcampos"]; $i++) {
					switch ($config[$i]["nombre"]) {
						case "servidor_elasticsearch" :
							$servidor = $config[$i]["valor"];
							break;
						case "puerto_elasticsearch" :
							$puerto = $config[$i]["valor"];
							break;
					}
				}
				$hosts = [
						"$servidor:$puerto"
				];
				$this->cliente_elasticsearch = new elasticsearch_saia($hosts);
			} else {
				$this->cliente_elasticsearch = new elasticsearch_saia();
			}
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
		$nombre_tabla = $info_doc["nombre_tabla"];
		$nombre_formato = $info_doc["nombre_formato"];
		$datos_ft = $this->cargar_informacion_ft2($nombre_tabla, $iddocumento);

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
			foreach ($documento[0] as $key => $valor ) {
				if (!is_int($key)) {
					$datos_temporal["documento"][$key] = $valor;
				}
			}
			$datos_temporal["documento"]["nombre_tabla_ft"] = $nombre_tabla;
		}

		if (@$datos_ft["numcampos"]) {
			foreach ( $datos_ft[0] as $key => $valor ) {
				if (!is_int($key)) {
					$datos_temporal[$nombre_tabla][$key] = $this->obtener_valor_campo($key, $info_doc["idformato"], $iddocumento);
				}
			}
			$datos_temporal[$nombre_tabla]["nombre_formato"] = $nombre_formato;
		}
		return ($datos_temporal);
	}

	private function obtener_info_item($tabla_ft, $iddocumento, $idformato) {
		$datos_temporal = array();

		$datos_ft = $this->cargar_informacion_item($tabla_ft, $iddocumento);

		if (!$datos_ft["numcampos"]) {
			throw new \Exception("Existe un error al tratar de buscar el item con id " . $iddocumento);
		}

		if (@$datos_ft["numcampos"]) {
			$pk = 'id' . $tabla_ft;
			foreach ( $datos_ft[0] as $key => $valor ) {
				if (!is_int($key)) {
					$datos_temporal[$tabla_ft][$key] = $this->obtener_valor_campo($key, $idformato, $iddocumento);
				}
			}
			$datos_temporal[$tabla_ft]["nombre_formato"] = preg_replace("/^ft_/m", "", $tabla_ft);
		}
		return ($datos_temporal);
	}

	private function obtener_info_hijos($iddocumento, $hijos, $idformato) {
		if (empty($iddocumento)) {
			return $hijos;
		}

		$info_formato = busca_filtro_tabla("idformato, nombre, nombre_tabla, item", "formato", "idformato=$idformato", "", $conn);

		if(!$info_formato["numcampos"]) {
			return $hijos;
		}
		$es_item1 = $info_formato[0]["item"] == '1';
		$tabla1 = $info_formato[0]["nombre_tabla"];
		$plantilla_padre = $info_formato[0]["nombre"];
		$idplantilla_padre = $info_formato[0]["idformato"];
		$formatos_hijos = busca_filtro_tabla("h.idformato, h.nombre, h.nombre_tabla, h.item", "formato h", "h.cod_padre = $idplantilla_padre", "", $conn);

		if($es_item1) {
			$datos_ft = $this->obtener_info_item($tabla1, $iddocumento, $idformato);
		} else {
			$datos_ft = $this->cargar_informacion_ft2($tabla1, $iddocumento);
		}

		$datos_hijos = array();
		for($i = 0; $i < $formatos_hijos["numcampos"]; $i++) {
			$plantilla = strtoupper($formatos_hijos[$i]["nombre"]);
			$tabla = $formatos_hijos[$i]["nombre_tabla"];
			$es_item = $formatos_hijos[$i]["item"] == '1';
			$idformato_hijo= $formatos_hijos[$i]["idformato"];
			$documentos_hijos = busca_filtro_tabla("", $tabla, $tabla1 . " = " . $datos_ft[0]["id" . $tabla1], "", $conn);
			if ($documentos_hijos["numcampos"]) {
				for($h = 0; $h < $documentos_hijos["numcampos"]; $h++) {
					if($es_item) {
						$id_hijo = $documentos_hijos[$h]["id$tabla"];
					} else {
						$id_hijo = $documentos_hijos[$h]["documento_iddocumento"];
					}
					if ($id_hijo) {
						$relacion = new StdClass();
						$relacion->id_padre = $iddocumento;
						$relacion->id_hijo = $id_hijo;
						$relacion->tipo_padre = strtoupper($plantilla_padre);
						$relacion->tipo_hijo = $plantilla;
						$relacion->hijo_es_item = $es_item;
						$relacion->idformato_hijo = $idformato_hijo;
						$relacion->tabla_hijo = $tabla;
						$datos_hijos[] = $relacion;
						$datos_hijos = $this->obtener_info_hijos($id_hijo, $datos_hijos, $idformato_hijo);
					}
				}
			}
		}
		return  array_merge($hijos, $datos_hijos);
	}

	private function buildTree(array $elements, $parentId = 0) {
		$branch = array();

		foreach ($elements as $element) {
			if ($element->id_padre == $parentId) {
				$children = $this->buildTree($elements, $element->id_hijo);
				if ($children) {
					$element->hijos = $children;
				}
				$branch[] = $element;
			}
		}

		return $branch;
	}

	// Se debe tener en cuenta que el documento ya debe estar cargado
	public function indexar_elasticsearch_completo() {
		$doc_ppal = $this->iddocumento;
		$documento_origen = $this->obtener_info_doc($doc_ppal);

		if ($documento_origen) {
			$nombre_tabla = $documento_origen["documento"]["nombre_tabla_ft"];

			$hijos = array();

			$idformato = $documento_origen["documento"]["formato_idformato"];

			$hijos = $this->obtener_info_hijos($doc_ppal, $hijos, $idformato);
			$total = count($hijos);
			if ($total > 0) {
				$params = [
						"index" => "documentos",
						"type" => $documento_origen["documento"]["plantilla"],
						"id" => $doc_ppal
				];
				$params["documento"] = $documento_origen["documento"];
				$params[$nombre_tabla] = $documento_origen[$nombre_tabla];
				$resultado_indice = $this->guardar_indice_simple($params, $nombre_tabla);
				if (!$resultado_indice["created"]) {
					echo "No creado: ", $doc_ppal, "<br>";
					return true;
					print_r($resultado_indice);
					throw new \Exception("No fue posible crear el indice");
					die();
				}

				$arreglo_hijos = array();
				// Primero es necesario crear el mapeo entre el documento padre y sus hijos
				foreach ( $hijos as $hijo ) {
					if ($hijo->hijo_es_item) {
						$datos_hijo = $this->obtener_info_item($hijo->tabla_hijo, $hijo->id_hijo, $hijo->idformato_hijo);
					} else {
						$datos_hijo = $this->obtener_info_doc($hijo->id_hijo);
					}
					if ($datos_hijo) {
						$resultado_indice = $this->guardar_indice_simple($datos_hijo, $hijo->tabla_hijo, $hijo->id_padre);
					}
				}
			} else {
				$resultado_indice = $this->guardar_indice_simple($documento_origen, $nombre_tabla);
				if (!$resultado_indice["created"]) {
					echo "No creado: ", $doc_ppal, "<br>";
				}
			}
		} else {
			throw new \Exception("Error al tomar los datos del registro " . $this->iddocumento);
		}

		return (true);
	}

	private function guardar_indice_simple($datos, $nombre_tabla, $padre=null) {
		if ($datos) {
			$indice = "documentos";
			$tipo_dato = $datos["documento"]["plantilla"];
			$id = $datos["documento"]["iddocumento"];

			if(empty($nombre_tabla)) {
				print_r($datos);
				throw new \Exception("Sin nombre tabla $nombre_tabla" . $this->iddocumento);
			}

			if(empty($id)) {
				$nombre = $datos[$nombre_tabla]["nombre_formato"];
				$id = $datos[$nombre_tabla]["id$nombre_tabla"];
			}
			if(empty($id)) {
				print_r($datos);
				throw new \Exception("Sin ID $nombre_tabla " . $this->iddocumento);
			}
			if(empty($tipo_dato)) {
				$tipo_dato= strtoupper($datos[$nombre_tabla]["nombre_formato"]);
			}
			if(empty($tipo_dato)) {
				print_r($datos);
				throw new \Exception("Sin Tipo Indice $nombre_tabla " . $this->iddocumento);
			}
			$salida = "";
			try {
				$salida = $this->get_cliente_elasticsearch()->adicionar_indice_simple($indice, $id, $datos, $tipo_dato, $padre);
			} catch (Exception $e) {
				echo 'Excepción capturada: ',  $e->getMessage(), "<br>", $e->getTraceAsString(), "<br>";
				die();
			}
			return $salida;
		}
		return false;
	}

	private function guardar_configuracion_indice($params) {
		if ($params) {
			return ($this->get_cliente_elasticsearch()->guardar_configuracion_indice($params));
		}
		return false;
	}

	private function guardar_mapeo_indice($params) {
		if ($params) {
			return ($this->get_cliente_elasticsearch()->guardar_mapeo_indice($params));
		}
		return false;
	}

	private function guardar_indice($params) {
		if ($params) {
			return ($this->get_cliente_elasticsearch()->adicionar_indice($params));
		}
		return false;
	}

	private function existe_indice($nombre) {
		if ($params) {
			return ($this->get_cliente_elasticsearch()->existe_indice($nombre));
		}
	}

	public function crear_indice_saia() {
		$formatos = busca_filtro_tabla("idformato, nombre, nombre_tabla", "formato", "cod_padre = 0", "nombre ", $conn);
		$mapa_formatos = array();
		$params = array(
				"index" => "documentos"
		);
		$mapeo_datos_doc = $this->obtener_mapeo_doc();
		// print_r($mapeo_datos_doc);die();
		for($i = 0; $i < $formatos["numcampos"]; $i++) {
			$mapeo_datos_padre = $this->obtener_mapeo_formato($formatos[$i]["idformato"]);
			$hijos = array();
			// $hijos = $this->obtener_formato_hijo($hijos, $formatos[$i]["idformato"]);
			$hijos = $this->obtener_formato_hijo($hijos, $formatos[$i]["idformato"]);
			$tipo_indice = strtoupper($formatos[$i]["nombre"]);
			$mapa_formatos[] = $hijos;
			$params["body"]["mappings"][$tipo_indice] = [
					"_source" => [
							"enabled" => true
					]
			];
			$params["body"]["mappings"][$tipo_indice]["properties"]["documento"] = $mapeo_datos_doc;
			if (!empty($mapeo_datos_padre)) {
				$params["body"]["mappings"][$tipo_indice]["properties"][$formatos[$i]["nombre_tabla"]] = $mapeo_datos_padre;
			}
			$num_hijos = count($hijos);
			for($h = 0; $h < $num_hijos; $h++) {
				$mapeo_datos_ft = $this->obtener_mapeo_formato($hijos[$h]->idformato_hijo);
				$tipo_indice = $hijos[$h]->tipo_hijo;
				// print_r($mapeo_datos_ft);die();
				$params["body"]["mappings"][$tipo_indice] = [
						"_source" => [
								"enabled" => true
						],
						"_parent" => [
								"type" => $hijos[$h]->tipo_padre
						]
				];
				$mapeo_datos["body"]["mappings"][$tipo_indice]["properties"]["documento"] = $mapeo_datos_doc;
				if (!empty($mapeo_datos_ft)) {
					$mapeo_datos["body"]["mappings"][$tipo_indice]["properties"][$hijos[$h]->nombre_tabla] = $mapeo_datos_ft;
				}
			}
		}
		return $this->guardar_indice($params);
	}

	private function obtener_formato_hijo($hijos, $idformato) {
		if (empty($idformato)) {
			return $hijos;
		}

		$info_formato = busca_filtro_tabla("idformato, nombre, nombre_tabla, item", "formato", "idformato=$idformato", "", $conn);

		if (!$info_formato["numcampos"]) {
			return $hijos;
		}
		$es_item1 = $info_formato[0]["item"] == '1';
		$tabla1 = $info_formato[0]["nombre_tabla"];
		$plantilla_padre = $info_formato[0]["nombre"];
		$idplantilla_padre = $info_formato[0]["idformato"];
		$formatos_hijos = busca_filtro_tabla("h.idformato, h.nombre, h.nombre_tabla, h.item", "formato h", "h.cod_padre = $idplantilla_padre", "", $conn);
		$datos_hijos = array();
		for($i = 0; $i < $formatos_hijos["numcampos"]; $i++) {
			$plantilla = strtoupper($formatos_hijos[$i]["nombre"]);
			$tabla = $formatos_hijos[$i]["nombre_tabla"];
			$es_item = $formatos_hijos[$i]["item"] == '1';
			$idformato_hijo = $formatos_hijos[$i]["idformato"];
			$relacion = new StdClass();
			$relacion->tipo_padre = strtoupper($plantilla_padre);
			$relacion->tipo_hijo = $plantilla;
			$relacion->hijo_es_item = $es_item;
			$relacion->idformato_hijo = $idformato_hijo;
			$relacion->idformato_padre = $idplantilla_padre;
			$ralacion->nombre_tabla = $tabla;
			$datos_hijos[] = $relacion;
			$datos_hijos = $this->obtener_formato_hijo($datos_hijos, $idformato_hijo);
		}
		return array_merge($hijos, $datos_hijos);
	}

	private function obtener_mapeo_formato($idformato) {
		global $conn;
		$tipos = array(
				"TEXT" => "text",
				"DATE" => "date",
				"VARCHAR" => "text",
				"INT" => "integer",
				"CHAR" => "text",
				"DATETIME" => "date",
				"NUMBER" => "integer"
		);
		$campos = busca_filtro_tabla("nombre, tipo_dato", "campos_formato", "formato_idformato = $idformato and lower(nombre) <> 'estado_documento'", "", $conn);
		$mapeo = [];
		for($i = 0; $i < $campos["numcampos"]; $i++) {
			$tipo_dato = $tipos[$campos[$i]["tipo_dato"]];
			if (empty($tipo_dato)) {
				$tipo_dato = "text";
			}
			/*
			 * if ($tipo_dato == "date") {
			 * $mapeo["properties"][$campos[$i]["nombre"]] = [
			 * "type" => $tipo_dato,
			 * "format" => "yyyy-MM-dd HH:mm:ss"
			 * ];
			 * } else {
			 */
			$mapeo["properties"][$campos[$i]["nombre"]] = [
					"type" => $tipo_dato
			];
			// }
		}
		return $mapeo;
	}

	private function obtener_mapeo_doc() {
		$mapeo["properties"] = [
				"activa_admin" => [
						"type" => "text"
				],
				"almacenado" => [
						"type" => "integer"
				],
				"descripcion" => [
						"type" => "text"
				],
				"dias" => [
						"type" => "text"
				],
				"documento_antiguo" => [
						"type" => "integer"
				],
				"ejecutor" => [
						"type" => "text"
				],
				"estado" => [
						"type" => "text"
				],
				"fecha" => [
						"type" => "date"/*,
						"format" => "yyyy-MM-dd HH:mm:ss"*/
				],
				"fecha_creacion" => [
						"type" => "date" /*,
						"format" => "yyyy-MM-dd HH:mm:ss"*/
				],
				"fk_idversion_documento" => [
						"type" => "integer"
				],
				"formato_idformato" => [
						"type" => "integer"
				],
				"guia_empresa" => [
						"type" => "integer"
				],
				"iddocumento" => [
						"type" => "integer"
				],
				"municipio_idmunicipio" => [
						"type" => "integer"
				],
				"nombre_contador" => [
						"type" => "text"
				],
				"nombre_serie" => [
						"type" => "text"
				],
				"numero" => [
						"type" => "text"
				],
				"paginas" => [
						"type" => "integer"
				],
				"pantalla_idpantalla" => [
						"type" => "text"
				],
				"pdf" => [
						"type" => "text"
				],
				"pdf_hash" => [
						"type" => "text"
				],
				"plantilla" => [
						"type" => "text"
				],
				"responsable" => [
						"type" => "integer"
				],
				"serie" => [
						"type" => "integer"
				],
				"tipo_radicado" => [
						"type" => "integer"
				],
				"version" => [
						"type" => "integer"
				]
		];

		return $mapeo;
	}

	private function obtener_valor_campo($campo, $idformato, $iddoc) {
		global $conn, $ruta_db_superior;
		$datos = busca_filtro_tabla("nombre_tabla,detalle,etiqueta_html,valor,item,tipo_dato,autoguardado,A.nombre as formato,ruta_adicionar,ruta_editar,ruta_mostrar,tipo_edicion", "formato A,campos_formato B", "B.formato_idformato=A.idformato AND A.idformato=" . $idformato . " AND B.nombre LIKE '" . $campo . "'", "", $conn);
		// print_r($datos);
		if ($datos[0]["item"]) {
			$llave = "id" . $datos[0]["nombre_tabla"];
		} else {
			$llave = "documento_iddocumento";
		}
		$retorno = "";
		if ($datos["numcampos"]) {
			$campos = busca_filtro_tabla($campo, $datos[0]["nombre_tabla"], $llave . "=" . $iddoc, "", $conn);
			/*if (($iddoc == 1393 || $iddoc == 27) && preg_match("/fecha/", $campo)) {
				print_r($campos);
				die();
			}*/
			if ($campos["numcampos"]) {
				switch ($datos[0]["etiqueta_html"]) {
					/*case "arbol" :
						$tipo_arbol = explode(";", $datos[0]["valor"]);
						$idcampo = busca_filtro_tabla("idcampos_formato", "campos_formato", "nombre like '$campo' and formato_idformato=$idformato", "", $conn);
						$retorno = mostrar_seleccionados($idformato, $idcampo[0][0], $tipo_arbol[6], $iddoc, 1);
						break;*/
					case "archivo" :
						include_once ("../../anexosdigitales/funciones_archivo.php");
						$idcampo = busca_filtro_tabla("idcampos_formato", "campos_formato", "nombre like '$campo' and formato_idformato=$idformato", "", $conn);
						$retorno = listar_anexos_ver_descargar($idformato, $iddoc, $idcampo[0][0], $_REQUEST["tipo"], 1);
						break;
					case "autocompletar" :
						$retorno = $campos[0][0];
						break;
					case "textarea" :
						$retorno = codifica_encabezado(html_entity_decode($campos[0][0]));
						break;
					case "link" :
						if (basename($_SERVER["PHP_SELF"]) == basename($datos[0]["ruta_mostrar"])) {
							$retorno = "<a target='_blank' href='" . $campos[0][0] . "'>" . $campos[0][0] . "</a>";
						}
						break;
					case "valor" :
						if (strpos($_SERVER["PHP_SELF"], "edit") === false) {
							$retorno = "$" . number_format($campos[0][$campo], 0, ",", ".");
						}
						break;
					case "ejecutor" :
						if (basename($_SERVER["PHP_SELF"]) != basename($datos[0]["ruta_adicionar"]) && basename($_SERVER["PHP_SELF"]) != basename($datos[0]["ruta_editar"])) {
							if ($datos[0]["valor"] == "") {
								$parametros = array(
										"multiple",
										"nombre,identificacion",
										""
								);
							} else
								$parametros = explode("@", $datos[0]["valor"]);
							$ejecutores = busca_filtro_tabla("", "ejecutor,datos_ejecutor", "ejecutor_idejecutor=idejecutor and iddatos_ejecutor in(" . $campos[0][$campo] . ")", "", $conn);
							if ($parametros[3] != "") {
								include_once ($ruta_db_superior . "/formatos/librerias/funciones_ejecutor.php");
								$retorno .= llamado_ejecutor($parametros[3], $campo, $idformato, $iddoc);
							} else {

								$vector_mostrar = array(
										"nombre"
								);
								foreach ( $vector_mostrar as $fila_e ) {
									for($h = 0; $h < $ejecutores["numcampos"]; $h++) {
										if ($fila_e == "ciudad") {
											if ($ejecutores[$h][$fila_e]) {
												$ciudad = busca_filtro_tabla("nombre", "municipio", "idmunicipio=" . $ejecutores[$h][$fila_e], "", $conn);
												$datos_mostrar[$h][$fila_e] = $ciudad[0][0];
											} else
												$datos_mostrar[$h][$fila_e] = "&nbsp;";
										} else
											$datos_mostrar[$h][$fila_e] = $ejecutores[$h][$fila_e];
									}
								}
								if ($parametros[0] == "unico") {
									if ($parametros[4] == "1") {
										$retorno .= "<table>";
										foreach ( $datos_mostrar[0] as $nombre => $fila ) {
											if ($fila != "")
												$retorno .= "<tr><td>" . ucfirst($nombre) . ":</td><td>" . $fila . "</td></tr>";
										}
										$retorno .= "</table>";
									} else {
										$retorno = implode(", ", array_values($datos_mostrar[0]));
									}
								} elseif ($parametros[0] == "multiple") {
									if ($parametros[4] == "1") {
										$retorno .= "<table border='1' width=100% style='border-collapse:collapse'>";
										$retorno .= "<tr align='center' bgcolor='lightgray' style='text-transform:capitalize'><td>" . implode("&nbsp;</td><td>", array_keys($datos_mostrar[0])) . "</td></tr><tr>";
										for($h = 0; $h < count($datos_mostrar); $h++) {
											$retorno .= "<td>" . implode("&nbsp;</td><td>", array_values($datos_mostrar[$h])) . "</td>";
											$retorno .= "</tr>";
										}
										$retorno .= "</table>";
									} else {
										for($h = 0; $h < count($datos_mostrar); $h++) {
											$retorno .= str_replace(", ,", "", implode(", ", array_values($datos_mostrar[$h])) . "<br />");
										}
									}
								}
							}
						} else {
							$retorno = $campos[0][$campo];
						}
						break;
					case "fecha":
						if($campos[0][0]instanceof DateTime) {
							$retorno = $campos[0][0]->format("c");
						} else {
							$date=date_create($campos[0][0]);
							$retorno = $date->format("c");
						}
						if(empty($retorno)) {
							$retorno = null;
						}
						break;
					default :
						if(preg_match("/DATE|TIMESTAMP/", $datos[0]["tipo_dato"])) {
							if($campos[0][0]instanceof DateTime) {
								$retorno = $campos[0][0]->format("c");
							} else {
								$date=date_create($campos[0][0]);
								$retorno = $date->format("c");
							}
							if(empty($retorno)) {
								$retorno = null;
							}
						} else {
							$retorno = $campos[0][$campo];
						}
				}
			}
			if ($datos[0]["etiqueta_html"] == "textarea") {
				$retorno = stripslashes($retorno);
			} else
				$retorno = str_replace('"', "", stripslashes($retorno));
			if ($_REQUEST["tipo"] != 5 && basename($_SERVER["PHP_SELF"]) != basename($datos[0]["ruta_editar"])) {
				$retorno = str_replace("<p><!-- pagebreak --></p>", "<!-- pagebreak -->", $retorno);
				$retorno = str_replace("<!-- pagebreak -->", "<div class='page_break'></div>", $retorno);
			} else if (basename($_SERVER["PHP_SELF"]) != basename($datos[0]["ruta_editar"])) {
				$conf = busca_filtro_tabla("", "configuracion a", "a.nombre='exportar_pdf'", "", $conn);
				if ($conf[0]["valor"] == "html2ps") {
					$retorno = str_replace("<!-- pagebreak -->", '<pagebreak/>', $retorno);
				} else if ($conf[0]["valor"] == "class_impresion") {
					$retorno = str_replace("<!-- pagebreak -->", '<br pagebreak="true"/>', $retorno);
				} else {
					$retorno = str_replace("<!-- pagebreak -->", '<pagebreak/>', $retorno);
				}
			}
			/*if(preg_match("/fecha_ruta_distribuc/", $campo)) {
				echo $retorno . "<br>";
				print_r($datos[0]);
				echo "Valor: '$retorno'" . "<br>";
				print_r($campos);
				die($campo);
			}*/

			return (stripslashes($retorno));
		}
	}
}
?>
