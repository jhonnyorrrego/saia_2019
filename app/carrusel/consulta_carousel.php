<?php
use Imagine\Image\Box;

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
require_once $ruta_db_superior . 'vendor/autoload.php';
require_once $ruta_db_superior . 'StorageUtils.php';
require_once $ruta_db_superior . 'filesystem/SaiaStorage.php';

$imagine = new Imagine\Gd\Imagine();
$Response = new stdClass();
$Response->success = 1;
$Response->data = array();

$carousel_content = busca_filtro_tabla("imagen,nombre,contenido,idcontenidos_carrusel as id", "contenidos_carrusel", "'" . date('Y-m-d') . "'<=" . fecha_db_obtener("fecha_fin", "Y-m-d") . " and '" . date('Y-m-d') . "'>=" . fecha_db_obtener("fecha_inicio", "Y-m-d"), "", $conn);

if ($carousel_content['numcampos']) {
    $Storage = new SaiaStorage("archivos");

    for ($i = 0; $i < $carousel_content['numcampos']; $i++) {
        $Image = json_decode($carousel_content[$i]['imagen']);

        if (is_object($Image)) {
            if ($Storage->get_filesystem()->has($Image->ruta)) {
                $binary = StorageUtils::get_binary_file($carousel_content[$i]['imagen']);
                                
                if (!is_dir($ruta_db_superior . 'temporal/temporal_carousel')) {
                    mkdir($ruta_db_superior . 'temporal/temporal_carousel', 0777);
                }

                $route = explode('/', $Image->ruta);
                $fileName = $route[count($route) - 1];
                $finalRoute = $ruta_db_superior . 'temporal/temporal_carousel/' . $fileName;

                if(!is_file($finalRoute)){
                    $file = fopen($finalRoute, 'a+');
                    
                    if ($file) {
                        $content = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $binary));
                        fwrite($file, $content);
                        fclose($file);
                    }

                    $imagine->open($finalRoute)
                        ->resize(new Box(900, 630))
                        ->save($finalRoute);

                }

                $Response->data[$i] = array(
                    'image' => 'temporal/temporal_carousel/' . $fileName,
                    'title' => $carousel_content[$i]['nombre'],
                    'content' => $carousel_content[$i]['contenido'],
                );
            }
        }
    }
} else {
    $Response->success = 0;
}

echo json_encode($Response);
