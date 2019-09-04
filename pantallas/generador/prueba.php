<html>

<body>


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

    <div class="span3">
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
                <div class="tab-pane" id="archivos-tab">
                    <input type="hidden" name="ruta_archivo_actual" id="ruta_archivo_actual" value="">
                    <div id="esperando_archivo">
                        <img src="<?php echo ($ruta_db_superior); ?>assets/images/cargando.gif">
                    </div>
                    <div id="treeboxbox_tree3" class="arbol_saia"></div>
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
</body>

</html>