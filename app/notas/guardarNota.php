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
$Response = (object) array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 0,
);

if ($_SESSION['idfuncionario'] == $_REQUEST['key']) {
    if($_REQUEST['id']){
        $NotaFuncionario = new NotaFuncionario($_REQUEST['id']);
        $NotaFuncionario->setAttributes([
            'contenido' => $_REQUEST['content'],
            'fk_funcionario' => $_REQUEST['key'],
            'fecha' => date('Y-m-d'),
            'estado' => 1
        ]);
        $pk = $NotaFuncionario->save();
    }else{
        $pk = NotaFuncionario::newRecord([
            'contenido' => $_REQUEST['content'],
            'fk_funcionario' => $_REQUEST['key'],
            'fecha' => date('Y-m-d'),
            'estado' => 1
        ]);
    }

    if($pk){
        $Response->success = 1;
        $Response->message = "Datos almacenados";
        $Response->data = $pk;
    }else{
        $Response->message = "Error al guardar!";
    }

} else {
    $Response->message = "Usuario invalido";
}

echo json_encode($Response);
