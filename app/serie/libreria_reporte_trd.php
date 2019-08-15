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
    $route = "{$ruta_db_superior}views/serie/grilla_trd.php?";
    $route .= http_build_query([
        'id' => $idserie_version,
        'type' => 'json_trd'
    ]);

    return <<<HTML
        <button 
            class='btn btn-complete'
            onclick="js: window.location.href = '$route'"
        >
            {$nombre}
        </button>
HTML;
}

function clasification_options($idserie_version)
{
    global $ruta_db_superior;
    $route = "{$ruta_db_superior}views/serie/grilla_trd.php?";
    $route .= http_build_query([
        'id' => $idserie_version,
        'type' => 'json_clasificacion'
    ]);
    return <<<HTML
        <button class="btn btn-small"
        onclick="js: window.location.href = '{$route}'";
        >Ver</button>
HTML;
}
