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

include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object)[
    'data' => [],
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['login']) {
        throw new Exception("Debe indicar el usuario", 1);
    }

    $date = StaticSql::setDateFormat(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
    $sql = <<<SQL
        UPDATE log_acceso
        SET fecha_cierre = {$date}
        WHERE
            login = '{$_REQUEST["login"]}' AND
            fecha_cierre IS NULL
SQL;

    if (!StaticSql::query($sql)) {
        throw new Exception("Error al eliminar", 1);
    }

    $Response->success = 1;
    $Response->message = 'Sesión eliminada';
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
