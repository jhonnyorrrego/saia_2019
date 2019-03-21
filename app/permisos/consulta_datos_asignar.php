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
        $Response->data->type = 1;
    } else {
        $records = Acceso::findColumn('fk_funcionario', [
            'accion' => Acceso::ACCION_VER,
            'estado' => 1,
            'tipo_relacion' => $type,
            'id_relacion' => $_REQUEST['typeId']
        ]);

        if (count($records) > 1) { //usuario especifico
            $Response->data->type = 3;
            $Response->data->users = $records;

            $total = Acceso::countRecords([
                'accion' => Acceso::ACCION_EDITAR,
                'estado' => 1,
                'tipo_relacion' => $type,
                'id_relacion' => $_REQUEST['typeId'],
            ]);
            $Response->data->edit = $total > 1;
        } else { //privado
            $Response->data->type = 2;
        }
    }

    $Response->success = 1;
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);
