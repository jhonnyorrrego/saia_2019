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

    $dataAditional = [];
    $folder = "TRD/version_{$_REQUEST['version']}";

    $ok = 1;
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
            $ok = 0;
            $Response->message = 'No se pudo leer el archivo TRD';
        }
    }

    if (!empty($_REQUEST['file_anexos']) && $ok) {
        $urlAnexo = $ruta_db_superior . $_REQUEST['file_anexos'];

        if (is_file($urlAnexo)) {
            $filename = basename($urlAnexo);
            $route = "{$folder}/ane_{$filename}";

            $content = file_get_contents($urlAnexo);
            $json = TemporalController::createFileDbRoute($route, "archivos", $content);
            $dataAditional['anexos'] = $json;
        } else {
            $ok = 0;
            $Response->message = 'No se pudo cargar el anexo TRD';
        }
    }

    if ($ok) {
        if ($SerieVersion = SerieVersion::getCurrentVersion()) {

            $TRDVersionController = new TRDVersionController($SerieVersion->getPK());
            $TRDVersionController->removeTemporalFile();
            $folder = "TRD/version_{$SerieVersion->version}";

            $SerieVersion->setAttributes([
                'json_trd' => TemporalController::createFileDbRoute($folder . "/trd.txt", "archivos", $TRDVersionController->getTrdData()),
                'json_clasificacion' => TemporalController::createFileDbRoute($folder . "/clasificacion.txt", "archivos", $TRDVersionController->getClasificationData())
            ]);
            $SerieVersion->update();
        }

        $attributes = [
            'version' => $_REQUEST['version'],
            'tipo' => $_REQUEST['tipo'],
            'nombre' => $_REQUEST['nombre'],
            'descripcion' => $_REQUEST['descripcion']
        ];
        $attributes = array_merge($attributes, $dataAditional);

        if ($idSerieVersion = SerieVersion::newRecord($attributes)) {
            if ($_REQUEST['tipo'] == 1) {
                new TRDLoadController($urlExcel, $idSerieVersion);
            } else {
                new TRDCloneController($idSerieVersion, $SerieVersion->getPK());
            }

            $Response->success = 1;
            $Response->message = "Datos Guardados!";
        } else {
            $Response->message = "No se pudo almacenar la información";
        }
    }
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
