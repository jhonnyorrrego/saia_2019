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

echo(librerias_jquery("1.7"));
echo(estilo_bootstrap());
?>
<!DOCTYPE html>
<html>
	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<ul class="nav pull-left">
					<li>
						<button type="button" class="btn btn-primary btn-mini" id="ksubmit_saia" enlace="<?php echo $ruta_db_superior; ?>pantallas/busquedas/procesa_filtro_busqueda.php?idbusqueda_componente=224" titulo="Resultado">
							&nbsp;Buscar&nbsp;
						</button>
					</li>
					<li class="divider-vertical"></li>
				</ul>
			</div>
		</div>

		<div class="container master-container">
			<form accept-charset="UTF-8" id="kformulario_saia" method="post">
				<legend>
					Filtrar Expediente
				</legend>

				<div class="control-group">
					<label class="string required control-label" for="estado_archivo"> <b>Archivo</b>
						<input type="hidden" name="bksaiacondicion_estado_archivo" id="bksaiacondicion_estado_archivo" value="=">
					</label>
					<div class="controls">
						<input id="bqsaia_estado_archivo" name="bqsaia_estado_archivo" size="50" type="radio" value="1">
						Gestion
						<input id="bqsaia_estado_archivo" name="bqsaia_estado_archivo" size="50" type="radio" value="2">
						Central
						<input id="bqsaia_estado_archivo" name="bqsaia_estado_archivo" size="50" type="radio" value="3">
						Historico
					</div>
				</div>

				<input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>">
				<input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">

			</form>
		</div>
	</body>
</html>
<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
<script>
	$(document).keypress(function(event) {
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if (keycode == '13') {
			$("#ksubmit_saia").click();
		}
	}); 
</script>