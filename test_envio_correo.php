<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
        break;
    }

    $ruta .= '../';
    $max_salida--;
}



include_once $ruta_db_superior . 'core/autoload.php';

$SendMailController = new SendMailController('asunto de pruebas', 'contenido de pruebas');
$SendMailController->setDestinations(
    SendMailController::DESTINATION_TYPE_USERID,
    [1, 6, 10]
);
echo '<pre>';
var_dump($SendMailController->send());
echo '</pre>';
exit;
