<?php
$max_salida = 10;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
    if(is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
        // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}

error_reporting(E_ALL | E_STRICT);

require $ruta_db_superior . 'controllers/autoload.php';

$datos = [];
if(!empty($_REQUEST["idactividad"]) && !empty($_REQUEST["tipo"])) {
    $actividad = $_REQUEST["idactividad"];
    $tipo = $_REQUEST["tipo"];

    $datos = ReqCalidadActiv::findByTipo($actividad, $tipo, true);
}

$resp = [
    "rows" => $datos,
    "total" => count($datos)
];

echo json_encode($resp);
