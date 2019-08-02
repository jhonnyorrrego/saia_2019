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

include_once $ruta_db_superior . "core/autoload.php";
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
    'margen_izquierda' => $margenes[0],
    'margen_derecha' => $margenes[1],
    'margen_superior' => $margenes[2],
    'margen_inferior' => $margenes[3]
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
<?php if ($color["numcampos"]) : ?>
    <style type="text/css">
        .phpmaker {
            font-family: Verdana, Tahoma, arial;
            color: #000000;
        }

        .encabezado {
            background-color: <?= $color[0]["valor"] ?>;
            color: white;
            padding: 10px;
            text-align: left;
        }

        .encabezado_list {
            background-color: <?= $color[0]["valor"] ?>;
            color: white;
            vertical-align: middle;
            text-align: center;
            font-weight: bold;
        }
    </style>
<?php endif; ?>
<?php if ($fuente["numcampos"]) : ?>
    <style>
        #documento {
            font-size: <?= $formato[0]["font_size"] . 'px' ?>;
            font-family: <?= $fuente[0]["valor"] ?>
        }
    </style>
<?php endif; ?>
<?php
$userCode = SessionController::getValue('usuario_actual');
leido($userCode, $iddocumento);

if (!$formato[0]["item"] && $_REQUEST['tipo'] != 5) {
    if (!empty($_REQUEST["vista"])) {
        $vista = busca_filtro_tabla("encabezado", "vista_formato", "idvista_formato='" . $_REQUEST["vista"] . "'", "", $conn);
        $encabezado = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato='" . $vista[0]["encabezado"] . "'", "", $conn);
    } else {
        $encabezado = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato='" . $formato[0]["encabezado"] . "'", "", $conn);
    }
}
?>
<?php if (!$_REQUEST['tipo'] || ($_REQUEST['tipo'] && $_REQUEST['tipo'] != 5)) : ?>
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
        .page_margin_bottom {
            overflow: hidden;
            margin-left: 5%;
            margin-right: 5%;
            margin-top: 5%;
            margin-bottom: 5%;
        }

        .page_margin_top {
            height: <?= $tam_pagina["margen_superior"] . 'mm' ?>;
        }

        .page_margin_bottom {
            height: <?= $tam_pagina["margen_inferior"] . 'mm' ?>;
        }
    </style>
<?php endif; ?>

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