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

require $ruta_db_superior . 'core/autoload.php';

$datos = [];
if(!empty($_REQUEST["idflujo"]) && !empty($_REQUEST["bpmn_id"])) {
    $idflujo = $_REQUEST["idflujo"];
    $idactividad = $_REQUEST["bpmn_id"];

    $listadoTareas = busca_filtro_tabla("g.*, e.nombre nombre_dst, e.bpmn_id bpmn_id_dst",
            "wf_enlace g join wf_elemento e on g.fk_elemento_destino = e.idelemento",
            "g.fk_flujo = $idflujo and g.bpmn_origen = '$idactividad'", "");

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
