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

if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
    header("Content-type: application/xhtml+xml");
} else {
    header("Content-type: text/xml");
}

include_once $ruta_db_superior . "class.funcionarios.php";
include_once $ruta_db_superior . "pantallas/expediente/librerias.php";

$id = @$_REQUEST["inicia"];
$excluidos = array();

$arbol = new OldDHtmlXtreeExpedienteSerie($conn, $id);

if (isset($_REQUEST["excluidos"])) {
    $excluidos = explode(",", $_REQUEST["excluidos"]);
    $arbol->setExcluidos($excluidos);
}

if (isset($_REQUEST["doc"])) {
    $iddocumento = $_REQUEST["doc"];
    $arbol->setIddocumento($iddocumento);
}

if (isset($_REQUEST["id"])) {
    $id = $_REQUEST["id"];
    $arbol->setId($id);
}

if (isset($_REQUEST["uid"])) {
    $uid = $_REQUEST["uid"];
    $arbol->setUid($uid);
}

if (isset($_REQUEST["carga_partes_serie"])) {
    $carga_partes_serie = $_REQUEST["carga_partes_serie"];
    $arbol->setCarga_partes_serie($carga_partes_serie);
}

if (isset($_REQUEST["accion"])) {
    $accion = $_REQUEST["accion"];
    $arbol->setAccion($accion);
}

if (isset($_REQUEST["sin_padre"])) {
    $sin_padre_serie = $_REQUEST["sin_padre"];
    $arbol->setSin_padre_serie($sin_padre_serie);
}

if (isset($_REQUEST["sin_padre_expediente"])) {
    $sin_padre_expediente = $_REQUEST["sin_padre_expediente"];
    $arbol->sin_padre_expediente($sin_padre_expediente);
}

if(isset($_REQUEST["carga_total"])) {
    $carga_total = $_REQUEST["carga_total"];
    $arbol->setCarga_total($carga_total);
}

if(isset($_REQUEST["seleccionado"])) {
    $seleccionado = $_REQUEST["seleccionado"];
    $arbol->setSeleccionado($seleccionado);
}

echo $arbol->generarXml();

class OldDHtmlXtreeExpedienteSerie
{
    private $objetoXML;
    private $ingresado = 0;
    private $carga_partes_serie = false;
    private $id = null;
    private $uid = null;
    private $excluidos = array();
    private $exp_asignados;
    private $iddocumento;
    private $varios;
    private $idfuncionario;
    private $datos_admin_funcionario;
    private $accion;
    private $sin_padre_serie;
    private $sin_padre_expediente;
    private $exp_doc;
    private $carga_total;
    private $seleccionado;

    public function __construct($conn, $id)
    {
        $this->conn = $conn;
        $this->objetoXML = new XMLWriter();
        $this->id = $id;
        //$this->uid = $uid;
        //$this->carga_partes_serie = $carga_partes_serie;
        //$this->$excluidos = $excluidos;
        //$this->iddocumento = $iddocumento;
        $this->idfuncionario = usuario_actual("idfuncionario");
        //$this->accion = $accion;
        //$this->sin_padre_serie = $sin_padre_serie;
        //$this->sin_padre_expediente = $sin_padre_expediente;
    }

    public function generarXml($id = 0)
    {
        $this->exp_asignados = expedientes_asignados();
        $this->datos_admin_funcionario = busca_datos_administrativos_funcionario($idfuncionario);
        if (!empty($this->iddocumento)) {
            $this->varios = 1;
            $varios_docs = explode(",", $this->iddocumento);
            $documento = busca_filtro_tabla("", "expediente_doc", "documento_iddocumento in(" . $this->iddocumento . ")", "", $this->conn);
            $this->exp_doc = array();
            if (count($varios_docs) == 1) {
                $this->exp_doc = extrae_campo($documento, "expediente_idexpediente", "U");
                $this->varios = 0;
            }
        }

        $this->objetoXML->openMemory();
        $this->objetoXML->setIndent(true);
        $this->objetoXML->setIndentString("\t");

        $this->objetoXML->startDocument('1.0', 'UTF-8');
        $this->objetoXML->startElement("tree");

//si llega el request para cargar por partes subseries & tipo documental
        if ($carga_partes_serie) {
            if (!empty($this->id) && !empty($this->uid)) {

                if (strpos($id, 'sub') !== false) {
                    $this->objetoXML->writeAttribute("id", $id);
                    $ids = explode('sub', $id);
                    $this->llena_subseries_tipo_documental($ids[0], $ids[1]);
                    if (!$this->ingresado) {
                        $this->objetoXML->startElement("item");
                        $this->objetoXML->writeAttribute("style", 'font-family:verdana; font-size:7pt;');
                        $this->objetoXML->writeAttribute("text", 'No tiene series documentales asignadas');
                        $this->objetoXML->writeAttribute("id", '-1');
                        $this->objetoXML->writeAttribute("nocheckbox", '1');
                        $this->objetoXML->endElement();
                    }
                }
            }
        } else if ($this->id && $this->uid) {
            $this->objetoXML->writeAttribute("id", $id);
            $this->llena_expediente($id);
            if (!$this->ingresado) {
                $this->objetoXML->startElement("item");
                $this->objetoXML->writeAttribute("style", 'font-family:verdana; font-size:7pt;');
                $this->objetoXML->writeAttribute("text", 'No tiene series documentales asignadas');
                $this->objetoXML->writeAttribute("id", '-1');
                $this->objetoXML->writeAttribute("nocheckbox", '1');
                $this->objetoXML->endElement();
            }
        } else {
            $this->objetoXML->writeAttribute("id", '0');
            $this->llena_expediente($id);
            if (!$this->ingresado) {
                $this->objetoXML->startElement("item");
                $this->objetoXML->writeAttribute("style", 'font-family:verdana; font-size:7pt;');
                $this->objetoXML->writeAttribute("text", 'No tiene series documentales asignadas');
                $this->objetoXML->writeAttribute("id", '-1');
                $this->objetoXML->writeAttribute("nocheckbox", '1');
                $this->objetoXML->endElement();
            }

        }

        $this->objetoXML->endElement();
        $this->objetoXML->endDocument();

        $cadenaXML = trim($this->objetoXML->outputMemory());
        return $cadenaXML;
    }

    private function llena_expediente($id)
    {
        global $funcionarios, $dependencias;
        if ($id == 0) {
            $papas = busca_filtro_tabla("a.fecha, a.nombre, a.cod_arbol, a.idexpediente, estado_cierre",
                "vexpediente_serie a", $this->exp_asignados . " and (a.cod_padre=0 OR a.cod_padre IS NULL) AND a.estado_cierre=1",
                "GROUP BY a.fecha, a.nombre, a.cod_arbol, a.idexpediente, estado_cierre order by idexpediente desc", $this->conn);
        } else {
            $papas = busca_filtro_tabla("a.fecha, a.nombre, a.cod_arbol, a.idexpediente, a.estado_cierre",
                "vexpediente_serie a", $this->exp_asignados . " and (a.cod_padre=" . $id . ") AND a.estado_cierre=1",
                "GROUP BY a.fecha, a.nombre, a.cod_arbol, a.idexpediente, estado_cierre order by idexpediente desc", $this->conn);
        }
        //print_r($papas);die();
        if ($papas["numcampos"]) {
            for ($i = 0; $i < $papas["numcampos"]; $i++) {
                $permitido = 0;
                if (!in_array($papas[$i]["idexpediente"], $this->excluidos)) {
                    $this->ingresado = 1;
                    $hijos_entidad_serie = busca_filtro_tabla("serie_idserie", "expediente", "idexpediente=" . $papas[$i]["idexpediente"], "", $this->conn);
                    $texto_item = "";
                    $texto_item = ($papas[$i]["nombre"]);
                    if ($papas[$i]["estado_cierre"] == 2) {
                        $texto_item .= " <span style='color:red'>(CERRADO)</span>";
                    }

                    $this->objetoXML->startElement("item");
                    $this->objetoXML->writeAttribute("style", 'font-family:verdana; font-size:7pt; font-weight: 900;');
                    $this->objetoXML->writeAttribute("text", htmlspecialchars($texto_item));
                    $this->objetoXML->writeAttribute("id", $papas[$i]["idexpediente"]);
                    if (!empty($this->iddocumento)) {
                        if ($this->accion == 1 && in_array($papas[$i]["idexpediente"], $this->exp_doc)) {
                            if (!$this->varios) {
                                $this->objetoXML->writeAttribute("checked", '1');
                            } else {
                                $this->objetoXML->writeAttribute("nocheckbox", '1');
                            }
                        } elseif ($this->accion == 0 && !in_array($papas[$i]["idexpediente"], $this->exp_doc)) {
                            $this->objetoXML->writeAttribute("nocheckbox", '1');
                        }
                    } elseif (!empty($this->seleccionado) && $this->seleccionado == $papas[$i]["idexpediente"]) {
                        $this->objetoXML->writeAttribute("checked", '1');
                        if ($papas[$i]["estado_cierre"] == 2) {
                            $this->objetoXML->writeAttribute("nocheckbox", '1');
                        }
                        //$this->objetoXML->writeAttribute("child", '1');
                    }

                    if ($this->sin_padre_expediente) {
                        $this->objetoXML->writeAttribute("nocheckbox", '1');
                    }

                    $child = 0;
                    if ($hijos_entidad_serie['numcampos']) {
                        for ($x = 0; $x < $hijos_entidad_serie['numcampos']; $x++) {
                            if (in_array($hijos_entidad_serie[$x]['serie_idserie'], $this->datos_admin_funcionario["series"])) {
                                $child = 1;
                            }
                        }
                    }
                    $hijos_expediente = busca_filtro_tabla("a.fecha, a.nombre, a.cod_arbol, a.idexpediente, a.estado_cierre",
                        "vexpediente_serie a", $this->exp_asignados . " and (a.cod_padre=" . $papas[$i]["idexpediente"] . ") AND a.estado_cierre=1",
                        "GROUP BY a.fecha, a.nombre, a.cod_arbol, a.idexpediente, estado_cierre order by idexpediente desc", $this->conn);
                    if ($hijos_expediente['numcampos']) {
                        $child = 1;
                    }
                    $this->objetoXML->writeAttribute("child", $child);

                    // echo (">");
                    if (!empty($this->uid) || $this->carga_total) {
                        $this->llena_expediente($papas[$i]["idexpediente"]);
                    }
                    $this->objetoXML->endElement();
                }
            }
        }
        if (!empty($this->uid) || !empty($this->id)) {
            if ($this->id == $id) {
                $hijos_entidad_serie = busca_filtro_tabla("serie_idserie", "expediente", "idexpediente=" . $this->id, "", $this->conn);

                if ($hijos_entidad_serie['numcampos']) {
                    $lista_entidad_series_filtrar = implode(',', extrae_campo($hijos_entidad_serie, 'serie_idserie'));
                }

                if ($hijos_entidad_serie['numcampos']) {
                    $this->llena_entidad_serie($this->id, $lista_entidad_series_filtrar);
                }
            }
        }
    }

//llena series asignadas segun dependencia  (dsa)
    private function llena_entidad_serie($iddependencia, $series)
    {
        global $objetoXML, $activo;

        $condicion_final = "categoria=2 AND idserie IN(" . $series . ")";
        $series = busca_filtro_tabla("nombre,idserie,codigo", "serie", $condicion_final . $activo, "", $this->conn);
        for ($i = 0; $i < $series['numcampos']; $i++) {
            $this->objetoXML->startElement("item");
            $this->objetoXML->writeAttribute("style", 'font-family:verdana; font-size:7pt;');
            $this->objetoXML->writeAttribute("text", htmlspecialchars(($series[$i]["nombre"])) . ' (' . $series[$i]['codigo'] . ')');
            $this->objetoXML->writeAttribute("id", $iddependencia . "sub" . $series[$i]['idserie']);
            if ($this->sin_padre_serie) {
                $this->objetoXML->writeAttribute("nocheckbox", '1');
            }
            $this->ingresado = 1;
            $subseries_tipo_documental = busca_filtro_tabla("idserie", "serie", "categoria=2 AND tipo IN(2,3) AND cod_padre=" . $series[$i]['idserie'] . $activo, "", $this->conn);
            //print_r($subseries_tipo_documental);
            if ($subseries_tipo_documental['numcampos']) {
                $this->objetoXML->writeAttribute("child", '1');
            } else {
                $this->objetoXML->writeAttribute("child", '0');
            }

            if ($subseries_tipo_documental['numcampos']) {
                if (!$this->carga_partes_serie) {
                    $this->llena_subseries_tipo_documental($iddependencia, $series[$i]['idserie']);
                }

            }

            $this->objetoXML->endElement();
        }
    }

    private function llena_subseries_tipo_documental($iddependencia, $idserie)
    {
        global $objetoXML, $activo;

        $tabla_otra = 'serie';
        $orden = "nombre";

        $papas = busca_filtro_tabla("*", $tabla_otra, "cod_padre=" . $idserie . $activo, "$orden ASC", $this->conn);
        //print_r($papas);
        if ($papas["numcampos"]) {
            for ($i = 0; $i < $papas["numcampos"]; $i++) {
                $hijos = busca_filtro_tabla("count(*) AS cant", $tabla_otra, "cod_padre=" . $papas[$i]["id$tabla_otra"] . $activo, "", $this->conn);
                $this->objetoXML->startElement("item");
                $this->objetoXML->writeAttribute("style", 'font-family:verdana; font-size:7pt;');
                if ($tabla == "serie") {
                    if (@$papas[$i]["estado"] == 1) {
                        $estado_serie = ' - ACTIVA';
                    } else {
                        $estado_serie = ' - INACTIVA';
                    }
                }
                $this->ingresado = 1;
                $this->objetoXML->writeAttribute("text", ($papas[$i]["nombre"]) . ' (' . $papas[$i]['codigo'] . ')');
                $this->objetoXML->writeAttribute("id", $iddependencia . "sub" . $papas[$i]['idserie']);
                if ($hijos[0]["cant"] != 0 && $this->sin_padre_serie) {
                    $this->objetoXML->writeAttribute("nocheckbox", '1');
                }
                if ($hijos[0][0]) {
                    $this->objetoXML->writeAttribute("child", '1');
                } else {
                    $this->objetoXML->writeAttribute("child", '0');
                }

                if (!$this->carga_partes_serie) {
                    $this->llena_subseries_tipo_documental($iddependencia, $papas[$i]["id$tabla_otra"]);
                }
                $this->objetoXML->endElement();
            }
        }
        return;
    }

    /**
     * Set the value of sin_padre_serie
     *
     * @return  self
     */
    public function setSin_padre_serie($sin_padre_serie)
    {
        $this->sin_padre_serie = $sin_padre_serie;

        return $this;
    }

    /**
     * Set the value of sin_padre_expediente
     *
     * @return  self
     */
    public function setSin_padre_expediente($sin_padre_expediente)
    {
        $this->sin_padre_expediente = $sin_padre_expediente;

        return $this;
    }

    /**
     * Set the value of excluidos
     *
     * @return  self
     */
    public function setExcluidos($excluidos)
    {
        $this->excluidos = $excluidos;

        return $this;
    }

    /**
     * Set the value of iddocumento
     *
     * @return  self
     */
    public function setIddocumento($iddocumento)
    {
        $this->iddocumento = $iddocumento;

        return $this;
    }

    /**
     * Set the value of carga_partes_serie
     *
     * @return  self
     */
    public function setCarga_partes_serie($carga_partes_serie)
    {
        $this->carga_partes_serie = $carga_partes_serie;

        return $this;
    }

    /**
     * Set the value of uid
     *
     * @return  self
     */
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set the value of accion
     *
     * @return  self
     */
    public function setAccion($accion)
    {
        $this->accion = $accion;

        return $this;
    }

    /**
     * Set the value of carga_total
     *
     * @return  self
     */ 
    public function setCarga_total($carga_total)
    {
        $this->carga_total = $carga_total;

        return $this;
    }

    /**
     * Set the value of seleccionado
     *
     * @return  self
     */ 
    public function setSeleccionado($seleccionado)
    {
        $this->seleccionado = $seleccionado;

        return $this;
    }
}
