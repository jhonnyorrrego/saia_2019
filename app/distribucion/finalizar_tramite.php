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
include_once $ruta_db_superior . 'app/distribucion/funciones_distribucion.php';

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

    ////////////////////// Este llamado finaliza el tramite cuando se encuetra el documento en distribución.
    ////////////////////// Cambia el estado a finalizado si se encuentra en ENTREGA o lo devuelve a por distribuir si se encontraba en recogida

    $vector_iddistribucion = explode(',', $_REQUEST['iddistribucion']);

    foreach ($vector_iddistribucion as $vector) {
        $iddistribucion = $vector;
        $Distribucion = new Distribucion($iddistribucion);
        $diligencia = mostrar_diligencia_distribucion($Distribucion->tipo_origen, $Distribucion->estado_recogida);

        if ($Distribucion->entre_sedes == 0) {
            switch ($diligencia) {
                case 'RECOGIDA':
                    $Distribucion->estado_recogida = 1;
                    $Distribucion->estado_distribucion = 1;
                    $Distribucion->save();
                    break;
                case 'ENTREGA':
                    $Distribucion->estado_distribucion = 3;
                    $Distribucion->save();
                    break;
            } //fin switch  
        }
        if ($Distribucion->entre_sedes > 0) {
            $query = Model::getQueryBuilder();
            $copiasDistribuciones = $query
                ->select("iddistribucion")
                ->from("distribucion")
                ->where("entre_sedes= :entreSedes")
                ->setParameter("entreSedes", $Distribucion->entre_sedes, \Doctrine\DBAL\Types\Type::INTEGER)
                ->execute()->fetchAll();
        }
        foreach ($copiasDistribuciones as $itemDistribucion) {
            $Distribucion = new Distribucion($itemDistribucion['iddistribucion']);
            $Distribucion->estado_distribucion = 3;
            $Distribucion->save();
        }
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
