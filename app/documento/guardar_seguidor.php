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
    'success' => 1,
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $DocumentoFuncionario = DocumentoFuncionario::findByAttributes([
        'fk_documento' => $_REQUEST['documentId'],
        'fk_funcionario' => $_REQUEST['user']
    ]);

    if ($_REQUEST['remove'] && $DocumentoFuncionario) {
        if ($DocumentoFuncionario->toggleRelation(0)) {
            $Response->message = 'Usuario Eliminado';
            $Response->data = $DocumentoFuncionario->getPK();
        } else {
            $Response->message = "Error al guardar";
            $Response->success = 0;
        }
    } else {
        if ($DocumentoFuncionario) {
            $pk = $DocumentoFuncionario->toggleRelation(1);
        } else {
            $pk = DocumentoFuncionario::newRecord([
                'fk_documento' => $_REQUEST['documentId'],
                'fk_funcionario' => $_REQUEST['user'],
                'estado' => 1,
                'fecha' => date('Y-m-d H:i:s'),
                'tipo' => 2
            ]);
        }

        if ($pk) {
            $Response->message = 'Usuario asignado';
        } else {
            $Response->message = 'Error al guardar';
            $Response->success = 0;
        }
    }
} else {
    $Response->message = "Debe iniciar sesion";
    $Response->success = 0;
}

echo json_encode($Response);

