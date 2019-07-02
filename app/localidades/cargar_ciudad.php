<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
        break;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object)[
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['city']) {
        $records = Configuracion::findByNames(['pais', 'departamento', 'ciudad']);
        foreach ($records as $Configuracion) {
            switch ($Configuracion->nombre) {
                case 'pais':
                    $Response->data->country = $Configuracion->getValue();
                    break;
                case 'departamento':
                    $Response->data->state = $Configuracion->getValue();
                    break;
                case 'ciudad':
                    $Response->data->city = $Configuracion->getValue();
                    break;
            }
        }
    } else {
        $Municipio = new Municipio($_REQUEST['city']);

        if (!$Municipio) {
            throw new Exception("Ciudad desconocida", 1);
        }

        $Response->data->country = $Municipio->getState()->pais_idpais;
        $Response->data->state = $Municipio->departamento_iddepartamento;
        $Response->data->city = $Municipio->getPK();
    }


    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
