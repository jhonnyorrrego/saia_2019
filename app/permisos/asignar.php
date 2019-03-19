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

    switch ($_REQUEST['private']) {
        case 1: //public
            $output = Acceso::executeUpdate([
                'estado' => 1
            ], [
                'tipo_relacion' => $type,
                'id_relacion' => $_REQUEST['typeId'],
                'accion' => Acceso::ACCION_VER_PUBLICO
            ]);
            break;
        case 2: //privado
            $output = Acceso::executeUpdate([
                'estado' => 0
            ], [
                'tipo_relacion' => $type,
                'id_relacion' => $_REQUEST['typeId']
            ]);

            if ($output) {
                $output = Acceso::executeUpdate([
                    'estado' => 1
                ], [
                    'tipo_relacion' => $type,
                    'id_relacion' => $_REQUEST['typeId'],
                    'fk_funcionario' => $_SESSION['idfuncionario']
                ]);
            }
            break;
        case 3: //usuario especifico
            $users = explode(',', $_REQUEST['user']);

            /*$output = Acceso::executeUpdate([
                'estado' => 0
            ], [
                'tipo_relacion' => $type,
                'id_relacion' => $_REQUEST['typeId']
            ]);*/

            $data = [
                'tipo_relacion' => $type,
                'id_relacion' => $_REQUEST['typeId']
            ];
            foreach ($users as $key => $userId) {
                Acceso::newRecord([
                    'accion' => Acceso::ACCION_VER,
                    'fk_funcionario' => $userId
                ] + $data);

                if($_REQUEST['edit']){
                    Acceso::newRecord([
                        'accion' => Acceso::ACCION_EDITAR,
                        'fk_funcionario' => $userId
                    ] + $data);
                }
            }
            exit;
            break;
    }

    if ($output) {
        $Response->message = 'Privacidad actualizada';
        $Response->success = 1;
    } else {
        $Response->message = 'Error al modificar la privacidad';
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);
