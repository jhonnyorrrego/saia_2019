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


$documentId = $_REQUEST['iddoc'];
$Documento = new Documento($documentId);
$Formato = $Documento->getFormat();

$margenes = explode(",", $Formato->margenes);
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

if ($Formato->orientacion) {
    $alto_paginador = $tam_pagina[$Formato->papel]["ancho"];
    $ancho_paginador = $tam_pagina[$Formato->papel]["alto"];
} else {
    $alto_paginador = $tam_pagina[$Formato->papel]["alto"];
    $ancho_paginador = $tam_pagina[$Formato->papel]["ancho"];
}

$porcentajePaginador = ($alto_paginador * 100) / $ancho_paginador;
$porcentajePx = $porcentajePaginador * $ancho_paginador / 100;

$ConfiguracionColor = Configuracion::findByAttributes([
    'nombre' => 'color_encabezado'
]);

$ConfiguracionLetra = Configuracion::findByAttributes([
    'nombre' => 'tipo_letra'
]);
?>
<?php if ($ConfiguracionColor) : ?>
    <style type="text/css">
        .phpmaker {
            font-family: Verdana, Tahoma, arial;
            color: #000000;
        }

        .encabezado {
            background-color: <?= $ConfiguracionColor->valor ?>;
            color: white;
            padding: 10px;
            text-align: left;
        }

        .encabezado_list {
            background-color: <?= $ConfiguracionColor->valor ?>;
            color: white;
            vertical-align: middle;
            text-align: center;
            font-weight: bold;
        }
    </style>
<?php endif; ?>
<?php if ($ConfiguracionLetra) : ?>
    <style>
        #documento {
            font-size: <?= $Formato->font_size . 'px' ?>;
            font-family: <?= $ConfiguracionLetra->valor ?>
        }
    </style>
<?php endif; ?>
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
        .page_margin_bottom {
            overflow: hidden;
            margin-left: 5%;
            margin-right: 5%;
            margin-top: 5%;
            margin-bottom: 5%;
        }

        .page_content {

            overflow: hidden;
            margin-left: 5%;
            margin-right: 5%;
            margin-top: 0%;
            margin-bottom: 5%;

        }

        .page_margin_top {
            height: <?= $tam_pagina["margen_superior"] . 'mm' ?>;
        }

        .page_margin_bottom {
            height: <?= $tam_pagina["margen_inferior"] . 'mm' ?>;
        }
    </style>
<?php endif;

if ($_REQUEST['tipo'] != 5) {
    $EncabezadoFormato = $Formato->getHeader();
    echo crear_encabezado_pie_pagina($EncabezadoFormato->contenido, $documentId, $Formato->getPK(), 0);
}
