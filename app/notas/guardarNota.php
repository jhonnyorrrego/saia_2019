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

include_once $ruta_db_superior . 'db.php';
include_once $ruta_db_superior . 'models/note.php';

$Response = (object) array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 0,
);

if ($_SESSION['idfuncionario'] == $_REQUEST['iduser']) {
    $note = new Note($_REQUEST['id']);
    $note->contenido = $_REQUEST['content'];

    if($note->save()){
        $Response->success = 1;
        $Response->message = "Datos almacenados";
        $Response->data = $note->idnota;
    }else{
        $Response->message = "Error al guardar!";
    }

} else {
    $Response->message = "Usuario inválido";
}

echo json_encode($Response);
