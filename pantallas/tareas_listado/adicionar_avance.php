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
include_once($ruta_db_superior."class_transferencia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."pantallas/lib/librerias_notificaciones.php");
echo(librerias_jquery("1.7"));
echo(librerias_arboles());
echo(estilo_bootstrap());
echo(librerias_bootstrap());
if($_REQUEST['guardar']==1){
	$idtareas_listado=$_REQUEST['idtareas_listado'];
	$sql="INSERT INTO tareas_avance (tareas_idtareas,fecha,descripcion,estado,ejecutor) VALUES(".$idtareas_listado.",".fecha_db_almacenar($_REQUEST['fecha'],"Y-m-d H:i:s").",'".($_REQUEST['descripcion'])."',".$_REQUEST['estado'].",".usuario_actual("funcionario_codigo").")";
	phpmkr_query($sql);
	$sql="UPDATE tareas SET estado_tarea=".$_REQUEST["estado"]." WHERE idtareas=".$idtareas_listado;
	phpmkr_query($sql);
	notificaciones("Avance asignado!","success",4500);
	abrir_url("detalles_tareas_listado.php?idtareas_listado=".$idtareas_listado,"iframe_detalle");
	unset($_REQUEST);
	?>
	<script type="text/javascript">window.parent.hs.close();</script>
	<?php
if($_REQUEST['iddoc']){
	redirecciona("detalles_tareas.php?idtareas_listado=".$idtareas_listado,"iframe_detalle");
}
	
}else{
?>
<div class="container">
		<div class="control-group" nombre="etiqueta">
			<legend>Asignar avance a la tarea</legend>
		</div>
		<form id="formulario_tareas" class="form-horizontal">
			 <tr>
  	<td class="prettyprint" colspan="3">
  		<div class="tabbable" id="secciones">
  			<ul class="nav nav-tabs">
  				<li class="active"><a href="#tab1" data-toggle="tab"><i class="icon-calendar"></i></a></li>
  				<li><a href="#tab2" data-toggle="tab"><i class="icon-fast-forward"></i></a></li>
  				<li><a href="#tab3" data-toggle="tab"><i class="icon-time"></i></a></li>
  				<li><a href="#tab4" data-toggle="tab"><i class="icon-align-justify"></i></a></li>
  				<li><a href="#tab5" data-toggle="tab"><i class=" icon-upload"></i></a></li>
  				
  			</ul>
  			<div class="tab-content">
  				<div class="tab-pane active" id="tab1">
  					1
  				</div>
  				<div class="tab-pane" id="tab2">
  					<div class="progress progress-striped active" id="barra_progreso">
  						<div id="progreso" class="bar" style="width: 10%;"></div>
  					</div>
  					<div class="pull-left"">
  						<label class="form-control" for="frecuencia_consulta">Frecuencia
	  </label>
  						<select name="frecuencia_consulta" class="form-control" id="cantidad_progreso"">
  							<option value="">Por favor seleccione...</option>
  							<option value="1">10%</option>
  							<option value="2">20%</option>
  							<option value="3">30%</option>
  							<option value="3">40%</option>
  							<option value="3">50%</option>
  							<option value="3">60%</option>
  							<option value="3">70%</option>
  							<option value="3">80%</option>
  							<option value="3">90%</option>
  							<option value="3">100%</option>
  						</select>
	 			   </div>
  				</div>
  				<div class="tab-pane" id="tab3">
  					3
  				</div>
  				<div class="tab-pane" id="tab4">
  					4
  				</div>
  				<div class="tab-pane" id="tab5">
  					
  					<div class="control-group">
  						<div id="name">
  							
							
						</div>
  						<div id="MultiFile1_wrap">
  							
  							<label style="padding-left:5px;color:#777;font-size:18px;" class="control-label" for="etiqueta">Anexos*:</label>
  							<div class="controls">
  								<input tabindex="7" type="file" class="required multi" name="fotografia[]" accept="jpg|png|gif|doc|ppt|xls|txt|pdf|docx|pptx|pps|xlsx|csv" id="MultiFile1">
  								<span id="MultiFile1_wrap_labels"></span>
  							</div>
		  				</div>
					</div>			
  				</div>
  			</div>
  		</div>
  		<script type="text/javascript" charset="utf-8">
			 // $('#secciones').hide();
		  </script>
  	</td>
  </tr>
		</form>
	</div>
	<script type="text/javascript" src="<?php echo($ruta_db_superior); ?>js/jquery.validate.1.13.1.js"></script>
	<style>
	label.error {
		font-weight: bold;
		color: red;
	}
	</style>
	<script>
		
	$(document).ready(function(){
		$("#formulario_tareas").validate();
		
		$("cantidad_progreso").change(function(){
			
			switch($(this).val()) {
    			case 1:
        			alert('entra');
       				break;
    			case 2:
        			code block
        			break;
        		case 3:
        			code block
        			break;
        		case 4:
        			code block
        			break;
        		case 5:
        			code block
        			break;
        		case 6:
        			code block
        			break;
        		case 7:
        			code block
        			break;
        		case 8:
        			code block
        			break;
        		case 9:
        			code block
        			break;
        		case 10:
        			code block
        			break;
        		default:
}
			
		});
	});
	</script>
<?php
}
