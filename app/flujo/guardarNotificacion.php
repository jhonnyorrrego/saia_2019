<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while($max_salida > 0) {
    if(is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'controllers/autoload.php';
$response = (object) [
    'data' => [],
    'message' => "",
    'success' => 0
];

if($_REQUEST['idflujo']) {
    $response['message'] = "No se especificó el flujo";
    echo json_encode($response);
    die();
}

if($_SESSION['idfuncionario'] == $_REQUEST['key']) {
    if($_REQUEST['idnotificacion']) {
        // TODO: Validar si ya existe con el mismo # de version
        $flujo = new Notificacion($_REQUEST['idnotificacion']);

        $flujo->setAttributes([
            "fk_flujo" => $_REQUEST['idflujo'],
            "fk_evento_notificacion" => $_REQUEST["idevento_notificacion"],
            "asunto" => $_REQUEST["asunto"],
            "cuerpo" => $_REQUEST["cuerpo"]
        ]);
        $flujo->save();
        $pk = $_REQUEST['idnotificacion'];
    } else {
        $pk = Notificacion::newRecord([
            "fk_flujo" => $_REQUEST['idflujo'],
            "asunto" => $_REQUEST["asunto"],
            "cuerpo" => $_REQUEST["cuerpo"]
        ]);
    }

    if(!empty($pk) && !empty($_REQUEST["actividad_evento"])) {
        $pk = ActividadNotificacion::newRecord([
            "fk_actividad" => $_REQUEST['actividad_evento'],
            "fk_notificacion" => $pk
        ]);
    }
    if(!empty($pk) && !empty($_REQUEST["anexos_notificacion"])) {
        $total = procesarAnexosNotificacion($_REQUEST["anexos_notificacion"], $pk, $_REQUEST["key"]);
        $response->data["totalAnexos"] = $total;
    }
    if(!empty($pk) && !empty($_REQUEST["formato_notificacion"])) {
        $total = procesarFormatosNotificacion($_REQUEST["formato_notificacion"], $pk);
        $response->data["totalFormatos"] = $total;
    }
}

function procesarAnexosNotificacion($anexos_tmp, $notificacion, $funcionario) {
    $conteoAnexos = 0;
    if(!empty($anexos_tmp)) {
        $anexos = array_map("trim", explode(",", $anexos_tmp));
        foreach($anexos as $idTemp) {
            $rutaBase = $notificacion;
            $dbRoute = UtilitiesController::moverAnexoTemporal($rutaBase, 'anexos_notificacion', $idTemp, true);
            if(!empty($dbRoute)) {
                $pkAnexo = AnexoNotificacion::newRecord([
                    "fk_notificacion" => $notificacion,
                    "ruta" => json_encode($dbRoute),
                    "fecha" => date('Y-m-d'),
                    "fk_funcionario" => $funcionario
                ]);
                if($pkAnexo) {
                    $conteoAnexos++;
                }
            }
        }
    }
    return $conteoAnexos;
}

function procesarFormatosNotificacion($formato_flujo, $notificacion) {
    // formato_flujo, 348,352,272
    $conteoFormatos = 0;
    if(!empty($formato_flujo)) {
        $formatos = array_map("trim", explode(",", $formato_flujo));
        AdjuntoNotificacion::executeDelete([
            "fk_notificacion" => $notificacion
        ]);
        foreach($formatos as $idFmt) {
            $pkFormato = AdjuntoNotificacion::newRecord([
                "fk_notificacion" => $notificacion,
                "fk_formato_flujo" => $idFmt
            ]);
            if($pkFormato) {
                $conteoFormatos++;
            }
        }
    }
    return $conteoFormatos;
}