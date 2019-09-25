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
    'onlyType' => 0,
    'data' => []
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['idserie']) {
        throw new Exception('Serie invalida', 1);
    }

    if (!isset($_REQUEST['className'])) {
        throw new Exception("Error Processing Request", 1);
    }

    $Serie = new $_REQUEST['className']($_REQUEST['idserie']);
    if (!$Serie->hasChild(2)) {

        $Response->onlyType = 1;
        $Instances = $Serie->getSerieDependenciaFk();
        if ($Instances) {

            if (count($Instances) == 1) {
                $Dependencia = $Instances[0]->getDependenciaFk();
                $Response->data = [
                    'iddependencia' => $Dependencia->getPK(),
                    'codigo' => $Dependencia->codigo,
                    'nombre' => $Dependencia->nombre
                ];
            } else {
                throw new Exception("Error, la serie esta vinculada a dos dependencia", 1);
            }
        } else {
            throw new Exception("Error al consultar la dependencia de la serie", 1);
        }
    }
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
