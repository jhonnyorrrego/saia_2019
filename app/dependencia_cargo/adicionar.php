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

    $DependenciaCargo = new DependenciaCargo($_REQUEST['roleId']);
    $DependenciaCargo->setAttributes([
        'funcionario_idfuncionario' => $_REQUEST['userId'],
        'dependencia_iddependencia' => $_REQUEST['dependency'],
        'cargo_idcargo' => $_REQUEST['position'],
        'estado' => $_REQUEST['state'],
        'fecha_inicial' => (new DateTime($_REQUEST['initial_date']))->format('Y-m-d H:i:s'),
        'fecha_final' => (new DateTime($_REQUEST['final_date']))->format('Y-m-d H:i:s'),
        'tipo' => 1
    ]);

    if (!$_REQUEST['roleId']) { //adicionar
        $DependenciaCargo->fecha_ingreso = date('Y-m-d H:i:s');
    }

    if (!$DependenciaCargo->save()) {
        throw new Exception("Error al guardar", 1);
    }

    $Response->message = !$_REQUEST['roleId'] ? "Rol creado" : "Rol modificado";
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
