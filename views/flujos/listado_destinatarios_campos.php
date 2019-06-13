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
if(!empty($_REQUEST["idnotificacion"])) {
    $idnotificacion = $_REQUEST["idnotificacion"];

    $listado = busca_filtro_tabla("d.iddestinatario, cf.idcampos_formato fk_campo_formato, cf.etiqueta, cf.nombre",
            'wf_dest_notificacion d
            join wf_destinatario_formato df on d.iddestinatario = df.iddestinatario
            join wf_formato_flujo ff on df.fk_formato_flujo = df.idformato_flujo
            join campos_formato cf on df.fk_campo_formato = cf.idcampos_formato',
            "d.fk_notificacion = $idnotificacion", "", $conn);

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
