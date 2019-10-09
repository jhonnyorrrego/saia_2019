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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$SendMailController = new SendMailController('asunto de pruebas', 'contenido de pruebas');
$SendMailController->setDestinations(
    SendMailController::DESTINATION_TYPE_USERID,
    [1, 6]
);

$SendMailController->setCopyDestinations(
    SendMailController::DESTINATION_TYPE_EMAIL,
    ['cristian.agudelo@cerok.com', 'sebasjsv97@gmail.com']
);

$SendMailController->setHiddenCopyDestinations(
    SendMailController::DESTINATION_TYPE_EMAIL,
    ['andres.agudelo@cerok.com']
);

$SendMailController->setHiddenCopyDestinations(
    SendMailController::DESTINATION_TYPE_EMAIL,
    ['maria.diaz@cerok.com'],
    true
);

$SendMailController->setAttachments(
    SendMailController::ATTACHMENT_TYPE_JSON,
    [
        '{"servidor":"local:\/\/..\/almacenamiento\/","ruta":"2019\/09\/27\/3\/APROBADO\/anexos\/1570073228-580.jpg"}',
        '{"servidor":"local:\/\/..\/almacenamiento\/","ruta":"2019\/09\/27\/3\/APROBADO\/anexos\/1570073228-580.jpg"}'
    ]
);

$SendMailController->setAttachments(
    SendMailController::ATTACHMENT_TYPE_ROUTE,
    [
        'temporal/temporal_cerok/foto_recorte-1.jpg',
        'temporal/temporal_cerok/foto_recorte-456456456.jpg'
    ],
    true
);

var_dump($SendMailController->send());
