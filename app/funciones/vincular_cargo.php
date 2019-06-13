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

$Response = (object)[
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['position']) {
        throw new Exception('Debe indicar el cargo', 1);
    }

    if (!$_REQUEST['functions']) {
        throw new Exception('Debe indicar las funciones', 1);
    }

    foreach ($_REQUEST['functions'] as $key => $functionId) {
        $CargoFuncion = CargoFuncion::findByAttributes([
            'fk_cargo' => $_REQUEST['position'],
            'fk_funcion' => $functionId
        ]);

        if ($CargoFuncion) {
            $CargoFuncion->estado = 1;
            $pk = $CargoFuncion->save();
        } else {
            $pk = CargoFuncion::newRecord([
                'fk_cargo' => $_REQUEST['position'],
                'fk_funcion' => $functionId,
                'estado' => 1,
                'fecha' => date('Y-m-d H:i:s')
            ]);
        }

        if (!$pk) {
            throw new Exception("Error al guardar", 1);
        }
    }

    $Response->message = "Funciones vinculadas";
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
