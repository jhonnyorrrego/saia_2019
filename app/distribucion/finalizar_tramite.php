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

    for ($i = 0; $i < count($vector_iddistribucion); $i++) {
        $iddistribucion = $vector_iddistribucion[$i];

        $distribucion = busca_filtro_tabla("tipo_origen,estado_recogida,estado_distribucion", "distribucion", "iddistribucion=" . $iddistribucion, "");
        $diligencia = mostrar_diligencia_distribucion($distribucion[0]['tipo_origen'], $distribucion[0]['estado_recogida']);
        $upd = '';
        switch ($diligencia) {
            case 'RECOGIDA':
                $estado_distribucion = 1;
                if (@$_REQUEST['finaliza_manual']) {
                    $estado_distribucion = 0;
                }
                $upd = " UPDATE distribucion SET estado_recogida=1,estado_distribucion=" . $estado_distribucion . " WHERE iddistribucion=" . $iddistribucion;
                break;
            case 'ENTREGA':
                $estado_distribucion = 3;
                $upd = " UPDATE distribucion SET estado_distribucion=" . $estado_distribucion . " WHERE iddistribucion=" . $iddistribucion;
                break;
        } //fin switch

        if ($upd != '') {
            phpmkr_query($upd);
        }
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
