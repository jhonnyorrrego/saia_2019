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

$Response = (object)[
    'data' => [],
    'message' => '',
    'success' => 0
];

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $totalComments = ComentarioDocumento::countRecords(['fk_documento' => $_REQUEST['documentId']]);
    $totalTasks = DocumentoTarea::countRecords(['fk_documento' => $_REQUEST['documentId']]);
    $totalDocuments = Respuesta::countRecords(['origen' => $_REQUEST['documentId']]);

    $Response->data = [
        'comments' => $totalComments,
        'documents' => $totalDocuments,
        'tasks' => $totalTasks
    ];
    $Response->success = 1;
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);

