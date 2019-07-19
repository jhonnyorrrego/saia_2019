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

    switch ($_REQUEST['type']) {
        case 'TIPO_ANEXO_PDF':
            $Anexo = new Anexo($_REQUEST['typeId']);
            $route = $Anexo->ruta;
            $force = true;
            break;
        case 'TIPO_ANEXOS_PDF':
            $Anexo = new Anexos($_REQUEST['typeId']);
            $route = $Anexo->ruta;
            $force = true;
            break;
        default:
            if ($_REQUEST['actualizar_pdf']) {
                $userId = SessionController::getValue('idfuncionario');
                $Funcionario = new Funcionario($userId);
                $_REQUEST['token'] = FuncionarioController::generateToken($Funcionario, 5, true);

                $fileName = ucfirst($_REQUEST['exportar']) . "Controller.php";
                include_once "{$ruta_db_superior}/controllers/pdf/{$fileName}";

                $Documento = new Documento($_REQUEST['iddoc']);
                $route = $Documento->pdf;
            } else {
                $route = base64_decode($_REQUEST['ruta']);
            }

            $force = $_REQUEST['actualizar_pdf'];
            break;
    }

    if ($route) {
        $image = TemporalController::createTemporalFile($route, '', $force);

        if ($image->success && is_file($ruta_db_superior . $image->route)) {
            $Response->data = $image->route;
            $Response->success = 1;
        } else {
            $Response->message = "Error al generar el archivo";
        }
    } else {
        $Response->message = "Error al resolver la ruta del pdf";
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
