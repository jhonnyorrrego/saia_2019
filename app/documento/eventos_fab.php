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
    'message' => '',
    'success' => 0
);

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['documentId']) {
        throw new Exception('Documento invalido', 1);
    }

    $userCode = SessionController::getValue('usuario_actual'); //funcionario_codigo
    $documentId = $_REQUEST['documentId'];

    $sql = <<<SQL
        SELECT
            destino,
            estado,
            numero
        FROM
            buzon_entrada a JOIN
            documento b
            ON
                b.iddocumento = a.archivo_idarchivo
        WHERE
            archivo_idarchivo = {$documentId}
        ORDER BY
            a.idtransferencia ASC
SQL;
    $findMaker = StaticSql::search($sql, 0, 1)[0];

    $editButton = Documento::canEdit($userCode, $documentId);
    $seeManagers = Acceso::findByAttributes([
        'accion' => Acceso::ACCION_ELIMINAR,
        'estado' => 1,
        'tipo_relacion' => Acceso::TIPO_DOCUMENTO,
        'id_relacion' => $documentId,
        'fk_funcionario' => SessionController::getValue('idfuncionario')
    ]);
    $returnButton = false;
    $confirmButton = false;

    $sql = <<<SQL
        SELECT destino
        FROM buzon_entrada
        WHERE
            activo = 1 AND
            archivo_idarchivo = {$documentId} AND 
            nombre = 'POR_APROBAR' AND
            destino= {$userCode}
        ORDER BY idtransferencia
SQL;
    $findCurrent = StaticSql::search($sql);

    if ($findCurrent[0]['destino'] == $userCode) {
        $confirmButton = true;
        if ($findMaker['destino'] == $userCode) {
            $returnButton = false;
        } else {
            $returnButton = true;
        }
    }

    $sql = <<<SQL
        SELECT 
            a.idformato,
            a.nombre,
            a.ruta_editar
        FROM
            formato a JOIN
            documento b ON
            lower(a.nombre) = lower(b.plantilla)
        WHERE
            b.iddocumento = {$documentId}
SQL;
    $formato = StaticSql::search($sql);

    if ($editButton) {
        $editRoute = $ruta_db_superior . FORMATOS_CLIENTE . $formato[0]['nombre'] . '/' . $formato[0]['ruta_editar'];
        $editRoute .= '?' . http_build_query([
            'iddoc' => $documentId,
            'idformato' => $formato[0]['idformato']
        ]);
    }

    if ($returnButton) {
        $returnRoute = $ruta_db_superior . 'class_transferencia.php?';
        $returnRoute .= http_build_query([
            'iddoc' => $documentId,
            'funcion' => 'formato_devolucion'
        ]);
    }

    if ($seeManagers) {
        $managersRoute = 'views/documento/responsables.php?';
        $managersRoute .= http_build_query([
            'documentId' => $documentId,
            'number' => $findMaker['numero']
        ]);
    }

    $Response->data = [
        'showFab' => $seeManagers || $editButton || $returnButton || $confirmButton,
        'managers' => [
            'see' => $seeManagers,
            'route' => $managersRoute
        ],
        'edit' => [
            'see' =>  $editButton,
            'route' => $editRoute ?? ''
        ],
        'return' => [
            'see' =>  $returnButton,
            'route' => $returnRoute ?? ''
        ],
        'confirm' => [
            'see' =>  $confirmButton
        ]
    ];
    $Response->success = 1;
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
