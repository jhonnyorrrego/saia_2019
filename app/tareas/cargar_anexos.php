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

$Response = (object) array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 1,
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $dir = $ruta_db_superior . $_SESSION["ruta_temp_funcionario"];

    if (!is_dir($dir)) {
        mkdir($dir, 0777);
    }else{
        chmod($dir, 0777);
    }

    $temporalRoutes = [];
    foreach($_FILES as $key => $file){
        $name = rand(0, 10000) . '.' . $file['name'];

        $content = file_get_contents($file['tmp_name']);
        if(file_put_contents($dir . $name, $content) !== false){
            $temporalRoutes[] = $name;            
        }
    }

    if(count($temporalRoutes)){
        $Response->data = $temporalRoutes;
        $Response->message = 'Documentos almacenado en el temporal';
    }else{
        $Response->message = 'Imposible guardar';
        $Response->success = 0;
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);