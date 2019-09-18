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

    $listadoTareas = busca_filtro_tabla("r.idriesgo, r.fk_actividad, r.riesgo, r.descripcion, ir.impacto, pr.probabilidad",
            "wf_riesgo_actividad r join wf_tipo_prob_riesgo pr on pr.idtipo_probabilidad = r.fk_probabilidad
             join wf_tipo_impacto_riesgo ir on ir.idtipo_impacto = r.fk_impacto",
            "r.fk_actividad = $idactividad", "");

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
