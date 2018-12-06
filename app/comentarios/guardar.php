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

$Response = (object)array(
    'success' => 1,
    'message' => '',
    'data' => (object)array()
);

if($_SESSION['idfuncionario'] == $_REQUEST['user']['key']){
    $ComentarioDocumento = new ComentarioDocumento();
    $ComentarioDocumento->setAttributes([
        'fk_funcionario' => $_REQUEST['user']['key'],
        'fk_documento' => $_REQUEST['documentId'],
        'comentario' => $_REQUEST['comment'],
        'fecha' => date('Y-m-d H:i:s')
    ]);
    
    if(!$ComentarioDocumento->save()){
        $Response->success = 0;
        $Response->message = "Error al guardar";
    }
}else{
    $Response->success = 0;
    $Response->message = 'Debe iniciar session';
}

echo json_encode($Response);