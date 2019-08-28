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

include_once($ruta_db_superior."core/autoload.php");
include_once($ruta_db_superior . "librerias_saia.php");
echo(select2());
//echo(librerias_jquery('1.7'));
?>

    <script>
        $(document).ready(function () {
            $("#opciones_acciones_distribucion").select2();

            //Acción - class= accion_distribucion - select id: opciones_acciones_distribucion
            $("#opciones_acciones_distribucion").on("select2:select", function (e) {
                //$(document).on('change', '#opciones_acciones_distribucion', function () {
                var valor = e.params.data.id;

                if (valor == 'boton_generar_planilla') {
                    /*Genera Planilla de Mensajeros*/
                    var mensajero_temp = "";
                    idruta_dist = new Array();
                    var registros_seleccionados = "";
                    var mensajero = "";
                    var error = 0;

                    $("input[name=btSelectItem]").each(function () {
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
                    $("input[name=btSelectItem]").each(function () {
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
                            url: '<?php echo($ruta_db_superior); ?>distribucion/ejecutar_acciones_distribucion.php',
                            data: {
                                iddistribucion: registros_seleccionados,
                                ejecutar_accion: 'finalizar_distribucion'
                            },
                            success: function (datos) {
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
                    $("input[name=btSelectItem]").each(function () {
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
                            url: '<?php echo($ruta_db_superior); ?>distribucion/ejecutar_acciones_distribucion.php',
                            data: {
                                iddistribucion: registros_seleccionados,
                                ejecutar_accion: 'confirmar_recepcion_distribucion'
                            },
                            success: function (datos) {
                                top.notification({
                                    message: "Distribuciones confirmadas satisfactoriamente!",
                                    type: "success",
                                    duration: "3500"
                                });
                                window.location.reload();
                            }
                        });
                    }

                }//fin if boton_confirmar_recepcion_distribucion

                if (valor == 'boton_finalizar_entrega_personal') {

                    var registros_seleccionados = "";
                    $("input[name=btSelectItem]").each(function () {
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
                            url: '<?php echo($ruta_db_superior); ?>distribucion/ejecutar_acciones_distribucion.php',
                            data: {
                                iddistribucion: registros_seleccionados,
                                ejecutar_accion: 'finalizar_entrega_personal'
                            },
                            success: function (datos) {
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
                            url: '<?php echo($ruta_db_superior); ?>distribucion/ejecutar_acciones_distribucion.php',
                            success: function (data) {
                                if (data.exito) {
                                    var seleccionados = $("#tabla_resultados").bootstrapTable("getSelections");
                                    seleccionados.forEach( function(valor, indice, array) {
                                        var dataIndex = $('input[name="btSelectItem"][value="'+valor["llave"]+'"]').attr("data-index");
                                        $("#tabla_resultados").bootstrapTable('updateCell', {index: dataIndex, field: 'select_mensajeros_ruta_distribucion', value: $('[value="'+mensajero+'"]').html()})
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
                    $("input[name=btSelectItem]").each(function () {
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
                            url: '<?php echo($ruta_db_superior); ?>distribucion/ejecutar_acciones_distribucion.php',
                            data: {
                                ft_item_despacho_ingres: registros_seleccionados,
                                ejecutar_accion: 'confirmar_recepcion_item_planilla'
                            },
                            success: function (datos) {
                                top.notification({
                                    message: "Items confirmadas satisfactoriamente!",
                                    type: "success",
                                    duration: "3500"
                                });
                                window.location.reload();
                            }
                        });
                    }
                }//fin if boton_confirmar_recepcion_distribucion
                $(this).val('');
            });  //FIN IF opciones_acciones_distribucion


        });  //FIN IF documento.ready

    </script>

<?php
?>