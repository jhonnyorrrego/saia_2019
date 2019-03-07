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
    'message' => '',
    'success' => 1,
);

if ($_SESSION['idfuncionario'] == $_REQUEST['iduser']) {
    global $conn;

    $data = array();
    $grouperParent = $_REQUEST['grouper'] ? $_REQUEST['grouper'] : 0;
    $parent = $_REQUEST['parent'] ? $_REQUEST['parent'] : 0;
    $modules = Modulo::findAllByAttributes([
        'cod_padre' => $parent
    ], null, 'orden');

    if ($grouperParent == 1 && $parent) {
        $Modulo = Modulo::findByAttributes(['nombre' => 'dashboard']);
        $data[] = [
            'idmodule' => $Modulo->getPK(),
            'isParent' => 0,
            'name' => html_entity_decode($Modulo->etiqueta),
            'icon' => $Modulo->imagen,
            'type' => $Modulo->tipo,
            'url' => $Modulo->enlace
        ];
    }

    foreach ($modules as $key => $Modulo) {
        if (PermisoController::moduleAccess($Modulo->nombre)) {
            if ($grouperParent) {                
                $countChilds = Modulo::countRecords(['cod_padre' => $Modulo->getPK()]);
                $isParent = $countChilds ? 1 : 0;
            }

            $data[] =[
                'idmodule' => $Modulo->getPK(),
                'isParent' => $isParent,
                'name' => html_entity_decode($Modulo->etiqueta),
                'icon' => $Modulo->imagen,
                'type' => $Modulo->tipo,
                'url' => $Modulo->enlace
            ];
        }
    }

    $Response->data = $data;
} else {
    $Response->message = 'Debe inicial session';
    $Response->success = 0;
}

echo json_encode($Response);