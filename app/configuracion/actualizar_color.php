<?php
session_start();

$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object)[
    'success' => 1,
    'message' => '',
    'data' => []
];

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    if ($_REQUEST['color']) {
        $success = Configuracion::executeUpdate([
            'valor' => $_REQUEST['color']
        ], [
            'nombre' => 'color_institucional'
        ]);

        if ($success) {
            createThumbnails();
            $Response->message = 'Datos actualizados';
        } else {
            $Response->success = 0;
            $Response->message = "Error al guardar";
        }
    } else {
        $Response->success = 0;
        $Response->message = 'Debe seleccionar un color';
    }
} else {
    $Response->success = 0;
    $Response->message = 'Debe iniciar sesion';
}

echo json_encode($Response);


function createThumbnails()
{
    global $ruta_db_superior;

    $color = $_REQUEST['color'];
    $sizes = [48, 96, 192];
    $imagine = new Imagine\Gd\Imagine();

    foreach ($sizes as $key => $value) {
        $image = $imagine
            ->open($ruta_db_superior . 'assets/images/logo_saia.png');

        $topLeft = new Imagine\Image\Point(0, 0);
        $box = new Imagine\Image\Box($value, $value);
        $palette = new Imagine\Image\Palette\RGB();
        $canvas = $imagine->create($image->getSize(), $palette->color($color));
        $canvas
            ->paste($image, $topLeft)
            ->resize($box)
            ->save("{$ruta_db_superior}assets/images/logo_saia_{$value}x{$value}.png");
    }

    $content = file_get_contents($ruta_db_superior . 'manifest.json');
    $json = json_decode($content);
    $json->theme_color = $color;
    $json->background_color = $color;
    file_put_contents($ruta_db_superior . 'manifest.json', json_encode($json));
}
