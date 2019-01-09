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

$Response = (object) array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    if($_REQUEST['selections']){
        $selections = explode(',', $_REQUEST['selections']);
        
        foreach($selections as $documentId){
            $PrioridadDocumento = PrioridadDocumento::findByAttributes([
                'fk_documento' => $documentId
            ]);

            if(!$PrioridadDocumento){
                $pk = PrioridadDocumento::newRecord([
                    'fk_documento' => $documentId,
                    'fk_funcionario' => $_REQUEST['key'],
                    'fecha' => date('Y-m-d H:i:s'),
                    'prioridad' => strval($_REQUEST['priority'])
                ]);
            }else{
                $PrioridadDocumento->setAttributes(array(
                    'fk_documento' => $documentId,
                    'fk_funcionario' => $_REQUEST['key'],
                    'fecha' => date('Y-m-d H:i:s'),
                    'prioridad' => strval($_REQUEST['priority'])
                ));
                $pk = $PrioridadDocumento->save();
            }

            if($pk){
                $Response->message = "Prioridad actualizada";
                $Response->success = 1; 
            }else{
                $Response->message = "Error al guardar";
                $Response->success = 0;
                break;
            }
        }
    }else{
        $Response->message = "invalid data";
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);