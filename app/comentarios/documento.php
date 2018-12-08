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

include_once $ruta_db_superior . 'models/comentarioDocumento.php';
include_once $ruta_db_superior . 'models/funcionario.php';
include_once $ruta_db_superior . 'pantallas/documento/librerias.php';

$Response = (object)array(
    'success' => 1,
    'message' => '',
    'data' => (object)array()
);

if($_SESSION['idfuncionario'] == $_REQUEST['key']){
    $documentId = $_REQUEST['documentId'];
    $comments = ComentarioDocumento::findByDocument($documentId);

    $data = [];
    for($i = 0, $total = count($comments); $i < $total; $i++){
        $Funcionario = new Funcionario($comments[$i]['fk_funcionario']);
        $data[] = [
            'user' => [
                'key' => $Funcionario->getPk(),
                'name' => $Funcionario->getName(),
                'image' => $Funcionario->getImage('foto_recorte')
            ],
            'comment' => $comments[$i]['comentario'],
            'temporality' => temporality($comments[$i]['fecha'])
        ];
    }

    $Response->data = $data;
}else{
    $Response->success = 0;
    $Response->message = 'Debe iniciar Session';
}

echo json_encode($Response);