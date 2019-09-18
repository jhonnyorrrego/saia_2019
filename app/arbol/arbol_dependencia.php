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

header('Content-Type: application/json');

$arbol = new ArbolDependencia($_REQUEST);
$objetoJson = $arbol->crear_arbol();
echo json_encode($objetoJson);

class ArbolDependencia
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

        $hijos_dep = $this->llena_dependencia(0);
        if (!empty($hijos_dep)) {
            $hijos = $hijos_dep;
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
            $this->condicion_ad .= " and iddependencia not in (" . $this->parametros["excluidos"] . ")";
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

    private function llena_dependencia($id)
    {
        $objetoJson = [];
        if ($id == 0) {
            $papas = busca_filtro_tabla("", "dependencia", "(cod_padre=0 or cod_padre is null)" . $this->condicion_ad, "nombre ASC");
        } else {
            $papas = busca_filtro_tabla("", "dependencia", "cod_padre=" . $id . $this->condicion_ad, "nombre ASC");
        }
        if ($papas["numcampos"]) {
            for ($i = 0; $i < $papas["numcampos"]; $i++) {
                $item = [];

                $text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")";
                if ($papas[$i]["estado"] == 0) {
                    $text .= " - INACTIVO";
                    $item["unselectableStatus"] = true;
                }

                $item["extraClasses"] = "estilo-dependencia";
                $item["title"] = $text;
                $item["key"] = $papas[$i]["iddependencia"];
                $item["checkbox"] = $this->checkbox;

                if ($this->expandir == 1) {
                    $item["expanded"] = true;
                }

                if ($this->cantSel) {
                    if (in_array($papas[$i]["iddependencia"], $this->seleccionados) !== false) {
                        $item["selected"] = true;
                    }
                }

                if ($this->fields) {
                    foreach ($this->fields as $field) {
                        if ($field != 'logo') {
                            $item['data'][$field] = $papas[$i][$field];
                        } else {
                            $image = TemporalController::createTemporalFile($papas[$i][$field], uniqid(), true);
                            if ($image->success) {
                                $item['data'][$field] = $image->route;
                            } else {
                                $item['data'][$field] = '';
                            }
                        }
                    }
                }

                if ($this->unSelectables && in_array($papas[$i]["iddependencia"], $this->unSelectables)) {
                    $item["unselectableStatus"] = true;
                }

                $hijos = busca_filtro_tabla("count(*) as cant", "dependencia", "cod_padre=" . $papas[$i]["iddependencia"] . $this->condicion_ad, "");
                if ($hijos[0]["cant"]) {
                    $item["children"] = $this->llena_dependencia($papas[$i]["iddependencia"], $enableCheck);
                }
                $objetoJson[] = $item;
            }
        }
        return $objetoJson;
    }
}
