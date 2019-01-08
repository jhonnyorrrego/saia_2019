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

if (!$id) {
    $arbol = llena_expediente($id, $idexpediente, $condicion_ad, $partes);
} else {
    $arbol = llena_expediente($id, 0, $condicion_ad, $partes);
}

header('Content-Type: application/json');
echo json_encode($arbol);

function llena_expediente($id, $idexpediente, $condicion_ad, $partes) {
    global $conn, $condicion_ad, $checkbox;
    $objetoJson = array();
    if ($idexpediente) {
        $papas = busca_filtro_tabla("DISTINCT e.idexpediente,e.serie_idserie,e.nombre,e.codigo_numero,e.estado_cierre,e.agrupador,e.fk_entidad_serie", "expediente e,permiso_expediente p", "p.fk_expediente=e.idexpediente and p.fk_funcionario=" . $_SESSION["idfuncionario"] . " and e.idexpediente=" . $idexpediente, "nombre ASC", $conn);
    } else if ($id == 0) {
        $papas = busca_filtro_tabla("DISTINCT e.idexpediente,e.serie_idserie,e.nombre,e.codigo_numero,e.estado_cierre,e.agrupador,e.fk_entidad_serie", "expediente e,permiso_expediente p", "p.fk_expediente=e.idexpediente and p.fk_funcionario=" . $_SESSION["idfuncionario"] . " and (e.cod_padre=0 or e.cod_padre is null) " . $condicion_ad, "nombre ASC", $conn);
    } else {
        $papas = busca_filtro_tabla("DISTINCT e.idexpediente,e.serie_idserie,e.nombre,e.codigo_numero,e.estado_cierre,e.agrupador,e.fk_entidad_serie", "expediente e,permiso_expediente p", "p.fk_expediente=e.idexpediente and p.fk_funcionario=" . $_SESSION["idfuncionario"] . " and e.cod_padre=" . $id . $condicion_ad, "nombre ASC", $conn);
    }

    if ($papas["numcampos"]) {
        for ($i = 0; $i < $papas["numcampos"]; $i++) {
            $item = array();
            $item["extraClasses"] = "estilo-dependencia";
            $item["key"] = $papas[$i]["idexpediente"];

            $cerrado = false;
            $text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo_numero"] . ")";
            if ($papas[$i]["estado_cierre"] == 2) {
                $text .= " - CERRADO";
                $cerrado = true;
            }

            $cons_permiso = busca_filtro_tabla("permiso", "permiso_expediente", "fk_expediente=" . $papas[$i]["idexpediente"] . " and fk_funcionario=" . $_SESSION["idfuncionario"], "", $conn);
            $permiso = '';
            if ($cons_permiso["numcampos"]) {
                for ($k = 0; $k < $cons_permiso["numcampos"]; $k++) {
                    $permiso .= $cons_permiso[$k]["permiso"] . ',';
                }
            }
            $permisos = explode(",", $permiso);
            $tiene_permisos = in_array("a", $permisos) || in_array("v", $permisos);
            if ($tiene_permisos && !$cerrado) {
                $item["checkbox"] = $checkbox;
            }

            $item["title"] = $text;
            $item["data"] = array(
                "idexpediente" => $papas[$i]["idexpediente"],
                "serie_idserie" => $papas[$i]["serie_idserie"],
                "agrupador" => $papas[$i]["agrupador"]
            );

            $cant_hijos = busca_filtro_tabla("count(1) as cant", "expediente e,permiso_expediente p", "p.fk_expediente=e.idexpediente and p.fk_funcionario=" . $_SESSION["idfuncionario"] . " and e.cod_padre=" . $papas[$i]["idexpediente"] . $condicion_ad, "", $conn);
            $hijos = array();

            if (!$partes) {
                if ($cant_hijos[0]["cant"] && !$cerrado) {
                    $hijos = llena_expediente($papas[$i]["idexpediente"], $idexpediente, $condicion_ad, $partes);
                }
            } else {
                $item["lazy"] = true;
            }

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
?>