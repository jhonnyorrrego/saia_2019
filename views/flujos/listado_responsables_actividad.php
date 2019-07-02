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

    $listadoCargos = busca_filtro_tabla("d.idresponsable_actividad, d.fk_responsable, d.tipo_responsable, 'Rol - Cargo' as texto_tipo, c.nombre", 
            "wf_responsable_actividad d join cargo c on d.fk_responsable = c.idcargo", 
            "d.tipo_responsable = 1 and d.fk_actividad = $idactividad", "", $conn);
    $listadoFuncionarios = busca_filtro_tabla("d.idresponsable_actividad, d.fk_responsable, d.tipo_responsable, 'Funcionario' as texto_tipo, concat(concat(f.nombres, ' '), f.apellidos) as nombre", 
            "wf_responsable_actividad d join funcionario f on d.fk_responsable = f.idfuncionario", 
            "d.tipo_responsable = 2 and d.fk_actividad = $idactividad", "", $conn);

    if($listadoCargos["numcampos"]) {
        $total = isset($listadoCargos['numcampos']) ? $listadoCargos['numcampos'] : count($listadoCargos);

        for($row = 0; $row < $total; $row++) {
            $fila = [];
            foreach($listadoCargos[$row] as $key => $value) {
                if(is_string($key)) {
                    $fila[$key] = $value;
                }
            }
            $datos[] = $fila;
        }
    }
    if($listadoFuncionarios["numcampos"]) {
        $total = isset($listadoFuncionarios['numcampos']) ? $listadoFuncionarios['numcampos'] : count($listadoFuncionarios);

        for($row = 0; $row < $total; $row++) {
            $fila = [];
            foreach($listadoFuncionarios[$row] as $key => $value) {
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
