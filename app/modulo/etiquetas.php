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

include_once $ruta_db_superior . 'models/etiqueta.php';
include_once $ruta_db_superior . 'models/busquedaComponente.php';

$Response = (object) array(
    'data' => new stdClass(),
    'message' => '',
    'success' => 1,
);

if ($_SESSION['idfuncionario'] == $_REQUEST['iduser']) {
    global $conn;
    
    $data = array();
    $parent = $_REQUEST['parent'] ? $_REQUEST['parent'] : 0;
    $component = BusquedaComponente::findByName('etiquetados');
    $tags = Etiqueta::findActiveByUser($_REQUEST['iduser']);

    foreach($tags as $tag){
        $url = 'views/buzones/index.php?';
        $url .= http_build_query([
            'variable_busqueda' => $tag['idetiqueta'],
            'idbusqueda_componente' => $component['idbusqueda_componente']
        ]);

        $data[] = array(
            'idmodule' => $tag['idetiqueta'],
            'isParent' => false,
            'name' => html_entity_decode($tag['nombre']),
            'icon' => 'fa fa-tag',
            'type' => 'tag',
            'url' => $url
        );
    }

    $Response->data = $data;
} else {
    $Response->message = 'Usuario invalido';
    $Response->success = 0;
}

echo json_encode($Response);