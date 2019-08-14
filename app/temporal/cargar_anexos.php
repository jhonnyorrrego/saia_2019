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

    $dir = SessionController::getTemporalDir() . '/';

    if (!empty($_REQUEST['dir'])) {
        $dir .= 'anexos/' . $_REQUEST['dir'] . '/';
    }

    $relative = $ruta_db_superior . $dir;

    if (!is_dir($relative)) {
        mkdir($relative, PERMISOS_CARPETAS, true);
    } else {
        chmod($relative, PERMISOS_CARPETAS);
    }

    $temporalRoutes = [];
    foreach ($_FILES as $key => $file) {
        $content = file_get_contents($file['tmp_name']);
        if (file_put_contents($relative . $file['name'], $content) !== false) {
            $temporalRoutes[] = $dir . $file['name'];
        }
    }

    if (!count($temporalRoutes)) {
        throw new Exception("Imposible guardar", 1);
    }

    $Response->data = $temporalRoutes;
    $Response->message = 'Documentos almacenado en el temporal';
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
