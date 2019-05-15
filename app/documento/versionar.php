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

include_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object)[
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['documentId']) {
        throw new Exception('Documento invalido', 1);
    }

    $documentId = $_REQUEST['documentId'];
    $userId = SessionController::getValue('idfuncionario');
    $Funcionario = new Funcionario($userId);

    $Documento = new Documento($_REQUEST['documentId']);

    $url = PROTOCOLO_CONEXION . RUTA_PDF . "/app/visor/calcular_ruta.php?";
    $url .= http_build_query([
        'key' => $userId,
        'token' => FuncionarioController::generateToken($Funcionario, 5, true),
        'actualizar_pdf' => 1,
        'exportar' => $Documento->getFormat()->exportar,
        'iddoc' => $documentId
    ]);

    $ch = curl_init();
    if (strpos(PROTOCOLO_CONEXION, 'https') !== false) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    }
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = json_decode(curl_exec($ch));
    curl_close($ch);

    $Documento = new Documento($documentId);
    $directory = "{$documentId}/{$Documento->version}";
    $fileName = Anexo::getNameFromJson($Documento->pdf);
    $route = "{$directory}/pdf/{$fileName}";
    $content = StorageUtils::get_file_content($Documento->pdf);
    $fileDbRoute = TemporalController::createFileDbRoute($route, 'versiones', $content);

    $fkVersionDocumento = VersionDocumento::newRecord([
        'documento_iddocumento' => $documentId,
        'fecha' => date('Y-m-d H:i:s'),
        'funcionario_idfuncionario' => $userId,
        'version' => $Documento->version + 1,
        'pdf' => $fileDbRoute //pendiente almacenar en la carpeta de versionamiento
    ]);

    $files = Anexos::findAllByAttributes([
        'documento_iddocumento' => $documentId,
        'estado' => 1,
        'eliminado' => 0
    ]);

    foreach ($files as $key => $Anexo) {
        $Anexo = $Anexo->clone();
        $fileName = Anexo::getNameFromJson($Anexo->ruta);
        $route = "{$directory}/anexos/{$fileName}";
        $content = StorageUtils::get_file_content($Anexo->ruta);
        $route = TemporalController::createFileDbRoute($route, 'versiones', $content);

        $Anexo->setAttributes([
            'fk_anexos' => 0,
            'versionamiento' => 1,
            'documento_iddocumento' => 0
        ]);
        $Anexo->save();

        VersionAnexos::newRecord([
            'documento_iddocumento' => $documentId,
            'ruta' => $route,
            'fk_idversion_documento' => $fkVersionDocumento,
            'anexos_idanexos' => $Anexo->getPK()
        ]);
    }

    $pages = Pagina::findAllByAttributes([
        'id_documento' => $documentId
    ]);

    foreach ($pages as $key => $Pagina) {
        $fileName = Anexo::getNameFromJson($Pagina->ruta);
        $route = "{$directory}/paginas/{$fileName}";
        $content = StorageUtils::get_file_content($Pagina->ruta);
        $page = TemporalController::createFileDbRoute($route, 'versiones', $content);

        $fileName = Anexo::getNameFromJson($Pagina->imagen);
        $route = "{$directory}/paginas/miniaturas/{$fileName}";
        $content = StorageUtils::get_file_content($Pagina->imagen);
        $thumbnail = TemporalController::createFileDbRoute($route, 'versiones', $content);
        VersionPagina::newRecord([
            'documento_iddocumento' => $documentId,
            'ruta' => $page,
            'ruta_miniatura' => $thumbnail,
            'fk_idversion_documento' => $fkVersionDocumento,
            'pagina_idpagina' => $Pagina->getPK()
        ]);
    }

    $Documento->setAttributes([
        'version' => $Documento->version + 1,
        'fk_idversion_documento' => $fkVersionDocumento
    ]);
    $Documento->save();

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
