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

$Response = (object) array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    if (count($_REQUEST['destination']) && $_REQUEST['documentId']) {
        $users = array_unique($_REQUEST['destination']);
        $users = array_filter($users, function ($v, $k) {
            return strpos($v, '#') == false;
        }, ARRAY_FILTER_USE_BOTH);
        $userList = implode('@', $users);

        transferencia_automatica(0, $_REQUEST['documentId'], $userList, 3, $_REQUEST['message'], "TRANSFERIDO");

        foreach ($_REQUEST['files'] as $route) {
            $content = file_get_contents($ruta_db_superior . $route);
            $routePath = explode('/', $route);
            $extensionParts = explode('.', end($routePath));
            $route = 'anexo_transferencia/' . $_REQUEST['documentId'] . '/' . time() . '-' . rand(0, 1000) . '.' . end($extensionParts);

            $dbRoute = TemporalController::createFileDbRoute($route, 'archivos', $content);

            Anexos::newRecord([
                'documento_iddocumento' => $_REQUEST['documentId'],
                'ruta' => $dbRoute,
                'etiqueta' => end($routePath),
                'tipo' => end($extensionParts),
                'fecha_anexo' => date('Y-m-d H:i:s'),
                'fk_funcionario' => $_REQUEST['key'],
                'estado' => 1,
                'version' => 1
            ]);
        }

        $Response->message = 'Documento Transferido';
        $Response->success = 1;
    } else {
        $Response->message = 'Debe indicar el destino';
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);
