<?php
@set_time_limit(0);
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once($ruta_db_superior."calendario/calendario.php");
include_once ($ruta_db_superior . "librerias_saia.php");
echo(librerias_html5());
echo(librerias_jquery("1.7"));
echo(librerias_arboles());
echo(estilo_bootstrap()); 
echo(librerias_notificaciones());

if (@$_REQUEST['guardar']) {
	
	if (@$_REQUEST['tiempo_cumplimiento']!='') {
		$sql_update="UPDATE ft_hallazgo SET tiempo_cumplimiento=".fecha_db_almacenar(@$_REQUEST['tiempo_cumplimiento'],"Y-m-d")." WHERE documento_iddocumento=".@$_REQUEST['iddoc'];
		//print_r($sql_update);die();
		phpmkr_query($sql_update);
		?>
		<script>
			notificacion_saia('Tiempo Cumplimento actualizado','success','',4000);
			window.parent.location = "<?php echo($ruta_db_superior); ?>formatos/hallazgo/mostrar_hallazgo.php?iddoc=<?php echo($_REQUEST['iddoc']); ?>";
		</script>
		<?php
	} else {
		?>
		<script>
			notificacion_saia('Se debe ingresar una fecha valida','error','',4000);
		</script>
		<?php
		crear_formulario_form_tiempo_cumplimiento();
	}

}else{
	crear_formulario_form_tiempo_cumplimiento();
}

function crear_formulario_form_tiempo_cumplimiento(){
	$iddoc=$_REQUEST['iddoc'];
	
	?>
		<html>
			<title>Tiempo Cumplimiento</title>
			
			<body>
				<form name="form_tiempo_cumplimiento" class="form-vertical" id="form_tiempo_cumplimiento" method="post" action="actualizar_tiempo_cumplimiento.php">
					<input type="hidden" value="<?php echo $iddoc;?>" name="iddoc" id="iddoc" />
					
					<br /><br />
					<h5>Tiempo Programado para Cumplimiento</h5>
					<div class="controls">
					<div class="input-append date" id="datepicker">
						<input class="required" id="tiempo_cumplimiento" name="tiempo_cumplimiento" style="width:100px" type="text" value="" placeholder="Inicio" readonly="true">
            <?php selector_fecha("tiempo_cumplimiento","form_tiempo_cumplimiento","Y-m-d",date("m"),date("Y"),"default.css","../../",""); ?>
					</div>
				</div>
				<input type="hidden" value="1" name="guardar"/>
				<button type="submit" class="btn btn-primary">Guardar</button>
				</form>
			</body>
		</html>
	<?php
}

?>