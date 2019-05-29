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
include_once $ruta_db_superior . "db.php";
include_once $ruta_db_superior . "controllers/autoload.php";

header('Content-Type: application/json');

$arbol = new ArbolCargo($_REQUEST);
$objetoJson = $arbol->crear_arbol();
echo json_encode($objetoJson);

class ArbolCargo
{
    public $parametros = [];
    private $seleccionados = [];
    private $cantSel = 0;
    private $expandir = 0;
    private $condicion_ad = '';
    public $checkbox = 1;
    public $fields = 1;

    public $enableCheck = false;
    public $depserie = 0;

    public function __construct($parametros)
    {
        $this->parametros = $parametros;
    }

    public function crear_arbol()
    {
        $hijos = [];
        $objetoJson = [
            'key' => 0
        ];

        $this->configurar();

		$id = 0;
		if ($this->parametros["id"]) {
			$id = $this->parametros["id"];
			$objetoJson["key"] = $this->parametros["id"];
		}

        $hijos_cargo = $this->llena_cargo($id);
        if (!empty($hijos_cargo)) {
            $hijos = $hijos_cargo;
        }
        $objetoJson['children'] = $hijos;

		return $objetoJson;
    }

    private function configurar()
    {
        if (!empty($this->parametros["estado"])) {
            $this->condicion_ad .= " and estado=" . $this->parametros["estado"];
        }

        if (!empty($this->parametros["seleccionados"])) {
            $this->seleccionados = explode(",", $this->parametros["seleccionados"]);
            $this->cantSel = count($this->seleccionados);
        }

        if (!empty($this->parametros["excluidos"])) {
            $this->condicion_ad .= " and idcargo not in (" . $this->parametros["excluidos"] . ")";
        }

        if (!empty($this->parametros["expandir"])) {
            $this->expandir = $this->parametros["expandir"];
        }

        if (isset($this->parametros["checkbox"])) {
            $this->checkbox = $this->parametros["checkbox"];
        }

        if (isset($this->parametros["fields"])) {
            $this->fields = $this->parametros["fields"];
        }

        if (isset($this->parametros["unSelectables"])) {
            $this->unSelectables = $this->parametros["unSelectables"];
        }
	}
	
	private function llena_cargo($id) {
		
		$objetoJson = [];
		if ($id == 0) {
			$papas = busca_filtro_tabla("", "cargo", "(cod_padre=0 or cod_padre is null)" . $this->condicion_ad, "nombre ASC", $conn);
		} else {
			$papas = busca_filtro_tabla("", "cargo", "cod_padre=" . $id . $this->condicion_ad, "nombre ASC", $conn);
		}
		if ($papas["numcampos"]) {
			for ($i = 0; $i < $papas["numcampos"]; $i++) {
				$item = [];
				$text = $papas[$i]["nombre"];
				if ($papas[$i]["estado"] == 0) {
					$item["unselectableStatus"] = true;
					$item["folder"] = 1;
				}
				
				$item["extraClasses"] = "estilo-dependencia";
				$item["title"] = $text;
				$item["key"] = $papas[$i]["idcargo"];
				$item["checkbox"]=$checkbox;
				
				if ($this->expandir == 1) {
					$item["expanded"] = true;
				}
				
				if ($this->cantSel) {
					if (in_array($papas[$i]["idcargo"], $this->seleccionados) !== false) {
						$item["selected"] = true;
					}
				}
	
				foreach ($_REQUEST['fields'] as $field){
					$item['data'][$field] = $papas[$i][$field];
				}
	
				if ($this->unSelectables && in_array($papas[$i]["idcargo"], $this->unSelectables)) {
					$item["unselectableStatus"] = true;
				}
	
				$hijos = busca_filtro_tabla("count(*) as cant", "cargo", "cod_padre=" . $papas[$i]["idcargo"] . $condicion_ad, "", $conn);
				if ($hijos[0]["cant"]) {
					$item["children"] = $this->llena_cargo($papas[$i]["idcargo"]);
				} else {
					$item["folder"] = 0;
				}
				$objetoJson[] = $item;
			}
		}
		return $objetoJson;
	}

}
//-----------------------


?>