<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'assets/librerias.php';

include_once $ruta_db_superior . 'librerias_saia.php';
include_once $ruta_db_superior . 'controllers/autoload.php';
require_once ($ruta_db_superior . "arboles/crear_arbol_ft.php");

//$opciones_arbol = array("keyboard" => true, "onNodeClick" => "evento_click", "busqueda_item" => 1);
$opciones_arbol = array("keyboard" => true, "selectMode" => 2);
$extensiones = array("filter" => array());

$idflujo = null;
$idnotificacion = null;

$notificacion = null;
if (isset($_REQUEST["idnotificacion"])) {
    $idnotificacion = $_REQUEST["idnotificacion"];
    $notificacion = new Notificacion($idnotificacion);
} else {
    $notificacion = new Notificacion();
}
if (isset($_REQUEST["idflujo"])) {
    $idflujo = $_REQUEST["idflujo"];
    $notificacion->fk_flujo = $idflujo;
    $eventos = EventoNotificacion::findAll('', 0, true);
    $tipoTarea = TipoElemento::findByBpmnName(TipoElemento::TIPO_TAREA);
    $actividades = Elemento::findAllByAttributes(["fk_flujo" => $idflujo, "fk_tipo_elemento" => $tipoTarea->getPk()]);
    $formatoFlujo = FormatoFlujo::conFkFlujo($idflujo);
    $formatos = $formatoFlujo->findFormatosByFlujo();
    $listaIdsFmt = [];
    foreach ($formatos as $fila) {
        $listaIdsFmt[] = $fila["idformato"];
    }

    $origenFormatos = array("url" => "arboles/arbol_formatos.php", "ruta_db_superior" => $ruta_db_superior,
        "params" => array(
            "seleccionable" => "checkbox",
            "obligatorio" => 1,
            "filtrar" => implode(",", $listaIdsFmt)
    ));
    $origenCampos = array("url" => "arboles/arbol_formatos_campos.php", "ruta_db_superior" => $ruta_db_superior,
        "params" => array(
            "obligatorio" => 1,
            "filtrar" => implode(",", $listaIdsFmt)
    ));

    if (!empty($idnotificacion)) {
        $lista_formatos = obtenerListaFormatos($idnotificacion);
        if (!empty($lista_formatos)) {
            $origenFormatos["params"]["seleccionados"] = implode(",", $lista_formatos);
        }
    }
    $arbolFormato = new ArbolFt("formato_notificacion", $origenFormatos, $opciones_arbol, $extensiones);
    $arbolCampos = new ArbolFt("campos_formato_notificacion", $origenCampos, ["keyboard" => true, "selectMode" => 2, "onNodeClick" => "seleccionarCampo"], $extensiones);
}
if (empty($idflujo)) {
    die("No se encontro parametro idflujo");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <meta name="description" content="">

        <?= jquery() ?>
        <?= validate() ?>
        <?= bootstrap() ?>
        <?= icons() ?>
        <?= theme() ?>
        <?= librerias_UI("1.12") ?>
        <?= librerias_tabla_bootstrap("1.13", false, false) ?>
        <?= librerias_arboles_ft("2.24") ?>
        <?= dropzone() ?>

        <script type="text/javascript" src="js/notificaciones.js" ></script>

    </head>
    <body>

        <div class="container">
             <form id="notificationForm">
                <input type="hidden" id="form_uuid_notif" value="<?= uniqid() ?>">
                <input type="hidden" name="idnotificacion" id="idnotificacion" value="<?= $idnotificacion ?>">
                <fieldset>
                    <legend>Definiendo las notificaciones</legend>
                    <div class="row mb-2">
                        <div class="col col-md-12">
                            <div class="form-group">
                                <label for="sel_tipo_notificacion">Seleccione en que momento se enviar&aacute; la notificaci&oacute;n *</label>
                                <select class="form-control" name="idevento_notificacion" id="sel_tipo_notificacion" required value="<?= $notificacion->fk_evento_notificacion ?>">
                                    <option value="0">Por favor seleccione...</option>
                                    <?php
                                    if (!empty($eventos)) {
                                        foreach ($eventos as $evento) {
                                            $seleccionado = "";
                                            if ($notificacion->fk_evento_notificacion == $evento["idevento_notificacion"]) {
                                                $seleccionado = 'selected="selected"';
                                            }
                                            echo '<option value="' . $evento["idevento_notificacion"] . '" ' . $seleccionado . '>' . $evento["evento"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2 tipo_opcion tipo_opcion_1" style="display: none;">
                        <div class="col col-md-12">
                            <div class="form-group">
                                <label for="sel_actividad_evento">Elija el cambio de estado</label>
                                <select class="form-control" name="actividad_evento" id="sel_actividad_evento">
                                    <option value="0">Por favor seleccione...</option>
                                    <?php
                                    if (!empty($actividades)) {
                                        foreach ($actividades as $tarea) {
                                            echo '<option value="' . $tarea->getPk() . '">' . $tarea->nombre . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2 tipo_opcion tipo_opcion_2" style="display: none;">
                        <div class="col col-md-12">
                            <div class="form-group">
                            <label for="sel_formato_evento">Elija el formato asociado</label>
                                <select class="form-control" name="formato_evento" id="sel_formato_evento" value="<?= $notificacion->fk_formato_flujo ?>">
                                    <option value="0">Por favor seleccione...</option>
                                    <?php
                                    if (!empty($formatos)) {
                                        foreach ($formatos as $formato) {
                                            echo '<option value="' . $formato["idformato"] . '">' . $formato["etiqueta"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                   </div>
                    <!-- <div class="tipo_opcion tipo_opcion_3" style="display: none;">
                        <label>Elija el formato asociado</label>
                    </div> -->
                    <div class="row mb-2">
                        <div class="col col-md-12">
                            <div class="form-group form-group-default">
                                <label for="asunto_notificacion">Asunto del email *</label>
                                <input class="form-control" type="text" id="asunto_notificacion" name="asunto" required value="<?= $notificacion->asunto ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-7">
                            <div class="form-group form-group-default">
                                <label for="mensaje_notificacion">Mensaje *</label>
                                <textarea class="form-control" id="mensaje_notificacion" name="mensaje" required rows="10"  style="height:100%;"><?= $notificacion->cuerpo ?></textarea>
                            </div>
                        </div>
                        <div class="col col-md-5" style="height:200px; overflow: auto;">
                            <label for="campos_formato_notificacion">Etiquetas automáticas de email</label>
                            <?php
                            if (!empty($listaIdsFmt)) {
                                echo $arbolCampos->generar_html();
                            } else {
                                echo 'No ha seleccionado formatos para el proceso';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col col-md-3">
                            <input type="hidden" id="anexos_notificacion" name="anexos_notificacion" value="">
                            <label for="dropzone">Adjuntar anexos preestablecidos que se enviar&aacute;n en cada notificaci&oacute;n</label>
                        </div>

                        <div class="col col-md-9">
                            <div id="dropzone" class="dropzone" data-campo="anexos_notificacion" data-multiple="multiple">
                                <div class="dz-message"><span>Haga clic para elegir un archivo o Arrastre acá el archivo.</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col col-md-9">
                            <label for="formato_notificacion">Elija los Registros que se deben enviar adjunto al email</label>
                            <?php
                            if (!empty($listaIdsFmt)) {
                                echo $arbolFormato->generar_html();
                            } else {
                                echo 'No ha seleccionado formatos para el proceso';
                            }
                            ?>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>

        <div class="container">
            <div class="row mt-3">
                <div class="col col-md-3">
                    <button type="button" class="btn btn-primary btn-sm" id="guardarNotificacion">Guardar notificaci&oacute;n</button>
                </div>
                <div class="col col-md-3">
                    <div class="dropdown" id="divDdDestinatario">
                        <button class="btn btn-warning btn-sm dropdown-toggle" type="button" id="dropdownDestinatario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Adicionar destinatario
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownDestinatario">
                            <a class="dropdown-item tipo1" href="#" data-toggle="modal">Funcionarios de la Organizaci&oacute;n</a>
                            <a class="dropdown-item tipo2" href="#">Asociado a campos de registros</a>
                            <a class="dropdown-item tipo3" href="#">Personas externas</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Tabla de notificaciones. Si otra tabla -->

        <div id="toolbar_dst2">
            <a href="#" id="boton_eliminar" class="btn btn-secondary" title="Eliminar"><i class="f-12 fa fa-trash"></i></a>
        </div>
        <table class="table table-striped table-bordered table-hover" cellspacing="0" id="tabla_destinatarios2"
               data-toggle="table"
               data-url="listado_destinatarios.php?idnotificacion=<?= $idnotificacion ?>"
               data-click-to-select="true"
               data-show-toggle="true"
               data-show-columns="true"
               data-toolbar="#toolbar_dst2"
               data-pagination="true">
            <thead>
                <tr>
                    <th data-field="state" data-checkbox="true"></th>
                    <th data-field="iddestinatario" data-visible="false">IdDest</th>
                    <th data-field="fk_tipo_destinatario" data-visible="false">IdTipoDest</th>
                    <th data-field="nombre" >Nombre</th>
                    <th data-field="email" >Correo</th>
                    <th data-field="nombre_tipo" >Tipo de destinatario</th>
                </tr>
            </thead>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="modalTipoNotificacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="width: auto;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Ventana Modal</h4>
                    </div>
                    <div class="modal-body">
                        <iframe id="frameTipoNotificacion" src="<?= $ruta_db_superior ?>views/flujos/modal_persona_saia.php" width="600" height="400" frameborder="0" allowtransparency="true"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <!-- <button type="button" class="btn btn-primary">Guardar cambios</button>  -->
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <script type="text/javascript" data-params='{"idflujo" : "<?= $idflujo ?>"}'>
            //var $table = $('#tabla_notificaciones');
            //$table.bootstrapTable();

            $(function () {
                var idflujo = $("script[data-idflujo]").data("idflujo");
                if (!idflujo) {
                    idflujo = <?= $idflujo ?>;
                }

                let idnotificacion = $("#idnotificacion").val();
                if(idnotificacion && idnotificacion > 0) {
                   $("#divDdDestinatario").addClass("visible");
                } else {
                   $("#divDdDestinatario").addClass("invisible");
                }

                //console.log("notificacion", "idflujo", idflujo);
                //var $table = $('#tabla_notificaciones');
                $("#tabla_destinatarios2").bootstrapTable();

                $(".tipo1").click(function () {
                    let idnotificacion = $("#idnotificacion").val();
                    //console.log(idnotificacion);
                    var $iframe = $('#frameTipoNotificacion');
                    var url = "<?= $ruta_db_superior ?>views/flujos/modal_persona_saia.php?idnotificacion=" + idnotificacion;

                    //abrirModalDestinatario(url, "Destinatarios de correo de la Organización");

                    $("#myModalLabel").html("Destinatarios de correo de la Organización");
                    if (idnotificacion) {
                        if ($iframe.length) {
                            $iframe.attr('src', url);
                            $('#modalTipoNotificacion').modal('show');
                        }
                    } else {
                        idnotificacion = guardarNotificacion();
                        if (idnotificacion) {
                            if ($iframe.length) {
                                $iframe.attr('src', url);
                                $('#modalTipoNotificacion').modal('show');
                            }
                        } else {
                            top.notification({type: "error", message: "No se encontró notificación"});
                        }
                    }
                });

                $(".tipo2").click(function () {
                    var idnotificacion = $("#idnotificacion").val();
                    //console.log(idnotificacion);
                    var url = "<?= $ruta_db_superior ?>views/flujos/modal_persona_campos.php?idnotificacion=" + idnotificacion;
                    var $iframe = $('#frameTipoNotificacion');
                    $("#myModalLabel").html("Destinatarios de correo desde campo de formato");
                    if (idnotificacion) {
                        if ($iframe.length) {
                            $iframe.attr('src', url);
                            $('#modalTipoNotificacion').modal('show');
                        }
                    } else {
                        var idnotificacion = guardarNotificacion();
                        if (idnotificacion) {
                            if ($iframe.length) {
                                $iframe.attr('src', url);
                                $('#modalTipoNotificacion').modal('show');
                            }
                        } else {
                            top.notification({type: "error", message: "No se encontró notificación"});
                        }
                    }
                });

                $(".tipo3").click(function () {
                    var idnotificacion = $("#idnotificacion").val();
                    //console.log(idnotificacion);
                    var url = "<?= $ruta_db_superior ?>views/flujos/modal_persona_externa.php?idnotificacion=" + idnotificacion;
                    var $iframe = $('#frameTipoNotificacion');
                    $("#myModalLabel").html("Destinatarios de correo Externos");
                    if (idnotificacion) {
                        if ($iframe.length) {
                            $iframe.attr('src', url);
                            $('#modalTipoNotificacion').modal('show');
                        }
                    } else {
                        var idnotificacion = guardarNotificacion();
                        if (idnotificacion) {
                            if ($iframe.length) {
                                $iframe.attr('src', url);
                                $('#modalTipoNotificacion').modal('show');
                            }
                        } else {
                            top.notification({type: "error", message: "No se encontró notificación"});
                        }
                    }
                });

                $("#guardarNotificacion").click(function () {
                    var id = guardarNotificacion();
                });

                $.each(['show', 'hide'], function (i, ev) {
                    var el = $.fn[ev];
                    $.fn[ev] = function () {
                        this.trigger(ev);
                        return el.apply(this, arguments);
                    };
                });

                $("#sel_tipo_notificacion").change(function () {
                    var tipo = $(this).val();
                    if (tipo == 3) {
                        tipo = 2;
                    }
                    var nombre = "tipo_opcion_" + tipo;
                    $("." + nombre).show();
                    $(".tipo_opcion").each(function () {
                        if (!$(this).hasClass(nombre)) {
                            $(this).hide();
                        }
                    });
                });
                $('.tipo_opcion').on('show', function () {
                    //console.log('#foo is now visible');
                });
                $('.tipo_opcion').on('hide', function () {
                    //console.log('#foo is hidden');
                });

                function abrirModalDestinatario(url, titulo) {
                    let jspanelOpts = {
                        dragit: {
                            containment: [60, 5, 5, 5],
                            snap: true
                        },
                        ziBase: 10000,
                        /*syncMargins: true,*/
                        headerTitle: titulo,
                        iconfont: 'fa',
                        theme: 'dark',
                        position: {
                            my: "center-top",
                            at: "center-top"
                        },
                        contentSize: '600 400',
                        borderRadius: '6px',
                        content: '<iframe src="' + url + '" style="width: 100%; height: 90%; border:none; overflow:hidden auto;"></iframe>',
                        callback: function () {
                            this.header.style.borderBottom = 'none';
                            this.content.style.borderTop = 'none';
                        }
                    };
                    modalDestinatario = jsPanel.create(jspanelOpts);

                }

                function guardarNotificacion() {
                    if ($("#notificationForm").valid()) {
                        var formData = new FormData(document.getElementById("notificationForm"));
                        formData.append('key', localStorage.getItem("key"));
                        //var idflujo = $("#idflujo").val();
                        if (idflujo && idflujo != "") {
                            formData.append('idflujo', idflujo);
                        }
                        for (var pair of formData.entries()) {
                            console.log(pair[0] + ' => ' + pair[1]);
                        }
                        //return false;
                        var pk = false;
                        $.ajax({
                            dataType: "json",
                            url: "<?= $ruta_db_superior ?>app/flujo/guardarNotificacion.php",
                            type: "POST",
                            data: formData,
                            async: false,
                            processData: false, // tell jQuery not to process the data
                            contentType: false, // tell jQuery not to set contentType
                            success: function (response) {
                                if (response["success"] == 1) {
                                    top.notification({type: "success", message: response.message});
                                    pk = response.data.pk;
                                    $("#idnotificacion").val(pk);
                                    parent.postMessage({accion: "recargarTabla", id: pk}, "*");
                                    if(pk && pk > 0) {
                                        $("#divDdDestinatario").toggleClass("invisible");
                                    }
                                } else {
                                    top.notification({type: "error", message: response.message});
                                }
                            }
                        });
                        return pk;
                    }
                    return false;
                }

            });

            function seleccionarCampo(event, data) {
                //var elemento_evento = $.ui.fancytree.getEventTargetType(event.originalEvent);
                //console.log(event, data);
                if (!data.node.isFolder()) {
                    //alert("it works");
                    let tag = '{*' + data.node.data.nombre + '*}';
                    var area = $("#mensaje_notificacion");

                    var cursorPos = area.prop('selectionStart');
                    var v = area.val();
                    var textBefore = v.substring(0, cursorPos);
                    var textAfter = v.substring(cursorPos, v.length);

                    area.val(textBefore + tag + textAfter);
                }
            }

        </script>
        <?php

        function obtenerListaFormatos($idnotificacion) {
            global $conn;

            $lista_formatos = [];
            $formatos = busca_filtro_tabla("ff.*", "wf_adjunto_notificacion an join wf_formato_flujo ff on ff.idformato_flujo = an.fk_formato_flujo", "an.fk_notificacion= " . $idnotificacion, "", $conn);
            for ($i = 0; $i < $formatos["numcampos"]; $i++) {
                $lista_formatos[] = $formatos[$i]["fk_formato"];
            }
            return $lista_formatos;
        }
        ?>

