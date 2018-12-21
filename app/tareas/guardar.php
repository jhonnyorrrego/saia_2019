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
    if($_REQUEST['task']){
        $Tarea = new Tarea($_REQUEST['task']);
    }else{
        $Tarea = new Tarea();
    }

    $Tarea->setAttributes([
        'nombre' => $_REQUEST['name'],
        'fecha_inicial' => $_REQUEST['initialDate'],
        'fecha_final' => $_REQUEST['finalDate'],
        'prioridad' => $_REQUEST['priority'],
        'descripcion' => $_REQUEST['description']
    ]);
    
    if($Tarea->save()){
        if(isset($_REQUEST['managers'])){
            $maker = [$_REQUEST['key']];
            FuncionarioTarea::assignUser($Tarea->getPk(), $maker, 3);

            $managers = count($_REQUEST['managers']) ? $_REQUEST['managers'] : $maker;
            FuncionarioTarea::inactiveRelationsByTask($Tarea->getPK(), 1);
            FuncionarioTarea::assignUser($Tarea->getPk(), $_REQUEST['managers'], 1);
        }

        if(count($_REQUEST['followers'])){
            FuncionarioTarea::inactiveRelationsByTask($Tarea->getPK(), 2);
            FuncionarioTarea::assignUser($Tarea->getPk(), $_REQUEST['followers'], 2);
        }

        if(count($_REQUEST['files'])){
            AnexoTarea::uploadTemporalFiles($_REQUEST['files'], $Tarea->getPK());
        }

        $Response->message = "Datos almacenados";
    }else{
        $Response->message = "Error al guardar";
        $Response->success = 0;
    }
} else {
    $Response->message = "Debe iniciar sesion";
    $Response->success = 0;
}

echo json_encode($Response);