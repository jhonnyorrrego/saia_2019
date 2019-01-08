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

$Response = (object) [
    'data' => [],
    'message' => "",
    'success' => 0
];

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $data = AnexoTarea::findAllByAttributes([
        'estado' => 1,
        'fk_tarea' => $_REQUEST['task']
    ], [], AnexoTarea::getPrimaryLabel() . ' desc');

    foreach ($data as $AnexoTarea) {
        $Response->data [] = [
            'id' => $AnexoTarea->getPK(),
            'user' => $AnexoTarea->getUser()->getName(),
            'date' => $AnexoTarea->getDate(),
            'size' => $AnexoTarea->getFileSize(),
            'name' => $AnexoTarea->getFileName(),
            'version' => $AnexoTarea->getVersion(),
            'description' => $AnexoTarea->getDescription()
        ];
    }

    $Response->success = 1;
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);