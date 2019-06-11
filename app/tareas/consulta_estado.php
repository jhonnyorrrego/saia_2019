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

$Response = (object)[
    'data' => [],
    'message' => "",
    'success' => 1,
];

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $states = TareaEstado::findAllByAttributes([
        'fk_tarea' => $_REQUEST['task']
    ], [], 'idtarea_estado desc');

    foreach ($states as $key => $TareaEstado) {
        $Response->data[] = [
            'id' => $TareaEstado->getPK(),
            'date' => $TareaEstado->getDateAttribute('fecha'),
            'user' => $TareaEstado->getUser()->getName(),
            'stateLabel' => TareaEstado::getState($TareaEstado->valor),
            'description' => $TareaEstado->descripcion,
            'value' => $TareaEstado->valor,
            'state' => $TareaEstado->estado
        ];
    }
} else {
    $Response->message = "Debe iniciar sesion";
    $Response->success = 0;
}

echo json_encode($Response);

