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
include_once $ruta_db_superior . "assets/librerias.php";

function opciones_acciones_distribucion($datos)
{
    

    $cnombre_componente = busca_filtro_tabla("nombre", "busqueda_componente", "idbusqueda_componente=" . $datos['idbusqueda_componente'], "");
    $nombre_componente = $cnombre_componente[0]['nombre'];

    $cadena_acciones = "<select id='opciones_acciones_distribucion' class='pull-left btn btn-xs'>";
    $cadena_acciones .= "<option value=''>Acciones...</option>";

    if ($nombre_componente == 'reporte_distribucion_general_endistribucion' || $nombre_componente == 'reporte_distribucion_general_pordistribuir') {
        $cadena_acciones .= "<option value='boton_generar_planilla'>Generar Planilla</option>";
    }

    if ($nombre_componente == 'reporte_distribucion_general_endistribucion') {
        $cadena_acciones .= "<option value='boton_finalizar_entrega'>Finalizar Tr&aacute;mite</option>";
    }

    if ($nombre_componente == 'reporte_distribucion_general_sinrecogida') {
        $cadena_acciones .= "<option value='boton_confirmar_recepcion_distribucion'>Confirmar Recepcion</option>";
    }
    if ($nombre_componente == 'reporte_planilla_distribucion') {
        $cadena_acciones .= "<option value='boton_confirmar_recepcion_iten_planilla'>Confirmar Recepcion</option>";
    }
    if ($nombre_componente != 'reporte_distribucion_general_finalizado') {
        $cadena_acciones .= "<option value='boton_finalizar_entrega_personal'>Finalizar sin planilla</option>";
    }
    if ($nombre_componente == 'reporte_distribucion_general_endistribucion' || $nombre_componente == 'reporte_distribucion_general_pordistribuir') {
        $cadena_acciones .= "<optgroup id='asignar_mensajero_g' label='Asignar mensajero'>";
        $cadena_acciones .= select_mensajero_distribucion();
        $cadena_acciones .= "</optgroup>";
    }
    $cadena_acciones .= "</select>";

    return $cadena_acciones;
}

function select_mensajero_distribucion()
{
    

    $select = "";
    $array_concat = array(
        "nombres",
        "' '",
        "apellidos"
    );

    $datos = Model::getQueryBuilder()
        ->select(["iddependencia_cargo", "CONCAT(nombres, CONCAT(' ', apellidos)) as nombre"])
        ->from("vfuncionario_dc")
        ->where("lower(cargo)='mensajero'")
        ->andWhere("estado_dc=1")
        ->execute()->fetchAll();

    //if($vector_variable_busqueda[0]=='filtro_mensajero_distribucion' && $vector_variable_busqueda[1]){
    $vector_variable_busqueda = explode('|', @$_REQUEST['variable_busqueda']);
    $vector_mensajero_tipo = explode('-', $vector_variable_busqueda[1]);
    $filtrar_mensajero = @$vector_variable_busqueda[1];

    for ($i = 0, $total = count($datos); $i < $total; $i++) {
        $selected = '';
        if ($vector_variable_busqueda[0] == 'filtro_mensajero_distribucion' && $vector_variable_busqueda[1] && $vector_mensajero_tipo[1] == 'i') {
            if ($filtrar_mensajero) {
                if ($filtrar_mensajero == $datos[$i]['iddependencia_cargo'] . "-i") {
                    $selected = 'selected';
                }
            }
        }
        $select .= "<option class='select_mensajeros_ditribucion' value='" . $datos[$i]['iddependencia_cargo'] . "-i' " . $selected . ">" . $datos[$i]['nombre'] . "&nbsp;-&nbsp;Mensajero</option>";
    }

    $mensajeros_externos = Model::getQueryBuilder()
        ->select(["iddependencia_cargo", "CONCAT(nombres, CONCAT(' ', apellidos)) as nombre"])
        ->from("vfuncionario_dc")
        ->where("lower(cargo) like :cargo")
        ->andWhere("estado_dc=1")
        ->setParameter(':cargo', 'mensajer%extern%')
        ->execute()->fetchAll();

    for ($i = 0, $total = count($mensajeros_externos); $i < $total; $i++) {
        $selected = '';
        if ($vector_variable_busqueda[0] == 'filtro_mensajero_distribucion' && $vector_variable_busqueda[1] && $vector_mensajero_tipo[1] == 'i') {
            if ($filtrar_mensajero) {
                if ($filtrar_mensajero == $mensajeros_externos[$i]['iddependencia_cargo'] . "-i") {
                    $selected = 'selected';
                }
            }
        }
        $select .= "<option class='select_mensajeros_ditribucion' value='" . $mensajeros_externos[$i]['iddependencia_cargo'] . "-i' " . $selected . ">" . $mensajeros_externos[$i]['nombre'] . "&nbsp;-&nbsp;Mensajero Externo</option>";
    }

    $empresas_transportadoras = busca_filtro_tabla("idcf_empresa_trans as id,nombre", "cf_empresa_trans", "estado=1", "");
    for ($i = 0; $i < $empresas_transportadoras['numcampos']; $i++) {
        $selected = '';
        if ($vector_variable_busqueda[0] == 'filtro_mensajero_distribucion' && $vector_variable_busqueda[1] && $vector_mensajero_tipo[1] == 'e') {
            if ($filtrar_mensajero) {
                if ($filtrar_mensajero == $empresas_transportadoras[$i]['id'] . "-e") {
                    $selected = 'selected';
                }
            }
        }
        $select .= "<option class='select_mensajeros_ditribucion' value='" . $empresas_transportadoras[$i]['id'] . "-e' " . $selected . ">" . $empresas_transportadoras[$i]['nombre'] . "&nbsp;-&nbsp;Empresa Transportadora</option>";
    }

    return $select;
}

function opciones_acciones_ruta_distribucion($datos)
{
    $botonAdicionar = '<div class="kenlace_saia" enlace="formatos/ruta_distribucion/adicionar_ruta_distribucion.php" conector="iframe" titulo="Crear ruta"><center><button class="btn btn-secondary"><i class="fa fa-plus"></i><span class="d-sm-inline"> Adicionar</span></button></center></div>';
    return $botonAdicionar;
}

echo select2();
?>

<script>
    $(document).ready(function() {
        $("#opciones_acciones_distribucion").select2();

        //Acción - class= accion_distribucion - select id: opciones_acciones_distribucion
        $("#opciones_acciones_distribucion").on("select2:select", function(e) {
            var valor = e.params.data.id;

            if (valor == 'boton_generar_planilla') {

                registros_seleccionados = top.window.gridSelection();
                if (registros_seleccionados.length == 0) {
                    top.notification({
                        message: "No ha seleccionado alguna distribuci&oacute;n",
                        type: "error",
                        duration: "3500"
                    });
                    return false;
                }

                var idruta_dist = [];
                var mensajeroDistribucion = [];

                try {
                    registros_seleccionados.forEach(function(item, index, array) {

                        idruta = $('#idruta_dist_' + item).val();
                        if ($.inArray(idruta, idruta_dist) == -1) {
                            idruta_dist.push(idruta);
                        }

                        if (!$('#select_mensajeros_ditribucion_' + item).attr('valor')) {
                            top.notification({
                                message: "No es posible generar la planilla debido a que una &oacute; varias distribuciones no tienen mensajero asignado",
                                type: "error",
                                duration: "4500"
                            });
                            throw "error";
                        } else {

                            mensajero = $('#select_mensajeros_ditribucion_' + item).attr('valor');
                            if (mensajeroDistribucion.length != 0) {
                                if (mensajeroDistribucion.indexOf(mensajero) == -1) {
                                    top.notification({
                                        message: "No puede seleccionar distribuciones con diferentes mensajeros",
                                        type: "error",
                                        duration: "3500"
                                    });
                                    throw "error";
                                }
                            } else {
                                mensajeroDistribucion.push(mensajero);
                            }
                        }
                    });
                    $("#opciones_acciones_distribucion").after("<div style='display:none;' id='ir_adicionar_documento' class='link kenlace_saia' enlace='formatos/despacho_ingresados/adicionar_despacho_ingresados.php?idruta_dist=" + idruta_dist.join(",") + "&iddistribucion=" + registros_seleccionados + "&mensajero=" + mensajero + "' conector='iframe' titulo='Generar Planilla Mensajeros'>---</div>");
                    $("#ir_adicionar_documento").trigger("click");
                    $("#ir_adicionar_documento").remove();

                } catch (e) {}
            }

            if (valor == 'boton_finalizar_entrega') {

                var registros_seleccionados = "";
                $("input[name=btSelectItem]").each(function() {
                    var checkbox = $(this);
                    if (checkbox.is(':checked') === true) {
                        var iddistribucion = $(this).val();
                        registros_seleccionados += iddistribucion + ",";
                    }
                });

                registros_seleccionados = registros_seleccionados.substring(0, registros_seleccionados.length - 1);
                if (registros_seleccionados == "") {
                    top.notification({
                        message: "No ha seleccionado ninguna distribuci&oacute;n",
                        type: "warning",
                        duration: "3500"
                    });
                } else {
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: '<?php echo ($ruta_db_superior); ?>app/distribucion/ejecutar_acciones_distribucion.php',
                        data: {
                            iddistribucion: registros_seleccionados,
                            ejecutar_accion: 'finalizar_distribucion'
                        },
                        success: function(datos) {
                            top.notification({
                                message: "Distribuciones finalizadas satisfactoriamente!",
                                type: "success",
                                duration: "3500"
                            });
                            window.location.reload();
                        }
                    });
                }
            } //fin if boton_finalizar_entrega

            if (valor == 'boton_confirmar_recepcion_distribucion') {

                var registros_seleccionados = "";
                $("input[name=btSelectItem]").each(function() {
                    var checkbox = $(this);
                    if (checkbox.is(':checked') === true) {
                        var iddistribucion = $(this).val();
                        registros_seleccionados += iddistribucion + ",";
                    }
                });

                registros_seleccionados = registros_seleccionados.substring(0, registros_seleccionados.length - 1);
                if (registros_seleccionados == "") {
                    top.notification({
                        message: "No ha seleccionado ninguna distribuci&oacute;n",
                        type: "warning",
                        duration: "3500"
                    });
                } else {
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: '<?php echo ($ruta_db_superior); ?>app/distribucion/ejecutar_acciones_distribucion.php',
                        data: {
                            iddistribucion: registros_seleccionados,
                            ejecutar_accion: 'confirmar_recepcion_distribucion'
                        },
                        success: function(datos) {
                            top.notification({
                                message: "Distribuciones confirmadas satisfactoriamente!",
                                type: "success",
                                duration: "3500"
                            });
                            window.location.reload();
                        }
                    });
                }

            } //fin if boton_confirmar_recepcion_distribucion

            if (valor == 'boton_finalizar_entrega_personal') {

                var registros_seleccionados = "";
                $("input[name=btSelectItem]").each(function() {
                    var checkbox = $(this);
                    if (checkbox.is(':checked') === true) {
                        var iddistribucion = $(this).val();
                        registros_seleccionados += iddistribucion + ",";
                    }
                });

                registros_seleccionados = registros_seleccionados.substring(0, registros_seleccionados.length - 1);
                if (registros_seleccionados == "") {
                    top.notification({
                        message: "No ha seleccionado ninguna distribuci&oacute;n",
                        type: "warning",
                        duration: "3500"
                    });
                } else {
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: '<?php echo ($ruta_db_superior); ?>app/distribucion/ejecutar_acciones_distribucion.php',
                        data: {
                            iddistribucion: registros_seleccionados,
                            ejecutar_accion: 'finalizar_entrega_personal'
                        },
                        success: function(datos) {
                            top.notification({
                                message: "Distribuciones Finalizadas satisfactoriamente!",
                                type: "success",
                                duration: "3500"
                            });
                            window.location.reload();
                        }
                    });
                }

            }

            if (valor == 'seleccionar_todos_accion_distribucion') {
                $("input[name=btSelectItem]").attr('checked', true);
            }
            if (valor == 'quitar_seleccionados_accion_distribucion') {
                $("input[name=btSelectItem]").attr('checked', false);
            }


            var elemento = e.params.data.element;
            if ($(elemento).hasClass("select_mensajeros_ditribucion")) {
                var mensajero = $(this).val();
                registros_seleccionados = top.window.gridSelection();
                if (registros_seleccionados.length === 0) {
                    top.notification({
                        message: "No ha seleccionado ninguna distribuci&oacute;n",
                        type: "warning",
                        duration: "3500"
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        dataType: 'json',
                        data: {
                            mensajero: mensajero,
                            iddistribucion: registros_seleccionados,
                            ejecutar_accion: 'cambiar_mensajero_distribucion'
                        },
                        url: '<?php echo ($ruta_db_superior); ?>app/distribucion/ejecutar_acciones_distribucion.php',
                        success: function(data) {
                            if (data.exito) {
                                var seleccionados = $("#table").bootstrapTable("getSelections");
                                seleccionados.forEach(function(valor, indice, array) {
                                    $("#select_mensajeros_ditribucion_" + valor["id"]).html($('[value="' + mensajero + '"]').html());
                                    $("#select_mensajeros_ditribucion_" + valor["id"]).attr('valor', mensajero);
                                });
                                top.notification({
                                    message: 'Mensajero asignado exitosamente',
                                    type: "success",
                                    duration: 4000
                                });
                            } else {
                                top.notification({
                                    message: data.msn,
                                    type: "error",
                                    duration: 4000
                                });
                            }
                        }
                    });
                }

            }
            //FIN FILTRO TIPO ORIGEN DEL DOCUMENTO

            if (valor == 'boton_confirmar_recepcion_iten_planilla') {

                var registros_seleccionados = "";
                $("input[name=btSelectItem]").each(function() {
                    var checkbox = $(this);
                    if (checkbox.is(':checked') === true) {
                        var iditem = $(this).val();
                        registros_seleccionados += iditem + ",";
                    }
                });

                registros_seleccionados = registros_seleccionados.substring(0, registros_seleccionados.length - 1);
                if (registros_seleccionados == "") {
                    top.notification({
                        message: "No ha seleccionado ningun item",
                        type: "warning",
                        duration: "3500"
                    });
                } else {
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: '<?php echo ($ruta_db_superior); ?>app/distribucion/ejecutar_acciones_distribucion.php',
                        data: {
                            ft_item_despacho_ingres: registros_seleccionados,
                            ejecutar_accion: 'confirmar_recepcion_item_planilla'
                        },
                        success: function(datos) {
                            top.notification({
                                message: "Items confirmadas satisfactoriamente!",
                                type: "success",
                                duration: "3500"
                            });
                            window.location.reload();
                        }
                    });
                }
            } //fin if boton_confirmar_recepcion_distribucion
            $(this).val('');
        }); //FIN IF opciones_acciones_distribucion


    }); //FIN IF documento.ready
</script>

<?php
?>