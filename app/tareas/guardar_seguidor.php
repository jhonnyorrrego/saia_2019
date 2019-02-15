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
    'success' => 1,
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $data = [
        'fk_tarea' => $_REQUEST['taskId'],
        'fk_funcionario' => $_REQUEST['user'],
        'tipo' => 2
    ];
    $TareaFuncionario = TareaFuncionario::findByAttributes($data);
    
    if($_REQUEST['remove'] && $_REQUEST['remove'] && $TareaFuncionario){
        if($TareaFuncionario->toggleRelation(0)){
            $Response->message = 'Usuario Eliminado';
            $Response->data = $TareaFuncionario->getPK();
        }else{
            $Response->message = "Error al guardar";
            $Response->success = 0;
        }
    }else{
        if($TareaFuncionario){
            $pk = $TareaFuncionario->toggleRelation(1);
        }else{
            $pk = TareaFuncionario::newRecord($data);
        }

        if($pk){
            $Response->message = 'Usuario asignado';
        }else{
            $Response->message = 'Error al guardar';
            $Response->success = 0;
        }
    }
} else {
    $Response->message = "Debe iniciar sesion";
    $Response->success = 0;
}

echo json_encode($Response);