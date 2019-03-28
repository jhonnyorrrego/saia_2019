<?php

$max_salida = 10;
$raiz_saia = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $raiz_saia = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

function librerias_jquery($version = "1.7.2")
{
    global $raiz_saia;
    $texto = '';
    switch ($version) {
        case "1.4":
            $version = "1.4.2";
            break;
        case "1.7":
            $version = "1.7.2";
            break;
        case "1.8":
            $version = "1.8.3";
            break;
        case "1.2.3":
            $texto = '<script src="' . $raiz_saia . 'js/jquery-1.2.3.min.js" type="text/javascript"></script>';
            return $texto;
        case "1.12":
            $version = "1.12.4";
            break;
        case "2.2":
            $version = "2.2.4";
            break;
        case "3.3":
            $version = "3.3.1";
            break;
        case "sapi":
            $texto = '<script type="text/javascript" src="http://www.google.com/jsapi"></script>
                <script type="text/javascript">
                        google.load("jquery", "1.7.2");
                </script>';
            return $texto;
    }
    $texto = '<script src="' . $raiz_saia . 'js/jquery/' . $version . '/jquery.js" type="text/javascript"></script>';
    return $texto;
}

function librerias_UI($version = "1.8.17")
{
    global $raiz_saia;
    $texto = '';
    switch ($version) {
        case "1.12":
            $version = "1.12.1";
            break;
        case "1.8.17":
            $texto = '<script src="' . $raiz_saia . 'js/jquery-ui-1.8.17.min.js" type="text/javascript"></script>';
            return $texto;
    }
    $texto = '<script src="' . $raiz_saia . 'js/jquery-ui/' . $version . '/jquery-ui.js" type="text/javascript"></script>';
    return $texto;
}

function librerias_jqgrid()
{
    global $raiz_saia;
    $texto = '<script src="' . $raiz_saia . 'js/idiomas/grid.locale-es.js" type="text/javascript"></script>
<script src="' . $raiz_saia . 'js/jquery.jqGrid.min.js" type="text/javascript"></script>';
    return $texto;
}

function estilo_jqgrid()
{
    global $raiz_saia;
    $texto = '<link rel="stylesheet" type="text/css" media="screen" href="' . $raiz_saia . 'css/ui.jqgrid.css" />
<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'asset/css/contenedor.css">';
    return $texto;
}

function estilo_lightness()
{
    global $raiz_saia;
    $texto = '<link rel="stylesheet" href="' . $raiz_saia . 'css/ui-lightness/jquery-ui-1.8.17.css" type="text/css" media="all" />';
    return $texto;
}

function estilo_redmond()
{
    global $raiz_saia;
    $texto = '<link rel="stylesheet" href="' . $raiz_saia . 'css/redmond/jquery-ui-1.9.2.custom.min.css" type="text/css" media="all" />';
    return $texto;
}

function estilo_principal($estilo = "estilo_lightness")
{
    global $raiz_saia;
    $texto = '<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'asset/css/main.css">';
    $texto .= $estilo();
    return $texto;
}

function estilo_bootstrap($version = "saia")
{
    global $raiz_saia;
    switch ($version) {
        case "2.1":
            $version = "2.1.1";
            break;
        case "2.3":
            $version = "2.3.2";
            break;
        case "3.2":
            $version = "3.2.0";
            break;
        case "3.3":
            $version = "3.3.7";
            break;
        case "saia":
            $texto = "";
            $texto = '<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'css/bootstrap/saia/css/bootstrap.css">';
            $texto .= '<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'css/bootstrap/saia/css/bootstrap-responsive.css">';
            $texto .= '<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'css/bootstrap/saia/css/jasny-bootstrap.min.css">';
            $texto .= '<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'css/bootstrap/saia/css/jasny-bootstrap-responsive.min.css">';
            $texto .= '<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'css/bootstrap/saia/css/bootstrap_reescribir.css">';
            $texto .= '<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'pantallas/lib/librerias_css.css">';
            $texto .= '<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'css/bootstrap/saia/css/bootstrap_iconos_segundarios.css">';
            return $texto;
    }
    $texto = '<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'css/bootstrap/' . $version . '/css/bootstrap.css">';
    return $texto;
}

function librerias_bootstrap($version = "saia")
{
    global $raiz_saia;
    switch ($version) {
        case "2.3":
            $version = "2.3.2";
            break;
        case "3.2":
            $version = "3.2.0";
            break;
        case "3.3":
            $version = "3.3.7";
            break;
        case "saia":
            $texto = '<script type="text/javascript" src="' . $raiz_saia . 'js/bootstrap/saia/bootstrap.js"></script>';
            $texto .= '<script type="text/javascript" src="' . $raiz_saia . 'js/bootstrap/saia/jasny-bootstrap.min.js"></script>';
            return $texto;
    }
    $texto = '<script type="text/javascript" src="' . $raiz_saia . 'js/bootstrap/' . $version . '/bootstrap.js"></script>';
    return $texto;
}

function librerias_validar_formulario($version = '13')
{
    global $raiz_saia;

    switch ($version) {
        case "5":
            $texto = '<script type="text/javascript" src="' . $raiz_saia . 'js/jquery.validate.js"></script>';
            break;
        case "11":
            $texto = '<script type="text/javascript" src="' . $raiz_saia . 'js/jquery.validate_v1.11.js"></script>';
            break;
        case "13":
            $texto = '<script type="text/javascript" src="' . $raiz_saia . 'js/jquery.validate.1.13.1.js"></script>';
            break;
        default:
            $texto = '<script type="text/javascript" src="' . $raiz_saia . 'js/jquery.validate.1.13.1.js"></script>';
            break;
    }
    $texto .= '<style>label.valid {width: 24px; height: 24px; background: url(' . $raiz_saia . 'asset/img/layout/valid.png) center center no-repeat; display: inline-block;text-indent: -9999px;}label.error {font-weight: bold;color: red;padding: 2px 8px;margin-top: 2px;}</style>';
    return $texto;
}

function librerias_html5()
{
    global $raiz_saia;
    $texto = '<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--[if lt IE 9]>
      <script src="' . $raiz_saia . 'js/html5.js"></script>
      <script src="' . $raiz_saia . 'js/html5-print.js"></script>
    <![endif]-->';
    return $texto;
}

function librerias_arboles($opciones = '')
{
    global $raiz_saia;
    $texto = '<script type="text/javascript" src="' . $raiz_saia . 'js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="' . $raiz_saia . 'js/dhtmlXTree.js"></script>
<script type="text/javascript" src="' . $raiz_saia . 'js/dhtmlxtree_xw.js"></script>
  <script type="text/javascript" src="' . $raiz_saia . 'pantallas/lib/librerias_arboles.js"></script>
	<link rel="STYLESHEET" type="text/css" href="' . $raiz_saia . 'css/dhtmlXTree.css">';
    if ($opciones == 'drag') {
        $texto .= '<script type="text/javascript" src="' . $raiz_saia . 'js/dhtmlxTree_dragIn.js"></script>';
    }
    return $texto;
}

function librerias_arboles_ft($version = "2.24", $opciones = '', $tema = "lion")
{
    global $raiz_saia;
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
    $texto = '<link href="' . $raiz_saia . "js/jquery.fancytree/$version/skin-$tema/ui.fancytree.css" . '" rel="stylesheet">';
    $texto .= '<script src="' . $raiz_saia . "js/jquery.fancytree/$version/jquery.fancytree.min.js" . '"></script>';
    if ($opciones == 'filtro') {
        $texto .= '<script src="' . $raiz_saia . 'js/jquery.fancytree/' . $version . "/$modulos" . '/jquery.fancytree.filter.js"></script>';
    }
    return $texto;
}

function librerias_tooltips()
{
    //se elimina el codigo ya que se debe hacer uso de los tooltips de bootstrap
    return '';
}

function librerias_acciones_kaiten()
{
    global $raiz_saia;
    $texto = '<script type="text/javascript" src="' . $raiz_saia . 'pantallas/lib/acciones_kaiten.js"></script>';
    return $texto;
}

function librerias_notificaciones()
{
    //se elimina el codigo ya que se debe hacer uso de top.notification
    return '';
}

function librerias_datepicker_bootstrap()
{
    global $raiz_saia;
    $texto = '';
    $texto .= '<script src="' . $raiz_saia . 'js/bootstrap/saia/bootstrap-datetimepicker.js" type="text/javascript" charset="utf-8"></script>';
    $texto .= '<script src="' . $raiz_saia . 'js/bootstrap/saia/bootstrap-datetimepicker.es.js" type="text/javascript" charset="utf-8"></script>';
    $texto .= '<link rel="stylesheet" href="' . $raiz_saia . 'css/bootstrap-datetimepicker.min.css" type="text/css" />';
    return $texto;
}

function librerias_highslide()
{
    global $raiz_saia;
    $texto = '';
    $texto .= '<script src="' . $raiz_saia . 'anexosdigitales/highslide-5.0.0/highslide/highslide-full.js" type="text/javascript" charset="utf-8"></script>';
    $texto .= '<link rel="stylesheet" href="' . $raiz_saia . 'anexosdigitales/highslide-5.0.0/highslide/highslide.css" type="text/css" />';
    return $texto;
}

function librerias_zoom()
{
    global $raiz_saia;
    $texto = '';
    $texto .= '<script src="' . $raiz_saia . 'js/jquery.jqzoom-core.js" type="text/javascript" charset="utf-8"></script>';
    $texto .= '<link rel="stylesheet" href="' . $raiz_saia . 'css/jquery.jqzoom.css" type="text/css">';
    return $texto;
}

function librerias_rotate()
{
    global $raiz_saia;
    $texto = '';
    $texto .= '<script src="' . $raiz_saia . 'js/jquery_rotate.js" type="text/javascript" charset="utf-8"></script>';
    return $texto;
}

function librerias_file_upload()
{
    global $raiz_saia;
    $texto = '';
    $texto .= '<script src="' . $raiz_saia . 'pantallas/anexos/js/jquery.ui.widget.js" type="text/javascript"></script>';
    $texto .= '<script src="' . $raiz_saia . 'pantallas/anexos/js/jquery.iframe-transport.js" type="text/javascript"></script>';
    $texto .= '<script src="' . $raiz_saia . 'pantallas/anexos/js/jquery.fileupload.js" type="text/javascript"></script>';
    $texto .= '<script src="' . $raiz_saia . 'pantallas/anexos/js/jquery.fileupload-process.js" type="text/javascript"></script>';
    $texto .= '<script src="' . $raiz_saia . 'pantallas/anexos/js/jquery.fileupload-validate.js" type="text/javascript"></script>';
    return $texto;
}

function estilo_file_upload()
{
    global $raiz_saia;
    $texto = '';
    $texto .= '<link rel="stylesheet" href="' . $raiz_saia . 'pantallas/anexos/css/jquery.fileupload-ui.css" type="text/css" />';
    return $texto;
}

function librerias_jqcrop()
{
    global $raiz_saia;

    $texto = '<script src="' . $raiz_saia . 'js/jquery.Jcrop.pack.js"></script>';
    $texto .= '<link rel="stylesheet" href="' . $raiz_saia . 'css/jquery.Jcrop.css" type="text/css" />';

    return $texto;
}

function librerias_graficos()
{
    global $raiz_saia;
    $texto = '<script src="' . $raiz_saia . 'js/echarts/echarts.js"></script>';
    return $texto;
}
