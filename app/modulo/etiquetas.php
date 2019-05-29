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

include_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object)[
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    $data = [];
    $parent = $_REQUEST['parent'] ? $_REQUEST['parent'] : 0;
    $BusquedaComponente = BusquedaComponente::findByAttributes(
        [
            'nombre' => 'etiquetados'
        ],
        [
            BusquedaComponente::getPrimaryLabel()
        ]
    );
    $tags = Etiqueta::findAllByAttributes([
        'estado' => 1,
        'fk_funcionario' => $_REQUEST['key']
    ]);

    foreach ($tags as $Etiqueta) {
        $url = 'views/buzones/index.php?';
        $url .= http_build_query([
            'variable_busqueda' => $Etiqueta->getPK(),
            'idbusqueda_componente' => $BusquedaComponente->getPK()
        ]);

        $data[] = [
            'idmodule' => $Etiqueta->getPK(),
            'isParent' => false,
            'name' => html_entity_decode($Etiqueta->nombre),
            'icon' => 'fa fa-tag',
            'type' => 'tag',
            'url' => $url
        ];
    }

    $Response->data = $data;
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
