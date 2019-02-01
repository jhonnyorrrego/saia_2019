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
    $response->message = "No se especificó notificación";
    echo json_encode($response);
    die();
}

if($_SESSION['idfuncionario'] == $_REQUEST['key']) {
    if(!empty($_REQUEST['fk_actividad'])) {

        $eliminados = 0;

        $lista = explode(",", $_REQUEST["ids"]);
        foreach ($lista as $id) {
            $a = ResponsableActividad::executeDelete(["idresponsable_actividad" => $id]);
            if($a) {
                $eliminados++;
            }
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
