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

function opciones($idserie_version, $anexo)
{
    global $ruta_db_superior, $versionActual;

    $routeAnexo = "#";
    if ($anexo) {
        $routeAnexo = "{$ruta_db_superior}filesystem/mostrar_binario.php?";
        $routeAnexo .= http_build_query([
            'ruta' => base64_encode($anexo)
        ]);
    }

    if (!$versionActual) {
        $versionActual = (int) SerieVersion::getCurrentVersion()->getPK();
        $GLOBALS['versionActual'] =  $versionActual;
    }

    $route = "{$ruta_db_superior}views/serie/grilla_trd.php?";
    $actual = (int) ($versionActual == $idserie_version) ?? false;

    $routeTrd = $route . http_build_query([
        'id' => $idserie_version,
        'type' => 'json_trd',
        'currentVersion' => $actual
    ]);

    $routeClasi = $route . http_build_query([
        'id' => $idserie_version,
        'type' => 'json_clasificacion',
        'currentVersion' => $actual
    ]);


    return <<<HTML
        <div class="dropdown">
            <button class="btn mx-1" 
                type="button" 
                data-toggle="dropdown" 
                aria-haspopup="true" 
                aria-expanded="false"
            >
                <i class="fa fa-ellipsis-v fa-2x"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-left bg-white" role="menu">
                <a href="{$routeTrd}" target="_self" class="dropdown-item">
                    <i class="fa fa-eye"></i> TRD
                </a>
                <a href="{$routeClasi}" target="_self" class="dropdown-item">
                    <i class="fa fa-eye"></i> Clasificación
                </a>
                <a href="{$routeAnexo}" target="_blank" class="dropdown-item">
                    <i class="fa fa-download"></i> Anexo
                </a>
            </div>
        </div>
HTML;
}
