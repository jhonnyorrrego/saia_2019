<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';
include_once $ruta_db_superior . 'librerias_saia.php';
include_once $ruta_db_superior . 'pantallas/generador/librerias_pantalla.php';
include_once $ruta_db_superior . 'pantallas/lib/librerias_componentes.php';
include_once $ruta_db_superior . 'assets/librerias.php';
include_once $ruta_db_superior . 'arboles/crear_arbol_ft.php';

$idpantalla = 0;
$idencabezadoFormato = 0;
$contenidoEncabezado = 0;
$contenidoPie = 0;
$ocultarTexto = 0;
$publicar = 0;

if ($_REQUEST["idformato"]) {
    include_once $ruta_db_superior . "pantallas/generador/librerias.php";
    $idpantalla = $_REQUEST["idformato"];
    $camposNucleo = " and A.nombre not in('" . implode("', '", camposNucleo($idpantalla)) . "')";
    $camposFormato = busca_filtro_tabla("", "campos_formato A", "A.formato_idformato=" . $_REQUEST['idformato'] . " and etiqueta_html<>'campo_heredado' " . $camposNucleo . "", "A.orden", $conn);
    if ($camposFormato['numcampos']) {
        $ocultarTexto = 1;
    }
    $consulta_formato = busca_filtro_tabla("cuerpo,encabezado,pie_pagina,publicar,nombre", "formato f", "idformato=" . $idpantalla, "", $conn);
    if ($consulta_formato['numcampos']) {
        $publicar = $consulta_formato[0]['publicar'];
        if ($consulta_formato[0]['cuerpo']) {
            $contenido_formato = json_encode($consulta_formato[0]['cuerpo']);
        }
        if ($consulta_formato[0]['encabezado']) {
            $idencabezadoFormato = $consulta_formato[0]['encabezado'];
            $consultaEncabezado = busca_filtro_tabla("contenido,etiqueta", "encabezado_formato", "idencabezado_formato=" . $consulta_formato[0]['encabezado'], "", $conn);
            $contenidoEncabezado = json_encode($consultaEncabezado[0]['contenido']);
        }
        if ($consulta_formato[0]['pie_pagina']) {
            $consultaPie = busca_filtro_tabla("contenido,etiqueta", "encabezado_formato", "idencabezado_formato=" . $consulta_formato[0]['pie_pagina'], "", $conn);
            $contenidoPie = json_encode($consultaPie[0]['contenido']);
            $idpie = $consulta_formato[0]['pie_pagina'];
        }
    }
}

/////////////////////////////////////////// Configuracion del arbol /////////////////////////////////////////////////////

$origen = array("url" => "arboles/arbol_formatos.php", "ruta_db_superior" => $ruta_db_superior, "params" => array("id" => $_REQUEST['idformato'], "cargar_seleccionado" => 1));
$opciones_arbol = array("keyboard" => true, "onNodeClick" => "evento_click", "busqueda_item" => 1);
$extensiones = array("filter" => array());
$arbol = new ArbolFt("campo_idformato", $origen, $opciones_arbol, $extensiones, $validaciones);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Generador Pantallas SAIA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo ($ruta_db_superior); ?>pantallas/generador/css/generador_pantalla.css" rel="stylesheet">

    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= theme() ?>
    <?= jqueryUi() ?>
    <?= icons() ?>
    <?= librerias_arboles_ft("2.24", 'filtro') ?>

    <?php


    $campos = busca_filtro_tabla("", "pantalla_componente B", "nombre not in ('textarea_tiny')", "", $conn);
    $librerias_js = array();
    $librerias_jsh = array();

    for ($i = 0; $i < $campos["numcampos"]; $i++) {
        $librerias = array_filter(array_map('trim', explode(",", $campos[$i]["librerias"])));
        foreach ($librerias as $libreria) {
            $extension = explode(".", $libreria);
            $cant = count($extension);
            if ($extension[$cant - 1] !== '') {
                switch ($extension[($cant - 1)]) {
                    case "php":
                        include_once($ruta_db_superior . $libreria);
                        break;
                    case "js":
                        array_push($librerias_js, $libreria);
                        break;
                    case "js@h":
                        $header = array_filter(explode("@", $libreria));
                        if (!empty($header) && !in_array($header[0], $librerias_jsh)) {
                            array_push($librerias_jsh, $header[0]);
                            echo ('<script type="text/javascript" src="' . $ruta_db_superior . $header[0] . '"></script>');
                        }
                        break;
                    case "css":
                        $texto = '<link rel="stylesheet" type="text/css" href="' . $ruta_db_superior . $libreria . '"/>';
                        break;
                    default:
                        $texto = ""; // retorna un vacio si no existe el tipo
                        break;
                }
                echo $texto;
            }
        }
    }

    ?>

    <script src="<?php echo $ruta_db_superior; ?>js/ckeditor/4.11/ckeditor_cust/ckeditor.js"></script>

</head>

<body>

    <div class="container-fluid mx-4 px-0">
        <div class="row">


            <div class="col-12 col-sm-12 col-md-3 col-lg-2 mx-0">
                <div class="section">
                    <div class="col-12 px-0 mb-2">
                        <?= $arbol->generar_html() ?>
                    </div>
                </div>
                <script src="js/funciones_arbol.js"></script>
            </div>

            <div class="col-12 col-sm-12 col-md-9 col-lg-9 pl-1" id="contenedor_generador" style="border-left:1px solid #eee;">

                <div class="tabbable section">

                    <ul class="nav nav-tabs" id="tabs_formulario">
                        <li style="width:225px;" class="button_tab_formulario active" id="pantalla_principal">
                            <a href="#datos_formulario-tab" data-toggle="tab" id="nav-active" style="text-align:center;">Paso 1. Informaci&oacute;n</a>
                            <div class="progress-circle-indeterminate"></div>
                        </li>
                        <li style="width:225px" class="button_tab_formulario" id=" generar_formulario_pantalla">
                            <a href="#formulario-tab" data-toggle="tab" style="text-align:center;">
                                <center>Paso 2. Campos</center>
                            </a>
                        </li>
                        <!-- <li>
                                <a href="#librerias_formulario-tab" data-toggle="tab">3-Librerias</a>
                            </li> -->
                        <li style="width:225px" class="button_tab_formulario" id=" diseno_formulario_pantalla">
                            <a href="#pantalla_mostrar-tab" data-toggle="tab" style="text-align:center;">Paso 3. Dise&ntilde;o</a>
                        </li>
                        <li style="width:225px;" class="button_tab_formulario" id=" vista_formulario_pantalla">
                            <a href="#pantalla_previa-tab" data-toggle="tab" style="text-align:center;">Vista previa</a>
                        </li>
                        <!-- li>
                                <a href="#pantalla_listar-tab" data-toggle="tab">5-listar</a>
                            </li -->
                        <!--<li>
                                        <a href="#encabezado_pie-tab" data-toggle="tab">5-Encabezado pie</a>
                            </li>-->
                        <!--li>
                                    <a href="#asignar_funciones-tab" data-toggle="tab">6-Asignar funciones</a>
                                </li-->
                        <li>
                            <!--<a href="#generar_formulario-tab" data-toggle="tab">Publicar</a>-->
                            <div class="container-fluid">
                                <div class="row" class="col-3 offset2" style="float:left">
                                    <button style="background: #48b0f7; color:fff; margin-top:3px; margin-left:10px;margin-bottom: 7px; display:none;" name="adicionar" class="btn btn-info" id="enviar_datos_formato" value="adicionar_datos_formato" style="background: #48b0f7;color:fff;"><span style="color:fff; background: #48b0f7;">Siguiente</span></button>
                                    <button style="background: #48b0f7; color:fff; margin-top:3px; margin-left:10px;margin-bottom: 7px; display:none;" class="btn btn-info" id="cambiar_nav"><span style="color:fff; background: #48b0f7;">Siguiente</span></button>
                                    <button style="background: #48b0f7; color:fff; margin-top:3px; margin-left:10px;margin-bottom: 7px; display:none;" class="btn btn-info" id="cambiar_nav_basico"><span style="color:fff; background: #48b0f7;">Siguiente</span></button>
                                    <button style="background: #48b0f7; color:fff; margin-top:3px; margin-left:10px;margin-bottom: 7px; display:none;" class="btn btn-info" data-vista="vista_previa" id="cambiar_vista"><span style="color:fff; background: #48b0f7;"> Siguiente</span></button>
                                    <button style="background: #48b0f7; color:fff; margin-top:3px; margin-left:10px;margin-bottom: 7px; display:none;" class="btn btn-info" id="cambiar_nav_permiso">Siguiente</button>
                                    <div id="barra_principal_formato" class="barra_principal_formato" style="margin-left:10px; width:85%; display:none">
                                        <div class="progress progress-striped active" style="margin-bottom: 7px;">
                                            <div class="bar bar-success" id="barra_formato"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane" id="librerias_formulario-tab">
                            <div id="configurar_libreria_pantalla"></div>
                            <div id="librerias_en_uso"></div>
                        </div>


                        <div class="tab-pane" id="asignar_funciones-tab">
                            <?php include_once "asignar_funciones.php"; ?>
                        </div>

                        <div class="tab-pane" id="generar_formulario-tab">

                            <div class="accordion" id="acordion_generar">

                            </div>
                            <!--<div >
                                    <button id="generar_pantalla" class="btn btn-primary">Generar<span id="cargando_generar_pantalla"></span></button>
                                </div>-->
                        </div>
                    </div>
                </div>



                <div class="tab-pane" id="datos_formulario-tab">
                    <?php
                    include_once $ruta_db_superior . 'pantallas/generador/datos_pantalla.php';
                    ?>
                </div>



            </div>







            <div class="col-12 col-sm-12 col-md-3 col-lg-3">



            </div>


        </div>
    </div>

</body>

</html>

<?php

//// Aqui estaban los llamados a librerias viejas /////////////////////////////////////

echo icons();
$cant_js = count($librerias_js);
$incluidas = array();
for ($i = 0; $i < $cant_js; $i++) {
    if (!in_array($librerias_js[$i], $librerias_jsh) && !in_array($librerias_js[$i], $incluidas) && !empty($librerias_js[$i])) {
        array_push($incluidas, $librerias_js[$i]);
        echo ('<script type="text/javascript" src="' . $ruta_db_superior . $librerias_js[$i] . '"></script>');
    }
}
?>