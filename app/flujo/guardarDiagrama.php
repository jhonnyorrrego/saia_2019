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

if ($_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $xml = null;
    if ($_REQUEST['idflujo']) {
        if(empty($_REQUEST["datos"])) {
            $response->message = "Falta el diagrama!";
            echo json_encode($response);
            die();
        } else {
            $xml = $_REQUEST["datos"];
            $flujo = new Flujo($_REQUEST['idflujo']);
            $flujo->setAttributes([
                "fk_funcionario" => $_REQUEST["key"],
                "diagrama" => $xml,
                "fecha_modificacion" => date('Y-m-d'),
            ]);
            $pk = $flujo->save();
        }
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