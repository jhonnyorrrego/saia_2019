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
$response = array(
    'data' => [],
    'message' => "",
    'success' => 0
);

if ($_SESSION['idfuncionario'] == $_REQUEST['key']) {
    if ($_REQUEST['id']) {
        //TODO: Validar si ya existe con el mismo # de version
        $flujo = new Flujo($_REQUEST['id']);
        $flujo->setAttributes([
            //'fk_funcionario' => $_REQUEST['key'],
            "nombre" => $_REQUEST["nombre"],
            "descripcion" => $_REQUEST["descripcion"],
            "codigo" => $_REQUEST["codigo"],
            "version" => $_REQUEST["version"],
            "expediente" => $_REQUEST["expediente"],
            //"diagrama" => $_REQUEST["diagrama"],
            //"duracion" => $_REQUEST["duracion"],
            "fecha_modificacion" => date('Y-m-d'),
            "fecha_modificacion" => $_REQUEST["fecha_modificacion"],
            "info" => $_REQUEST["info"],
            "version_actual" => 1
        ]);
        $pk = $flujo->save();
    } else {
        $pk = Flujo::newRecord([
            //'fk_funcionario' => $_REQUEST['key'],
            "nombre" => $_REQUEST["nombre"],
            "descripcion" => $_REQUEST["descripcion"],
            "codigo" => $_REQUEST["codigo"],
            "version" => $_REQUEST["version"],
            "expediente" => $_REQUEST["expediente"],
            //"diagrama" => $_REQUEST["diagrama"],
            //"duracion" => $_REQUEST["duracion"],
            "fecha_creacion" => date('Y-m-d'),
            "info" => $_REQUEST["info"],
            "version_actual" => 1
        ]);
    }

    if ($pk) {
        $response->success = 1;
        $response->message = "Datos almacenados";
        $response->data = $pk;
    } else {
        $response->message = "Error al guardar!";
    }
} else {
    $response->message = "Usuario invalido";
}

echo json_encode($response);
