<?php
require_once ("../db.php");
$iddeps = [
    464,
    477,
    59,
    63
];

$dependencias = busca_filtro_tabla("iddependencia, cod_padre, codigo, nombre, codigo_arbol", "dependencia", "iddependencia in(" . implode(",", $iddeps) . ")", "", $conn);

$elementos = array();
for ($i = 0; $i < $dependencias["numcampos"]; $i++) {
    $item = [
        "key" => $dependencias[$i]["iddependencia"],
        "title" => $dependencias[$i]["nombre"] . " (" . $dependencias[$i]["codigo"] . ")",
        "padre" => $dependencias[$i]["cod_padre"],

    ];
    $elementos[$dependencias[$i]["codigo_arbol"]] = $item;
}

$arbol = explodeTree($elementos, ".");

// $arbol = pathToTree($elementos);

print_r($arbol);

function explodeTree($array, $delimiter = '_') {
    if (!is_array($array)) {
        return false;
    }
    $splitRE = '/' . preg_quote($delimiter, '/') . '/';
    $returnArr = array();
    foreach ($array as $key => $val) {
        // Get parent parts and the current leaf
        $parts = preg_split($splitRE, $key, -1, PREG_SPLIT_NO_EMPTY);
        $leafPart = array_pop($parts);

        // Build parent structure
        // Might be slow for really deep and large structures
        $parentArr = &$returnArr;
        foreach ($parts as $part) {
            $nodo_existe = &existe($parentArr, $part);
            if (!$nodo_existe) {
                $parentArr[] = busca_dependencia($part);
            } elseif (!is_array($nodo_existe)) {
                $parentArr[] = busca_dependencia($part);
            }
            //$parentArr = &$parentArr[$part];
            $parentArr = &existe($parentArr, $part)["children"];
        }

        // Add the final part to the structure
        if (!existe($parentArr, $leafPart)) {
            $parentArr[] = $val;
        }
    }
    return $returnArr;
}

function &existe(&$array, $id) {
    $longitud = count($array);
    for ($i = 0; $i < $longitud; $i++) {
        if ($array[$i]["key"] == $id) {
            return $array[$i];
        }
    }
    return false;
}

function busca_dependencia($iddep) {
    $dependencias = busca_filtro_tabla("iddependencia, cod_padre, codigo, nombre, codigo_arbol", "dependencia", "iddependencia = $iddep", "", $conn);

    if($dependencias["numcampos"]) {
        $item = [
            "key" => $iddep,
            "title" => $dependencias[0]["nombre"] . " (" . $dependencias[$i]["codigo"] . ")",
            "padre" => $dependencias[0]["cod_padre"],
            "children" => null
        ];
        return $item;
    }
    return null;
}

function pathToTree_orig($array) {
    $tree = array();
    foreach ($array as $item) {
        $pathIds = explode(".", $item["path"]);
        $current = &$tree;
        foreach ($pathIds as $id) {
            if (!isset($current["children"][$id])) {
                $current["children"][$id] = array();
                // $current["children"][$id]["hola"] = "hola";
                $deps = busca_filtro_tabla("iddependencia, cod_padre, codigo, nombre, codigo_arbol", "dependencia", "iddependencia = $id", "", $conn);
                $current["children"][$id]["key"] = $id;
                $current["children"][$id]["title"] = $deps[0]["nombre"] . " (" . $deps[0]["codigo"] . ")";
            }
            $current = &$current["children"][$id];
            if ($id == $item["key"]) {
                // TODO: Aqui llenar serie
                $current = $item;
            }
        }
    }
    return $tree["children"];
}
