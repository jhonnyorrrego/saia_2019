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
include_once ($ruta_db_superior . "class.funcionarios.php");

$objetoJson = array("key" => 0);
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

if (isset($_REQUEST["checkbox"])) {
    $checkbox = $_REQUEST["checkbox"];
}

if (isset($_REQUEST["serie_idserie"])) {
    $serie_idserie = $_REQUEST["serie_idserie"];
}
$lista_expedientes = array();

if (!$id) {
    $arbol = llena_expediente($id, $idexpediente, $lista_entidades, $condicion_ad, $partes, $lista_expedientes);
} else {
    $arbol_exp = llena_expediente($id, 0, $lista_entidades, $condicion_ad, $partes, $lista_expedientes);
    $agrup = busca_filtro_tabla("agrupador", "expediente", "idexpediente=" . $id, "", $conn);
    $arbol_serie = array();
    if (!$agrup[0]["agrupador"]) {
        $arbol_serie = llena_subserie($serie_idserie, $id);
    }
    $arbol = array_merge($arbol_exp, $arbol_serie);
}

header('Content-Type: application/json');
echo json_encode($arbol);

function llena_expediente($id, $idexpediente, $lista_entidades, $condicion_ad, $partes, $lista_expedientes) {
    global $conn, $condicion_ad;
    $objetoJson = array();
    if ($idexpediente) {
        //$papas = busca_filtro_tabla("DISTINCT idexpediente,serie_idserie,nombre,codigo_numero,estado_cierre,agrupador", "entidad_expediente ee join expediente e on ee.expediente_idexpediente = e.idexpediente", "e.idexpediente=" . $idexpediente, "nombre ASC", $conn);
        $papas = busca_filtro_tabla("DISTINCT e.idexpediente,e.serie_idserie,e.nombre,e.codigo_numero,e.estado_cierre,e.agrupador,e.fk_entidad_serie", "expediente e,permiso_expediente p", "p.fk_expediente=e.idexpediente and p.fk_funcionario=" . $_SESSION["idfuncionario"] . " and e.idexpediente=" . $idexpediente, "nombre ASC", $conn);
    } else if ($id == 0) {
        //$papas = busca_filtro_tabla("DISTINCT idexpediente,serie_idserie,nombre,codigo_numero,estado_cierre,agrupador", "entidad_expediente ee join expediente e on ee.expediente_idexpediente = e.idexpediente", "(cod_padre=0 or cod_padre is null) and e.fk_entidad_serie in (" . $lista_entidades . ")", "nombre ASC", $conn);
        $papas = busca_filtro_tabla("DISTINCT e.idexpediente,e.serie_idserie,e.nombre,e.codigo_numero,e.estado_cierre,e.agrupador,e.fk_entidad_serie", "expediente e,permiso_expediente p", "p.fk_expediente=e.idexpediente and p.fk_funcionario=" . $_SESSION["idfuncionario"] . " and (e.cod_padre=0 or e.cod_padre is null) " . $condicion_ad, "nombre ASC", $conn);
    } else {
        //$papas = busca_filtro_tabla("DISTINCT idexpediente,serie_idserie,nombre,codigo_numero,estado_cierre,agrupador", "entidad_expediente ee join expediente e on ee.expediente_idexpediente = e.idexpediente", "cod_padre=" . $id . " and e.idexpediente in (" . $lista_expedientes . ")", "nombre ASC", $conn);
        $papas = busca_filtro_tabla("DISTINCT e.idexpediente,e.serie_idserie,e.nombre,e.codigo_numero,e.estado_cierre,e.agrupador,e.fk_entidad_serie", "expediente e,permiso_expediente p", "p.fk_expediente=e.idexpediente and p.fk_funcionario=" . $_SESSION["idfuncionario"] . " and e.cod_padre=" . $id . $condicion_ad, "nombre ASC", $conn);
    }

    if ($papas["numcampos"]) {
        for ($i = 0; $i < $papas["numcampos"]; $i++) {
            $cerrado = false;
            $text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo_numero"] . ")";
            if ($papas[$i]["estado_cierre"] == 2) {
                $text .= " - CERRADO";
                $cerrado = true;
            }

            $item = array();
            $item["extraClasses"] = "estilo-dependencia";
            $item["title"] = $text;
            $item["key"] = $papas[$i]["idexpediente"];

            $item["data"] = array(
                "idexpediente" => $papas[$i]["idexpediente"],
                "serie_idserie" => $papas[$i]["serie_idserie"],
                "agrupador" => $papas[$i]["agrupador"]
            );

            $cant_hijos = busca_filtro_tabla("count(1) as cant", "expediente e,permiso_expediente p", "p.fk_expediente=e.idexpediente and p.fk_funcionario=" . $_SESSION["idfuncionario"] . " and e.cod_padre=" . $papas[$i]["idexpediente"] . $condicion_ad, "", $conn);
            $hijos_exp = array();
            $hijos_sub = array();

            if (!$cerrado && $papas[$i]["agrupador"] == 0) {
                $hijos_sub = llena_subserie($papas[$i]["serie_idserie"], $papas[$i]["idexpediente"]);
            }

            if (!$partes) {
                if ($cant_hijos[0]["cant"] && !$cerrado) {
                    $hijos_exp = llena_expediente($papas[$i]["idexpediente"], $idexpediente, $lista_entidades, $condicion_ad, $partes, $lista_expedientes);
                }
            } else {
                $item["lazy"] = true;
            }

            $hijos = array_merge($hijos_exp, $hijos_sub);
            if (!empty($hijos)) {
                $item["children"] = $hijos;
            } else if (!$cant_hijos[0]["cant"]) {
                $item["lazy"] = false;
            }

            $objetoJson[] = $item;
        }
    }
    return $objetoJson;
}

/*private*/
function llena_subserie($id, $idexp) {
    global $conn, $checkbox;
    $objetoJson = array();
    $papas = busca_filtro_tabla("distinct idserie, nombre_serie nombre, codigo, tipo, estado_serie estado, permiso", "vpermiso_serie", "tipo in (2,3) and tvd=0 and cod_padre=" . $id . " and idfuncionario = " . $_SESSION["idfuncionario"] . " and permiso like '%a,v%'", "nombre ASC", $conn);
    if ($papas["numcampos"]) {
        for ($i = 0; $i < $papas["numcampos"]; $i++) {
            $permisos = array();
            $tiene_permisos = false;
            $tiene_permiso_lectura = false;

            if (!empty($papas[$i]["permiso"])) {
                $permisos = explode(",", $papas[$i]["permiso"]);
                $tiene_permisos = in_array("a", $permisos) || in_array("v", $permisos);
                $tiene_permiso_lectura = count($permisos) == 1 && in_array("l", $permisos);
            }

            $text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")";

            if ($papas[$i]["estado"] == 0) {
                $text .= " - INACTIVO";
            }

            if (!$tiene_permisos || $tiene_permiso_lectura) {
                $text .= " - (Sin permiso)";
            }

            $item = array();
            $item["extraClasses"] = "estilo-dependencia";
            $item["title"] = $text;
            $item["key"] = "{$papas[$i]["idserie"]}.{$idexp}";
            if ($papas[$i]["tipo"] == 3 && $tiene_permisos) {
                $item["checkbox"] = $checkbox;
            }

            if ($papas[$i]["estado"] == 0 || !$tiene_permisos) {
            } else {
                $tipo_docu = busca_filtro_tabla("count(1) as cant", "serie", "tipo=3 and tvd=0 and cod_padre=" . $papas[$i]["idserie"], "", $conn);
                if ($tipo_docu[0]["cant"]) {
                    $item["children"] = llena_tipo_documental($papas[$i]["idserie"], $idexp);
                }
            }
            $objetoJson[] = $item;
        }
    }
    return $objetoJson;
}

/*private */
function llena_tipo_documental($id, $idexp) {
    global $conn, $checkbox;
    $objetoJson = array();
    $papas = busca_filtro_tabla("distinct idserie, nombre_serie nombre, codigo, tipo, estado_serie estado, permiso", "vpermiso_serie", "tipo=3 and tvd=0 and cod_padre=" . $id . " and idfuncionario = " . $_SESSION["idfuncionario"] . " and permiso like '%a,v%'", "nombre ASC", $conn);
    if ($papas["numcampos"]) {
        for ($i = 0; $i < $papas["numcampos"]; $i++) {
            $permisos = array();
            $tiene_permisos = false;
            $tiene_permiso_lectura = false;

            if (!empty($papas[$i]["permiso"])) {
                $permisos = explode(",", $papas[$i]["permiso"]);
                $tiene_permisos = in_array("a", $permisos) || in_array("v", $permisos);
                $tiene_permiso_lectura = count($permisos) == 1 && in_array("l", $permisos);
            }

            $text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")";
            if ($papas[$i]["estado"] == 0) {
                $text .= " - INACTIVO";
            }

            $item = array();
            $item["extraClasses"] = "estilo-dependencia";

            $item["key"] = $papas[$i]["idserie"] . "." . $idexp;
            if (!$tiene_permisos || $tiene_permiso_lectura) {
                $text .= " - (Sin permiso)";
            } else {
                $item["checkbox"] = $checkbox;
            }
            $item["title"] = $text;

            $item["data"] = array();
            $item["data"] = array(
                "idexpediente" => $idexp,
                "idserie" => $papas[$i]["idserie"]
            );
            $objetoJson[] = $item;
        }
    }
    return $objetoJson;
}
?>