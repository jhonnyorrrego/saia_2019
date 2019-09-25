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
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    $Response->data = [];
    $query = Model::getQueryBuilder();
    $mensajeros = $query
        ->select("mensajero_ruta")
        ->from("ft_funcionarios_ruta")
        ->where("estado_mensajero= 1")
        ->andWhere("ft_ruta_distribucion = :ruta")
        ->setParameter(":ruta", $_REQUEST['ruta'], \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()->fetchAll();

    foreach ($mensajeros as $key => $ruta) {
        $VfuncionarioDc = new VfuncionarioDc($mensajeros[$key]["mensajero_ruta"]);
        $Response->data[] = $VfuncionarioDc->nombres . ' ' . $VfuncionarioDc->apellidos;
    }

    $Response->success = 1;
    $Response->message = "Campos actualizados";
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
