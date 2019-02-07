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

include_once $ruta_db_superior . "controllers/autoload.php";

$Response = (Object)[
    'success' => 1,
    'data' => []
];

$configurations = implode("','", $_REQUEST['configurations']);
$sql = "select nombre,valor from configuracion where nombre in ('{$configurations}')";
$findConfigurations = StaticSql::search($sql);

if ($findConfigurations) {
    foreach ($findConfigurations as $key => $configuration) {
        $Object = json_decode($configuration['valor']);
        if ($Object->ruta) {
            $tipo_almacenamiento = new SaiaStorage("archivos");
            if ($tipo_almacenamiento->get_filesystem()->has($Object->ruta)) {
                $value = StorageUtils::get_binary_file($configuration['valor']);
            }
        }else{
            $value = $configuration['valor'];
        }

        $Response->data[] = [
            'name' => $configuration['nombre'],
            'value' => $value,
        ];
    }
} else {
    $Response->success = 0;
}

echo json_encode($Response);
