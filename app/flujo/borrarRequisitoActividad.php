<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while($max_salida > 0) {
    if(is_file($ruta . 'db.php')) {
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

if(empty($_REQUEST['fk_actividad'])) {
    $response->message = "No se especificó la actividad";
    echo json_encode($response);
    die();
}

/*
 * data["idnotificacion"] = idnotificacion;
 * data["fk_tipo_destinatario"] = tipodestinatario;
 */
if($_SESSION['idfuncionario'] == $_REQUEST['key']) {

    $idactividad = $_REQUEST['fk_actividad'];

    $eliminados = 0;

    $lista = explode(",", $_REQUEST["ids"]);
    foreach ($lista as $id) {
        $a = ReqCalidadActiv::executeDelete(['fk_actividad' =>$idactividad, "idrequisito_calidad" => $id]);
        if($a) {
            $eliminados++;
        }
    }

    if($eliminados) {
        $response->success = 1;
        $response->message = "Datos eliminados";
        $response->data["pk"] = $eliminados;
    } else {
        $response->message = "Error al borrar!";
    }
} else {
    $response->message = "Usuario incorrecto";
}

echo json_encode($response);
