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

    $showParams = [
        'token' => $_REQUEST["token"],
        'key' => $_REQUEST["key"]
    ];
    $addParams = [
        'key' => $_REQUEST["key"],
        'token' => $_REQUEST["token"],
        'padre' => $_REQUEST['padre'] ?? null,
        'anterior' => $_REQUEST['anterior'] ?? null,
    ];

    if ($_REQUEST['documentId']) {
        $Documento = new Documento($_REQUEST['documentId']);
        $Formato = $Documento->getFormat();
        $showParams["iddoc"] = $_REQUEST['documentId'];
    } else if ($_REQUEST['formatId']) {
        $Formato = new Formato($_REQUEST['formatId']);
    }

    $addParams['idformato'] = $Formato->getPK();
    if ($addParams['anterior'] && !$addParams['padre']) {
        $Documento = new Documento($addParams['anterior']);
        $ft = $Documento->getFt();
        $addParams['padre'] = $ft["id" . $Documento->getFormat()->nombre_tabla];
    }

    $Response->data = [
        'ruta_mostrar' => "formatos/{$Formato->nombre}/{$Formato->ruta_mostrar}?" . http_build_query($showParams),
        'ruta_editar' => "formatos/{$Formato->nombre}/{$Formato->ruta_editar}",
        'ruta_adicionar' => "formatos/{$Formato->nombre}/{$Formato->ruta_adicionar}?" . http_build_query($addParams)
    ];

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
