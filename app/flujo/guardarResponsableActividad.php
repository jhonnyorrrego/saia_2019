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
$response = (object) [
            'data' => [],
            'message' => "",
            'success' => 0
];

if (empty($_REQUEST['fk_actividad'])) {
    $response->message = "No se especificó la actividad";
    echo json_encode($response);
    die();
}

if ($_SESSION['idfuncionario'] == $_REQUEST['key']) {
    if (!empty($_REQUEST['fk_actividad'])) {

        $atributos = [
        "fk_responsable" => $_REQUEST["fk_responsable"],
        "fk_actividad" => $_REQUEST['fk_actividad'],
        "tipo_responsable" => $_REQUEST['tipo_responsable']
        ];
        $pk = ResponsableActividad::newRecord($atributos);
    }
    if ($pk) {
        $response->success = 1;
        $response->message = "Datos almacenados";
        $response->data["pk"] = $pk;
    } else {
        $response->message = "Error al guardar!";
    }
} else {
    $response->message = "Usuario incorrecto";
}

echo json_encode($response);

