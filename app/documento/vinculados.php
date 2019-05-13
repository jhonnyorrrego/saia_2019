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

include_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object)[
    'rows' => [],
    'total' => ''
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['documentId']) {
        throw new Exception("Documento invalido", 1);
    }

    $linkedes = DocumentoVinculado::findRelations($_REQUEST['documentId']);

    foreach ($linkedes as $key => $DocumentoVinculado) {
        $Documento =
            $DocumentoVinculado->origen == $_REQUEST['documentId'] ?
            $DocumentoVinculado->getDestination() : $DocumentoVinculado->getOrigin();

        $Response->rows[] = [
            'id' => $Documento->getPk(),
            'numero' => $Documento->numero,
            'fecha' => $Documento->fecha,
            'asunto' => $Documento->descripcion,
            'responsable' => $Documento->getUser()->getName(),
            'tipo' => $Documento->getSerie()->nombre,
            'clase' => 'Asociado'
        ];
    }

    $Response->total = count($Response->rows);
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
