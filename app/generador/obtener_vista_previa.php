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
include_once $ruta_db_superior . "formatos/librerias/encabezado_pie_pagina.php";

$Response = (object) [
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['formatId']) {
        throw new Exception('Debe indicar el formato', 1);
    }

    $Formato = new Formato($_REQUEST['formatId']);

    if (!$Formato) {
        throw new Exception("Formato invalido", 1);
    }

    $header = $Formato->getHeader()->contenido ?? '';
    $body = $Formato->cuerpo ?? '';
    $footer = $Formato->getFooter()->contenido ?? '';

    $content = <<<HTML
        <div style='padding:20px;'>
            {$header}
        </div>
        <div style='padding:20px;'>
            {$body}
        </div>
        <div style='padding:20px;'>
            {$footer}
        </div>
HTML;

    $Response->data = $content;
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
