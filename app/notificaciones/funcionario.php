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

$Response = (object)[
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['userId']) {
        throw new Exception('Debe indicar un usuario', 1);
    }

    $limit = $_REQUEST['offset'] + $_REQUEST['more'];

    $notifications = Notificacion::findAllByAttributes([
        'destino' => $_REQUEST['userId'],
    ], null, 'fecha desc', $_REQUEST['offset'], $limit);

    $data = [];
    foreach ($notifications as $key => $Notificacion) {
        $id = $Notificacion->getPK();
        $ids[] = $id;

        $data[] = $Notificacion->getAttributes() + ['id' => $id];
    }

    $ids = implode(',', $ids);
    $sql = <<<SQL
        UPDATE notificacion
        SET notificado = 1
        WHERE idnotificacion in ({$ids})
SQL;
    Notificacion::query($sql);

    $Response->data = $data;
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
