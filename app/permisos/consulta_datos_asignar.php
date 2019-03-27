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
    'data' => new stdClass(),
    'message' => "",
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    eval('$type = Acceso::' . $_REQUEST['type'] . ';');

    $Acceso = Acceso::findAllByAttributes([
        'accion' => Acceso::ACCION_VER_PUBLICO,
        'estado' => 1,
        'tipo_relacion' => $type,
        'id_relacion' => $_REQUEST['typeId']
    ]);

    if ($Acceso) { //publico
        $Response->data->type = 'public';
    } else {
        $records = Acceso::countRecords([
            'accion' => Acceso::ACCION_VER,
            'estado' => 1,
            'tipo_relacion' => $type,
            'id_relacion' => $_REQUEST['typeId']
        ]);

        if ($records == 1) { //privado
            $Response->data->type = 'private';
        } else {  //usuario especifico
            $Response->data->type = 'specific';
        }
    }

    $data = Acceso::findAllByAttributes([
        'estado' => 1,
        'tipo_relacion' => $type,
        'id_relacion' => $_REQUEST['typeId']
    ]);

    $Response->data->users = [];
    foreach ($data as $key => $Acceso) {
        if($Acceso->fk_funcionario != Funcionario::RADICADOR_SALIDA &&
            $Acceso->accion > $Response->data->users[$Acceso->fk_funcionario]['action']){

            $Response->data->users[$Acceso->fk_funcionario] = [
                'id' => $Acceso->getPK(),
                'userId' => $Acceso->fk_funcionario,
                'name' => $Acceso->getUser()->getName(),
                'action' => $Acceso->accion
            ];
        }
    }

    $Response->success = 1;
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);
