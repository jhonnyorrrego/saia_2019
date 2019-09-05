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
include_once $ruta_db_superior . 'assets/librerias.php';
include_once $ruta_db_superior . 'arboles/crear_arbol_ft.php';

$formatId = $_REQUEST['idformato'] ?? 0;
$params = json_encode([
    'baseUrl' => $ruta_db_superior,
    'formatId' => $formatId
]);

if ($formatId) {
    /////////////////////////////////////////// Configuracion del arbol /////////////////////////////////////////////////////
    $origen = [
        "url" => "arboles/arbol_formatos.php",
        "ruta_db_superior" => $ruta_db_superior,
        "params" => [
            "id" => $formatId,
            "cargar_seleccionado" => 1
        ]
    ];
    $opciones_arbol = [
        "keyboard" => true,
        "onNodeClick" => "evento_click",
        "busqueda_item" => 1
    ];
    $extensiones = ["filter" => []];
    $arbol = new ArbolFt("campo_idformato", $origen, $opciones_arbol, $extensiones);
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

function check_banderas($bandera, $chequear = true)
{
    global $formato;

    if ($bandera == "aprobacion_automatica") {
        echo ' value="e" ';
        if (strpos($formato[0]["banderas"], "e") !== false) {
            echo ' checked="checked" ';
        }
    } else if ($bandera == "asunto_padre") {
        echo ' value="r" ';
        if (strpos($formato[0]["banderas"], "r") !== false) {
            echo ' checked="checked" ';
        }
    } else if ($bandera && $formato[0][$bandera]) {
        $texto = ' value="' . $formato[0][$bandera] . '"';
        if ($chequear) {
            $texto .= ' checked="checked" ';
        }
        echo $texto;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Generador Pantallas SAIA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= theme() ?>
    <?= icons() ?>
    <?= jqueryUi() ?>
    <?= icons() ?>
    <?= fancyTree('filter') ?>
    <?= validate() ?>
    <?= ckeditor() ?>
    <?= select2() ?>
    <link href="<?= $ruta_db_superior ?>views/generador/css/index.css" rel="stylesheet">
    <link href="<?= $ruta_db_superior ?>views/generador/css/lists.css" rel="stylesheet" />
    <style type="text/css">
        .arbol_saia>.containerTableStyle {
            overflow: hidden;
        }

        ul.fancytree-container {
            overflow: auto;
            position: relative;
            border: none !important;
            outline: none !important;
        }

        span.fancytree-title {
            font-family: Ubuntu, sans-serif;
            font-size: 12px;
        }

        span.fancytree-checkbox.fancytree-radio {
            vertical-align: middle;
        }

        span.fancytree-expander {
            vertical-align: middle !important;
        }
    </style>
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
</head>

<body>
    <div class="container-fluid mx-0 px-2 pb-5" style="min-width:1400px;">
        <div class="row my-2 mx-0">
            <div class="col-12 col-sm-12 col-md-3 col-lg-2 mx-0"></div>
            <div class="col-12 col-sm-12 col-md-3 col-lg-2 mx-0 fixed-top">
                <div class="section" id="arbol">
                    <div class="col-12 px-0 mb-2">
                        <?= $arbol ? $arbol->generar_html() : '' ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-9 col-lg-10 mx-0 px-1">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 pl-1 ml-1 mr-0" style="position:fixed;z-index:1;background:white;top:-2px;padding-top:6px;padding-bottom:6px;">
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

                        <div style="position:fixed;right:8px;top:0px;">
                            <label id="guardar" style="background: #48b0f7; color:fff; margin-top:3px; margin-left:10px;margin-bottom: 7px;color:white;cursor:pointer;height:44px;width:140px;padding-left:32px;padding-top:10px;">Guardar</label>
                            <label id="generar" style="background: #48b0f7; color:fff; margin-top:3px; margin-left:10px;margin-bottom: 7px;color:white;cursor:pointer;height:44px;width:140px;padding-left:32px;padding-top:10px;">PUBLICAR</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 pl-4 mr-0 ml-1 mt-5" style="border-left:1px solid #eee;">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 mx-0 px-1" id="contenedor_generador">
                                <div class="tabbable section">
                                    <div class="tab-content" style="text-align:left;">
                                        <!-- vista previa -->
                                        <div class="tab-pane" id="pantalla_previa-tab" style="background:#eee;padding-top:30px;padding-bottom:30px">
                                            <div id="pantalla_vista_previa" style="background:#fff;margin:30px;"></div>

                                        </div>
                                        <!-- fin vista previa -->

                                        <!-- creacion del mostrar -->
                                        <div class="tab-pane" id="pantalla_mostrar-tab">
                                            <div class="row">
                                                <div class="col-12 col-md-9">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h5 class="title">Encabezado del formato</h5>
                                                            <select name="encabezado" id="select_header" style="width:250px;" class="select_header_footer" data-type="header">
                                                                <option value="0">Por favor Seleccione</option>
                                                            </select>

                                                            <span style="cursor:pointer;font-size:18px;margin-left: 5px;" class="crear_encabezado" id="crear_encabezado">
                                                                <i class="fa fa-plus-circle"></i>
                                                            </span>

                                                            <span style="cursor:pointer;font-size:18px;margin-left: 5px;" class="edit_header_footer" data-type="header">
                                                                <i class="fa fa-edit"></i>
                                                            </span>
                                                            <span style="cursor:pointer;font-size:18px;margin-left: 5px;" class="delete_header_footer" data-type="header">
                                                                <i class="fa fa-trash"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12" id="header_content"></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h5 class="title">Cuerpo del formato</h5><br>
                                                            <textarea name="editor_mostrar" id="editor_mostrar"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h5 class="title">Pie del formato</h5><br>
                                                            <select name="pie_pagina" id="select_footer" style="width:250px;" class="select_header_footer" data-type="footer">
                                                                <option value=" 0">Por favor Seleccione</option>
                                                            </select>
                                                            <span style="cursor:pointer;font-size:18px;margin-left: 5px;" class="crear_pie" id="crear_pie">
                                                                <i class="fa fa-plus-circle"></i>
                                                            </span>
                                                            <span style="cursor:pointer;font-size:18px;margin-left: 5px;" class="edit_header_footer" data-type="footer">
                                                                <i class="fa fa-edit"></i>
                                                            </span>
                                                            <span style="cursor:pointer;font-size:18px;margin-left: 5px;" class="delete_header_footer" data-type="footer">
                                                                <i class="fa fa-trash"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12" id="footer_content"></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-3" id="funciones_desplegables"></div>
                                            </div>
                                        </div>
                                        <!-- fin creacion del mostrar -->

                                        <!-- campos formato -->
                                        <div class="tab-pane" id="formulario-tab">
                                            <div class="row px-0 mx-0 pt-3">
                                                <div class="mx-0 px-0 col-9" style="position:relative;display:inline-block;vertical-align:top">
                                                    <ul id="contenedorComponentes" class="sortable boxy px-4" style="margin-left: 1em;">
                                                        <h6 style="text-align:center;position:absolute;top:160px;left:270px;opacity:0.6"><i class="fa fa-dropbox" style="font-size:200%;"></i> Arrastre los componentes aquí</h6>
                                                        <?php
                                                        $consulta_campos_lectura = busca_filtro_tabla("valor", "configuracion", "nombre='campos_solo_lectura'", "", $conn);
                                                        $campos_excluir = array(
                                                            "dependencia",
                                                            "documento_iddocumento",
                                                            "estado_documento",
                                                            "firma",
                                                            "serie_idserie",
                                                            "encabezado"
                                                        );
                                                        if ($consulta_campos_lectura['numcampos']) {
                                                            $campos_lectura = json_decode($consulta_campos_lectura[0]['valor'], true);
                                                            $campos_lectura = implode(",", $campos_lectura);
                                                            $campos_lectura = str_replace(",", "','", $campos_lectura);
                                                            $busca_idft = strpos($campos_lectura, "idft_");
                                                            if ($busca_idft !== false) {
                                                                $consulta_ft = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $formatId, "", $conn);
                                                                $campos_lectura = str_replace("idft_", "id" . $consulta_ft[0]['nombre_tabla'], $campos_lectura);
                                                                $campos_excluir[] =  $campos_lectura;
                                                            }
                                                        }
                                                        $condicion_adicional = " and B.nombre not in('" . implode("', '", $campos_excluir) . "')";
                                                        $pantalla = busca_filtro_tabla("", "formato A,campos_formato B", "A.idformato=B.formato_idformato AND A.idformato=" . $formatId . $condicion_adicional, "B.orden", $conn);
                                                        $texto = '';
                                                        if ($pantalla['numcampos']) {
                                                            $count = 1;
                                                            for ($i = 0; $i < $pantalla["numcampos"]; $i++) {
                                                                $pantalla_campos = busca_filtro_tabla("A.*,B.nombre AS nombre_componente,B.etiqueta AS etiqueta_componente,B.componente,B.opciones,B.categoria,B.procesar,B.estado AS componente_estado,B.idpantalla_componente, B.eliminar, B.opciones_propias, C.nombre AS pantalla,A.idcampos_formato AS idpantalla_campos,B.etiqueta_html AS etiqueta_html_componente", "campos_formato A,pantalla_componente B, formato C", "A.formato_idformato=C.idformato AND A.idcampos_formato=" . $pantalla[$i]['idcampos_formato'] . " AND A.etiqueta_html=B.etiqueta_html", "", $conn);
                                                                if ($pantalla_campos["numcampos"] && (strpos($pantalla_campos[0]["acciones"], substr($accion, 0, 1)) !== false || $accion == '' || $accion == 'retorno_campo')) {
                                                                    $pantalla_componente = busca_filtro_tabla("clase,nombre", "pantalla_componente", "idpantalla_componente={$pantalla_campos[0]['idpantalla_componente']}", "", $conn);
                                                                    $texto .= "<li class='agregado' idpantalla_campo='" . $pantalla_campos[0]['idpantalla_campos'] . "' idpantalla_componente='" . $pantalla_campos[0]['idpantalla_componente'] . "' data-position='" . $count . "' ><i class='fa {$pantalla_componente[0]["clase"]} mr-3'></i> " . $pantalla_campos[0]["etiqueta"] . " <div class='eliminar' style='position:absolute;right:24px;top:20px;font-size:150%;cursor:pointer;' title='Eliminar componente'><i class='fa fa-trash eliminar'></i></div></li>";
                                                                }
                                                                $count++;
                                                            }

                                                            $texto = str_replace("? >", "?" . ">", $texto);
                                                            $texto = str_replace("< ?php ", "<" . "?php", $texto);
                                                        }

                                                        echo $texto;
                                                        ?>
                                                    </ul>
                                                </div>
                                                <div class="col-3" style="position:relative;display:inline-block;vertical-align:top">
                                                    <ul id="itemsComponentes" class="sortable boxier" style="margin-right: 1em;">
                                                        <?php
                                                        $listadoComponentes = busca_filtro_tabla('etiqueta,idpantalla_componente,clase', 'pantalla_componente', 'estado=1', '', $conn);

                                                        for ($i = 0; $i < $listadoComponentes["numcampos"]; $i++) {
                                                            $etiqueta = htmlentities(html_entity_decode(utf8_encode($listadoComponentes[$i]["etiqueta"])));
                                                            echo "<li class='panel' idpantalla_componente='{$listadoComponentes[$i]["idpantalla_componente"]}' idformato='{$formatId}' ><i class='{$listadoComponentes[$i]["clase"]} mr-3'></i>{$etiqueta}</li>";
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- fin campos formato -->

                                        <!-- informacion formato -->
                                        <div class="tab-pane" id="datos_formulario-tab">
                                            <?php
                                            if ($formatId) {
                                                $formato = busca_filtro_tabla("", "formato", "idformato=" . $formatId, "", $conn);
                                                $formato = procesar_cadena_json($formato, array("cuerpo", "ayuda", "etiqueta"));
                                                $cod_padre = $formato[0]["cod_padre"];

                                                $cod_proceso_pertenece = $formato[0]["proceso_pertenece"];
                                                $categoria = $formato[0]["fk_categoria_formato"];
                                                if ($formato[0]["tiempo_autoguardado"] > 3000) {
                                                    $formato[0]["tiempo_autoguardado"] = $formato[0]["tiempo_autoguardado"] / 60000;
                                                }
                                                $funcionPredeterminada = strpos($formato[0]['funcion_predeterminada'], "1");
                                                $checkResponsables = '';
                                                if ($funcionPredeterminada !== false) {
                                                    $checkResponsables = "checked";
                                                }
                                                //$formato = json_encode($formato);
                                                if ($cod_proceso_pertenece) {
                                                    $adicional_cod_proceso = "&seleccionado=" . $cod_proceso_pertenece;
                                                }
                                                if ($cod_padre) {
                                                    $nombre_cod_padre = busca_filtro_tabla("", "formato a", "a.idformato=" . $cod_padre, "", $conn);
                                                    $adicional_cod_padre = "&seleccionado=" . $cod_padre;
                                                }
                                                if ($categoria) {
                                                    $nombre_categoria = busca_filtro_tabla("", "categoria_formato a", "a.idcategoria_formato IN($categoria)", "", $conn);
                                                    $adicional_categoria = "&seleccionado=" . $categoria;
                                                }

                                                $origen = array("url" => "arboles/arbol_formatos.php", "ruta_db_superior" => $ruta_db_superior, "params" => array("id" => $_REQUEST['id'], "excluido" => $formatId, "seleccionados" => $cod_padre, "seleccionable" => "radio"));
                                                $opciones_arbol = array("keyboard" => true, "selectMode" => 1, "seleccionarClick" => 1, "busqueda_item" => 1, "checkbox" => radio);
                                                $extensiones = array("filter" => array());
                                                $arbol = new ArbolFt("codigo_padre_formato", $origen, $opciones_arbol, $extensiones, $validaciones);

                                                $origenCategoria = array("url" => "arboles/arbol_categoria_formatos.php", "ruta_db_superior" => $ruta_db_superior, "params" => array("tipo" => "1", "seleccionados" => $formato[0]["fk_categoria_formato"], "seleccionable" => "checkbox"));
                                                $opcionesArbolCategoria = array("keyboard" => true, "selectMode" => 3, "seleccionarClick" => 1, "busqueda_item" => 1, "checkbox" => checkbox);
                                                $extensionesCategoria = array("filter" => array());
                                                $arbolCategoria = new ArbolFt("fk_categoria_formato", $origenCategoria, $opcionesArbolCategoria, $extensionesCategoria, $validaciones);
                                            } else {
                                                $origen = array("url" => "arboles/arbol_formatos.php", "ruta_db_superior" => $ruta_db_superior, "params" => array("seleccionable" => "radio"));
                                                $opciones_arbol = array("keyboard" => true, "selectMode" => 1, "seleccionarClick" => 1, "busqueda_item" => 1, "checkbox" => radio);
                                                $extensiones = array("filter" => array());
                                                $arbol = new ArbolFt("codigo_padre_formato", $origen, $opciones_arbol, $extensiones, $validaciones);

                                                $origenCategoria = array("url" => "arboles/arbol_categoria_formatos.php", "ruta_db_superior" => $ruta_db_superior, "params" => array("tipo" => "1", "seleccionado" => $formato[0]["fk_categoria_formato"], "seleccionable" => "checkbox"));
                                                $opcionesArbolCategoria = array("keyboard" => true, "selectMode" => 3, "seleccionarClick" => 1, "busqueda_item" => 1, "checkbox" => checkbox);
                                                $extensionesCategoria = array("filter" => array());
                                                $arbolCategoria = new ArbolFt("fk_categoria_formato", $origenCategoria, $opcionesArbolCategoria, $extensionesCategoria, $validaciones);
                                            }

                                            $tipoDocumental = busca_filtro_tabla("", "serie", "tipo=3 and estado=1", "lower(nombre)", $conn);

                                            /**
                                             * Esta funcion puede servir para
                                             */
                                            function procesar_cadena_json($resultado, $lista_valores)
                                            {
                                                for ($i = 0; $i < $resultado["numcampos"]; $i++) {
                                                    $busqueda = $resultado[$i];
                                                    foreach ($busqueda as $key => $valor) {
                                                        if (is_numeric($key)) {
                                                            unset($busqueda[$key]);
                                                        } else if (in_array($key, $lista_valores)) {
                                                            $busqueda[$key] = str_replace("\n", "", $busqueda[$key]);
                                                            $busqueda[$key] = str_replace("\r", "", $busqueda[$key]);
                                                            $busqueda[$key] = html_entity_decode($busqueda[$key]);
                                                            $busqueda[$key] = addslashes($busqueda[$key]);
                                                        }
                                                    }
                                                    $resultado[$i] = $busqueda;
                                                }
                                                return ($resultado);
                                            }

                                            ?>
                                            <script type="text/javascript" src="<?= $ruta_db_superior ?>views/generador/js/editar_componente_generico.js"></script>

                                            <form name="datos_formato" id="datos_formato">
                                                <div class="row mx-4 px-0">
                                                    <div class="col-9 mt-4">
                                                        <div class="title my-0">
                                                            Información general
                                                        </div>
                                                        <hr />
                                                        <input type="hidden" name="nombre" id="nombre_formato" value="" required />
                                                        <input type="hidden" name="idformato" id="idformato" value="<?= $_REQUEST["idformato"] ?>" />
                                                        <div class="row-fluid">

                                                            <div class="my-3">
                                                                <label class="control-label" for="etiqueta"><strong>Nombre del formato<span class="require-input">*</span></strong></label>
                                                                <input type="text" class="col-12" name="etiqueta" id="etiqueta_formato" placeholder="Nombre" value="" required />

                                                            </div>
                                                            <div class="my-3">
                                                                <label class="control-label" for="descripcion"><strong>Descripci&oacute;n del formato</strong><span class="require-input">*</span></label>

                                                                <textarea class="col-12" name="descripcion_formato" id="descripcion_formato" placeholder="Descripci&oacute;n" rows="3" required></textarea>

                                                            </div>

                                                            <div class="my-3">
                                                                <div class="row">
                                                                    <div class="col-9">
                                                                        <label class="control-label" for="serie_idserie"><strong>Tipo documental asociado</strong></label>
                                                                        <div id="select_serie">
                                                                            <div id="esperando_arbol_serie_formato"></div>

                                                                            <select style="width:100%;" name="serie_idserie" id="serie_idserie">
                                                                                <?php
                                                                                $tipo = '';
                                                                                for ($i = 0; $i < $tipoDocumental["numcampos"]; $i++) {
                                                                                    echo '<option value="' . $tipoDocumental[$i]["idserie"] . '" class="codigoSerie" codigo="' . $tipoDocumental[$i]["codigo"] . '" >' . ucwords(strtolower($tipoDocumental[$i]["nombre"])) . '</option>';
                                                                                }
                                                                                ?>
                                                                            </select>

                                                                            <div id="treebox_arbol_serie_formato" class="arbol_saia"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="my-1 col-3">
                                                                        <div>
                                                                            <strong>C&oacute;digo</strong>
                                                                        </div>
                                                                        <div class="my-2">
                                                                            <input type="text" disabled id="codigoSerieInput" style="background:#fff;height:36px;width:100%" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mt-4">
                                                                <div class="col-12">
                                                                    <label for="banderas"><strong>Atributos del formato</strong></label>
                                                                </div>
                                                                <div class="col-12 mt-5 text-left">
                                                                    <div class="text-left" style="width:220px;display:inline-block"><input type="checkbox" class="paginar" name="paginar" id="paginar" <?php check_banderas('paginar'); ?>><span class="paginar">Paginar al mostrar</span></div>
                                                                    <div class="text-left" style="width:220px;display:inline-block"><input type="checkbox" name="banderas[]" id="banderas" <?= check_banderas('aprobacion_automatica'); ?>><span class="banderas">Aprobacion Automatica</span></div>
                                                                    <div class="text-left" style="width:220px;display:inline-block"><input type="checkbox" class="mostrar_pdf" name="mostrar_pdf" id="mostrar_pdf" <?php check_banderas('mostrar_pdf'); ?>><span class="mostrar_pdf">Mostrar en PDF</span></div>
                                                                    <div class="text-left" style="width:220px;display:inline-block"><input type="checkbox" class="tipo_edicion" name="tipo_edicion" id="tipo_edicion" <?php check_banderas('tipo_edicion'); ?>><span class="tipo_edicion">Edicion Continua</span></div>
                                                                    <input type="checkbox" name="banderas[]" style="display:none;" id="banderas" <?php check_banderas('asunto_padre'); ?> checked>
                                                                </div>

                                                                <input type="hidden" name="mostrar" id="mostrar" <?php check_banderas('mostrar', false); ?>>
                                                                <input type="hidden" name="paginar" id="paginar" <?php check_banderas('paginar', false); ?>>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 my-3 pl-0">
                                                        <div class="my-3 pt-5">
                                                            <label class="control-label" for="version"><strong>Versi&oacute;n<span class="require-input">*</span></strong></label>
                                                            <div class="my-0">
                                                                <input type="text" name="version" id="version" placeholder="Versi&oacute;n" value="" style="height:44px;width:100%;" required>
                                                            </div>
                                                        </div>
                                                        <div class="my-0">
                                                            <label class="control-label" for="tipos"><strong>Tipo de registro<span class="require-input">*</span></strong></label>
                                                            <div class="my-0">
                                                                <select style="height:44px;width:100%;" name="tipo_registro" id="tipo_registro" data-toggle="tooltip">
                                                                    <option value="">Por favor seleccione</option>
                                                                    <option value="1">Documento oficial (PDF)</option>
                                                                    <option value="2">Registro de apoyo</option>
                                                                    <option value="3">Registro del tipo Item</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="my-4">
                                                            <label class="control-label" for="mostrar_tipodoc_pdf">&nbsp;</label>
                                                            <div class="my-1 py-2">
                                                                <input type="checkbox" name="mostrar_tipodoc_pdf" id="mostrar_tipodoc_pdf" value="1" <?php if (@$formato[0]["mostrar_tipodoc_pdf"] == 1) echo (' checked="checked"'); ?>>
                                                                <span id="texto_tipodoc">Mostrar código en el nombre del Formato.</span>
                                                            </div>
                                                        </div>
                                                        <div class="mt-2 py-3">
                                                            <label class="control-label" for="contador"><strong>Consecutivo asociado<span class="require-input">*</span></strong></label>
                                                            <div class="mt-4">
                                                                <select style="height:44px;width:100%" name="contador_idcontador" data-toggle="tooltip" title="Escoja un contador" id="contador_idcontador" required>
                                                                    <?php
                                                                    $contadores = busca_filtro_tabla("", "contador", "nombre<>'' and estado=1", "nombre", $conn);
                                                                    $reinicia_contador = 1;
                                                                    for ($i = 0; $i < $contadores["numcampos"]; $i++) {
                                                                        echo ('<option value="' . $contadores[$i]["idcontador"] . '"');
                                                                        if ($formato[0]["contador_idcontador"] == $contadores[$i]["idcontador"]) {
                                                                            echo (" selected='selected' ");
                                                                            $reinicia_contador = $contadores[$i]["reiniciar_cambio_anio"];
                                                                        }
                                                                        echo ('>' . $contadores[$i]["etiqueta_contador"] . '</option>');
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mx-4">
                                                    <div class="col-9">
                                                        <div class="title my-0 mt-5">
                                                            Configuraci&oacute;n de p&aacute;gina
                                                        </div>
                                                        <hr />
                                                        <div class="my-4 py-1">
                                                            <label class="control-label" for="papel"><strong>Tama&ntilde;o de la p&aacute;gina</strong></label>
                                                            <div class="my-2">
                                                                <select name="papel" id="papel" style="height:44px;">
                                                                    <option value="Letter" <?= $formato[0]["papel"] == "Letter" ? ' selected' : '' ?>>Carta (21,6 cm x 27,9 cm)</option>
                                                                    <option value="Legal" <?= $formato[0]["papel"] == "Legal" ? ' selected' : '' ?>>Legal (21,6 cm x 35,6 cm)</option>
                                                                    <option value="A4" <?= $formato[0]["papel"] == "A4" ? ' selected' : '' ?>>A4 (21,0 cm x 29,7 cm)</option>
                                                                    <option value="A5" <?= $formato[0]["papel"] == "A5" ? ' selected' : '' ?>>Media Carta (14,0 cm x 21,6 cm)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row my-4">
                                                            <div class="col-6">

                                                                <label class="control-label" for="orientacion"><strong>Orientaci&oacute;n</strong></label>
                                                                <div class="py-2">
                                                                    <input type="radio" name="orientacion" id="orientacion_0" value="0" <?php if (!@$formato[0]["orientacion"]) echo (' checked="checked"'); ?>> Vertical &nbsp;&nbsp;
                                                                    <input type="radio" name="orientacion" id="orientacion_1" value="1" <?php if (@$formato[0]["orientacion"]) echo (' checked="checked"'); ?>> Horizontal
                                                                </div>

                                                            </div>
                                                            <div class="col-6 mx-0">
                                                                <label class=" control-label" for="font_size"><strong>Tama&ntilde;o de letra</strong></label>
                                                                <div class="my-2 mx-4">
                                                                    <select name="font_size" id="font_size" data-toggle="tooltip" title="Seleccione el tamaño de letra para los formatos" style="height:44px;">
                                                                        <?php
                                                                        $tam_letras = [8, 10, 11, 12, 14, 16, 18, 22, 24, 30, 36];
                                                                        $default_font_size = 11;
                                                                        if (@$formato["numcampos"]) {
                                                                            $default_font_size = $formato[0]["font_size"];
                                                                        }

                                                                        foreach ($tam_letras as $value) {
                                                                            echo ('<option value="' . $value . '"');
                                                                            if ($value == $default_font_size) {
                                                                                echo (' selected="selected"');
                                                                            }
                                                                            echo ('>' . $value . '</option>');
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="my-4">
                                                            <label class="control-label" for="fk_categoria_formato" data-toggle="tooltip" title="Escoja en donde ser&aacute; ubicado el formato"><strong>Categor&iacute;a del formato</strong></label>
                                                            <div class="col-6">
                                                                <?= $arbolCategoria->generar_html() ?>
                                                            </div>
                                                        </div>
                                                        <div class="my-4">
                                                            <div class="my-1">
                                                                <label class="control-label" for="funcion_predeterminada"><strong>Ruta de aprobaci&oacute;n</strong></label>
                                                            </div>
                                                            <div class="my-1">
                                                                Varios responsables <input type="checkbox" name="funcion_predeterminada[]" id="funcion_predeterminada_1" value="1" <?php echo $checkResponsables; ?> data-toggle="tooltip" title="Opción que realiza ruta de aprobación">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 my-5">
                                                        <div class="my-5 py-4">
                                                            <?php
                                                            $margen_defecto = array(2.5, 2.5, 1.9, 2.5);
                                                            if ($formato["numcampos"] && !empty($formato[0]["margenes"])) {
                                                                $margen_defecto = explode(",", $formato[0]["margenes"]);
                                                                $margen_defecto = array_map(function ($val) {
                                                                    return $val / 10; // esta guardado en milimetros
                                                                }, $margen_defecto);
                                                            }
                                                            ?>
                                                            <label class="control-label ml-2" for="margenes"><strong>M&aacute;rgenes (cent&iacute;metros)</strong></label>
                                                            <div class="row-fluid text-right col-9">
                                                                <div class="my-3">
                                                                    <label for="msup">Superior </label>
                                                                    <input type="number" min="0" max="10" step="0.1" class="ml-4 input-mini" name="msup" id="msup" value="<?= $margen_defecto[2] ?>" style="width:50%;height:44px">

                                                                </div>

                                                                <div class="my-3">
                                                                    <label for="minf">Inferior </label>
                                                                    <input type="number" min="0" max="10" step="0.1" class="ml-4 pl-1 input-mini" name="minf" id="minf" value="<?= $margen_defecto[3] ?>" style="width:50%;height:44px">

                                                                </div>

                                                                <div class="my-3">
                                                                    <label for="mizq">Izquierda</label>
                                                                    <input type="number" min="0" max="10" step="0.1" class="ml-4 input-mini" name="mizq" id="mizq" value="<?= $margen_defecto[0] ?>" style="width:50%;height:44px">

                                                                </div>
                                                                <div class="mt-3">
                                                                    <label for="mder">Derecha</label>
                                                                    <input type="number" min="0" max="10" step="0.1" class="ml-4 input-mini" name="mder" id="mder" value="<?= $margen_defecto[1] ?>" style="width:50%;height:44px">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row my-3 pt-3">
                                                    <div class="col 12">
                                                        <label class="control-label title" for="codigo_padre" data-toggle="tooltip" title="Seleccione el formato principal al cual pertenece"><strong>Relaci&oacute;n con otro Formato</strong></label>
                                                        <hr />
                                                        <?php echo ($nombre_cod_padre[0]["etiqueta"]); ?>
                                                        <div class="col-6">
                                                            <input id="codigo_padre_formato" type="hidden" name="cod_padre" value="<?php echo ($cod_padre); ?>">
                                                            <?= $arbol->generar_html() ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="title my-0 mt-5 mx-4 pt-3">
                                                    Permisos del formato a:
                                                    <hr />
                                                </div>

                                                <div class="mx-4 my-3 pt-2">
                                                    <?php
                                                    $profiles = busca_filtro_tabla("A.idperfil, A.nombre", "perfil A", "", "A.nombre ASC", $conn);

                                                    if ($profiles['numcampos']) {
                                                        echo '<div>';
                                                        for ($i = 0; $i < $profiles['numcampos']; $i++) {
                                                            echo "<label class='input-group' style='display:inline-block;width:200px;'>
                                                                <input class='permisos' type='checkbox' id='{$profiles[$i]["idperfil"]}' name='permisosPerfil[]' value='{$profiles[$i]["idperfil"]}' > {$profiles[$i]["nombre"]}
                                                            </label>";
                                                        }
                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>

                                                <input type="hidden" name="exportar" value="mpdf">
                                                <input type="hidden" name="pertenece_nucleo" value="0">
                                                <input type="hidden" id="tiempo_formato" name="tiempo_autoguardado" value="5">
                                            </form>
                                        </div>
                                        <!-- fin informacion formato -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= $ruta_db_superior ?>views/generador/js/generador_pantalla.js"></script>
    <script src="<?= $ruta_db_superior ?>views/generador/js/coordinates.js"></script>
    <script src="<?= $ruta_db_superior ?>views/generador/js/drag.js"></script>
    <script src="<?= $ruta_db_superior ?>views/generador/js/dragdrop.js"></script>
    <script src="<?= $ruta_db_superior ?>views/generador/js/funciones_arbol.js"></script>
    <?php
    $cant_js = count($librerias_js);
    $incluidas = array();
    for ($i = 0; $i < $cant_js; $i++) {
        if (!in_array($librerias_js[$i], $librerias_jsh) && !in_array($librerias_js[$i], $incluidas) && !empty($librerias_js[$i])) {
            array_push($incluidas, $librerias_js[$i]);
            echo ('<script type="text/javascript" src="' . $ruta_db_superior . $librerias_js[$i] . '"></script>');
        }
    }
    ?>
    <script type="text/javascript" data-params='<?= $params ?>' id="script_generador_pantalla">
        $(document).ready(function() {
            let params = $('#script_generador_pantalla').data('params');
            let step = 1;

            (function init() {
                var editor_mostrar = CKEDITOR.replace("editor_mostrar");
                createHeaderFooterSelect()
            })()

            $(".nav li").click(function() {
                return !$(this).hasClass('disabled');
            });

            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $(e.relatedTarget).css({
                    'color': '#666',
                    'background': '#eee',
                    'font-weight': 'normal'
                });
                $(e.target).css({
                    'color': '#fff',
                    'background': '#49b0e8',
                    'font-weight': 'bold'
                });

                switch ($(e.target).attr('id')) {
                    case 'nav-vista_previa':
                        step = 4;
                        break;
                    case 'nav-mostrar':
                        step = 3;
                        break;
                    case 'nav-campos':
                        step = 2;
                        break;
                    case 'nav-informacion':
                        step = 1;
                        break;
                }

                if (step == 1 || step == 3) {
                    $("#guardar").css({
                        'color': '#fff',
                        'background': '#49b0e8',
                        'font-weight': 'bold'
                    });
                } else {
                    $("#guardar").css({
                        'color': '#666',
                        'background': '#eee',
                        'font-weight': 'normal'
                    });
                }
            });

            $('#guardar').on('click', function() {
                if (step == 1) {
                    saveFormat();
                } else if (step == 3) {
                    saveBody();
                } else {
                    return false;
                }
            })

            $(document).on("click", ".funcionesPropias", function() {
                var funcion = $(this).attr("name");
                CKEDITOR.instances['editor_mostrar'].insertText(funcion);
            });

            $(document).on("change", ".select_header_footer", function() {
                $.post(
                    `${params.baseUrl}app/generador/actualizar_encabezado_pie.php`, {
                        key: localStorage.getItem('key'),
                        token: localStorage.getItem('token'),
                        formatId: params.formatId,
                        type: $(this).data('type'),
                        identificator: $(this).val()
                    },
                    function(response) {
                        if (response.success) {
                            top.notification({
                                type: 'success',
                                message: response.message
                            });

                            if (type == 'header') {
                                showHeader();
                            } else {
                                showFooter();
                            }
                        } else {
                            top.notification({
                                type: 'error',
                                message: response.message
                            });
                        }
                    },
                    'json'
                );
            });

            $(document).on("click", ".delete_header_footer", function(e) {
                let type = $(this).data('type');
                let identificator = type == 'header' ? $("#select_header").val() : $("#select_footer").val();

                $.post(
                    `${params.baseUrl}app/generador/eliminar_encabezado_pie.php`, {
                        key: localStorage.getItem('key'),
                        token: localStorage.getItem('token'),
                        identificator: identificator,
                        formatId: params.formatId,
                        type: type
                    },
                    function(response) {
                        if (response.success) {
                            createHeaderFooterSelect();

                            top.notification({
                                type: 'success',
                                message: response.message
                            });
                        } else {
                            top.notification({
                                type: 'error',
                                message: response.message
                            });
                        }
                    },
                    'json'
                );
            });

            $(document).on("click", ".edit_header_footer", function(e) {
                let type = $(this).data('type');
                let identificator = type == 'header' ? $("#select_header").val() : $("#select_footer").val();

                if (identificator) {
                    top.topModal({
                        url: `${params.baseUrl}views/generador/editor_encabezado.php`,
                        params: {
                            identificator: identificator
                        },
                        size: 'modal-xl',
                        title: 'Editar contenido',
                        buttons: {
                            success: {
                                label: "Guardar",
                                class: "btn btn-complete"
                            },
                            cancel: {
                                label: "Cerrar",
                                class: "btn btn-danger"
                            }
                        },
                        onSuccess: function(data) {
                            createHeaderFooterSelect();
                            top.closeTopModal();
                        }
                    });
                } else {
                    top.notification({
                        type: 'error',
                        message: "Debe seleccionar un item"
                    });
                }
            });





            $(document).on("click", ".guardar_pie", function(e) {
                alert('guardar pie');
                return;
                var id = $("#idpie").val();
                if (id) {
                    var etiqueta = $("#etiqueta_pie").val();
                    var directoryPath = window.location.href.substring(0, window.location.href.lastIndexOf("/") + 1);
                    var enlace = directoryPath + '/editor_encabezado.php';

                    top.topModal({
                        url: enlace,
                        params: {
                            idencabezado: id,
                            etiqueta: etiqueta,
                            idformato: $("#idformato").val()
                        },
                        size: 'modal-xl',
                        title: 'Editar pie del formato',
                        buttons: {
                            success: {
                                label: "Guardar",
                                class: "btn btn-complete"
                            },
                            cancel: {
                                label: "Cerrar",
                                class: "btn btn-danger"
                            }
                        }
                    });
                }
            });

            $(document).off("click", ".crear_encabezado").on("click", ".crear_encabezado", function(e) {
                top.topModal({
                    url: `${params.baseUrl}views/generador/crear_encabezado_pie.php`,
                    params: {
                        crear_encabezado: 1,
                        idformato: $("#idformato").val()
                    },
                    size: 'modal-xl',
                    title: 'Crear encabezado del formato',
                    buttons: {
                        success: {
                            label: "Guardar",
                            class: "btn btn-complete"

                        },
                        cancel: {
                            label: "Cerrar",
                            class: "btn btn-danger"
                        }
                    },
                    onSuccess: function(data) {
                        successModalEncabezado(data);
                    }
                });
            });

            $(document).off("click", ".crear_pie").on("click", ".crear_pie", function(e) {
                var directoryPath = window.location.href.substring(0, window.location.href.lastIndexOf("/") + 1);
                var enlace = directoryPath + '/crear_pie.php';

                top.topModal({
                    url: enlace,
                    params: {
                        crear_pie: 1,
                        idformato: $("#idformato").val()
                    },
                    size: 'modal-xl',
                    title: 'Crear pie del formato',
                    buttons: {
                        success: {
                            label: "Guardar",
                            class: "btn btn-complete"
                        },
                        cancel: {
                            label: "Cerrar",
                            class: "btn btn-danger"
                        }
                    },
                    onSuccess: function(data) {
                        successModalPie(data);
                    }
                });

            });

            function createHeaderFooterSelect() {
                $.post(
                    `${params.baseUrl}app/generador/consulta_encabezados.php`, {
                        key: localStorage.getItem('key'),
                        token: localStorage.getItem('token'),
                        formatId: params.formatId
                    },
                    function(response) {
                        if (response.success) {
                            $('#select_header,#select_footer').empty();
                            response.data.headers.forEach(item => {
                                $('#select_header,#select_footer').append(
                                    $('<option>', {
                                        value: item.id,
                                        text: item.label
                                    })
                                );
                            });

                            $('#select_header').val(response.data.header);
                            $('#select_footer').val(response.data.footer);
                            $('#select_header,#select_footer').select2();

                            showHeader();
                            showFooter();
                        } else {
                            top.notification({
                                type: 'error',
                                message: response.message
                            });
                        }
                    },
                    'json'
                );
            }

            function showHeader() {
                $.post(
                    `${params.baseUrl}app/generador/obtener_contenido_encabezado.php`, {
                        key: localStorage.getItem('key'),
                        token: localStorage.getItem('token'),
                        identificator: $('#select_header').val()
                    },
                    function(response) {
                        if (response.success) {
                            $('#header_content').html(response.data.content);
                        } else {
                            top.notification({
                                type: 'error',
                                message: response.message
                            });
                        }
                    },
                    'json'
                );
            }

            function showFooter() {
                $.post(
                    `${params.baseUrl}app/generador/obtener_contenido_encabezado.php`, {
                        key: localStorage.getItem('key'),
                        token: localStorage.getItem('token'),
                        identificator: $('#select_footer').val()
                    },
                    function(response) {
                        if (response.success) {
                            $('#footer_content').html(response.data.content);
                        } else {
                            top.notification({
                                type: 'error',
                                message: response.message
                            });
                        }
                    },
                    'json'
                );
            }

            function successModalEncabezado(data) {
                alert('actualizar select');
                return;
                if (data.accion != "update") {
                    $("#select_header").append("<option value=" + data.idencabezado + " selected>" + data.etiqueta + "</option>");
                } else {
                    $('option[value="' + data.idencabezado + '"]').html(data.etiqueta);
                }
                $("#encabezado_formato").html(data.contenido);
                encabezados[data.idencabezado] = data.contenido;
                top.closeTopModal();
            }

            function successModalPie(data) {
                alert('actualizar select footer');
                return;
                if (data.accion != "update") {
                    $("#select_footer").append("<option value=" + data.idencabezado + " selected>" + data.etiqueta + "</option>");
                } else {
                    $('option[value="' + data.idencabezado + '"]').html(data.etiqueta);
                }

                $("#pie_formato").html(data.contenido);
                encabezados[data.idencabezado] = data.contenido;
                top.closeTopModal();
            }

            function saveFormat() {
                if ($("#datos_formato").valid()) {
                    let data = $("#datos_formato").serialize() + "&" + $.param({
                        token: localStorage.getItem('token'),
                        key: localStorage.getItem('key')
                    });
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: `${params.baseUrl}app/generador/guardar_formato.php`,
                        data: data,
                        success: function(response) {
                            if (response.success) {
                                top.notification({
                                    type: 'success',
                                    message: response.message
                                });

                                if (!params.formatId) {
                                    window.location.href = window.location.pathname + "?idformato=" + response.data.formatId;
                                }
                            } else {
                                top.notification({
                                    type: 'error',
                                    message: response.message
                                });
                            }
                        }
                    });
                } else {
                    top.notification({
                        type: 'warning',
                        message: "Debe diligenciar los campos obligatorios"
                    });
                    $(".error").first().focus();
                    return false;
                }
            }

            function saveBody() {
                var content = CKEDITOR.instances['editor_mostrar'].getData();

                $.post(
                    `${params.baseUrl}app/generador/actualizar_cuerpo_formato.php`, {
                        key: localStorage.getItem('key'),
                        token: localStorage.getItem('token'),
                        content: content,
                        formatId: params.formatId
                    },
                    function(response) {
                        if (response.success) {
                            top.notification({
                                type: 'success',
                                message: response.message
                            });
                            $('#tabs_formulario a[href="#pantalla_previa-tab"]').tab('show');
                        } else {
                            top.notification({
                                type: 'error',
                                message: response.message
                            });
                        }
                    },
                    'json'
                );
            }

            $.ajax({
                type: 'POST',
                url: `${params.baseUrl}pantallas/lib/llamado_ajax.php`,
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

            $.ajax({
                type: "POST",
                dataType: "json",
                data: {
                    idpantalla: $("#idformato").val(),
                    key: localStorage.getItem("key")
                },
                url: `${params.baseUrl}app/generador_pantalla/cargar_vista_previa.php`,
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

            $.ajax({
                type: "POST",
                dataType: "json",
                url: `${params.baseUrl}pantallas/generador/funciones_desplegables.php?pantalla_idpantalla=` +
                    $("#idformato").val() +
                    "&extensiones_permitidas=php&funciones_nucleo=1",
                success: function(html) {
                    if (html) {
                        $("#funciones_desplegables").html(html.codigo_html);
                    }
                }
            });

            /////////////////////////////ACA INICIA EL ARCHIVO DE LA PESTANA 1 ////////////////////////////////////////////////////////////////////////
            $("#serie_idserie").select2();
            $("#tipo_registro").select2();
            $("#contador_idcontador").select2();

            $($("#select2-serie_idserie-container").siblings()[0]).hide();
            $("input[name='when_is_escrow_set_to_close']").hide();
            if ($("#codigo_serie").val() == '') {
                $("#mostrar_tipodoc_pdf").hide();
                $("#texto_tipodoc").hide();
            }
            $('[data-toggle="tooltip"]').tooltip();

            $("#etiqueta_formato").change(function() {
                if (!params.formatId) {
                    if ($(this).val()) {
                        var nombre = normalizar($(this).val());
                        $("#nombre_formato").val(nombre);
                    }
                }
            });
            var descripcion_formato = "<?php echo $descripcionFormato; ?>";
            var formato = <?php echo (json_encode($formato)); ?>;

            var nombre_formato = "";
            if ($("#nombre_formato").val() != "") {
                var nombre_formato = $("#nombre_formato").val();
            }

            $("#tipo_registro").change(function() {
                var valor = $(this).val();
                switch (valor) {
                    case "1":
                        $("#item").val("0");
                        $("#mostrar_pdf").val("1");
                        $(".tipo_edicion").show();
                        $("input[name='paginar']").attr("checked", "checked");
                        $("input[name='mostrar_pdf']").attr("checked", true);
                        break;
                    case "2":
                        $("#item").val("0");
                        $("#mostrar_pdf").val("0");
                        $(".tipo_edicion").hide();
                        $("input[name='paginar']").attr("checked", false);
                        $("input[name='mostrar_pdf']").attr("checked", false);
                        break;
                    case "3":
                        $("#item").val("1");
                        $("#mostrar_pdf").val("0");
                        $(".tipo_edicion").hide();
                        $("input[name='mostrar_pdf']").attr("checked", false);
                        break;
                    default:
                        $("#item").val("0");
                        $("#mostrar_pdf").val("0");
                        $("input[name='paginar']").attr("checked", false);
                        $("input[name='mostrar_pdf']").attr("checked", false);
                        break;
                }
            });

            if (formato !== null && formato.numcampos) {
                $('#nombre_formato').val(formato[0].nombre);
                $('#etiqueta_formato').val(formato[0].etiqueta);
                //$('#tabla_formato').val(formato[0].tabla);
                $('#descripcion_formato').val(descripcion_formato);
                $('#proceso_pertenece').val(formato[0].proceso_pertenece);
                $('#serie_id_serie').val(formato[0].serie_idserie);
                $('#version').val(formato[0].version);
                $('#librerias_formato').val(formato[0].librerias);
                $('#etiqueta_formato').val(formato[0].etiqueta);
                $('#ruta_formato').val(formato[0].ruta_formato);
                $('#ayuda_formato').val(formato[0].ayuda);
                //$('#prefijo_formato').val(formato[0].prefijo);
                $('#ruta_almacenamiento_formato').val(formato[0].ruta_almacenamiento);
                $('#idformato').val(formato[0].idformato);
                $('#tipo_formato_' + formato[0].tipo_formato).attr('checked', "checked");
                $('#versionar_' + formato[0].versionar).attr('checked', "checked");
                $('#accion_eliminar_' + formato[0].accion_eliminar).attr('checked', "checked");
                if (formato[0].tipo_formato == 2) {
                    $("#campos_formato").show();
                }
                $('#aprobacion_automatica_' + formato[0].aprobacion_automatica).attr('checked', "checked");
                $('#tabs_formulario a[href="#datos_formulario-tab"]').tab('show');
                $('#componentes_acciones').hide();
                $('.nav li').removeClass('disabled');

                var item = formato[0].item;
                var mostrar_pdf = formato[0].mostrar_pdf;
                if (item == 0 && mostrar_pdf == 0) {
                    $("#tipo_registro").val(2);
                    $(".tipo_edicion").hide();
                }
                if (item == 0 && mostrar_pdf == 1) {
                    $("#tipo_registro").val(1);
                    $(".tipo_edicion").show();
                }
                if (item == 1 && mostrar_pdf == 0) {
                    $("#tipo_registro").val(3);
                    $(".tipo_edicion").hide();
                }

            } else {
                $('.nav li').addClass('disabled');
                $('#generar_pantalla').addClass('disabled');

                $("#contenidos_componentes").hide();
                $('#tabs_formulario li:first').removeClass('disabled');
                $('#tabs_formulario a[href="#datos_formulario-tab"]').tab('show');
            }

            //tree_arbol_serie_formato.setOnCheckHandler(parsear_serie_formato);

            $("#serie_idserie").change(function() {

                obtenerCodigoSerie();

            });

        });

        function obtenerCodigoSerie() {
            $(".codigoSerie").each(function() {
                if ($(this).val() == $("#serie_idserie").val()) {
                    $("#codigoSerieInput").val($(this).attr("codigo"));
                }
            });
        }

        obtenerCodigoSerie();

        function parsear_serie_formato(nodeId) {
            //console.log(nodeId);
            var datos = tree_arbol_serie_formato.getUserData(nodeId, "serie_codigo");
            //console.log(datos);
            $("#codigo_serie").val(datos);
            if (datos) {
                $("#mostrar_tipodoc_pdf").show();
                $("#texto_tipodoc").show();
            } else {
                $("#mostrar_tipodoc_pdf").hide();
                $("#texto_tipodoc").hide();
            }
        }

        function parsear_items() {
            var nombre_formato = $("#nombre_formato").val();
            if (nombre_formato.indexOf("ft_") == "-1") {
                $("#nombre_formato").val("ft_" + nombre_formato);
            }
            $("#prefijo_formato").val("ft_");
        }
    </script>
</body>

</html>