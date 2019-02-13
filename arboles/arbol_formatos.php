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
$id_x = @$_REQUEST["id"];
$seleccionados = array();
$filtrar = @$_REQUEST["filtrar"];
if (@$_REQUEST["seleccionados"]) {
    $seleccionados = explode(",", $_REQUEST["seleccionados"]);
}
$cargar_seleccionado = @$_REQUEST["cargar_seleccionado"];

if ($id_x) {
    $id_x = buscar_papa($_REQUEST['id']);
}

function buscar_papa($idformato) {
    $exit = $exit + 1;
    if ($exit > 20) {
        return false;
    }
    $formato = busca_filtro_tabla("", "formato", "idformato=" . $idformato . " and cod_padre<>0", "", $conn);
    if ($formato["numcampos"] > 0) {
        $padre = busca_filtro_tabla("", "formato", "idformato=" . $formato[0]["cod_padre"], "", $conn);
        $id_padre = buscar_papa($padre[0]["idformato"]);
        return $id_padre;
    } else {
        return $idformato;
    }
}

$objetoJson = array(
    "key" => 0
);

$seleccionable = null;
if(isset($_REQUEST["seleccionable"])) {
    $seleccionable = $_REQUEST["seleccionable"];
    if($seleccionable == "checkbox") {
        $seleccionable = 1;
    } else {
        $seleccionable = "radio";
    }
}

if (!empty($id_x)) {
    $objetoJson = llena_formato($id_x, 0, $seleccionados, $filtrar, $cargar_seleccionado, $seleccionable);
} else {
    $objetoJson = llena_formato(null, 0, $seleccionados, $filtrar, $cargar_seleccionado, $seleccionable);
}

header('Content-Type: application/json');

echo json_encode($objetoJson);

function llena_formato($id, $nivel = 0, $seleccionados = array(), $filtrar = null, $cargar_seleccionado = null, $seleccionable = null) {
    global $conn;
    $formatoExcluido = '';
    if ($_REQUEST["excluido"]) {
        $idExcluido = $_REQUEST["excluido"];
        $formatoExcluido = " AND idformato NOT IN('{$idExcluido}')";
    }
    // $valida_item = "item <> 1";
    $valida_item = "";
    if (@$_REQUEST['flujo']) {
        $valida_item = "1 = 1";
    }

    $adicionales = "";
    if (!empty($filtrar)) {
        $adicionales = ' AND idformato IN(' . $filtrar . ')';
    }
    if (empty($id)) {
        $papas = busca_filtro_tabla("idformato, etiqueta,descripcion_formato,version", "formato", $valida_item . " (cod_padre=0 OR cod_padre IS NULL)" . $adicionales .$formatoExcluido , "etiqueta ASC", $conn);
    } else if ($cargar_seleccionado == 1) {
        $papas = busca_filtro_tabla("idformato, etiqueta,descripcion_formato,version", "formato", "idformato=" . $id, "etiqueta ASC", $conn);
        // $papas = busca_filtro_tabla("idformato, etiqueta", "formato", $valida_item . " idformato=" . $id . $adicionales, "etiqueta ASC", $conn);
    } else {
        $papas = busca_filtro_tabla("idformato, etiqueta,descripcion_formato,version", "formato", "item <> 1 AND cod_padre=" . $id . $adicionales. $formatoExcluido, "etiqueta ASC", $conn);
    }

    $resp = array();
    if ($papas["numcampos"]) {
        for ($i = 0; $i < $papas["numcampos"]; $i++) {

            $hijos = busca_filtro_tabla("count(*) total", "formato", $valida_item . "  cod_padre=" . $papas[$i]["idformato"], "", $conn);
            $item = [
                "extraClasses" => "estilo-arbol kenlace_saia"
            ];

            $item["expanded"] = true;
            if (in_array($papas[$i]["idformato"], $seleccionados)) {
                $item["selected"] = true;
            }

            $item["title"] = $papas[$i]["etiqueta"];
            $item["key"] = $papas[$i]["idformato"];
            $item["data"] = array(
                'descripcion' => html_entity_decode($papas[$i]["descripcion_formato"]),
                'version' => $papas[$i]["version"]
            );
            if (!empty($hijos[0]["total"])) {
                $children = llena_formato($papas[$i]["idformato"], $nivel++, $seleccionados,null,null, $seleccionable);

                if (!empty($children)) {

                    $item["children"] = $children;
                }
            } else if($seleccionable) {
                $item["checkbox"] = $seleccionable;
            }

            $resp[] = $item;
        }
    }

    return $resp;
}