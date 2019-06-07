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

include_once $ruta_db_superior . 'core/autoload.php';

$retorno = array(
    'success' => 0,
    'message' => '',
    'data' => []
);

if ($_SESSION['idfuncionario'] == $_POST['key']) {
    $notas = NotaPagina::findAllByAttributes([
        'fk_pagina' => $_POST['fk_pagina']
    ]);
    if ($notas) {
        foreach ($notas as $key => $NotaPagina) {
            $data = [];

            $infoDiv = json_decode($NotaPagina->posicion, true);
            $pWidth = ($_POST['height'] * $infoDiv['top']) / 100;
            $pHeight = ($_POST['width'] * $infoDiv['left']) / 100;
            $data['style'] = "left: " . $pHeight . "px; top: " . $pWidth . "px;";
            $data['json'] = $NotaPagina->json; //falta esto
            $data['id'] = $NotaPagina->getPK();
            $data['name'] = $NotaPagina->getUser()->getName();
            $data['text'] = $NotaPagina->observacion;

            $retorno['data'][] = $data;
            $retorno['success'] = 1;
        }
    } else {
        $retorno["success"] = 2;
        $retorno["message"] = 'No se encontraron notas';
    }
} else {
    $retorno['message'] = 'Usuario invalido';
}

echo json_encode($retorno);
