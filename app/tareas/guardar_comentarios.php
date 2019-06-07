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

$Response = (object)array(
    'success' => 1,
    'message' => '',
    'data' => []
);

if($_SESSION['idfuncionario'] == $_REQUEST['key'] && $_REQUEST['relation']){
    $pk = TareaComentario::newRecord([
        'fk_funcionario' => $_REQUEST['key'],
        'fk_tarea' => $_REQUEST['relation'],
        'comentario' => $_REQUEST['comment']['comment'],
        'fecha' => date('Y-m-d H:i:s')
    ]);

    if(!$pk){
        $Response->message = 'Error al guardar';
        $Response->success = 0;
    }
}else{
    $Response->success = 0;
    $Response->message = 'Debe iniciar session';
}

echo json_encode($Response);