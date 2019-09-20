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
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['active']) {
        throw new Exception("Error Processing Request", 1);
    }

    $conn = Connection::getInstance();
    $conn->beginTransaction();

    try {
        if ($SerieVersion = SerieVersion::getTempVersion()) {

            //Se inactiva la version actual
            if ($CurrentVersion = SerieVersion::getCurrentVersion()) {
                $TRDVersionController = new TRDVersionController($CurrentVersion);

                $folder = "TRD/version_{$CurrentVersion->version}";
                $CurrentVersion->setAttributes([
                    'estado' => 0,
                    'vigente' => 0,
                    'json_trd' => TemporalController::createFileDbRoute(
                        $folder . "/trd.txt",
                        "archivos",
                        $TRDVersionController->getTrdData()
                    ),
                    'json_clasificacion' => TemporalController::createFileDbRoute(
                        $folder . "/clasificacion.txt",
                        "archivos",
                        $TRDVersionController->getClasificationData()
                    )
                ]);
                if ($CurrentVersion->update()) {
                    throw new Exception("Error al actualizar el estado de la version actual", 1);
                }
            }

            // Se activa la version temporal
            $SerieVersion->setAttributes([
                'estado' => 1,
                'vigente' => 1
            ]);
            if (!$SerieVersion->update()) {
                throw new Exception("Error al actualizar el estado de la version", 1);
            }

            new TRDSaveController($SerieVersion->getPK());

            $conn->commit();

            TRDLoadController::truncate();
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    } catch (\Throwable $th) {
        $conn->rollBack();
        throw new Exception($th->getMessage(), 1);
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
