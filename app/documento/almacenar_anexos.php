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
    'data' => new stdClass(),
    'message' => "",
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $data = [];
    foreach ($_REQUEST['routes'] as $route) {
        $content = file_get_contents($ruta_db_superior . $route);
        $routePath = explode('/', $route);
        $extensionParts = explode('.', end($routePath));
        $storageName = time() . '-' . rand(0, 1000) . '.' . end($extensionParts);

        $Documento = new Documento($_REQUEST['documentId']);
        $route = $Documento->estado . '/' . date('Y-m-d') . '/' . $_REQUEST['documentId'] . '/anexos/' . $storageName;
        $dbRoute = TemporalController::createFileDbRoute($route, 'archivos', $content);

        $Anexos = new Anexos();
        $Anexos->setAttributes([
            'documento_iddocumento' => $_REQUEST['documentId'],
            'ruta' => $dbRoute,
            'etiqueta' => end($routePath),
            'tipo' => end($extensionParts),
            'descripcion' => $_REQUEST['description'],
            'fecha_anexo' => date('Y-m-d H:i:s'),
            'fk_funcionario' => $_REQUEST['key']
        ]);

        if($_REQUEST['fileId']){
            $OldRecord = new Anexos($_REQUEST['fileId']);
            $OldRecord->storage();            

            $Anexos->setAttributes([
                'version' => ++$OldRecord->version,
                'fk_anexos' => $OldRecord->fk_anexos
            ]);
        }

        if ($Anexos->save()) {
            if(!$Anexos->fk_anexos){
                Anexos::executeUpdate([
                    'fk_anexos' => $Anexos->getPK()
                ], [
                    Anexos::getPrimaryLabel() => $Anexos->getPK()
                ]);
            }

            $data[] = $Anexos->getPK();
        }
    }

    if (count($data)) {
        $Response->message = 'Anexos cargados';
        $Response->success = 1;
    } else {
        $Response->message = 'Imposible guardar';
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);