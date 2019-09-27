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
 * Con este php llamado desde el ajax se cargan los mensajeros de la organización
 * 
 * @param $_REQUEST[''] En el request solo llega el token y key para validar la sesión    
 * @return string en formato json se envian los nombres y los id de las sedes.
 * @return string  con el formato Json Retorna un json con array data (Nombre de los mensajeros) code(id de los mensajeros de la ruta que llega con el $_REQUEST['ruta'] desde el ajax
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
    $mensajerosSedes = array();

    foreach ($mensajeros as $key => $ruta) {
        $VfuncionarioDc = new VfuncionarioDc($mensajeros[$key]["mensajero_ruta"]);
        array_push($mensajerosSedes, ['id' => $mensajeros[$key]["mensajero_ruta"], 'nombre' => $VfuncionarioDc->nombres . ' ' . $VfuncionarioDc->apellidos]);
    }
    $Response->data = json_encode($mensajerosSedes);
    $Response->success = 1;
    $Response->message = "Mensajeros cargados exitosamente";
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
