<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';

global $counter_formatos;
$counter_formatos = 1;

function contador_formatos()
{
    global $counter_formatos;
    $response = $counter_formatos;
    $counter_formatos++;

    return $response;
}

function boton_editar_formatos($idformato, $etiqueta)
{
    $response = "<div class='kenlace_saia' enlace='views/generador/index.php?idformato=" . $idformato . "' name='nombre' conector='iframe' title='" . $etiqueta . "' > <button class='btn btn-complete'> Modificar </button></div>";
    return $response;
}
