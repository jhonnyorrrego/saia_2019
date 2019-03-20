<?php
session_start();

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

$response = (object)array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $data = [];
    foreach ($_REQUEST['archivos'] as $archivo) {
        $content = file_get_contents($ruta_db_superior . $archivo);
        $routePath = explode('/', $archivo);
        $extensionParts = explode('.', end($routePath));
        $storageName = time() . '-' . rand(0, 1000) . '.' . end($extensionParts);
        $archivo = date('Y') . '/' . date('m') . '/' . date('d') . '/' . $_REQUEST['id'] . '/' . $storageName;
        $dbRoute = TemporalController::createFileDbRoute($archivo, 'anexos_flujos', $content);

        $anexo = new Anexo();
        $anexo->setAttributes([
            'ruta' => $dbRoute,
            'etiqueta' => end($routePath),
            'nombre' => $storageName,
            'extension' => end($extensionParts),
            'descripcion' => $_REQUEST['descripcion']
        ]);

        if($_REQUEST['fileId']){
            $regAnt = new Anexo($_REQUEST['fileId']);
            $regAnt->storage();            

            $anexo->setAttributes([
                'version' => ++$regAnt->version,
                'fk_anexo' => $regAnt->getPK()
            ]);
        }

        if ($anexo->save()) {
            $class = $_REQUEST['modelName'];
            $data[] = $class::newRecord([
                'fk_anexo' => $anexo->getPK(),
                $_REQUEST['fkName'] => $_REQUEST['id']
            ]);
        }
    }

    if (count($data)) {
        $response->message = 'Anexos cargados';
        $response->success = 1;
    } else {
        $response->message = 'Imposible guardar';
    }
} else {
    $response->message = "Debe iniciar sesion";
}

echo json_encode($response);