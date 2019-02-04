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
if(!empty($_REQUEST["idactividad"])) {
    $idactividad = $_REQUEST["idactividad"];

    $listadoTareas = busca_filtro_tabla("t.idtarea_actividad, t.fk_actividad, t.nombre",
            "wf_tarea_actividad t",
            "t.fk_actividad = $idactividad", "", $conn);

    if($listadoTareas["numcampos"]) {
        $total = isset($listadoTareas['numcampos']) ? $listadoTareas['numcampos'] : count($listadoTareas);

        for($row = 0; $row < $total; $row++) {
            $fila = [];
            foreach($listadoTareas[$row] as $key => $value) {
                if(is_string($key)) {
                    $fila[$key] = $value;
                }
            }
            $datos[] = $fila;
        }
    }
}

$resp = [
    "rows" => $datos,
    "total" => count($datos)
];

echo json_encode($resp);
