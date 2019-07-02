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

    $listado = busca_filtro_tabla("fa.idfuncionario_actividad, fa.fk_funcionario, f.login, f.nombres, f.apellidos, f.email",
        "wf_funcionario_actividad fa join funcionario f on fa.fk_funcionario = f.idfuncionario", "fa.fk_actividad = $idactividad", "", $conn);

    if($listado["numcampos"]) {
        $total = isset($listado['numcampos']) ? $listado['numcampos'] : count($listado);

        for($row = 0; $row < $total; $row++) {
            $fila = [];
            foreach($listado[$row] as $key => $value) {
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
