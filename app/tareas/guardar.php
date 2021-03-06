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

    $Tarea = new Tarea($_REQUEST['task'] ?? null);
    $Tarea->setAttributes([
        'nombre' => $_REQUEST['name'],
        'fecha_inicial' => $_REQUEST['initialDate'],
        'fecha_final' => $_REQUEST['finalDate'],
        'descripcion' => $_REQUEST['description']
    ]);

    if (!$Tarea->save()) {
        throw new Exception("Error al guardar", 1);
    }

    TareaFuncionario::inactiveRelationsByTask(
        $Tarea->getPK(),
        TareaFuncionario::TIPO_CREADOR
    );
    TareaFuncionario::assignUser(
        $Tarea->getPk(),
        [$_REQUEST['key']],
        TareaFuncionario::TIPO_CREADOR
    );

    if (isset($_REQUEST['managers'])) {
        TareaFuncionario::inactiveRelationsByTask(
            $Tarea->getPK(),
            TareaFuncionario::TIPO_RESPONSABLE
        );
        TareaFuncionario::assignUser(
            $Tarea->getPk(),
            $_REQUEST['managers'],
            TareaFuncionario::TIPO_RESPONSABLE
        );
    }

    if (!empty($_REQUEST['documentId'])) {
        $pk = DocumentoTarea::newRecord([
            'fk_tarea' => $Tarea->getPK(),
            'fk_documento' => $_REQUEST['documentId'],
            'fk_funcionario' => $_REQUEST['key'],
            'fecha' => date('Y-m-d H:i:s'),
            'estado' => 1
        ]);

        if (!$pk) {
            throw new Exception("Error al crear enlace", 1);
        }

        sendNotification($Tarea);
        $Response->message = $_REQUEST['task'] ? "Datos actualizados" : "Tarea creada";
        $Response->data = $Tarea->getPK();
        $Response->success = 1;
    } else {
        sendNotification($Tarea);
        $Response->message = $_REQUEST['task'] ? "Datos actualizados" : "Tarea creada";
        $Response->data = $Tarea->getPK();
        $Response->success = 1;
    }

    $notifications = json_encode([
        [
            'origin' => 1,
            'destination' => 6,
            'date' => date('Y-m-d H:i:s'),
            'description' => 'desc',
            'type' => Notificacion::TIPO_DOCUMENTO,
            'typeId' => 1,
        ], [
            'origin' => 1,
            'destination' => 6,
            'date' => date('Y-m-d H:i:s'),
            'description' => 'desc',
            'type' => Notificacion::TIPO_DOCUMENTO,
            'typeId' => 1,
        ], [
            'origin' => 1,
            'destination' => 9,
            'date' => date('Y-m-d H:i:s'),
            'description' => 'desc',
            'type' => Notificacion::TIPO_DOCUMENTO,
            'typeId' => 1,
        ]
    ]);

    $Response->notifications = CriptoController::encrypt_blowfish($notifications);
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);

function sendNotification($Tarea)
{
    if ($_REQUEST['notification']) {
        $users = TareaFuncionario::findUsersByType(
            $Tarea->getPK(),
            TareaFuncionario::TIPO_RESPONSABLE
        );

        $emails = [];
        foreach ($users as $Funcionario) {
            $emails[] = $Funcionario->email;
        }

        $icsRoute = generateIcs($Tarea);
        $body = $Tarea->getName() . ' - ' . $Tarea->descripcion;
        $SendMailController = new SendMailController('Nueva tarea asignada', $body);
        $SendMailController->setDestinations(
            SendMailController::DESTINATION_TYPE_EMAIL,
            $emails
        );
        $SendMailController->setAttachments(
            SendMailController::ATTACHMENT_TYPE_ROUTE,
            [$icsRoute]
        );
        $SendMailController->send();
    }
}

function generateIcs($Tarea)
{
    global $ruta_db_superior;

    $properties = [
        'description' => $Tarea->descripcion,
        'dtstart' => $Tarea->fecha_inicial,
        'dtend' => $Tarea->fecha_final,
        'summary' => $Tarea->getName(),
        'organizer' => usuario_actual('email')
    ];

    $ics = new IcsController($properties);
    $content = $ics->to_string();

    $route = $ruta_db_superior . $_SESSION['ruta_temp_funcionario'] . '/tarea.ics';
    return file_put_contents($route, $content) ? $route : '';
}
