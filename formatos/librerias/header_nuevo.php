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
} else if ($idformato) {
    $formato = busca_filtro_tabla("", "formato a,documento b", "lower(b.plantilla)= lower(a.nombre) and a.idformato=" . $idformato, "", $conn);
} else {
    throw new Exception("Error Processing Request", 1);
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
    .phpmaker {
        font-family: Verdana, Tahoma, arial;
        color: #000000;
    }

    .encabezado {
        background-color: <?=$color[0]["valor"] ?>;
        color: white;
        padding: 10px;
        text-align: left;
    }

    .encabezado_list {
        background-color: <?=$color[0]["valor"] ?>;
        color: white;
        vertical-align: middle;
        text-align: center;
        font-weight: bold;
    }
    </style>
    <?php endif; ?>
    <?php if ($fuente["numcampos"]) : ?>
    <style>
    #documento>table tr td div p span {
        font-size: <?=$formato[0]["font_size"] . 'px'?>;
        font-family: <?=$fuente[0]["valor"] ?>
    }
    </style>
    <?php endif; ?>
    <?php
        leido($_SESSION["usuario_actual"], $iddocumento);

        if (!$formato[0]["item"] && $_REQUEST['tipo'] != 5) {
            if (!empty($_REQUEST["vista"])) {
                $vista = busca_filtro_tabla("encabezado", "vista_formato", "idvista_formato='" . $_REQUEST["vista"] . "'", "", $conn);
                $encabezado = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato='" . $vista[0]["encabezado"] . "'", "", $conn);
            } else {
                $encabezado = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato='" . $formato[0]["encabezado"] . "'", "", $conn);
            }
        } 
    ?>
    <script>
    var ancho = "<?= $ancho_paginador ?>";
    var alto = "<?= $alto_paginador ?>";
    </script>
    <?php if(!$_REQUEST['tipo'] || ($_REQUEST['tipo'] && $_REQUEST['tipo'] != 5)): ?>
        <style type="text/css">
        .page_border {
            border: 1px solid #CACACA;
            margin-bottom: 8px;
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
            -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
            box-shadow: 2px 2px 8px #c6c6c6;
        }
        </style>
    <?php endif; ?>

    <style type="text/css">
    .page_margin_top,
    .page_content,
    .page_margin_bottom {
        overflow: hidden;
        margin-left: 5%;
        margin-right: 5%;
        margin-top: 5%;
        margin-bottom: 5%;
    }

    .page_margin_top {
        height: <?=$tam_pagina["margen_superior"] . 'px'?>;
    }

    .page_margin_bottom {
        height: <?=$tam_pagina["margen_inferior"] . 'px'?>;
    }
    </style>
</head>

<body>
    <div class="container bg-master-lightest mx-0 px-2 px-md-2 mw-100">
        <div id="documento" class="row p-0 m-0">
            <div id="pag-0" class="col-12 page_border bg-white">
                <div class="page_margin_top mb-0" id="doc_header">
                    <?php if ($encabezado["numcampos"]) {
                    echo crear_encabezado_pie_pagina(stripslashes($encabezado[0][0]), $iddocumento, $formato[0]["idformato"], 0);
                } ?>
                </div>
                <div id="pag_content-0" class="page_content">
                    <div id="page_overflow">