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

    if (!$_REQUEST['iddistribucion']) {
        throw new Exception('Debe especificar la distribución', 1);
    }

    // Verifica si los items ya se encuentran recepcionados (data = 1) y si no se encuentran recepcionados (data = 2).
    $resultado = 1;
    $items = explode(',', $_REQUEST['iddistribucion']);
    for ($i = 0; $i < count($items); $i++) {
        $iddistribucion = $items[$i];
        $Distribucion = new Distribucion($iddistribucion);
        if ($Distribucion->estado_distribucion == '0') {
            $query = Model::getQueryBuilder();
            $itemDistribucion = $query
                ->select('estado_distribucion')
                ->from('distribucion')
                ->where('iddistribucion = :item')
                ->setParameter(':item', $iddistribucion, \Doctrine\DBAL\Types\Type::INTEGER)
                ->execute()->fetchAll();
            if ($itemDistribucion[0]['estado_distribucion'] == '0') {
                $resultado = 2;
            }
        }
    }
    $Response->data = $resultado;
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
