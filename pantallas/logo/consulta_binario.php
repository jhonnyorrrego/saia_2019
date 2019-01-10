<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . "db.php";
require_once $ruta_db_superior . 'StorageUtils.php';
require_once $ruta_db_superior . 'filesystem/SaiaStorage.php';

$Response = new stdClass();
$Response->success = 1;
$Response->data = "";

$busca_ruta = busca_filtro_tabla("*", "configuracion a", "a.nombre='logo'", "", $conn);

if($busca_ruta['numcampos']){
    $ruta = $busca_ruta[0]['valor'];
    
    $tipo_almacenamiento = new SaiaStorage("archivos");
    $ruta = json_decode($ruta);
    
    if (is_object($ruta)) {
        if ($tipo_almacenamiento->get_filesystem()->has($ruta->ruta)) {
            $ruta = json_encode($ruta);
            
            $Response->data = StorageUtils::get_binary_file($ruta);
        }
    }else{
        $Response->success = 0;
    }
}else{
    $Response->success = 0;
}

echo json_encode($Response);