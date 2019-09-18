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

include_once $ruta_db_superior . 'core/autoload.php';
$Response = (object) array(
    'success' => 1,
    'message' => '',
    'data' => (object) array()
);

if ($_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $permissions = PermisoPerfil::countRecords([
        'perfil_idperfil' => $_REQUEST['profileId']
    ]);

    if ($permissions) {
        $Response->success = 0;
        $Response->message = "Debe eliminar los permisos asociados a este perfil antes de eliminarlo";
    } else {
        $Perfil = new Perfil($_REQUEST['profileId']);
        if (!$Perfil->delete()) {
            $Response->success = 0;
            $Response->message = "Error al Eliminar";
        }
    }
} else {
    $Response->success = 0;
    $Response->message = 'Debe iniciar session';
}

echo json_encode($Response);
