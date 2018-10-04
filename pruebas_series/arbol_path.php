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
        "path" => $dependencias[$i]["codigo_arbol"]
    ];
    $elementos[] = $item;
}

$arbol = pathToTree($elementos);

print_r($arbol);

function pathToTree($array) {
    $tree = array();
    foreach ($array as $item) {
        $pathIds = explode(".", $item["path"]);
        $current = &$tree;
        foreach ($pathIds as $id) {
            if (!isset($current["children"][$id])) {
                $current["children"][$id] = array();
                //$current["children"][$id]["hola"] = "hola";
                $deps = busca_filtro_tabla("iddependencia, cod_padre, codigo, nombre, codigo_arbol",
                    "dependencia", "iddependencia = $id", "", $conn);
                $current["children"][$id]["key"] = $id;
                $current["children"][$id]["title"] = $deps[0]["nombre"] . " (" . $deps[0]["codigo"] . ")";
            }
            $current = &$current["children"][$id];
            if ($id == $item["key"]) {
                //TODO: Aqui llenar serie
                $current = $item;
            }
        }
    }
    return $tree["children"];
}


