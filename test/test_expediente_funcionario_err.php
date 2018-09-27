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

// DEFAULT DATOS
$condicion_ad = " and " . expedientes_asignados();
if (isset($_REQUEST["excluidos_exp"])) {
    $condicion_ad .= " and idexpediente not in (" . $_REQUEST["excluidos_exp"] . ")";
} else if (isset($_REQUEST["incluir_series"])) {
    $condicion_ad .= " and a.serie_idserie  in (" . $_REQUEST["incluir_series"] . ")";
}

if (@$_REQUEST['estado_archivo']) {
    $condicion_ad = " AND (a.estado_archivo IN(" . $_REQUEST['estado_archivo'] . "))";
}

if (@$_REQUEST['estado_cierre']) {
    $condicion_ad = " AND (a.estado_cierre IN(" . $_REQUEST['estado_cierre'] . "))";
}

if (isset($_REQUEST["idexpediente"])) {
    $condicion_ad .= " and a.idexpediente = " . $_REQUEST["idexpediente"];
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

$arbol = new DHtmlXtreeExpedienteFunc($conn, $condicion_ad, $seleccionados);
echo $arbol->generarXml($id);

class DHtmlXtreeExpedienteFunc {

    private $objetoXML;

    private $conn;

    private $condicion_ad;

    private $seleccionados;

    public function __construct($conn, $condicion_ad, $seleccionados) {
        $this->conn = $conn;
        $this->condicion_ad = $condicion_ad;
        $this->seleccionados = $seleccionados;
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
        if ($id == 0) {
            $expedientes = busca_filtro_tabla("DISTINCT idexpediente,serie_idserie,nombre,codigo_numero,estado_cierre", "vexpediente_serie a", "(cod_padre=0 or cod_padre is null)" . $this->condicion_ad, "nombre ASC", $this->conn);
        } else {
            $expedientes = busca_filtro_tabla("DISTINCT idexpediente,serie_idserie,nombre,codigo_numero,estado_cierre", "vexpediente_serie a", "cod_padre=" . $id . $this->condicion_ad, "nombre ASC", $this->conn);
        }

        //print_r($expedientes);
        if ($expedientes["numcampos"]) {
            for ($i = 0; $i < $expedientes["numcampos"]; $i++) {
                $text = $expedientes[$i]["nombre"] . " (" . $expedientes[$i]["codigo_numero"] . ")";
                if ($expedientes[$i]["estado_cierre"] == 2) {
                    $text .= " - CERRADO";
                }
                $exp_hijos = busca_filtro_tabla("count(1) as cant", "vexpediente_serie a", "a.cod_padre=" . $expedientes[$i]["idexpediente"] . $this->condicion_ad, "", $this->conn);

                // print_r($hijos);

                $cantidad_tipos_doc = 0;
                $idserie_exp = 0;
                if (!empty($expedientes[$i]["serie_idserie"]) && $expedientes[$i]["serie_idserie"] > 0) {
                    $tipo_docu = busca_filtro_tabla("count(1) as cant", "serie", "tipo=3 and tvd=0 and cod_padre=" . $expedientes[$i]["serie_idserie"], "", $this->conn);
                    $cantidad_tipos_doc = $tipo_docu[0]["cant"];
                    $idserie_exp = $expedientes[$i]["serie_idserie"];
                }

                $this->objetoXML->startElement("item");
                $this->objetoXML->writeAttribute("style", "font-family:verdana; font-size:7pt;font-weight:bold");
                $this->objetoXML->writeAttribute("text", $text);
                $this->objetoXML->writeAttribute("id", $expedientes[$i]["idexpediente"] . "#");
                $this->objetoXML->writeAttribute("nocheckbox", 1);
                if ($exp_hijos[0]["cant"] || $cantidad_tipos_doc) {
                    $this->objetoXML->writeAttribute("child", 1);
                } else {
                    $this->objetoXML->writeAttribute("child", 0);
                }
                if ($exp_hijos[0]["cant"]) {
                    $this->llena_expediente($expedientes[$i]["idexpediente"]);
                }

                if ($cantidad_tipos_doc) {
                    $this->llena_tipo_documental($expedientes[$i]["serie_idserie"], $expedientes[$i]["idexpediente"]);
                } else if($idserie_exp) {
                    $this->llena_serie($expedientes[$i]["serie_idserie"], $expedientes[$i]["idexpediente"]);
                }

                $this->objetoXML->endElement();
            }
        }
    }

    private function llena_serie($id, $idexp) {
        $series = busca_filtro_tabla("", "serie", "tvd=0 and cod_padre=" . $id, "nombre ASC", $this->conn);
        if ($series["numcampos"]) {
            for ($i = 0; $i < $series["numcampos"]; $i++) {
                $permiso = busca_filtro_tabla("count(*) as cant", "permiso_serie", $this->permisos_serie($series[$i]["idserie"]), "", $this->conn);
                //print_r($permiso);
                $text = $series[$i]["nombre"] . " (" . $series[$i]["codigo"] . ")";
                if ($series[$i]["estado"] == 0) {
                    $text .= " - INACTIVO";
                }
                if ($permiso[0]["cant"] == 0) {
                    $text .= " - (Sin permiso)";
                }
                $this->objetoXML->startElement("item");
                $this->objetoXML->writeAttribute("style", "font-family:verdana; font-size:7pt;");
                $this->objetoXML->writeAttribute("text", $text);
                $this->objetoXML->writeAttribute("id", "{$series[$i]["idserie"]}.{$idexp}");

                if ($series[$i]["estado"] == 0 || $permiso[0]["cant"] == 0) {
                    $this->objetoXML->writeAttribute("nocheckbox", 1);
                } else {
                    $tipo_docu = busca_filtro_tabla("count(1) as cant", "serie", "tipo=3 and tvd=0 and cod_padre=" . $series[$i]["idserie"], "", $this->conn);
                    if ($tipo_docu[0]["cant"]) {
                        $this->objetoXML->writeAttribute("nocheckbox", 0);
                        $this->objetoXML->writeAttribute("child", 1);
                        $this->llena_tipo_documental($series[$i]["idserie"], $idexp);
                    } else {
                        $this->objetoXML->writeAttribute("child", 0);
                    }
                }

                $this->objetoXML->endElement();
            }
        }
    }

    private function llena_tipo_documental($id, $idexp) {
        $series = busca_filtro_tabla("", "serie", "tipo=3 and tvd=0 and cod_padre=" . $id, "nombre ASC", $this->conn);
        if ($series["numcampos"]) {
            for ($i = 0; $i < $series["numcampos"]; $i++) {
                $permiso = busca_filtro_tabla("count(*) as cant", "permiso_serie", $this->permisos_serie($series[$i]["idserie"]), "", $this->conn);
                $text = $series[$i]["nombre"] . " (" . $series[$i]["codigo"] . ")";
                if ($series[$i]["estado"] == 0) {
                    $text .= " - INACTIVO";
                }
                if ($permiso[0]["cant"] == 0) {
                    $text .= " - (Sin permiso)";
                }
                $this->objetoXML->startElement("item");
                $this->objetoXML->writeAttribute("style", "font-family:verdana; font-size:7pt;");
                $this->objetoXML->writeAttribute("text", $text);
                $this->objetoXML->writeAttribute("id", "{$series[$i]["idserie"]}.{$idexp}");
                if ($series[$i]["estado"] == 0 || $permiso[0]["cant"] == 0) {
                    $this->objetoXML->writeAttribute("nocheckbox", 1);
                }

                if (in_array($series[$i]["idserie"], $this->seleccionados) !== false) {
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
                $this->objetoXML->text($series[$i]["idserie"]);
                $this->objetoXML->endElement();
                /* FIN USERDATA */

                $this->objetoXML->endElement();
            }
        }
    }

    private function permisos_serie($serie_actual) {
        $idfunc_actual = usuario_actual('idfuncionario');

        $entidades_exp = array(1, 2, 4);
        $llaves_exp = array($idfunc_actual);

        $roles = busca_filtro_tabla("dependencia_iddependencia,cargo_idcargo", "dependencia_cargo a", "a.estado='1' and a.funcionario_idfuncionario=" . $idfunc_actual, "", $this->conn);
        $dependencias = extrae_campo($roles, "dependencia_iddependencia");
        $cargos = extrae_campo($roles, "cargo_idcargo");

        $llaves_exp = array_merge($llaves_exp, $dependencias);
        $llaves_exp = array_merge($llaves_exp, $cargos);
        $cadena_serie = "(entidad_identidad IN ('" . implode("','", $entidades_exp) . "') AND llave_entidad IN ('" . implode("','", $llaves_exp) . "'))";

        $permisos_serie = busca_filtro_tabla("serie_idserie", "permiso_serie", $cadena_serie, "", $this->conn);
        $series = extrae_campo($permisos_serie, "serie_idserie");
        $series[] = $serie_actual;
        $series = array_unique($series);
        $series = array_filter($series);
        $cadena_series_sql = '';
        if (count($series)) {
            $cadena_series_sql = " AND serie_idserie IN(" . implode(", ", $series) . ")";
        }
        $cadena = " entidad_identidad IN(" . implode(",", $entidades_exp) . ") AND llave_entidad IN(" . implode(",", $llaves_exp) . ") " . $cadena_series_sql;

        return ($cadena);
    }

    public static function expedientes_asignados($conn) {
        // return "1=1";
        $idfunc_actual = usuario_actual('idfuncionario');

        $llaves_exp = array(
            $idfunc_actual
        );

        $roles = busca_filtro_tabla("dependencia_iddependencia,cargo_idcargo", "dependencia_cargo a", "a.estado='1' and a.funcionario_idfuncionario=" . $idfunc_actual, "", $conn);
        $dependencias = extrae_campo($roles, "dependencia_iddependencia");
        $cargos = extrae_campo($roles, "cargo_idcargo");

        $llaves_exp = array_merge($llaves_exp, $dependencias);
        $llaves_exp = array_merge($llaves_exp, $cargos);

        $cadena = "ee.entidad_identidad IN (1, 2, 4) AND ee.llave_entidad IN ('" . implode("','", $llaves_exp) . "')";

        return ($cadena);
    }
}