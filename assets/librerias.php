<?php

/**
 * retorna script para cargar
 * jquery v3.3.1 minificado
 * No se debe usar la version 3.4.1 porque tiene un bug
 */
function jquery()
{
    global $ruta_db_superior;

    $route = $ruta_db_superior . 'node_modules/jquery/dist/jquery.min.js';
    return '<script type="text/javascript" src="' . $route . '"></script>';
}
/**
 * retorna script para cargar
 * jquery ui v1.12.1 minificado
 */
function jqueryUi()
{
    global $ruta_db_superior;

    $routeCss = $ruta_db_superior . 'node_modules/jquery-ui-dist/jquery-ui.min.css';
    $css = '<link href="' . $routeCss . '" rel="stylesheet" type="text/css" />';

    $routeJs = $ruta_db_superior . 'node_modules/jquery-ui-dist/jquery-ui.min.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    return $css . $js;
}

/**
 * retorna los enlaces css y js
 * de bootstrap v4.3.1 minificados
 */
function bootstrap()
{
    $css = cssBootstrap();
    $js = jsBootstrap();

    return $css . $js;
}

/**
 * retorna los enlaces js de bootstrap
 * v4.3.1 minificados
 */
function jsBootstrap()
{
    global $ruta_db_superior;

    $routePopper = $ruta_db_superior . 'node_modules/popper.js/dist/umd/popper.min.js';
    $popper = '<script src="' . $routePopper . '" type="text/javascript"></script>';

    $routeJs = $ruta_db_superior . 'node_modules/bootstrap/dist/js/bootstrap.min.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    return $popper . $js;
}

/**
 * retorna el enlace al archivo css de bootstrap
 * v4.3.1 minificado
 * @return string
 */
function cssBootstrap()
{
    global $ruta_db_superior;

    $routeCss = $ruta_db_superior . 'node_modules/bootstrap/dist/css/bootstrap.min.css';
    $css = '<link href="' . $routeCss . '" rel="stylesheet" type="text/css" />';

    return $css;
}
/**
 * retorna los enlaces css , js y locale
 * de bootstrap table v1.13.5 minificados
 */
function bootstrapTable()
{
    global $ruta_db_superior;

    $routeCss = $ruta_db_superior . 'assets/theme/assets/plugins/bootstrap-table/bootstrap-table.min.css';
    $css = '<link href="' . $routeCss . '" rel="stylesheet" type="text/css" />';

    $routeJs = $ruta_db_superior . 'assets/theme/assets/plugins/bootstrap-table/bootstrap-table.min.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    $locale = $ruta_db_superior . 'assets/theme/assets/plugins/bootstrap-table/locale/bootstrap-table-es-ES.min.js';
    $language = '<script src="' . $locale . '" type="text/javascript"></script>';

    return $css . $js . $language;
}

/**
 * retorna los enlaces css , js y locale
 * de bootstrap table editable
 */
function bootstrapTableEditable()
{
    global $ruta_db_superior;

    $routeCss = $ruta_db_superior . 'assets/theme/assets/plugins/bootstrap4-editable/css/bootstrap-editable.css';
    $css = '<link href="' . $routeCss . '" rel="stylesheet" type="text/css" />';

    $routeJs = $ruta_db_superior . 'assets/theme/assets/plugins/bootstrap4-editable/js/bootstrap-editable.min.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    $btEditable = $ruta_db_superior . 'assets/theme/assets/plugins/bootstrap-table/extensions/editable/bootstrap-table-editable.min.js';
    $editable = '<script src="' . $btEditable . '" type="text/javascript"></script>';

    return $css . $js . $editable;
}

/**
 * retorna los enlaces css y js
 * del filter para bootstrap table
 *
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-08-12
 */
function bootstrapTableFilter()
{
    global $ruta_db_superior;

    $routeCss = $ruta_db_superior . 'assets/theme/assets/plugins/bootstrap-table/extensions/filter-control/bootstrap-table-filter-control.min.css';
    $css = '<link href="' . $routeCss . '" rel="stylesheet" type="text/css" />';

    $routeJs = $ruta_db_superior . 'assets/theme/assets/plugins/bootstrap-table/extensions/filter-control/bootstrap-table-filter-control.min.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    return $css . $js;
}

/**
 * retorna los enlaces css y js
 * del export para bootstrap table
 *
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-08-12
 */
function bootstrapTableExport()
{
    global $ruta_db_superior;

    $js = '';
    $baseRoute = $ruta_db_superior . 'assets/theme/assets/plugins/bootstrap-table/extensions/export/';
    $routes = [
        'libs/FileSaver/FileSaver.min.js',
        'libs/js-xlsx/xlsx.core.min.js',
        'libs/jsPDF/jspdf.min.js',
        'libs/jsPDF-AutoTable/jspdf.plugin.autotable.js',
        'libs/es6-promise/es6-promise.auto.min.js',
        'libs/html2canvas/html2canvas.min.js',
        'tableExport.min.js',
        'bootstrap-table-export.js',
    ];

    foreach ($routes as $key => $route) {
        $routeJs = $baseRoute . $route;
        $js .= '<script type="text/javascript" src="' . $routeJs . '"></script>';
    }

    return $js;
}

/**
 * retorna los enlaces css y js
 * de izitoast v1.4.0 minificados
 */
function notificacion()
{
    global $ruta_db_superior;

    $routeCss = $ruta_db_superior . 'node_modules/izitoast/dist/css/iziToast.min.css';
    $css = '<link href="' . $routeCss . '" rel="stylesheet" type="text/css" />';

    $routeJs = $ruta_db_superior . 'node_modules/izitoast/dist/js/iziToast.min.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    return $css . $js;
}

/**
 * retorna los enlaces css y js
 * usados en el tema actual
 */

function theme()
{
    $css = cssTheme();
    $js = jsTheme();

    return $css . $js;
}

/**
 * retorna los estilos del tema
 */
function cssTheme()
{
    global $ruta_db_superior;

    $routeCss = $ruta_db_superior . 'assets/theme/pages/css/pages.min.css';
    return '<link class="main-stylesheet" href="' . $routeCss . '" rel="stylesheet" type="text/css" />';
}

/**
 * retorna el js necesario para 
 * implementar el tema
 */
function jsTheme()
{
    global $ruta_db_superior;

    $routeM = $ruta_db_superior . 'assets/theme/assets/plugins/modernizr.custom.js';
    $modernizr = '<script type="text/javascript" src="' . $routeM . '"></script>';

    $routeJs = $ruta_db_superior . 'assets/theme/pages/js/pages.min.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    return $modernizr . $js;
}

/**
 * retorna los enlaces usados
 * por el tema para el uso
 * de iconos
 */
function icons()
{
    global $ruta_db_superior;

    $routeAwesome = $ruta_db_superior . 'assets/theme/assets/plugins/font-awesome/css/font-awesome.css';
    $fa = '<link class="main-stylesheet" href="' . $routeAwesome . '" rel="stylesheet" type="text/css" />';

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
 * v2.24.0
 */
function moment()
{
    global $ruta_db_superior;

    $route = $ruta_db_superior . 'node_modules/moment/min/moment-with-locales.min.js';
    $locale = '<script type="text/javascript" src="' . $route . '"></script>';

    $route = $ruta_db_superior . 'node_modules/moment/min/moment.min.js';
    $js = '<script type="text/javascript" src="' . $route . '"></script>';

    return $locale . $js;
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
 * Retorna acciones kaiten para permitir la gestion de las ventanas.
 */
function accionesKaiten()
{
    global $ruta_db_superior;
    return '<script type="text/javascript" src="' . $ruta_db_superior . 'assets/theme/assets/js/cerok_libraries/acciones_kaiten.js"></script>';
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
 * de la libreria jquery validate v1.13.0
 */
function validate()
{
    global $ruta_db_superior;

    $routeJs = $ruta_db_superior . 'node_modules/jquery-validation/dist/jquery.validate.min.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    $routeLocaleJs = $ruta_db_superior . 'node_modules/jquery-validation/dist/localization/messages_es.min.js';
    $locale = '<script type="text/javascript" src="' . $routeLocaleJs . '"></script>';

    return $js . $locale;
}

/**
 * Incluir libreria para arboles jquery.fancytree
 * v2.30.0
 * @param string $filtro
 * @return string
 */
function fancyTree($filtro = false)
{
    global $ruta_db_superior;

    $routeCss = $ruta_db_superior . 'assets/theme/assets/plugins/jquery-fancytree/2.30.0/skin-lion/ui.fancytree.min.css';
    $css = '<link class="main-stylesheet" href="' . $routeCss . '" rel="stylesheet" type="text/css" />';
    $css .= '<style>
        ul.fancytree-container {           
            overflow: auto;
            position: relative;
            border: none !important;
            outline: none !important;
        }
        span.fancytree-title {
            font-family: verdana;
            font-size: 7pt;
        }
        span.fancytree-checkbox.fancytree-radio {
            vertical-align: middle;
        }
        span.fancytree-expander {
            vertical-align: middle !important;
        }
    </style>';

    $routeJs = $ruta_db_superior . 'assets/theme/assets/plugins/jquery-fancytree/2.30.0/jquery.fancytree.min.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    if ($filtro) {
        $routeModule = $ruta_db_superior . 'assets/theme/assets/plugins/jquery-fancytree/2.30.0/modules/jquery.fancytree.filter.js';
        $js .= '<script src="' . $routeModule . '"></script>';
    }

    return $css . $js;
}

/**
 * retorna libreria para ejecucion
 * de ventana modal en el top
 */
function topModal()
{
    global $ruta_db_superior;

    $routeJs = $ruta_db_superior . 'assets/theme/assets/js/cerok_libraries/topModal/topModal.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    return $js;
}

function bpmnModeler()
{
    global $ruta_db_superior;

    $ruta_lib = "assets/theme/assets/plugins/bpmn-js/3.1.0/";
    $rutaModeler = $ruta_db_superior . $ruta_lib . "bpmn-modeler.development.js";
    $modeler = '<script src="' . $rutaModeler . '" type="text/javascript"></script>';

    return $modeler;
}

/**
 * retorna la libreria bpmn
 * v3.0.4
 *
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019
 */
function bpmnViewer()
{
    global $ruta_db_superior;
    $ruta_lib = "assets/theme/assets/plugins/bpmn-js/3.0.4/";
    $rutaViewer = $ruta_db_superior . $ruta_lib . "bpmn-viewer.development.js";
    $viewer = '<script src="' . $rutaViewer . '" type="text/javascript"></script>';

    return $viewer;
}

/**
 * retorna enlaces para el uso
 * de la libreria select2 v4.0 .4
 */
function select2()
{
    global $ruta_db_superior;

    $baseUrl = $ruta_db_superior . 'assets/theme/assets/plugins/select2/';
    $css = '<link href="' . $baseUrl . 'css/select2.min.css" rel="stylesheet" type="text/css" />';

    $js = '<script src="' . $baseUrl . 'js/select2.min.js" type="text/javascript"></script>';
    $js .= '<script src="' . $baseUrl . 'js/i18n/es.js" type="text/javascript"></script>';
    return $css . $js;
}
/**
 * retorna los enlaces para incluir 
 * el dropzone  v5.5
 * @return void
 */
function dropzone()
{
    global $ruta_db_superior;

    $routeCss = $ruta_db_superior . 'assets/theme/assets/plugins/dropzone/custom.css';
    $css = '<link class="main-stylesheet" href="' . $routeCss . '" rel="stylesheet" type="text/css" />';

    $routeJs = $ruta_db_superior . 'assets/theme/assets/plugins/dropzone/min/dropzone.min.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    return $css . $js;
}

/**
 * retorna los enlaces para incluir
 * datetimepicker v4.17.47
 *
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-03-20
 */
function dateTimePicker()
{
    global $ruta_db_superior;

    $routeCss = $ruta_db_superior . 'assets/theme/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css';
    $css = '<link class="main-stylesheet" href="' . $routeCss . '" rel="stylesheet" type="text/css" />';

    $routeJs = $ruta_db_superior . 'assets/theme/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    $routeLanguage = $ruta_db_superior . 'assets/theme/assets/plugins/bootstrap-datetimepicker/js/locales/es.js';
    $language = '<script type="text/javascript" src="' . $routeLanguage . '"></script>';

    return $css . $js . $language;
}

/**
 * retorna los enlaces para incluir
 * jspanel v4.7.0
 *
 * @return string
 * @date 2019-04-02
 */
function jsPanel()
{
    global $ruta_db_superior;

    $routeCss = $ruta_db_superior . 'node_modules/jspanel4/dist/jspanel.min.css';
    $css = '<link class="main-stylesheet" href="' . $routeCss . '" rel="stylesheet" type="text/css" />';

    $routeJs = $ruta_db_superior . 'node_modules/jspanel4/dist/jspanel.min.js';
    $js = '<script type="text/javascript" src="' . $routeJs . '"></script>';

    return $css . $js;
}

function kuku()
{
    global $ruta_db_superior;

    $js = '';
    $routes = [
        'assets/theme/assets/plugins/kukudocs/celljs/CellJS.bundle.min.js',
        'assets/theme/assets/plugins/kukudocs/celljs/CellUiLoader.js',
        'assets/theme/assets/plugins/kukudocs/docxjs/DocxJS.bundle.min.js',
        'assets/theme/assets/plugins/kukudocs/docxjs/DocxUiLoader.js',
        'assets/theme/assets/plugins/kukudocs/slidejs/SlideJS.bundle.min.js',
        'assets/theme/assets/plugins/kukudocs/slidejs/SlideUiLoader.js'
    ];

    foreach ($routes as $route) {
        $routeJs = $ruta_db_superior . $route;
        $js .= '<script type="text/javascript" src="' . $routeJs . '"></script>';
    }

    return $js;
}

/**
 * retorna la libreria lodash minificada
 * v4.17.15
 *
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-08-27
 */
function lodash()
{
    global $ruta_db_superior;

    $route = $ruta_db_superior . "node_modules/lodash/lodash.min.js";
    $js = '<script src="' . $route . '" type="text/javascript"></script>';

    return $js;
}

/**
 * obtiene la libreria del ckeditor
 *
 * @return string
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-09-04
 */
function ckeditor()
{
    global $ruta_db_superior;

    $route = $ruta_db_superior . "assets/theme/assets/plugins/ckeditor/4.11/ckeditor_cust/ckeditor.js";
    $js = '<script src="' . $route . '" type="text/javascript"></script>';

    return $js;
}
