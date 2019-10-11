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

/**
 * las funciones indicadas posteriormente son
 * usadas para el reporte de carruseles
 * 
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 */

/**
 * retorna el dropdown de opciones
 *
 * @param integer $carouselId
 * @return string
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-10-10
 */
function options($carouselId)
{
    return <<<HTML
        <div class="dropdown">
            <button class="btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-left bg-white" role="menu">
                <a href="#" class="dropdown-item new_action" data-type="edit" data-id="{$carouselId}">
                    <i class="fa fa-edit"></i> Editar
                </a>
                <a href="#" class="dropdown-item new_action" data-type="show_items" data-id="{$carouselId}">
                    <i class="fa fa-newspaper-o"></i> Ver noticias
                </a>
            </div>
        </div>
HTML;
}

/**
 * genera la etiqueta de la columna estado
 *
 * @param integer $carouselId
 * @param string $state
 * @return string
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-10-10
 */
function show_state($state)
{
    $Carrusel = new Carrusel();
    return $Carrusel->getValueLabel('estado', (int) $state);
}
