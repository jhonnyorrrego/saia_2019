<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . "core/autoload.php";
include_once $ruta_db_superior . "app/documento/librerias.php";

function responsable($userId)
{
    $Funcionario = new Funcionario($userId);
    $img = roundedImage($Funcionario->getImage('foto_recorte'));
    $name = $Funcionario->getName();

    return <<<HTML
        <div class="col-2">
            {$img}
        </div>
        <div class="col px-0">
            {$name}
        </div>
HTML;
}
