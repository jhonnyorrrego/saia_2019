<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
if (!@$ruta_actual) {
	while ($max_salida > 0) {
		if (is_file($ruta . "db.php")) {
			$ruta_db_superior = $ruta;
		}
		$ruta .= "../";
		$max_salida--;
	}
	include_once ($ruta_db_superior . "db.php");
} else {
	$ruta_db_superior = $ruta_actual . $ruta_db_superior;
}

if (@$_SESSION["generando_pantalla"]) {
	$raiz_saia = '<?php echo($ruta_db_superior); ?' . '>';
} else {
	$raiz_saia = $ruta_db_superior;
}

include_once ($raiz_saia . "css/index_estilos.php");

function librerias_jquery($version = "1.7.2") {
	global $raiz_saia;
	$texto = '';
	switch ($version) {
		case "1.4" :
			$version = "1.4.2";
			break;
		case "1.7" :
			$version = "1.7.2";
			break;
		case "1.8" :
			$version = "1.8.3";
			break;
		case "1.2.3" :
			$texto = '<script src="' . $raiz_saia . 'js/jquery-1.2.3.min.js" type="text/javascript"></script>';
			return $texto;
		case "1.12" :
			$version = "1.12.4";
			break;
		case "2.2" :
		    $version = "2.2.4";
		    break;
		case "sapi" :
			$texto = '<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
        google.load("jquery", "1.7.2");
</script>';
			return $texto;
	}
	$texto = '<script src="' . $raiz_saia . 'js/jquery/' . $version . '/jquery.js" type="text/javascript"></script>';
	return ($texto);
}

function librerias_fechas($hora = 0) {
	global $raiz_saia;
	$texto = '';
	$texto .= '<link rel="stylesheet" href="' . $raiz_saia . 'css/ui-lightness/jquery-ui-1.8.4.custom.css" type="text/css" media="all" />';
	$texto .= librerias_UI();
	if ($hora) {
		$texto .= '<script src="' . $raiz_saia . 'js/jquery-ui-timepicker-addon.js" type="text/javascript"></script>';
	}
	return ($texto);
}

function librerias_UI($version = "1.8.17") {
	global $raiz_saia;
	$texto = '';
	switch ($version) {
	    case "1.12" :
	        $version = "1.12.1";
	        break;
	    case "1.8.17":
	        $texto = '<script src="' . $raiz_saia . 'js/jquery-ui-1.8.17.min.js" type="text/javascript"></script>';
	        return $texto;
	}
	$texto = '<script src="' . $raiz_saia . 'js/jquery-ui/' . $version . '/jquery-ui.js" type="text/javascript"></script>';
	return ($texto);
}

function librerias_jqgrid() {
	global $raiz_saia;
	$texto .= '<script src="' . $raiz_saia . 'js/idiomas/grid.locale-es.js" type="text/javascript"></script>
<script src="' . $raiz_saia . 'js/jquery.jqGrid.min.js" type="text/javascript"></script>';
	return ($texto);
}

function estilo_jqgrid() {
	global $raiz_saia;
	$texto .= '<link rel="stylesheet" type="text/css" media="screen" href="' . $raiz_saia . 'css/ui.jqgrid.css" />
<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'asset/css/contenedor.css">';
	return ($texto);
}

function estilo_excite() {
	global $raiz_saia;
	$texto = '<link rel="stylesheet" href="' . $raiz_saia . 'css/excite-bike/excite-bike-ui.css" type="text/css" media="all" />';
	return ($texto);
}

function estilo_lightness() {
	global $raiz_saia;
	$texto = '<link rel="stylesheet" href="' . $raiz_saia . 'css/ui-lightness/jquery-ui-1.8.17.css" type="text/css" media="all" />';
	return ($texto);
}

function estilo_darkness() {
	global $raiz_saia;
	$texto = '<link rel="stylesheet" href="' . $raiz_saia . 'css/ui-darkness/jquery-ui-1.8.css" type="text/css" media="all" />';
	return ($texto);
}

function estilo_smoothness() {
	global $raiz_saia;
	$texto = '<link rel="stylesheet" href="' . $raiz_saia . 'asset/css/smoothness/jquery-ui.css" type="text/css" />';
	return ($texto);
}

function estilo_redmond() {
	global $raiz_saia;
	$texto = '<link rel="stylesheet" href="' . $raiz_saia . 'css/redmond/jquery-ui-1.9.2.custom.min.css" type="text/css" media="all" />';
	return ($texto);
}

function estilo_principal($estilo = "estilo_lightness") {
	global $raiz_saia;
	$texto = '<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'asset/css/main.css">';
	$texto .= index_estilos('temas_main');
	$texto .= $estilo();
	return ($texto);
}

function estilo_bootstrap($version = "saia") {
	global $raiz_saia;
	switch ($version) {
		case "2.1" :
			$version = "2.1.1";
			break;
		case "2.3" :
			$version = "2.3.2";
			break;
		case "3.2" :
			$version = "3.2.0";
			break;
		case "saia" :
			$texto = "";
			$texto = '<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'css/bootstrap/saia/css/bootstrap.css">';
			$texto .= '<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'css/bootstrap/saia/css/bootstrap-responsive.css">';
			$texto .= '<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'css/bootstrap/saia/css/jasny-bootstrap.min.css">';
			$texto .= '<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'css/bootstrap/saia/css/jasny-bootstrap-responsive.min.css">';
			$texto .= '<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'css/bootstrap/saia/css/bootstrap_reescribir.css">';
			$texto .= '<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'pantallas/lib/librerias_css.css">';
			$texto .= '<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'css/bootstrap/saia/css/bootstrap_iconos_segundarios.css">';
			$texto .= index_estilos('temas_bootstrap');
			return $texto;
	}
	$texto = '<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'css/bootstrap/' . $version . '/css/bootstrap.css">';
	return ($texto);
}

function estilo_tabla_bootstrap($version = "1.11") {
	global $raiz_saia;
	switch ($version) {
		case "1.12" :
			$version = "1.12.1";
			break;
		case "1.11" :
			$version = "1.11.1";
			break;
		case "1.10" :
			$version = "1.10.1";
			break;
	}
	$texto = '<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'css/bootstrap_table/' . $version . '/bootstrap-table.css">';
	return $texto;
}

function librerias_tabla_bootstrap($version = "1.11", $export = false, $avanzado = false) {
	global $raiz_saia;
	switch ($version) {
		case "1.12" :
			$version = "1.12.1";
			break;
		case "1.11" :
			$version = "1.11.1";
			break;
		case "1.10" :
			$version = "1.10.1";
			break;
	}
	$texto = '<script type="text/javascript" src="' . $raiz_saia . 'css/bootstrap_table/' . $version . '/bootstrap-table.js"></script>';

	$texto .= '<script src="' . $raiz_saia . 'css/bootstrap_table/' . $version . '/locale/bootstrap-table-es-ES.js"></script>';
	if ($export) {
		$texto .= '<script src="' . $raiz_saia . 'css/bootstrap_table/' . $version . '/extensions/export/bootstrap-table-export.js"></script>';
	}
	if($avanzado) {
	    $texto .= '<script src="' . $raiz_saia . 'css/bootstrap_table/' . $version . '/extensions/toolbar/bootstrap-table-toolbar.js"></script>';
	}

	return $texto;
}

function librerias_bootstrap($version = "saia") {
	global $raiz_saia;
	switch ($version) {
		case "2.3" :
			$version = "2.3.2";
			break;
		case "3.2" :
			$version = "3.2.0";
			break;
		case "3.3" :
			$version = "3.3.7";
			break;
		case "saia" :
			$texto = '<script type="text/javascript" src="' . $raiz_saia . 'js/bootstrap/saia/bootstrap.js"></script>';
			$texto .= '<script type="text/javascript" src="' . $raiz_saia . 'js/bootstrap/saia/jasny-bootstrap.min.js"></script>';
			return ($texto);
	}
	$texto = '<script type="text/javascript" src="' . $raiz_saia . 'js/bootstrap/' . $version . '/bootstrap.js"></script>';
	return $texto;
}

function librerias_validar_formulario($version = '13') {
	global $raiz_saia;

	switch ($version) {
		case "5" :
			$texto = '<script type="text/javascript" src="' . $raiz_saia . 'js/jquery.validate.js"></script>';
			break;
		case "11" :
			$texto = '<script type="text/javascript" src="' . $raiz_saia . 'js/jquery.validate_v1.11.js"></script>';
			break;
		case "13" :
			$texto = '<script type="text/javascript" src="' . $raiz_saia . 'js/jquery.validate.1.13.1.js"></script>';
			break;
		default :
			$texto = '<script type="text/javascript" src="' . $raiz_saia . 'js/jquery.validate.1.13.1.js"></script>';
			break;
	}
	$texto .= '<style>label.valid {width: 24px; height: 24px; background: url(' . $raiz_saia . 'asset/img/layout/valid.png) center center no-repeat; display: inline-block;text-indent: -9999px;}label.error {font-weight: bold;color: red;padding: 2px 8px;margin-top: 2px;}</style>';
	return ($texto);
}

function librerias_html5() {
	global $raiz_saia;
	$texto = '<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--[if lt IE 9]>
      <script src="' . $raiz_saia . 'js/html5.js"></script>
      <script src="' . $raiz_saia . 'js/html5-print.js"></script>
    <![endif]-->';
	return ($texto);
}

function librerias_arboles($opciones = '') {
	global $raiz_saia;
	$texto = '<script type="text/javascript" src="' . $raiz_saia . 'js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="' . $raiz_saia . 'js/dhtmlXTree.js"></script>
<script type="text/javascript" src="' . $raiz_saia . 'js/dhtmlxtree_xw.js"></script>
  <script type="text/javascript" src="' . $raiz_saia . 'pantallas/lib/librerias_arboles.js"></script>
	<link rel="STYLESHEET" type="text/css" href="' . $raiz_saia . 'css/dhtmlXTree.css">';
	if ($opcion == 'drag') {
		$texto .= '<script type="text/javascript" src="' . $raiz_saia . 'js/dhtmlxTree_dragIn.js"></script>';
	}
	return ($texto);
}

function librerias_arboles_ft($version = "2.24", $opciones = '', $tema = "lion") {
    global $raiz_saia;
    $modulos = "";
    switch ($version) {
        case "2.24" :
            $version = "2.24.0";
            $modulos = "src";
            break;
        case "2.30" :
            $version = "2.30.0";
            $modulos = "modules";
            break;
    }
    $texto =  '<link href="' .   $raiz_saia . "js/jquery.fancytree/$version/skin-$tema/ui.fancytree.css" . '" rel="stylesheet">';
    $texto .= '<script src="' .  $raiz_saia . "js/jquery.fancytree/$version/jquery.fancytree.min.js" . '"></script>';
    if($opciones == 'filtro') {
        $texto .= '<script src="' .  $raiz_saia . 'js/jquery.fancytree/' . $version . "/$modulos" . '/jquery.fancytree.filter.js"></script>';
    }
    return $texto;
}

function librerias_tiny() {
	global $raiz_saia;
	$texto = '';
	$texto = '<script language="javascript" type="text/javascript" src="' . $raiz_saia . 'tinymce/jquery.tinymce.min.js"></script>';
	return ($texto);
}

function libreria_php($ruta, $retorno = 0) {
	global $raiz_saia;
	if ($retorno) {
		$texto = '<?php include_once($ruta_db_superior."' . $ruta . '"); ?' . '>';
		return ($texto);
	} else {
		include_once ($raiz_saia . $ruta);
	}
	return ('');
}

function funcion_php($nombre, $parametros = '', $libreria = '', $retorno = 0) {
	global $raiz_saia;
	$texto = '';
	if ($libreria) {
		$texto .= libreria_php($libreria, $retorno);
	}
	if ($retorno) {
		$texto .= '<?php ' . $nombre . '(' . $parametros . '); ?' . '>';
		return ($texto);
	} else {
		include_once ($raiz_saia . $ruta);
	}
	return ('');
}

function librerias_editor_php() {
	global $raiz_saia;
	$texto = '';
	$texto = '<script src="' . $raiz_saia . 'js/ace_editor_php/ace-noconflict.js" type="text/javascript" charset="utf-8"></script>
<script src="' . $raiz_saia . 'js/ace_editor_php/theme-dreamweaver-noconflict.js" type="text/javascript" charset="utf-8"></script>
<script src="' . $raiz_saia . 'js/ace_editor_php/mode-php-noconflict.js" type="text/javascript" charset="utf-8"></script>';
	return ($texto);
}

function librerias_principal() {
	global $raiz_saia;
	$texto = '';
	$texto = '<script src="' . $raiz_saia . 'asset/js/main.js" type="text/javascript" charset="utf-8"></script>';
	return ($texto);
}

function librerias_tooltips() {
	// http://craigsworks.com/projects/qtip2/
	global $raiz_saia;
	$texto = '';
	$texto .= '<script src="' . $raiz_saia . 'js/jquery.qtip.js" type="text/javascript" charset="utf-8"></script>
';
	$texto .= '<link rel="stylesheet" href="' . $raiz_saia . 'css/jquery.qtip.css" type="text/css" />';
	$texto .= '<script type="text/javascript" src="' . $raiz_saia . 'pantallas/lib/acciones_tooltips.js"></script>';
	return ($texto);
}

function librerias_mascaras_texto() {
	// Proximo desarrrollo de jquery ui
	global $raiz_saia;
	$texto = '';
	$texto .= '<script src="' . $raiz_saia . 'js/jquery.maskedinput.js" type="text/javascript" charset="utf-8"></script>';
	return ($texto);
}

function librerias_easing() {
	global $raiz_saia;
	$texto = '';
	$texto .= '<script src="' . $raiz_saia . 'js/jquery.easing.min.js" type="text/javascript" charset="utf-8"></script>';
	return ($texto);
}

function librerias_supersize() {
	global $raiz_saia;
	$texto = '';
	$texto .= '<script src="' . $raiz_saia . 'js/supersized.3.2.7.min.js" type="text/javascript" charset="utf-8"></script>';
	$texto .= '<script src="' . $raiz_saia . 'js/supersized.shutter.js" type="text/javascript" charset="utf-8"></script>';
	$texto .= '<link rel="stylesheet" href="' . $raiz_saia . 'css/supersized.css" type="text/css" />';
	$texto .= '<link rel="stylesheet" href="' . $raiz_saia . 'css/supersized.shutter.css" type="text/css" />';
	return ($texto);
}

function librerias_kaiten() {
	global $raiz_saia;
	$texto = '';
	$texto .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
	$texto .= '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />';
	$texto .= '<link rel="stylesheet" type="text/css" href="' . $raiz_saia . 'css/kaiten.min.css" />';
	$texto .= '<script type="text/javascript" src="' . $raiz_saia . 'pantallas/anexos/js/jquery.ui.widget.js" ></script>';
	$texto .= '<script type="text/javascript" src="' . $raiz_saia . 'js/kaiten.js"></script>';
	$texto .= '<script type="text/javascript" src="' . $raiz_saia . 'js/jquery.ba-resize.min.js"></script>';
	$texto .= index_estilos('temas_kaiten');
	return ($texto);
}

function librerias_acciones_kaiten() {
	global $raiz_saia;
	$texto = '';
	$texto .= '<script type="text/javascript" src="' . $raiz_saia . 'pantallas/lib/acciones_kaiten.js"></script>';
	return ($texto);
}

function librerias_scroll_infinito() {
	global $raiz_saia;
	$texto = '';
	$texto .= '<script src="' . $raiz_saia . 'js/jquery.infini_scroll.js" type="text/javascript" charset="utf-8"></script>';
	return ($texto);
}

function librerias_notificaciones() {
	global $raiz_saia;
	$texto = '';
	$texto .= '<script src="' . $raiz_saia . 'js/noty/jquery.noty.js" type="text/javascript" charset="utf-8"></script>';
	$texto .= '<script src="' . $raiz_saia . 'js/noty/layouts/topCenter.js" type="text/javascript" charset="utf-8"></script>';
	$texto .= '<script src="' . $raiz_saia . 'js/noty/layouts/topRight.js" type="text/javascript" charset="utf-8"></script>';
	$texto .= '<script src="' . $raiz_saia . 'js/noty/themes/default.js" type="text/javascript" charset="utf-8"></script>';
	$texto .= '<script src="' . $raiz_saia . 'pantallas/lib/librerias_notificaciones.js" type="text/javascript" charset="utf-8"></script>';
	return ($texto);
}

function librerias_datepicker_bootstrap() {
	global $raiz_saia;
	$texto = '';
	$texto .= '<script src="' . $raiz_saia . 'js/bootstrap/saia/bootstrap-datetimepicker.js" type="text/javascript" charset="utf-8"></script>';
	$texto .= '<script src="' . $raiz_saia . 'js/bootstrap/saia/bootstrap-datetimepicker.es.js" type="text/javascript" charset="utf-8"></script>';
	$texto .= '<link rel="stylesheet" href="' . $raiz_saia . 'css/bootstrap/saia/css/bootstrap-datetimepicker.min.css" type="text/css" />';
	return ($texto);
}

function librerias_highslide() {
	/*
	 * $texto="";
	 * $texto.='<script src="'.$raiz_saia.'anexosdigitales/highslide-4.0.10/highslide/highslide-full.js" type="text/javascript" charset="utf-8"></script>';
	 * $texto.='<link rel="stylesheet" href="'.$raiz_saia.'anexosdigitales/highslide-4.0.10/highslide/highslide.css" type="text/css" />';
	 * return($texto);
	 */
	/*global $raiz_saia;
	$texto = '';
	$texto .= '<script src="' . $raiz_saia . 'anexosdigitales/highslide-4.0.10/highslide/highslide-full.js" type="text/javascript" charset="utf-8"></script>';
	$texto .= '<link rel="stylesheet" href="' . $raiz_saia . 'anexosdigitales/highslide-4.0.10/highslide/highslide.css" type="text/css" />';
	return ($texto);*/
	global $raiz_saia;
	$texto = '';
	$texto .= '<script src="' . $raiz_saia . 'anexosdigitales/highslide-5.0.0/highslide/highslide-full.js" type="text/javascript" charset="utf-8"></script>';
	$texto .= '<link rel="stylesheet" href="' . $raiz_saia . 'anexosdigitales/highslide-5.0.0/highslide/highslide.css" type="text/css" />';
	return ($texto);

}

function librerias_zoom() {
	global $raiz_saia;
	$texto = '';
	$texto .= '<script src="' . $raiz_saia . 'js/jquery.jqzoom-core.js" type="text/javascript" charset="utf-8"></script>';
	$texto .= '<link rel="stylesheet" href="' . $raiz_saia . 'css/jquery.jqzoom.css" type="text/css">';
	return ($texto);
}

function librerias_rotate() {
	global $raiz_saia;
	$texto = '';
	$texto .= '<script src="' . $raiz_saia . 'js/jquery_rotate.js" type="text/javascript" charset="utf-8"></script>';
	return ($texto);
}

function librerias_file_upload() {
	global $raiz_saia;
	$texto = '';
	$texto .= '<script src="' . $raiz_saia . 'pantallas/anexos/js/jquery.ui.widget.js" type="text/javascript"></script>';
	$texto .= '<script src="' . $raiz_saia . 'pantallas/anexos/js/jquery.iframe-transport.js" type="text/javascript"></script>';
	$texto .= '<script src="' . $raiz_saia . 'pantallas/anexos/js/jquery.fileupload.js" type="text/javascript"></script>';
	$texto .= '<script src="' . $raiz_saia . 'pantallas/anexos/js/jquery.fileupload-process.js" type="text/javascript"></script>';
	$texto .= '<script src="' . $raiz_saia . 'pantallas/anexos/js/jquery.fileupload-validate.js" type="text/javascript"></script>';
	return ($texto);
}

function estilo_file_upload() {
	global $raiz_saia;
	$texto = '';
	$texto .= '<link rel="stylesheet" href="' . $raiz_saia . 'pantallas/anexos/css/jquery.fileupload-ui.css" type="text/css" />';
	return ($texto);
}

function librerias_jqcrop() {
	global $raiz_saia;

	$texto = '<script src="' . $raiz_saia . 'js/jquery.Jcrop.pack.js"></script>';
	$texto .= '<link rel="stylesheet" href="' . $raiz_saia . 'css/jquery.Jcrop.css" type="text/css" />';

	return ($texto);
}

function librerias_graficos() {
	global $raiz_saia;
	$texto = '<script src="' . $raiz_saia . 'js/echarts/echarts.js"></script>';
	return ($texto);
}
?>