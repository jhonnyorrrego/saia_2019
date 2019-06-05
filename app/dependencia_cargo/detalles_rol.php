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

include_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object) [
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['roleId']) {
        throw new Exception('Debe indicar el rol', 1);
    }

    $DependenciaCargo = new DependenciaCargo($_REQUEST['roleId']);

    if(!$DependenciaCargo){
        throw new Exception("Rol indefinido", 1);
    }

    $Response->data = (object)[
        'dependency' => $DependenciaCargo->dependencia_iddependencia,
        'position' => $DependenciaCargo->cargo_idcargo,
        'initialDate' => $DependenciaCargo->fecha_inicial,
        'finalDate' => $DependenciaCargo->fecha_final,
        'state' => $DependenciaCargo->estado
    ];
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);