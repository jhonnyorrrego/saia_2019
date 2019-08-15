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
    <?= validate() ?>


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

    <div class="container-fluid ml-0 pl-0 pb-5" style="min-width:1400px;">

        <div class="row my-2 ml-0" >
            <div class="col-12 col-sm-12 col-md-3 col-lg-2 mx-0" ></div>
            <div class="col-12 col-sm-12 col-md-3 col-lg-2 mx-0 fixed-top">
                <div class="section">
                    <div class="col-12 px-0 mb-2">
                        <?= $arbol->generar_html() ?>
                    </div> 
                </div>
                <script src="js/funciones_arbol.js"></script>
            </div>


            <div class="col-12 col-sm-12 col-md-9 col-lg-10 mx-0">

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 pl-1 mr-0" style="position:fixed;z-index:1;background:white;top:-2px;padding-top:6px;padding-bottom:6px;">
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

                    <div style="position:fixed;right:10px;top:0px;">
                        <label style="background: #48b0f7; color:fff; margin:auto;color:white;cursor:pointer;height:44px;width:140px;padding-left:32px;padding-top:10px;" id="guardar">GUARDAR</label>          
                        <label style="background: #48b0f7; color:fff; margin-top:3px; margin-left:10px;margin-bottom: 7px;color:white;cursor:pointer;height:44px;width:140px;padding-left:32px;padding-top:10px;">PUBLICAR</label>

                        <div id="barra_principal_formato" class="barra_principal_formato" style="margin-left:10px; width:85%; display:none">
                            <div class="progress progress-striped active" style="margin-bottom: 7px;">
                                <div class="bar bar-success" id="barra_formato"></div>
                            </div>
                        </div>

                        <button id="generar_pantalla" class="btn btn-primary" style="display:none">Generar<span id="cargando_generar_pantalla"></span></button>

                    </div>
                </div>
 
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 pl-1 mr-0 mt-5"  style="border-left:1px solid #eee;">

                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 mx-0" id="contenedor_generador">
                            <div class="tabbable section">

                                <div class="tab-content" style="text-align:left;">


                                    <div class="tab-pane" id="pantalla_previa-tab" style="background:#eee;padding-top:30px;padding-bottom:30px">
                                        <div id="pantalla_vista_previa" style="background:#fff;margin:30px;"></div>

                                    </div>

                                    <div class="tab-pane" id="pantalla_previa-permiso"></div>

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
                                                cambios</span>
                                        </button><br><br>
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
                                            var encabezados = <?= json_encode($contenido_enc); ?>;
                                            var idencabezado = <?= $idencabezadoFormato; ?>;
                                            var etiquetas = <?= json_encode($etiqueta_enc); ?>;
                                        </script>




                                    </div>




                                    <div class="tab-pane" id="pantalla_listar-tab">
                                        <form name="formulario_editor_listar" id="formulario_editor_listar" action=""> <br />
                                            <div id="tipo_listar">Por favor seleccione un tipo de visualizaci&oacute;n:
                                                <select name="tipo_pantalla_busqueda" id="tipo_pantalla_busqueda">
                                                    <option value="0">Por favor seleccione</option>
                                                        <?php
                                                        $tipo_listado = busca_filtro_tabla("", "pantalla_busqueda a", "estado=1", "etiqueta asc", $conn);
                                                        for ($i = 0; $i < $tipo_listado["numcampos"]; $i++) {
                                                        echo ('<option value="' . $tipo_listado[$i]["idpantalla_busqueda"] . '" nombre="' . $tipo_listado[$i]["nombre"] . '">' . $tipo_listado[$i]["etiqueta"] . '</option>');
                                                        }
                                                        ?>
                                                </select>
                                                <?php if ($tipo_listado["numcampos"]) { ?>
                                                    <div width="100%" id="frame_tipo_listado"></div>
                                                <?php 
                                                }
                                                ?>
                                            </div>
                                        </form>
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

                                            <div class="title my-0 mt-5 mx-4 pt-3">
                                                Permisos del formato a:
                                                <hr />
                                            </div>
                                            
                                            <div class="mx-4 my-3 pt-2">
                                                <input type="hidden" id="nombreFormato" value="<?= $consulta_formato[0]['nombre']; ?>" />
                                                <br>
                                                    <?= consultarPermisosPerfil($consulta_formato[0]['nombre']); ?>
                                                <button style="background: #48b0f7; color:fff;margin-top: 20px; margin-bottom: 7px;display:none;" id="generar_pantalla">Publicar</button>
                                            </div>
                                       
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
                                    <div class="tab-pane active" id="componentes-tab" style="overflow:auto;"></div>

                                    <div class="tab-pane" id="librerias-tab"></div>

                                    <div class="tab-pane" id="funciones-tab">
                                        <input type="hidden" name="idpantalla_funcion_exe" id="idpantalla_funcion_exe" />
                                        <input type="hidden" name="nombre_funcion_insertar" id="nombre_funcion_insertar" />
                                        <div id="funciones_desplegables" style="height:90%;"></div>
                                    </div>

                                </div>

                            </div>

                    

                        </div>


                    </div>

                </div>

              <hr />
              

            </div>

        </div>

    </div>

</body>

</html>

<?php

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

<script type="text/javascript">
$(document).ready(function() {
    /*$("#nuevo_formato").click(function() {
		abrir_kaiten("pantallas/generador/iframe_generador.php?nokaiten=1","Nuevo formato");
	});*/

    $('#componentes_acciones').hide();
    
    $.ajax({
        type: 'POST',
        url: "<?php echo ($ruta_db_superior); ?>pantallas/generador/librerias_formato.php",
        data: {
            ejecutar_libreria_formato: 'consultarPermisos',
            nombreFormato: $("#nombreFormato").val()
        },
        success: function(response) {
            if (response) {
                var objeto = jQuery.parseJSON(response);
                if (objeto.permisos) {
                    var permisosPerfil = objeto.permisos.join();
                    $.each(objeto.permisos,function(i,e){
                        $('[name="permisosPerfil"][value='+e+']').attr('checked', true);
                    });
                }
            }
        }
    });
    var idpantalla = "<?php echo $idpantalla ?>";
    $("#cambiar_vista").hide();
    $("#generar_pantalla").hide();
    if(idpantalla){
        $("#cambiar_nav").show();
    }else{
        $("#enviar_datos_formato").show();
    }
    
    $('#cambiar_vista').on('click', function() {
        $("#diseno_formulario_pantalla").removeClass("disabled");
        $("#vista_formulario_pantalla").removeClass("disabled");
        $("#diseno_formulario_pantalla").next().find("a").trigger("click");
    });
    $('#cambiar_nav_basico').on('click', function() { 
        $.ajax({
            type: 'POST',
            url: '<?php echo ($ruta_db_superior); ?>' + 'pantallas/generador/librerias.php',
            data: {
                ejecutarLibreria: 'validarCamposObligatorios',
                idformato: $("#idformato").val()
            },
            success: function(response) {
                if(response){
                     var objeto = jQuery.parseJSON(response);   
                    if(objeto.exito!=1 || objeto.error == 0){
                        notificacion_saia(objeto.mensaje, "error", "", 3500);
                    }else{
                        $("#diseno_formulario_pantalla").removeClass("disabled");
                        $("#generar_formulario_pantalla").next().find("a").trigger("click");
                    }
                }
               
            }
        });
       
    });
     $('#cambiar_nav_permiso').on('click', function() {
        $("#vista_formulario_permisos").removeClass("disabled");
        $("#vista_formulario_pantalla").next().find("a").trigger("click");
     
    });
    
    $('#cambiar_nav').on('click', function() {
        $.ajax({
            type: 'POST',
            async: false,
            url: "<?php echo ($ruta_db_superior); ?>pantallas/generador/librerias.php",
            data: {
                ejecutarLibreria: 'validarCamposObligatorios',
                idformato: $("#idformato").val(),
                rand: Math.round(Math.random() * 100000)
            },
            success: function(response) {
                if (response) {
                    var objeto = jQuery.parseJSON(response);
                    if (objeto.exito) {
                        $("#diseno_formulario_pantalla").removeClass("disabled");
                        $("#generar_formulario_pantalla").next().find("a").trigger("click");
                        generar_pantalla("full");
                    } else {
                        notificacion_saia(objeto.mensaje, "error", "", 3500);
                    }
                }
            }
        });
    });
    
    $("#asignar_funciones-tab").hide();
    $("#pantalla_listar-tab").hide();
    if (idpantalla) {
        var publicar = <?= $publicar ?>;
        var ocultarTexto = <?= $ocultarTexto ?>;
        if(ocultarTexto==1){
            $("#list_one").hide();
        }
        
        $("#pantalla_principal").addClass("active");
        $("#diseno_formulario_pantalla").addClass("disabled");
        $("#vista_formulario_pantalla").addClass("disabled");
        $("#vista_formulario_permisos").addClass("disabled");

        if($("#pantalla_principal").attr("class")=="active"){
            $("#enviar_datos_formato").show();
            $("#cambiar_nav_basico").hide();
            $("#cambiar_nav").hide();
        }
        
        //$('#componentes_acciones').show();
        var contenidoPie = <?php echo $contenidoPie ?>;
        var contenidoEncabezado = <?php echo $contenidoEncabezado ?>;
        if (contenidoEncabezado) {
            document.getElementById("encabezado_formato").innerHTML = <?php echo $contenidoEncabezado ?>;
        }
        if (contenidoPie) {

            document.getElementById("pie_formato").innerHTML = contenidoPie;
        }
        CKEDITOR.instances.editor_mostrar.setData(<?php echo $contenido_formato ?>);

        var idencabezadoFormato = "<?php echo $idencabezadoFormato; ?>"

        var idPie = "<?php echo $idpie; ?>"
        if (idencabezadoFormato == 0) {

            $("#eliminar_encabezado").addClass('disabled');
            $("#eliminar_encabezado").prop('disabled', true);

            $("#adicionar_encabezado").addClass("disabled");
            $("#adicionar_encabezado").prop('disabled', true);
        } else {
            $("#eliminar_encabezado").removeClass('disabled');
            $("#eliminar_encabezado").prop('disabled', false);

            $("#adicionar_encabezado").removeClass("disabled");
            $("#adicionar_encabezado").prop('disabled', false);
        }

        if (idPie == 0) {
            $("#eliminar_pie").addClass('disabled');
            $("#eliminar_pie").prop('disabled', true);

            $("#adicionar_pie").addClass("disabled");
            $("#adicionar_pie").prop('disabled', true);
        } else {
            $("#eliminar_pie").removeClass('disabled');
            $("#eliminar_pie").prop('disabled', false);

            $("#adicionar_pie").removeClass("disabled");
            $("#adicionar_pie").prop('disabled', false);
        }

        $("#sel_encabezado").val(idencabezadoFormato);
        $("#sel_pie_pagina").val(idPie);
        $("#generar_pantalla").on("click", function(e) {
            var checkeados = [];
            $("input[name='permisosPerfil']").each(function(){
              if($(this).is(":checked")){
                   checkeados.push($(this).val());
              }
            });

            $(".generador_pantalla").find(".accordion-inner").html("");
            $(".generador_pantalla").removeClass("alert-success");
            $(".generador_pantalla").removeClass("alert-error");
            generar_pantalla("full",checkeados);
        });
    }


    $(document).on("click", "#funcionesPropias", function() {
        var idfuncionFormato = $(this).attr("idfuncionFormato");
        var funcion = $(this).attr("name");
        var tipo = idfuncionFormato.split("_");
        if (tipo[1] === 'func') {
            CKEDITOR.instances['editor_mostrar'].insertText(funcion);
            $.ajax({
                type: 'POST',
                url: "<?php echo ($ruta_db_superior); ?>pantallas/lib/llamado_ajax.php",
                data: "librerias=pantallas/generador/librerias_formato.php&funcion=vincular_funciones_formatos&parametros=" +
                    tipo[0] + ";" + funcion + "&idformato=" + $("#idformato").val() + "&rand=" +
                    Math.round(Math.random() * 100000),
                success: function(html) {
                    if (html) {
                        var objeto = jQuery.parseJSON(html);
                        if (objeto.exito) {
                            notificacion_saia(objeto.mensaje, "success", "", 3500);
                        } else {
                            notificacion_saia(objeto.mensaje, "error", "", 3500);
                        }
                    }
                }
            });
        }
    });

    $(document).on("click", "#camposPropios", function() {

        var idcamposFormato = $(this).attr("idcamposFormato");
        var funcion = $(this).attr("name");
        var tipo = idcamposFormato.split("_");
        if (tipo[1] === 'campo') {
            CKEDITOR.instances['editor_mostrar'].insertText(funcion);
        }

    });
    $(document).on("click", "#actualizar_cuerpo_formato", function() {
        var contenido_editor = CKEDITOR.instances['editor_mostrar'].getData();
        
        $.ajax({
            type: 'POST',
            url: "<?php echo ($ruta_db_superior); ?>pantallas/generador/librerias_formato.php",
            data: {
                ejecutar_libreria_formato: 'actualizar_cuerpo_formato',
                contenido: contenido_editor,
                idformato: $("#idformato").val(),
                rand: Math.round(Math.random() * 100000)
            },
            success: function(html) {
                if (html) {
                    var objeto = jQuery.parseJSON(html);
                    if (objeto.exito) {
                        notificacion_saia(objeto.mensaje, "success", "", 3500);
                    } else {
                        notificacion_saia(objeto.mensaje, "error", "", 3500);
                    }
                }
            }
        });
    });

    function generar_pantalla(nombre_accion,permisosPerfil) {
        $("#barra_principal_formato").show();
        $("#barra_formato").html("0%");
        $("#barra_formato").css("width", "0%");
        var ruta_generar = 'formatos/generar_formato.php';
        var datos = {
            idformato: $("#idformato").val(),
            accion: "full",
            permisosPerfil : permisosPerfil,
            nombreFormato: $("#nombreFormato").val(),
            llamado_ajax: 1
        };
        var interval = null;
        $.ajax({
            type: 'POST',
            url: '<?php echo ($ruta_db_superior); ?>' + ruta_generar,
            data: datos,
            beforeSend: function() {
                interval = setInterval(() => {
                    if (parseInt($("#barra_formato").html()) < 98) {
                        var porcentaje = parseInt($("#barra_formato").html()) + 4 + "%";
                        $("#barra_formato").html(porcentaje);
                        $("#barra_formato").css("width", porcentaje);
                    } else {
                        window.clearInterval(interval);
                    }

                }, 150);
            },
            success: function(html) {
                window.clearInterval(interval)
                if (html) {
                    var objeto = jQuery.parseJSON(html);
                    if(objeto.publicar == 0 && objeto.exito == true){
                        $("#barra_formato").html("100%");
                        $("#barra_formato").css("width", "100%");
                        CKEDITOR.instances.editor_mostrar.setData(objeto.contenido_cuerpo);
                        setTimeout(function() {
                            $(".barra_principal_formato").fadeOut(1500);
                        }, 3000);
                    }else if (objeto.exito == true && objeto.permisos) {
                        $("#barra_formato").html("100%");
                        $("#barra_formato").css("width", "100%");
                        notificacion_saia("Formato generado y "+objeto.permisos, "success", "", 3500);
                        CKEDITOR.instances.editor_mostrar.setData(objeto.contenido_cuerpo);
                        setTimeout(function() {
                            $(".barra_principal_formato").fadeOut(1500);
                        }, 3000);
                        if(objeto.publicar==1){
                           publicar=objeto.publicar;  
                        }
                    }else if (objeto.exito == true && !objeto.permisos) {
                        $("#barra_formato").html("100%");
                        $("#barra_formato").css("width", "100%");
                        notificacion_saia("Formato generado correctamente", "success", "", 3500);
                        CKEDITOR.instances.editor_mostrar.setData(objeto.contenido_cuerpo);
                        setTimeout(function() {
                            $(".barra_principal_formato").fadeOut(1500);
                        }, 3000);
                        if(objeto.publicar==1){
                           publicar=objeto.publicar;  
                        }
                    } else {
                        notificacion_saia("Se a producido un error por favor comuniquese con el administrador", "error", "", 9500);
                        setTimeout(function() {
                            $(".barra_principal_formato").fadeOut(1000);
                        }, 2000);
                    }
                }
                $("#cargando_generar_pantalla").html("");
            }
        });
    }

    campo_id_foco = "";
    var alto = $(window).height();
    var ancho = $(window).width();
    if (ancho < 600) {
        top.noty({
            text: 'Por favor rote el dispositivo',
            type: 'warning',
            layout: 'topCenter',
            timeout: 8000
        });
    }
    var browserType;
    var tab_acciones = false;
    iniciar_tooltip();
    if (document.layers) {
        browserType = "nn4"
    }
    if (document.all) {
        browserType = "ie"
    }
    if (window.navigator.userAgent.toLowerCase().match("gecko")) {
        browserType = "gecko"
    }
    $(".nav li").click(function() {
        if ($(this).hasClass('disabled')) {
            return false;
        }
    });

    var formulario_encabezado = $("#formulario_editor_encabezado");
    formulario_encabezado.validate({
        ignore: [],
        debug: false,
        rules: {
            "etiqueta_encabezado": {
                required: true,
                minlength: 1
            },
            editor_encabezado: {
                required: function() {
                    CKEDITOR.instances.editor_encabezado.updateElement();
                },
                minlength: 1
            }
        }
    });
    var formulario_pie = $("#formulario_editor_pie");
    formulario_pie.validate({
        ignore: [],
        debug: false,
        rules: {
            "etiqueta_pie": {
                required: true,
                minlength: 1
            },
            editor_pie: {
                required: function() {
                    CKEDITOR.instances.editor_pie.updateElement();
                },
                minlength: 1
            }
        }
    });

    $(document).on("change", "#sel_encabezado", function() {
        var seleccionado = this.value;
        $("#idencabezado").val(seleccionado);
        if (seleccionado > 0) {
            /*$("#adicionar_encabezado").addClass("disabled");
            $("#adicionar_encabezado").prop('disabled', true);*/
            $("#adicionar_encabezado").removeClass("disabled");
            $("#adicionar_encabezado").prop('disabled', false);
            $("#eliminar_encabezado").removeClass('disabled');
            $("#eliminar_encabezado").prop('disabled', false);
            document.getElementById("encabezado_formato").innerHTML = encabezados[seleccionado];
            $("#etiqueta_encabezado").val(etiquetas[seleccionado]);
        } else {
            $("#modificar_encabezado").addClass("disabled");
            $("#modificar_encabezado").prop('disabled', true);
            $("#eliminar_encabezado").addClass('disabled');
            $("#eliminar_encabezado").prop('disabled', true);
            $("#adicionar_encabezado").addClass("disabled");
            $("#adicionar_encabezado").prop('disabled', true);
            document.getElementById("encabezado_formato").innerHTML = "";
            $("#etiqueta_encabezado").val("");
        }

        $.ajax({
            type: 'POST',
            url: "<?php echo ($ruta_db_superior); ?>pantallas/lib/llamado_ajax.php",
            data: "librerias=pantallas/generador/librerias_formato.php&funcion=actualizar_encabezado_pie&parametros=" +
                $("#idformato").val() + ";encabezado;" + seleccionado + ";1&rand=" + Math.round(
                    Math.random() * 100000),
            success: function(html) {
                if (html) {
                    var objeto = jQuery.parseJSON(html);
                    console.log(objeto); return false;
                    if (objeto.exito) {
                        notificacion_saia("Encabezado actualizado", "success", "", 3000);
                    }
                }
            }
        });

    });

    $(document).on("change", "#sel_pie_pagina", function() {
        var seleccionado = this.value;
        $("#idpie").val(seleccionado);
        if (seleccionado > 0) {
            $("#eliminar_pie").removeClass('disabled');
            $("#eliminar_pie").prop('disabled', false);
            $("#adicionar_pie").removeClass('disabled');
            $("#adicionar_pie").prop('disabled', false);

            document.getElementById("pie_formato").innerHTML = encabezados[seleccionado];
            $("#etiqueta_pie").val(etiquetas[seleccionado]);
        } else {
            $("#eliminar_pie").addClass('disabled');
            $("#eliminar_pie").prop('disabled', true);
            $("#adicionar_pie").addClass('disabled');
            $("#adicionar_pie").prop('disabled', true);

            document.getElementById("pie_formato").innerHTML = "";
            $("#etiqueta_pie").val(etiquetas[seleccionado]);
        }

        $.ajax({
            type: 'POST',
            url: "<?php echo ($ruta_db_superior); ?>pantallas/lib/llamado_ajax.php",
            data: "librerias=pantallas/generador/librerias_formato.php&funcion=actualizar_encabezado_pie&parametros=" +
                $("#idformato").val() + ";pie;" + seleccionado + ";1&rand=" + Math.round(Math
                    .random() * 100000),
            success: function(html) {
                if (html) {
                    var objeto = jQuery.parseJSON(html);
                    if (objeto.exito) {
                        notificacion_saia("Pie pagina actualizado", "success", "", 3000);
                    }
                }
            }
        });
    });

    $(document).on("click", ".guardar_encabezado", function(e) {
        var id = $("#idencabezado").val();
        if (id != 0) {
            var etiqueta = $("#etiqueta_encabezado").val();
            var enlace = 'editor_encabezado.php?idencabezado=' + id + '&etiqueta=' + etiqueta;
            hs.htmlExpand(this, {
                objectType: 'iframe',
                width: 800,
                height: 500,
                contentId: 'cuerpo_paso',
                preserveContent: false,
                src: enlace,
                outlineType: 'rounded-white',
                wrapperClassName: 'highslide-wrapper drag-header'
            });
        }

    });

    $(document).on("click", "#eliminar_encabezado", function(e) {
        var id = $("#idencabezado").val();
        var idFormato = $("#idformato").val();
        if (id && id > 0) {
            var etiqueta = "";
            var contenido = "";
            var datos = {
                ejecutar_libreria_encabezado: "eliminar_contenido_encabezado",
                idencabezado: id,
                tipo: "encabezado",
                idFormato: idFormato,
                rand: Math.round(Math.random() * 100000),
                etiqueta: etiqueta,
                contenido: contenido,
                tipo_retorno: 1
            };
            $.ajax({
                type: 'POST',
                dataType: "json",
                url: "<?php echo ($ruta_db_superior); ?>pantallas/generador/librerias_formato.php",
                data: datos,
                success: function(data) {
                    if (data.exito == 1) {
                        $("#sel_encabezado").empty();
                        encabezados = [];
                        $("#sel_encabezado").append(
                            '<option value="0">Por favor seleccione</option>');
                        $.each(data.datos, function() {
                            encabezados[this.idencabezado] = this.contenido;
                            etiquetas[this.idencabezado] = this.etiqueta;
                            $("#sel_encabezado").append('<option value="' + this
                                .idencabezado + '">' + this.etiqueta +
                                '</option>');
                        });
                        $("#adicionar_encabezado").removeClass("disabled");
                        $("#adicionar_encabezado").prop('disabled', false);
                        $("#modificar_encabezado").addClass("disabled");
                        $("#modificar_encabezado").prop('disabled', true);
                        $("#eliminar_encabezado").addClass("disabled");
                        $("#eliminar_encabezado").prop('disabled', true);
                        notificacion_saia("Encabezado pagina eliminado", "success", "",
                            3000);
                        $("#encabezado_formato").val("");
                        $("#etiqueta_encabezado").val("");
                        $("#idencabezado").val("0");
                    } else if (data.exito == 0) {
                        notificacion_saia(data.mensaje, "error", "", 3000);
                    }
                }
            });
        }
    });



    $(document).on("click", "#limpiar_encabezado", function(e) {
        //$("#div_etiqueta_encabezado").show();
        $("#sel_encabezado option[selected]").removeAttr("selected");
        $("#idencabezado").val("0");
        $("#eliminar_encabezado").addClass('disabled');
        $("#eliminar_encabezado").prop('disabled', true);
        $("#etiqueta_encabezado").val("");

        //var editor = tinymce.get('editor_encabezado');
        CKEDITOR.instances.editor_encabezado.setData("")
        $("#adicionar_encabezado").removeClass("disabled");
        $("#adicionar_encabezado").prop('disabled', false);
        $("#modificar_encabezado").addClass("disabled");
        $("#modificar_encabezado").prop('disabled', true);
        //editor.setContent("");

    });

    $(document).on("click", ".guardar_pie", function(e) {
        var id = $("#idpie").val();
        if (id != 0) {
            var etiqueta = $("#etiqueta_pie").val();
            var enlace = 'editor_encabezado.php?idpie=' + id + '&etiqueta=' + etiqueta + '&pie=1';
            hs.htmlExpand(this, {
                objectType: 'iframe',
                width: 800,
                height: 500,
                contentId: 'cuerpo_paso',
                preserveContent: false,
                src: enlace,
                outlineType: 'rounded-white',
                wrapperClassName: 'highslide-wrapper drag-header'
            });
        }
    });

    $(document).on("click", ".crear_encabezado", function(e) {
        var enlace = 'crear_encabezado_pie.php?crear_encabezado=1';
        hs.graphicsDir = '<?php echo($ruta_db_superior); ?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
		hs.outlineType = 'rounded-white';
        hs.htmlExpand(this, {
            objectType: 'iframe',
            width: 800,
            height: 500,
            contentId: 'cuerpo_paso',
            preserveContent: false,
            src: enlace,
            outlineType: 'rounded-white',
            wrapperClassName: 'highslide-wrapper drag-header',
        });
    });

    $(document).on("click", ".crear_pie", function(e) {
        var enlace = 'crear_pie.php?pie=1';
        hs.htmlExpand(this, {
            objectType: 'iframe',
            width: 800,
            height: 500,
            contentId: 'cuerpo_paso',
            preserveContent: false,
            src: enlace,
            outlineType: 'rounded-white',
            wrapperClassName: 'highslide-wrapper drag-header',
        });
    });

    $(document).on("click", "#eliminar_pie", function(e) {
        var id = $("#sel_pie_pagina").val();
        var idFormato = $("#idformato").val();
        if (id && id > 0) {
            var etiqueta = "";
            var contenido = "";
            var datos = {
                ejecutar_libreria_encabezado: "eliminar_contenido_encabezado",
                idencabezado: id,
                tipo: "piePagina",
                rand: Math.round(Math.random() * 100000),
                etiqueta: etiqueta,
                idFormato: idFormato,
                contenido: contenido,
                tipo_retorno: 1
            };
            $.ajax({
                type: 'POST',
                dataType: "json",
                url: "<?php echo ($ruta_db_superior); ?>pantallas/generador/librerias_formato.php",
                data: datos,
                success: function(data) {
                    if (data.exito == 1) {
                        $("#sel_pie_pagina").empty();
                        encabezados = [];
                        $("#sel_pie_pagina").append(
                            '<option value="0">Por favor seleccione</option>');
                        $.each(data.datos, function() {
                            encabezados[this.idencabezado] = this.contenido;
                            etiquetas[this.idencabezado] = this.etiqueta;
                            $("#sel_pie_pagina").append('<option value="' + this
                                .idencabezado + '">' + this.etiqueta +
                                '</option>');
                        });
                        $("#adicionar_pie").removeClass("disabled");
                        $("#adicionar_pie").prop('disabled', false);
                        $("#modificar_pie").addClass("disabled");
                        $("#modificar_pie").prop('disabled', true);
                        $("#eliminar_pie").addClass("disabled");
                        $("#eliminar_pie").prop('disabled', true);
                        notificacion_saia("Pie pagina eliminado", "success", "", 3000);

                        $("#etiqueta_pie").val("");
                        $("#pie_formato").val("");
                        $("#idpie").val("0");
                    } else if (data.exito == 0) {
                        notificacion_saia(data.mensaje, "error", "", 3000);
                    }
                }
            });
        }
    });


    $(document).on("click", "#limpiar_pie", function(e) {
        //$("#div_etiqueta_pie").show();
        $("#sel_pie_pagina option[selected]").removeAttr("selected");
        $("#idpie").val("0");
        $("#etiqueta_pie").val("");
        $("#eliminar_pie").addClass('disabled');
        $("#eliminar_pie").prop('disabled', true);
        CKEDITOR.instances.editor_pie.setData("");

        $("#adicionar_pie").removeClass("disabled");
        $("#adicionar_pie").prop('disabled', false);
        $("#modificar_pie").addClass("disabled");
        $("#modificar_pie").prop('disabled', true);

    });

    $("#frame_tipo_listado").height(alto - 125);
    //$(".tab-pane").height(alto - 50);
    //$(".tab-content").height(alto - 40);
    $(".tab-content").css("padding-top", 0);
    
    $.ajax({
        type: 'POST',
        url: "<?php echo ($ruta_db_superior); ?>pantallas/lib/llamado_ajax.php",
        async: false,
        data: "librerias=pantallas/generador/librerias_pantalla.php&funcion=load_componentes&parametros=1&idpantalla=" +
            $("#idformato").val() + "&rand=" + Math.round(Math.random() * 100000),
        success: function(html) {
            if (html) {
                var objeto = jQuery.parseJSON(html);
                if (objeto.exito) {
                    $("#componentes-tab").append(objeto.codigo_html);
                }
            }
        }
    });

    $("#seleccionar_archivo").click(function() {
        ruta_archivo = $("#ruta_archivo_actual").val();
        if (ruta_archivo != '') {
            $.ajax({
                type: 'POST',
                url: '<?php echo ($ruta_db_superior); ?>pantallas/generador/librerias.php?ejecutar_pantalla_campo=incluir_librerias_pantalla',
                data: 'ruta=' + ruta_archivo + "&idpantalla_campos=" + $("#idformato").val() +
                    "&tipo_retorno=1&tipo_libreria=1",
                success: function(html) {
                    if (html) {
                        var objeto = jQuery.parseJSON(html);
                        if (objeto.exito) {
                            notificacion_saia(objeto.mensaje, "success", "", 3000);
                        } else {
                            notificacion_saia(objeto.mensaje, "error", "", 3000);
                        }
                    }
                }
            });
        }
    });

    ////////////////////////////////////////// AQUI VA LA VENTANA  MODAL /////////////////////////////////////////
    //hs.graphicsDir = '<?php echo($ruta_db_superior); ?>anexosdigitales/highslide-4.0.10/highslide/graphics/';

    var count_click = 0;

    function count_click_add() {
        count_click += 1;
        return count_click;
    }

////////////////////////////////// FUNCIONES QUE NECESITAN MODAL /////////////////////////////////////////////////
/*
    hs.Expander.prototype.onInit = function(sender) {
        var cantidadClicks = count_click_add(); 
        if(cantidadClicks>1){
            return false;
        }
    };


    hs.Expander.prototype.onAfterClose = function(event) {
        count_click=0;
        var editor_enlace = event.src.split('?');

        if (editor_enlace[0] == 'editor_encabezado.php' || editor_enlace[0] == 'crear_encabezado_pie.php' ||
            editor_enlace[0] == 'crear_pie.php') {
            var separandosrc = editor_enlace[1].split('=');
            if (editor_enlace[0] == 'crear_encabezado_pie.php') {
                var idactual = $("#sel_encabezado").attr('idencabezado');
            } else if (editor_enlace[0] == 'crear_pie.php') {
                var idactual = $("#sel_pie_pagina").attr('idpie');
            } else {
                var buscandoid = separandosrc[1].split('&');
                var idactual = buscandoid[0];
            }
            var buscandopie = editor_enlace[1].split('&');
            var valorEncabezado = buscandopie[0];
            var valorPie = buscandopie[0];
            var datos = {
                ejecutar_libreria_encabezado: "consultar_contenido_encabezado",
                tipo_retorno: 1
            };
            $.ajax({
                type: 'POST',
                dataType: "json",
                url: "<?php echo ($ruta_db_superior); ?>pantallas/generador/librerias_formato.php",
                data: datos,
                success: function(data) {
                    if (data.exito == 1 && valorEncabezado != 'pie=1' && idactual) {
                        $("#sel_encabezado").empty();
                        encabezados = [];
                        $("#sel_encabezado").append(
                            '<option value="0">Por favor seleccione</option>');
                        $.each(data.datos, function() {
                            encabezados[this.idencabezado] = this.contenido;
                            etiquetas[this.idencabezado] = this.etiqueta;
                            $("#sel_encabezado").append('<option value="' + this
                                .idencabezado + '">' + this.etiqueta + '</option>');
                        });
                        $("#sel_encabezado").val(idactual).trigger('change');
                    } else if (data.exito == 1 && valorPie == 'pie=1' && idactual) {
                        $("#sel_pie_pagina").empty();
                        encabezados = [];
                        $("#sel_pie_pagina").append(
                            '<option value="0">Por favor seleccione</option>');
                        $.each(data.datos, function() {
                            encabezados[this.idencabezado] = this.contenido;
                            etiquetas[this.idencabezado] = this.etiqueta;
                            $("#sel_pie_pagina").append('<option value="' + this
                                .idencabezado + '">' + this.etiqueta + '</option>');
                        });
                        $("#sel_pie_pagina").val(idactual).trigger('change');
                    }
                }
            });
        }
    }
    //hs.dimmingOpacity = 0.75;

    var form_builder = {
        el: null,
        method: "POST",
        action: "",
        delimeter: '=',
        setElement: function(el) {
            this.el = el;
        },
        getElement: function() {
            return this.el;
        },
        addComponent: function(component) {
            $.ajax({
                type: 'POST',
                url: "<?php echo ($ruta_db_superior); ?>pantallas/lib/llamado_ajax.php",
                data: "librerias=pantallas/generador/librerias.php&funcion=adicionar_pantalla_campos&parametros=" +
                    $("#idformato").val() + ";" + component.attr("idpantalla_componente") +
                    ";1&rand=" + Math.round(Math.random() * 100000),
                success: function(html) {
                    if (html) {

                        var objeto = jQuery.parseJSON(html);
                        if (objeto.exito) {
                            $("#list").append(objeto.codigo_html);
                        }
                    }
                }
            });
        }
    };
*/

 //////////////////////////////////////////////// AQUI TERMINAN ALGUNOS LLAMADOS DE MODAL /////////////////////////////////////////////////////////////////


    $(document).on('click', '.element > .close', function(e) {
        let idFormato= $("#idformato").val();
        e.stopPropagation();
        hs.htmlExpand(null, {
            src: "eliminar_pantalla_campo.php?idformato="+idFormato+"&idpantalla_campos=" + $(this).attr(
                "idpantalla_campos"),
            objectType: 'iframe',
            outlineType: 'rounded-white',
            wrapperClassName: 'highslide-wrapper drag-header',
            preserveContent: false,
            width: 400,
            height: 200
        });
    });
    $(document).on('click', '.element', function() {
        console.log("1---");
        var componente = $(this).attr("nombre");
        var ulr_hs =
            "<?php echo ($ruta_db_superior); ?>pantallas/generador/editar_componente_generico.php?idpantalla_componente=" +
            $(this).attr("idpantalla_componente") + "&idpantalla_campos=" + $(this).attr(
                "idpantalla_campo");
        if (componente == "archivo_xxx") {
            ulr_hs = "<?php echo ($ruta_db_superior); ?>pantallas/generador/" + componente +
                "/editar_componente.php?idpantalla_componente=" + $(this).attr(
                "idpantalla_componente") + "&idpantalla_campos=" + $(this).attr("idpantalla_campo");
        }
        var opciones = {
  
            src: ulr_hs,
            objectType: 'iframe',
            outlineType: 'rounded-white',
            wrapperClassName: 'highslide-wrapper drag-header',
            preserveContent: true,
            width: 600,
            height: 500
        };
        hs.graphicsDir = '<?php echo($ruta_db_superior); ?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
        hs.htmlExpand(null, opciones);
    });

   

    $(document).on('click', '.element > input, .element > textarea, .element > label', function(e) {
        e.preventDefault();
    });
    $("#list").droppable({
            accept: '.component',
            hoverClass: 'content-hover',
            drop: function(e, ui) {
                $("#list_one").hide();
                form_builder.addComponent(ui.draggable);
            }
        })
        .sortable({
            placeholder: "element-placeholder",
            update: function(e, ui) {
                var orden = $("#list").sortable("toArray");
                $.ajax({
                    type: 'POST',
                    url: "<?php echo ($ruta_db_superior); ?>pantallas/lib/llamado_ajax.php",
                    data: "librerias=pantallas/generador/librerias_pantalla.php&funcion=ordenar_pantalla_campos&parametros=" +
                        orden + "&rand=" + Math.round(Math.random() * 100000),
                    success: function(html) {
                        if (html) {}
                    }
                });
            }
        })
        .disableSelection();
    //$("#configurar_pantalla_libreria").height(alto-$(".nav-tabs").height()-50);
    $(".component").draggable({
        helper: function(e) {
            return $(this).clone().addClass('component-drag');
        }
    }).click(function(e) {
        form_builder.addComponent($(this));
        $("#list_one").hide();
    });
   

    /////////////////////////////////////////////////////////////////// ESTO NO FUNCIONA  ( tree3 / dhtmlXTreeObject)/////////////////////////////////////////

    //tree3 = new dhtmlXTreeObject("treeboxbox_tree3", "100%", (alto - 65), 0);
    //tree3.setImagePath("<?php echo ($ruta_db_superior); ?>imgs/");
    //tree3.enableTreeImages(false);
    //tree3.enableTextSigns(true);
    //tree3.setOnLoadingStart(cargando_serie);
    //tree3.setOnLoadingEnd(fin_cargando_serie);
    //tree3.setOnClickHandler(cargar_editor);
    //tree3.enableThreeStateCheckboxes(true);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /*function cargar_archivo(ruta_archivo){
    	if(ruta_archivo!=''){
    		$.ajax({
          type:'POST',
          url: '<?php echo ($ruta_db_superior); ?>pantallas/lib/convertir_archivo_a_texto.php',
          data:'ruta='+ruta_archivo+"&accion=cargar",
          success: function(html){
            if(html){
            	var objeto=jQuery.parseJSON(html);
              if(objeto.exito){
                var re = /(?:\.([^.]+))?$/;
                var extension=re.exec(ruta_archivo)[1];
                if(extension=='undefined'){
                  extension='php';
                }
                else if(extension=="js"){
                  extension="javascript";
                }
                editor.getSession().setMode("ace/mode/"+extension);
              	editor.setValue(objeto.codigo_html);
              	$("#acciones_archivo-tab").show();
              	$("#ruta_archivo_actual").val(ruta_archivo);
              	notificacion_saia("Archivo "+ruta_archivo+" cargado de forma exitosa","success","",3000);

              }
          	}
          }
      	});
      }
    } */


    function cargar_editor(nodeId) {

        var ruta_archivo = tree3.getUserData(nodeId, "myurl");
        if (ruta_archivo != '') {
            $("#configurar_libreria_pantalla").html("cargando...");
            $.ajax({
                type: 'POST',
                url: 'configurar_pantalla_libreria.php',
                data: 'ruta=' + ruta_archivo + '&idformato=' + $("#idformato").val() + "&rand=" + Math
                    .round(Math.random() * 100000),
                success: function(html) {
                    if (html) {
                        $("#ruta_archivo_actual").val(ruta_archivo);
                        $("#configurar_libreria_pantalla").html(html);
                        notificacion_saia("Archivo " + ruta_archivo + " cargado de forma exitosa",
                            "success", "", 3000);
                    }
                }
            });
        } else {
            tree3.openItem(nodeId);

        }
    }

    function fin_cargando_serie() {
        if (browserType == "gecko")
            document.poppedLayer =
            eval('document.getElementById("esperando_archivo")');
        else if (browserType == "ie")
            document.poppedLayer =
            eval('document.getElementById("esperando_archivo")');
        else
            document.poppedLayer =
            eval('document.layers["esperando_archivo"]');
        document.poppedLayer.style.visibility = "hidden";
    }

    function cargando_serie() {
        if (browserType == "gecko")
            document.poppedLayer =
            eval('document.getElementById("esperando_archivo")');
        else if (browserType == "ie")
            document.poppedLayer =
            eval('document.getElementById("esperando_archivo")');
        else
            document.poppedLayer =
            eval('document.layers["esperando_archivo"]');
        document.poppedLayer.style.visibility = "visible";
    }
   
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
 
        $("#componentes_acciones").show();
        var id = e.target.toString().split("#");

        switch (id[1]) {
            case 'archivos-tab':
                $('#tabs_formulario a[href="#librerias_formulario-tab"]').tab('show');
                tree3.deleteChildItems(0);
                tree3.loadXML(
                    "<?php echo ($ruta_db_superior); ?>pantallas/lib/test_archivos_carpetas.php?carpeta_inicial=formatos&extensiones_permitidas=php"
                    );
                break;
            case 'acciones-tab':
                if (tab_acciones == false) {
                    $('#tabs_formulario a[href="#pantalla_mostrar-tab"]').tab('show');
                }
            break;
            case 'pantalla_previa-tab':
                $('#cambiar_vista').hide();
                $('#cambiar_nav').hide();
                $('#enviar_datos_formato').hide();
                $("#cambiar_nav_basico").hide();
                //$("#generar_pantalla").hide();
                $("#cambiar_nav_permiso").show();
                if (tab_acciones == false) {
                    $('#tabs_formulario a[href="#pantalla_previa-tab"]').tab('show');
                }
                $("#componentes_acciones").hide();
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
                            $("#pantalla_previa-tab").html(response.data);
                        } else {
                            top.notification({
                                type: "error",
                                message: response.message
                            })
                        }
                    }
                });
                break;
             case 'pantalla_previa-permiso':
                $('#cambiar_nav').hide();
                $('#enviar_datos_formato').hide();
                $('#cambiar_vista').hide();
                $("#cambiar_nav_basico").hide();
                $("#cambiar_nav_permiso").hide();
                if (tab_acciones == false) {
                    $('#tabs_formulario a[href="#pantalla_previa-permiso"]').tab('show');
                }
              
            break; 
            case 'funciones-tab':
                if (tab_acciones == false) {
                    $('#tabs_formulario a[href="#pantalla_mostrar-tab"]').tab('show');
                }
                $('#componente_tab').hide();
                $('#funciones_tab').show();

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo ($ruta_db_superior); ?>pantallas/generador/funciones_desplegables.php?pantalla_idpantalla=" +
                        $("#idformato").val() +
                        "&extensiones_permitidas=php&funciones_nucleo=1",
                    success: function(html) {
                        if (html) {
                            $("#funciones_desplegables").html(html.codigo_html);
                        }
                    }
                });
                break;
            case 'pantalla_mostrar-tab':
                if(publicar!=1){
                     $("#generar_pantalla").trigger("click");
                }else{
                    $('#cambiar_nav').hide();
                    $("#cambiar_nav_basico").show();
                }
                           
                tab_acciones = true;
                $('#tabs_opciones a[href="#funciones-tab"]').tab('show');
                $('#cambiar_nav').hide();
                //$('#generar_pantalla').hide();
                $('#enviar_datos_formato').hide();
                $("#cambiar_nav_basico").hide();
                $('#cambiar_nav_permiso').hide();
                $('#cambiar_vista').show();
                break;
            case 'pantalla_listar-tab':
                tab_acciones = true;
                $('#tabs_opciones a[href="#funciones-tab"]').tab('show');
                break;
            case 'componentes-tab':
                tab_acciones = false;
                $('#tabs_formulario a[href="#formulario-tab"]').tab('show');
                break;
            case 'formulario-tab':
                tab_acciones = false;

                normalNavs();
                minimizar_pantalla();
                $('#nav-campos').css({
                    'color': '#fff',
                    'background': '#49b0e8',
                    'font-weight': 'bold'
                });

                $('#tabs_opciones a[href="#componentes-tab"]').tab('show');
                $('#componente_tab').show();
                $('#funciones_tab').hide();
                //$("#generar_pantalla").hide();
                $('#cambiar_vista').hide();
                $('#enviar_datos_formato').hide();
                $('#cambiar_nav_permiso').hide();                
                if(publicar==1){
                    $('#cambiar_nav').hide();
                    $("#cambiar_nav_basico").show();
                }else{
                  $('#cambiar_nav').show();
                }
                break;
            case 'datos_formulario-tab':
                tab_acciones = false;

                normalNavs();
                maximizar_pantalla();
                $('#nav-informacion').css({
                    'color': '#fff',
                    'background': '#49b0e8',
                    'font-weight': 'bold'
                });


                $('#componentes_acciones').hide();
                $('#enviar_datos_formato').show();
                $('#cambiar_nav').hide();
                $('#cambiar_vista').hide();
                $("#cambiar_nav_basico").hide();
                //$('#generar_pantalla').hide();
                $('#cambiar_nav_permiso').hide();

                break;
            case 'librerias_formulario-tab':
                tab_acciones = false;
                if (!$('#tabs_opciones a[href="#includes-tab"]').parent().hasClass("active")) {
                    $('#tabs_opciones a[href="#archivos-tab"]').tab('show');
                    //cargar el listado en librerias_en_uso
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo ($ruta_db_superior); ?>pantallas/generador/librerias.php?ejecutar_pantalla_campo=listado_archivos_incluidos',
                        data: 'idformato=' + $("#idformato").val(),
                        success: function(html) {
                            if (html) {
                                var objeto = jQuery.parseJSON(html);
                                if (objeto.exito) {
                                    $('#librerias_en_uso').html(objeto.codigo_html);
                                    //iniciar_tooltip();
                                }
                            }
                        }
                    });

                }
                break;
            case 'includes-tab':
                //alert('includes tab');
                //$('#tabs_formulario a[href="#librerias_formulario-tab"]').tab('show');
                /*$.ajax({
        type:'POST',
        url: '<?php echo ($ruta_db_superior); ?>pantallas/generador/librerias.php?ejecutar_pantalla_campo=listado_archivos_incluidos',
        data:'idpantalla_campos='+$("#idformato").val(),
        success: function(html){
          if(html){
          	var objeto=jQuery.parseJSON(html);
            if(objeto.exito){
              $('#includes-tab').html(objeto.codigo_html);
              iniciar_tooltip();
            }
        	}
        }
    	});*/
                break;
        }
    });
    $(".eliminar_libreria").on("click", function() {
        var include = $(this).attr("idformato_libreria");
        $(this).addClass("cargando");
        $(this).removeClass(".eliminar_libreria");
        /*$(this).removeClass(".eliminar_adjunto_menu");
        $('[rel=tooltip]').hide();*/
        $.ajax({
            type: 'POST',
            url: '<?php echo ($ruta_db_superior); ?>pantallas/generador/librerias.php?ejecutar_pantalla_campo=eliminar_archivo_incluido',
            data: 'idformato=' + include + "&tipo_retorno=1",
            success: function(html) {
                if (html) {
                    var objeto = jQuery.parseJSON(html);
                    if (objeto.exito) {
                        $("#libreria" + objeto.idformato).remove();
                        notificacion_saia(objeto.mensaje, "success", "", 3000);

                        if (objeto.exito_funciones) {
                            notificacion_saia(objeto.mensaje_funciones, "success", "",
                            4000);
                        }

                    } else {
                        notificacion_saia(objeto.mensaje, "error", "", 3000);
                    }
                }
            }
        });
    });
    $(".configurar_libreria").on("click", function() {
        hs.htmlExpand(null, {
            src: "configurar_pantalla_libreria.php?idpantalla_libreria=" + $(this).attr(
                "idpantalla_libreria"),
            objectType: 'iframe',
            outlineType: 'rounded-white',
            wrapperClassName: 'highslide-wrapper drag-header',
            preserveContent: true,
            width: 497,
            height: 300
        });
    });

    function fin_cargando_mostrar() {


        if (browserType == "gecko")
            document.poppedLayer =
            eval('document.getElementById("esperando_acciones")');
        else if (browserType == "ie")
            document.poppedLayer =
            eval('document.getElementById("esperando_acciones")');
        else
            document.poppedLayer =
            eval('document.layers["esperando_acciones"]');
        document.poppedLayer.style.visibility = "hidden";
    }

    function cargando_mostrar() {
        if (browserType == "gecko")
            document.poppedLayer =
            eval('document.getElementById("esperando_acciones")');
        else if (browserType == "ie")
            document.poppedLayer =
            eval('document.getElementById("esperando_acciones")');
        else
            document.poppedLayer =
            eval('document.layers["esperando_acciones"]');
        document.poppedLayer.style.visibility = "visible";
    }



    $('#idpantalla_funcion_exe').on("change", function() {
        var idpantalla_funcion_exe = $('#idpantalla_funcion_exe').val();
        var nombre_funcion_insertar = $('#nombre_funcion_insertar').val();
        nombre_funcion_insertar = '{*' + nombre_funcion_insertar + '@' + idpantalla_funcion_exe + '*}';


        if ($('#pantalla_listar-tab').hasClass("active")) {
            if ($("#tipo_pantalla_busqueda").val() == 1) {
                //tinymce.activeEditor.execCommand('mceInsertContent', false, nombre_funcion_insertar);
            } else if ($("#tipo_pantalla_busqueda").val() == 2) {
                valor = nombre_funcion_insertar;
                var campo_interno_reporte = $("#" + campo_id_foco).val($("#" + campo_id_foco).val() +
                    valor);
                $("#" + campo_id_foco).focus();
            }
        } else {
            //tinymce.activeEditor.execCommand('mceInsertContent', false, nombre_funcion_insertar);
        }



    });


    $("#tipo_pantalla_busqueda").change(function() {
        $("#frame_tipo_listado").html(
            "<img src='<?php echo ($ruta_db_superior); ?>assets/images/cargando.gif'>");
        if ($(this).val() != 0) {
            $("#frame_tipo_listado").load(
                "<?php echo ($ruta_db_superior); ?>pantallas/generador/esquemas_busqueda_saia/" + $(
                    "#tipo_pantalla_busqueda option:selected").attr("nombre") + ".php",
                "tipo_busqueda=" + $(this).val() +
                "&idpantalla=<?php echo ($_REQUEST['idformato']); ?>");
        } else {
            $("#frame_tipo_listado").html("");
        }
    });

    function cambios_editor(editor) {
        //console.log(editor);
        if (editor.id == "editor_encabezado") {
            var modo = $("#idencabezado").val();
            if (modo == "" || modo == "0") {
                $("#adicionar_encabezado").removeClass("disabled");
                $("#adicionar_encabezado").prop('disabled', false);
            } else {
                $("#modificar_encabezado").removeClass("disabled");
                $("#modificar_encabezado").prop('disabled', false);
            }
        } else if (editor.id == "editor_pie") {
            var modo = $("#idpie").val();
            if (modo == "" || modo == "0") {
                $("#adicionar_pie").removeClass("disabled");
                $("#adicionar_pie").prop('disabled', false);
            } else {
                $("#modificar_pie").removeClass("disabled");
                $("#modificar_pie").prop('disabled', false);
            }
        } else {
            $("#actualizar_cuerpo_formato").removeClass("btn-success");
            $("#actualizar_cuerpo_formato").addClass("btn-info");
        }
    }

 
    function receiveMessage(event) {
        if (event.data["etiqueta_html"] && event.data["etiqueta_html"] == 'textarea_cke') {
            CKEDITOR.instances[event.data["nombre_campo"]].setData(event.data["fs_predeterminado"]);
        }
        var source = event.source.frameElement; //this is the iframe that sent the message
        var message = event.data; //this is the message
    }

    window.addEventListener("message", receiveMessage, false);


    $( '.permisos' ).on( 'click', function() {
                    if( $(this).is(':checked') ){
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo ($ruta_db_superior); ?>pantallas/generador/librerias_pantalla.php?permisosFormato=1',
                        data: {idformato: $("#idformato").val(),idperfil:$(this).val() ,nombreFormato : $("#nombreFormato").val()},
                        success: function(response) {
                            if (response) {
                                var objeto = jQuery.parseJSON(response);
                                if (objeto.exito==1) {
                                    notificacion_saia(objeto.mensaje, "success", "", 3000);
                                }else{
                                    notificacion_saia(objeto.mensaje, "error", "", 3000);
                                }
                            }
                        }
                    }); 
                    } else {
                        $.ajax({
                        type: 'POST',
                        url: '<?php echo ($ruta_db_superior); ?>pantallas/generador/librerias_pantalla.php?eliminarPermisoFormato=1',
                        data: {idformato: $("#idformato").val(),idperfil:$(this).val() ,nombreFormato : $("#nombreFormato").val()},
                        success: function(response) {
                            if (response) {
                                var objeto = jQuery.parseJSON(response);
                                if (objeto.exito==1) {
                                    notificacion_saia(objeto.mensaje, "success", "", 3000);
                                }else{
                                    notificacion_saia(objeto.mensaje, "error", "", 3000);
                                }
                            }
                        }
                    }); 
                    }
                });

    ////////////////////////////////// Nuevos scripts interacción grafica //////////////////////////////////////////

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

 /////////////////////////////////////////////////////////////////////////////////////////////////////////



}); //Fin Document ready
/*
function generar_archivos_ignorados(){
  $.ajax({
    type:'POST',
    url: '<?php echo ($ruta_db_superior); ?>pantallas/generador/librerias_pantalla.php',
    data:'ejecutar_libreria_pantalla=generar_archivos_ignorados&idpantalla='+$("#idformato").val()+"&rand="+Math.round(Math.random()*100000)
	});
}*/
</script>
