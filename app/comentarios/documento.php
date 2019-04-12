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
include_once $ruta_db_superior . 'pantallas/documento/librerias.php';

$Response = (object)array(
    'success' => 1,
    'message' => '',
    'data' => (object)array()
);

if($_SESSION['idfuncionario'] == $_REQUEST['key']){
    $comments = ComentarioDocumento::findAllByAttributes([
        'fk_documento' => $_REQUEST['relation']
    ]);

    $data = [];
    foreach ($comments as $key => $ComentarioDocumento) {
        $data[] = [
            'user' => [
                'key' => $ComentarioDocumento->getUser()->getPk(),
                'name' => $ComentarioDocumento->getUser()->getName(),
                'image' => $ComentarioDocumento->getUser()->getImage('foto_recorte')
            ],
            'comment' => $ComentarioDocumento->getComment(),
            'temporality' => $ComentarioDocumento->getDate('d-m-Y h:i a')
        ];
    }

    $Response->data = $data;
}else{
    $Response->success = 0;
    $Response->message = 'Debe iniciar Session';
}

echo json_encode($Response);