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
    'data' => [],
    'message' => "",
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    if ($_REQUEST['type'] && $_REQUEST['typeId']) {
        eval('$type = VisorNota::' . $_REQUEST['type'] . ';');

        $VisorNota = VisorNota::findByAttributes([
            'tipo_relacion' => $type,
            'idrelacion' => $_REQUEST['typeId'],
            'uuid' => $_REQUEST['uuid']
        ]);

        if($VisorNota){
            $VisorNota->setAttributes($_REQUEST['annotation']);

            if($VisorNota->save()){
                $Response->message = 'Nota actualizada';
                $Response->success = 1;
            }else{
                $Response->message = 'Error al guardar';
            }
        }else{
            $Response->message = 'Nota no identificada';
        }
    } else {
        $Response->message = 'Error al buscar';
    }
} else {
    $Response->message = "Debe iniciar sesion";
    $Response->success = 0;
}

echo json_encode($Response);