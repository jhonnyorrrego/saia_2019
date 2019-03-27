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
    $condition = [
        'tipo_relacion' => $type,
        'id_relacion' => $_REQUEST['typeId']
    ];
    $GLOBALS['condition'] = $condition;

    //consulto el responsable
    $Acceso = Acceso::findByAttributes([
        'accion' => Acceso::ACCION_ELIMINAR,
        'estado' => 1
    ] + $condition);
    if ($_REQUEST['accion']) {

        foreach ($_REQUEST['users'] as $key => $userId) {
            //el responsable solo se puede modificar por el responsable
            if ($userId == $Acceso->fk_funcionario && $_REQUEST['key'] != $Acceso->fk_funcionario) {
                $Response->message = 'No puedes modificar los permisos del responsable';
                continue;
            }

            //inactivo todos los permisos del funcionario
            Acceso::executeUpdate(['estado' => 0], [
                'fk_funcionario' => $userId
            ] + $condition);

            //asigno nuevos permisos segun la accion indicada
            switch ($_REQUEST['accion']) {
                case 'delete':
                    $output = true;
                    break;
                case 'see':
                    $output = newAction(Acceso::ACCION_VER, $userId);
                    break;
                case 'edit':
                    $output = newAction(Acceso::ACCION_VER, $userId) &&
                        newAction(Acceso::ACCION_EDITAR, $userId);
                    break;
                case 'manager':
                    //inactivo el responsable anterior
                    $Acceso->estado = 0;
                    $Acceso->save();

                    $output = newAction(Acceso::ACCION_VER, $userId) &&
                        newAction(Acceso::ACCION_EDITAR, $userId) &&
                        newAction(Acceso::ACCION_ELIMINAR, $userId);
                    break;
            }
        }
    } else if ($_REQUEST['private']) {
        switch ($_REQUEST['private']) {

            case 'public':
                $output = Acceso::executeUpdate(['estado' => 1], [
                    'accion' => Acceso::ACCION_VER_PUBLICO
                ] + $condition);
                break;
            case 'specific':
                $output = Acceso::executeUpdate(['estado' => 0], [
                    'accion' => Acceso::ACCION_VER_PUBLICO
                ] + $condition);
                break;

            case 'private':
                if ($Acceso->fk_funcionario == $_REQUEST['key']) {
                    $output = Acceso::executeUpdate(['estado' => 0], $condition);

                    if ($output) {
                        $output = Acceso::executeUpdate(['estado' => 1], [
                            'fk_funcionario' => $_REQUEST['key']
                        ] + $condition);
                    }
                } else {
                    $Response->message = 'Solo el responsable puede cambiar a esta privacidad';
                }
                break;
        }
    }

    if ($output) {
        $Response->message = 'Privacidad actualizada';
        $Response->success = 1;
    } else {
        if (!$Response->message) {
            $Response->message = 'Error al modificar la privacidad';
        }
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);

function newAction($action, $userId)
{
    global $condition;

    return Acceso::newRecord([
        'accion' => $action,
        'fk_funcionario' => $userId,
        'fecha' => date('Y-m-d H:i:s')
    ] + $condition);
}
