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

if (JwtController::check($_REQUEST['token'], $_REQUEST['key'])) {
    $userId = SessionController::getValue('idfuncionario');
    $Funcionario = new Funcionario($userId);
    $actualRow = ($_REQUEST['pageNumber'] - 1) * $_REQUEST['pageSize'];
    $dataParams = [
        'page' => $_REQUEST['pageNumber'],
        'rows' => $_REQUEST['pageSize'],
        'actual_row' => $actualRow,
        'key' => $Funcionario->getPK(),
        'token' => FuncionarioController::generateToken($Funcionario, 5, true)
    ];

    unset($_REQUEST['pageNumber'], $_REQUEST['pageSize']);
    $params = array_merge($_REQUEST, $dataParams);
    $query = http_build_query($params);
    $url = PROTOCOLO_CONEXION . RUTA_PDF . "/pantallas/busquedas/servidor_busqueda_exp.php?" . $query;

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
    $output = json_decode(curl_exec($ch));
    curl_close($ch);

    $data = array(
        'total' => $output->records,
        'rows' => $output->rows
    );
    /*foreach ($output->rows as $key => $value) {
        $data['rows'][$key]['id'] = (int) $value->llave;
        $data['rows'][$key]['info'] = $value->info;
    }*/
} else {
    $data['message'] = 'Debe iniciar sesion';
}
echo json_encode($data);
