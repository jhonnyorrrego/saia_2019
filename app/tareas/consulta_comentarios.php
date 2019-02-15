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

$Response = (object)array(
    'success' => 1,
    'message' => '',
    'data' => []
);

if($_SESSION['idfuncionario'] == $_REQUEST['key'] && $_REQUEST['relation']){
    $comments = TareaComentario::findAllByAttributes([
        'fk_tarea' => $_REQUEST['relation']
    ]);

    $data = [];
    foreach ($comments as $key => $TareaComentario) {
        $data[] = [
            'user' => [
                'key' => $TareaComentario->getUser()->getPk(),
                'name' => $TareaComentario->getUser()->getName(),
                'image' => $TareaComentario->getUser()->getImage('foto_recorte')
            ],
            'comment' => $TareaComentario->getComment(),
            'temporality' => $TareaComentario->getDate('d-m-Y h:i a')
        ];
    }

    $Response->data = $data;
}else{
    $Response->success = 0;
    $Response->message = 'Debe iniciar Session';
}

echo json_encode($Response);