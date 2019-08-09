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

function enlace_reporte_nombre($idserie_version, $nombre)
{
    global $ruta_db_superior;

    return <<<HTML
        <button 
            class='btn btn-complete'
            onclick="js: window.location.href = '{$ruta_db_superior}views/serie/grilla_trd.php?id={$idserie_version}'"
        >
            {$nombre}
        </button>
HTML;
}
