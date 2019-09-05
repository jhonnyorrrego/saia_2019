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

function view_trd($id)
{
    return link_report($id, 'json_trd');
}

function view_clasification($id)
{
    return link_report($id, 'json_clasificacion');
}

function link_report($idserie_version, $type)
{
    global $ruta_db_superior, $versionActual;

    if (!$versionActual) {
        $versionActual = (int) SerieVersion::getCurrentVersion()->getPK();
        $GLOBALS['versionActual'] =  $versionActual;
    }

    $route = "{$ruta_db_superior}views/serie/grilla_trd.php?";
    $route .= http_build_query([
        'id' => $idserie_version,
        'type' => $type,
        'currentVersion' => (int) ($versionActual == $idserie_version) ?? false
    ]);

    return <<<HTML
        <button 
            class='btn btn-complete'
            onclick="js: window.location.href = '$route'"
        >
            Ver
        </button>
HTML;
}
