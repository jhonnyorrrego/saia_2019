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

$Response = (object)array(
    'success' => 1,
    'message' => '',
    'data' => (object)array()
);

if($_SESSION['idfuncionario'] == $_REQUEST['key']){
    $pk = $ComentarioDocumento = ComentarioDocumento::newRecord([
        'fk_funcionario' => $_REQUEST['key'],
        'fk_documento' => $_REQUEST['relation'],
        'comentario' => $_REQUEST['comment']['comment'],
        'fecha' => date('Y-m-d H:i:s')
    ]);

    if(!$pk){
        $Response->success = 0;
        $Response->message = "Error al guardar";
    }
}else{
    $Response->success = 0;
    $Response->message = 'Debe iniciar session';
}

echo json_encode($Response);