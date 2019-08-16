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
    'rows' => [],
    'total' => 0,
    'message' => ''
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    $userId = SessionController::getValue('idfuncionario');
    $Funcionario = new Funcionario($userId);
    $dataParams = [
        'key' => $Funcionario->getPK(),
        'token' => FuncionarioController::generateToken($Funcionario, 5, true)
    ];

    $params = array_merge($_REQUEST, $dataParams);
    $query = http_build_query($params);
    $url = PROTOCOLO_CONEXION . RUTA_PDF . "/app/busquedas/generar_reporte.php?" . $query;

    if ($_REQUEST['debug']) {
        echo '<pre>';
        var_dump($url . "&debug=1");
        echo '</pre>';
        exit;
    }
    $ch = curl_init();
    if (strpos(PROTOCOLO_CONEXION, 'https') !== false) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    }
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $Response = json_decode(curl_exec($ch));
    curl_close($ch);
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
