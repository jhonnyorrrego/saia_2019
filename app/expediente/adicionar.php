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

$Response = (object) [
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (empty($_REQUEST['nombre'])) {
        throw new Exception("Error Processing Request", 1);
    }

    $newData = UtilitiesController::cleanForm($_REQUEST);

    $defaultValues = [
        'fecha_creacion' => date('Y-m-d H:i:s'),
        'fk_propietario' => SessionController::getValue('idfuncionario'),
        'fk_responsable' => SessionController::getValue('idfuncionario'),
        'estado' => 1
    ];

    if (empty($newData['fk_serie_dependencia'])) {
        $newData['fk_serie_dependencia'] = 0;
        $newData['fk_dependencia'] = 0;
        $newData['fk_serie'] = 0;
        $newData['fk_subserie'] = 0;
    } else {
        $SerieDependencia = new SerieDependencia($newData['fk_serie_dependencia']);
        $Serie = $SerieDependencia->getSerieFk();

        $newData['fk_dependencia'] = $SerieDependencia->fk_dependencia;
        $newData['fk_serie'] = $Serie->tipo == 1 ?
            $SerieDependencia->fk_serie : $Serie->getCodPadre()->getPK();
        $newData['fk_subserie'] =  $Serie->tipo == 2 ? $SerieDependencia->fk_serie : 0;
    }
    $newData['fk_caja'] = 0;

    $attributes = array_merge($newData, $defaultValues);

    $conn = Connection::getInstance();
    $conn->beginTransaction();

    try {
        if ($id = Expediente::newRecord($attributes)) {
            $Response->data = Expediente::getDataId($id);
            $Response->success = 1;
            $Response->message = "Datos Guardados!";
            $conn->commit();
        } else {
            $conn->rollBack();
        }
    } catch (\Throwable $th) {
        $conn->rollBack();
        throw new Exception($th->getMessage(), 1);
    }
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
