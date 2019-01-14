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
include_once ($ruta_db_superior . "pantallas/expediente/librerias.php");

$id = 0;
if ($_GET["id"]) {
    $id = $_GET["id"];
}

$condicion_ad = '';
$idexpediente = 0;

// DEFAULT DATOS
$estado_archivo = false;
if (@$_REQUEST['estado_archivo']) {
    $estado_archivo = true;
    $condicion_ad .= " AND (e.estado_archivo IN(" . $_REQUEST['estado_archivo'] . "))";
}

$estado_cierre = false;
if (@$_REQUEST['estado_cierre']) {
    $estado_cierre = true;
    $condicion_ad .= " AND (e.estado_cierre IN(" . $_REQUEST['estado_cierre'] . "))";
}

if (isset($_REQUEST["excluidos_exp"])) {
    $condicion_ad .= " and idexpediente not in (" . $_REQUEST["excluidos_exp"] . ")";
} else if (isset($_REQUEST["incluir_series"]) && !($estado_cierre || $estado_archivo)) {
    $condicion_ad .= " and e.serie_idserie  in (" . $_REQUEST["incluir_series"] . ")";
}

$partes = false;
if (@$_REQUEST['cargar_partes']) {
    $partes = true;
}

if (isset($_REQUEST["idexpediente"])) {
    $condicion_ad .= " and e.idexpediente = " . $_REQUEST["idexpediente"];
    $idexpediente = $_REQUEST["idexpediente"];
}

$seleccionados = array();
if (isset($_REQUEST["seleccionados"])) {
    $seleccionados = explode(",", $_REQUEST["seleccionados"]);
}

if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
    header("Content-type: application/xhtml+xml");
} else {
    header("Content-type: text/xml");
}

$arbol = new DHtmlXtreeExpedienteFunc($conn, $condicion_ad, $idexpediente, $seleccionados, $partes);
echo $arbol -> generarXml($id);

class DHtmlXtreeExpedienteFunc {

    private $objetoXML;
    private $conn;
    private $condicion_ad;
    private $seleccionados;
    private $idexpediente;
    private $partes;

    public function __construct($conn, $condicion_ad, $idexpediente, $seleccionados, $partes) {
        $this -> conn = $conn;
        $this -> condicion_ad = $condicion_ad;
        $this -> seleccionados = $seleccionados;
        $this -> idexpediente = $idexpediente;
        $this -> partes = $partes;
    }

    public function generarXml($id = 0) {
        $this -> objetoXML = new XMLWriter();
        $this -> objetoXML -> openMemory();
        $this -> objetoXML -> setIndent(true);
        $this -> objetoXML -> setIndentString("\t");
        $this -> objetoXML -> startDocument('1.0', 'utf-8');
        $this -> objetoXML -> startElement("tree");
        $this -> objetoXML -> writeAttribute("id", $id);
        $this -> llena_expediente($id);
        $this -> objetoXML -> endElement();
        $this -> objetoXML -> endDocument();
        $cadenaXML = trim($this -> objetoXML -> outputMemory());
        return $cadenaXML;
    }

    private function llena_expediente($id) {
        if ($this -> idexpediente) {
            $papas = busca_filtro_tabla("DISTINCT e.idexpediente,e.serie_idserie,e.nombre,e.codigo_numero,e.estado_cierre,e.agrupador,e.fk_entidad_serie", "expediente e,permiso_expediente p", "p.fk_expediente=e.idexpediente and p.fk_funcionario=" . $_SESSION["idfuncionario"] . " and e.idexpediente=" . $this -> idexpediente, "nombre ASC", $this -> conn);
        } else if ($id == 0) {
            $papas = busca_filtro_tabla("DISTINCT e.idexpediente,e.serie_idserie,e.nombre,e.codigo_numero,e.estado_cierre,e.agrupador,e.fk_entidad_serie", "expediente e,permiso_expediente p", "p.fk_expediente=e.idexpediente and p.fk_funcionario=" . $_SESSION["idfuncionario"] . " and (e.cod_padre=0 or e.cod_padre is null) " . $this -> condicion_ad, "nombre ASC", $this -> conn);
        } else {
            $papas = busca_filtro_tabla("DISTINCT e.idexpediente,e.serie_idserie,e.nombre,e.codigo_numero,e.estado_cierre,e.agrupador,e.fk_entidad_serie", "expediente e,permiso_expediente p", "p.fk_expediente=e.idexpediente and p.fk_funcionario=" . $_SESSION["idfuncionario"] . " and e.cod_padre=" . $id . $this -> condicion_ad, "nombre ASC", $this -> conn);
        }

        if ($papas["numcampos"]) {
            for ($i = 0; $i < $papas["numcampos"]; $i++) {

                $agrupador = $papas[$i]["agrupador"];
                $cerrado = 0;
                $text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo_numero"] . ")";
                if ($papas[$i]["estado_cierre"] == 2) {
                    $text .= " - CERRADO";
                    $cerrado = 1;
                }
                $hijos = busca_filtro_tabla("count(1) as cant", "expediente e,permiso_expediente p", "p.fk_expediente=e.idexpediente and p.fk_funcionario=" . $_SESSION["idfuncionario"] . " and e.cod_padre=" . $papas[$i]["idexpediente"] . $this -> condicion_ad, "", $this -> conn);

                $this -> objetoXML -> startElement("item");
                $this -> objetoXML -> writeAttribute("style", "font-family:verdana; font-size:7pt;font-weight:bold");
                $this -> objetoXML -> writeAttribute("text", $text);
                $this -> objetoXML -> writeAttribute("id", $papas[$i]["idexpediente"]);

                if (!$agrupador || $cerrado) {
                    $this -> objetoXML -> writeAttribute("nocheckbox", 1);
                } else {
                    $cons_permiso = busca_filtro_tabla("permiso", "permiso_expediente", "fk_expediente=" . $papas[$i]["idexpediente"] . " and fk_funcionario=" . $_SESSION["idfuncionario"], "", $conn);
                    $permiso = '';
                    if ($cons_permiso["numcampos"]) {
                        for ($k = 0; $k < $cons_permiso["numcampos"]; $k++) {
                            $permiso .= $cons_permiso[$k]["permiso"] . ',';
                        }
                    }
                    $permisos = explode(",", $permiso);
                    $tiene_permisos = in_array("a", $permisos) || in_array("v", $permisos);
                    if (!$tiene_permisos) {
                        $this -> objetoXML -> writeAttribute("nocheckbox", 1);
                    }
                }

                if (!$this -> partes) {
                    if ($hijos[0]["cant"] && !$cerrado) {
                        $this -> llena_expediente($papas[$i]["idexpediente"]);
                    }
                }

                if ($hijos[0]["cant"] && !$cerrado) {
                    $this -> objetoXML -> writeAttribute("child", 1);
                } else {
                    $this -> objetoXML -> writeAttribute("child", 0);
                }

                $this -> objetoXML -> endElement();

            }
        }
    }

}
?>