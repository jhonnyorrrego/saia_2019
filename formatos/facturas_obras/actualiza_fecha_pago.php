<?php
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
include_once ($ruta_db_superior . "assets/librerias.php");
echo(bootstrap());

$idfun = usuario_actual("idfuncionario");
if (isset($_POST["ok"]) && isset($_POST["fecha_pago"]) && isset($_POST["iddoc"])) {
	$update = "UPDATE ft_facturas_obras SET fecha_pago=" . fecha_db_almacenar($_POST["fecha_pago"], "Y-m-d H:i:s") . ",func_fecha_pago=" . $idfun . ",fecha_accion_pago=" . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . " WHERE documento_iddocumento=" . $_POST["iddoc"];
	phpmkr_query($update) or die("Error al actualizar, comuniquese con el administrador");
	?>
	<script>
		window.parent.hs.close();
	</script>
	<?php
}
?>

<form method="POST">
	<table class="table" style="border-collapse: collapse;width: 100%" border="1">
		<thead>
			<tr>
				<td style="text-align: center;font-weight:bold;">FECHA PAGO</td>
			</tr>
		</thead>
		<tr>
			<td>
			<input type="date" name="fecha_pago" placeholder="YYYY-MM-DD" maxlength="10">
			</td>
		</tr>
		<tr>
			<td style="text-align: center">
			<input type="hidden" name="iddoc" value="<?php echo $_REQUEST["iddoc"]; ?>" />
			<input type="hidden" name="idformato" value="<?php echo $_REQUEST["idformato"]; ?>" />
			<input type="hidden" name="ok" value="1"/>
			<input class="btn btn-mini" type="submit" value="Guardar" />
			</td>
		</tr>
	</table>
</form>