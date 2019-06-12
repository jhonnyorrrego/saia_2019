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

include_once $ruta_db_superior . 'core/autoload.php';

$idflujo = $_REQUEST['idflujo'];
$actividad = null;
$idactividad = null;
$enlaces = [];
if (!empty($_REQUEST["idactividad"])) {
    $actividad = new Elemento($_REQUEST["idactividad"]);
    $idactividad = $actividad->getPk();

    $enlaces = Enlace::findByEnlaceOrigen($idflujo, $actividad->bpmn_id);
}
?>

<div class="container-fluid">
    <div id="toolbar_tabla_elementos">
        <a href="#" id="boton_eliminar_decision" class="btn btn-secondary" title="Eliminar"><i class="f-12 fa fa-trash"></i></a>
    </div>
    <table class="table table-striped table-bordered table-hover" id="tabla_elementos"
           data-toggle="table"
           data-url="listado_enlaces_decision.php?idflujo=<?= $idflujo ?>&bpmn_id=<?= $actividad->bpmn_id ?>"
           data-click-to-select="true"
           data-show-toggle="true"
           data-show-columns="true"
           data-toolbar="#toolbar_tabla_elementos"
           data-pagination="true">
        <thead>
            <tr>
                <!-- <th data-field="state" data-checkbox="true"></th>  -->
                <th data-field="idenlace" data-visible="false">Id</th>
                <th data-field="bpmn_id" data-visible="false">IdBpmn</th>
                <th data-field="nombre" data-editable="true">Nombre de la decisi&oacute;n</th>
                <th data-field="nombre_dst">Hacia el paso</th>
                <th data-field="bpmn_id_dst" data-visible="false">IdBpmnDst</th>
            </tr>
        </thead>
    </table>
</div>

<script>

var $tabla = $("#tabla_elementos");
$tabla.bootstrapTable();

$.fn.editable.defaults.mode = 'inline';

$tabla.on('editable-save.bs.table', function(evt, field, row, oldValue, $el){
	//console.log(field);
	console.log(row);
	//console.log(oldValue);
	//console.log($el);
	//$el.classList.remove("editable-unsaved");

    var data = guardarEnlaceFlujo(row);
    if(data) {
        parent.postMessage({accion: "actualizarDiagrama", bpmn_id: data.bpmn_id, nombreTarea: data.nombre}, "*");
    }

	return true;
});

$tabla.on('editable-hidden.bs.table', function(evt, field, row, $el, reason) {
	//console.log(reason);
	//reason: cancel|nochange|save
	if(reason == 'save' && $el.hasClass("editable-unsaved")) {
		$el.removeClass('editable-unsaved');
	}
});

var $botonEliminarDecision = $('#boton_eliminar_decision');
var $botonGuardarDecision = $('#btnGuardarDecision');

var idactividad = "<?= $idactividad ?>";

//console.log("params", params);

function guardarEnlaceFlujo(data) {
    if (data) {
        data['key'] = localStorage.getItem("key");

        var pk = false;
        $.ajax({
            dataType: "json",
            url: "<?= $ruta_db_superior ?>app/flujo/guardarEnlaceFlujo.php",
            type: "POST",
            data: data,
            async: false,
            success: function (response) {
                if (response["success"] == 1) {
                    top.notification({type: "success", message: response.message});
                    pk = response.data;
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
