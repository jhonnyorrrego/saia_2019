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
            $binary = StorageUtils::get_binary_file($configuration['valor']);
            $dir = 'temporal/saia/logo';

            if (!is_dir($ruta_db_superior . $dir)) {
                if (!mkdir($ruta_db_superior . $dir, 0777, true)) {
                    throw new Exception("cant no create dir", 1);
                }
            }

            $route = explode('/', $Object->ruta);
            $fileName = end($route);
            $finalRoute = $ruta_db_superior . $dir . '/' . $fileName;

            if (!is_file($finalRoute)) {
                $content = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $binary));
                if (file_put_contents($finalRoute, $content)) {
                    $value = $dir . '/' . $fileName;
                }
            } else {
                $value = $dir . '/' . $fileName;
            }

            if (!$value) {
                $Response->success = 0;
            }
        } else {
            $value = $configuration['valor'];
        }

        $Response->data[] = [
            'name' => $configuration['nombre'],
            'value' => $value
        ];
    }
} else {
    $Response->success = 0;
}

echo json_encode($Response);
