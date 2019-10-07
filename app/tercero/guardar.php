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

    if (!$_REQUEST['tipo']) {
        throw new Exception("Debe indicar el tipo de tercero", 1);
    }

    if ($_REQUEST['userId']) { //editar
        $Tercero = new Tercero($_REQUEST['userId']);
    } else if ($_REQUEST['identificacion']) {
        $Tercero = Tercero::findByAttributes([
            'identificacion' => $_REQUEST['identificacion'],
            'estado' => 1
        ]);
    }

    if ($Tercero) {
        if ($_REQUEST['tipo'] == TERCERO::TIPO_NATURAL) {
            $edit = $_REQUEST['identificacion'] == $Tercero->identificacion;
        } else {
            $edit =
                $_REQUEST['identificacion'] == $Tercero->identificacion &&
                $_REQUEST['nombre'] == $Tercero->nombre &&
                $_REQUEST['sede'] == $Tercero->sede;
        }

        if ($edit) {
            $Tercero->estado = 0;
            $Tercero->save();
        }
    }

    $Tercero = new Tercero();
    $Tercero->setAttributes($_REQUEST);

    if (!$Tercero->save()) {
        throw new Exception("Error al guardar", 1);
    }

    $Response->message = "Tercero actualizado";
    $Response->data->userId = $Tercero->getPK();
    $Response->data->name = $Tercero->nombre;
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
