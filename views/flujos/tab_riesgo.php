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
$prob_riesgo = [];
$impacto_riesgo = [];
if (!empty($_REQUEST["idactividad"])) {
    $actividad = new Elemento($_REQUEST["idactividad"]);
    $idactividad = $actividad->getPk();

    $prob_riesgo = TipoProbRiesgo::findAll("", 0, true);
    $impacto_riesgo = TipoImpactoRiesgo::findAll("", 0, true);
}
?>

<div>
    <form id="frmRiesgoActividad">
        <div class="form-group form-group-default">
            <label for="nombre_riesgo">Riesgo identificado del Paso</label>
            <input type="email" class="form-control" id="nombre_riesgo" name="riesgo" placeholder="Escriba el riesgo del paso" value="">
        </div>
        <div class="form-group form-group-default">
            <label for="descripcion_riesgo">Descripción del riesgo</label>
            <textarea class="form-control" id="descripcion_riesgo" name="descripcion_riesgo" placeholder="Describa el riesgo"></textarea>
        </div>
        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label class="my-0" for="selProbRiesgo">Probabilidad del riesgo</label>
                    <select class="form-control" id="selProbRiesgo">
                    <option value="0">Por favor selecione...</option>
                    <?php
                    foreach ($prob_riesgo as $prob) : ?>
                        <option value="<?= $prob["idtipo_probabilidad"] ?>"><?=$prob["probabilidad"]  ?></option>
                    <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="col col-md-6">
                <div class="form-group">
                    <label class="my-0" for="selImpactoRiesgo" id="lbl_rol_func">Impacto del riesgo</label>
                    <select class="form-control" id="selImpactoRiesgo">
                    <option value="0">Por favor selecione...</option>
                    <?php
                    foreach ($impacto_riesgo as $impacto) : ?>
                        <option value="<?= $impacto["idtipo_impacto"] ?>"><?=$impacto["impacto"]  ?></option>
                    <?php endforeach;?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row pr-2 mt-1">
            <div class="col col-md-8">
                <button type="button" class="btn btn-primary btn-sm float-right" id="btnGuardarRiesgo">Agregar Riesgo</button>
            </div>
        </div>

    </form>
</div>

<div class="container-fluid">
    <div id="toolbar_tabla_riesgos">
        <a href="#" id="boton_eliminar_riesgo" class="btn btn-secondary" title="Eliminar"><i class="f-12 fa fa-trash"></i></a>
    </div>
    <table class="table table-striped table-bordered table-hover" id="tabla_riesgos"
           data-toggle="table"
           data-url="listado_riesgos_actividad.php?idactividad=<?= $idactividad ?>"
           data-click-to-select="true"
           data-show-toggle="true"
           data-show-columns="true"
           data-toolbar="#toolbar_tabla_riesgos"
           data-pagination="true">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="true"></th>
                <th data-field="idriesgo" data-visible="false">Id</th>
                <th data-field="riesgo">Nombre del riesgo</th>
                <th data-field="descripcion">Descripci&oacute;n</th>
                <th data-field="impacto">Impacto</th>
                <th data-field="probabilidad">Probabilidad</th>
            </tr>
        </thead>
    </table>
</div>

<script>

var $tabla = $("#tabla_riesgos");
$tabla.bootstrapTable();

var $botonEliminarRiesgo = $('#boton_eliminar_riesgo');
var $botonGuardarRiesgo = $('#btnGuardarRiesgo');

var idactividad = "<?= $idactividad ?>";

var obligatorio = 0;
//console.log('tipo_requisito', tipo_requisito);
$botonGuardarRiesgo.click(function () {
    var datos = $tabla.bootstrapTable('getData');

    var riesgo = $("#frmRiesgoActividad #nombre_riesgo").val();
    var descripcion = $("#frmRiesgoActividad #descripcion_riesgo").val();
    var fk_probabilidad = $("#frmRiesgoActividad #selProbRiesgo").val();
    var fk_impacto = $("#frmRiesgoActividad #selImpactoRiesgo").val();
    var texto_prob = $("#frmRiesgoActividad #selProbRiesgo option:selected").text();
    var texto_impa = $("#frmRiesgoActividad #selImpactoRiesgo option:selected").text();

    var existe = false;
    for (var key in datos) {
        var obj = datos[key];
        if (obj.riesgo == riesgo) {
            existe = true;
            break;
        }
    }
    if (!existe) {
        var data = {descripcion: descripcion, riesgo: riesgo, fk_probabilidad: fk_probabilidad, fk_impacto: fk_impacto};
        var id = guardarRiesgoActividad(idactividad, data);
        if(id) {
            data["idriesgo"] = id;
            data["impacto"] = texto_impa;
            data["probabilidad"] = texto_prob;
            $tabla.bootstrapTable('append', data);
            document.getElementById("frmRiesgoActividad").reset();
        }
    }
});


$botonEliminarRiesgo.click(function () {
    var ids = $.map($tabla.bootstrapTable('getSelections'), function (row) {
        return row.idriesgo
    });
    var estado = eliminarRiesgoActividad(idactividad, ids.join(","));
    if (estado) {
        $tabla.bootstrapTable('remove', {
            field: 'idriesgo',
            values: ids
        });
    }
});

function guardarRiesgoActividad(idactividad, data) {
    if (data) {
        data['key'] = localStorage.getItem("key");
        data["fk_actividad"] = idactividad;

        //console.log(idactividad, data);
        //return false;
        var pk = false;
        $.ajax({
            dataType: "json",
            url: "<?= $ruta_db_superior ?>app/flujo/guardarRiesgoActividad.php",
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

function eliminarRiesgoActividad(idactividad, ids) {
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
            url: "<?= $ruta_db_superior ?>app/flujo/borrarRiesgoActividad.php",
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

