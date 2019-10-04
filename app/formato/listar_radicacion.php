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
    'data' => [],
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    // Esto es para hacer el menu en 'registrar correspondencia' de la opcion CAD
    // Se listan los formatos de categoria 1 y que no sean hijos, se guardan en un array para luego listarlos desde listar_radicacion.js.

    $Formato = Formato::findAllByAttributes([
        'cod_padre' => 0,
        'fk_categoria_formato' => 1

    ], [], 'orden');

    if (!$Formato) {
        throw new Exception("No se encontraron resultados", 1);
    }

    foreach ($Formato as $formatos) {
        $Response->data[] = [
            'id' => $formatos->getPK(),
            'url' => "formatos/{$formatos->nombre}/{$formatos->ruta_adicionar}",
            'name' => $formatos->nombre,
            'label' => $formatos->etiqueta
        ];
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
