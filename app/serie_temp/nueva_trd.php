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

    if (!$_REQUEST['tipo']) {
        throw new Exception('Debe indicar una acción', 1);
    }
    throw new Exception("No se pudo almacenar la información", 1);

    $dataAditional = [];
    $folder = "TRD/version_{$_REQUEST['version']}";
    $urlExcel = false;

    if ($_REQUEST['tipo'] == 1) {
        $urlExcel = $ruta_db_superior . $_REQUEST['file_trd'];

        if (is_file($urlExcel)) {
            $filename = basename($urlExcel);
            $route = "{$folder}/trd_{$filename}";

            $content = file_get_contents($urlExcel);
            $jsonDB = TemporalController::createFileDbRoute($route, "archivos", $content);

            $dataAditional['archivo_trd'] = $jsonDB;
        } else {
            throw new Exception("No se pudo leer el archivo TRD", 1);
        }
    } else if (!SerieVersion::existCurrentVersion()) {
        throw new Exception("No existe una TRD vigente, no se puede clonar", 1);
    }

    if (!empty($_REQUEST['file_anexos'])) {
        $urlAnexo = $ruta_db_superior . $_REQUEST['file_anexos'];

        if (is_file($urlAnexo)) {
            $filename = basename($urlAnexo);
            $route = "{$folder}/ane_{$filename}";

            $content = file_get_contents($urlAnexo);
            $json = TemporalController::createFileDbRoute($route, "archivos", $content);

            $dataAditional['anexos'] = $json;
        } else {
            throw new Exception("No se pudo leer el anexo TRD", 1);
        }
    }

    unset($_REQUEST['file_trd'], $_REQUEST['file_anexos']);
    $attributes = array_merge($_REQUEST, $dataAditional);

    $conn = Connection::getInstance();
    $conn->beginTransaction();

    try {
        if ($idSerieVersion = SerieVersion::newRecord($attributes)) {
            if ($_REQUEST['tipo'] == 1) {
                new TRDLoadController($urlExcel, $idSerieVersion);
            } else {
                new TRDCloneController($idSerieVersion, $SerieVersion->getPK());
            }

            $Response->success = 1;
            $Response->message = "Datos Guardados!";
            $conn->commit();
        } else {
            throw new Exception("No se pudo almacenar la información", 1);
        }
    } catch (\Throwable $th) {
        $conn->rollBack();
        throw new Exception($th->getMessage(), 1);
    }
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
