<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'db.php';
global $conn; 

$Response = (object) array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 1,
);

$configurations = busca_filtro_tabla('*', 'configuracion', "nombre='color_institucional'", '', $conn);

if($configurations['numcampos']){
    unset($configurations['sql'],$configurations['numcampos'],$configurations['tabla']);
    $Response->data = $configurations;
}else{
    $Response->success = 0;
    $Response->message = "Error!";
}

echo json_encode($Response);
