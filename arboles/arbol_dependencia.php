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
include_once ($ruta_db_superior . "db.php");

// TERMINA DEFAULT

header('Content-Type: application/json');

$arbol = new ArbolDependencia($conn, $_REQUEST);
$objetoJson = $arbol->crear_arbol();
echo json_encode($objetoJson);

class ArbolDependencia {

    private $seleccionados = "";

    private $expandir = 0;

    private $condicion_ad = "";

    private $activado = false;

    public function __construct($conn, $parametros) {
        $this->conn = $conn;
        $this->parametros = $parametros;
    }

    public function crear_arbol() {
        $id = 0;
        $hijos = array();
        $hijos_dep = array();
        $objetoJson = array(
            "key" => 0
        );
        $this->configurar();
        if (isset($this->parametros["id"])) {
            $objetoJson["key"] = $this->parametros["id"];
            if ($id[0] == 0) {
                $hijos_dep = $this->llena_dependencia($id[0]);
                if (!empty($hijos_dep)) {
                    $hijos[] = $hijos_dep;
                }
            }
            $objetoJson["children"] = $hijos;
        } else {
            $objetoJson["key"] = 0;
            $hijos_dep = $this->llena_dependencia(0); // TRD
            if (!empty($hijos_dep)) {
                $hijos = $hijos_dep;
            }
            $objetoJson["children"] = $hijos;
        }
        return $objetoJson;
    }

    private function configurar() {
        if (isset($this->parametros["estado"])) {
            $this->condicion_ad .= " and estado=" . $this->parametros["estado"];
        }
        if (isset($this->parametros["checkbox"])) {
            $this->checkbox = $this->parametros["checkbox"];
        }
        if (isset($this->parametros["excluidos"])) {
            $this->condicion_ad .= " and iddependencia not in (" . $this->parametros["excluidos"] . ")";
        }
        if (isset($this->parametros["seleccionados"])) {
            $this->seleccionados = explode(",", $this->parametros["seleccionados"]);
        }
        if (isset($this->parametros["expandir"])) {
            $this->expandir = $this->parametros["expandir"];
        }
    }

    private function llena_dependencia($id) {
        $objetoJson = array();
        if ($id == 0) {
            $papas = busca_filtro_tabla("", "dependencia", "(cod_padre=0 or cod_padre is null)" . $this->condicion_ad, "nombre ASC", $this->conn);
        } else {
            $papas = busca_filtro_tabla("", "dependencia", "cod_padre=" . $id . $this->condicion_ad, "nombre ASC", $this->conn);
        }
        // print_r($papas["sql"]);
        if ($papas["numcampos"]) {
            for ($i = 0; $i < $papas["numcampos"]; $i++) {
                $text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")";
                if ($papas[$i]["estado"] == 0) {
                    $text .= " - INACTIVO";
                }
                $item = array();
                $item["extraClasses"] = "estilo-dependencia";
                $item["title"] = $text;
                $item["key"] = $papas[$i]["iddependencia"];
                $item["checkbox"] = $this->checkbox;
                if ($this->expandir == 1) {
                    $item["expanded"] = true;
                }
                if ($papas[$i]["estado"] == 0) {
                    // $objetoXML -> writeAttribute("nocheckbox", 1);
                    $item["unselectableStatus"] = false;
                    $item["folder"] = 1;
                }
                if ($this->seleccionados != "") {
                    if (in_array($papas[$i]["iddependencia"], $this->seleccionados) !== false) {
                        $item["selected"] = true;
                        if (!$this->activado) {
                            $item["active"] = true;
                            $this->activado = true;
                        }
                    }
                }
                $hijos = busca_filtro_tabla("count(*) as cant", "dependencia", "cod_padre=" . $papas[$i]["iddependencia"] . $this->condicion_ad, "", $this->conn);
                if ($hijos[0]["cant"]) {
                    // $objetoXML -> writeAttribute("child", 1);
                    $item["children"] = $this->llena_dependencia($papas[$i]["iddependencia"]);
                } else {
                    // $objetoXML -> writeAttribute("child", 0);
                    $item["folder"] = 0;
                }
                $objetoJson[] = $item;
            }
        }
        return $objetoJson;
    }
}
