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

$Response = (object)array(
    'data' => [],
    'message' => "",
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    global $conn;

    $userCode = $_SESSION["usuario_actual"]; //funcionario_codigo
    $documentId = $_REQUEST['documentId'];
    $seePreviousManagers = false;
    $seeManagers = false;
    $editButton = false;
    $returnButton = false;
    $confirmButton = true;

    $permissions = array();
    $findPermissions = busca_filtro_tabla("", "permiso_documento", "funcionario='" . $userCode . "' AND documento_iddocumento=" . $documentId, "", $conn);
    if ($findPermissions["numcampos"]) {
        $permissions = explode(",", $findPermissions[0]["permisos"]);
    }

    $findManager = busca_filtro_tabla("destino,estado,plantilla", "buzon_entrada,documento", "iddocumento=archivo_idarchivo and archivo_idarchivo=" . $documentId, "buzon_entrada.idtransferencia asc", $conn);

    if ($findManager["numcampos"]) {
        if ($findManager[0]["estado"] == "ACTIVO") {
            $seePreviousManagers = true;
        }

        if (in_array("m", $permissions)) {
            if (!$_REQUEST["vista"]) {
                $editButton = true;
            }
        }

        $findCurrent = busca_filtro_tabla("A.idtransferencia as idtrans,A.destino,A.ruta_idruta", "buzon_entrada A", "A.activo=1 and A.archivo_idarchivo=" . $documentId . " and (A.nombre='POR_APROBAR') and A.destino='" . $userCode . "'", "A.idtransferencia", $conn);
        if ($findCurrent["numcampos"]) {
            $findPrevious = busca_filtro_tabla("A.idtransferencia,A.ruta_idruta", "buzon_entrada A", "A.idtransferencia <" . $findCurrent[0]["idtrans"] . " and A.nombre='POR_APROBAR' and A.activo=1 and A.archivo_idarchivo=" . $documentId . " and origen='" . $userCode . "'", "", $conn);
        }

        if ($findManager["numcampos"] > 0 && $findManager[0]["destino"] != $userCode) {
            $returnButton = true;
        }

        if ($findCurrent[0]["destino"] != $userCode || $findPrevious["numcampos"]) {
            $seeManagers = false;
            if ($seePreviousManagers && in_array("r", $permissions)) {
                $seeManagers = true;
            }
            $confirmButton = false;
            $returnButton = false;
        }
        if ($seePreviousManagers && in_array("r", $permissions)) {
            if ($_REQUEST["vista"] == "") {
                $seeManagers = true;
            }
        }
    }

    $sql = "select a.idformato,a.nombre,a.ruta_editar from formato a join documento b on lower(a.nombre) = lower(b.plantilla) where b.iddocumento = {$documentId}";
    $formato = StaticSql::search($sql);

    $editRoute = $ruta_db_superior . FORMATOS_CLIENTE . $formato[0]['nombre'] . '/' . $formato[0]['ruta_editar'];
    $editRoute .= '?' . http_build_query([
        'iddoc' => $documentId,
        'idformato' => $formato[0]['idformato']
    ]);

    $Response->data = [
        'showFab' => $seeManagers || $editButton || $returnButton || $confirmButton,
        "managers" => [
            'see' => $seeManagers,
            'route' => "{$ruta_db_superior}mostrar_ruta.php?doc={$documentId}"
        ],
        "edit" => [
            'see' =>  $editButton,
            'route' => $editRoute
        ],
        "return" => [
            'see' =>  $returnButton,
            'route' => "{$ruta_db_superior}class_transferencia.php?iddoc={$documentId}&funcion=formato_devolucion"
        ],
        "confirm" => [
            'see' =>  $confirmButton
        ]
    ];
    $Response->success = 1;
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);
