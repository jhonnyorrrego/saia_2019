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

$Response = (object)array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $annotation = (object)$_REQUEST['annotation'];
    $comment = $_REQUEST['comment'];
    eval('$type = VisorNota::' . $_REQUEST['type'] . ';');

    $VisorNota = VisorNota::findByAttributes([
        'tipo_relacion' => $type,
        'idrelacion' => $_REQUEST['typeId'],
        'uuid' => $annotation->uuid,
        'page' => $annotation->page
    ]);

    if(!$VisorNota){
        $VisorNota = new VisorNota();
        $VisorNota->setAttributes($annotation);
        $VisorNota->setAttributes([
            'fk_funcionario' => $_REQUEST['key'],
            'fecha' => date('Y-m-d H:i:s'),
            'tipo_relacion' => $type,
            'idrelacion' => $_REQUEST['typeId']
        ]);

        if(!$VisorNota->save()){
            $VisorNota = null;
        }
    }

    if($VisorNota){
        $data = array_merge($comment, [
            'fk_funcionario' => $_REQUEST['key'],
            'fk_visor_nota' => $VisorNota->getPK(),
            'fecha' => date('Y-m-d H:i:s')
        ]);
        $pk = VisorComentario::newRecord($data);
        if($pk) {
            $Response->message = 'Comantario creado';
            $Response->success = 1;
        }else{
            $Response->message = 'Error al crear el comentario';
        }
    }else{
        $Response->message = 'Error al crear la nota';
    }
} else {
    $Response->message = "Debe iniciar sesion";
    $Response->success = 0;
}

echo json_encode($Response);