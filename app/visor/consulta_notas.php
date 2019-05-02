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
    'data' => [],
    'message' => "",
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    if ($_REQUEST['type'] && $_REQUEST['typeId']) {
        eval('$type = VisorNota::' . $_REQUEST['type'] . ';');
        $data = VisorNota::findByDocument($type, $_REQUEST['typeId']);

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
                'content' => html_entity_decode($VisorComentario->content),
                'uuid' => $VisorComentario->uuid,
                'user' => [
                    'key' => $VisorComentario->getUser()->getPK(),
                    'name' => $VisorComentario->getUser()->getName(),
                    'image' => $VisorComentario->getUser()->getImage('foto_recorte')
                ],
                'date' => $VisorComentario->getDateAttribute('fecha')
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

