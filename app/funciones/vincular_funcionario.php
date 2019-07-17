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

    if (!$_REQUEST['userId']) {
        throw new Exception('Debe indicar el usuario', 1);
    }

    if (!$_REQUEST['functions']) {
        throw new Exception('Debe indicar las funciones', 1);
    }

    foreach ($_REQUEST['functions'] as $key => $functionId) {
        $FuncionarioFuncion = FuncionarioFuncion::findByAttributes([
            'fk_funcionario' => $_REQUEST['userId'],
            'fk_funcion' => $functionId,
            'fk_cargo' => null
        ]);

        if ($FuncionarioFuncion) {
            $FuncionarioFuncion->estado = 1;
            $pk = $FuncionarioFuncion->save();
        } else {
            $pk = FuncionarioFuncion::newRecord([
                'fk_funcionario' => $_REQUEST['userId'],
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
