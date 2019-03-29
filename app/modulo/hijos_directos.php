<?php
session_start();
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

$Response = (object)[
    'data' => [],
    'message' => '',
    'success' => 1
];

if ($_SESSION['idfuncionario'] == $_REQUEST['iduser']) {
    $grouperParent = $_REQUEST['grouper'] ? $_REQUEST['grouper'] : 0;
    $parent = $_REQUEST['parent'] ? $_REQUEST['parent'] : 0;

    if ($grouperParent == 1 && $parent) {
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

    $sql = "SELECT * FROM modulo WHERE cod_padre={$parent} AND tipo<3 ORDER by orden ASC";
    $modules = Modulo::findBySql($sql);

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
} else {
    $Response->message = 'Debe iniciar session';
    $Response->success = 0;
}

echo json_encode($Response);
