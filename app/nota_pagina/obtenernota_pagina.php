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

include_once $ruta_db_superior . 'models/notaPagina.php';

$retorno = array(
    'success' => 0,
    'message' => ''
);

if ($_SESSION['idfuncionario'] == $_POST['key']) {
    $notas = NotaPagina::getAllResultPagina($_POST['fk_pagina']);
    if ($notas['numcampos']) {
        $retorno["success"] = 1;
        $retorno["numcampos"] = $notas["numcampos"];

        for ($i = 0; $i < $notas['numcampos']; $i++) {
            $data = array();

            $infoDiv = json_decode($notas['data'][$i] -> getPosicion(), true);
            $pWidth = ($_POST['height'] * $infoDiv['top']) / 100;
            $pHeight = ($_POST['width'] * $infoDiv['left']) / 100;
            $data['style'] = "left: " . $pHeight . "px; top: " . $pWidth . "px;";
            
            $data['json'] = $notas['data'][$i] -> getJson(); //falta esto

            $data['id'] = $notas['data'][$i] -> getPK();
            $data['name'] = $notas['data'][$i] -> getNameFuncionario();
            $data['text'] = $notas['data'][$i] -> getObservacion();

            $retorno[$i]['info'] = $data;
        }
    } else {
        $retorno["success"] = 2;
        $retorno["message"] = 'No se encontraron notas';
    }
} else {
    $retorno['message'] = 'Usuario invalido';
}

echo json_encode($retorno);
