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

/**
 * NO se deben agregar campos a la vista si esta repite el mismo funcionario o serie eje: permiso_serie
 * si esta una serie activa y otra inactiva saldra dos veces en el arbol
 * preguntar a Andres agudelo antes de cambiar la vista (vpermiso_serie)
 */

// DEFAULT DATOS
$tipo = array(
    1 => 0,
    2 => 0,
    3 => 1
);
if (isset($_REQUEST["tipo1"])) {
    $tipo[1] = $_REQUEST["tipo1"];
}
if (isset($_REQUEST["tipo2"])) {
    $tipo[2] = $_REQUEST["tipo2"];
}

if (isset($_REQUEST["tipo3"])) {
    $tipo[3] = $_REQUEST["tipo3"];
}

$condicion_ad = " and idfuncionario=" . $_SESSION["idfuncionario"];
if (isset($_REQUEST["categoria"])) {
    $condicion_ad .= " and categoria=" . $_REQUEST["categoria"];
} else {
    $condicion_ad .= " and categoria=2";
}
if (isset($_REQUEST["tvd"])) {
    $condicion_ad .= " and tvd=" . $_REQUEST["tvd"];
} else {
    $condicion_ad .= " and tvd=0";
}
if (isset($_REQUEST["estado_serie"])) {
    $condicion_ad .= " and estado_serie=" . $_REQUEST["estado_serie"];
}
if (isset($_REQUEST["excluidos"])) {
    $condicion_ad .= " and idserie not in (" . $_REQUEST["excluidos"] . ")";
}

$seleccionados = array();
if (isset($_REQUEST["seleccionados"])) {
    $seleccionados = explode(",", $_REQUEST["seleccionados"]);
}
// TERMINA DEFAULT

$id = 0;
$incluir_padre = false;

if (isset($_REQUEST["id"])) {
    $id = $_REQUEST["id"];
}

if(isset($_REQUEST["mostrar_padre"]) && $_REQUEST["mostrar_padre"] == "1") {
    $incluir_padre = true;
}

if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
    header("Content-type: application/xhtml+xml");
} else {
    header("Content-type: text/xml");
}

$arbol = new DHtmlXtreeSeries($conn, $tipo, $condicion_ad, $seleccionados, $incluir_padre);
echo  $arbol->generarXml($id);

class DHtmlXtreeSeries {

    private $objetoXML;
    private $conn;
    private $condicion_ad;
    private $seleccionados;
    private $incluir_padre;
    private $tipo = array(
        1 => 0,
        2 => 0,
        3 => 1
    );

    public function __construct($conn, $tipo, $condicion_ad, $seleccionados, $incluir_padre=false) {
        $this->conn = $conn;
        $this->tipo = $tipo;
        $this->condicion_ad = $condicion_ad;
        $this->seleccionados = $seleccionados;
        $this->incluir_padre = $incluir_padre;
    }

    public function generarXml($id=0) {
        $this->objetoXML = new XMLWriter();
        $this->objetoXML->openMemory();
        $this->objetoXML->setIndent(true);
        $this->objetoXML->setIndentString("\t");
        $this->objetoXML->startDocument('1.0', 'utf-8');
        $this->objetoXML->startElement("tree");
        $this->objetoXML->writeAttribute("id", 0);
        $this->llena_serie($id);
        $this->objetoXML -> endElement();
        $this->objetoXML -> endDocument();
        $cadenaXML = trim($this->objetoXML -> outputMemory());
        return $cadenaXML;
    }

    private function llena_serie($id) {
        if ($id == 0) {
            $papas = busca_filtro_tabla("", "vpermiso_serie", "(cod_padre=0 or cod_padre is null)" . $this->condicion_ad, "nombre_serie ASC", $this->conn);
        } else if($this->incluir_padre) {
            $papas = busca_filtro_tabla("", "vpermiso_serie", "idserie=" . $id . $this->condicion_ad, "nombre_serie ASC", $this->conn);
            $this->incluir_padre = false;
        } else {
            $papas = busca_filtro_tabla("", "vpermiso_serie", "cod_padre=" . $id . $this->condicion_ad, "nombre_serie ASC", $this->conn);
        }
        if ($papas["numcampos"]) {
            for ($i = 0; $i < $papas["numcampos"]; $i++) {
                $text = $papas[$i]["nombre_serie"] . " (" . $papas[$i]["codigo"] . ")";
                if ($papas[$i]["estado_serie"] == 0) {
                    $text .= " - INACTIVO";
                }
                $this->objetoXML->startElement("item");
                $this->objetoXML->writeAttribute("style", "font-family:verdana; font-size:7pt;");
                $this->objetoXML->writeAttribute("text", $text);
                $this->objetoXML->writeAttribute("id", $papas[$i]["idserie"]);
                if ($this->tipo[$papas[$i]["tipo"]] == 0 || $papas[$i]["estado_serie"] == 0) {
                    $this->objetoXML->writeAttribute("nocheckbox", 1);
                }
                if (in_array($papas[$i]["idserie"], $this->seleccionados) !== false) {
                    $this->objetoXML->writeAttribute("checked", 1);
                }
                $hijos = busca_filtro_tabla("count(*) as cant", "vpermiso_serie", "cod_padre=" . $papas[$i]["idserie"] . $this->condicion_ad, "", $this->conn);
                if ($hijos[0]["cant"]) {
                    $this->objetoXML->writeAttribute("child", 1);
                    $this->llena_serie($papas[$i]["idserie"]);
                } else {
                    $this->objetoXML->writeAttribute("child", 0);
                }

                /* USERDATA */
                $this->objetoXML->startElement("userdata");
                $this->objetoXML->writeAttribute("name", "nombre_serie");
                $this->objetoXML->text($papas[$i]["nombre_serie"]);
                $this->objetoXML->endElement();

                $this->objetoXML->startElement("userdata");
                $this->objetoXML->writeAttribute("name", "codigo");
                $this->objetoXML->text($papas[$i]["codigo"]);
                $this->objetoXML->endElement();

                $this->objetoXML->startElement("userdata");
                $this->objetoXML->writeAttribute("name", "entidad_identidad");
                $this->objetoXML->text($papas[$i]["entidad_identidad"]);
                $this->objetoXML->endElement();
                /* FIN USERDATA */

                $this->objetoXML->endElement();
            }
        }
    }

    public function getObjetoXML() {
        return $this->objetoXML;
    }
}
?>