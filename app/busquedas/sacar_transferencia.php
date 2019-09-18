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

$Response = (object) [
    'success' => 0,
    'message' => '',
    'data' => []
];

if ($_SESSION['idfuncionario'] && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $BuzonSalida = new BuzonSalida($_REQUEST['transfer']);
    $documentList = implode(',', $_REQUEST['selections']);

    if ($BuzonSalida && $BuzonSalida->destino == $_REQUEST['key']) { //recibidos
        $update = Model::getQueryBuilder()
            ->update('buzon_salida')
            ->set('recibido', 0)
            ->where('archivo_idarchivo in (:documentList')
            ->andWhere('destino = :key')
            ->setParameter(':documentList', $_REQUEST['selections'], \Doctrine\DBAL\Connection::PARAM_INT_ARRAY)
            ->setParameter('key', $_REQUEST['key'],  \Doctrine\DBAL\Types\Type::INTEGER)
            ->execute();
    } else { //enviados
        $update = Model::getQueryBuilder()
            ->update('buzon_salida')
            ->set('enviado', 0)
            ->where('archivo_idarchivo in (:documentList')
            ->andWhere('origen = :key')
            ->setParameter(':documentList', $_REQUEST['selections'], \Doctrine\DBAL\Connection::PARAM_INT_ARRAY)
            ->setParameter('key', $_REQUEST['key'],  \Doctrine\DBAL\Types\Type::INTEGER)
            ->execute();
    }

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
