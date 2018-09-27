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

include_once ($ruta_db_superior . "class.funcionarios.php");
include_once ($ruta_db_superior . "pantallas/expediente/librerias.php");
$ingresado = 0;
$id = @$_REQUEST["inicia"];
$excluidos = array();

if (@$_REQUEST["excluidos"])
    $excluidos = explode(",", $_REQUEST["excluidos"]);

$funcionarios = array();
$idfunc = usuario_actual("idfuncionario");

$lista2 = expedientes_asignados();
$idfuncionario = usuario_actual("idfuncionario");
$datos_admin_funcionario = busca_datos_administrativos_funcionario($idfuncionario);

$id = @$_REQUEST["idexpediente"];

if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
    header("Content-type: application/xhtml+xml");
} else {
    header("Content-type: text/xml");
}

$objetoXML = new XMLWriter();
$objetoXML->openMemory();
$objetoXML->setIndent(true);
$objetoXML->setIndentString("\t");
$objetoXML->startDocument('1.0', 'utf-8');
$objetoXML->startElement("tree");

if ($id && @$_REQUEST["uid"]) {
    $objetoXML->writeAttribute("id", $id);

    llena_expediente($id);
    if (!$ingresado) {
        $objetoXML->writeAttribute("style", "font-family:verdana; font-size:7pt;");
        $objetoXML->writeAttribute("text", "No tiene series documentales asignadas");

        $objetoXML->writeAttribute("id", -1);
        $objetoXML->writeAttribute("nocheckbox", 1);
    }
    $objetoXML->endElement();
    $objetoXML->endDocument();

    $cadenaXML = trim($objetoXML->outputMemory());
    echo $cadenaXML;

    die();
}

$objetoXML->writeAttribute("id", "0");

llena_expediente($id);
if (!$ingresado) {
    $objetoXML->startElement("item");
    $objetoXML->writeAttribute("style", "font-family:verdana; font-size:7pt;");
    $objetoXML->writeAttribute("text", "No tiene series documentales asignadas");
    $objetoXML->writeAttribute("id", "-1");
    $objetoXML->writeAttribute("nocheckbox", "1");
    $objetoXML->endElement();
}

$objetoXML->endDocument();

$cadenaXML = trim($objetoXML->outputMemory());
echo $cadenaXML;

function llena_expediente($id) {
    global $objetoXML, $conn, $funcionarios, $excluidos, $lista2, $datos_admin_funcionario, $ingresado;
    if ($id == 0) {
        $papas = busca_filtro_tabla("a.fecha, a.nombre, a.cod_arbol, a.idexpediente, estado_cierre",
            "vexpediente_serie a", $lista2 . " and (a.cod_padre=0 OR a.cod_padre IS NULL) AND a.estado_cierre=1",
            "GROUP BY a.fecha, a.nombre, a.cod_arbol, a.idexpediente, estado_cierre order by idexpediente desc", $conn);
    } else {
        $papas = busca_filtro_tabla("a.fecha, a.nombre, a.cod_arbol, a.idexpediente, a.estado_cierre",
            "vexpediente_serie a", $lista2 . " and (a.cod_padre=" . $id . ") AND a.estado_cierre=1",
            "GROUP BY a.fecha, a.nombre, a.cod_arbol, a.idexpediente, estado_cierre order by idexpediente desc", $conn);
    }
    if ($papas["numcampos"]) {
        for ($i = 0; $i < $papas["numcampos"]; $i++) {
            if (!in_array($papas[$i]["idexpediente"], $excluidos)) {
                $ingresado = 1;
                $hijos_entidad_serie = busca_filtro_tabla("serie_idserie", "expediente", "idexpediente=" . $papas[$i]["idexpediente"], "", $conn);

                $texto_item = "";
                $texto_item = ($papas[$i]["nombre"]);
                if ($papas[$i]["estado_cierre"] == 2) {
                    $texto_item .= " <span style=\"color:red\">(CERRADO)</span>";
                }

                $objetoXML->startElement("item");
                $objetoXML->writeAttribute("style", "font-family:verdana; font-size:7pt; font-weight: 900;");
                $objetoXML->writeAttribute("text", htmlspecialchars($texto_item));
                $objetoXML->writeAttribute("id", $papas[$i]["idexpediente"]);
                if (@$_REQUEST["seleccionado"] && $_REQUEST["seleccionado"] == $papas[$i]["idexpediente"]) {
                    $objetoXML->writeAttribute("checked", "1");
                    if ($papas[$i]["estado_cierre"] == 2) {
                        $objetoXML->writeAttribute("nocheckbox", "1");
                    }
                    // $objetoXML->writeAttribute("child", "1");
                } else {
                    $objetoXML->writeAttribute("nocheckbox", "0");
                }

                if (@$_REQUEST['sin_padre_expediente']) {
                    $objetoXML->writeAttribute("nocheckbox", "1");
                }

                $child = 0;
                if ($hijos_entidad_serie['numcampos']) {
                    for ($x = 0; $x < $hijos_entidad_serie['numcampos']; $x++) {
                        if (in_array($hijos_entidad_serie[$x]['serie_idserie'], $datos_admin_funcionario["series"])) {
                            $child = 1;
                        }
                    }
                }
                $hijos_expediente = busca_filtro_tabla("a.fecha, a.nombre, a.cod_arbol, a.idexpediente, a.estado_cierre",
                    "vexpediente_serie a", $lista2 . " and (a.cod_padre=" . $papas[$i]["idexpediente"] . ") AND a.estado_cierre=1",
                    "GROUP BY a.fecha, a.nombre, a.cod_arbol, a.idexpediente, estado_cierre order by idexpediente desc", $conn);
                if ($hijos_expediente['numcampos']) {
                    $child = 1;
                }
                $objetoXML->writeAttribute("child", "" . $child . "");

                //echo (">");
                if (@$_REQUEST["uid"] || @$_REQUEST["carga_total"]) {
                    llena_expediente($papas[$i]["idexpediente"]);
                }
                $objetoXML->endElement();
            }
        }
    }
    if (@$_REQUEST['uid'] || @$_REQUEST['id']) {
        if ($_REQUEST['id'] == $id) {
            $hijos_entidad_serie = busca_filtro_tabla("serie_idserie", "expediente", "idexpediente=" . $_REQUEST['id'], "", $conn);

            if ($hijos_entidad_serie['numcampos']) {
                $lista_entidad_series_filtrar = implode(',', extrae_campo($hijos_entidad_serie, 'serie_idserie'));
            }

            if ($hijos_entidad_serie['numcampos']) {
                llena_entidad_serie($_REQUEST['id'], $lista_entidad_series_filtrar);
            }
        }
    }
    return;
}

// llena series asignadas segun dependencia (dsa)
function llena_entidad_serie($iddependencia, $series) {
    global $objetoXML, $conn, $ingresado;

    $condicion_final = "categoria=2 AND idserie IN(" . $series . ")";
    $series = busca_filtro_tabla("nombre,idserie,codigo", "serie", $condicion_final, "", $conn);

    for ($i = 0; $i < $series['numcampos']; $i++) {
        $objetoXML->startElement("item");
        $objetoXML->writeAttribute("style", "font-family:verdana; font-size:7pt;");
        $objetoXML->writeAttribute("text", "" . htmlspecialchars(($series[$i]["nombre"])) . ' (' . $series[$i]['codigo'] . ')');
        $objetoXML->writeAttribute("id", $iddependencia . "sub" . $series[$i]['idserie']);
        if (@$_REQUEST['sin_padre']) {
            $objetoXML->writeAttribute("nocheckbox", "1");
        }
        $ingresado = 1;
        $subseries_tipo_documental = busca_filtro_tabla("idserie", "serie", "categoria=2 AND tipo IN(2,3) AND cod_padre=" . $series[$i]['idserie'], "", $conn);
        // print_r($subseries_tipo_documental);
        if ($subseries_tipo_documental['numcampos']) {
            $objetoXML->writeAttribute("child", "1");
        } else {
            $objetoXML->writeAttribute("child", "0");
        }

        if ($subseries_tipo_documental['numcampos']) {
            if (!@$_REQUEST['carga_partes_serie']) {
                llena_subseries_tipo_documental($iddependencia, $series[$i]['idserie']);
            }
        }

        $objetoXML->endElement();
    }
}

function llena_subseries_tipo_documental($iddependencia, $idserie) {
    global $objetoXML, $conn, $excluidos, $ingresado;

    $tabla_otra = 'serie';
    $orden = "nombre";

    $papas = busca_filtro_tabla("", $tabla_otra, "cod_padre=" . $idserie, "$orden ASC", $conn);
    // print_r($papas);
    if ($papas["numcampos"]) {
        for ($i = 0; $i < $papas["numcampos"]; $i++) {
            $hijos = busca_filtro_tabla("count(*) AS cant", $tabla_otra, "cod_padre=" . $papas[$i]["id$tabla_otra"], "", $conn);
            $objetoXML->startElement("item");
            $objetoXML->writeAttribute("style", "font-family:verdana; font-size:7pt;");

            $ingresado = 1;
            $objetoXML->writeAttribute("text", "" . htmlspecialchars(($papas[$i]["nombre"])) . ' (' . $papas[$i]['codigo'] . ')');
            $objetoXML->writeAttribute("id", $iddependencia . "sub" . $papas[$i]['idserie']);
            if (@$_REQUEST["arbol_series"]) {
            } else if ($hijos[0]["cant"] != 0 && (@$_REQUEST["sin_padre"])) {
                $objetoXML->writeAttribute("nocheckbox", "1");
            }
            if ($hijos[0][0])
                $objetoXML->writeAttribute("child", "1");
            else
                $objetoXML->writeAttribute("child", "0");
            if (!@$_REQUEST['carga_partes_serie']) {
                llena_subseries_tipo_documental($iddependencia, $papas[$i]["id$tabla_otra"]);
            }
            $objetoXML->endElement();
        }
    }
    return;
}