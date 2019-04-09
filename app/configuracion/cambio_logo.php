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

$Response = (object)[
    'success' => 0,
    'message' => '',
    'data' => []
];

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    if ($_REQUEST['route']) {
        $fileName = basename($_REQUEST['route']);
        $content = file_get_contents($ruta_db_superior . $_REQUEST['route']);
        $dbRoute = TemporalController::createFileDbRoute("logos/{$fileName}", "archivos", $content);

        $update = Configuracion::executeUpdate([
            'valor' => $dbRoute,
        ], [
            'nombre' => 'logo'
        ]);

        if ($update) {
            $Response->success = 1;
            $Response->message = 'Imagen actualizada';
        } else {
            $Response->message = 'Error al guardar';
        }
    } else {
        $Response->message = 'Debes cargar una imagen';
    }
} else {
    $Response->message = 'Debe iniciar sesion';
}

echo json_encode($Response);
