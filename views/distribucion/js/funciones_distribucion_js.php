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

    if ($nombre_componente == 'reporte_distribucion_general_pendientes') {
        $cadena_acciones .= "<option value='boton_recepcionar'>Recepcionar </option>";
        $cadena_acciones .= "<option value='boton_generar_planilla'>Generar Planilla</option>";
        $cadena_acciones .= "<option value='boton_entre_sedes'>Despachar entre sedes</option>";
        $cadena_acciones .= "<option value='boton_finalizar_sin_planilla'>Finalizar sin planilla</option>";
    }

    if ($nombre_componente == 'reporte_distribucion_general_endistribucion') {
        $cadena_acciones .= "<option value='boton_finalizar_tramite'>Finalizar Tr&aacute;mite</option>";
    }

    if ($nombre_componente == 'reporte_planilla_distribucion') {
        $cadena_acciones .= "<option value='boton_confirmar_recepcion_iten_planilla'>Confirmar Recepcion</option>";
    }

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
            var registros_seleccionados = window.gridSelection();
            var registros = "";
            registros_seleccionados.forEach(function(item) {
                registros += item + ",";
            });
            registros = registros.substring(0, registros.length - 1);


            // Esta opcion se utiliza cuando no requiere recogida o se espera desde otra sede y el documento se encuentra en estado por recepcionar. 
            // cambiando su estado  'por distribuir '

            if (valor == 'boton_recepcionar') {
                if (registros_seleccionados.length == 0) {
                    top.notification({
                        message: "No ha seleccionado ninguna distribución",
                        type: "error",
                        duration: "3500"
                    });
                } else {
                    top.confirm({
                        id: 'question',
                        type: 'error',
                        title: 'Recepcionar',
                        message: '¿Está seguro de recepcionar?',
                        position: 'center',
                        timeout: 0,
                        buttons: [
                            [
                                '<button><b>Si</b></button>',
                                function(instance, toast) {

                                    $.ajax({
                                        type: 'POST',
                                        dataType: 'json',
                                        url: '<?php echo ($ruta_db_superior); ?>app/distribucion/recepcionar.php',
                                        data: {
                                            token: localStorage.getItem('token'),
                                            key: localStorage.getItem('key'),
                                            iddistribucion: registros
                                        },
                                        success: function(datos) {
                                            if (datos.success == 2) {
                                                top.notification({
                                                    message: "Items recepcionados satisfactoriamente!",
                                                    type: "success",
                                                    duration: "3500"
                                                });
                                            }
                                            if (datos.message != '') {
                                                top.notification({
                                                    message: datos.message,
                                                    type: "error",
                                                    duration: "3500"
                                                });
                                            }
                                            window.location.reload();
                                        }
                                    });

                                    instance.hide({
                                            transitionOut: 'fadeOut'
                                        },
                                        toast,
                                        'button'
                                    );
                                },
                                true
                            ],
                            [
                                '<button>NO</button>',
                                function(instance, toast) {
                                    instance.hide({
                                            transitionOut: 'fadeOut'
                                        },
                                        toast,
                                        'button'
                                    );
                                }
                            ]
                        ]
                    });
                }
            } // Fin Recepcionar

            //// Esta  opción se ejecuta cuando se seleccionan los item que se van a despachar  a sus destinos con su respectiva Ruta y mensajero.
            //// En el caso de que el documento requiera recogida se genera planilla para que el mensajero lo recoja

            if (valor == 'boton_generar_planilla') {
                if (registros_seleccionados.length == 0) {
                    top.notification({
                        message: "No ha seleccionado ninguna distribución",
                        type: "error",
                        duration: "3500"
                    });

                } else {
                    seleccionado = true;
                }
                if (seleccionado) {
                    var idruta_dist = [];
                    var mensajeroDistribucion = [];
                    var sede_destino = [];

                    try {

                        // verifica si los items tienen ruta o mensajero asignado para proceder con la generacion de planilla de distribucion
                        registros_seleccionados.forEach(function(item, index, array) {
                            if (($('#selMensajeros' + item).val() != "") && ($('#selMensajeros' + item).val() != null)) {
                                idruta_dist.push($('#ruta' + item).val());
                                mensajeroDistribucion.push($('#selMensajeros' + item).val());
                                // si no hay valor de sede destino el valor por defecto es 0
                                if ($('#sedeDestino' + item).data('idsede') == '') {
                                    sede_destino.push(0);
                                    // Si hay opcion entre sedes, guarda el valor de la sede destino del item.
                                } else {
                                    sede_destino.push($('#sedeDestino' + item).data('idsede'));
                                }

                            } else {
                                top.notification({
                                    message: "Uno de los items no tienen mensajero asignado",
                                    type: "error",
                                    duration: "3500"
                                });
                                throw "error";
                            }
                        });
                        // Compara las rutas si son iguales para generar la planilla, comienza a comparar desde el segundo ciclo porque compara la posicion anterior 
                        // con la actual hasta terminar todos los items de distribucion.
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
                        // Compara los mensajeros si son iguales para generar la planilla, comienza a comparar desde el segundo ciclo porque compara la posicion anterior 
                        // con la actual hasta terminar todos los items de distribucion.
                        count = 0;
                        mensajeroDistribucion.forEach(function(element) {

                            if (count) {
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

                        // Compara si la sede es igual para generar la planilla, comienza a comparar desde el segundo ciclo porque compara la posicion anterior 
                        // con la actual hasta terminar todos los items de distribucion.
                        count = 0;
                        sede_destino.forEach(function(element) {

                            if (count) {
                                if (sede_destino[count - 1] != sede_destino[count]) {
                                    top.notification({
                                        message: "No puede seleccionar distribuciones con diferentes sedes destino",
                                        type: "error",
                                        duration: "3500"
                                    });
                                    throw "error";
                                }
                            }
                            count++;
                        });

                        // cosulta si los items ya se encuentran recepcionados
                        $.ajax({
                            type: 'POST',
                            dataType: 'json',
                            url: '<?= $ruta_db_superior ?>app/distribucion/validar_distribucion.php',
                            data: {
                                token: localStorage.getItem('token'),
                                key: localStorage.getItem('key'),
                                iddistribucion: registros
                            },
                            success: function(datos) {
                                if (datos.data == 2) {
                                    top.notification({
                                        message: "No es posible generar planilla a documentos sin recepcionar",
                                        type: "error",
                                        duration: "3500"
                                    });
                                } else {

                                    //definicion de parametros para ventana kaiten, adicionar planilla_distribucion
                                    let params = $.param({
                                        idruta_dist: idruta_dist[0],
                                        mensajero: mensajeroDistribucion[0],
                                        sede_destino: sede_destino[0]
                                    });
                                    let configuration = {
                                        kConnector: 'iframe',
                                        url: `formatos/despacho_ingresados/adicionar_despacho_ingresados.php?iddistribucion=${registros}&${params}`,
                                        kTitle: "Generar Planilla Mensajero",
                                        kWidth: "100%"
                                    };
                                    //abre la ventana
                                    parent.window.crear_pantalla_busqueda(configuration, true);
                                }
                            }
                        });
                    } catch (e) {}
                }
            } // Fin boton generar planilla

            // Aquí ejecuta la accion entre sedes abriendo la modal para su configuración
            if (valor == 'boton_entre_sedes') {

                seleccionado = false;

                if (registros_seleccionados.length == 0) {
                    top.notification({
                        message: "No ha seleccionado ninguna distribución",
                        type: "error",
                        duration: "3500"
                    });

                } else {
                    seleccionado = true;
                }

                if (seleccionado) {
                    // cosulta si los items ya se encuentran recepcionados
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: '<?= $ruta_db_superior ?>app/distribucion/validar_distribucion.php',
                        data: {
                            token: localStorage.getItem('token'),
                            key: localStorage.getItem('key'),
                            iddistribucion: registros
                        },
                        success: function(datos) {
                            if (datos.data == 2) {
                                top.notification({
                                    message: "No es posible la opción entre sedes a documentos sin recepcionar",
                                    type: "error",
                                    duration: "3500"
                                });
                            } else {
                                top.topModal({
                                    url: `views/distribucion/despachar_entre_sedes.php?registros=${registros}`,
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
                        }
                    });
                }
            } // Fin if boton_entre_sedes

            //Esta función se utiliza cuando requieren terminar el proceso sin generar una planilla en el momento que se en encuentra en estado por distribuir.
            if (valor == 'boton_finalizar_sin_planilla') {

                if (registros_seleccionados.length == 0) {
                    top.notification({
                        message: "No ha seleccionado ninguna distribución",
                        type: "error",
                        duration: "3500"
                    });
                } else {
                    top.confirm({
                        id: 'question',
                        type: 'error',
                        title: 'Finalizar sin planilla!',
                        message: '¿Está seguro de finalizar sin planilla?',
                        position: 'center',
                        timeout: 0,
                        buttons: [
                            [
                                '<button><b>Si</b></button>',
                                function(instance, toast) {
                                    $.ajax({
                                        type: 'POST',
                                        dataType: 'json',
                                        url: '<?php echo ($ruta_db_superior); ?>app/distribucion/finalizar_tramite.php',
                                        data: {
                                            token: localStorage.getItem('token'),
                                            key: localStorage.getItem('key'),
                                            iddistribucion: registros
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

                                    instance.hide({
                                            transitionOut: 'fadeOut'
                                        },
                                        toast,
                                        'button'
                                    );
                                },
                                true
                            ],
                            [
                                '<button>NO</button>',
                                function(instance, toast) {
                                    instance.hide({
                                            transitionOut: 'fadeOut'
                                        },
                                        toast,
                                        'button'
                                    );
                                }
                            ]
                        ]
                    });
                }
            } //  FIN boton_finalizar_sin_planilla

            // Clic en boton finalizar tramite, este se utiliza en el reporte 'En distribución' cuando el mensajero entrega el documento a su destino o en el caso de que 
            // se encuentre en recogida cuando obtiene el documento del lugar o persona de origen.
            if (valor == 'boton_finalizar_tramite') {
                if (registros_seleccionados == "") {
                    top.notification({
                        message: "No ha seleccionado ninguna distribución",
                        type: "error",
                        duration: "3500"
                    });
                } else {
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: '<?php echo ($ruta_db_superior); ?>app/distribucion/finalizar_tramite.php',
                        data: {
                            token: localStorage.getItem('token'),
                            key: localStorage.getItem('key'),
                            iddistribucion: registros
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

            if (valor == 'seleccionar_todos_accion_distribucion') {
                $("input[name=btSelectItem]").attr('checked', true);
            }
            if (valor == 'quitar_seleccionados_accion_distribucion') {
                $("input[name=btSelectItem]").attr('checked', false);
            }

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