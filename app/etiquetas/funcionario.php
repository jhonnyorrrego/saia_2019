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
    'success' => 1,
    'message' => '',
    'data' => []
];

if($_SESSION['idfuncionario'] == $_REQUEST['key']){
    $tags = Etiqueta::findAllByAttributes([
        'estado' => 1,
        'fk_funcionario' => $_REQUEST['key'],
        'nucleo' => 0
    ]);

    if($_REQUEST['selections']){
        if($_REQUEST['dataBind'] == 'document'){
            foreach($tags as $key => $Etiqueta){
                $Response->data[] = [
                    'checkboxType' => EtiquetaDocumento::defineCheckboxType($Etiqueta->getPK(), $_REQUEST['selections']),
                    'idetiqueta' => $Etiqueta->getPK(),
                    'nombre' => $Etiqueta->nombre
                ];
            }
        }else if($_REQUEST['dataBind'] == 'task'){
            foreach($tags as $key => $Etiqueta){
                $Response->data[] = [
                    'checkboxType' => TareaEtiqueta::isActive($Etiqueta->getPK(), $_REQUEST['selections']),
                    'idetiqueta' => $Etiqueta->getPK(),
                    'nombre' => $Etiqueta->nombre
                ];
            }
        }
    }
}else{
    $Response->success = 0;
    $Response->message = 'Debe iniciar session';
}

echo json_encode($Response);