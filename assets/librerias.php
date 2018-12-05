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
 * jquery Mobile  v1.4.5 minificado
 */
function jqueryMobile()
{
    global $ruta_db_superior;

    $routeCss = $ruta_db_superior . 'assets/theme/assets/plugins/jquery-mobile/jquery.mobile-1.4.5.min.css';
    $css = '<link href="' . $routeCss . '" rel="stylesheet" type="text/css" />';

    $routeJs = $ruta_db_superior . 'assets/theme/assets/plugins/jquery-mobile/jquery.mobile-1.4.5.min.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    return $css . $js;
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
 * retorna los enlaces css , js y locale
 * de bootstrap table v1.12.1 minificados
 */
function bootstrapTable()
{
    global $ruta_db_superior;

    $routeCss = $ruta_db_superior . 'assets/theme/assets/plugins/bootstrap-table/bootstrap-table.css';
    $css = '<link href="' . $routeCss . '" rel="stylesheet" type="text/css" />';

    $routeJs = $ruta_db_superior . 'assets/theme/assets/plugins/bootstrap-table/bootstrap-table.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    $locale = $ruta_db_superior . 'assets/theme/assets/plugins/bootstrap-table/locale/bootstrap-table-es-ES.js';
    $languaje = '<script src="' . $locale . '" type="text/javascript"></script>';

    return $css . $js . $languaje;
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

    $routeM = $ruta_db_superior . 'assets/theme/assets/plugins/modernizr.custom.js';
    $modernizr = '<script type="text/javascript" src="' . $routeM . '"></script>';

    $routeCss = $ruta_db_superior . 'assets/theme/pages/css/pages.css';
    $css = '<link class="main-stylesheet" href="' . $routeCss . '" rel="stylesheet" type="text/css" />';

    $routeJs = $ruta_db_superior . 'assets/theme/pages/js/pages.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    return $modernizr . $css . $js;
}

/**
 * retorna los enlaces usados
 * por el tema para el uso
 * de iconos
 */
function icons()
{
    global $ruta_db_superior;

    /*$routePages = $ruta_db_superior . 'assets/theme/pages/css/pages-icons.css';
    $pg = '<link class="main-stylesheet" href="' . $routePages . '" rel="stylesheet" type="text/css" />';
    */
    $routeAwesome = $ruta_db_superior . 'assets/theme/assets/plugins/font-awesome/css/font-awesome.css';
    $fa = '<link class="main-stylesheet" href="' . $routeAwesome . '" rel="stylesheet" type="text/css" />';

    /*$routeLine = $ruta_db_superior . 'assets/theme/assets/plugins/simple-line-icons/simple-line-icons.css';
    $sl = '<link class="main-stylesheet" href="' . $routeLine . '" rel="stylesheet" type="text/css" />';
    */
    return $fa;
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
function moment()
{
    global $ruta_db_superior;

    $route = $ruta_db_superior . 'assets/theme/assets/plugins/moment/moment.min.js';
    return '<script type="text/javascript" src="' . $route . '"></script>';
}

/**
 * retorna enlace de libreria
 * que permite determinar el breakpoint
 * actual según bootstrap
 */
function breakpoint()
{
    global $ruta_db_superior;

    $route = $ruta_db_superior . 'assets/theme/assets/js/cerok_libraries/breakpoint/if-b4-breakpoint.js';
    return '<script type="text/javascript" src="' . $route . '"></script>';
}

/**
 * retorna la libreria kaiten
 * con las nuevas modificaciones
 */
function kaiten()
{
    global $ruta_db_superior;

    $routeCss = $ruta_db_superior . 'assets/theme/assets/plugins/kaiten/css/kaiten.css';
    $css = '<link class="main-stylesheet" href="' . $routeCss . '" rel="stylesheet" type="text/css" />';

    $routeJs = $ruta_db_superior . 'assets/theme/assets/plugins/kaiten/js/jquery.min.js';
    $jq = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    $routeUi = $ruta_db_superior . 'assets/theme/assets/plugins/kaiten/js/jquery-ui.custom.min.js';
    $ui = '<script type="text/javascript" src="' . $routeUi . '"></script>';

    $routeJs = $ruta_db_superior . 'assets/theme/assets/plugins/kaiten/js/kaiten.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    $resize = $ruta_db_superior . 'assets/theme/assets/plugins/kaiten/js/jquery.ba-resize.min.js';
    $jqresize = '<script type="text/javascript" src="' . $resize . '"></script>';

    return $css . $jq . $ui . $js . $jqresize;
}

/** 
 * retorna enlaces para el uso
 * de la libreria jquery scrollbar
 */
function scrollBar()
{
    global $ruta_db_superior;

    $routeCss = $ruta_db_superior . 'assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.css';
    $css = '<link class="main-stylesheet" href="' . $routeCss . '" rel="stylesheet" type="text/css" />';

    $routeJs = $ruta_db_superior . 'assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    return $css . $js;
}

/**
 * retorna enlaces para el uso
 * de la libreria jquery validate
 */
function validate()
{
    global $ruta_db_superior;

    $routeJs = $ruta_db_superior . 'assets/theme/assets/plugins/jquery-validation/js/jquery.validate.min.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';
    
    $routeLocaleJs = $ruta_db_superior . 'assets/theme/assets/plugins/jquery-validation/js/localization/messages_es.min.js';
    $locale = '<script type="text/javascript" src="' . $routeLocaleJs . '"></script>';

    return $js . $locale;
}

/**
 * Incluir libreria para arboles jquery.fancytree
 * @param string $version
 * @param string $opciones
 * @param string $tema
 * @return string
 */
function arboles_ft($version = "2.30", $opciones = '', $tema = "lion")
{
    global $ruta_db_superior;
    $ruta = $ruta_db_superior . 'assets/theme/assets/plugins/jquery-fancytree/';

    $modulos = "";
    switch ($version) {
        case "2.24":
            $version = "2.24.0";
            $modulos = "src";
            break;
        case "2.30":
            $version = "2.30.0";
            $modulos = "modules";
            break;
    }
    $texto = '<link href="' . $ruta . "$version/skin-$tema/ui.fancytree.css" . '" rel="stylesheet">';
    $texto .= '<script src="' . $ruta . "$version/jquery.fancytree.min.js" . '"></script>';
    if ($opciones == 'filtro') {
        $texto .= '<script src="' . $ruta . $version . "/$modulos" . '/jquery.fancytree.filter.js"></script>';
    }
    return $texto;
}

/**
 * retorna libreria para ejecucion
 * de ventana modal en el top
 */
function topModal(){
    global $ruta_db_superior;

    $routeJs = $ruta_db_superior . 'assets/theme/assets/js/cerok_libraries/topModal/topModal.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    return $js;
}

/**
 * incluye las librerias necesarias 
 * para la pantalla del topModal
 * 
 * @param array $data
 * @return string <script> incluye las librerias
 * cuando el documento esta listo
 */
function librariesForTopModal($data){
    $data = implode('', $data);
    $libraries = str_replace('</script>','<\/script>', $data);
    
    return "<script type='text/javascript'>
        div = $('<div>').append('". $libraries ."');
        
        $.each(div.children(), function(i, e){
            if(e.href){
                $('head').append(e);
            }else if(e.src){
                $('body').append(e);
            }
        });

        delete div;
    </script>";
}