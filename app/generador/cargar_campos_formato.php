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
    'data' => '',
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    $Response->data .= cargarCampos('Elementos de diseño');
    $Response->data .= cargarCampos('Campos del formato');
    $Response->data .= cargarCampos('Campos avanzados');
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);

function cargarCampos($categoria)
{
    $components = PantallaComponente::findAllByAttributes([
        'estado' => 1,
        'categoria' => $categoria
    ]);

    $listado = '';
    $listado .= "<h5>{$categoria}</h5>";

    foreach ($components as $PantallaComponente) {
        $listado .= "<li class='panel' idpantalla_componente='{$PantallaComponente->getPK()}'>
            <i class='{$PantallaComponente->clase} mr-3'></i>
            <div id='c_' class='d-inline'>{$PantallaComponente->etiqueta}</div>
        </li>";
    }

    return $listado;
}
