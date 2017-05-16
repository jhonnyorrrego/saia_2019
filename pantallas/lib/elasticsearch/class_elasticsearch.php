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
<?php include_once($ruta_db_superior."db.php"); ?>
<?php

class elasticsearch_saia {
	var $hosts;
	var $cliente;
	var $resultado;
	var $parametros;

	// var $error_saia;
	function __construct($hosts) {
		if ($hosts == '') {
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

	function connect() {
		global $ruta_db_superior;
		if (!file_exists($ruta_db_superior . 'vendor/autoload.php')) {
			$this->install_elasticsearch();
		}
		require $ruta_db_superior . 'vendor/autoload.php';
		$this->cliente = Elasticsearch\ClientBuilder::create()->setHosts($hosts)->build();
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

	function adicionar_indice_simple($indice, $id, $arreglo_datos, $tipo_dato, $padre=null) {
		if (!$this->existe_indice($indice)) {
			$this->crear_indice($indice);
		}
		$parametros['index'] = $indice;
		$parametros['id'] = $id;
		$parametros['body'] = $arreglo_datos;
		$parametros['type'] = $tipo_dato;
		if(!empty($padre)) {
			$parametros['parent'] = $padre;
		}
		return ($this->cliente->index($parametros));
	}

	function adicionar_indice($parametros) {
		return ($this->cliente->index($parametros));
	}


	function buscar_item_elastic($parametros, $json) {
		/*Ejemplo Json que se debe enviar con un arreglo de campos donde buscar
		 $json = '{
		 "query":{
		 "query_string" : {
		 "fields" : ["title", "author", "genre", "description"],
		 "query" : 'genre:adventure NOT verne' "
		 }
		 }
		 }';
		 Ejemplo Json cuando quiero buscar sobre un solo campo
		 $json = '{
		 "query" : {
		 "match" : {
		 "author" : "Jules Verne"
		 }
		 }
		 }';
		 */
		$parametros['body'] = $json;
		return ($this->resultado = $this->cliente->search($parametros));
	}

	function borrar_indice($indice, $id, $tipo_dato) {
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
}
?>