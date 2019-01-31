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
    'data' => [],
    'message' => '',
    'success' => 0,
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']){
    if(!empty($_REQUEST['term'])){
        $funcionarios = Funcionario::findAllByTerm($_REQUEST['term']);
    }else if(!empty($_REQUEST['defaultUser'])){
        $funcionarios[] = new Funcionario($_REQUEST['defaultUser']);
    }else if(!empty($_REQUEST['documentId'])){
        $funcionarios = Funcionario::findByDocumentTransfer($_REQUEST['documentId']);
    }

    if(count($funcionarios)){
        $data = [];
        
        foreach($funcionarios as $Funcionario){
            $data[] = [
                'id' => $Funcionario->getPK(),
                'text' => $Funcionario->getName()
            ];
        }

        $Response->data = $data;
        $Response->success = 1;
    }else{
        $Response->message = "No se encontraron registros";
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);