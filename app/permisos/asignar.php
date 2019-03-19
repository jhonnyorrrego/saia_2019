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

    //consulto el propietario
    $Acceso = Acceso::findByAttributes([
        'accion' => Acceso::ACCION_ELIMINAR
    ] + $condition, ['fk_funcionario']);

    switch ($_REQUEST['private']) {
        case 1: //public
            $output = Acceso::executeUpdate(['estado' => 1], [
                'accion' => Acceso::ACCION_VER_PUBLICO
            ] + $condition);
            break;
        case 2: //privado
            if ($Acceso->fk_funcionario == $_SESSION['idfuncionario']) {
                $output = Acceso::executeUpdate(['estado' => 0], $condition);

                if ($output) {
                    $output = Acceso::executeUpdate(['estado' => 1], [
                        'fk_funcionario' => $_SESSION['idfuncionario']
                    ] + $condition);
                }
            } else {
                $Response->message = 'Solo el propietario puede cambiar a esta privacidad';
            }
            break;
        case 3: //usuario especifico
            $output = Acceso::executeUpdate(['estado' => 0], $condition);
            $users = explode(',', $_REQUEST['user']);

            foreach ($users as $key => $userId) {
                if ($Acceso->fk_funcionario != $userId) {
                    Acceso::newRecord([
                        'accion' => Acceso::ACCION_VER,
                        'fk_funcionario' => $userId,
                        'fecha' => date('Y-m-d H:i:s')
                    ] + $condition);

                    if ($_REQUEST['edit']) {
                        Acceso::newRecord([
                            'accion' => Acceso::ACCION_EDITAR,
                            'fk_funcionario' => $userId,
                            'fecha' => date('Y-m-d H:i:s')
                        ] + $condition);
                    }
                }
            }
            break;
    }

    //activo los permisos del propietario    
    Acceso::executeUpdate(['estado' => 1], [
        'fk_funcionario' => $Acceso->fk_funcionario
    ] + $condition);

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
