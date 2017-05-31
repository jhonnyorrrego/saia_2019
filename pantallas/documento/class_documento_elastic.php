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
			$datos_ft = busca_filtro_tabla('', 'ft_' . strtolower($plantilla) . " A", 'A.documento_iddocumento=' . $this->iddocumento, '', $conn);
			return $datos_ft;
		}
		return false;
	}

	private function cargar_informacion_ft2($plantilla, $iddocumento) {
		if ($iddocumento) {
			$tabla = 'ft_' . strtolower($plantilla);
			$datos_ft = busca_filtro_tabla("", "$tabla a", "a.documento_iddocumento = $iddocumento", "", $conn);
			return $datos_ft;
		}
		return false;
	}

	private function cargar_informacion_item($plantilla, $iddocumento) {
		if ($iddocumento) {
			$tabla = 'ft_' . strtolower($plantilla);
			$datos_ft = busca_filtro_tabla("", "$tabla a", "a.id$tabla = $iddocumento", "", $conn);
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
			$datos_temporal["datos_ft"]["nombre_formato"] = strtolower($plantilla);
		}
		return ($datos_temporal);
	}

	private function obtener_info_item($plantilla, $iddocumento, $idformato) {
		$datos_temporal = array();

		$datos_ft = $this->cargar_informacion_item($plantilla, $iddocumento);
		//print_r($datos_ft);die();
		// $this->cargar_adicional_documento();

		if (!$datos_ft["numcampos"]) {
			throw new \Exception("Existe un error al tratar de buscar el documento con id " . $iddocumento);
		}

		if (@$datos_ft["numcampos"]) {
			foreach ( $datos_ft[0] as $key => $valor ) {
				if (!is_int($key) && $key != "documento_iddocumento") {
					$datos_temporal["datos_ft"][$key] = mostrar_valor_campo($key, $idformato, $iddocumento, 1);
				}
			}
			$datos_temporal["datos_ft"]["nombre_formato"] = strtolower($plantilla);
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
			$datos_ft = $this->obtener_info_item($plantilla_padre, $iddocumento, $idformato);
		} else {
		$datos_ft = $this->cargar_informacion_ft2($plantilla_padre, $iddocumento);
		}

		//print_r($formatos_hijos);die();
		// print_r($datos_ft[0]);die();
		$datos_hijos = array();
		for($i = 0; $i < $formatos_hijos["numcampos"]; $i++) {
			$plantilla = strtoupper($formatos_hijos[$i]["nombre"]);
			$tabla = $formatos_hijos[$i]["nombre_tabla"];
			$es_item = $formatos_hijos[$i]["item"] == '1';
			$idformato_hijo= $formatos_hijos[$i]["idformato"];
			$documentos_hijos = busca_filtro_tabla("", $tabla, "ft_" . $plantilla_padre . " = " . $datos_ft[0]["idft_" . $plantilla_padre], "", $conn);
			// print_r($documentos_hijos);die();
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
						$datos_hijos[] = $relacion;
						// $datos_hijos[$iddocumento] = $id_hijo;
						// print_r($documentos_hijos[$h]);echo "<br>";
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
		// $this->asignar_iddocumento();
		// $this->obtener_info_hijos($this->iddocumento);
		$doc_ppal = $this->iddocumento;
		$documento_origen = $this->obtener_info_doc($doc_ppal);

		if ($documento_origen) {
			$hijos = array();

			$idformato = $documento_origen["documento"]["formato_idformato"];

			$hijos = $this->obtener_info_hijos($doc_ppal, $hijos, $idformato);
			//var_dump($hijos);
			//var_dump($this->buildTree($hijos));die();
			$total = count($hijos);
			if ($total > 0) {
				$params = [
						"index" => "documentos",
						"type" => $documento_origen["documento"]["plantilla"],
						"id" => $doc_ppal
				];
				$params["documento"] = $documento_origen["documento"];
				$params["datos_ft"] = $documento_origen["datos_ft"];
				$resultado_indice = $this->guardar_indice_simple($params);
				// $resultado_indice = $this->guardar_mapeo_indice($params);
				// print_r($resultado_indice);die();
				if (!$resultado_indice["_shards"]["successful"]) {
					print_r($resultado_indice);
					throw new \Exception("No fue posible crear el indice");
					die();
				}

				$arreglo_hijos = array();
				// Primero es necesario crear el mapeo entre el documento padre y sus hijos
				foreach ( $hijos as $hijo ) {
						if($hijo->hijo_es_item) {
							$datos_hijo = $this->obtener_info_item($hijo->tipo_hijo, $hijo->id_hijo, $hijo->idformato_hijo);
							//print_r($datos_hijo);die();
						} else {
						$datos_hijo = $this->obtener_info_doc($hijo->id_hijo);
						}
						if ($datos_hijo) {
						$resultado_indice = $this->guardar_indice_simple($datos_hijo, $hijo->id_padre);
						print_r($resultado_indice);
						//$arreglo_hijos[] = $datos_hijo;
						}
				}

				//$resultado_indice = null;
				//print_r($params);die();

				//Se debe indexar el documento padre
				/*if (count($arreglo_hijos) > 0) {
					foreach ( $arreglo_hijos as $hijo ) {
						print_r($hijo);die();
						$this->guardar_indice_simple($hijo, $documento_origen);
					}
				}*/
			} else {
				$this->guardar_indice_simple($arreglo_datos);
			}
		} else {
			throw new \Exception("Error al tomar los datos del registro " . $this->iddocumento);
		}

		return (true);
	}

	private function guardar_indice_simple($datos, $padre=null) {
		if ($datos) {
			//$datos_json = json_encode($datos);
			$indice = "documentos";
			$tipo_dato = $datos["documento"]["plantilla"];
			$id = $datos["documento"]["iddocumento"];

			if(empty($id)) {
				$nombre = $datos["datos_ft"]["nombre_formato"];
				$id = $datos["datos_ft"]["idft_$nombre"];
				//print_r($datos);die("kaput $id");
			}
			if(empty($tipo_dato)) {
				$tipo_dato= strtoupper($datos["datos_ft"]["nombre_formato"]);
				//print_r($datos);die("kaput $id");
			}
			$salida = "";
			try {
				$salida = $this->get_cliente_elasticsearch()->adicionar_indice_simple($indice, $id, $datos, $tipo_dato, $padre);
			} catch (\Exception $e) {
				print_r($e);
			}
			return $salida;
		}
	}

	private function guardar_configuracion_indice($params) {
		if ($params) {
			return ($this->get_cliente_elasticsearch()->guardar_configuracion_indice($params));
		}
	}

	private function guardar_mapeo_indice($params) {
		if ($params) {
			return ($this->get_cliente_elasticsearch()->guardar_mapeo_indice($params));
		}
	}

	private function guardar_indice($params) {
		if ($params) {
			return ($this->get_cliente_elasticsearch()->adicionar_indice($params));
		}
	}

	private function existe_indice($nombre) {
		if ($params) {
			return ($this->get_cliente_elasticsearch()->existe_indice($nombre));
		}
	}

	public function crear_indice_saia() {
		$formatos = busca_filtro_tabla("idformato, nombre, nombre_tabla", "formato", "cod_padre = 0", "nombre ", $conn);
		$mapa_formatos = array();
		$params = array("index" => "documentos");
		for($i = 0; $i < $formatos["numcampos"]; $i++) {
			$hijos= array();
			// $hijos = $this->obtener_formato_hijo($hijos, $formatos[$i]["idformato"]);
			$hijos = $this->obtener_formato_hijo($hijos, $formatos[$i]["idformato"]);
			$tipo_indice = strtoupper($formatos[$i]["nombre"]);
			$mapa_formatos[] = $hijos;
			$params["body"]["mappings"][$tipo_indice] = ["_source" => [
					"enabled" => true
			]];
			$num_hijos= count($hijos);
			for($h=0; $h<$num_hijos; $h++){
				$params["body"]["mappings"][$hijos[$h]->tipo_hijo] = ["_parent" => ["type" => $hijos[$h]->tipo_padre]];
			}
		}
		//print_r(json_encode($params));
		print_r($this->guardar_indice($params));
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
			//echo "$i<br>";
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
			$datos_hijos[] = $relacion;
			//$datos_hijos = array_merge($datos_hijos, $this->obtener_formato_hijo($idformato_hijo));
			$datos_hijos = $this->obtener_formato_hijo($datos_hijos, $idformato_hijo);
			//print_r($datos_hijos);
		}
		//print_r($datos_hijos); die();
		/*if (!empty($datos_hijos)) {
			$hijos=array_merge($hijos, $datos_hijos);
		}*/
		return array_merge($hijos, $datos_hijos);;
	}
}
?>
