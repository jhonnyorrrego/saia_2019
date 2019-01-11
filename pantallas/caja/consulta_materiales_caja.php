<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) { $ruta_db_superior = $ruta;
    } $ruta .= "../";
    $max_salida--;
}
include_once ($ruta_db_superior . "db.php");

$materiales = busca_filtro_tabla("nombre,valor", "cf_material", "estado =1", "", $conn);
unset($materiales["tabla"], $materiales["sql"], $materiales["numcampos"]);

echo json_encode($materiales);
?>