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

include_once $ruta_db_superior . 'controllers/autoload.php';

$idflujo = $_REQUEST['idflujo'];
$actividad = null;
$idactividad = null;
$tipo_decision = [];
if (!empty($_REQUEST["idactividad"])) {
    $actividad = new Elemento($_REQUEST["idactividad"]);
    $idactividad = $actividad->getPk();

    $tipo_decision = TipoDecisionActiv::findAll("", 0, true);
}
?>

<div>
    <form id="frmdecisionActividad">
        <div class="form-group">
            <label for="nombre_decision">Nombre de la decisi&oacute;n</label>
            <input type="email" class="form-control" id="nombre_decision" name="decision" placeholder="Nombre de la decisi&oacute;n" value="">
        </div>
        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label class="my-0" for="selTipoDecision">Tipo de decisi&oacute;n</label>
                    <select class="form-control" id="selTipoDecision">
                    <option value="0">Por favor selecione...</option>
                    <?php
                    foreach ($tipo_decision as $decis) : ?>
                        <option value="<?= $decis["idtipo_decision_activ"] ?>"><?=$decis["tipo_decision"]  ?></option>
                    <?php endforeach;?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row pr-2 mt-1">
            <div class="col col-md-8">
                <button type="button" class="btn btn-primary btn-sm float-right" id="btnGuardarDecision">Guardar</button>
            </div>
        </div>

    </form>
</div>

<div class="container-fluid">
    <div id="toolbar_tabla_decisiones">
        <a href="#" id="boton_eliminar_decision" class="btn btn-secondary" title="Eliminar"><i class="f-12 fa fa-trash"></i></a>
    </div>
    <table class="table table-striped table-bordered table-hover" id="tabla_decisiones"
           data-toggle="table"
           data-url="listado_decisiones_actividad.php?idactividad=<?= $idactividad ?>"
           data-click-to-select="true"
           data-show-toggle="true"
           data-show-columns="true"
           data-pagination="true">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="true"></th>
                <th data-field="iddecision_actividad" data-visible="false">Id</th>
                <th data-field="fk_tipo_decision" data-visible="false">IdTipo</th>
                <th data-field="decision">Nombre de la decisi&oacute;n</th>
                <th data-field="tipo_decision">Tipo de decisi&oacute;n</th>
            </tr>
        </thead>
    </table>
</div>

<script>

var $tabla = $("#tabla_req_in");
$tabla.bootstrapTable();

var $botonEliminarDecision = $('#boton_eliminar_decision');
var $botonGuardarDecision = $('#btnGuardarDecision');

var idactividad = "<?= $idactividad ?>";

$botonGuardarDecision.click(function () {
    var datos = $tabla.bootstrapTable('getData');

    var decision = $("#frmDecisionActividad #nombre_decision").val();
    var fk_tipo_decision = $("#frmDecisionActividad #selTipoDecision").val();

    //console.log("obligatorio", obligatorio);
    var existe = false;
    for (var key in datos) {
        var obj = datos[key];
        if (obj.decision == decision && obj.fk_tipo_decision == fk_tipo_decision) {
            existe = true;
            break;
        }
    }
    //console.log("existe", existe);
    if (!existe) {
        var data = {decision: decision, fk_tipo_decision: fk_tipo_decision};
        var id = guardarDecisionActividad(idactividad, data);
        data["iddecision_actividad"] = id;
        $tabla.bootstrapTable('append', data);
    }
});


$botonEliminarDecision.click(function () {
    var ids = $.map($tabla.bootstrapTable('getSelections'), function (row) {
        return row.iddecision_actividad
    });
    var estado = eliminarDecisionActividad(idactividad, ids.join(","));
    if (estado) {
        $tabla.bootstrapTable('remove', {
            field: 'iddecision_actividad',
            values: ids
        });
    }
});

function guardarDecisionActividad(idactividad, data) {
    if (data) {
        data['key'] = localStorage.getItem("key");
        data["fk_actividad"] = idactividad;

        //console.log(idactividad, data);
        //return false;
        var pk = false;
        $.ajax({
            dataType: "json",
            url: "<?= $ruta_db_superior ?>app/flujo/guardarDecisionActividad.php",
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

function eliminarDecisionActividad(idactividad, ids) {
    if (ids) {
        var data = {
            key: localStorage.getItem("key"),
            fk_actividad: idactividad,
            ids: ids
        };

        //console.log(idactividad, data);
        //return false;
        //TODO: Falta pedir confirmacion al usuario

        var pk = false;
        $.ajax({
            dataType: "json",
            url: "<?= $ruta_db_superior ?>app/flujo/borrarDecisionActividad.php",
            type: "POST",
            data: data,
            async: false,
            success: function (response) {
                if (response["success"] == 1) {
                    top.notification({type: "success", message: response.message});
                    pk = true;
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

</script>
