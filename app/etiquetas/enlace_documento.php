<?php

use Symfony\Component\DependencyInjection\Tests\Compiler\E;
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
    if(!$_REQUEST['selections']){
        $Response->success = 0;
        $Response->message = "Debe seleccionar documentos";
    }else{
        $selections = explode(',', $_REQUEST['selections']);

        foreach ($_REQUEST['tags'] as $tagId => $value){
            foreach ($selections as $documentId){
                EtiquetaDocumento::executeDelete([
                    'fk_etiqueta' => $tagId,
                    'fk_documento' => $documentId
                ]);

                if($value == 1){
                    EtiquetaDocumento::newRecord([
                        'fk_documento' => $documentId,
                        'fk_etiqueta' => $tagId
                    ]);
                }
            }
        }
    }
}else{
    $Response->success = 0;
    $Response->message = 'Debe iniciar session';
}

echo json_encode($Response);