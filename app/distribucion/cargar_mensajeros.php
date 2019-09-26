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

/**
 * Retorna un json con array data (Nombre de los mensajeros) code(id de los mensajeros de la ruta que llega con el $_REQUEST['ruta'] desde el ajax
 * @return string  con el formato Json
 * @author Julian Otalvaro Osorio <julian.otalvaro@cerok.com>
 * @date 2019-09-25 
 */

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    $Response->data = [];
    $Response->code = [];
    $query = Model::getQueryBuilder();
    $mensajeros = '';
    if (isset($_REQUEST['ruta'])) {
        $mensajeros = $query
            ->select("mensajero_ruta")
            ->from("ft_funcionarios_ruta")
            ->where("estado_mensajero= 1")
            ->andWhere("ft_ruta_distribucion = :ruta")
            ->setParameter(":ruta", $_REQUEST['ruta'], \Doctrine\DBAL\Types\Type::INTEGER)
            ->execute()->fetchAll();
    } else {
        $mensajeros = $query
            ->select("mensajero_ruta")
            ->from("ft_funcionarios_ruta")
            ->where("estado_mensajero= 1")
            ->execute()->fetchAll();
    }
    foreach ($mensajeros as $key => $ruta) {
        $VfuncionarioDc = new VfuncionarioDc($mensajeros[$key]["mensajero_ruta"]);
        $Response->data[] = $VfuncionarioDc->nombres . ' ' . $VfuncionarioDc->apellidos;
        $Response->code[] = $mensajeros[$key]["mensajero_ruta"];
    }
    $Response->data = json_encode($Response->data);
    $Response->success = 1;
    $Response->message = "Mensajeros cargados exitosamente";
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
