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
if(!empty($_REQUEST["idactividad"])) {
    $idactividad = $_REQUEST["idactividad"];

    $listadoTareas = busca_filtro_tabla("d.iddecision_actividad, d.fk_actividad, d.decision, td.tipo_decision",
            "wf_decision_actividad d join wf_tipo_decision_activ td on td.idtipo_decision_activ = d.fk_tipo_decision",
            "d.fk_actividad = $idactividad", "", $conn);

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
