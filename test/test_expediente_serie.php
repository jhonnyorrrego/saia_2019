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

$id = 0;
if ($_GET["id"]) {
    $id = $_GET["id"];
}

// DEFAULT DATOS
$condicion_ad = "";
if (isset($_REQUEST["excluidos_exp"])) {
    $condicion_ad .= " and idexpediente not in (" . $_REQUEST["excluidos_exp"] . ")";
}

$seleccionados = array();
if (isset($_REQUEST["seleccionados"])) {
    $seleccionados = explode(",", $_REQUEST["seleccionados"]);
}
// TERMINA DEFAULT

if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
    header("Content-type: application/xhtml+xml");
} else {
    header("Content-type: text/xml");
}

$arbol = new DHtmlXtreeExpedienteSerie($conn, $condicion_ad, $seleccionados, true);
echo $arbol->generarXml($id);

class DHtmlXtreeExpedienteSerie {

    private $objetoXML;

    private $conn;

    private $condicion_ad;

    private $seleccionados;

    private $incluir_padre;

    public function __construct($conn, $condicion_ad, $seleccionados, $incluir_padre = false) {
        $this->conn = $conn;
        $this->condicion_ad = $condicion_ad;
        $this->seleccionados = $seleccionados;
        $this->incluir_padre = $incluir_padre;
    }

    public function generarXml($id = 0) {
        $this->objetoXML = new XMLWriter();
        $this->objetoXML->openMemory();
        $this->objetoXML->setIndent(true);
        $this->objetoXML->setIndentString("\t");
        $this->objetoXML->startDocument('1.0', 'utf-8');
        $this->objetoXML->startElement("tree");
        $this->objetoXML->writeAttribute("id", $id);
        $this->llena_expediente($id);
        $this->objetoXML->endElement();
        $this->objetoXML->endDocument();
        $cadenaXML = trim($this->objetoXML->outputMemory());
        return $cadenaXML;
    }

    private function llena_expediente($id) {
        global $condicion_ad, $seleccionados;
        if ($id == 0) {
            $papas = busca_filtro_tabla("", "expediente", "(cod_padre=0 or cod_padre is null)" . $this->condicion_ad, "nombre ASC", $this->conn);
        } else {
            $papas = busca_filtro_tabla("", "expediente", "cod_padre=" . $id . $this->condicion_ad, "nombre ASC", $this->conn);
        }
        if ($papas["numcampos"]) {
            for ($i = 0; $i < $papas["numcampos"]; $i++) {
                $text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo_numero"] . ")";
                if ($papas[$i]["estado_cierre"] == 2) {
                    $text .= " - CERRADO";
                }
                $this->objetoXML->startElement("item");
                $this->objetoXML->writeAttribute("style", "font-family:verdana; font-size:7pt;font-weight:bold");
                $this->objetoXML->writeAttribute("text", $text);
                $this->objetoXML->writeAttribute("id", $papas[$i]["idexpediente"] . "#");
                $this->objetoXML->writeAttribute("nocheckbox", 1);
                $hijos = busca_filtro_tabla("count(*) as cant", "expediente", "cod_padre=" . $papas[$i]["idexpediente"] . $this->condicion_ad, "", $this->conn);
                $tipo_docu = busca_filtro_tabla("count(*) as cant", "serie", "tipo=3 and tvd=0 and cod_padre=" . $papas[$i]["serie_idserie"], "", $this->conn);

                if ($hijos[0]["cant"] || $tipo_docu[0]["cant"]) {
                    $this->objetoXML->writeAttribute("child", 1);
                } else {
                    $this->objetoXML->writeAttribute("child", 0);
                }
                if ($hijos[0]["cant"]) {
                    $this->llena_expediente($papas[$i]["idexpediente"]);
                }
                if ($tipo_docu[0]["cant"]) {
                    $this->llena_tipo_documental($papas[$i]["serie_idserie"], $papas[$i]["idexpediente"]);
                }
                $this->objetoXML->endElement();
            }
        }
    }

    private function llena_tipo_documental($id, $idexp) {
        $papas = busca_filtro_tabla("", "serie", "tipo=3 and tvd=0 and cod_padre=" . $id, "nombre ASC", $this->conn);
        if ($papas["numcampos"]) {
            for ($i = 0; $i < $papas["numcampos"]; $i++) {
                $text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")";
                if ($papas[$i]["estado"] == 0) {
                    $text .= " - INACTIVO";
                }
                $this->objetoXML->startElement("item");
                $this->objetoXML->writeAttribute("style", "font-family:verdana; font-size:7pt;");
                $this->objetoXML->writeAttribute("text", $text);
                $this->objetoXML->writeAttribute("id", $papas[$i]["idserie"]);
                if ($papas[$i]["estado"] == 0) {
                    $this->objetoXML->writeAttribute("nocheckbox", 1);
                }
                if (in_array($papas[$i]["idserie"], $this->seleccionados) !== false) {
                    $this->objetoXML->writeAttribute("checked", 1);
                }
                $this->objetoXML->writeAttribute("child", 0);

                /* USERDATA */
                $this->objetoXML->startElement("userdata");
                $this->objetoXML->writeAttribute("name", "idexpediente");
                $this->objetoXML->text($idexp);
                $this->objetoXML->endElement();

                $this->objetoXML->startElement("userdata");
                $this->objetoXML->writeAttribute("name", "idserie");
                $this->objetoXML->text($papas[$i]["idserie"]);
                $this->objetoXML->endElement();
                /* FIN USERDATA */

                $this->objetoXML->endElement();
            }
        }
    }
}
?>