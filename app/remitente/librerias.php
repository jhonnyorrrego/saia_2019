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

include_once $ruta_db_superior . "core/autoload.php";
include_once $ruta_db_superior . 'pantallas/documento/librerias.php';

/**
 * las funciones indicadas posteriormente son
 * usadas para el reporte de remitentes
 * 
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 */

/**
 * retorna el dropdown de opciones
 *
 * @param integer $userId
 * @return string
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-06-17
 */
function options($userId)
{
    return <<<HTML
    <div class="dropdown">
        <button class="btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-ellipsis-v"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-left bg-white" role="menu">
            <a href="#" class="dropdown-item new_action" data-type="edit" data-id="{$userId}">
                <i class="fa fa-edit"></i> Editar
            </a>
        </div>
    </div>
HTML;
}
