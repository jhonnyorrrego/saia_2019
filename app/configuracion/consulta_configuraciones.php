<?php
session_start();

$max_salida = 10;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . "db.php";
require_once $ruta_db_superior . 'StorageUtils.php';
require_once $ruta_db_superior . 'filesystem/SaiaStorage.php';

$Response = new stdClass();
$Response->success = 1;
$Response->data = "";

$configurations = implode("','", $_REQUEST['configurations']);
$findConfigurations = busca_filtro_tabla("nombre,valor", "configuracion", "nombre in ('" . $configurations . "')", "", $conn);
$data = array();

if ($findConfigurations['numcampos']) {
    for ($i = 0; $i < $findConfigurations['numcampos']; $i++) {
        $Object = json_decode($findConfigurations[$i]['valor']);
        if ($Object->ruta) {
            $tipo_almacenamiento = new SaiaStorage("archivos");
            if ($tipo_almacenamiento->get_filesystem()->has($Object->ruta)) {
                $value = StorageUtils::get_binary_file($findConfigurations[$i]['valor']);
            }
        }else{
            $value = $findConfigurations[$i]['valor'];
        }

        $data[] = array(
            'name' => $findConfigurations[$i]['nombre'],
            'value' => $value,
        );
    }

    $Response->data = $data;
} else {
    $Response->success = 0;
}

echo json_encode($Response);
