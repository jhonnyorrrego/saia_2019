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

    if (!$_REQUEST['idencabezado']) {
        throw new Exception('Debe indicar el encabezado', 1);
    }

    $QueryBuilder = Model::getQueryBuilder()
        ->select('count(*) as total')
        ->from('encabezado_formato')
        ->where('etiqueta = :etiqueta')
        ->setParameter(':etiqueta', $_REQUEST['etiqueta']);

    if ($_REQUEST['idencabezado']) {
        $QueryBuilder
            ->andWhere('idencabezado_formato <> :identificator')
            ->setParameter(':identificator', $_REQUEST['idencabezado']);
    }

    $data = $QueryBuilder->execute()->fetch();

    if ($data['total']) {
        throw new Exception("Ya existe un encabezado creado con ese nombre", 1);
    }

    $content = addslashes(stripslashes($_REQUEST['contenido']));
    if (empty($idencabezado)) {
        $save = EncabezadoFormato::newRecord([
            'etiqueta' => $_REQUEST['etiqueta'],
            'contenido' => $content
        ]);
    } else {
        $EncabezadoFormato = new EncabezadoFormato($_REQUEST['idencabezado']);
        $EncabezadoFormato->setAttributes([
            'etiqueta' => $_REQUEST['etiqueta'],
            'contenido' => $content
        ]);
        $save = $EncabezadoFormato->save();
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
