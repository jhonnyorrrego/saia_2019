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

include_once $ruta_db_superior . 'models/funcionario.php';

$Response = (object) array(
    'data' => new stdClass(),
    'message' => '',
    'success' => 1,
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']){
    $funcionarios = Funcionario::findAllByTerm($_REQUEST['term']);

    if(count($funcionarios)){
        $data = [];
        
        foreach($funcionarios as $Funcionario){
            $data[] = [
                'id' => $Funcionario->getPK(),
                'text' => $Funcionario->getName()
            ];
        }

        $Response->data = $data;
    }else{
        $Response->message = "Error al guardar";
        $Response->success = 0;
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);