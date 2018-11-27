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

$idfuncionario = encrypt_blowfish(usuario_actual('id'), LLAVE_SAIA_CRYPTO);
$actualRow = ($_REQUEST['pageNumber'] - 1 ) * $_REQUEST['pageSize'];

$params = http_build_query(array(
    'idbusqueda_componente' =>  $_REQUEST["idbusqueda_componente"],
    'idfunc' => $idfuncionario,
    'page' => $_REQUEST['pageNumber'],
    'rows' => $_REQUEST['pageSize'],
    'actual_row' => $actualRow
));

$url = PROTOCOLO_CONEXION . RUTA_PDF . '/pantallas/busquedas/servidor_busqueda.php?' . $params;
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
    'rows' => array()
);
foreach ($output->rows as $key => $value) {
    $data ['rows'][]['info'] = $value->info;
}

echo json_encode($data);