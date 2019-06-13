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
include_once $ruta_db_superior . 'core/autoload.php';
$Response = (object) array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 1,
);

if ($_SESSION['idfuncionario'] == $_REQUEST['iduser']) {
    foreach ($_REQUEST['ids'] as $key => $value) {
        $delete = NotaFuncionario::executeUpdate(['estado' => 0], [
            NotaFuncionario::getPrimaryLabel() => $value
        ]);
    }

    $Response->message = "Notas eliminadas";
} else {
    $Response->message = "Usuario inválido";
    $Response->success = 0;
}

echo json_encode($Response);
