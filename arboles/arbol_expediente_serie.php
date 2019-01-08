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

$objetoJson = array("key" => 0);
if (isset($_REQUEST["checkbox"])) {
    $checkbox = $_REQUEST["checkbox"];
}
$partes = false;
if (isset($_REQUEST["cargar_partes"])) {
    $partes = true;
}
$seleccionados = array();
if (isset($_REQUEST["seleccionados"])) {
    $seleccionados = explode(",", $_REQUEST["seleccionados"]);
}
$idfuncionario = $_SESSION["idfuncionario"];
if ($_REQUEST["iddependencia"]) {
    $busqueda = busca_filtro_tabla("", "dependencia", "iddependencia=" . $_REQUEST["iddependencia"], "", $conn);
    if ($busqueda["numcampos"]) {
        $iddep = $busqueda[0]["iddependencia"];
        $dependencia_nombre = $busqueda[0]["nombre"];
        $dependencia_codigo = $busqueda[0]["codigo"];

        if ($_REQUEST["serie_idserie"]) {
            $arbol = llena_serie($_REQUEST["serie_idserie"], 0, $iddep, 0, $dependencia_nombre, $dependencia_codigo, $partes);
        } else {
            $datos = busca_filtro_tabla("distinct e.identidad_serie", "entidad_serie e, vpermiso_serie vp", "e.identidad_serie=vp.identidad_serie and e.llave_entidad=" . $iddep . " and e.entidad_identidad=2 and e.estado=1 and funcionario_codigo=" . $idfuncionario, "", $conn);
            $lista_entidad_serie = extrae_campo($datos, "identidad_serie");
            $arbol = llena_serie(0, $lista_entidad_serie, $iddep, 0, $dependencia_nombre, $dependencia_codigo, $partes);
        }
    }
}

header('Content-Type: application/json');
echo json_encode($arbol);

function llena_serie($id, $identidad_serie, $iddep, $tipo = 0, $nombre_dependencia, $dependencia_codigo, $partes = 0) {
    global $conn, $checkbox, $idfuncionario, $seleccionados;
    $condicion = "";
    if (is_array($identidad_serie)) {
        $condicion = "identidad_serie in (" . implode(",", $identidad_serie) . ") and ";
    } elseif ($identidad_serie != 0) {
        $condicion = "identidad_serie in" . $identidad_serie . " and ";
    }
    $objetoJson = array();
    if ($id == 0) {
        $papas = busca_filtro_tabla("nombre_serie,codigo,estado_serie,idfuncionario,idserie,identidad_serie,permiso,tipo", "vpermiso_serie", "$condicion (cod_padre=0 or cod_padre is null) and categoria=2 and tvd=0 and funcionario_codigo=" . $idfuncionario, "nombre_serie ASC", $conn);
    } else {
        $papas = busca_filtro_tabla("nombre_serie,codigo,estado_serie,idfuncionario,idserie,identidad_serie,permiso,tipo", "vpermiso_serie", "$condicion cod_padre=" . $id . " and categoria=2 and tvd=0 and funcionario_codigo=" . $idfuncionario, "nombre_serie ASC", $conn);
    }

    if ($papas["numcampos"]) {
        for ($i = 0; $i < $papas["numcampos"]; $i++) {
            $text = $papas[$i]["nombre_serie"] . " (" . $papas[$i]["codigo"] . ")";
            if ($papas[$i]["estado_serie"] == 0) {
                $text .= " - INACTIVO";
            }
            $item = array();
            $item["extraClasses"] = "estilo-serie";
            $item["title"] = $text;
            $item["key"] = $iddep . "." . $papas[$i]["idserie"] . "." . $tipo;

            if ($nombre_dependencia == "" || $dependencia_codigo == "") {
                $valores_dependencia = busca_dependencia($iddep);
                $nombre_dependencia = $valores_dependencia["nombre"];
                $dependencia_codigo = $valores_dependencia["codigo"];
            }
            $item["data"] = array(
                "iddependencia" => $iddep,
                "nombre_dependencia" => $nombre_dependencia,
                "dependencia_codigo" => $dependencia_codigo,
                "codigo" => $papas[$i]["codigo"],
                "identidad_serie" => $papas[$i]["identidad_serie"],
                "serie_idserie" => $papas[$i]["idserie"]
            );

            if ($idfuncionario == $papas[$i]["idfuncionario"] && $papas[$i]["permiso"] == 'l,a,v' && $papas[$i]["tipo"] != 3) {
                $item["checkbox"] = $checkbox;
            }

            if (in_array($item["key"], $seleccionados) !== false) {
                $item["selected"] = true;
            }

            $hijos = busca_filtro_tabla("count(*) as cant", "serie", "tvd=" . $tipo . "  and cod_padre=" . $papas[$i]["idserie"] . " and categoria=2", "", $conn);
            if (!$partes) {
                if ($hijos[0]["cant"]) {
                    $item["children"] = llena_serie($papas[$i]["idserie"], 0, $iddep, $tipo, $nombre_dependencia, $dependencia_codigo);
                }
            }

            if ($hijos[0]["cant"]) {
                $item["lazy"] = true;
            }
            $objetoJson[] = $item;
        }
    }
    return $objetoJson;
}
?>