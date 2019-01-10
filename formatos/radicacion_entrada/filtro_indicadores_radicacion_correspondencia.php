<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}

include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery("1.7"));
?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo($ruta_db_superior);?>css/daterangepicker-bs3.css" />
<style>
.daterangepicker .calendar th, .daterangepicker .calendar td {min-width:12px;}
.dropdown-menu ul {width: 100%;}
.input-append .add-on, .input-prepend .add-on{height:17px;}
#fecha{text-align:center;}
</style>
<div class="container master-container">
<form id="kformulario_saia">
	<input type="hidden" name="adicionar_consulta" value="1">
			<div class="control-group">
				<legend>&nbsp;&nbsp;&nbsp;Fecha de Radicaci&oacute;n</legend>  <br/>
				<label class="string required control-label" for="rango_fecha">Seleccion un rango de fechas:
					<input type="hidden" name="bqsaia_a@fecha_radicacion_entrada_x" id="bqsaia_a-fecha_radicacion_entrada_x" value="">
					<input type="hidden" name="bksaiacondicion_a@fecha_radicacion_entrada_x" id="bksaiacondicion_a-fecha_radicacion_entrada_x" value=">=">
		      <input type="hidden" name="bqsaia_a@fecha_radicacion_entrada_y" id="bqsaia_a-fecha_radicacion_entrada_y" value="" >
		      <input type="hidden" name="bksaiacondicion_a@fecha_radicacion_entrada_y" id="bksaiacondicion_a-fecha_radicacion_entrada_y" value="<=">
		      <input type="hidden" name="bqtipodato" value="date|a@fecha_radicacion_entrada_x,a@fecha_radicacion_entrada_y">
				</label>
				<div class="controls">
					<input type="text" style="width: 250px" name="rango_fecha" id="fecha" value="" />
				</div>
			</div>
		
			
			
			<div class="controls">
				<div id="recargar_indicadores" class="btn btn-mini btn-primary recargar_indicadores" componente="<?php echo(@$_REQUEST["idbusqueda_componente"]); ?>">Actualizar Gr&aacute;ficos</div>
			</div>
			<input type="hidden" name="json" id="json" value="1">	
</form>
</div>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/moment.js"></script>
<script type="text/javascript">
$(document).ready(function(){
moment.lang('es', {
	      months : [
		  "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
		  "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
	      ]	      
	});
	moment.lang('es');
    $('#fecha').daterangepicker({
	    startDate: moment().subtract('days', 29),
	    endDate: moment(),
	    showDropdowns: true,
	    showWeekNumbers: true,
	    timePicker: false,
	    timePickerIncrement: 1,
	    timePicker12Hour: true,
	    ranges: {
	       'Hoy': [moment(), moment()],
	       'Ayer': [moment().subtract('days', 1), moment().subtract('days', 1)],
	       'Pasados 7 Dias': [moment().subtract('days', 6), moment()],
	       'Pasados 30 Dias': [moment().subtract('days', 29), moment()],
	       'Mes Actual': [moment().startOf('month'), moment().endOf('month')],
	       'Mes Pasado': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
	    },
	    opens: 'left',
	    buttonClasses: ['btn btn-default'],
	    applyClass: 'btn-small btn-primary',
	    cancelClass: 'btn-small',
	    format: 'YYYY-MM-DD',
	    separator: ' - ',
	    locale: {
	        applyLabel: 'Seleccionar',
	        fromLabel: 'De',
	        toLabel: 'A',
	        customRangeLabel: 'Seleccione rango',
	        daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi','Sa'],
	        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Novimbre', 'Diciembre'],
	        firstDay: 1
	    }
     },
     function(start,end){
      	$('#fecha').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        $('#bqsaia_a-fecha_radicacion_entrada_x').val(start.format('YYYY-MM-DD'));
        $('#bqsaia_a-fecha_radicacion_entrada_y').val(end.format('YYYY-MM-DD'));
      
        
     }
  );
});
</script>