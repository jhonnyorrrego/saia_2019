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
    //JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['documentId']) {
        throw new Exception('Documento invalido', 1);
    }

    $records = DocumentoRastro::findAllByAttributes([
        'fk_documento' => $_REQUEST['documentId']
    ], [], 'fecha desc');

    $data = [];
    foreach ($records as $DocumentoRastro) {
        $Funcionario = $DocumentoRastro->getUser();
        $data[] =  [
            'id' => $DocumentoRastro->getPK(),
            'imgRoute' => $Funcionario->getImage('foto_recorte'),
            'userName' => $Funcionario->getName(),
            'title' => $DocumentoRastro->titulo,
            'content' => $DocumentoRastro->descripcion,
            'date' => DateController::convertDate($DocumentoRastro->fecha),
            'icon' => $DocumentoRastro->getIcon(),
            'url' => $DocumentoRastro->getModalRoute()
        ];
    }

    $Response->data = $data;
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
