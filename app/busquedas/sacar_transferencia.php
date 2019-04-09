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

$Response = (object)[
    'success' => 0,
    'message' => '',
    'data' => []
];

if ($_SESSION['idfuncionario'] && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $sql = "select idtransferencia from buzon_salida where idtransferencia = {$_REQUEST['transfer']} and destino = {$_REQUEST['key']}";
    $records = Conexion::getConnection()->executeSelect($sql);

    $documentList = implode(',', $_REQUEST['selections']);
    if (count($records)) {//recibidos
        $sql = "update buzon_salida set recibido = 0 where archivo_idarchivo in ({$documentList}) and destino={$_REQUEST['key']}";
    } else {//enviados
        $sql = "update buzon_salida set enviado = 0 where archivo_idarchivo in ({$documentList}) and origen={$_REQUEST['key']}";
    }
    
    $update = Conexion::getConnection()->Ejecutar_Sql($sql);

    if ($update) {
        $trashId = Etiqueta::getUserTrashId($_REQUEST['key']);
        foreach ($_REQUEST['selections'] as $key => $documentId) {
            EtiquetaDocumento::newRecord([
                'fk_etiqueta' => $trashId,
                'fk_documento' => $documentId
            ]);
        }

        $Response->message = "Documentos removidos";
        $Response->success = 1;
    } else {
        $Response->message = "Error al remover";
    }
} else {
    $Response->message = 'Debe iniciar sesion';
}

echo json_encode($Response);