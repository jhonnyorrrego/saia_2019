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

include_once($ruta_db_superior . "db.php");
include_once($ruta_db_superior . "formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior . "pantallas/qr/librerias.php");
include_once($ruta_db_superior . "distribucion/funciones_distribucion.php");
include_once $ruta_db_superior . 'controllers/autoload.php';
/* ADICIONAR */

function mostrar_radicado_entrada($idformato, $iddoc)
{
    global $conn;
    $fecha = date('Y-m-d');
    $campo = '<label class="form-control" id="numero_radicado">';
    if ($_REQUEST["iddoc"]) {
        $doc = busca_filtro_tabla("", "documento a", "iddocumento=" . $_REQUEST["iddoc"], "", $conn);
        $campo .= '<b>' . $doc[0]["numero"] . '</b>';
    } else {
        $campo .= $fecha . "-<b>" . muestra_contador("radicacion_entrada") . '</b>-E';
    }
    $campo .= '</label>';

    echo $campo;
}

/* EDITAR */

function datos_editar_radicacion($idformato, $iddoc)
{
    global $conn, $ruta_db_superior;
    $datos = busca_filtro_tabla("", "ft_radicacion_entrada", "documento_iddocumento=" . $_REQUEST['iddoc'], "", $conn);
    if ($datos[0]['tipo_origen'] == 1) {
        ?>
        <script>
            $(document).ready(function () {
                $('#tr_tipo_origen').hide();
                $('#tr_requiere_recogida').hide();
                $('#tr_area_responsable').hide();
                $('#area_responsable').removeClass('required');
                $('#destino').addClass('required');
                $('#tr_tipo_destino').hide();
                $('input:radio[name="tipo_destino"]').filter('[value="2"]').attr('checked', true);
                $('#tr_destino').show();
                $('#tr_copia_a').show();
                $('#tr_persona_natural_dest').hide();
                $('#persona_natural_dest').removeClass('required');
                $('#tr_tipo_mensajeria').hide();
                $('[name="tipo_mensajeria"]').removeClass('required');

                //$('#fecha_oficio_entrada').addClass('required');
                $('#fecha_oficio_entrada').removeClass('required');
                $('#tr_fecha_oficio_entrada').show();
                $('#tr_numero_oficio').show();
                $('#persona_natural').addClass('required');
                $('#tr_persona_natural').show();

                $('#tr_umero_guia').show();
            });
        </script>
        <?php

    } else {
        ?>
        <script>
            $('#tr_tipo_origen').hide();

            $('#tr_area_responsable').show();
            $('#area_responsable').addClass('required');
            $('#tr_tipo_destino').show();

            $('#fecha_oficio_entrada').removeClass('required');
            $('#tr_fecha_oficio_entrada').hide();
            $('#tr_numero_oficio').hide();
            $('#persona_natural').removeClass('required');
            $('#tr_persona_natural').hide();
            //$('#anexos_digitales').parent().parent().hide();
            $('#tr_tipo_mensajeria').show();
            $('[name="tipo_mensajeria"]').addClass('required');

            $('#tr_numero_guia').hide();
        </script>
        <?php

    }
    ?>
    <script>
        $(document).ready(function () {

            $('[name="tipo_destino"]').click(function () {
                var tipo = $(this).val();
                if (tipo == 1) {
                    $('#destino').removeClass('required');
                    $('#tr_destino').hide();
                    $('#tr_copia_a').hide();
                    $('#tr_persona_natural_dest').show();
                    $('#persona_natural_dest').addClass('required');

                } else {
                    $('#destino').addClass('required');
                    $('#tr_destino').show();
                    $('#tr_copia_a').show();
                    $('#tr_persona_natural_dest').hide();
                    $('#persona_natural_dest').removeClass('required');

                }
            });
        });
    </script>
    <?php

}

/* ADICIONAR-EDITAR */

function quitar_descripcion_entrada($idformato, $iddoc)
{
    global $conn;
    ?>
    <script>
        if ($("#descripcion").val() == "Pendiente por llenar datos") {
            $("#descripcion").val("");
        }
        if ($("#persona_natural").val() == "&nbsp;") {
            $("#persona_natural").val("");
        }
        if ($("#destino").val() == "&nbsp;") {
            $("#destino").val("");
        }
        if ($("#copia_a").val() == "&nbsp;") {
            $("#copia_a").val("");
        }
        $('#formulario_formatos').validate({
            ignore: [],
            submitHandler: function (form) {
                var fecha = $("#fecha_oficio_entrada").val().split(" ");
                var f = new Date();
                var dia = f.getDate();
                var mes = (f.getMonth() + 1);
                if (dia < 10) {
                    dia = '0' + dia;
                }
                if (mes < 10) {
                    mes = '0' + mes;
                }
                var fecha2 = f.getFullYear() + "-" + mes + "-" + dia;

                if (fecha[0] > fecha2) {
                    $("#fecha_oficio_entrada").after("<font color='red'>La fecha es mayor a la de hoy</font>");
                    $("#fecha_oficio_entrada").focus();
                    $('#continuar').css('display', 'inherit');
                    $('#continuar').next('input').hide();
                    return false;
                }
                var destinos = $("#destino").val();
                $.post("contar_funcionarios.php", {destino: destinos}, function (respuesta) {
                    if (respuesta == 1) {
                        var confirmacion = confirm("Esta seguro de transferir el documento a los destinos seleccionadas?");
                        if (!confirmacion) {
                            $('#continuar').css('display', 'inherit');
                            $('#continuar').next('input').hide();
                            return false;
                        }
                    }
                    var copia = $("#copia_a").val();
                    $.post("contar_funcionarios.php", {destino: copia}, function (respuesta) {
                        if (respuesta == 1) {
                            var confirmacion = confirm("Esta seguro de transferir el documento con copia a las personas seleccionadas?");
                            if (!confirmacion) {
                                $('#continuar').css('display', 'inherit');
                                $('#continuar').next('input').hide();
                                return false;
                            }
                        }
                        form.submit();
                    });
                });
            }
        });
    </script>
    <?php

}

function serie_documental_radicacion($idformato, $iddoc)
{
    global $conn, $ruta_db_superior;


    $dependencia_maestra = busca_filtro_tabla("iddependencia", "dependencia", "cod_padre=0 OR cod_padre IS NULL", "", $conn);

    $dependencia_actual = busca_filtro_tabla("iddependencia", "vfuncionario_dc", "estado_dep=1 AND estado_dc=1 AND funcionario_codigo=" . usuario_actual("funcionario_codigo"), "", $conn);
    $dependencia_principal = buscar_dependencias_principal($dependencia_actual[0]["iddependencia"]);
    $primeros_hijos = busca_filtro_tabla("iddependencia", "dependencia", "cod_padre=" . $dependencia_principal, "", $conn);

    for ($i = 0; $i < $primeros_hijos['numcampos']; $i++) {
        $arreglo[] = $primeros_hijos[$i]['iddependencia'];
    }
    $cargo = '"' . implode('","', $arreglo) . '"';
    ?>
    <script>
        $(document).ready(function () {
            //tree_serie_idserie.setOnCheckHandler(onNodeSelect_dependencia_serie);
            $('#tr_serie_idserie').hide();
            function onNodeSelect_dependencia_serie(nodeId) {
                tree_serie_idserie.setCheck(tree_serie_idserie.getAllChecked(), 0);
                tree_serie_idserie.setCheck(nodeId, 1);
                var ids = nodeId.split("sub");
                var idserie = ids[1];
                $('#serie_idserie').val(idserie);

            }
            var dependencia_principal = '<?php echo ($dependencia_principal); ?>';
            var cargado = [<?php echo ($cargo); ?>];
            cargado.push(dependencia_principal);

            //tree_destino.setOnCheckHandler(onNodeSelect);
            $("#treebox_destino").fancytree({

                select: function(event, data) {
                    // Display list of selected nodes
                    var selNodes = data.tree.getSelectedNodes();
                    var nodos = [];
                    var padres = [];
                    // convert to title/key array
                    var selKeys = $.map(selNodes, function(node){
                        nodos.push(node.key);
                        padres.push(data.node.getParent().key);
                    });
                    for (var i = 0; i < nodos.length; i++) {
                        onNodeSelect(nodos[i],padres[i]);
                    }
                    $('[name="destino"]').val(nodos.join(","));
                }
            });

            function onNodeSelect(nodeId,parentId) {

                var numeral = nodeId.indexOf("#");
                var padre,dependencia;
                if (numeral >= 0) {
                    padre = parentId.replace("#", "");
                    dependencia = nodeId.replace("#", "");
                } else {

                    dependencia = parentId;
                    padre = $("#treebox_destino").fancytree("getTree").getNodeByKey(dependencia).getParent().key;
                    if (padre == 0) {  //SOLO PARA SU ORGANIZACION
                        padre = '<?php echo ($dependencia_maestra[0]['iddependencia']); ?>';
                    }

                   padre = padre.replace("#", "");
                   dependencia = dependencia.replace("#", "");
                }

                var parametro_adicional = '';
                if (dependencia == '<?php echo ($dependencia_maestra[0]['iddependencia']); ?>') {
                    parametro_adicional = '&carga_partes_dependencia=1';
                }
                /*TODO: Actualizar arbol de expedientes, desarrollo pendiente de andres agudelo
                tree_serie_idserie.setXMLAutoLoading("<?php echo ($ruta_db_superior); ?>test_dependencia_serie.php?tabla=dependencia&mostrar_nodos=dsa&sin_padre_dependencia=1&estado=1&cargar_series=1&carga_partes_serie=1&iddependencia=" + dependencia + parametro_adicional);

                tree_serie_idserie.smartRefreshItem("d" + padre);
                tree_serie_idserie.openItem("d" + padre); //ARBOL: expande nodo hasta el item indicado*/

            }
            $('#tipo_origen1').click(function () {
                var dependencia = $('#dependencia').val();
                tree_serie_idserie.setOnLoadingEnd(obtener_dependencia(dependencia));

                function obtener_dependencia(rol) {
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: "obtener_dependencia.php",
                        data: {
                            iddependencia_cargo: rol
                        },
                        async: false,
                        success: function (datos) {
                            var x = Math.floor((Math.random() * 100000) + 1);
                            cargado.push(datos[1]);
                        }
                    });
                }
            });

        });

    </script>
    <?php

}

function buscar_dependencias_principal($iddependencia){
    global $conn;
    $cod_dep = busca_filtro_tabla("cod_padre", "dependencia", "cod_padre is not null and iddependencia=" . $iddependencia, "",$conn);

    if ($cod_dep['numcampos']) {
        return (buscar_dependencias_principal($cod_dep[0]["cod_padre"]));
    } else {
        return ($iddependencia);
    }
}

function tipo_radicado_radicacion($idformato, $iddoc)
{//en el adicionar
    global $conn, $ruta_db_superior;
    $funcionario_codigo = usuario_actual('funcionario_codigo');
    $cargo = busca_filtro_tabla("iddependencia,iddependencia_cargo", "vfuncionario_dc a", "estado_dc=1 AND a.funcionario_codigo=" . $funcionario_codigo, "", $conn);
    $lista_iddependencia_cargo = implode(',', (extrae_campo($cargo, 'iddependencia_cargo')));
    $dependencia_principal = buscar_dependencias_principal($cargo[0]["iddependencia"]);
    ?>
    <script>
        $(document).ready(function () {
            var dependencia_principal = '<?php echo ($dependencia_principal); ?>';
            tipo_origen($("input:radio[name=tipo_origen]:checked").val());
            tipo_destino($("input:radio[name=tipo_destino]:checked").val());


            $('[name="tipo_origen"]').click(function () {
                tipo_origen($(this).val());
            });

            $('[name="tipo_destino"]').click(function () {
                tipo_destino($(this).val());
            });

            $("[name='requiere_recogida']").change(function () {
                if ($(this).val() == 1) {
                    $("[name='tipo_mensajeria'][value=3]").attr("checked", false);
                    $("[name='tipo_mensajeria'][value=3]").attr("disabled", true);
                } else {
                    $("[name='tipo_mensajeria'][value=3]").attr("disabled", false);
                }
            });
            $("[name='requiere_recogida']:checked").trigger("change");


            <?php
            if (!PermisoController::moduleAccess("permiso_radicacion_externa")) {
                ?>
                    $('#tipo_origen0').attr('disabled',true);
                    $('#tipo_origen1').attr('checked', true);
                    $('#tipo_origen1').click();
                    tipo_origen(2);
                <?php

            }
            ?>
            $("#treebox_area_responsable").fancytree({

                select: function(event, data){
                    var selNodes = data.tree.getSelectedNodes();
                    var selKeys = $.map(selNodes, function(node){
                        refrescar_arbol_tipo_documental_funcionario_responsable(node.key,data.node.getParent().key);
                        $("[name='area_responsable']").val(node.key);
                    });
                }
            });


        });
        function tipo_origen(tipo) {
            if (tipo == 1) {   //EXTERNO
                $('#tr_requiere_recogida').hide();

                $('#tr_empresa_transportado').show();

                $('[name="tipo_radicado"]').val('radicacion_entrada');
                seleccionar_interno_actual(0);
                $('#tr_area_responsable').hide();
                $('#area_responsable').removeClass('required');
                $('#destino').addClass('required');
                $('#tr_tipo_destino').hide();
                $('input:radio[name="tipo_destino"]').filter('[value="2"]').attr('checked', true);
                $('#tr_destino').show();
                $('#tr_copia_a').show();
                $('#tr_persona_natural_dest').hide();
                $('#persona_natural_dest').removeClass('required');
                $('#tr_tipo_mensajeria').hide();
                $('[name="tipo_mensajeria"]').removeClass('required');

                //$('#fecha_oficio_entrada').addClass('required');
                $('#fecha_oficio_entrada').removeClass('required');
                $('#tr_fecha_oficio_entrada').show();
                $('#tr_numero_oficio').show();
                $('#persona_natural').addClass('required');
                $('#tr_persona_natural').show();
                //$('#anexos_digitales').parent().parent().show();
                $('#tr_numero_guia').show();

            } else { //INTERNO
                $('#tr_requiere_recogida').show();

                $('#tr_empresa_transportado').hide();

                seleccionar_interno_actual(1);

                $('[name="tipo_radicado"]').val('radicacion_salida');
                $('#tr_area_responsable').show();
                $('#area_responsable').addClass('required');
                $('#tr_tipo_destino').show();

                $('#fecha_oficio_entrada').removeClass('required');
                $('#tr_fecha_oficio_entrada').hide();
                $('#tr_numero_oficio').hide();
                $('#persona_natural').removeClass('required');
                $('#tr_persona_natural').hide();
                //$('#anexos_digitales').parent().parent().hide();
                $('#tr_tipo_mensajeria').show();
                $('[name="tipo_mensajeria"]').addClass('required');

                $('#tr_numero_guia').hide();
            }
            $.ajax({
                type: 'POST',
                dataType: 'json',
                async: false,
                url: "tipo_contador.php",
                data: {
                    tipo_radicacion: tipo
                },
                success: function (datos) {
                    $('#numero_radicado').html(datos[0]);
                }
            });
        }
        function tipo_destino(tipo) {
            if (tipo == 1) {
                $('#destino').removeClass('required');
                $('#tr_destino').hide();
                $('#tr_copia_a').hide();
                $('#tr_persona_natural_dest').show();
                $('#persona_natural_dest').addClass('required');
                //$('#tipo_mensajeria0').parent().show();


                refrescar_arbol_tipo_documental_funcionario_responsable();

            } else {
                $('#destino').addClass('required');
                $('#tr_destino').show();
                $('#tr_copia_a').show();
                $('#tr_persona_natural_dest').hide();
                $('#persona_natural_dest').removeClass('required');
                //$('#tipo_mensajeria0').parent().hide();


            }
        }

        function refrescar_arbol_tipo_documental_funcionario_responsable(nodeId, parentId) {
            <?php
            $dependencia_maestra = busca_filtro_tabla("iddependencia", "dependencia", "cod_padre=0 OR cod_padre IS NULL", "", $conn);
            ?>
            var dependencia,padre;
            if ($("input:radio[name=tipo_origen]:checked").val() == 2 && $("input:radio[name=tipo_destino]:checked").val() == 1) {
                if (nodeId) {
                    dependencia = parentId;
                    padre = $("#treebox_area_responsable").fancytree("getTree").getNodeByKey(dependencia).getParent().key;
                    if (padre == 0) {  //SOLO PARA SU ORGANIZACION
                        padre = '<?php echo ($dependencia_maestra[0]['iddependencia']); ?>';
                    }

                    padre = padre.replace("#", "");
                    dependencia = dependencia.replace("#", "");

                    var parametro_adicional = '';
                    if (dependencia == '<?php echo ($dependencia_maestra[0]['iddependencia']); ?>') {
                        parametro_adicional = '&carga_partes_dependencia=1';
                    }

                    tree_serie_idserie.setXMLAutoLoading("<?php echo ($ruta_db_superior); ?>test_dependencia_serie.php?tabla=dependencia&mostrar_nodos=dsa&sin_padre_dependencia=1&estado=1&cargar_series=1&carga_partes_serie=1&iddependencia=" + dependencia + parametro_adicional);
                    tree_serie_idserie.smartRefreshItem("d" + padre);
                    tree_serie_idserie.openItem("d" + padre); //ARBOL: expande nodo hasta el item indicado
                }
            }

        }

        function seleccionar_interno_actual(seleccionar) {
            if (seleccionar) {
                seleccion_reponsable_actual();
                //tree_area_responsable.setOnLoadingEnd(seleccion_reponsable_actual);
            } else {
                //tree_area_responsable.setCheck(tree_area_responsable.getAllChecked(), false);
                $("#treebox_area_responsable").fancytree("getTree").expandAll(false);
                //tree_area_responsable.closeAllItems(); //ARBOL: cierra todo el arbol

            }
        }


        function seleccion_reponsable_actual() {
            var lista_iddependencia_cargo = '<?php echo ($lista_iddependencia_cargo); ?>';
            var vector_iddependencia_cargo = lista_iddependencia_cargo.split(',');

            expandNode($("#treebox_area_responsable").fancytree("getRootNode"),2);
            $("#treebox_area_responsable").fancytree("getTree").getNodeByKey(vector_iddependencia_cargo[0]).setSelected(true);
        }
        function expandNode(node, depth) {
            // Expand this node
            node.setExpanded(true);
            // Reduce the depth count
            depth--;
            // If we need to go deeper
            if (depth > 0) {
                for (var i = 0; i < node.children.length; i++) {
                    // Go recursive on child nodes
                    expandNode(node.children[i], depth);
                }
            }
        }
    </script>
    <?php

}

/* MOSTRAR */

function llenar_datos_funcion($idformato, $iddoc)
{
    global $conn, $datos;
    $datos = busca_filtro_tabla("ft.*,d.estado,d.tipo_radicado", "ft_radicacion_entrada ft,documento d", "d.iddocumento=ft.documento_iddocumento and d.iddocumento=" . $iddoc, "", $conn);
    if ($datos[0]["estado"] == 'INICIADO') {
        $sql = "UPDATE ft_radicacion_entrada SET tipo_origen=" . $datos[0]['tipo_radicado'] . " WHERE documento_iddocumento=" . $iddoc;
        phpmkr_query($sql);
        $texto = '<br><br><button class="btn btn-mini btn-warning" onclick="window.location=\'editar_radicacion_entrada.php?iddoc=' . $iddoc . '&idformato=' . $idformato . '\';">Llenar datos</button>';
        echo $texto;
    }
}

function mostrar_informacion_general_radicacion($idformato, $iddoc)
{
    global $conn, $ruta_db_superior;

    $datos = busca_filtro_tabla("serie_idserie,descripcion,descripcion_anexos,descripcion_general,tipo_origen,numero_oficio," . fecha_db_obtener("fecha_oficio_entrada", "Y-m-d") . " AS fecha_oficio_entrada," . fecha_db_obtener("fecha_radicacion_entrada", "Y-m-d") . " AS fecha_radicacion_entrada,numero_guia,empresa_transportado,requiere_recogida,tipo_mensajeria", "ft_radicacion_entrada", "documento_iddocumento=" . $iddoc, "", $conn);
    $documento = busca_filtro_tabla("numero,tipo_radicado," . fecha_db_obtener("fecha", "Y-m-d") . " AS fecha", "documento", "iddocumento=" . $iddoc, "", $conn);
    if ($documento[0]['tipo_radicado'] == 1) {
        $tipo = "E";
    } else {
        $tipo = "I";
    }
    if ($datos["numcampos"]) {
        $numero_radicado = $datos[0]['fecha_radicacion_entrada'] . "-" . $documento[0]['numero'] . "-" . $tipo;
    }
    if (!empty($datos[0]["serie_idserie"])) {
        $tipo_documento = busca_filtro_tabla("nombre", "serie", "idserie=" . $datos[0]["serie_idserie"], "", $conn);
    }
    $anexos = busca_filtro_tabla("etiqueta", "anexos", "documento_iddocumento=" . $iddoc, "", $conn);
    $nombre_anexos = '';
    $fecha_radicacion = $documento[0]['fecha'];

    for ($i = 0; $i < $anexos['numcampos']; $i++) {
        $nombre_anexos .= $anexos[$i]['etiqueta'];
        if ($i < $anexos['numcampos'] - 1) {
            $nombre_anexos .= ', ';
        }
    }

    $img = mostrar_codigo_qr($idformato, $iddoc, true);
    $tabla = '<style>
        .table.table-condensed thead tr td {
        padding-top: 2px;
        padding-bottom: 2px;            
    }
    .table.table-condensed {
        table-layout: auto;
    }

    </style>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed" style="width: 100%; text-align:left;margin-bottom: 5%;" border="0" cellspacing="0">
                    <thead>
                        <tr>
                            <td style="border:none;"><b>FECHA DE RADICACI&Oacute;N: </b> ' . $fecha_radicacion . '<br><b>TIPO DE DOCUMENTO:</b> ' . $tipo_documento[0]["nombre"] . '<br><b>ASUNTO:</b> ' . $datos[0]["descripcion"] . '</td>
                            <td style="text-align:center;border:none;" colspan="2" rowspan="3"><p style="text-align:center;">' . $img . '</p><b style="text-align:center;">REGISTRO No. : ' . $numero_radicado . '</b></td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed" style="width: 100%;margin-top: 2%;margin-bottom: 2%;" border="0" cellspacing="0">
                <thead>';
    if ($datos[0]['tipo_origen'] == 1) {
        $empresa_transportadora = mostrar_valor_campo('empresa_transportado', $idformato, $iddoc, 1);
        $tabla .= "<tr>
                        <td class='pr-0' style='border:none;width: 19%;'><strong>TIPO DE ORIGEN:</strong></td>
                        <td style='border:none;width: 18%;'>" . mostrar_valor_campo('tipo_origen', $idformato, $iddoc, 1) . "</td>
                        <td style='border:none;width: 23%;'><strong>N&Uacute;MERO DE GU&Iacute;A:</strong></td>
                        <td style='border:none;'>" . $datos[0]['numero_guia'] . "</td>
                </tr>
                    <tr>
                        <td style='border:none;'><strong>NO. OFICIO:</strong></td>
                        <td style='border:none;'>" . $datos[0]['numero_oficio'] . "</td>
                        <td style='border:none;width: 22%;' ><strong>EMPRESA TRANSPORTADORA:</strong></td>
                        <td px-0 style='border:none;'>" . $empresa_transportadora . "</td>
                        
                </tr>
                <tr>
                    <td style='border:none;'><strong>FECHA DEL DOCUMENTO:</strong></td>
                    <td style='border:none;'>" . $datos[0]['fecha_oficio_entrada'] . "</td>
                    <td style='border:none;'><strong>ANEXOS F&Iacute;SICOS:</strong></td>
                    <td style='border:none;'>" . $datos[0]['descripcion_anexos'] . "</td>
                    
                </tr>";
    } else {
        $recogida = ($datos[0]["requiere_recogida"] == 1) ? "Si" : "No";
        $entrega = ($datos[0]["tipo_mensajeria"] == 1) ? "Si" : "No";
        $tabla .= "
                            <tr>
                            <td class='pr-0' style='border:none;width: 23%;'><strong>TIPO DE ORIGEN:</strong></td>
                            <td style='border:none;width: 23%;'>" . mostrar_valor_campo('tipo_origen', $idformato, $iddoc, 1) . "</td>
                            <td style='border:none;width: 23%;'><strong>REQUIERE SERVICIO DE RECOGIDA?:</strong></td>
                            <td style='border:none;'>" . $recogida . "</td>
                        </tr>
                        <tr>
                            <td style='border:none;'><strong>REQUIERE SERVICIO DE ENTREGA?:</strong></td>
                            <td style='border:none;'>" . $entrega . "</td>
                            <td style='border:none;'><strong>ANEXOS F&Iacute;SICOS:</strong></td>
                            <td style='border:none;'>" . $datos[0]['descripcion_anexos'] . "</td>      
                        </tr>";

    }

    $tabla .= '
                    <tr>
                        <td style="border:none;"><b>ANEXOS DIGITALES:</b></td>
                        <td style="border:none;" colspan="2">' . $nombre_anexos . '</td>
                    
                    </tr>';
    $tabla .= '</div></div></thead></table></div></div>';
    echo $tabla;
}

function obtener_informacion_proveedor($idformato, $iddoc)
{
    global $conn, $datos;
    if ($datos[0]['tipo_origen'] == 1 && $datos[0]["persona_natural"]) {
        $info = busca_filtro_tabla("", "datos_ejecutor B, ejecutor C", "B.ejecutor_idejecutor=C.idejecutor AND B.iddatos_ejecutor=" . $datos[0]["persona_natural"], "", $conn);
        if ($info["numcampos"]) {
            $texto = array();
            $texto[] = "<b>Nombre:</b> " . $info[0]["nombre"];
            $texto[] = "<b>Identificaci&oacute;n:</b> " . $info[0]["identificacion"];
            if ($info[0]["cargo"]) {
                $texto[] = "<b>Cargo:</b> " . $info[0]["cargo"];
            }
            if ($info[0]["empresa"]) {
                $texto[] = "<b>Empresa:</b>" . $info[0]["empresa"];
            }
            echo implode(", &nbsp;", $texto);
        }
    } else {
        $array_concat = array(
            "nombres",
            "' '",
            "apellidos"
        );
        $cadena_concat = concatenar_cadena_sql($array_concat);
        if ($datos[0]['area_responsable']) {
            $origen = busca_filtro_tabla($cadena_concat . " AS nombre, dependencia, cargo", "vfuncionario_dc", "iddependencia_cargo IN(" . $datos[0]['area_responsable'] . ")", "", $conn);
            if ($origen["numcampos"]) {
                $texto = array();
                $texto[] = "<b>Nombre:</b> " . $origen[0]["nombre"];
                $texto[] = "<b>Dependencia:</b> " . $origen[0]["dependencia"];
                $texto[] = "<b>Cargo:</b> " . $origen[0]["cargo"];
                echo implode("<br />", $texto);
            }
        }
    }
}

function mostrar_item_destino_radicacion($idformato, $iddoc)
{
    global $conn;
    echo mostrar_listado_distribucion_documento($idformato, $iddoc, 1);
}

function mostrar_copia_electronica($idformato, $iddoc)
{
    global $conn, $datos;
    $tabla = "";
    if ($datos[0]['tipo_destino'] == 2) {//INTERNO
        $info = mostrar_valor_campo('copia_a', $idformato, $iddoc, 1);
        if ($info) {
            $tabla = '<style>
        .table.table-condensed thead tr td {
        padding-top: 2px;
        padding-bottom: 2px;            
    }
    .table.table-condensed {
        table-layout: auto;
    }

    </style>';
            $tabla .= '<div class="row px-2">
            <div class="col-md-12"><table class="table table-condensed" style="width: 100%; text-align:left;" border="0" cellspacing="0"><thead>';
            $tabla .= '<tr><td style="border:none;width: 100%;"><b>Copia Electr&oacute;nica a:&nbsp;&nbsp;&nbsp;</b>' . $info . '</td></tr>';
            $tabla .= '</thead></table></div></div>';
        }
    }
    echo $tabla;
}

/* POSTERIOR EDITAR */

function cambiar_estado($idformato, $iddoc)
{
    global $conn;
    $doc = busca_filtro_tabla("estado", "documento A", "iddocumento=" . $iddoc, "", $conn);
    if ($doc[0]["estado"] == 'INICIADO') {
        $sql1 = "UPDATE documento SET estado='APROBADO' WHERE iddocumento=" . $iddoc;
        phpmkr_query($sql1);
        post_aprobar_rad_entrada($idformato, $iddoc);
    }
}

/* POSTERIOR APROBAR */

function post_aprobar_rad_entrada($idformato, $iddoc)
{
    global $conn, $ruta_db_superior;

    if ($_REQUEST["radicacion_rapida"] == 1) {
        $sql1 = "UPDATE documento SET estado='INICIADO' WHERE iddocumento=" . $iddoc;
        phpmkr_query($sql1);
    } else {
        ingresar_item_destino_radicacion($idformato, $iddoc);
        actualizar_campos_documento($idformato, $iddoc);
        actualizar_datos_documento($idformato, $iddoc);

        $datos = busca_filtro_tabla("d.estado,ft.tipo_mensajeria,ft.idft_radicacion_entrada,ft.destino,ft.tipo_origen,ft.tipo_destino,ft.descripcion", "ft_radicacion_entrada ft,documento d", "ft.documento_iddocumento=d.iddocumento and d.iddocumento=" . $iddoc, "", $conn);
        if ($datos[0]['tipo_destino'] == 2) {//INTERNO
            transferencia_automatica($idformato, $iddoc, "destino", 2);
        }
        transferencia_automatica($idformato, $iddoc, "copia_a", 2, '', 'COPIA');
        $sql1 = "UPDATE ft_radicacion_entrada SET despachado=1 WHERE documento_iddocumento=" . $iddoc;
        phpmkr_query($sql1);

        if ($datos[0]['tipo_mensajeria'] == 3) {// Entrega Personal/Medios Propios
            $tipo_destino = busca_filtro_tabla("tipo_destino,destino", "distribucion", "documento_iddocumento=" . $iddoc, "", $conn);
            for ($i = 0; $i < $tipo_destino['numcampos']; $i++) {
                if ($tipo_destino[$i]['tipo_destino'] == 1) {
                    transferencia_automatica($idformato, $iddoc, $tipo_destino[$i]['destino'], 1);
                }
            }
        }

        if ($_REQUEST["digitalizacion"] == 1) {
            $enlace = "paginaadd.php?key=" . $iddoc . "&enlace2=views/documento/index_acordeon.php?documentId=" . $iddoc;
            abrir_url($ruta_db_superior . "colilla.php?target=_self&colilla_vertical=" . $_REQUEST['colilla'] . "&key=" . $iddoc . "&enlace=" . $enlace, "_self");
            die();
        } else if ($_REQUEST["digitalizacion"] == 0) {
            $enlace = "views/documento/index_acordeon.php?documentId=" . $iddoc;
            abrir_url($ruta_db_superior . "colilla.php?target=_self&key=" . $iddoc . "&colilla_vertical=" . $_REQUEST['colilla'] . "&enlace=" . $enlace, '_self');
            die();
        }
    }
}

function ingresar_item_destino_radicacion($idformato, $iddoc)
{//posterior al adicionar - editar
    global $conn, $ruta_db_superior;
    $datos = busca_filtro_tabla("a.tipo_origen,a.tipo_destino,a.tipo_mensajeria,a.requiere_recogida", "ft_radicacion_entrada a, documento b", " lower(b.estado)<>'iniciado' AND a.documento_iddocumento=b.iddocumento AND  a.documento_iddocumento=" . $iddoc, "", $conn);
    //area_responsable --->  origen
    //persona_natural ---> origen_externo
    //destino ---> destino
    //persona_natural_dest ---> destino_externo
    if ($datos['numcampos']) {
        $estado_distribucion = 1;
        if ($datos[0]['tipo_mensajeria'] == 3) {
            $estado_distribucion = 3;
        }

        if ($datos[0]['tipo_origen'] == 2 && $datos[0]['tipo_destino'] == 2) {//INT - INT
            if ($datos[0]['tipo_mensajeria'] != 3 && !$datos[0]['requiere_recogida']) {//no quiere recogida
                pre_ingresar_distribucion($iddoc, 'area_responsable', 1, 'destino', 1, 0, 1);
                //INT -INT
            } else {
                pre_ingresar_distribucion($iddoc, 'area_responsable', 1, 'destino', 1, $estado_distribucion);
                //INT -INT
            }
        }

        if ($datos[0]['tipo_origen'] == 2 && $datos[0]['tipo_destino'] == 1) {//INT - EXT
            if ($datos[0]['tipo_mensajeria'] != 3 && !$datos[0]['requiere_recogida']) {//no quiere recogida
                pre_ingresar_distribucion($iddoc, 'area_responsable', 1, 'persona_natural_dest', 2, 0, 1);
                //INT -EXT
            } else {
                pre_ingresar_distribucion($iddoc, 'area_responsable', 1, 'persona_natural_dest', 2, $estado_distribucion);
                //INT -EXT
            }
        }
        if ($datos[0]['tipo_origen'] == 1 && $datos[0]['tipo_destino'] == 2) {//EXT - INT
            pre_ingresar_distribucion($iddoc, 'persona_natural', 2, 'destino', 1, $estado_distribucion);
        }
    }
    return;
}

function actualizar_campos_documento($idformato, $iddoc)
{
    global $conn;
    $datos = busca_filtro_tabla("persona_natural,numero_oficio,numero_oficio,descripcion_anexos,fecha_oficio_entrada", "ft_radicacion_entrada A", "A.documento_iddocumento=" . $iddoc, "", $conn);
    if ($datos["numcampos"]) {
        $campo_formato = busca_filtro_tabla("A.valor", "campos_formato A", "A.formato_idformato=" . $idformato . " AND A.nombre='descripcion_anexos'", "", $conn);
        $valores = array();
        if ($campo_formato["numcampos"]) {
            $filas = explode(";", $campo_formato[0]["valor"]);
            $cant1 = count($filas);
            for ($i = 0; $i < $cant1; $i++) {
                $datos2 = explode(",", $filas[$i]);
                $valores[$datos2[0]] = $datos2[1];
            }
        }
        if ($datos[0]["persona_natural"]) {
            $ejecutor = busca_filtro_tabla("ciudad", "datos_ejecutor A, ejecutor B", "A.ejecutor_idejecutor=B.idejecutor AND iddatos_ejecutor=" . $datos[0]["persona_natural"], "", $conn);
        }
        $sql1 = "UPDATE documento SET oficio='" . $datos[0]["numero_oficio"] . "', anexo='" . $valores[$datos[0]["descripcion_anexos"]] . "', descripcion_anexo='" . $datos[0]["descripcion_anexos"] . "', fecha_oficio=" . fecha_db_almacenar($datos[0]["fecha_oficio_entrada"], 'Y-m-d H:i:s') . ", municipio_idmunicipio='" . $ejecutor[0]["ciudad"] . "' WHERE iddocumento=" . $iddoc;
        phpmkr_query($sql1);
    }
    return;
}
?>
