<?php
class FlujoXML {
	private $archivo;
	private $contenido;
	private $documento;
	private $xpath;
	private $ns_bp = "bpmn:";
	private $ns_di = "bpmndi:";
	private $ns_dc = "dc:";
	private $ns_di2 = "di:";
	private $ns_list = array(
		"bpmn" => "http://www.omg.org/spec/BPMN/20100524/MODEL",
		"bpmndi" => "http://www.omg.org/spec/BPMN/20100524/DI",
		"dc " => "http://www.omg.org/spec/DD/20100524/DC",
		"di " => "http://www.omg.org/spec/DD/20100524/DI"
	);

	public function __construct(array $parametros) {
		if(isset($parametros["contenido"]) && !empty($parametros["contenido"])) {
			$this->contenido = $parametros["contenido"];
		} else if(isset($parametros["archivo"]) && !empty($parametros["archivo"])) {
			$this->archivo = $parametros["archivo"];
			$this->contenido = file_get_contents($this->archivo);
		}
		$this->inicializar();
	}

	private function inicializar() {
		$this->documento = new DOMDocument();
		$this->documento->loadXML($this->contenido);
		$this->xpath = new DOMXpath($this->documento);
		$this->inicializar_ns();
	}

	private function inicializar_ns() {
		foreach($this->ns_list as $key => $value) {
			$this->xpath->registerNamespace($key, $value);
		}
	}

	public function getDocumento() {
		return $this->documento;
	}

	public function obtenerElementos() {
		$eventos = $this->obtenerEventos();
		$resp = [];
		$resp["tareas"] = $this->obtenerTareas();
		$resp["condiciones"] = $this->obtenerPuertas();
		$resp["enlaces"] = $this->obtenerEnlaces();
		$resp = array_merge($resp, $eventos);
		return $resp;
	}

	private function iterarHijos($elements) {
		$result = array();
		if($elements) {
			foreach($elements as $element) {
				$nodes = $element->childNodes;
				foreach($nodes as $node) {
					if(!empty($node->nodeValue)) {
						$result[] = trim($node->nodeValue);
					}
				}
			}
		}
		return $result;
	}

	private function extraerDatos($element) {
		$result = null;
		if($element) {
			$result = ["id" => $element->getAttribute("id"), "nombre" => trim($element->getAttribute("name")), "tipo" => $element->localName];
			$enlacesIn = [];
			$enlacesOut = [];
			//var_dump($element);
			$nodo_in = $this->xpath->query("{$this->ns_bp}incoming", $element)->item(0);
			if($nodo_in) {
				$enlacesIn[] = $this->obtenerSecuencia($nodo_in->nodeValue);
			}
			$nodo_out = $this->xpath->query("{$this->ns_bp}outgoing", $element)->item(0);
			if($nodo_out) {
				$enlacesOut[] = $this->obtenerSecuencia($nodo_out->nodeValue);
			}
			$result["in"] = $enlacesIn;
			$result["out"] = $enlacesOut;
		}
		return $result;
	}

	private function iterarElementos(DOMNodeList $elements) {
		$result = array();
		if($elements) {
			foreach($elements as $element) {
				$datos = $this->extraerDatos($element);
				if(!empty($datos)) {
					$result[] = $datos;
				}
			}
		}
		return $result;
	}

	private function iterarEnlaces(DOMNodeList $elements) {
		$result = array();
		if($elements) {
			foreach($elements as $element) {
				$id = $element->getAttribute("id");
				$nombre = trim($element->getAttribute("name"));
				if(empty($nombre)) {
					$nombre = $id;
				}
				$tarea = ["id" => $id,
					"nombre" => $nombre,
					"tipo" => $element->localName,
					"origen" => trim($element->getAttribute("sourceRef")),
					"destino" => trim($element->getAttribute("targetRef"))
				];
				$result[] = $tarea;
			}
		}
		return $result;
	}

	public function obtenerTareas() {
		$elements = $this->xpath->query("/{$this->ns_bp}definitions/{$this->ns_bp}process/{$this->ns_bp}task");
		//$elements = $this->xpath->query("/definitions");
		//var_dump($elements);
		$notas = $this->iterarElementos($elements);
		return $notas;
	}

	public function obtenerEnlaces() {
		$elements = $this->xpath->query("/{$this->ns_bp}definitions/{$this->ns_bp}process/{$this->ns_bp}sequenceFlow");
		//$elements = $this->xpath->query("/definitions");
		//var_dump($elements);
		$notas = $this->iterarEnlaces($elements);
		return $notas;
	}

	public function obtenerPuertas() {
	    $tiposPuerta = ["exclusiveGateway", "parallelGateway", "inclusiveGateway"];
	    $puertas = [];
	    foreach ($tiposPuerta as $tipo) {
	        $elements = $this->xpath->query("/{$this->ns_bp}definitions/{$this->ns_bp}process/{$this->ns_bp}{$tipo}");
	        $puerta = $this->iterarElementos($elements);
	        if(!empty($puerta)) {
	            $puertas = array_merge($puertas, $puerta);
	        }
	    }
	    return $puertas;
	}

	public function obtenerEventos() {
		$tiposEvento = ["startEvent", "endEvent"];
		$eventos = [];
		foreach ($tiposEvento as $tipo) {
			$elements = $this->xpath->query("/{$this->ns_bp}definitions/{$this->ns_bp}process/{$this->ns_bp}{$tipo}");
			$puerta = $this->extraerDatos($elements->item(0));
			if(!empty($puerta)) {
				$eventos [$tipo] = $puerta;
			}
		}
		return $eventos;
	}

	private function obtenerTipoElemento($id) {
		$elements = $this->xpath->query("//*[@id='$id']");
		$resp = null;
		if($elements && $elements->length>0) {
			$elemento = $elements->item(0);
			//var_dump($elemento);die();
			$resp = $elemento->localName;
		}
		return $resp;
	}

	private function obtenerSecuencia($id) {
		//<bpmn:sequenceFlow id="SequenceFlow_1a8k0fl" sourceRef="Task_1qj4pxu" targetRef="Task_1udyaui" />
		$elements = $this->xpath->query("//{$this->ns_bp}sequenceFlow[@id='$id']");
		$resp = [];
		if($elements && $elements->length>0) {
			$evento = $elements->item(0);
			$id1 = $evento->getAttribute("id");
			$origen = $evento->getAttribute("sourceRef");
			$destino = $evento->getAttribute("targetRef");
			$to = $this->obtenerTipoElemento($origen);
			$td = $this->obtenerTipoElemento($destino);
			$nombre = trim($evento->getAttribute("name"));
			if(empty($nombre)) {
				$nombre = $id1;
			}
			$resp = ["id" => $id1, "nombre" => $nombre, "origen" => $origen, "destino" => $destino, "tipo_origen" => $to, "tipo_destino" => $td];
		}
		return $resp;
	}
}