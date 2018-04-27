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
echo(librerias_jquery("1.7"));
echo(estilo_bootstrap()); 
echo(librerias_notificaciones());

if (@$_REQUEST['guardar']) {
	if (@$_REQUEST['tiempo_cumplimiento']!='') {
		$sql_update="UPDATE ft_hallazgo SET tiempo_cumplimiento=".fecha_db_almacenar(@$_REQUEST['tiempo_cumplimiento'],"Y-m-d")." WHERE documento_iddocumento=".@$_REQUEST['iddoc'];
		phpmkr_query($sql_update);
		notificaciones("Tiempo Cumplimento actualizado","success");
		?>
		<script>
			window.parent.location = "<?php echo($ruta_db_superior); ?>formatos/hallazgo/mostrar_hallazgo.php?iddoc=<?php echo($_REQUEST['iddoc']); ?>";
		</script>
		<?php
		} else {
			notificaciones("Se debe ingresar una fecha valida");
		}
}
$iddoc=$_REQUEST['iddoc'];
?>

<html>
	<title>Tiempo Cumplimiento</title>
	<body>
		<form name="form_tiempo_cumplimiento" class="form-vertical" id="form_tiempo_cumplimiento" method="post" action="actualizar_tiempo_cumplimiento.php">
			<table class="table table-bordered">
				<tr>
					<td style="text-align: center;font-weight: bold;">TIEMPO PROGRAMADO PARA CUMPLIMIENTO</td>
				</tr>
				<tr>
					<td>
						<div class="input-append date" id="datepicker">
							<input class="required" id="tiempo_cumplimiento" name="tiempo_cumplimiento" type="text" value="" placeholder="Inicio" readonly="true">
							<?php selector_fecha("tiempo_cumplimiento", "form_tiempo_cumplimiento", "Y-m-d", date("m"), date("Y"), "default.css", "../../", ""); ?>
						</div>
					</td>
				</tr>
				<tr>
					<td style="text-align: center;">
						<input type="hidden" value="<?php echo $iddoc; ?>" name="iddoc" id="iddoc" />
						<input type="submit" value="Guardar" name="Guardar" class="btn btn-primary"/>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>
