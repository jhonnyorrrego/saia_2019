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

$Response = (object)[
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    $edit = !empty($_REQUEST['userId']);

    if ($edit) {
        $ReferenceEjecutor = new Ejecutor($_REQUEST['userId']);
        $ReferenceDatosEjecutor = $ReferenceEjecutor->getUserData();

        $Ejecutor = $ReferenceEjecutor->clone();
        $DatosEjecutor = $ReferenceDatosEjecutor->clone();

        $ReferenceEjecutor->estado = 0;
        $ReferenceEjecutor->save();
    } else {
        $Ejecutor = new Ejecutor();
        $DatosEjecutor = new DatosEjecutor();
    }

    $data = UtilitiesController::cleanForm([
        'identificacion' => $_REQUEST['identificacion'],
        'nombre' => $_REQUEST['nombre'],
        'tipo_ejecutor' => $_REQUEST['tipo_ejecutor'],
        'fecha_ingreso' => date('Y-m-d H:i:s'),
        'estado' => 1
    ]);
    $Ejecutor->setAttributes($data);

    if (!$Ejecutor->save()) {
        throw new Exception("Error al crear el tercero", 1);
    }

    $data = UtilitiesController::cleanForm([
        'ejecutor_idejecutor' => $Ejecutor->getPK(),
        'direccion' => $_REQUEST['direccion'],
        'telefono' => $_REQUEST['telefono'],
        'cargo' => $_REQUEST['cargo'],
        'ciudad' => $_REQUEST['ciudad'],
        'titulo' => $_REQUEST['titulo'],
        'email' => $_REQUEST['email']
    ]);
    $DatosEjecutor->setAttributes($data);

    if (!$DatosEjecutor->save()) {
        throw new Exception("Error al vincular los datos", 1);
    }

    $Response->message = $edit ? "Tercero actualizado" : "Tercero creado";
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
