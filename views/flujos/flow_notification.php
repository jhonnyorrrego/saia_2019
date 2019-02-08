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

include_once $ruta_db_superior . 'librerias_saia.php';
include_once $ruta_db_superior . 'controllers/autoload.php';
require_once ($ruta_db_superior . "arboles/crear_arbol_ft.php");

echo estilo_tabla_bootstrap("1.13");

echo librerias_tabla_bootstrap("1.13", false, false);

//$opciones_arbol = array("keyboard" => true, "onNodeClick" => "evento_click", "busqueda_item" => 1);
$opciones_arbol = array("keyboard" => true, "selectMode" => 2);
$extensiones = array("filter" => array());

$idflujo = null;
if (isset($_REQUEST["idflujo"])) {
    $idflujo = $_REQUEST["idflujo"];
    //$flujo = new Flujo($idflujo);
    $tipoTarea = TipoElemento::findByBpmnName(TipoElemento::TIPO_TAREA);
    $formatoFlujo = FormatoFlujo::conFkFlujo($idflujo);
    $formatos = $formatoFlujo->findFormatosByFlujo();
    $listaIdsFmt = [];
    foreach ($formatos as $fila) {
        $listaIdsFmt[] = $fila["idformato"];
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col col-12">
            Permite la configuración y personalización del envío de
            notificaciones en tiempo real a usuario del Sistema o usuarios
            externos notificando el cambio de estado y/o enviando documentación
            que se haya creado.
        </div>
    </div>
    <div class="row">
        <div class="col col-12 mt-2">
            <button type="button" id="crearNotificacion"
                    class="btn btn-primary btn-sm">Crear notificaci&oacute;n</button>
        </div>
    </div>

    <div class="row">
        <div class="col col-12" id="notificacion_frm" style="display: none">
            <script src="<?= $ruta_db_superior ?>views/flujos/js/flujos.js"></script>
        </div>
    </div>

<!-- data-url="<?= $ruta_db_superior ?>/views/flujos/listado_notificaciones.php?idflujo=<?= $idflujo ?>" -->

    <div class="row">
        <div class="col col-12 mt-4">

            <table id="tabla_notificaciones" class="table" table-layout="fixed"
                   data-toggle="table"
                   data-url="listado_notificaciones.php?idflujo=<?= $idflujo ?>"
                   data-side-pagination="server"
                   data-pagination="true"
                   data-search="false">
                <thead>
                    <tr>
                        <th data-field="idnotificacion" data-visible="false">Id</th>
                        <th data-field="nombre_evento">Acci&oacute;n para la notificaci&oacute;n</th>
                        <th data-field="asunto">Asunto</th>
                        <th data-field="email">Destinatario</th>
                        <th data-field="idnotificacion" data-formatter="buttonFormatter">&nbsp;</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>
</div>

<script type="text/javascript" id="sfn" data-idflujo="<?= $idflujo ?>">
    //var $table = $('#tabla_notificaciones');
    //$table.bootstrapTable();

    $(function () {
        var idflujo = $("script[data-idflujo]").data("idflujo");
        console.log("notificaciones", "idflujo", idflujo);

        $("#crearNotificacion").click(function (event, idnotificacion) {
            if ($("#notificacion_frm").is(":visible")) {
                $("#notificacion_frm").empty();
                $("#notificacion_frm").hide();
            } else {
                var src = "frm_notificacion.php?idflujo=<?= $idflujo ?>";
                if (idnotificacion) {
                    src += "&idnotificacion=" + idnotificacion;
                }
                $("#notificacion_frm").show();
                $('#notificacion_frm').append('<div id="iframe"><iframe src="' + src + '"  width="90%" height="650" frameborder="0"></iframe></div>');
            }
            //$("#notificacion_frm").toggle();
        });

        $(document).on("click", ".boton_editar_notificacion", function () {
            var id = $(this).data("idnotificacion");
            $("#crearNotificacion").trigger("click", id);
        });
        $(document).on("click", ".boton_eliminar_notificacion", function () {
            var ftb = [
                '<a href="#" id="btn-cancelar" class="jsPanel-ftr-btn"><i class="fa fa-close" style="font-size:24px;"></i> No</a>&nbsp;',
                '<a href="#" id="btn-aceptar" class="jsPanel-ftr-btn"><i class="fa fa-check" style="font-size:24px;color:red"></i> Si</a>',
            ];
            var id = $(this).data("idnotificacion");
            //$("#crearNotificacion").trigger("click", id);
            jsPanel.modal.create({
                contentSize:   '300 120',
                footerToolbar: ftb,
                content: "<p>&nbsp;</p><center><h4>Desea eliminar?<h4></center>",
                headerRemove:  true,
                callback: function (panel) {
                    jsPanel.pointerup.forEach(function (evt) {
                        panel.footer.querySelector('#btn-aceptar').addEventListener(evt, function () {
                            //panel.content.innerHTML = 'Click en Aceptar';
                            panel.close();
                        });
                        panel.footer.querySelector('#btn-cancelar').addEventListener(evt, function () {
                            panel.close();
                        });
                    });
                }
            });

        });
    });

    function buttonFormatter(value, row, index) {
        return `
            <div class="dropdown">
            <button class="btn btn-light btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-chevron-circle-down"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item boton_editar_notificacion" href="#" data-idnotificacion="${value}"><i class="f-10 fa fa-edit"></i> Editar</a>
              <a class="dropdown-item boton_eliminar_notificacion" href="#"><i class="f-10 fa fa-trash"></i> Eliminar</a>
            </div>
          </div>
        `;
        /*return [
            '<a href="#" class="boton_editar_notificacion" data-idnotificacion="' + value + '">',
            '<i class="f-12 fa fa-edit"></i>',
            '</a>'
        ].join('');*/
    }


</script>
