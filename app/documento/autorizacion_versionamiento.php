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

    $access = false;
    $userId = $_REQUEST['userId'];
    $documentId = $_REQUEST['documentId'];
    $Documento = new Documento($documentId);

    $access = Acceso::isManager(
        Acceso::TIPO_DOCUMENTO,
        $documentId,
        $userId
    );

    if (!$access) {
        if ((!$Documento->numero) || ($Documento->numero && $Documento->version > 1)) {
            $ActiveRoute = Ruta::getStepFromDocumet($documentId);
            $routes = Ruta::findActiveRoute($documentId);

            foreach ($routes as $key => $Ruta) {
                if ($userId == $Ruta->getOrigin()->getPK()) {
                    $access = true;
                    break;
                }

                if ($Ruta->getPK() == $ActiveRoute->getPK()) {
                    break;
                }
            }
        } else if ($Documento->numero && $Documento->version == 1) {
            $routes = Ruta::findLastFinishedRoute($documentId);

            foreach ($routes as $key => $Ruta) {
                if ($userId == $Ruta->getOrigin()->getPK()) {
                    $access = true;
                    break;
                }
            }
        }
    }

    if (!$access) {
        $Response->message = "Necesitas permiso para realizar esta acción.<br>
            Para más información puedes consultar al responsable de documento.";
    }

    $Response->success = $access;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
