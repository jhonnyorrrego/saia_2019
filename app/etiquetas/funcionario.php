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
    'data' => (object)array()
);

if($_SESSION['idfuncionario'] == $_REQUEST['key']){
    $tags = Etiqueta::findActiveByUser($_REQUEST['key']);

    if($_REQUEST['selections']){
        foreach($tags as $key => $tag){
            $tags[$key]['checkboxType'] = EtiquetaDocumento::defineCheckboxType($tag['idetiqueta'], $_REQUEST['selections']);
        }
    }
    $Response->data = $tags;
}else{
    $Response->success = 0;
    $Response->message = 'Debe iniciar session';
}

echo json_encode($Response);