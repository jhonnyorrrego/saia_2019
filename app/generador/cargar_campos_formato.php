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

    $Response->data = '';
    global $conn;

    function cargarCampos($categoria)
    {
        $listadoComponentes = busca_filtro_tabla('etiqueta,idpantalla_componente,clase', 'pantalla_componente', 'estado=1 AND categoria="' . $categoria . '"', '', $conn);
        $listado = '';
        $listado .= "<h5>" . $categoria . "</h5>";
        for ($i = 0; $i < $listadoComponentes["numcampos"]; $i++) {
            $etiqueta = $listadoComponentes[$i]["etiqueta"];
            $listado .= "<li class='panel' idpantalla_componente='{$listadoComponentes[$i]["idpantalla_componente"]}'><i class='{$listadoComponentes[$i]["clase"]} mr-3'></i><div id='c_' class='d-inline'>{$etiqueta}</div></li>";
        }
        return $listado;
    }

    $Response->data .= cargarCampos('Elementos de diseño');
    $Response->data .= cargarCampos('Campos del formato');
    $Response->data .= cargarCampos('Campos avanzados');

    $Response->success = 1;
    $Response->message = "Campos actualizados";
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
