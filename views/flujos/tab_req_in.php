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

$idactividad = null;
$tipo_requisito = ReqCalidadActiv::TIPO_ENTRADA;
if (!empty($_REQUEST["idactividad"])) {
    $idactividad = $_REQUEST["idactividad"];
}
?>
<div class="container">
    <form id="frmReqIn">
        <input type="hidden" name="fk_actividad" value="<?= $idactividad ?>">
        <div class="row py-1 mt-1">
            <div class="col col-md-8">
                <div class="form-control form-group-default">
                <label>Informaci&oacute;n de entrada</label>
                <input class="form-control form-control" id="requisito_in" name="nombre" type="text" placeholder="Qu&eacute; se requiere previo a realizar este paso&quest;">
                </div>
            </div>
            <div class="col col-md-4">
                <div class="form-check align-middle">
                    <input class="form-check-input" type="checkbox" value="" id="obligatorio_in" name="obligatorio">
                    <label class="form-check-label" for="obligatorio_in">
                        Obligatoria
                    </label>
                </div>
            </div>
        </div>
        <div class="row pr-2 mt-1">
            <div class="col col-md-8">
                <button type="button" class="btn btn-primary btn-sm float-right" id="btnGuardarRequisitoIn">Guardar</button>
            </div>
        </div>

    </form>
</div>
<div class="container-fluid">
    <div id="toolbar_tabla_req_in">
        <a href="#" id="boton_eliminar_req_in" class="btn btn-secondary" title="Eliminar"><i class="f-12 fa fa-trash"></i></a>
    </div>
    <table class="table table-striped table-bordered table-hover" id="tabla_req_in"
           data-toggle="table"
           data-url="listado_req_actividad.php?idactividad=<?= $idactividad ?>&tipo=<?= $tipo_requisito ?>"
           data-click-to-select="true"
           data-show-toggle="true"
           data-show-columns="true"
           data-toolbar="#toolbar_tabla_req_in"
           data-pagination="true">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="true"></th>
                <th data-field="idrequisito_calidad" data-visible="false">IdReq</th>
                <th data-field="obligatorio" data-formatter="obligatorioFormatterIn">Tipo</th>
                <th data-field="requisito">Nombre</th>
            </tr>
        </thead>
    </table>
</div>

<div class="container">
    <form id="frmQualityReqIn">

        <div class="row py-1 mt-1">
            <div class="col col-md-12">
                <div class="form-group">
                    <label for="req_calidad_in">Requisitos de calidad</label>
                    <textarea class="form-control" id="req_calidad_in" name="req_calidad_in"><?= $actividad->req_calidad_in ?></textarea>
                </div>
	        </div>
        </div>
        <div class="row py-1 mt-1">
            <div class="col col-md-12">
                <div class="float-right">
                    <button type="button" id="cancelarReqCalidadIn" class="btn btn-danger">Cancelar</button>
                    <button type="button" id="guardarReqCalidadIn" class="btn btn-primary">Guardar cambios</button>
    	        </div>
	        </div>
        </div>
	</form>
</div>

<script>
    var $tabla = $("#tabla_req_in");
    $tabla.bootstrapTable();

    //var $botonEliminarRequisito = $('#boton_eliminar_req_in');
    var $botonGuardarRequisitoIn = $('#btnGuardarRequisitoIn');

    var idactividad = "<?= $idactividad ?>";
    var tipo_requisito = "<?= $tipo_requisito ?>";
    var obligatorio = 0;
    //console.log('tipo_requisito', tipo_requisito);
    $botonGuardarRequisitoIn.click(function () {
        var datos = $tabla.bootstrapTable('getData');

        var nombre = $("#frmReqIn #requisito_in").val();
        if($("#frmReqIn #obligatorio_in").is(':checked')) {
            obligatorio = 1;
        }
        //console.log("obligatorio", obligatorio);
        var existe = false;
        for (var key in datos) {
            var obj = datos[key];
            if (obj.nombre == nombre) {
                existe = true;
                break;
            }
        }
        //console.log("existe", existe);
        if (!existe) {
            var data = {obligatorio: obligatorio, requisito: nombre, tipo: tipo_requisito};
            var id = guardarRequisitoActividad(idactividad, data);
            data["idrequisito_calidad"] = id;
            $tabla.bootstrapTable('append', data);
        }
    });

    $('#guardarReqCalidadIn').click(function () {
        let req_in = $("#frmQualityReqIn #req_calidad_in").val();
        var data = {requisito: req_in, tipo: tipo_requisito};
        var id = guardarRequisitoCalidadActividadIn(idactividad, data);
    });
    $("#cancelarReqCalidadIn").click(function () {
        let nombre = $("#frmActividad #nombre_actividad").val();
        let data = params;
        if(params && nombre && params.nombreTarea && params.nombreTarea != nombre) {
            data["accion"] = "cerrarModalActividad";
        } else {
            data = {accion: "cerrarModalActividad", idactividad: idactividad, nombre_actividad: nombre};
        }
        parent.postMessage(data, "*");

    });

    $('#boton_eliminar_req_in').click(function () {
        var ids = $.map($tabla.bootstrapTable('getSelections'), function (row) {
            return row.idrequisito_calidad
        });
        var estado = eliminarRequisitoActividad(idactividad, ids.join(","));
        if (estado) {
            $tabla.bootstrapTable('remove', {
                field: 'idrequisito_calidad',
                values: ids
            });
        }
    });

    function guardarRequisitoActividad(idactividad, data) {
        if (data) {
            data['key'] = localStorage.getItem("key");
            data["fk_actividad"] = idactividad;

            //console.log(idactividad, data);
            //return false;
            var pk = false;
            $.ajax({
                dataType: "json",
                url: "<?= $ruta_db_superior ?>app/flujo/guardarRequisitoActividad.php",
                type: "POST",
                data: data,
                async: false,
                success: function (response) {
                    if (response["success"] == 1) {
                        top.notification({type: "success", message: response.message});
                        pk = response.data.pk;
                        //parent.parent.postMessage({accion: "recargarTabla", id: pk}, "*");
                    } else {
                        top.notification({type: "error", message: response.message});
                    }
                }
            });
            return pk;
        }
        return false;
    }

    function guardarRequisitoCalidadActividadIn(idactividad, data) {
        if (data) {
            data['key'] = localStorage.getItem("key");
            data["idelemento"] = idactividad;

            //console.log(idactividad, data);
            //return false;
            var pk = false;
            $.ajax({
                dataType: "json",
                url: "<?= $ruta_db_superior ?>app/flujo/guardarRequisitoActividad.php",
                type: "POST",
                data: data,
                async: false,
                success: function (response) {
                    if (response["success"] == 1) {
                        top.notification({type: "success", message: response.message});
                        pk = response.data.pk;
                    } else {
                        top.notification({type: "error", message: response.message});
                    }
                }
            });
            return pk;
        }
        return false;
    }

    function eliminarRequisitoActividad(idactividad, ids) {
        if (ids) {
            var data = {
                key: localStorage.getItem("key"),
                fk_actividad: idactividad,
                obligatorio: obligatorio,
                ids: ids
            };

            //console.log(idactividad, data);
            //return false;
            //TODO: Falta pedir confirmacion al usuario

            var pk = false;
            $.ajax({
                dataType: "json",
                url: "<?= $ruta_db_superior ?>app/flujo/borrarRequisitoActividad.php",
                type: "POST",
                data: data,
                async: false,
                success: function (response) {
                    if (response["success"] == 1) {
                        top.notification({type: "success", message: response.message});
                        pk = true;
                        parent.parent.postMessage({accion: "recargarTabla", id: pk}, "*");

                    } else {
                        top.notification({type: "error", message: response.message});
                    }
                }
            });
            return pk;
        }
        return false;
    }

    function obligatorioFormatterIn(value, row, index) {
    	//console.log(value);
        if(value == '1') {
            return "Obligatoria";
        } else {
            return "Opcional";
        }
    }
</script>
