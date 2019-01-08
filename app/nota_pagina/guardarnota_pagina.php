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
    "success" => 0,
    "message" => ""
);

if ($_SESSION['idfuncionario'] == $_POST['key']) {
    $id = (strpos($_POST['idnota_pagina'], 'd') !== false) ? null : $_POST['idnota_pagina'];
    if (!$id) {
        $_POST['fk_funcionario'] = $_SESSION['idfuncionario'];
        $_POST['fecha_creacion'] = date('Y-m-d H:i:s');
    }
    $infoDiv = json_decode($_POST["json"], true);
    $pWidth = ($infoDiv['positionNota']["top"] * 100) / $infoDiv['tamanioDiv']["height"];
    $pHeight = ($infoDiv['positionNota']["left"] * 100) / $infoDiv['tamanioDiv']["width"];
    $posicion = array(
        "top" => $pWidth,
        "left" => $pHeight
    );
    $_POST["posicion"] = json_encode($posicion);
    $nota = new NotaPagina($id);
    $nota -> setAttributes($_POST);
    if ($nota -> save()) {
        $retorno["success"] = 1;
        $retorno["message"] = "Datos almacenados";
        $retorno["idnota_pagina"] = $nota -> getPk();
    } else {
        $retorno["message"] = "Error al actualizar la informaci&oacute;n!";
    }
} else {
    $retorno["message"] = "Usuario invalido";
}

echo json_encode($retorno);
