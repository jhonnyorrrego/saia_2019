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
include_once $ruta_db_superior . 'formatos/librerias/funciones_generales.php';

$Response = (object)[
    'data' => new stdClass(),
    'message' => "",
    'success' => 1
];

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
            transferencia_automatica(
                null,
                $DocumentoFuncionario->fk_documento,
                $DocumentoFuncionario->getUser()->funcionario_codigo,
                3
            );
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
