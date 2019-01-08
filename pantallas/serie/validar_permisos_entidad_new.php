<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
include_once ($ruta_db_superior . 'db.php');

if ($_REQUEST['id']) {
    $accion = $_REQUEST['accion'];
    $llave_entidad = $_REQUEST['id'];
    $idserie = $_REQUEST['serie'];
    $entidad_identidad = $_REQUEST['tipo_entidad'];

    if ($accion) {
        $sqlc = "INSERT INTO permiso_serie (entidad_identidad,serie_idserie,llave_entidad,estado) VALUES (" . $entidad_identidad . "," . $idserie . "," . $llave_entidad . ",1)";
        phpmkr_query($sqlc) or die($sqlc);

        $expedientes = busca_filtro_tabla("idexpediente", "expediente", "serie_idserie=$idserie", "", $conn);
        if($expedientes["numcampos"]) {
            for($i = 0; $i < $expedientes["numcampos"]; $i++) {
                $valores = array(
                    "entidad_identidad" => $entidad_identidad,
                    "expediente_idexpediente" => $expedientes[$i]["idexpediente"],
                    "llave_entidad" => $llave_entidad,
                    "permiso" => "NULL",
                    "fecha" => fecha_db_almacenar(date("Y-m-d"), "Y-m-d")
                );
                $qry = "INSERT INTO entidad_expediente(" . implode(",", array_keys($valores)) . ") values(" . implode(",", array_values($valores)) . ")";
                phpmkr_query($qry) or die($qry);
            }
        }
    } else {
        $sqlc = "DELETE FROM permiso_serie WHERE entidad_identidad=" . $entidad_identidad . " AND serie_idserie=" . $idserie . " AND llave_entidad=" . $llave_entidad;
        phpmkr_query($sqlc) or die($sqlc);

        $expedientes = busca_filtro_tabla("idexpediente", "expediente", "serie_idserie=$idserie", "", $conn);
        if($expedientes["numcampos"]) {
            for($i = 0; $i < $expedientes["numcampos"]; $i++) {
                $qry = "DELETE FROM entidad_expediente WHERE expediente_idexpediente = {$expedientes[$i]["idexpediente"]} AND entidad_identidad = $entidad_identidad AND llave_entidad = $llave_entidad";
                phpmkr_query($qry) or die($qry);
            }
        }

    }

    $retorno = array();
    $retorno['accion'] = $accion;
    $retorno['sqlc'] = $sqlc;
    echo (json_encode($retorno));
    // die();
}
?>