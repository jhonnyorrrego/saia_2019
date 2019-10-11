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

    /**
     * Cambia de estado_distribucion de Por recepcionar (0) a Por distribuir (1) en el reporte de Pendientes de distribucion.
     */

    $noRecepcionar = '';
    $success = 1;
    $items = explode(',', $_REQUEST['iddistribucion']);

    $Distribucion = new Distribucion($items[0]);
    if ($Distribucion->entre_sedes == 0) {
        for ($i = 0; $i < count($items); $i++) {
            $iddistribucion = $items[$i];
            $Distribucion = new Distribucion($iddistribucion);
            if (!$Distribucion->estado_distribucion) {
                $query = Model::getQueryBuilder();
                $actualiza_por_distribuir = $query
                    ->update('distribucion')
                    ->set('estado_distribucion', '1')
                    ->where('iddistribucion=:item')
                    ->setParameter(':item', $iddistribucion, \Doctrine\DBAL\Types\Type::INTEGER)
                    ->execute();
                $success = 2;
            } else {
                $noRecepcionar .= $Distribucion->numero_distribucion . ',';
            }
        }
    } else {
        for ($i = 0; $i < count($items); $i++) {
            $iddistribucion = $items[$i];
            $Distribucion = new Distribucion($iddistribucion);
            if (!$Distribucion->estado_distribucion) {
                $query = Model::getQueryBuilder();
                $actualiza_por_distribuir = $query
                    ->update('distribucion')
                    ->set('estado_distribucion', 1)
                    ->set('sede_origen', ':sede_origen')
                    ->set('sede_destino', ':sede_origen')
                    ->where('iddistribucion=:item')
                    ->setParameter(':sede_origen', $Distribucion->sede_destino, \Doctrine\DBAL\Types\Type::INTEGER)
                    ->setParameter(':item', $iddistribucion, \Doctrine\DBAL\Types\Type::INTEGER)
                    ->execute();
                $success = 2;
            } else {
                $noRecepcionar .= $Distribucion->numero_distribucion . ',';
            }
        }
    }
    $noRecepcionar = substr($noRecepcionar, 0, -1);
    $Response->message = "";
    if ($noRecepcionar != null) {
        $Response->message = "Los items ({$noRecepcionar}) ya se encuentran recepcionados";
    }
    $Response->success = $success;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
