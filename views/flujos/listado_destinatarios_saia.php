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
if(!empty($_REQUEST["idnotificacion"])) {
    $idnotificacion = $_REQUEST["idnotificacion"];

    $listado = busca_filtro_tabla("d.iddestinatario, f.idfuncionario, f.login, f.nombres, f.apellidos, f.email", "wf_dest_notificacion d join wf_destinatario_saia ds on d.iddestinatario = ds.iddestinatario join funcionario f on ds.fk_funcionario = f.idfuncionario", "d.fk_notificacion = $idnotificacion", "", $conn);

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
