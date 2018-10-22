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

$objetoJson = array(
    "key" => 0
);

if ($_REQUEST["id"] && $_REQUEST["cargar_partes"]) {
    //$objetoJson["key"] = $_REQUEST["id"];
    $objetoJson = array();
    $id = explode(".", $_REQUEST["id"]);
    $hijos_dep = array();
    $hijos_serie = array();
    $hijos_otros = array();
    $hijos = array();
    if ($id[1] == 0) {
        $hijos_dep = llena_dependencia($id[0], $id[2], true);
        if (!empty($hijos_dep)) {
            $hijos = $hijos_dep;
        }
    }
    if ($id[0] != 0) {
        $hijos_serie = llena_serie($id[1], $id[0], $id[2]);
        if (!empty($hijos_serie)) {
            $hijos = array_merge($hijos, $hijos_serie);
        }
    }

    if ($_REQUEST["serie_sin_asignar"] == 1 && $id[0] == 0) {
        $hijos_serie = array();
        $hijos_serie = llena_serie_sin_asignar($id[1]);
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
    if(isset($_REQUEST["cargar_partes"])) {
        $partes = true;
    }
    $hijos = array();
    $objetoJson["key"] = 0;
    $hijos_dep = array();
    $hijos_dep = llena_dependencia(0, 0, $partes); // TRD
    if (!empty($hijos_dep)) {
        $hijos = $hijos_dep;
    }
    $hijos_dep = array();
    $hijos_dep = llena_dependencia(0, 1, $partes); // TVD
    if (!empty($hijos_dep)) {
        $hijos = array_merge($hijos, $hijos_dep);
    }
    $hijos_serie = array();
    $hijos_otros = array();

    if ($_REQUEST["serie_sin_asignar"] == 1) {
        $item_sa = array();
        $item_sa["extraClasses"] = "estilo-serie";
        $item_sa["title"] = "LISTADO DE SERIES";
        $item_sa["key"] = "0.0.0";
        $item_sa["folder"] = 1;

        $item_sa["children"] = llena_serie_sin_asignar(0, 1);
        $hijos[] = $item_sa;
    }
    if ($_REQUEST["otras_categorias"] == 1) {
        $item_oc = array();
        $item_oc["extraClasses"] = "estilo-serie";
        $item_oc["title"] = "OTRAS CATEGORIAS";
        $item_oc["key"] = "0.0.-1";
        $item_oc["folder"] = 1;

        $item_oc["children"] = llena_otras_categorias(0, 1);
        $hijos[] = $item_oc;
    }
    $objetoJson["children"] = $hijos;
}

header('Content-Type: application/json');

echo json_encode($objetoJson);

function llena_dependencia($id, $tipo = 0, $partes = false) {
    global $conn;
    $objetoJson = array();
    $parte_text = "";
    if ($id == 0) {
        $papas = busca_filtro_tabla("", "dependencia", "(cod_padre=0 or cod_padre is null)", "nombre ASC", $conn);
        if ($tipo) {
            $parte_text = " - TVD";
        } else {
            $parte_text = " - TRD";
        }
    } else {
        $papas = busca_filtro_tabla("", "dependencia", "cod_padre=" . $id, "nombre ASC", $conn);
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
            $item["key"] = $papas[$i]["iddependencia"] . ".0." . $tipo;

            $hijos = busca_filtro_tabla("count(*) as cant", "dependencia", "cod_padre=" . $papas[$i]["iddependencia"], "", $conn);
            $serie = busca_filtro_tabla("count(*) as cant", "entidad_serie e,serie s", "e.serie_idserie=s.idserie and e.estado=1 and e.llave_entidad=" . $papas[$i]["iddependencia"] . " and s.tvd=" . $tipo . " and (s.cod_padre=0 or s.cod_padre is null)", "", $conn);
            $dependencias_hijas = array();
            $series_hijas = array();
            if (!$partes) {
                if ($hijos[0]["cant"] || $serie[0]["cant"]) {
                    $dependencias_hijas = llena_dependencia($papas[$i]["iddependencia"], $tipo);
                }
                /* SERIES */
                $series_hijas = llena_serie(0, $papas[$i]["iddependencia"], $tipo);
                $dependencias_hijas = array_merge($dependencias_hijas, $series_hijas);
                /* TERMINA SERIES */
                if (!empty($dependencias_hijas)) {
                    $item["folder"] = true;
                    $item["children"] = $dependencias_hijas;
                } else {
                    $item["folder"] = 0;
                }
            } else {
                $item["lazy"] = true;
            }
            $objetoJson[] = $item;
        }
    }
    return $objetoJson;
}

function llena_serie($id, $iddep, $tipo = 0) {
    global $conn;
    $objetoJson = array();
    if ($id == 0) {
        $papas = busca_filtro_tabla("e.identidad_serie, s.*", "entidad_serie e,serie s", "e.serie_idserie=s.idserie and e.estado=1 and e.llave_entidad=" . $iddep . " and s.tvd=" . $tipo . " and (s.cod_padre=0 or s.cod_padre is null) and s.categoria=2", "s.nombre ASC", $conn);
    } else {
        $papas = busca_filtro_tabla("e.identidad_serie, s.*", "entidad_serie e,serie s", "e.serie_idserie=s.idserie and e.estado=1 and e.llave_entidad=" . $iddep . " and s.tvd=" . $tipo . " and s.cod_padre=" . $id . " and s.categoria=2", "s.nombre ASC", $conn);
    }

    if ($papas["numcampos"]) {
        for ($i = 0; $i < $papas["numcampos"]; $i++) {
        	$identidad_serie=$papas[$i]["identidad_serie"];
        	
            $text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")";
            if ($papas[$i]["estado"] == 0) {
                $text .= " - INACTIVO";
            }
            $item = array();
            $item["extraClasses"] = "estilo-serie";
            $item["title"] = $text;
            $item["key"] = $iddep . "." . $papas[$i]["idserie"] . "." . $tipo;

            $item["data"] = array("entidad_serie"=>$identidad_serie);
			//$item["expanded"]=true;
            $hijos = busca_filtro_tabla("count(*) as cant", "serie", "tvd=" . $tipo . "  and cod_padre=" . $papas[$i]["idserie"] . " and categoria=2", "", $conn);
            if ($hijos[0]["cant"]) {
                $item["folder"] = 1;
                $item["children"] = llena_serie($papas[$i]["idserie"], $iddep, $tipo);
            } else {
                $item["folder"] = 0;
            }
            $objetoJson[] = $item;
        }
    }
    return $objetoJson;
}

function llena_serie_sin_asignar($id, $inicio = 0) {
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
            $asig = busca_filtro_tabla("count(*) as cant", "entidad_serie", "estado=1 and serie_idserie=" . $papas[$i]["idserie"], "");
            $style = "estilo-serie";
            if ($asig[0]["cant"] == 0 && $papas[$i]["tipo"] != 3) {
                $style = "estilo-serie-sa";
            }

            $item["extraClasses"] = $style;
            $item["title"] = $text;
            $item["key"] = "0." . $papas[$i]["idserie"] . "." . $papas[$i]["tvd"];

            $hijos = busca_filtro_tabla("count(*) as cant", "serie", "cod_padre=" . $papas[$i]["idserie"] . " and categoria=2", "", $conn);
            if ($hijos[0]["cant"]) {
                $item["folder"] = 1;
                $item["children"] = llena_serie_sin_asignar($papas[$i]["idserie"]);
            } else {
                $item["folder"] = 0;
            }
            $objetoJson[] = $item;
        }
    }
    return $objetoJson;
}

function llena_otras_categorias($id, $inicio = 0) {
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
            $item["key"] = "0." . $papas[$i]["idserie"] . ".-1";

            $hijos = busca_filtro_tabla("count(*) as cant", "serie", "cod_padre=" . $papas[$i]["idserie"] . " and categoria=3", "", $conn);
            if ($hijos[0]["cant"]) {
                $item["folder"] = 1;
                $item["children"] = llena_otras_categorias($papas[$i]["idserie"]);
            } else {
                $item["folder"] = 0;
            }
            $objetoJson[] = $item;
        }
    }
    return $objetoJson;
}
?>
