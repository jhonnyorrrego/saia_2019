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

    if (!$_REQUEST['selectType']) {
        throw new Exception('Debe indicar un tipo de busqueda', 1);
    }

    switch ($_REQUEST['selectType']) {
        case 'country':
            if ($_REQUEST['defaultValue']) {
                $Pais = new Pais($_REQUEST['defaultValue']);
                $records = [$Pais];
            } else {
                $records = Pais::findAllByTerm($_REQUEST['term']);
            }
            break;
        case 'state':
            if ($_REQUEST['defaultValue']) {
                $Departamento = new Departamento($_REQUEST['defaultValue']);
                $records = [$Departamento];
            } else {
                $records = Departamento::findAllByTerm($_REQUEST['term'], $_REQUEST['parentValue']);
            }
            break;
        case 'city':
            if ($_REQUEST['defaultValue']) {
                $Municipio = new Municipio($_REQUEST['defaultValue']);
                $records = [$Municipio];
            } else {
                $records = Municipio::findAllByTerm($_REQUEST['term'], $_REQUEST['parentValue']);
            }
            break;
        default:
            throw new Exception("Tipo de busqueda invalido", 1);
            break;
    }


    if ($records) {
        $data = [];

        foreach ($records as $Model) {
            $data[] = [
                'id' => $Model->getPK(),
                'text' => html_entity_decode($Model->nombre)
            ];
        }

        $Response->data = $data;
        $Response->success = 1;
    } else {
        $Response->message = "No se encontraron registros";
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
