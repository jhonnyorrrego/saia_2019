<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ("../db.php");
include_once ("encabezado_pie_pagina.php");

//Definir estilos para tipo de letra y color de encabezado
$_REQUEST["iddoc"] = str_replace("'", "", stripslashes($_REQUEST["iddoc"]));
if (isset($_REQUEST["idformato"])) {
	$formato = busca_filtro_tabla("", "formato,documento", "lower(plantilla)=nombre and iddocumento=" . $_REQUEST["iddoc"] . " and idformato=" . $_REQUEST["idformato"], "", $conn);
	if (!$formato["numcampos"]) {
		$formato = busca_filtro_tabla("", "formato", "idformato=" . $_REQUEST["idformato"], "", $conn);
	}
} else {
	$formato = busca_filtro_tabla("", "formato,documento", "lower(plantilla)=nombre and iddocumento=" . $_REQUEST["iddoc"], "", $conn);
}
//Redirecciona en caso de que el documento sea visible en PDF.
if ($formato["numcampos"] && @$_REQUEST["tipo"] != 5) {
	if ($formato[0]["pdf"] && $formato[0]["mostrar_pdf"] == 1) {
		$parte_url="";
		if(isset($_REQUEST["menu_principal_inactivo"])){
			$parte_url="&menu_principal_inactivo=1";
		}
		$ruta = $ruta_db_superior . "pantallas/documento/visor_documento.php?iddoc=" . $formato[0]["iddocumento"].$parte_url;
		redirecciona($ruta . "&rnd=" . rand(0, 100));
	} else {
		if ($formato[0]["mostrar_pdf"] == 1) {
			$ruta = $ruta_db_superior . "pantallas/documento/visor_documento.php?iddoc=" . $formato[0]["iddocumento"] . "&actualizar_pdf=1";
			redirecciona($ruta . "&rnd=" . rand(0, 100));
		} else if ($formato[0]["mostrar_pdf"] == 2 && !@$_REQUEST['error_pdf_word']) {
			$ruta = $ruta_db_superior . "pantallas/documento/visor_documento.php?pdf_word=1&iddoc=" . $formato[0]["iddocumento"];
			redirecciona($ruta . "&rnd=" . rand(0, 100));
		}
	}
}

if ($_REQUEST["tipo"] != 5) {
	leido($_SESSION["usuario_actual"], $_REQUEST["iddoc"]);
	if (!isset($_REQUEST["menu_principal_inactivo"])) {
		include_once ($ruta_db_superior . "pantallas/documento/menu_principal_documento.php");
		menu_principal_documento($_REQUEST["iddoc"], 1);
	}
}

$config = busca_filtro_tabla("valor", "configuracion", "nombre='color_encabezado'", "", $conn);
$style="";
if ($config["numcampos"]) {
$style = "
<style type=\"text/css\">
	.phpmaker{
	font-family: Verdana,Tahoma,arial;
	color:#000000;
	}
	.encabezado{
	background-color:" . $config[0]["valor"] . ";
	color:white ;
	padding:10px;
	text-align: left;
	}
	.encabezado_list{
	background-color:" . $config[0]["valor"] . ";
	color:white ;
	vertical-align:middle;
	text-align: center;
	font-weight: bold;
	}
</style>";
}


$fuente = busca_filtro_tabla("valor", "configuracion", "nombre='tipo_letra'", "", $conn);
$doc = $_REQUEST["iddoc"];
$nombre = $formato[0]["nombre"];

if (isset($_REQUEST["font_size"]) && $_REQUEST["font_size"]) {
	$formato[0]["font_size"] = $_REQUEST["font_size"];
}

$tam_pagina = array();
$equivalencia = 5;
$margenes = explode(",", $formato[0]["margenes"]);

$tam_pagina["A4"]["ancho"] = 595;
$tam_pagina["A4"]["alto"] = 842;

$tam_pagina["A5"]["ancho"] = 595;
$tam_pagina["A5"]["alto"] = 420;

$tam_pagina["Letter"]["ancho"] = 850;
$tam_pagina["Letter"]["alto"] = 1098;

$tam_pagina["Legal"]["ancho"] = 793;
$tam_pagina["Legal"]["alto"] = 1122;

$tam_pagina["margen_derecha"] = $margenes[1] * $equivalencia;
$tam_pagina["margen_izquierda"] = $margenes[0]* $equivalencia;
$tam_pagina["margen_superior"] = $margenes[2] * $equivalencia;
$tam_pagina["margen_inferior"] = $margenes[3] * $equivalencia;

if ($formato[0]["orientacion"]) {
	$alto_paginador = $tam_pagina[$formato[0]["papel"]]["ancho"];
	$ancho_paginador = $tam_pagina[$formato[0]["papel"]]["alto"];
} else {
	$alto_paginador = $tam_pagina[$formato[0]["papel"]]["alto"];
	$ancho_paginador = $tam_pagina[$formato[0]["papel"]]["ancho"];
}

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php
			echo $style;
			if ($fuente["numcampos"]){
				if($_REQUEST["tipo"]!=5){
					echo "<style> body,table,tr,td,div,p,span { font-size:" . $formato[0]["font_size"] . "px; font-family:" . $fuente[0]["valor"] . "; }</style>";
				}else{
					echo "<style> body,table,tr,td,div,p,span { font-size:" . $formato[0]["font_size"] . "pt; font-family:" . $fuente[0]["valor"] . "; }</style>";
				}
			}
		?>
	</head>
	<body>
	<?php
	if ($_REQUEST["tipo"] != 5) {
		if (!$formato[0]["item"]) {
			if (isset($_REQUEST["vista"]) && $_REQUEST["vista"]) {
				$vista = busca_filtro_tabla("encabezado", "vista_formato", "idvista_formato='" . $_REQUEST["vista"] . "'", "", $conn);
				$encabezado = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato='" . $vista[0]["encabezado"] . "'", "", $conn);
			} else {
				$encabezado = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato='" . $formato[0]["encabezado"] . "'", "", $conn);
			}
		}
		if ($formato[0]["paginar"] == '1') {
			echo('<style type="text/css">
			.page_border { border: 1px solid #CACACA; margin-bottom: 8px; box-shadow: 0 0 4px rgba(0, 0, 0, 0.1); -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.1); -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.1); }
			.paginador_docs { width: ' . $ancho_paginador . 'px; height:' . $alto_paginador . 'px; margin:30px auto 30px auto; box-shadow: 5px 5px 13px #0f0e0e;}

			.page_margin_top {height:' . ($tam_pagina["margen_superior"]) . 'px; margin:20px '.$tam_pagina["margen_izquierda"].'px 10px '.$tam_pagina["margen_derecha"].'px;overflow: hidden; }
			.page_content {height: ' . ($alto_paginador - ($tam_pagina["margen_superior"] + $tam_pagina["margen_inferior"]+40)) . 'px; margin:0px '.$tam_pagina["margen_izquierda"].'px 0px '.$tam_pagina["margen_derecha"].'px;  overflow:hidden; }
			.page_margin_bottom {height:' . ($tam_pagina["margen_inferior"]) . 'px; margin:10px '.$tam_pagina["margen_izquierda"].'px 10px '.$tam_pagina["margen_derecha"].'px;overflow: hidden; }

			</style>
			<script>
				$(document).ready(function(){
					var alto_papel=' . ($alto_paginador) . ';
			    var alto_encabezado=' . ($tam_pagina["margen_superior"]+30) . ';
			    var alto_pie_pagina=' . ($tam_pagina["margen_inferior"]+20). ';
					var altopagina = alto_papel-(alto_encabezado+alto_pie_pagina);
			    var paginas=1;
			    var alto=0;
			    var inicial=$("#documento").offset().top;

			    alto = $("#page_overflow").height();
				  paginas =Math.ceil(alto/altopagina);
					var contenido = $("#page_overflow").html();
					var encabezado = $("#doc_header").html();
					var piedepagina = $("#doc_footer").html();

					for(i=1;i<paginas;i++){
						var altoPaginActual = altopagina*i;
						var pagina = \'<div id="pag-\'+i+\'" class="paginador_docs page_border"><div class="page_margin_top">\'+encabezado+\'</div><div id="pag_content-\'+i+\'" class="page_content"><div style="margin-top:-\'+altoPaginActual+\'px">\'+contenido+\'</div></div><div class="page_margin_bottom">\'+piedepagina+\'</div></div>\';
						$("#documento").append(pagina);
					}
				});
			</script>');
		} else {
			echo('<style type="text/css">
			.page_border { border: 1px solid #CACACA; margin-bottom: 8px; box-shadow: 0 0 4px rgba(0, 0, 0, 0.1); -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.1); -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.1); }
			.paginador_docs { width: ' . $ancho_paginador . 'px; margin:30px auto 30px auto; box-shadow: 5px 5px 13px #0f0e0e;}

			.page_margin_top {height:' . ($tam_pagina["margen_superior"]) . 'px; margin:20px '.$tam_pagina["margen_izquierda"].'px 10px '.$tam_pagina["margen_derecha"].'px;overflow: hidden; }
			.page_content {margin:0px '.$tam_pagina["margen_izquierda"].'px 0px '.$tam_pagina["margen_derecha"].'px;  overflow:hidden; }
			.page_margin_bottom {height:' . ($tam_pagina["margen_inferior"]) . 'px; margin:10px '.$tam_pagina["margen_izquierda"].'px 10px '.$tam_pagina["margen_derecha"].'px;overflow: hidden; }
			</style>');
		}
		$style="";
		if($_SESSION["tipo_dispositivo"]=="movil"){
			$style='style="width:'.($ancho_paginador+50).'px;"';
		}
		echo('<div id="documento" '.$style.'>
			<div id="pag-0" class="paginador_docs page_border">
				<div class="page_margin_top" id="doc_header">');
				if ($encabezado["numcampos"]) {
					if (!isset($_REQUEST["tipo"]) || $_REQUEST["tipo"] == 1) {
						$pagina = 0;
					} else {
						$pagina = 1;
					}
					echo crear_encabezado_pie_pagina(stripslashes($encabezado[0][0]), $_REQUEST["iddoc"], $formato[0]["idformato"], $pagina);
				}
			echo('</div>

		<div id="pag_content-0" class="page_content">
			<div id="page_overflow"><table style="width:100%">');
	} else {
		echo '<table border="0" width="100%" cellpadding="0" cellspacing="0">';
	}
?>