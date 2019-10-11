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
include_once $ruta_db_superior . 'app/documento/librerias.php';

/**
 * filtra por la columna acceso_root en caso
 * de no ser el usuario root
 * 
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @return string
 * @date 2019-10-11
 */
function filtro($v)
{
    if (SessionController::isRoot()) {
        return  "1=1";
    } else {
        return "acceso_root = 0";
    }
}

/**
 * obtiene el valor, en caso de ser usuario
 * root lo decodifica
 *
 * @param string $value
 * @param integer $encrypt
 * @return string
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-10-11
 */
function show_value($value, $encrypt)
{
    if (SessionController::isRoot()) {
        $Configuracion = new Configuracion();
        $Configuracion->valor = $value;
        $Configuracion->encrypt = $encrypt;
        return $Configuracion->getValue();
    } else {
        return $value;
    }
}

/**
 * genera el boton de opciones
 *
 * @param integer $configurationId
 * @return string
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-10-11
 */
function options($configurationId)
{
    return <<<HTML
    <div class="dropdown">
        <button class="btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-ellipsis-v"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-left bg-white" role="menu">
            <a href="#" class="dropdown-item new_action" data-type="edit" data-id="{$configurationId}">
                <i class="fa fa-edit"></i> Editar
            </a>
        </div>
    </div>
HTML;
}
