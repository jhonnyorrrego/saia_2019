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

use \Doctrine\DBAL\Types\Type;

$Response = (object) [
    'data' => [],
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$table = $_REQUEST['tableName']) {
        throw new Exception("Error Processing Request", 1);
    }

    if (!$tipo = $_REQUEST['type']) {
        throw new Exception("Error Processing Request", 1);
    }

    if ($tipo == 1) {
        $Response->data = HelperSerie::getAllSerie($table);
    } else {
        /* SE DEBE PERMITIR LISTAR TODAS LAS RELACIONES SIN IMPORTAR EL ESTADO
        DE LA LLAVE (serie_dependencia) */
        $Response->data = HelperSerie::getAllSerieDependencia($table, $_REQUEST['idserie']);
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
