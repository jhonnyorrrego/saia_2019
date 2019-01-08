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
    'success' => 1,
    'message' => '',
    'data' => (object)array()
);

if($_SESSION['idfuncionario'] == $_REQUEST['key'] && $_REQUEST['task']){
    foreach ($_REQUEST['tags'] as $tagId => $value){
        if($value == 1){
            $EtiquetaTarea = EtiquetaTarea::findByAttributes([
                'fk_tarea' => $_REQUEST['task'],
                'fk_etiqueta' => $tagId
            ]);

            if($EtiquetaTarea){
                $EtiquetaTarea->toggleRelaction(1);
            }else{
                EtiquetaTarea::newRecord([
                    'fk_tarea' => $_REQUEST['task'],
                    'fk_funcionario' => $_REQUEST['key'],
                    'fk_etiqueta' => $tagId,
                    'estado' => 1
                ]);
            }
        }else if(!$value){
            EtiquetaTarea::executeUpdate([
                'estado' => 0
            ],[
                'fk_tarea' => $_REQUEST['task'],
                'fk_etiqueta' => $tagId,
            ]);
        }
    }
    $Response->message = 'Cambios realizados';
}else{
    $Response->success = 0;
    $Response->message = 'Debe iniciar session';
}

echo json_encode($Response);