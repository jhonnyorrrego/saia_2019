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

function opciones($idserie_version, $estado, $currentVersion, $anexo)
{
    global $ruta_db_superior;

    $routeAnexo = "#";
    if ($anexo) {
        $routeAnexo = "{$ruta_db_superior}filesystem/mostrar_binario.php?";
        $routeAnexo .= http_build_query([
            'ruta' => base64_encode($anexo)
        ]);
    }

    $li = '';
    if ($estado != 2) {

        $route = "{$ruta_db_superior}views/serie/grilla_trd.php?";

        $routeTrd = $route . http_build_query([
            'id' => $idserie_version,
            'type' => 'json_trd',
            'currentVersion' => $currentVersion
        ]);

        $routeClasi = $route . http_build_query([
            'id' => $idserie_version,
            'type' => 'json_clasificacion',
            'currentVersion' => $currentVersion
        ]);

        $nameEstado = $estado ? 'Inactivar' : 'Activar';
        $li = <<<HTML
        <a href="{$routeClasi}" target="_self" class="dropdown-item">
            <i class="fa fa-eye"></i> Clasificación
        </a>
HTML;
        if (!$currentVersion) {
            $li .= <<<HTML
            <a 
                href="#" id="activeInactive"
                data-id="{$idserie_version}" 
                data-estado="{$nameEstado}"
                class="dropdown-item">
                <i class="fa fa-exchange"></i> {$nameEstado}
            </a>
HTML;
        }
    } else {

        $routeTrd = "{$ruta_db_superior}views/serie_temp/grilla_trd_temp.php?id={$idserie_version}";

        $li = <<<HTML
        <a href="#" id="deleteVersion" class="dropdown-item">
            <i class="fa fa-trash"></i> Eliminar
        </a>
        <a href="#" id="activeVersion" class="dropdown-item">
            <i class="fa fa-check"></i> Confirmar
        </a>
HTML;
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
