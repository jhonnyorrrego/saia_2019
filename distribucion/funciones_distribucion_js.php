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

include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");

//echo(librerias_jquery('1.7'));
?>

<script>
    $(document).ready(function () {

        //Mensajero - class= select_mensajeros_ditribucion
        $('.select_mensajeros_ditribucion').live('change', function () {
            var mensajero = $(this).val();
            var iddistribucion = $(this).attr('iddistribucion');
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    mensajero: mensajero,
                    iddistribucion: iddistribucion,
                    ejecutar_accion: 'cambiar_mensajero_distribucion'
                },
                url: '<?php echo($ruta_db_superior); ?>distribucion/ejecutar_acciones_distribucion.php',
                success: function (data) {
                    if (data.exito) {
                        notificacion_saia('Mensajero asignado exitosamente', 'success', '', 4000);
                    } else {
                        notificacion_saia(data.msn, 'error', '', 4000);
                        window.location.reload();
                    }
                }
            });
        });



        //Acción - class= accion_distribucion - select id: opciones_acciones_distribucion
        $('#opciones_acciones_distribucion').live("change", function () {

            var valor = $(this).val();
            if (valor == 'boton_generar_planilla') {
                /*Genera Planilla de Mensajeros*/
                var mensajero_temp = "";
                idruta_dist = new Array();
                var registros_seleccionados = "";
                var mensajero = "";
                var error = 0;
                $('.accion_distribucion').each(function () {
                    var checkbox = $(this);
                    if (checkbox.is(':checked') === true) {
                        var iddistribucion = $(this).val();
                        idruta = $('#idruta_dist_' + iddistribucion).val();
                        if ($.inArray(idruta, idruta_dist) == -1) {
                            idruta_dist.push(idruta);
                        }
                        mensajero = $('#select_mensajeros_ditribucion_' + iddistribucion).val();
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
                } else if (error == 2) {
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
                $('.accion_distribucion').each(function () {
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
                $('.accion_distribucion').each(function () {
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
                $('.accion_distribucion').each(function () {
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
                $('.accion_distribucion').attr('checked', true);
            }
            if (valor == 'quitar_seleccionados_accion_distribucion') {
                $('.accion_distribucion').attr('checked', false);
            }

            //FILTRO TIPO ORIGEN DEL DOCUMENTO
            if (valor == 'filtrar_tipo_origen_externo') { //Entrada
                var tipo_origen = 'filtro_tipo_origen|2';
<?php $componente = $_REQUEST['idbusqueda_componente']; ?>
                var componente = '<?php echo($componente); ?>';
                window.location.href = "<?php echo $ruta_db_superior; ?>pantallas/busquedas/consulta_busqueda_tabla.php?idbusqueda_componente=" + componente + "&variable_busqueda=" + tipo_origen;

            }
            if (valor == 'filtrar_tipo_origen_interno') {  //Salida a externo
                var tipo_origen = 'filtro_tipo_origen|1';
<?php $componente = $_REQUEST['idbusqueda_componente']; ?>
                var componente = '<?php echo($componente); ?>';
                window.location.href = "<?php echo $ruta_db_superior; ?>pantallas/busquedas/consulta_busqueda_tabla.php?idbusqueda_componente=" + componente + "&variable_busqueda=" + tipo_origen;
            }
            if (valor == 'filtrar_tipo_origen_todos') { //Mostrar Todos
                var tipo_origen = 'filtro_tipo_origen|3';
<?php $componente = $_REQUEST['idbusqueda_componente']; ?>
                var componente = '<?php echo($componente); ?>';
                window.location.href = "<?php echo $ruta_db_superior; ?>pantallas/busquedas/consulta_busqueda_tabla.php?idbusqueda_componente=" + componente + "&variable_busqueda=" + tipo_origen;
            }
            //FIN FILTRO TIPO ORIGEN DEL DOCUMENTO


            $(this).val('');
        });  //FIN IF opciones_acciones_distribucion


        //Filtro por mensajero - class= filtro_mensajero_distribucion
        $('#filtro_mensajero_distribucion').live("change", function () {
            var mensajero = 'filtro_mensajero_distribucion|' + $(this).val();
<?php
$componente = $_REQUEST['idbusqueda_componente'];
?>
            var componente = '<?php echo($componente); ?>';
            window.location.href = "<?php echo $ruta_db_superior; ?>pantallas/busquedas/consulta_busqueda_tabla.php?idbusqueda_componente=" + componente + "&variable_busqueda=" + mensajero;

        });	//FIN IF filtro_mensajero_distribucion

        //Filtro por ventanilla - class= filtro_ventanilla_radicacion
        $('#filtro_ventanilla_radicacion').live("change", function () {
            var ventanilla = 'filtro_ventanilla_radicacion|' + $(this).val();
<?php
$componente = $_REQUEST['idbusqueda_componente'];
?>
            var componente = '<?php echo($componente); ?>';
            window.location.href = "<?php echo $ruta_db_superior; ?>pantallas/busquedas/consulta_busqueda_tabla.php?idbusqueda_componente=" + componente + "&variable_busqueda=" + ventanilla;

        });	//FIN IF filtro_ventanilla_radicacion




    });  //FIN IF documento.ready

</script>

<?php
?>