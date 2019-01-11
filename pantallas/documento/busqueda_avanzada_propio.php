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

$formato = '<select id="bqsaia_plantilla" name="bqsaia_plantilla"><option value="">Seleccione</option>';
$datos_formato = busca_filtro_tabla("nombre,etiqueta", "formato", "item<>1", "etiqueta asc", $conn);
for ($i = 0; $i < $datos_formato["numcampos"]; $i++) {
	$formato .= '<option value="' . $datos_formato[$i]["nombre"] . '">' . $datos_formato[$i]["etiqueta"] . '</option>';
}
$formato .= '</select>';
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
							<label class="string required control-label"> <strong>N&uacute;mero Radicado</strong>
								<input type="hidden" name="bksaiacondicion_numero" id="bksaiacondicion_numero" value="=">
							</label>
							<div class="controls">
								<input id="bqsaia_numero" name="bqsaia_numero"  size="50" type="text">
							</div>
						</div>
						<div class="btn-group" data-toggle="buttons-radio" >
							<button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_numero',this.id)">
								Y
							</button>
							<button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_numero',this.id)">
								O
							</button>
							<input type="hidden" name="bqsaiaenlace_numero" id="bqsaiaenlace_numero" value="y" />
						</div>
						<br>
						</td>

						<td>
						<div class="control-group">
							<label class="string required control-label"> <strong>Fecha</strong>
								<input type="hidden" name="bksaiacondicion_a@fecha_x" id="bksaiacondicion_a@fecha_x" value=">=">
							</label>
							<div class="controls">
								<input id="bqsaia_fecha_x" name="bqsaia_a@fecha_x" style="width:100px" type="text" value="" placeholder="Inicio">
								<?php selector_fecha("bqsaia_fecha_x", "kformulario_saia", "Y-m-d", date("m"), date("Y"), "default.css", "../../", ""); ?>
								&nbsp;&nbsp;y&nbsp;&nbsp;
								<input type="hidden" name="bksaiacondicion_a@fecha_y" id="bksaiacondicion_fecha_y" value="<=">
								<input id="bqsaia_fecha_y" name="bqsaia_a@fecha_y" style="width:100px" type="text" value="" placeholder="Fin">
								<?php selector_fecha("bqsaia_fecha_y", "kformulario_saia", "Y-m-d", date("m"), date("Y"), "default.css", "../../", ""); ?>
							</div>
						</div>
						<div class="btn-group" data-toggle="buttons-radio" >
							<button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha',this.id)">
								Y
							</button>
							<button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha',this.id)">
								O
							</button>
							<input type="hidden" name="bqsaiaenlace_a@fecha" id="bqsaiaenlace_fecha" value="y" />
						</div>
						<br />
						</td>
					</tr>

					<tr>
						<td>
						<div class="control-group">
							<label class="string required control-label"> <strong>Asunto/descripci&oacute;n</strong>
								<input type="hidden" name="bksaiacondicion_descripcion" id="bksaiacondicion_descripcion" value="=">
							</label>
							<div class="controls">
								<input id="bqsaia_descripcion" name="bqsaia_descripcion"  size="50" type="text">
							</div>
						</div>
						<div class="btn-group" data-toggle="buttons-radio" >
							<button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_descripcion',this.id)">
								Y
							</button>
							<button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_descripcion',this.id)">
								O
							</button>
							<input type="hidden" name="bqsaiaenlace_descripcion" id="bqsaiaenlace_descripcion" value="y" />
						</div>
						<br>
						</td>

						<td>
						<div class="control-group">
							<label class="string required control-label"> <strong>Formato</strong>
								<input type="hidden" name="bksaiacondicion_plantilla" id="bksaiacondicion_plantilla" value="like">
							</label>
							<div class="controls">
								<?php echo $formato; ?>
							</div>
						</div><!--div class="btn-group" data-toggle="buttons-radio" >
						<button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_plantilla',this.id)">
						Y
						</button>
						<button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_plantilla',this.id)">
						O
						</button>
						<input type="hidden" name="bqsaiaenlace_plantilla" id="bqsaiaenlace_plantilla" value="y" />
						</div>
						<br--></td>
					</tr>

					<tr>
						<td colspan="2">
						<input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>">
						<input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
						<input type="hidden" name="bqtipodato" value="date|a@fecha_x,a@fecha_y">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</body>
	<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
</html>