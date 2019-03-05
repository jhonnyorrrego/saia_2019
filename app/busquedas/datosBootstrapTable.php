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
unset($_REQUEST['pageNumber'], $_REQUEST['pageSize']);

$ids = [
    $_REQUEST['idbusqueda_componente']
];
unset($_REQUEST['idbusqueda_componente']);

if (!empty($_REQUEST['idsComponente'])) {
    $ids = array_unique(array_merge($ids, $_REQUEST['idsComponente']));
    unset($_REQUEST['idsComponente']);
}

$dataParams = [
    'idfunc' => $idfuncionario,
    'page' => $_REQUEST['pageNumber'],
    'rows' => $_REQUEST['pageSize'],
    'actual_row' => $actualRow
];

$total = 0;
$i = 0;
$rows=[];
foreach ($ids as $idBusquedaComponente) {
    $dataParams['idbusqueda_componente'] = $idBusquedaComponente;
    $params = array_merge($dataParams, $_REQUEST);

    $url = PROTOCOLO_CONEXION . RUTA_PDF . '/pantallas/busquedas/servidor_busqueda_exp.php?' . http_build_query($params);

    $ch = curl_init();
    if (strpos(PROTOCOLO_CONEXION, 'https') !== false) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    }
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = json_decode(curl_exec($ch));
    curl_close($ch);
    
    $total = $output->records + $total;

    foreach ($output->rows as $key => $value) {
        $rows[$i]['info'] = $value->info;
        $rows[$i]['id'] = (int)$value->llave;
        $i++;
    }
}

$data = [
    'total' => $total,
    'rows' => $rows
];
echo json_encode($data);
