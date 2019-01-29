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

include_once $ruta_db_superior . "db.php";
include_once $ruta_db_superior . "formatos/librerias/encabezado_pie_pagina.php";

global $conn;

$iddocumento = $_REQUEST['iddoc'];
$idformato = $_REQUEST['idformato'];

if ($iddocumento) {
    $formato = busca_filtro_tabla("", "formato a,documento b", "lower(b.plantilla)= lower(a.nombre) and b.iddocumento=" . $iddocumento, "", $conn);

    if (isset($_REQUEST["font_size"]) && $_REQUEST["font_size"]) {
        $formato[0]["font_size"] = $_REQUEST["font_size"];
    }
} else if ($idformato) {
    $formato = busca_filtro_tabla("", "formato a,documento b", "lower(b.plantilla)= lower(a.nombre) and a.idformato=" . $idformato, "", $conn);
} else {
    throw new Exception("Error Processing Request", 1);
}

if ($formato["numcampos"] && $_REQUEST["tipo"] != 5) {
    if ($formato[0]["pdf"] && $formato[0]["mostrar_pdf"] == 1) {
        if (isset($_REQUEST["menu_principal_inactivo"])) {
            $parte_url = "&menu_principal_inactivo=1";
        } else {
            $parte_url = "";
        }

        $ruta = $ruta_db_superior . "pantallas/documento/visor_documento.php?iddoc=" . $iddocumento . $parte_url;
        redirecciona($ruta . "&rnd=" . rand(0, 100));
    } else {
        if ($formato[0]["mostrar_pdf"] == 1) {
            $ruta = $ruta_db_superior . "pantallas/documento/visor_documento.php?iddoc=" . $iddocumento . "&actualizar_pdf=1";
            redirecciona($ruta . "&rnd=" . rand(0, 100));
        } else if ($formato[0]["mostrar_pdf"] == 2 && !$_REQUEST['error_pdf_word']) {
            $ruta = $ruta_db_superior . "pantallas/documento/visor_documento.php?pdf_word=1&iddoc=" . $iddocumento;
            redirecciona($ruta . "&rnd=" . rand(0, 100));
        }
    }
}

$margenes = explode(",", $formato[0]["margenes"]);
$tam_pagina = [
    'A4' => [
        'ancho' => 595,
        'alto' => 842
    ],
    'A5' => [
        'ancho' => 595,
        'alto' => 420
    ],
    'Letter' => [
        'ancho' => 850,
        'alto' => 1098
    ],
    'Legal' => [
        'ancho' => 793,
        'alto' => 1122
    ],
    'margen_izquierda' => $margenes[0] * 5,
    'margen_derecha' => $margenes[1] * 5,
    'margen_superior' => $margenes[2] * 5,
    'margen_inferior' => $margenes[3] * 5
];

if ($formato[0]["orientacion"]) {
    $alto_paginador = $tam_pagina[$formato[0]["papel"]]["ancho"];
    $ancho_paginador = $tam_pagina[$formato[0]["papel"]]["alto"];
} else {
    $alto_paginador = $tam_pagina[$formato[0]["papel"]]["alto"];
    $ancho_paginador = $tam_pagina[$formato[0]["papel"]]["ancho"];
}

$porcentajePaginador = ($alto_paginador * 100) / $ancho_paginador;
$porcentajePx = $porcentajePaginador * $ancho_paginador / 100;

$color = busca_filtro_tabla("valor", "configuracion", "nombre='color_encabezado'", "", $conn);
$fuente = busca_filtro_tabla("valor", "configuracion", "nombre='tipo_letra'", "", $conn);
?>
<html class="f-12">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
       
        <?php if ($color["numcampos"]) : ?>
            <style type="text/css">
                .phpmaker{
                    font-family: Verdana,Tahoma,arial;
                    color:#000000;
                }
                .encabezado{
                    background-color: <?= $color[0]["valor"] ?>;
                    color:white;
                    padding: 10px;
                    text-align: left;
                }
                .encabezado_list{
                    background-color: <?= $color[0]["valor"] ?>;
                    color:white;
                    vertical-align:middle;
                    text-align: center;
                    font-weight: bold;
                }
            </style>
        <?php endif; ?>
        <?php if ($fuente["numcampos"]) : ?>
            <?php if ($_REQUEST["tipo"] != 5) : ?>
                <style>
                    #documento > table tr td div p span {
                        font-size : <?= $formato[0]["font_size"] . 'px' ?>;
                        font-family : <?= $fuente[0]["valor"] ?>
                    }
                </style>
            <?php else : ?>
                <style>
                    #documento >table tr td div p span {
                        font-size: <?= $formato[0]["font_size"] . 'pt' ?>;
                        font-family: <?= $fuente[0]["valor"] ?>
                    }
                </style>
            <?php endif; ?>
        <?php endif; ?>  
        <?php if ($_REQUEST['tipo'] != 5) :
            leido($_SESSION["usuario_actual"], $iddocumento);

        if (!$formato[0]["item"]) {
            if (isset($_REQUEST["vista"]) && $_REQUEST["vista"]) {
                $vista = busca_filtro_tabla("encabezado", "vista_formato", "idvista_formato='" . $_REQUEST["vista"] . "'", "", $conn);
                $encabezado = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato='" . $vista[0]["encabezado"] . "'", "", $conn);
            } else {
                $encabezado = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato='" . $formato[0]["encabezado"] . "'", "", $conn);
            }
        } ?>
                <script>
                var ancho =  "<?= $ancho_paginador ?>";
                var alto =  "<?= $alto_paginador ?>";
                     
                </script>
            <style type="text/css">
                .page_border {
                    border: 1px solid #CACACA;
                    margin-bottom: 8px;
                    box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
                    -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
                    -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
                    box-shadow: 2px 2px 8px #c6c6c6;
                }

                .page_margin_top,
                .page_content,
                .page_margin_bottom{
                    overflow:hidden;
                    margin-left: 5%;
                    margin-right: 5%;
                    margin-top: 5%;
                    margin-bottom: 5%;
                }

                .page_margin_top {
                    height: <?= $tam_pagina["margen_superior"] . 'px' ?>;
                    
                }

                .page_content {
                    height: <?= $porcentajePx - $tam_pagina["margen_superior"] - $tam_pagina["margen_inferior"] . 'px' ?>;
                }

                .page_margin_bottom {
                    height: <?= $tam_pagina["margen_inferior"] . 'px' ?>;
                }
            </style>
            <?php if ($formato[0]["paginar"] == '1') : ?>
                <script>
                    $(document).ready(function(){
                        var alto_papel = '<?= $alto_paginador ?>';
                        var alto_encabezado = '<?= $tam_pagina["margen_superior"] + 30 ?>';
                        var alto_pie_pagina = '<?= $tam_pagina["margen_inferior"] + 20 ?>';
                        var altopagina = alto_papel-(alto_encabezado+alto_pie_pagina);
                        var alto = $("#page_overflow").height();
                        var paginas = Math.ceil(alto/altopagina);
                        var contenido = $("#page_overflow").html();
                        var encabezado = $("#doc_header").html();
                        var piedepagina = $("#doc_footer").html();

                        for(i = 1;i < paginas;i++){
                            var altoPaginActual = altopagina*i;
                            var pagina = `
                            <div id="pag-${i}" class="col-12 page_border bg-white">
                                <div class="page_margin_top">${encabezado}</div>
                                <div id="pag_content-${i}" class="page_content">
                                    <div style="margin-top:-${altoPaginActual}'px">${contenido}</div>
                                </div>
                                <div class="page_margin_bottom">${piedepagina}</div>
                            </div>`;
                            $("#documento").append(pagina);
                        }
                    });
                </script>
            <?php endif; ?>
        <?php endif; ?>
	</head>
	<body>
<?php if ($_REQUEST["tipo"] != 5) : ?>
    <div class="container bg-master-lightest mx-0 px-2 px-md-2 mw-100">
        <div id="documento" class="row p-0 m-0">
            <div id="pag-0" class="col-12 page_border bg-white">
                <div class="page_margin_top" id="doc_header">
                    <?php if ($encabezado["numcampos"]) {
                        if (!isset($_REQUEST["tipo"]) || $_REQUEST["tipo"] == 1) {
                            $pagina = 0;
                        } else {
                            $pagina = 1;
                        }
                        echo crear_encabezado_pie_pagina(stripslashes($encabezado[0][0]), $iddocumento, $formato[0]["idformato"], $pagina);
                    } ?>
                </div>
                <div id="pag_content-0" class="page_content">
                    <div id="page_overflow">
                        <table style="width:100%">
<?php else : ?>
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
<?php endif; ?>
