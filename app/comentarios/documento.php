<?php
session_start();

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
include_once $ruta_db_superior . 'pantallas/documento/librerias.php';

$Response = (object)array(
    'success' => 1,
    'message' => '',
    'data' => (object)array()
);

if($_SESSION['idfuncionario'] == $_REQUEST['key']){
    $documentId = $_REQUEST['documentId'];
    $comments = ComentarioDocumento::findAllByAttributes([
        'fk_documento' => $documentId
    ]);

    $data = [];
    foreach ($comments as $key => $ComentarioDocumento) {
        $Funcionario = new Funcionario($ComentarioDocumento->fk_funcionario);
        $DateTime = DateTime::createFromFormat('Y-m-d H:i:s', $ComentarioDocumento->fecha);

        $data[] = [
            'user' => [
                'key' => $Funcionario->getPk(),
                'name' => $Funcionario->getName(),
                'image' => $Funcionario->getImage('foto_recorte')
            ],
            'comment' => $ComentarioDocumento->comentario,
            'temporality' => $DateTime->format('h:i a')
        ];
    }

    $Response->data = $data;
}else{
    $Response->success = 0;
    $Response->message = 'Debe iniciar Session';
}

echo json_encode($Response);