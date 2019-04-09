<?php
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

$Response = (object)array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $Anexo = new Anexo($_REQUEST['fileId']);
    $Anexo->eliminado = 1;

    if ($Anexo->save()) {
        $Response->success = 1;
        $Response->message = "Registro eliminado";
    } else {
        $Response->message = "Error al eliminar";
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);
