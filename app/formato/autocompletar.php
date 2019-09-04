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

    if (!isset($_REQUEST['term'])) {
        throw new Exception("Debe indicar un criterio de búsqueda", 1);
    }

    $formats = Formato::findAllByTerm($_REQUEST['term']);

    if ($formats) {
        $data = [];

        foreach ($formats as $Formato) {
            $parentName = $Formato->findFirstParent()->etiqueta;
            $data[] = [
                'id' => $Formato->getPK(),
                'text' => html_entity_decode("{$Formato->etiqueta} ({$parentName})"),
                'name' => strtoupper($Formato->nombre)
            ];
        }

        $Response->data = $data;
        $Response->success = 1;
    } else {
        $Response->message = "No se encontraron registros";
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
