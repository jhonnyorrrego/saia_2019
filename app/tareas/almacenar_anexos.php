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
        $route = date('Y') . '/' . date('m') . '/' . date('d') . '/' . $_REQUEST['task'] . '/' . $storageName;
        $dbRoute = TemporalController::createFileDbRoute($route, 'anexos_tareas', $content);

        $Anexo = new Anexo();
        $Anexo->setAttributes([
            'ruta' => $dbRoute,
            'etiqueta' => end($routePath),
            'nombre' => $storageName,
            'extension' => end($extensionParts),
            'descripcion' => $_REQUEST['description']
        ]);

        if($_REQUEST['fileId']){
            $OldRecord = new Anexo($_REQUEST['fileId']);
            $OldRecord->storage();            

            $Anexo->setAttributes([
                'version' => ++$OldRecord->version,
                'fk_anexo' => $OldRecord->fk_anexo
            ]);
        }

        if ($Anexo->save()) {
            if(!$Anexo->fk_anexo){
                Anexo::executeUpdate([
                    'fk_anexo' => $Anexo->getPK()
                ], [
                    Anexo::getPrimaryLabel() => $Anexo->getPK()
                ]);
            }

            $data[] = TareaAnexo::newRecord([
                'fk_anexo' => $Anexo->getPK(),
                'fk_tarea' => $_REQUEST['task']
            ]);
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