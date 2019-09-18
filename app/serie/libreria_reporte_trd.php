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

function ver_estado(int $estado)
{

    switch ($estado) {
        case 0:
            $nombreEStado = 'INACTIVO';
            break;
        case 1:
            $nombreEStado = 'ACTIVO';
            break;
        case 2:
            $nombreEStado = 'BORRADOR';
            break;
    }
    return $nombreEStado;
}

function opciones($idserie_version, $estado, $anexo)
{
    global $ruta_db_superior, $versionActual;

    $routeAnexo = "#";
    if ($anexo) {
        $routeAnexo = "{$ruta_db_superior}filesystem/mostrar_binario.php?";
        $routeAnexo .= http_build_query([
            'ruta' => base64_encode($anexo)
        ]);
    }

    if (is_null($versionActual)) {
        $versionActual = SerieVersion::getCurrentVersion() ?
            SerieVersion::getCurrentVersion()->getPK() : 0;
        $GLOBALS['versionActual'] =  $versionActual;
    }

    $li = '';
    if ($estado != 2) {

        $actual = (int) ($versionActual == $idserie_version) ?? false;

        $route = "{$ruta_db_superior}views/serie/grilla_trd.php?";

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

        $nameEstado = $estado ? 'Inactivar' : 'Activar';
        $li = <<<HTML
        <a href="{$routeClasi}" target="_self" class="dropdown-item">
            <i class="fa fa-eye"></i> Clasificación
        </a>
        <a href="{$routeClasi}" target="_self" class="dropdown-item">
            <i class="fa fa-exchange"></i> {$nameEstado}
        </a>
HTML;
    } else {

        $route = "{$ruta_db_superior}views/serie_temp/grilla_trd.php?";

        $routeTrd = $route . http_build_query([
            'id' => $idserie_version
        ]);
    }

    return <<<HTML
        <div class="dropdown">
            <button class="btn mx-1 f-20" 
                type="button" 
                data-toggle="dropdown" 
                aria-haspopup="true" 
                aria-expanded="false"
            >
                <i class="fa fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-left bg-white" role="menu">
                <a href="{$routeAnexo}" target="_blank" class="dropdown-item">
                    <i class="fa fa-download"></i> Anexo
                </a>
                <a href="{$routeTrd}" target="_self" class="dropdown-item">
                    <i class="fa fa-eye"></i> TRD
                </a>
                {$li}
            </div>
        </div>
HTML;
}
