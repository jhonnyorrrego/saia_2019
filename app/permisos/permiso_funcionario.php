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

$Response = (object)array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $see = $edit = $delete = false;
    eval('$type = Acceso::' . $_REQUEST['sourceReference'] . ';');

    $permissions = Acceso::findAllByAttributes([
        'tipo_relacion' => $type,
        'id_relacion' => $_REQUEST['typeId'],
        'fk_funcionario' => $_REQUEST['key'],
        'estado' => 1
    ]);

    foreach ($permissions as $key => $Acceso) {
        switch ($Acceso->accion) {
            case Acceso::ACCION_VER:
                $see = true;
                break;
            case Acceso::ACCION_EDITAR:
                $edit = true;
                break;
            case Acceso::ACCION_ELIMINAR:
                $delete = true;
                break;
        }
    }

    if (!$see) {
        $publicSee = Acceso::countRecords([
            'tipo_relacion' => $type,
            'id_relacion' => $_REQUEST['typeId'],
            'accion' => Acceso::ACCION_VER_PUBLICO,
            'estado' => 1
        ]);

        $see = $publicSee > 0;
    }

    $Response->data->see = $see;
    $Response->data->edit = $edit;
    $Response->data->delete = $delete;

    $Response->success = 1;
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);
