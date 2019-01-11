<?php
session_start();

use Imagine\Image\Box;
use Imagine\Image\Point;

$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

require_once $ruta_db_superior . 'vendor/autoload.php';
require_once $ruta_db_superior . 'StorageUtils.php';
require_once $ruta_db_superior . 'filesystem/SaiaStorage.php';
include_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object) array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 1,
);

if (isset($_SESSION['idfuncionario']) && $_REQUEST) {
    $x1 = $_REQUEST['x1'];
    $y1 = $_REQUEST['y1'];
    $width = $_REQUEST['width'];
    $height = $_REQUEST['height'];

    $Funcionario = new Funcionario($_SESSION['idfuncionario']);
    $routeImage =  $Funcionario->getImage('foto_original');

    $imagine = new Imagine\Gd\Imagine();
    $imagine
        ->open($ruta_db_superior . $routeImage)
        ->resize(new Box($_REQUEST['imageWidth'], $_REQUEST['imageHeight']))
        ->crop(new Point($x1, $y1), new Box($width, $height))
        ->resize(new Box($width, $height))
        ->save($ruta_db_superior . $routeImage);

    $splitRoute = explode('.', $routeImage);
    $extention = $splitRoute[count($splitRoute) - 1];

    $image = array(
        'binary' => file_get_contents($ruta_db_superior . $routeImage),
        'extention' => $extention
    );

    if($Funcionario->updateImage($image, 'foto_recorte')){
        $Response->data = array(
            'foto_original' => $Funcionario->getImage('foto_original', true),
            'foto_recorte' => $Funcionario->getImage('foto_recorte', true)
        );
        $Response->success = 1;
        $Response->message = "Imagen Recortada";
    }else{
        $Response->success = 0;
        $Response->message = "Error";
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);
