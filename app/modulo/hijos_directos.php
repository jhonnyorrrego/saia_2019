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

include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object) [
    'data' => [],
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    $grouperParent = $_REQUEST['grouper'] ? $_REQUEST['grouper'] : 0;
    $parent = $_REQUEST['parent'] ? $_REQUEST['parent'] : 0;

    if ($grouperParent == 1 || $parent == 0) {
        $Modulo = Modulo::findByAttributes(['nombre' => 'dashboard']);
        $Response->data[] = [
            'idmodule' => $Modulo->getPK(),
            'isParent' => 0,
            'name' => html_entity_decode($Modulo->etiqueta),
            'icon' => $Modulo->imagen,
            'type' => $Modulo->tipo,
            'url' => $Modulo->enlace
        ];
    }

    $QueryBuilder = Model::getQueryBuilder()
        ->select('*')
        ->from(Modulo::getTableName())
        ->where('cod_padre = :cod_padre')
        ->andWhere('tipo < 3')
        ->orderBy('orden', 'asc')
        ->setParameter(':cod_padre', $parent);
    $modules = Modulo::findByQueryBuilder($QueryBuilder);

    foreach ($modules as $key => $Modulo) {
        if (PermisoController::moduleAccess($Modulo->nombre)) {
            if ($grouperParent) {
                $countChilds = Modulo::countRecords(['cod_padre' => $Modulo->getPK()]);
                $isParent = $countChilds ? 1 : 0;
            }

            $Response->data[] = [
                'idmodule' => $Modulo->getPK(),
                'isParent' => $isParent,
                'name' => html_entity_decode($Modulo->etiqueta),
                'icon' => $Modulo->imagen,
                'type' => $Modulo->tipo,
                'url' => $Modulo->enlace
            ];
        }
    }
    $Response->success = 1;
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
