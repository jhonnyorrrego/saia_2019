<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . 'db.php';
include_once $ruta_db_superior . 'pantallas/lib/librerias_cripto.php';

$idfuncionario = encrypt_blowfish($_SESSION["idfuncionario"], LLAVE_SAIA_CRYPTO);
$actualRow = ($_REQUEST['pageNumber'] - 1) * $_REQUEST['pageSize'];

$dataParams = [
    'idfunc' => $idfuncionario,
    'page' => $_REQUEST['pageNumber'],
    'rows' => $_REQUEST['pageSize'],
    'actual_row' => $actualRow
];
$columns = $_REQUEST['nameColumns'];

unset($_REQUEST['pageNumber'], $_REQUEST['pageSize'], $_REQUEST['nameColumns']);

$params = array_merge($dataParams, $_REQUEST);
$url = PROTOCOLO_CONEXION . RUTA_PDF . '/app/busquedas/generar_reporte.php?' . http_build_query($params);

$ch = curl_init();
if (strpos(PROTOCOLO_CONEXION, 'https') !== false) {
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
}
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = json_decode(curl_exec($ch));
curl_close($ch);

$data = [
    'total' => $output->records,
    'rows' => []
];
foreach ($output->rows as $key => $value) {
    $data['rows'][$key]['id'] = (int) $value->llave;
    foreach ($columns as $name) {
        $data['rows'][$key][$name] = $value->$name;
    }
}
echo json_encode($data);
