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

$Response = (object)array(
    'data' => [],
    'message' => "",
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $params = (object)$_REQUEST['params'];

    if ($params->tipo && $params->idtipo) {
        $data = VisorNota::findByDocument($params->tipo, $params->idtipo);

        foreach ($data->notes as $key => $VisorNota) {
            $Response->data[] = [
                'class' => $VisorNota->class,
                'page' => (int)$VisorNota->page,
                'type' => $VisorNota->type,
                'uuid' => $VisorNota->uuid,
                'x' => (int)$VisorNota->x,
                'y' => (int)$VisorNota->y
            ];
        }
        foreach ($data->comments as $key => $VisorComentario) {
            $Response->data[] = [
                'annotation' => $VisorComentario->annotation,
                'class' => $VisorComentario->class,
                'content' => $VisorComentario->content,
                'uuid' => $VisorComentario->uuid
            ];
        }
        $Response->success = 1;
    } else {
        $Response->message = 'Error al buscar';
    }
} else {
    $Response->message = "Debe iniciar sesion";
    $Response->success = 0;
}

echo json_encode($Response);