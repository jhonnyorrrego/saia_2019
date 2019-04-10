<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object)array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    switch ($_REQUEST['type']) {
        case 'TIPO_ANEXO_PDF':
            $Anexo = new Anexo($_REQUEST['typeId']);
            $route = $Anexo->ruta;
            $force = true;
            break;
        default:
            if ($_REQUEST['actualizar_pdf']) {
                include_once $ruta_db_superior . 'class_impresion_' . $_REQUEST['exportar'] . '.php';

                $Documento = new Documento($_REQUEST['iddoc']);
                $route = $Documento->pdf;
            } else {
                $route = base64_decode($_REQUEST['ruta']);
            }

            $force = $_REQUEST['actualizar_pdf'];
            break;
    }

    if ($route) {
        $image = TemporalController::createTemporalFile($route);

        if ($image->success && is_file($ruta_db_superior . $image->route)) {
            $Response->data = $image->route;
            $Response->success = 1;
        } else {
            $Response->message = "Error al generar el archivo";
        }
    } else {
        $Response->message = "Error al resolver la ruta del pdf";
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);
