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

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("idtareas","iddoc");
desencriptar_sqli('form_info');

include_once($ruta_db_superior."class_transferencia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."pantallas/lib/librerias_notificaciones.php");
echo(librerias_jquery("1.7"));
echo(librerias_arboles());
echo(estilo_bootstrap());
echo(librerias_bootstrap());
if($_REQUEST['guardar']==1){
	$tarea=$_REQUEST['idtareas'];
	$sql="INSERT INTO tareas_avance (tareas_idtareas,fecha,descripcion,estado,ejecutor) VALUES(".$tarea.",".fecha_db_almacenar($_REQUEST['fecha'],"Y-m-d H:i:s").",'".htmlentities($_REQUEST['descripcion'])."',".$_REQUEST['estado'].",".usuario_actual("funcionario_codigo").")";
	phpmkr_query($sql);
	$sql="UPDATE tareas SET estado_tarea=".$_REQUEST["estado"]." WHERE idtareas=".$tarea;
	phpmkr_query($sql);
	notificaciones("Avance asignado!","success",4500);
	unset($_REQUEST);
	?>
	<script type="text/javascript">window.parent.hs.close();</script>
	<?php
if($_REQUEST['iddoc']){
	abrir_url("mostrar_tareas.php?idtareas=".$tarea,"iframe_detalle");
}
	
}else{
?>
<div class="container">
		<div class="control-group" nombre="etiqueta">
			<legend>Asignar avance a la tarea</legend>
		</div>
		<form id="formulario_tareas" name="formulario_tareas" class="form-horizontal" method="post">
			<div class="control-group">
				<label class="control-label" for="etiqueta">Fecha*:</label>
				<div class="controls">
					<input type="text" name="fecha" id="fecha" class="required" readonly="" value="<?php echo(date("Y-m-d H:i:s"));?>">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="etiqueta">Descripci&oacute;n*:</label>
				<div class="controls">
					<textarea id="descripcion" class="required" name="descripcion" placeholder="Descripcion"></textarea>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="etiqueta">Estado*:</label>
				<div class="controls">
					<input type="radio" class="required" name="estado" id="estado0" value="0" checked="checked">Pendiente
					<input type="radio" name="estado" id="estado2" value="2">Terminada
					<label class="error" for="estado"></label>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<input type='submit' class="btn btn-primary btn-mini" name="submit" id="submit" value="continuar">
					<input type="hidden" name="idtareas" value="<?php echo($_REQUEST['idtareas'])?>">
					<input type="hidden" name="guardar" value="1">
				</div>
			</div>
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
		$("#formulario_tareas").validate({
			submitHandler: function(form) {
				<?php encriptar_sqli("formulario_tareas",0,"form_info",$ruta_db_superior);?>
			    form.submit();
			    
			  }
		});
	});
	</script>
<?php
}
