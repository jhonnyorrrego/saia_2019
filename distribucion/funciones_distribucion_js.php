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
    global $conn;

    $cnombre_componente = busca_filtro_tabla("nombre", "busqueda_componente", "idbusqueda_componente=" . $datos['idbusqueda_componente'], "", $conn);
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
    global $conn;

    $select = "";
    $array_concat = array(
        "nombres",
        "' '",
        "apellidos"
    );
    $cadena_concat = concatenar_cadena_sql($array_concat);
    $datos = busca_filtro_tabla("iddependencia_cargo, " . $cadena_concat . " AS nombre", "vfuncionario_dc", "lower(cargo)='mensajero' AND estado_dc=1", "", $conn);

    //if($vector_variable_busqueda[0]=='filtro_mensajero_distribucion' && $vector_variable_busqueda[1]){
    $vector_variable_busqueda = explode('|', @$_REQUEST['variable_busqueda']);
    $vector_mensajero_tipo = explode('-', $vector_variable_busqueda[1]);
    $filtrar_mensajero = @$vector_variable_busqueda[1];

    for ($i = 0; $i < $datos['numcampos']; $i++) {
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

    $mensajeros_externos = busca_filtro_tabla("iddependencia_cargo, " . $cadena_concat . " AS nombre", "vfuncionario_dc", "lower(cargo) LIKE 'mensajer%extern%' AND estado_dc=1", "", $conn);

    for ($i = 0; $i < $mensajeros_externos['numcampos']; $i++) {
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

    $empresas_transportadoras = busca_filtro_tabla("idcf_empresa_trans as id,nombre", "cf_empresa_trans", "estado=1", "", $conn);
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

echo select2();
?>

<script>
    $(document).ready(function() {
        $("#opciones_acciones_distribucion").select2();

        //Acción - class= accion_distribucion - select id: opciones_acciones_distribucion
        $("#opciones_acciones_distribucion").on("select2:select", function(e) {
            //$(document).on('change', '#opciones_acciones_distribucion', function () {
            var valor = e.params.data.id;

            if (valor == 'boton_generar_planilla') {
                /*Genera Planilla de Mensajeros*/
                var mensajero_temp = "";
                idruta_dist = new Array();
                var registros_seleccionados = "";
                var mensajero = "";
                var error = 0;

                $("input[name=btSelectItem]").each(function() {
                    var checkbox = $(this);
                    if (checkbox.is(':checked') === true) {
                        var iddistribucion = $(this).val();
                        idruta = $('#idruta_dist_' + iddistribucion).val();
                        if ($.inArray(idruta, idruta_dist) == -1) {
                            idruta_dist.push(idruta);
                        }
                        mensajero = $('#select_mensajeros_ditribucion_' + iddistribucion).attr('valor');
                        if (!mensajero) {
                            error = 2;
                        }
                        registros_seleccionados += iddistribucion + ",";

                        if (mensajero_temp) {
                            if (mensajero_temp != mensajero) {
                                error = 1;
                            }
                        }
                        mensajero_temp = mensajero;
                    }
                });
                registros_seleccionados = registros_seleccionados.substring(0, registros_seleccionados.length - 1);
                if (registros_seleccionados == "") {
                    top.notification({
                        message: "ATENCI&Oacute;N</b><br>No ha seleccionado ningun campo",
                        type: "warning",
                        duration: "3500"
                    });
                } else if (error == 1) {
                    top.notification({
                        message: "ATENCI&Oacute;N</b><br>No puede seleccionar diferentes mensajeros",
                        type: "warning",
                        duration: "3500"
                    });
                } else if (error != 2) {
                    top.notification({
                        message: "ATENCI&Oacute;N</b><br>No es posible generar la planilla debido a que una &oacute; varias distribuciones no tienen mensajero asignado",
                        type: "warning",
                        duration: "4500"
                    });
                } else {

                    $("#opciones_acciones_distribucion").after("<div style='display:none;' id='ir_adicionar_documento' class='link kenlace_saia' enlace='formatos/despacho_ingresados/adicionar_despacho_ingresados.php?idruta_dist=" + idruta_dist.join(",") + "&iddistribucion=" + registros_seleccionados + "&mensajero=" + mensajero + "' conector='iframe' titulo='Generar Planilla Mensajeros'>---</div>");
                    $("#ir_adicionar_documento").trigger("click");
                    $("#ir_adicionar_documento").remove();
                }
            } //fin if boton_generar_planilla

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
                        url: '<?php echo ($ruta_db_superior); ?>distribucion/ejecutar_acciones_distribucion.php',
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
                        url: '<?php echo ($ruta_db_superior); ?>distribucion/ejecutar_acciones_distribucion.php',
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
                        url: '<?php echo ($ruta_db_superior); ?>distribucion/ejecutar_acciones_distribucion.php',
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
                registros_seleccionados = totalSelection();
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
                        url: '<?php echo ($ruta_db_superior); ?>distribucion/ejecutar_acciones_distribucion.php',
                        success: function(data) {
                            if (data.exito) {
                                var seleccionados = $("#tabla_resultados").bootstrapTable("getSelections");
                                seleccionados.forEach(function(valor, indice, array) {
                                    var dataIndex = $('input[name="btSelectItem"][value="' + valor["llave"] + '"]').attr("data-index");
                                    $("#tabla_resultados").bootstrapTable('updateCell', {
                                        index: dataIndex,
                                        field: 'select_mensajeros_ruta_distribucion',
                                        value: $('[value="' + mensajero + '"]').html()
                                    })
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
                            //window.location.reload();
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
                        url: '<?php echo ($ruta_db_superior); ?>distribucion/ejecutar_acciones_distribucion.php',
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