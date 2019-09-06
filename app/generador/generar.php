<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
        break;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object) [
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['formatId']) {
        throw new Exception('Debe indicar el formato', 1);
    }

    $formatId = $_REQUEST['formatId'];
    $GenerarFormatoController = new GenerarFormatoController($formatId);
    $GenerarFormatoController->generate();

    //validar campo descripcion obligatorio
    //crear tabla e indices id , ft, documento 
    //crear archivo adicionar
    //crear archivo editar
    //crear archivo mostrar
    //crear cuerpo del formato en caso de no existir



    $Response->message = "Formato generado";
    $Response->success = 1;
} catch (Throwable $th) {
    echo '<pre>';
    var_dump($th);
    echo '</pre>';
    exit;
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
