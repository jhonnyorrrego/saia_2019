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
    'data' => [],
    'message' => "",
    'success' => 1
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    switch ($_REQUEST['type']) {
        case 'TIPO_PAGINA':
            $pages = Pagina::findAllByAttributes([
                'id_documento' => $_REQUEST['typeId']
            ]);

            foreach ($pages as $key => $Pagina) {
                $Response->data[] = [
                    'id' => $Pagina->getPK(),
                    'route' => $Pagina->getTemporalRoute()
                ];
            }
            break;
        case 'TIPO_ANEXO_IMAGEN':
            $Anexo = new Anexo($_REQUEST['typeId']);
            $image = TemporalController::createTemporalFile($Anexo->ruta);
            $Response->data[] = [
                'id' => $Anexo->getPK(),
                'route' => $image->route
            ];
            break;
        case 'TIPO_ANEXOS_IMAGEN':
            $Anexo = new Anexos($_REQUEST['typeId']);
            $image = TemporalController::createTemporalFile($Anexo->ruta);
            $Response->data[] = [
                'id' => $Anexo->getPK(),
                'route' => $image->route
            ];
            break;
    }

    if (!$Response->data) {
        $Response->message = 'No existen paginas';
    }
} else {
    $Response->message = "Debe iniciar sesion";
    $Response->success = 0;
}

echo json_encode($Response);
