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

include_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object)[
    'data' => [],
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['module']) {
        throw new Exception("Debe indicar el modulo", 1);
    }

    if (!$_REQUEST['profile']) {
        throw new Exception("Debe indicar el perfil", 1);
    }
    //elimino la relacion anterior para evitar consultar la existencia
    $delete = PermisoPerfil::executeDelete([
        'modulo_idmodulo' => $_REQUEST['module'],
        'perfil_idperfil' => $_REQUEST['profile']
    ]);

    if ($_REQUEST['add']) {
        $pk = PermisoPerfil::newRecord([
            'modulo_idmodulo' => $_REQUEST['module'],
            'perfil_idperfil' => $_REQUEST['profile']
        ]);

        if (!$pk) {
            throw new Exception("Error al guardar", 1);
        }

        $Response->message = "Permiso asignado";
    } else if (!$delete) {
        throw new Exception("Error al eliminar", 1);
    } else {
        $Response->message = "Permiso eliminado";
    }

    $Response->success = 1;
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
