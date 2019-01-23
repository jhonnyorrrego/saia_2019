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

include_once($ruta_db_superior."db.php");

class elasticsearch_saia {
	var $hosts;
	var $cliente;
	var $resultado;
	var $parametros;

	// var $error_saia;
	function __construct($hosts) {
		if (empty($hosts)) {
			//'192.168.0.13:9200' 'localhost:9200'
			$hosts = [
					'localhost:9200'
			];
		}
		// $this->error_saia=new error_saia();
		$this->cliente = null;
		$this->hosts = $hosts;
		$this->connect();
	}

	function install_elasticsearch() {
		// print_r(exec('curl -s http://getcomposer.org/installer | php'));
		// print_r(exec('php composer.phar install --no-dev'));
	}

	public function connect() {
		global $ruta_db_superior;
		if (!file_exists($ruta_db_superior . 'vendor/autoload.php')) {
			require_once RUTA_ABS_SAIA . 'vendor/autoload.php';
			//$this->install_elasticsearch();
		} else {
			require_once $ruta_db_superior . 'vendor/autoload.php';
		}
		$this->cliente = Elasticsearch\ClientBuilder::create()->setHosts($this->hosts)->allowBadJSONSerialization()->build();
	}

	function crear_indice($indice) {
		$parametros['index'] = $indice;
		if (!$this->cliente->indices()->exists($parametros)) {
			$this->cliente->indices()->create($parametros);
		}
	}

	function existe_indice($indice) {
		$parametros['index'] = $indice;
		if ($this->cliente->indices()->exists($parametros)) {
			return (true);
		}
		return (false);
	}

	function adicionar_indice_simple($indice, $id, $arreglo_datos, $tipo_dato, $padre = null) {
		if (!$this->existe_indice($indice)) {
			$this->crear_indice($indice);
		}
		$parametros['index'] = $indice;
		$parametros['id'] = $id;
		$parametros['body'] = $arreglo_datos;
		$parametros['type'] = $tipo_dato;
		if (!empty($padre)) {
			$parametros['parent'] = $padre;
		}
		return ($this->cliente->index($parametros));
	}

	public function adicionar_indice($parametros) {
		$resultado = null;
		if (!$this->existe_indice($parametros["index"])) {
			$resultado = $this->cliente->indices()->create($parametros);
		} else {
			$resultado = ["created" => 1];
		}
		return $resultado;
	}

	function guardar_configuracion_indice($parametros) {
		return ($this->cliente->indices()->putSettings($parametros));
	}

	function obtener_configuracion_indice($parametros) {
		return ($this->cliente->indices()->getSettings($parametros));
	}

	function guardar_mapeo_indice($parametros) {
		return ($this->cliente->indices()->putMapping($parametros));
	}

	function obtener_mapeo_indice($parametros) {
		return ($this->cliente->indices()->getMapping($parametros));
	}

	public function buscar_item_elastic($parametros, $json) {
		/*
		 * Ejemplo Json que se debe enviar con un arreglo de campos donde buscar
		 * $json = '{
		 * "query":{
		 * "query_string" : {
		 * "fields" : ["title", "author", "genre", "description"],
		 * "query" : 'genre:adventure NOT verne' "
		 * }
		 * }
		 * }';
		 * Ejemplo Json cuando quiero buscar sobre un solo campo
		 * $json = '{
		 * "query" : {
		 * "match" : {
		 * "author" : "Jules Verne"
		 * }
		 * }
		 * }';
		 */
		$parametros['body'] = $json;
		return ($this->resultado = $this->cliente->search($parametros));
	}

	/**
	 * Ejecuta una consulta en el servidor elasticsearch con los parametros enviados. Debe traer parametros[index], parametros[body]
	 * @param unknown $parametros
	 * @return array
	 */
	public function ejecutar_consulta($parametros) {
		return ($this->resultado = $this->cliente->search($parametros));
	}

	public function contar_resultados($parametros) {
		return ($this->resultado = $this->cliente->count($parametros));
	}

	public function validar_consulta($parametros) {
		return ($this->resultado = $this->cliente->indices()->validate($parametros));
	}

	function borrar_documento_indice($indice, $id, $tipo_dato) {
		$parametros['index'] = $indice;
		$parametros['id'] = $id;
		$parametros['type'] = $tipo_dato;
		$response = $this->cliente->delete($parametros);
		return ($response);
	}

	public function verificar_indice($indice, $id, $tipo_dato) {
		$parametros = [
				'index' => $indice,
				'type' => $tipo_dato,
				'id' => $id,
				'client' => [
						'verbose' => true
				]
		];
		$response = $this->cliente->get($parametros);
		return ($response);
	}

	public function borrar_indice($parametros) {
		return ($this->resultado = $this->cliente->indices()->delete($parametros));
	}

}
?>