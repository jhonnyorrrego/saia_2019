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
$response = (object) [
    'data' => [],
    'message' => "",
    'success' => 0
];

if (empty($_REQUEST['idnotificacion'])) {
    $response->message = "No se especificó la notificación";
    echo json_encode($response);
    die();
}

if ($_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $idnotificacion = $_REQUEST['idnotificacion'];
    ActividadNotificacion::executeDelete(["fk_notificacion" => $idnotificacion]);

    AnexoNotificacion::executeDelete(["fk_notificacion" => $idnotificacion]);

    AdjuntoNotificacion::executeDelete(["fk_notificacion" => $idnotificacion]);

    $destinatario = new DestinatarioNotificacion();
    $destinatario->setAttributes(["fk_notificacion" => $idnotificacion]);
    $destinos = $destinatario->findByNotificacion();
    foreach ($destinos as $destino) {
        DestinatarioCampoFormato::executeDelete(["iddestinatario" => $destino->iddestinatario]);
        DestinatarioExterno::executeDelete(["iddestinatario" => $destino->iddestinatario]);
        DestinatarioSaia::executeDelete(["iddestinatario" => $destino->iddestinatario]);
        DestinatarioNotificacion::executeDelete(["iddestinatario" => $destino->iddestinatario]);
    }

    $pk = Notificacion::executeDelete(["idnotificacion" => $idnotificacion]);
    if ($pk) {
        $response->success = 1;
        $response->message = "Datos eliminados";
        $response->data["pk"] = $pk;
    } else {
        $response->message = "Error al eliminar!";
    }
} else {
    $response->message = "Usuario incorrecto";
}

echo json_encode($response);
