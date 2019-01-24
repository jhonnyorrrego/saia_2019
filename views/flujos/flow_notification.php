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

echo estilo_tabla_bootstrap("1.13");

echo librerias_tabla_bootstrap("1.13", false, false);

$idflujo = null;
$datosDiagrama = null;
if(isset($_REQUEST["idflujo"])) {
	$idflujo = $_REQUEST["idflujo"];
	$flujo = new Flujo($idflujo);
	$datosDiagrama = $flujo->diagrama;
}

$eventos = EventoNotificacion::findAll('', 0, true);

?>
<div>
	<p>Permite la configuración y personalización del envío de
		notificaciones en tiempo real a usuario del Sistema o usuarios
		externos notificando el cambio de estado y/o enviando documentación
		que se haya creado.</p>
</div>
<div>
	<button type="button" id="crearNotificacion"
		class="btn btn-primary btn-sm">Crear notificaci&oacute;n</button>
</div>
<div id="notificacion_frm" style="display: none">
	<form id="notificationForm" class="form-inline">
		<fieldset>
			<legend>Definiendo las notificaciones</legend>
			<label for="sel_tipo_notificacion">Seleccione en que momento se enviar&aacute; la notificaci&oacute;n</label>
			<select class="form-control" name="" id="sel_tipo_notificacion">
				<option value="0">Por favor seleccione...</option>
				<?php if(!empty($eventos)) {
					foreach ($eventos as $evento) {
						echo '<option value="' . $evento["idevento_notificacion"] . '">' . $evento["evento"] . '</option>';
					}
				}
				?>			
				<!-- <option value="">Al cambiar de estado</option>
				<option value="2">Al crear un registro nuevo</option>
				<option value="3">Al radicarse o publicarse un documento</option> -->
			</select>
			<div class="tipo_opcion tipo_opcion_1" style="display: none;">
				<label>Elija el cambio de estado</label>
			</div>
			<div class="tipo_opcion tipo_opcion_2" style="display: none;">
				<label>Elija el formato asociado</label>
			</div>
			<div class="tipo_opcion tipo_opcion_3" style="display: none;">
				<label>Elija el formato asociado</label>
			</div>
		</fieldset>
	</form>
</div>
<!-- data-url="<?= $ruta_db_superior ?>/views/flujos/listado_notificaciones.php?idflujo=<?= $idflujo?>" -->
<table id="tabla_notificaciones" 
  
  data-toggle="table"
  data-url="listado_notificaciones.php?idflujo=<?= $idflujo?>"
  data-height="400"
  data-side-pagination="server"
  data-pagination="true"
  data-page-list="[5, 10, 20, 50, 100, 200]"
  data-search="true">
	<thead>
		<tr>
			<th data-field="">Acci&oacute;n para la notificaci&oacute;n</th>
			<th>Asunto</th>
			<th>Destinatario</th>
			<th></th>
		</tr>
	</thead>
</table>
<script type="text/javascript">
	//var $table = $('#tabla_notificaciones');
	//$table.bootstrapTable();

$(function(){
	$.each(['show', 'hide'], function (i, ev) {
	    var el = $.fn[ev];
	    $.fn[ev] = function () {
	      this.trigger(ev);
	      return el.apply(this, arguments);
	    };
	});
	$("#crearNotificacion").click(function(){
		$("#notificacion_frm").toggle();
	});
	$("#sel_tipo_notificacion").change(function() {
		var tipo = $(this).val();
		var nombre = "tipo_opcion_" + tipo;
		$("." + nombre).show();
		$(".tipo_opcion").each(function(){
			if(!$(this).hasClass(nombre)) {
				$(this).hide();
			}
		});
	});
	$('.tipo_opcion').on('show', function() {
	      console.log('#foo is now visible');
	});
	$('.tipo_opcion').on('hide', function() {
	      //console.log('#foo is hidden');
	});

	function ajaxRequest(params) {

	    // data you may need
	    console.log(params.data);

	    $.ajax({
	        type: "POST",
	        url: "listado_notificaciones.php",
	        data: "idflujo=1",
	// You are expected to receive the generated JSON (json_encode($data))
	        dataType: "json",
	        success: function (data) {
	            params.success({
	// By default, Bootstrap table wants a "rows" property with the data
	                "rows": data,
	// You must provide the total item ; here let's say it is for array length
	                "total": data.total
	            })
	        },
	        error: function (er) {
	            params.error(er);
	        }
	    });
	}
	
});
</script>
