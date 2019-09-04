<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
        break;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object) [
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    $data = (object) $_REQUEST;
    if (!$data->taskId) {
        throw new Exception('Debe indicar una tarea', 1);
    }

    $Tarea = new Tarea($data->taskId);
    if (!$Tarea) {
        throw new Exception("Error Processing Request", 1);
    }

    switch ($data->period) {
        case RecurrenciaTarea::PERIODO_SEMANA:
            $option = $data->week_day;
            break;
        case RecurrenciaTarea::PERIODO_MES:
            $option = $data->month_day;
            break;
        default:
            $option = null;
            break;
    }

    $configuration = (object) [
        'recurrence' => $data->default_recurrence,
        'unity' => $data->unity,
        'period' => $data->period,
        'option' => $option,
    ];

    if ($data->end == RecurrenciaTarea::TERMINAR_FECHA) {
        $configuration->endType = RecurrenciaTarea::TERMINAR_FECHA;
        $configuration->endValue = $data->end_date;
    } else {
        $configuration->endType = RecurrenciaTarea::TERMINAR_ITERACIONES;
        $configuration->endValue = $data->iterations;
    }

    $RecurrenciaTareaController = new RecurrenciaTareaController(
        $Tarea,
        $configuration,
        $data->notifications
    );
    $Response->message = "Recurrencia creada correctamente";
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
