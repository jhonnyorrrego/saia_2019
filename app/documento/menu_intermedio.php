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

$Response = (object)array(
    'data' => [],
    'message' => "",
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $sql = "select a.nombre,a.enlace,a.imagen,a.etiqueta from modulo a, modulo b where a.cod_padre = b.idmodulo and b.nombre = 'menu_documento' order by a.orden";
    $modules = StaticSql::search($sql);

    foreach ($modules as $key => $module) {
        if (PermisoController::moduleAccess($module['nombre'])) {
            $Response->data[] = $module;
        }
    }

    $Response->success = 1;
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);

