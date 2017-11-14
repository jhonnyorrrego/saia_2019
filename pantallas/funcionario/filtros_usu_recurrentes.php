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
include_once ($ruta_db_superior . "calendario/calendario.php");

echo(librerias_html5());
echo(librerias_jquery("1.7"));
echo(estilo_bootstrap());
echo(librerias_validar_formulario());
echo(librerias_arboles());
?>
<!DOCTYPE html>
<html>
	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<ul class="nav pull-left">
					<li>
						<button type="button" class="btn btn-primary btn-mini" id="ksubmit_saia" enlace="<?php echo $ruta_db_superior; ?>pantallas/busquedas/procesa_filtro_busqueda.php" titulo="Resultado">
							&nbsp;Buscar&nbsp;
						</button>
					</li>
					<li class="divider-vertical"></li>
				</ul>
			</div>
		</div>
		<br/>

		<div class="container master-container">
			<form accept-charset="UTF-8" id="kformulario_saia" method="post">
				<br />
				<table width="100%">
					<tr>
						<td>
						<div class="control-group">
							<label class="string required control-label"> <strong>Nombre</strong>
								<input type="hidden" name="bksaiacondicion_nombre_completo" id="bksaiacondicion_nombre_completo" value="like">
							</label>
							<div class="controls">
								<input id="bqsaia_nombre_completo" name="bqsaia_nombre_completo"  size="50" type="text">
							</div>
						</div>
						<div class="btn-group" data-toggle="buttons-radio" >
							<button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombre_completo',this.id)">
								Y
							</button>
							<button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombre_completo',this.id)">
								O
							</button>
							<input type="hidden" name="bqsaiaenlace_nombre_completo" id="bqsaiaenlace_nombre_completo" value="y" />
						</div>
						</td>

						<td>
						<div class="control-group">
							<label class="string required control-label"> <strong>Login</strong>
								<input type="hidden" name="bksaiacondicion_login" id="bksaiacondicion_login" value="=">
							</label>
							<div class="controls">
								<input id="bqsaia_login" name="bqsaia_login"  size="50" type="text">
							</div>
						</div>
						<!--div class="btn-group" data-toggle="buttons-radio" >
							<button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_login',this.id)">
								Y
							</button>
							<button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_login',this.id)">
								O
							</button>
							<input type="hidden" name="bqsaiaenlace_login" id="bqsaiaenlace_login" value="y" />
						</div>
						<br-->
						</td>

					</tr>

					<tr>
						<td colspan="2">
						<input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>">
						<input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</body>
	<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
</html>