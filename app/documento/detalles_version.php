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

    if (!$_REQUEST['versionId']) {
        throw new Exception('Debe indicar la versión', 1);
    }

    $VersionDocumento = new VersionDocumento($_REQUEST['versionId']);

    if (!$VersionDocumento) {
        throw new Exception("Error Processing Request", 1);
    }

    $Response->data->pdf = $VersionDocumento->getPdf();
    $pages = $VersionDocumento->getPages();
    $attachments = $VersionDocumento->getAttachments();

    foreach ($pages as $VersionPagina) {
        $prefix = $VersionDocumento->documento_iddocumento . '-' . $VersionPagina->getPK();
        $json = $VersionPagina->ruta;
        $temporalRoute = TemporalController::createTemporalFile($json, $prefix);
        $Response->data->pages[] = [
            'id' => $VersionPagina->getPK(),
            'route' => $temporalRoute->route
        ];
    }

    foreach ($attachments as $VersionAnexos) {
        $prefix = $VersionDocumento->documento_iddocumento . '-' . $VersionAnexos->getPK();
        $json = $VersionAnexos->ruta;
        $temporalRoute = TemporalController::createTemporalFile($json, $prefix);
        $Response->data->pages[] = [
            'id' => $VersionAnexos->getPK(),
            'route' => $temporalRoute->route
        ];
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
