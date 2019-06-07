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

$Response = (object)array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 1
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    if (SessionController::isRoot()) {
        $Response->data = StaticSql::search('select * from perfil');
    } else {
        $root = Perfil::ADMINISTRADOR;
        $sql = <<<SQL
            SELECT *
            FROM perfil
            WHERE
                idperfil <> {$root}
SQL;
        $Response->data = StaticSql::search($sql);
    }
} else {
    $Response->message = "Debe iniciar sesion";
    $Response->success = 0;
}

echo json_encode($Response);
