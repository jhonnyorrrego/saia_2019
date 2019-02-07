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
$seleccionados = array();
$idflujo = @$_REQUEST["idflujo"];
if (@$_REQUEST["seleccionados"]) {
    $seleccionados = explode(",", $_REQUEST["seleccionados"]);
}

$objetoJson = array(
    "key" => 0
);

$seleccionable = null;
if (isset($_REQUEST["seleccionable"])) {
    $seleccionable = $_REQUEST["seleccionable"];
    if ($seleccionable == "checkbox") {
        $seleccionable = 1;
    } else {
        $seleccionable = "radio";
    }
}

$idnotificacion = null;
if (isset($_REQUEST["idnotificacion"])) {
    $idnotificacion = $_REQUEST["idnotificacion"];
}

$objetoJson = llena_formato($idflujo, $idnotificacion, $seleccionados, $seleccionable);

header('Content-Type: application/json');

echo json_encode($objetoJson);

function llena_formato($idflujo, $idnotificacion, $seleccionados = array(), $seleccionable = null) {
    global $conn;

    $papas = busca_filtro_tabla("f.idformato, f.etiqueta, f.descripcion_formato, f.version, ff.idformato_flujo",
        "wf_formato_flujo ff join formato f on ff.fk_formato = f.idformato",
        "f.item <> 1 AND ff.fk_flujo = $idflujo", "etiqueta ASC", $conn);

    $resp = array();
    if ($papas["numcampos"]) {
        for ($i = 0; $i < $papas["numcampos"]; $i++) {
            $item = [
                "extraClasses" => "estilo-arbol kenlace_saia"
            ];

            $item["expanded"] = false;
            if(in_array($papas[$i]["idformato_flujo"], $seleccionados)) {
                $item["selected"] = true;
            }

            $item["title"] = $papas[$i]["etiqueta"];
            $item["key"] = $papas[$i]["idformato_flujo"];
            $item["data"] = array(
                'descripcion' => $papas[$i]["descripcion_formato"],
                'version' => $papas[$i]["version"]
            );
            if($seleccionable) {
                $item["checkbox"] = $seleccionable;
            }

            $resp[] = $item;
        }
    }

    return $resp;
}

?>
