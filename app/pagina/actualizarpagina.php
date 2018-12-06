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

include_once $ruta_db_superior . 'db.php';
include_once $ruta_db_superior . 'models/pagina.php';

$retorno = array(
    "success" => 0,
    "message" => ""
);

if (isset($_SESSION['idfuncionario']) && $_POST) {
    if (!Utilities::permisoModulo("editar_paginas")) {
        $retorno["message"] = "No tiene permisos para actualizar las paginas";
    } else {
        $ord = count($_POST["ordenar"]);
        $del = count($_POST["eliminar"]);
        if ($ord || $del) {
            if ($ord) {
                foreach ($_POST["ordenar"] as $registro) {
                    $pagina = new Pagina($registro["id"]);
                    $pagina -> setAttributes(array("pagina" => $registro["pagina"]));
                    $pagina -> update();
                }
            }

            if ($del) {
                foreach ($_POST["eliminar"] as $registro) {
                    $pagina = new Pagina($registro["id"]);
                    $pagina -> deletePagina();
                }
            }
            $retorno["success"] = 1;
            $retorno["message"] = "Datos actualizados";
        }
    }
}
echo json_encode($retorno);
