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
    $ok = false;
    $dataAditional = [];
    if ($_REQUEST['tipo'] == 1) {

        $urlExcel = $ruta_db_superior . $_REQUEST['file_trd'];

        if (is_file($urlExcel)) {
            new TRDLoadcontroller($urlExcel);
            $ok = true;

            $filename = basename($urlExcel);
            $route = "TRD/version_{$_REQUEST['tipo']}/trd_{$filename}";

            $content = file_get_contents($urlExcel);
            $jsonDB = TemporalController::createFileDbRoute($route, "archivos", $content);

            $dataAditional['archivo_trd'] = $jsonDB;
        } else {
            $Response->message = 'No se pudo leer el anexo TRD';
        }
    } else {
        //new TRDClonecontroller();
        $ok = true;
    }

    if ($ok) {

        if (!empty($_REQUEST['file_anexos'])) {

            $urlAnexo = $ruta_db_superior . $_REQUEST['file_anexos'];
            $filename = basename($urlAnexo);

            $route = "TRD/version_{$_REQUEST['tipo']}/ane_{$filename}";
            $content = file_get_contents($urlAnexo);

            $json = TemporalController::createFileDbRoute($route, "archivos", $content);
            $dataAditional['anexos'] = $json;
        }

        $attributes = [
            'version' => $_REQUEST['version'],
            'tipo' => $_REQUEST['tipo'],
            'descripcion' => $_REQUEST['descripcion']
        ];
        $attributes = array_merge($attributes, $dataAditional);

        if (SerieVersion::newRecord($attributes)) {

            $Response->success = 1;
        } else {
            $Response->message = "No se pudo almacenar la información";
        }
    } else {
        $Response->message = "No se pudo cargar/clonar la TRD";
    }
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
