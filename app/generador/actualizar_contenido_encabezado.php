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

$Response = (object) [
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['identificator']) {
        throw new Exception('Debe indicar el encabezado', 1);
    }

    $identificator = $_REQUEST['identificator'];
    $content = addslashes(stripslashes($_REQUEST['content']));

    if ($identificator) {
        $EncabezadoFormato = new EncabezadoFormato($identificator);
        $EncabezadoFormato->setAttributes([
            'etiqueta' => $_REQUEST['name'],
            'contenido' => $content
        ]);
        $save = $EncabezadoFormato->save();
    } else {
        $data = Model::getQueryBuilder()
            ->select('count(*) as total')
            ->from('encabezado_formato')
            ->where('etiqueta = :etiqueta')
            ->setParameter(':etiqueta', $_REQUEST['name'])
            ->execute()->fetch();

        if ($data['total']) {
            throw new Exception("Ya existe un encabezado creado con ese nombre", 1);
        }

        $save = EncabezadoFormato::newRecord([
            'etiqueta' => $_REQUEST['name'],
            'contenido' => $content
        ]);
    }

    if (!$save) {
        throw new Exception("Error al guardar", 1);
    }

    $Response->message = "Encabezado almacenado";
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
