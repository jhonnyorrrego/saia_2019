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

    if (!$_REQUEST['documentId']) {
        throw new Exception('Documento invalido', 1);
    }

    $records = VersionDocumento::findAllByAttributes([
        'documento_iddocumento' => $_REQUEST['documentId']
    ], [], 'idversion_documento desc');

    foreach ($records as $key => $VersionDocumento) {
        $date = DateController::convertDate($VersionDocumento->fecha);
        $Funcionario = $VersionDocumento->getUser();
        $label = "Versión {$VersionDocumento->version} : $date <br> {$Funcionario->getName()}";
        $Response->data[] = [
            'label' => $label,
            'version' => $VersionDocumento->version,
            'id' => $VersionDocumento->getPK()
        ];
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
