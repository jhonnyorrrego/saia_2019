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
include_once $ruta_db_superior . "core/autoload.php";

//POR EL MOMENTO NO SE USA ESTE SCRIPT=> BORRAR
$arbol = new ArbolTrdController(1);
$objetoJson = $arbol->getObjetoJson();

header('Content-Type: application/json');
echo json_encode($objetoJson);
