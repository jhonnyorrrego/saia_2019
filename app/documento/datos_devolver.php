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

    $documentId = $_REQUEST['documentId'];
    $Documento = new Documento($documentId);

    $ActiveRoute = Ruta::getStepFromDocumet($documentId);
    $Funcionario = $ActiveRoute->getOrigin();

    if ($Funcionario->getPK() != $_REQUEST['key']) {
        throw new Exception("El puedes devolver este documento", 1);
    }

    $routes = Ruta::findActiveRoute($documentId);
    foreach ($routes as $key => $Ruta) {
        if ($routes[$key + 1]->getPK() == $ActiveRoute->getPK()) {
            $PreviousRoute = $Ruta;
            break;
        }

        if ($key == 0 && $Ruta->getPK() == $ActiveRoute->getPK()) {
            throw new Exception("El creador no puede devolver el documento", 1);
        }
    }

    if (!$PreviousRoute) {
        throw new Exception("No es posible encontrar el destino", 1);
    }

    $Response->data = (object)[
        'userId' => $PreviousRoute->getOrigin()->getPk(),
        'username' => $PreviousRoute->getOrigin()->getName(),
        'number' => $Documento->numero,
        'description' => $Documento->getDescription(),
        'date' => date('Y-m-d H:i:s')
    ];
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
