<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object)[
    'rows' => [],
    'total' => ''
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if(!$_REQUEST['documentId']){
        throw new Exception("Documento invalido", 1);
    }

    $documentId = $_REQUEST['documentId'];
    $responses = Respuesta::findAllByAttributes([
        'destino' => $documentId
    ]);    

    foreach ($responses as $key => $Respuesta) {
        $Documento = $Respuesta->getOrigin();
        $Response->rows [] = [
            'id' => $Documento->getPK(),
            'numero' => $Documento->numero,
            'fecha' => $Documento->fecha,
            'asunto' => $Documento->descripcion,
            'responsable' => $Documento->getUser()->getName(),
            'tipo' => $Documento->getSerie()->nombre,
            'clase' => 'Origen'
        ];
    }

    $procedures = Respuesta::findAllByAttributes([
        'origen' => $documentId
    ]);

    foreach ($procedures as $key => $Respuesta) {
        $Documento = $Respuesta->getDestination();
        $Response->rows [] = [
            'numero' => $Documento->numero,
            'fecha' => $Documento->fecha,
            'asunto' => $Documento->descripcion,
            'responsable' => $Documento->getUser()->getName(),
            'tipo' => $Documento->getSerie()->nombre,
            'clase' => 'Trámite'
        ];
    }
    
    $Response->total = count($Response->rows);
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
