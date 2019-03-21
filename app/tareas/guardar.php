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

$Response = (object)array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 0,
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $Tarea = new Tarea($_REQUEST['task'] ?? null);
    $Tarea->setAttributes([
        'nombre' => $_REQUEST['name'],
        'fecha_inicial' => $_REQUEST['initialDate'],
        'fecha_final' => $_REQUEST['finalDate'],
        'descripcion' => $_REQUEST['description']
    ]);

    if ($Tarea->save()) {
        TareaFuncionario::inactiveRelationsByTask($Tarea->getPK(), 3);
        TareaFuncionario::assignUser($Tarea->getPk(), [$_REQUEST['key']], 3);

        if (isset($_REQUEST['managers'])) {
            TareaFuncionario::inactiveRelationsByTask($Tarea->getPK(), 1);
            TareaFuncionario::assignUser($Tarea->getPk(), $_REQUEST['managers'], 1);
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
                $Response->message = "Error al crear enlace";
                $Response->success = 0;
            } else {
                sendNotification();
                $Response->message = $_REQUEST['task'] ? "Datos actualizados" : "Tarea creada";
                $Response->data = $Tarea->getPK();
                $Response->success = 1;
            }
        } else {
            sendNotification();
            $Response->message = $_REQUEST['task'] ? "Datos actualizados" : "Tarea creada";
            $Response->data = $Tarea->getPK();
            $Response->success = 1;
        }
    } else {
        $Response->message = "Error al guardar";
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);

function sendNotification()
{
    if ($_REQUEST['notification']) {
        $users = $_REQUEST['managers'] ?? [$_REQUEST['key']];
        $ids = implode(',', $users);
        $sql = "select email from funcionario where idfuncionario in({$ids})";
        $records = StaticSql::search($sql);

        $emails = [];
        foreach ($records as $value) {
            $emails[] = $value['email'];
        }
        enviar_mensaje('', ['para' => 'email'], ['para' => $emails], 'Nueva tarea asignada', $_REQUEST['name']);
    }
}
