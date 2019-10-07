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
    'data' => [],
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    $users = [];

    if (isset($_REQUEST['term'])) {
        $users = Tercero::findAllByTerm($_REQUEST['term']);
    } else if (!empty($_REQUEST['defaultUser'])) {
        $users[] = new Tercero($_REQUEST['defaultUser']);
    }

    if ($users) {
        $data = [];

        foreach ($users as $Tercero) {
            $label = sprintf(
                "%s - %s",
                $Tercero->identificacion,
                $Tercero->nombre,
            );
            $data[] = [
                'id' => $Tercero->getPK(),
                'text' => $label
            ];
        }

        $Response->data = $data ? $data : null;
        $Response->success = 1;
    } else {
        $Response->message = "No se encontraron registros";
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
