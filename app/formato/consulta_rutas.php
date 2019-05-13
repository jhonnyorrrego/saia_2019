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

    if (!$_REQUEST['documentId']) {
        throw new Exception('Documento invalido', 1);
    }

    $Documento = new Documento($_REQUEST['documentId']);
    $Formato = $Documento->getFormat();
    $template = strtolower($Documento->plantilla);
    $queryParams = http_build_query([
        "iddoc" => $_REQUEST['documentId'],
        "key" => $_REQUEST["key"],
        "token" => $_REQUEST["token"]
    ]);

    $Response->data = [
        'ruta_mostrar' => "formatos/{$template}/{$Formato->ruta_mostrar}?" . $queryParams,
        'ruta_editar' => "formatos/{$template}/{$Formato->ruta_editar}",
        'ruta_adicionar' => "formatos/{$template}/{$Formato->ruta_adicionar}"
    ];

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
