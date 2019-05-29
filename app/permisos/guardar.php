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
    'success' => 1,
    'message' => '',
    'data' => (object)array()
);

if($_SESSION['idfuncionario'] == $_REQUEST['key']){
    if($_REQUEST['idPerfil'])
        $Perfil = new Perfil($_REQUEST['idPerfil']);
    else
        $Perfil = new Perfil();

    $Perfil->setAttributes([
        'nombre' => $_REQUEST['nombre']
    ]);
  
    if(!$Perfil->save()){
        $Response->success = 0;
        $Response->message = "Error al guardar";
    }else{
        $Response->data = $Perfil->getPk();
    }
}else{
    $Response->success = 0;
    $Response->message = 'Debe iniciar session';
}

echo json_encode($Response);