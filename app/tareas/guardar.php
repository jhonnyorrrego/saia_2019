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
    $Tarea = new Tarea();
    $Tarea->setAttributes([
        'nombre' => $_REQUEST['name'],
        'fecha_inicial' => $_REQUEST['initialDate'],
        'fecha_final' => $_REQUEST['finalDate'],
        'prioridad' => $_REQUEST['priority'],
        'descripcion' => $_REQUEST['description']
    ]);
    if($Tarea->save()){
        if(!count($_REQUEST['managers'])){
            FuncionarioTarea::assignUser($Tarea->getPk(), [$_REQUEST['key']], 1);
        }else{
            FuncionarioTarea::assignUser($Tarea->getPk(), $_REQUEST['managers'], 1);
        }

        if(count($_REQUEST['followers'])){
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
    $Response->message = "Debe iniciar sesión";
}

echo json_encode($Response);