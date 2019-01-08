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
                'documento_iddocumento' => $id
            ]);

            if(!$PrioridadDocumento){
                $PrioridadDocumento = new PrioridadDocumento();
            }
            
            $PrioridadDocumento->setAttributes(array(
                'documento_iddocumento' => $documentId,
                'funcionario_idfuncionario' => usuario_actual('idfuncionario'),
                'prioridad' => strval($_REQUEST['priority'])
            ));

            if($PrioridadDocumento->save()){
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