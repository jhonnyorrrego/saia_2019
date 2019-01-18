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
include_once $ruta_db_superior . 'pantallas/generador/librerias_pantalla.php';

$Response = (object) array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
   $contenido_funcion = carga_vista_previa($_REQUEST['idpantalla']);
   $Response->data = $contenido_funcion;
   $Response->success = 1;
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);