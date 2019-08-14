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
include_once $ruta_db_superior . 'pantallas/generador/librerias_pantalla.php';
//include_once $ruta_db_superior . 'pantallas/lib/librerias_componentes.php';
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

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
    <?= fancyTree('filter') ?>
    <?= librerias_tooltips() ?>

    <?php


    $campos = busca_filtro_tabla("nombre", "pantalla_componente B", "nombre not in ('textarea_tiny')", "", $conn);
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

    <div class="container-fluid ml-0 pl-0">

        <div class="row my-2 ml-0">

            <div class="col-12 col-sm-12 col-md-3 col-lg-2 mx-0">
                <div class="section">
                    <div class="col-12 px-0 mb-2">
                        <?= $arbol->generar_html() ?>
                    </div>
                </div>
                <script src="js/funciones_arbol.js"></script>
            </div>


            <div class="col-12 col-sm-12 col-md-9 col-lg-10 mx-0">


                <ul class="nav nav-tabs" id="tabs_formulario">
                    <li style="width:225px;" class="button_tab_formulario" id="pantalla_principal">
                        <a href="#datos_formulario-tab" data-toggle="tab" id="nav-informacion" style="text-align:center;">Paso 1. Informaci&oacute;n</a>
                    </li>
                    <li style="width:225px" class="button_tab_formulario" id="generar_formulario_pantalla">
                        <a href="#formulario-tab" data-toggle="tab" id="nav-campos" style="text-align:center;width:100%;height:100%;">Paso 2. Campos</a>
                    </li>

                    <li style="width:225px" class="button_tab_formulario" id="diseno_formulario_pantalla">
                        <a href="#pantalla_mostrar-tab" data-toggle="tab" id="nav-mostrar" style="text-align:center;width:100%;height:100%">Paso 3. Dise&ntilde;o</a>
                    </li>
                    <li style="width:225px;" class="button_tab_formulario" id="vista_formulario_pantalla">
                        <a href="#pantalla_previa-tab" data-toggle="tab" id="nav-vista_previa" style="text-align:center;;width:100%;height:100%">Vista previa</a>
                    </li>
                </ul>

                <div style="position:absolute;right:0px;top:0px;">

                    <label style="background: #48b0f7; color:fff; margin-top:3px; margin-left:10px;margin-bottom: 7px;color:white;cursor:pointer;height:44px;width:140px;padding-left:32px;padding-top:10px;">PUBLICAR</label>

                    <div id="barra_principal_formato" class="barra_principal_formato" style="margin-left:10px; width:85%; display:none">
                        <div class="progress progress-striped active" style="margin-bottom: 7px;">
                            <div class="bar bar-success" id="barra_formato"></div>
                        </div>
                    </div>

                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 pl-1 mr-4" id="contenedor_generador" style="border-left:1px solid #eee;">

                    <div class="tabbable section">

                        <div class="tab-content" style="text-align:left;">


                            <div class="tab-pane" id="pantalla_previa-tab" style="background:#eee;padding-top:30px;padding-bottom:30px">
                                <div id="pantalla_vista_previa" style="background:#fff;margin:30px;"></div>

                            </div>


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
                            </div>

                            <div class="tab-pane" id="pantalla_mostrar-tab"><br>
                                <h5 class="title">Encabezado del formato</h5><br>
                                <select name="sel_encabezado" id="sel_encabezado">
                                    <option value="0">Por favor Seleccione</option>
                                    <?php
                                    $encabezados = busca_filtro_tabla("", "encabezado_formato", "1=1", "etiqueta", $conn);
                                    $contenido_enc = array();
                                    $etiqueta_enc = array();

                                    if ($idpantalla) {
                                        $idencabezado = $idencabezadoFormato;
                                        $etiqueta_encabezado = json_encode($consultaEncabezado[0]['etiqueta']);
                                    } else {
                                        $idencabezado = 0;
                                        $etiqueta_encabezado = "";
                                    }

                                    for ($i = 0; $i < $encabezados["numcampos"]; $i++) {
                                        $contenido_enc[$encabezados[$i]["idencabezado_formato"]] = $encabezados[$i]["contenido"];
                                        $etiqueta_enc[$encabezados[$i]["idencabezado_formato"]] = $encabezados[$i]["etiqueta"];
                                        echo ("<option value='" . $encabezados[$i]["idencabezado_formato"] . "'");
                                        if ($encabezados[$i]["idencabezado_formato"] == $datos_formato[0]["encabezado"]) {
                                            $idencabezado = $encabezados[$i]["idencabezado_formato"];
                                            $etiqueta_encabezado = $encabezados[$i]["etiqueta"];
                                            echo (' selected="selected" ');
                                        }
                                        echo (">" . $encabezados[$i]["etiqueta"] . "</option>");
                                    }
                                    ?>
                                </select>
                                <span style="cursor:pointer;font-size:18px;margin-left: 5px;" class="crear_encabezado" id="crear_encabezado">
                                    <i class="fa fa-plus-circle"></i>
                                </span>
                                <span style="cursor:pointer;font-size:18px;margin-left: 5px;" class="guardar_encabezado" id="adicionar_encabezado">
                                    <i class="fa fa-edit"></i>
                                </span>
                                <span style="cursor:pointer;font-size:18px;margin-left: 5px;" <?php echo ($idencabezado ? "" : "disabled"); ?> id="eliminar_encabezado">
                                    <i class="fa fa-trash"></i>
                                </span>
                                <form name="formulario_editor_encabezado" id="formulario_editor_encabezado" action="">
                                    <input type="hidden" name="idencabezado" id="idencabezado" value="<?php echo $idencabezado; ?>">
                                    <input type="hidden" name="idformato" id="idformato" value="<?php echo $idpantalla; ?>">
                                    <input type="hidden" name="accion_encab" id="accion_encabezado" value="1">
                                    <div id="div_etiqueta_encabezado">
                                        <label style="display:none" for="etiqueta_encabezado">Etiqueta:
                                            <input type="hidden" id="etiqueta_encabezado" name="etiqueta_encabezado" value="<?php echo $etiqueta_encabezado; ?>"></label>
                                    </div>
                                    <div id="encabezado_formato" name="encabezado_formato" class="container-fluid">
                                        <?php
                                        if ($idencabezado) {
                                            echo $contenido_enc[$idencabezado];
                                        }
                                        ?>
                                    </div>
                                </form>
                                <h5 class="title">Cuerpo del formato</h5><br>
                                <form name="formulario_editor_mostrar" id="formulario_editor_mostrar" action="">
                                    <textarea name="editor_mostrar" id="editor_mostrar" class="">
                                            <?= $datos_formato[0]["cuerpo"]; ?>
                                        </textarea>
                                    <script>
                                        var editor_mostrar = CKEDITOR.replace("editor_mostrar");
                                    </script>
                                </form>
                                <button style="background: #48b0f7;color:fff;float:right" class="btn btn-info" id="actualizar_cuerpo_formato"><span style="color:fff; background: #48b0f7;"> Guardar
                                        cambios</span></button><br><br>
                                <h5>Pie del formato :</h5><br>
                                <select name="sel_pie_pagina" id="sel_pie_pagina">
                                    <option value="0">Por favor Seleccione</option>
                                    <?php
                                    if ($idpantalla) {
                                        $idpie = $idpie;
                                        $etiqueta_pie = json_encode($consultaPie[0]['etiqueta']);
                                    } else {
                                        $idpie = 0;
                                        $etiqueta_pie = "";
                                    }
                                    $pie_pagina = $encabezados; // No volver a consultar	
                                    for ($i = 0; $i < $pie_pagina["numcampos"]; $i++) {
                                        echo ("<option value='" . $pie_pagina[$i]["idencabezado_formato"] . "'");
                                        if ($pie_pagina[$i]["idencabezado_formato"] == $datos_formato[0]["pie_pagina"]) {
                                            $idpie = $pie_pagina[$i]["idencabezado_formato"];
                                            $etiqueta_pie = $pie_pagina[$i]["etiqueta"];
                                            echo (' selected="selected" ');
                                        }
                                        echo (">" . $pie_pagina[$i]["etiqueta"] . "</option>");
                                    }
                                    ?>
                                </select>
                                <span style="cursor:pointer;font-size:18px;margin-left: 5px;" class="crear_pie" id="crear_pie">
                                    <i class="fa fa-plus-circle"></i>
                                </span>
                                <span style="cursor:pointer;font-size:18px;margin-left: 5px;" class="guardar_pie" id="adicionar_pie">
                                    <i class="fa fa-edit"></i>
                                </span>
                                <span style="cursor:pointer;font-size:18px;margin-left: 5px;" <?php echo ($idpie ? "" : "disabled"); ?> id="eliminar_pie">
                                    <i class="fa fa-trash"></i>
                                </span>
                                <form name="formulario_editor_pie" id="formulario_editor_pie" action="" style="">
                                    <input type="hidden" name="idpie" id="idpie" value="<?php echo $idpie; ?>">

                                    <div id="div_etiqueta_pie">
                                        <label style="display:none" for="etiqueta_pie">Etiqueta: </label>
                                        <input type="hidden" id="etiqueta_pie" name="etiqueta_pie" value="<?php echo $etiqueta_pie; ?>">
                                    </div>
                                    <div id="pie_formato" name="pie_formato"></div>

                                </form><br>

                                <script type="text/javascript">
                                    var encabezados = <?php echo json_encode($contenido_enc); ?>;
                                    var idencabezado = <?php echo $idencabezadoFormato; ?>;
                                    var etiquetas = <?php echo json_encode($etiqueta_enc); ?>;
                                </script>
                            </div>




                            <div class="tab-pane" id="formulario-tab">
                                <div id="droppable">
                                    <ul id="list">
                                        <li id="list_one" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Arrastre los campos aquí</li>
                                        <?php
                                        $formatosCampo = load_pantalla($idpantalla);
                                        if ($formatosCampo) : ?>
                                        <?= $formatosCampo;  ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>


                            <div class="tab-pane" id="datos_formulario-tab">
                                <?php
                                include_once $ruta_db_superior . 'pantallas/generador/datos_pantalla.php';
                                ?>

                                <div class="tab-pane" id="pantalla_previa-permiso" style="">

                                    <h5 class="title">Permisos del formato a:</h5><br>
                                    <hr>
                                    <input type="hidden" id="nombreFormato" value="<?= $consulta_formato[0]['nombre']; ?>">
                                    <?= consultarPermisosPerfil($consulta_formato[0]['nombre']); ?>

                                    <button style="background: #48b0f7; color:fff;margin-top: 20px; margin-bottom: 7px;display:none;" id="generar_pantalla">Publicar</button>
                                </div>

                            </div>


                        </div>
                    </div>

                </div>

                <div class="col-12 col-sm-12 col-md-3 col-lg-3">

                    <div class="tabbable" id="componentes_acciones">
                        <ul class="nav" id="tabs_opciones">
                            <li class="active invisible" id="componente_tab">
                                <a href="#componentes-tab" data-toggle="tab">Componentes</a>
                            </li>
                            <li id="funciones_tab" class="invisible">
                                <a href="#funciones-tab" data-toggle="tab">Funciones</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="contenidos_componentes">
                            <div class="tab-pane active" id="componentes-tab" style="overflow:auto;">
                            </div>

                            <div class="tab-pane" id="librerias-tab">
                            </div>

                            <div class="tab-pane" id="funciones-tab">
                                <input type="hidden" name="idpantalla_funcion_exe" id="idpantalla_funcion_exe">
                                <input type="hidden" name="nombre_funcion_insertar" id="nombre_funcion_insertar">
                                <div id="funciones_desplegables" style="height:90%;">
                                </div>
                            </div>

                        </div>

                    </div>


                </div>

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

<script>
    $(document).ready(function() {

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {

            var anterior = e.relatedTarget.toString().split("#");
            var id = e.target.toString().split("#");

            switch (id[1]) {

                case 'datos_formulario-tab':
                    normalNavs();
                    maximizar_pantalla();
                    $('#nav-informacion').css({
                        'color': '#fff',
                        'background': '#49b0e8',
                        'font-weight': 'bold'
                    });
                    break;

                case 'formulario-tab':
                    normalNavs();
                    minimizar_pantalla();
                    $('#nav-campos').css({
                        'color': '#fff',
                        'background': '#49b0e8',
                        'font-weight': 'bold'
                    });
                    break;

                case 'pantalla_mostrar-tab':
                    normalNavs();
                    minimizar_pantalla();
                    $('#nav-mostrar').css({
                        'color': '#fff',
                        'background': '#49b0e8',
                        'font-weight': 'bold'
                    });
                    break;

                case 'pantalla_previa-tab':

                    normalNavs();
                    maximizar_pantalla();
                    $('#nav-vista_previa').css({
                        'color': '#fff',
                        'background': '#49b0e8',
                        'font-weight': 'bold'
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        data: {
                            idpantalla: $("#idformato").val(),
                            key: localStorage.getItem("key")
                        },
                        url: "<?php echo ($ruta_db_superior); ?>app/generador_pantalla/cargar_vista_previa.php",
                        success: function(response) {
                            if (response.success) {
                                $("#pantalla_vista_previa").html(response.data);
                            } else {
                                top.notification({
                                    type: "error",
                                    message: response.message
                                })
                            }
                        }
                    });

                    break;

            }

        });

        function normalNavs() {

            $('#nav-campos,#nav-informacion,#nav-mostrar,#nav-vista_previa').css({
                'color': '#666',
                'background': '#eee',
                'font-weight': 'normal'
            });

        }

        function maximizar_pantalla() {
            $("#contenedor_generador").removeClass('col-md-9 col-lg-9');
            $("#contenedor_generador").addClass('col-md-12 col-lg-12');
        }

        function minimizar_pantalla() {
            $("#contenedor_generador").removeClass('col-md-12 col-lg-12');
            $("#contenedor_generador").addClass('col-md-9 col-lg-9');
        }

    }); //Fin Document ready
</script>