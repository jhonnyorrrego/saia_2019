<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once($ruta_db_superior . "db.php");
include_once($ruta_db_superior . "assets/librerias.php");
echo (bootstrap());
echo (librerias_arboles());
echo (jquery());

if (isset($_REQUEST['aprobar'])) {
	$iddocs = explode(",", $_REQUEST['iddocs']);

	foreach ($iddocs as $value) {
		$idft = busca_filtro_tabla("idft_radicacion_facturas", "ft_radicacion_facturas", "documento_iddocumento=" . $value, "", $con);
		$dependencia = busca_filtro_tabla("iddependencia_cargo", "vfuncionario_dc", "estado=1 and estado_dc=1 and cargo like 'Aprobador Tesoreria' and funcionario_codigo=" . SessionController::getValue('usuario_actual'), "");

		$insert = "insert into ft_item_aprobaciones (ft_radicacion_facturas,fecha_aprobacion,dependencia,accion,observaciones) values (" . $idft[0]['idft_radicacion_facturas'] . "," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . "," . $dependencia[0]['iddependencia_cargo'] . ",'pagada','" . $_REQUEST['observaciones'] . "')";
		phpmkr_query($insert);

		$update = "update ft_radicacion_facturas set estado='5' where documento_iddocumento=" . $value;
		phpmkr_query($update);
	}

	echo "<script>
	        window.parent.hs.close();
	        window.parent.location.reload();
		</script>";
}
?>
<br />
<form role="form">
	<div class="form-group">
		<div>
			<label for="ejemplo_email_3">Observaciones:</label>
			<textarea rows="3" id="observaciones" name="observaciones"></textarea>
		</div>
		<div class="form-group">
			<div class="col-lg-offset-2 col-lg-10">
				<button type="submit" id="aprobar" name="aprobar" class="btn btn-primary">APROBAR</button>
				<input type="hidden" name="iddocs" value="<?php echo $_REQUEST['iddocs']; ?>">
			</div>
		</div>
	</div>
</form>