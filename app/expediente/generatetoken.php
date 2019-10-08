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
UtilitiesController::defaultHeaderCors();

$Funcionario = new Funcionario(1);
$token = FuncionarioController::generateToken(
    $Funcionario,
    null,
    true
);

$Response = (object) [
    'key' => $Funcionario->getPK(),
    'token' => $token
];

echo json_encode($Response);
