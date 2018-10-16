<?php

/**
 * retorna script para cargar
 * jquery v3.2.1 minificado
 */
function jquery()
{
    global $ruta_db_superior;

    $route = $ruta_db_superior . 'assets/theme/assets/plugins/jquery/jquery-3.2.1.min.js';
    return '<script type="text/javascript" src="' . $route . '"></script>';
}

/**
 * retorna script para cargar
 * jquery ui  v1.11.1 minificado
 */
function jqueryUi()
{
    global $ruta_db_superior;

    $route = $ruta_db_superior . 'assets/theme/assets/plugins/jquery-ui/jquery-ui.min.js';
    return '<script type="text/javascript" src="' . $route . '"></script>';
}

/**
 * retorna los enlaces css y js
 * de bootstrap v4.1.0 minificados
 */
function bootstrap()
{
    global $ruta_db_superior;

    $routePopper = $ruta_db_superior . 'assets/theme/assets/plugins/popper/umd/popper.min.js';
    $popper = '<script src="' . $routePopper . '" type="text/javascript"></script>';

    $routeCss = $ruta_db_superior . 'assets/theme/assets/plugins/bootstrap/css/bootstrap.min.css';
    $css = '<link href="' . $routeCss . '" rel="stylesheet" type="text/css" />';

    $routeJs = $ruta_db_superior . 'assets/theme/assets/plugins/bootstrap/js/bootstrap.min.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    return $popper . $css . $js;
}

/**
 * retorna los enlaces css y js
 * de toastr v2.1.3 minificados
 */
function toastr()
{
    global $ruta_db_superior;

    $routeCss = $ruta_db_superior . 'assets/theme/assets/plugins/toastr/toastr.min.css';
    $css = '<link href="' . $routeCss . '" rel="stylesheet" type="text/css" />';

    $routeJs = $ruta_db_superior . 'assets/theme/assets/plugins/toastr/toastr.min.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    return $css . $js;
}

/**
 * retorna los enlaces css y js
 * usados en el tema actual
 */

function theme()
{
    global $ruta_db_superior;

    $routeCss = $ruta_db_superior . 'assets/theme/pages/css/pages.css';
    $css = '<link class="main-stylesheet" href="' . $routeCss . '" rel="stylesheet" type="text/css" />';

    $routeJs = $ruta_db_superior . 'assets/theme/pages/js/pages.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    return $css . $js;
}

/**
 * retorna los enlaces usados
 * por el tema para el uso
 * de iconos
 */
function icons()
{
    global $ruta_db_superior;

    $routePages = $ruta_db_superior . 'assets/theme/pages/css/pages-icons.css';
    $pg = '<link class="main-stylesheet" href="' . $routePages . '" rel="stylesheet" type="text/css" />';

    $routeAwesome = $ruta_db_superior . 'assets/theme/assets/plugins/font-awesome/css/font-awesome.css';
    $fa = '<link class="main-stylesheet" href="' . $routeAwesome . '" rel="stylesheet" type="text/css" />';

    $routeLine = $ruta_db_superior . 'assets/theme/assets/plugins/simple-line-icons/simple-line-icons.css';
    $sl = '<link class="main-stylesheet" href="' . $routeLine . '" rel="stylesheet" type="text/css" />';

    return $pg . $fa . $sl;
}

/**
 * retorna los enlaces para mostrar
 * el loader automatico
 */
function pace()
{
    global $ruta_db_superior;

    $routeCss = $ruta_db_superior . 'assets/theme/assets/plugins/pace/pace-theme-flash.css';
    $css = '<link class="main-stylesheet" href="' . $routeCss . '" rel="stylesheet" type="text/css" />';

    $routeJs = $ruta_db_superior . 'assets/theme/assets/plugins/pace/pace.min.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    return $css . $js;
}

/**
 * retorna el enlace de moment js
 * v2.22.2
 */
function moment(){
    global $ruta_db_superior;
    
    $route = $ruta_db_superior . 'assets/theme/assets/plugins/moment/moment.min.js';
    return '<script type="text/javascript" src="' . $route . '"></script>';
}

function breakpoint(){
    global $ruta_db_superior;
    
    $route = $ruta_db_superior . 'assets/theme/assets/js/cerok_libraries/breakpoint/if-b4-breakpoint.js';
    return '<script type="text/javascript" src="' . $route . '"></script>';
}