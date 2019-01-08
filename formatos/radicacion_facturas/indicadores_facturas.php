<?php
$max_salida = 10;
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
$diafinal = date("t");
?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo($ruta_db_superior); ?>css/daterangepicker-bs3.css" />
<style>
	.daterangepicker .calendar th, .daterangepicker .calendar td {
		min-width: 12px;
	}
	.dropdown-menu ul {
		width: 100%;
	}
	.input-append .add-on, .input-prepend .add-on {
		height: 17px;
	}
	#fecha {
		text-align: center;
	}
</style>
<div class="container master-container">
	<form accept-charset="UTF-8" id="kformulario_saia"  method="post" class="form-horizontal">
		<input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
		<input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="336" componente="336">	
		<div class="control-group">
			<label class="string required control-label" for="rango_fecha"><b>Seleccione un rango de fechas:</b>
				<input type="hidden" name="bksaiacondicion_fecha_x" value="&gt;=">
				<input type="hidden" name="bqsaia_fecha_x" id="bqsaia_fecha_x" value="<?php echo date("Y-m-01"); ?>">
				<input type="hidden" name="bksaiacondicion_fecha_y" value="&lt;=">
				<input type="hidden" name="bqsaia_fecha_y"  id="bqsaia_fecha_y" value="<?php echo date("Y-m-t"); ?>" >
				<input type="hidden" name="bqsaiaenlace_fecha_y" value="y">
				<input type="hidden" name="bqtipodato" value="date|fecha_x,fecha_y">
			</label>
			<div class="controls">
				<input type="text" style="width: 280px" name="rango_fecha" id="fecha" value="" />
				<div class="btn btn-mini btn-primary recargar_indicadores" id="recargar_indicadores">
					Actualizar Gr&aacute;ficos
				</div>
			</div>
		</div>
		
    <!--div class="control-group">
      <label class="string required control-label">
      <strong>Tipo Reclamo</strong>
      <input type="hidden" name="bksaiacondicion_tipo_clasificacion" id="bksaiacondicion_tipo_clasificacion" value="=">
      </label>
      <div class="controls">
        <select id="bqsaia_tipo_clasificacion" name="bqsaia_tipo_clasificacion">
        	<option value="">Seleccione</option>
        	<option value="1">Comercial</option>
        	<option value="2">Calidad</option>
        </select>
      </div>
    </div-->
	</form>
</div>
<script type="text/javascript" src="<?php echo($ruta_db_superior); ?>js/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior); ?>js/moment.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		moment.lang('es', {
			months : ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]
		});
		$('#fecha').daterangepicker({
			startDate :moment().startOf('month'),
			endDate : moment().endOf('month'),
			showDropdowns : true,
			showWeekNumbers : true,
			timePicker : false,
			timePickerIncrement : 1,
			timePicker12Hour : true,
			ranges : {
				'Hoy' : [moment(), moment()],
				'Ayer' : [moment().subtract('days', 1), moment().subtract('days', 1)],
				'Pasados 7 Dias' : [moment().subtract('days', 6), moment()],
				'Pasados 30 Dias' : [moment().subtract('days', 29), moment()],
				'Mes Actual' : [moment().startOf('month'), moment().endOf('month')],
				'Mes Pasado' : [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
			},
			opens : 'left',
			buttonClasses : ['btn btn-default'],
			applyClass : 'btn-small btn-primary',
			cancelClass : 'btn-small',
			format : 'YYYY-MM-DD',
			separator : ' - ',
			locale : {
				applyLabel : 'Seleccionar',
				fromLabel : 'De',
				toLabel : 'A',
				customRangeLabel : 'Seleccione rango',
				daysOfWeek : ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
				monthNames : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Novimbre', 'Diciembre'],
				firstDay : 1
			}
		}, function(start, end) {
			$('#fecha').val(start.format('MMMM DD, YYYY') + ' - ' + end.format('MMMM DD, YYYY'));
			$('#bqsaia_fecha_x').val(start.format('YYYY-MM-DD'));
			$('#bqsaia_fecha_y').val(end.format('YYYY-MM-DD'));			
		});
		var diafinal=parseInt(<?php echo $diafinal; ?>);
		$('#fecha').val(moment().format('MMMM 01, YYYY') + ' - ' + moment().format('MMMM ' + (diafinal) + ', YYYY'));
	}); 
</script>