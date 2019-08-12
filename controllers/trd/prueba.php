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

$TRDVersionController = new TRDVersionController();

SerieVersion::newRecord([
    'version' => 2,
    'tipo' => 2,
    'descripcion' => 2,
    'archivo_trd' => 'prueba.txt',
    'anexos' => 2,
    'json_clasificacion' => TemporalController::createFileDbRoute(
        'trd',
        'archivos',
        $TRDVersionController->getClasificationData()
    ),
    'json_trd' => $TRDVersionController->getTrdData(),
    'nombre' => 'nombre de prueba'
]);
