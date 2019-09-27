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

    $cadena_acciones = "<select id='opciones_acciones_distribucion' class='pull-left btn btn-lg'>";
    $cadena_acciones .= "<option value=''>Acciones...</option>";
    $cadena_acciones .= "<option value=''>Recepcionar </option>";

    if ($nombre_componente == 'reporte_distribucion_general_endistribucion' || $nombre_componente == 'reporte_distribucion_general_pendientes') {
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

    $cadena_acciones .= "<option value='boton_entre_sedes'>Despachar entre sedes</option>";
    $cadena_acciones .= "<option value='boton_finalizar_sin_planilla'>Finalizar sin planilla</option>";

    $cadena_acciones .= "</select>";

    return $cadena_acciones;
}

echo select2();

?>

<script>
    $(document).ready(function() {
        $("#opciones_acciones_distribucion").select2();

        //Acción - class= accion_distribucion - select id: opciones_acciones_distribucion
        $("#opciones_acciones_distribucion").on("select2:select", function(e) {
            var valor = e.params.data.id;
            var seleccionado = false;

            if (valor == 'boton_generar_planilla') {

                registros_seleccionados = top.window.gridSelection();
                if (registros_seleccionados.length == 0) {
                    top.notification({
                        message: "No ha seleccionado alguna distribuci&oacute;n",
                        type: "error",
                        duration: "3500"
                    });

                } else {
                    seleccionado = true;
                }
                if (seleccionado) {
                    var idruta_dist = [];
                    var mensajeroDistribucion = [];

                    try {
                        registros_seleccionados.forEach(function(item, index, array) {
                            idruta_dist.push($('#ruta' + item).val());
                            mensajeroDistribucion.push($('#selMensajeros' + item).val());
                        });

                        var count = 0;
                        idruta_dist.forEach(function(element) {
                            if (count != 0) {
                                if (idruta_dist[count - 1] != idruta_dist[count]) {
                                    top.notification({
                                        message: "No puede seleccionar distribuciones con diferentes rutas",
                                        type: "error",
                                        duration: "3500"
                                    });
                                    throw "error";
                                }
                            }
                            count++;
                        });
                        count = 0;
                        mensajeroDistribucion.forEach(function(element) {
                            if (count != 0) {
                                if (mensajeroDistribucion[count - 1] != mensajeroDistribucion[count]) {
                                    top.notification({
                                        message: "No puede seleccionar distribuciones con diferentes mensajeros",
                                        type: "error",
                                        duration: "3500"
                                    });
                                    throw "error";
                                }
                            }
                            count++;
                        });

                        $("#opciones_acciones_distribucion").after("<div style='display:none;' id='ir_adicionar_documento' class='link kenlace_saia' enlace='formatos/despacho_ingresados/adicionar_despacho_ingresados.php?idruta_dist=" + idruta_dist[0] + "&iddistribucion=" + registros_seleccionados + "&mensajero=" + mensajeroDistribucion[0] + "' conector='iframe' titulo='Generar Planilla Mensajeros'>---</div>");
                        $("#ir_adicionar_documento").trigger("click");
                        $("#ir_adicionar_documento").remove();

                    } catch (e) {}
                }
            } /// Fin boton generar planilla

            ///// Clic en boton finalizar entrega
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
            } ///// Fin boton_finalizar_entrega_personal 

            if (valor == 'seleccionar_todos_accion_distribucion') {
                $("input[name=btSelectItem]").attr('checked', true);
            }
            if (valor == 'quitar_seleccionados_accion_distribucion') {
                $("input[name=btSelectItem]").attr('checked', false);
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

            if (valor == 'boton_entre_sedes') {

                registros_seleccionados = top.window.gridSelection();
                seleccionado = false;

                if (registros_seleccionados.length == 0) {
                    top.notification({
                        message: "No ha seleccionado alguna distribuci&oacute;n",
                        type: "error",
                        duration: "3500"
                    });

                } else {
                    seleccionado = true;
                }

                if (seleccionado) {

                    var count = 0;
                    var registrosSeleccionados = "";
                    registros_seleccionados.forEach(function() {
                        if (count != 0) {
                            registrosSeleccionados = `${registrosSeleccionados},${registros_seleccionados[count]}`;
                        } else {
                            registrosSeleccionados = registros_seleccionados[count];
                        }
                        count++;
                    });

                    top.topModal({
                        url: `views/distribucion/despachar_entre_sedes.php?registros=${registrosSeleccionados}`,
                        size: 'modal-xl',
                        title: 'Despachar entre sedes',
                        buttons: {
                            success: {
                                label: 'Guardar',
                                class: 'btn btn-complete'
                            },
                            cancel: {
                                label: 'Cerrar',
                                class: 'btn btn-danger'
                            }
                        },
                        onSuccess: function() {
                            top.closeTopModal();
                            $("#table").bootstrapTable("refresh");
                            top.notification({
                                message: "Se ha guardado correctamente",
                                type: "success",
                                duration: "3500"
                            });
                        }
                    });
                }
            } // Fin if boton_entre_sedes


            $(this).val('');
        }); //FIN IF opciones_acciones_distribucion

        /**
         *  Listener que cambia las opciones de los mensajeros con su respectiva ruta cada vez que cambia el select de la ruta
         *  Con un ajax llamamos cargar_mensajeros.php que nos retorna los array con el nombre del mensajero (data) y su id (code).
         *  @author Julian Otalvaro Osorio <julian.otalvaro@cerok.com>
         *  @date 2019-09-25 
         */

        $(document).on('change', '.selRuta', function(e) {
            var id = $(this).attr('id');
            id = id.split('ruta').join('');
            var value = $('#ruta' + id).val();

            $.ajax({
                url: '<?= $ruta_db_superior ?>app/distribucion/cargar_mensajeros.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    token: localStorage.getItem('token'),
                    key: localStorage.getItem('key'),
                    ruta: $('#ruta' + id).val()
                },
                success: function(respuesta) {
                    $('#selMensajeros' + id).empty();
                    var totalMensajeros = respuesta.data.length;
                    var count = 0;
                    var mensajeros = JSON.parse(respuesta.data);
                    mensajeros.forEach(function() {
                        $('#selMensajeros' + id).append("<option value=" + mensajeros[count].id + " >" + mensajeros[count].nombre + "</option>");
                        count++;
                    });
                }
            });
        });
        ///////////////////////////////////////////////////////////////////////////////
    }); //FIN IF documento.ready
</script>
<?php

function opciones_acciones_ruta_distribucion()
{
    $botonAdicionar = '<div class="kenlace_saia" enlace="formatos/ruta_distribucion/adicionar_ruta_distribucion.php" conector="iframe" titulo="Crear ruta"><center><button class="btn btn-secondary"><i class="fa fa-plus"></i><span class="d-sm-inline"> Adicionar</span></button></center></div>';
    return $botonAdicionar;
}

?>