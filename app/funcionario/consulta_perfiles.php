<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
        break;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object) [
    'data' => [],
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (isset($_REQUEST['userId'])) {
        $Funcionario = new Funcionario($_REQUEST['userId']);
        $profiles = $Funcionario->getProfiles();

        foreach ($profiles as $Perfil) {
            $Response->data[] = [
                'idperfil' => $Perfil->getPK(),
                'nombre' => $Perfil->nombre
            ];
        }
    } else if (SessionController::isRoot()) {
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

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
