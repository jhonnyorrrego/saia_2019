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

include_once $ruta_db_superior . 'controllers/autoload.php';
$response = (object) [
    'data' => [],
    'message' => "",
    'success' => 0
];

if ($_SESSION['idfuncionario'] == $_REQUEST['key']) {
    if ($_REQUEST['idflujo']) {
        // TODO: Validar si ya existe con el mismo # de version
        $flujo = new Flujo($_REQUEST['idflujo']);
        $flujo->setAttributes([
            "fk_funcionario" => $_REQUEST["key"],
            "nombre" => $_REQUEST["nombre"],
            "descripcion" => $_REQUEST["descripcion"],
            "codigo" => $_REQUEST["codigo"],
            "version" => $_REQUEST["version"],
            "expediente" => $_REQUEST["expediente"],
            // "diagrama" => $_REQUEST["diagrama"],
            // "duracion" => $_REQUEST["duracion"],
            "fecha_modificacion" => date('Y-m-d'),
            "info" => $_REQUEST["info"],
            "version_actual" => 1
        ]);
        $pk = $flujo->save();
    } else {
        $pk = Flujo::newRecord([
            "fk_funcionario" => $_REQUEST["key"],
            "nombre" => $_REQUEST["nombre"],
            "descripcion" => $_REQUEST["descripcion"],
            "codigo" => $_REQUEST["codigo"],
            "version" => $_REQUEST["version"],
            "expediente" => $_REQUEST["expediente"],
            // "diagrama" => $_REQUEST["diagrama"],
            // "duracion" => $_REQUEST["duracion"],
            "fecha_creacion" => date('Y-m-d'),
            "info" => $_REQUEST["info"],
            "version_actual" => 0
        ]);
    }

    // TODO: Procesar los anexos
    if (!empty($pk) && !empty($_REQUEST["anexos_flujo"])) {
        $total = procesarAnexosFlujo($_REQUEST["anexos_flujo"], $pk, $_REQUEST["key"]);
        $response->data["totalAnexos"] = $total;
    }
    if (!empty($pk) && !empty($_REQUEST["formato_flujo"])) {
        $total = procesarFormatosFlujo($_REQUEST["formato_flujo"], $pk);
        $response->data["totalFormatos"] = $total;
    }
    if ($pk) {
        $response->success = 1;
        $response->message = "Datos almacenados";
        $response->data["pk"] = $pk;
    } else {
        $response->message = "Error al guardar!";
    }
} else {
    $response->message = "Usuario incorrecto";
}

echo json_encode($response);

function procesarAnexosFlujo($anexos_tmp, $flujo, $funcionario) {
    $conteoAnexos = 0;
    if (!empty($anexos_tmp)) {
        $anexos = array_map("trim", explode(",", $anexos_tmp));
        foreach ($anexos as $idTemp) {
            $rutaBase = $flujo;
            $dbRoute = UtilitiesController::moverAnexoTemporal($rutaBase, 'anexos_flujos', $idTemp, true);
            if (!empty($dbRoute)) {
                $pkAnexo = AnexoFlujo::newRecord(
                [
                    "fk_flujo" => $flujo,
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

function procesarFormatosFlujo($formato_flujo, $flujo) {
    //formato_flujo, 348,352,272
    $conteoFormatos = 0;
    if (!empty($formato_flujo)) {
        $formatos = array_map("trim", explode(",", $formato_flujo));
        FormatoFlujo::executeDelete(["fk_flujo" => $flujo]);
        foreach ($formatos as $idFmt) {
            $pkFormato = FormatoFlujo::newRecord(
                [
                    "fk_flujo" => $flujo,
                    "fk_formato" => $idFmt
                ]);
            if($pkFormato) {
                $conteoFormatos++;
            }
        }
    }
    return $conteoFormatos;
}
