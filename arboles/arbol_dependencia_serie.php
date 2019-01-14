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

$objetoJson = array("key" => 0);

if ($_REQUEST["id"] && $_REQUEST["cargar_partes"]) {
    $objetoJson = array();
    $id = explode(".", $_REQUEST["id"]);
    $hijos_dep = array();
    $hijos_serie = array();
    $hijos_otros = array();
    $hijos = array();
    if ($id[1] == 0) {
        $hijos_dep = llena_dependencia($id[0], true);
        if (!empty($hijos_dep)) {
            $hijos = $hijos_dep;
        }
    }
    if ($id[0] != 0) {
        $hijos_serie = llena_serie($id[1], $id[0]);
        if (!empty($hijos_serie)) {
            $hijos = array_merge($hijos, $hijos_serie);
        }
    }

    if ($_REQUEST["otras_categorias"] == 1 && $id[0] == 0) {
        $hijos_otros = llena_otras_categorias($id[1]);
        if (!empty($hijos_otros)) {
            $hijos = array_merge($hijos, $hijos_otros);
        }
    }
    $objetoJson = $hijos;
} else {
    $partes = false;
    if (isset($_REQUEST["cargar_partes"])) {
        $partes = true;
    }
    $hijos = array();
    $objetoJson["key"] = 0;
    $hijos_dep = array();
    $hijos_dep = llena_dependencia(0, $partes);

    if (!empty($hijos_dep)) {
        $hijos = $hijos_dep;
    }

    $hijos_serie = array();
    $hijos_otros = array();

    if ($_REQUEST["otras_categorias"] == 1) {
        $item_oc = array();
        $item_oc["extraClasses"] = "estilo-serie";
        $item_oc["title"] = "OTRAS CATEGORIAS";
        $item_oc["key"] = "0.0";

        $item_oc["children"] = llena_otras_categorias(0, 1);
        $hijos[] = $item_oc;
    }
    $objetoJson["children"] = $hijos;
}

header('Content-Type: application/json');
echo json_encode($objetoJson);

function llena_dependencia($id, $partes = false) {
    global $conn;
    $objetoJson = array();
    $parte_text = "";
    if ($id == 0) {
        $papas = busca_filtro_tabla("iddependencia,codigo,nombre,estado", "dependencia", "(cod_padre=0 or cod_padre is null)", "nombre ASC", $conn);
        $parte_text = " - TRD";
    } else {
        $papas = busca_filtro_tabla("iddependencia,codigo,nombre,estado", "dependencia", "cod_padre=" . $id, "nombre ASC", $conn);
    }
    if ($papas["numcampos"]) {
        for ($i = 0; $i < $papas["numcampos"]; $i++) {
            $text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")" . $parte_text;
            if ($papas[$i]["estado"] == 0) {
                $text .= " - INACTIVO";
            }
            $item = array();
            $item["extraClasses"] = "estilo-dependencia";
            $item["title"] = $text;
            $item["key"] = $papas[$i]["iddependencia"] . ".0";

            $hijos = busca_filtro_tabla("count(*) as cant", "dependencia", "cod_padre=" . $papas[$i]["iddependencia"], "", $conn);
            $serie = busca_filtro_tabla("count(*) as cant", "entidad_serie e,serie s", "e.fk_serie=s.idserie and e.fk_dependencia=" . $papas[$i]["iddependencia"] . " and (s.cod_padre=0 or s.cod_padre is null)", "", $conn);

            $dependencias_hijas = array();
            $series_hijas = array();
            $dependencias_hijas1 = array();
            if (!$partes) {
                if ($hijos[0]["cant"]) {
                    $dependencias_hijas1 = llena_dependencia($papas[$i]["iddependencia"]);
                }
                if ($serie[0]["cant"]) {
                    $series_hijas = llena_serie(0, $papas[$i]["iddependencia"]);
                }
                $dependencias_hijas = array_merge($dependencias_hijas1, $series_hijas);
            } else {
                $item["lazy"] = true;
            }

            if (!empty($dependencias_hijas)) {
                $item["children"] = $dependencias_hijas;
            } else if ($serie[0]["cant"] || $hijos[0]["cant"]) {
                $item["lazy"] = true;
            } else {
                $item["lazy"] = false;
            }
            $objetoJson[] = $item;
        }
    }
    return $objetoJson;
}

function llena_serie($id, $iddep) {
    global $conn;
    $objetoJson = array();
    if ($id == 0) {
        $papas = busca_filtro_tabla("e.identidad_serie, s.*", "entidad_serie e,serie s", "e.fk_serie=s.idserie and e.fk_dependencia=" . $iddep . " and (s.cod_padre=0 or s.cod_padre is null) and s.categoria=2", "s.nombre ASC", $conn);
    } else {
        $papas = busca_filtro_tabla("e.identidad_serie,s.*", "entidad_serie e,serie s", "e.fk_serie=s.idserie and e.fk_dependencia=" . $iddep . " and s.cod_padre=" . $id . " and s.categoria=2", "s.nombre ASC", $conn);
    }
    if ($papas["numcampos"]) {
        for ($i = 0; $i < $papas["numcampos"]; $i++) {
            $identidad_serie = $papas[$i]["identidad_serie"];
            $text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")";
            if ($papas[$i]["estado"] == 0) {
                $text .= " - INACTIVO";
            }
            $item = array();
            $item["extraClasses"] = "estilo-serie";
            $item["title"] = $text;
            $item["key"] = $iddep . "." . $papas[$i]["idserie"];

            $item["data"] = array("entidad_serie" => $identidad_serie);
            $hijos = busca_filtro_tabla("count(*) as cant", "serie", " cod_padre=" . $papas[$i]["idserie"] . " and categoria=2", "", $conn);
            if ($hijos[0]["cant"]) {
                $item["children"] = llena_serie($papas[$i]["idserie"], $iddep);
            }
            $objetoJson[] = $item;
        }
    }
    return $objetoJson;
}

function llena_serie_sin_asignar($id) {
    global $conn;
    $objetoJson = array();

    if ($id == 0) {
        $papas = busca_filtro_tabla("", "serie", "(cod_padre=0 or cod_padre is null) and categoria=2", "nombre ASC", $conn);
    } else {
        $papas = busca_filtro_tabla("", "serie", "cod_padre=" . $id . " and categoria=2", "nombre ASC", $conn);
    }
    if ($papas["numcampos"]) {
        for ($i = 0; $i < $papas["numcampos"]; $i++) {
            $text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")";
            if ($papas[$i]["estado"] == 0) {
                $text .= " - INACTIVO";
            }
            $item = array();
            $asig = busca_filtro_tabla("count(*) as cant", "entidad_serie", "estado=1 and fk_serie=" . $papas[$i]["idserie"], "", $conn);
            $style = "estilo-serie";
            if ($asig[0]["cant"] == 0 && $papas[$i]["tipo"] != 3) {
                $style = "estilo-serie-sa";
            }

            $item["extraClasses"] = $style;
            $item["title"] = $text;
            $item["key"] = "0." . $papas[$i]["idserie"];

            $hijos = busca_filtro_tabla("count(*) as cant", "serie", "cod_padre=" . $papas[$i]["idserie"] . " and categoria=2", "", $conn);
            if ($hijos[0]["cant"]) {
                $item["children"] = llena_serie_sin_asignar($papas[$i]["idserie"]);
            }
            $objetoJson[] = $item;
        }
    }
    return $objetoJson;
}

function llena_otras_categorias($id) {
    global $conn;
    $objetoJson = array();
    if ($id == 0) {
        $papas = busca_filtro_tabla("", "serie", "(cod_padre=0 or cod_padre is null) and categoria=3", "nombre ASC", $conn);
    } else {
        $papas = busca_filtro_tabla("", "serie", "cod_padre=" . $id . " and categoria=3", "nombre ASC", $conn);
    }
    if ($papas["numcampos"]) {
        for ($i = 0; $i < $papas["numcampos"]; $i++) {
            $text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")";
            if ($papas[$i]["estado"] == 0) {
                $text .= " - INACTIVO";
            }
            $item = array();
            $item["extraClasses"] = "estilo-serie";
            $item["title"] = $text;
            $item["key"] = "0." . $papas[$i]["idserie"];

            $hijos = busca_filtro_tabla("count(*) as cant", "serie", "cod_padre=" . $papas[$i]["idserie"] . " and categoria=3", "", $conn);
            if ($hijos[0]["cant"]) {
                $item["children"] = llena_otras_categorias($papas[$i]["idserie"]);
            }
            $objetoJson[] = $item;
        }
    }
    return $objetoJson;
}
?>
