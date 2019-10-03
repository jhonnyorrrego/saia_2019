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
include_once ($ruta_db_superior . "assets/librerias.php");
include_once ($ruta_db_superior . "calendario/calendario.php");

echo(librerias_html5());
echo(jquery());
echo(bootstrap());
echo(librerias_validar_formulario());
echo(librerias_arboles());
 
$options='<option value="" selected>Seleccione...</option>';
$ventanillas=busca_filtro_tabla("idcf_ventanilla,valor","cf_ventanilla","estado=1","");
for($i=0;$i<$ventanillas['numcampos'];$i++){
	$options.='<option value="'.$ventanillas[$i]['idcf_ventanilla'].'">'.$ventanillas[$i]['valor'].'</option>';
}
?>

?>
<!DOCTYPE html>
<html>
	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<ul class="nav pull-left">
					<li>
						<button type="button" class="btn btn-primary btn-mini" id="ksubmit_saia" enlace="<?php echo $ruta_db_superior; ?>app/busquedas/procesa_filtro_busqueda.php" titulo="Resultado">
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
							<label class="string required control-label"> <strong>Fecha Radicaci&oacute;n</strong>
								<input type="hidden" name="bksaiacondicion_fecha_radicacion_x" id="bksaiacondicion_fecha_radicacion_x" value=">=">
							</label>
							<div class="controls">
								<input id="bqsaia_fecha_radicacion_x" name="bqsaia_fecha_radicacion_x" style="width:100px" type="text" value="" placeholder="Inicio">
								<?php selector_fecha("bqsaia_fecha_radicacion_x", "kformulario_saia", "Y-m-d", date("m"), date("Y"), "default.css", "../../", ""); ?>
								&nbsp;&nbsp;y&nbsp;&nbsp;
								<input type="hidden" name="bksaiacondicion_fecha_radicacion_y" id="bksaiacondicion_fecha_radicacion_y" value="<=">
								<input id="bqsaia_fecha_radicacion_y" name="bqsaia_fecha_radicacion_y" style="width:100px" type="text" value="" placeholder="Fin">
								<?php selector_fecha("bqsaia_fecha_radicacion_y", "kformulario_saia", "Y-m-d", date("m"), date("Y"), "default.css", "../../", ""); ?>
							</div>
						</div>
						<div class="btn-group" data-toggle="buttons-radio" >
							<button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_radicacion',this.id)">
								Y
							</button>
							<button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_radicacion',this.id)">
								O
							</button>
							<input type="hidden" name="bqsaiaenlace_fecha_radicacion" id="bqsaiaenlace_fecha_radicacion" value="y" />
						</div>
						<br />
						</td>
					</tr>

					<tr>
						<td>
						<div class="control-group">
							<label class="string required control-label"> <strong>N&uacute;mero Gu&iacute;a</strong>
								<input type="hidden" name="bksaiacondicion_numero_guia" id="bksaiacondicion_numero_guia" value="=">
							</label>
							<div class="controls">
								<input id="bqsaia_numero_guia" name="bqsaia_numero_guia"  size="50" type="text">
							</div>
						</div>
						<div class="btn-group" data-toggle="buttons-radio" >
							<button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_numero_guia',this.id)">
								Y
							</button>
							<button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_numero_guia',this.id)">
								O
							</button>
							<input type="hidden" name="bqsaiaenlace_numero_guia" id="bqsaiaenlace_numero_guia" value="y" />
						</div>
						<br>
						</td>

						<td>
						<div class="control-group">
							<label class="string required control-label"> <strong>Fecha Factura</strong>
								<input type="hidden" name="bksaiacondicion_fecha_factura_x" id="bksaiacondicion_fecha_factura_x" value=">=">
							</label>
							<div class="controls">
								<input id="bqsaia_fecha_factura_x" name="bqsaia_fecha_factura_x" style="width:100px" type="text" value="" placeholder="Inicio">
								<?php selector_fecha("bqsaia_fecha_factura_x", "kformulario_saia", "Y-m-d", date("m"), date("Y"), "default.css", "../../", ""); ?>
								&nbsp;&nbsp;y&nbsp;&nbsp;
								<input type="hidden" name="bksaiacondicion_fecha_factura_y" id="bksaiacondicion_fecha_factura_y" value="<=">
								<input id="bqsaia_fecha_factura_y" name="bqsaia_fecha_factura_y" style="width:100px" type="text" value="" placeholder="Fin">
								<?php selector_fecha("bqsaia_fecha_factura_y", "kformulario_saia", "Y-m-d", date("m"), date("Y"), "default.css", "../../", ""); ?>
							</div>
						</div>
						<div class="btn-group" data-toggle="buttons-radio" >
							<button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_factura',this.id)">
								Y
							</button>
							<button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_factura',this.id)">
								O
							</button>
							<input type="hidden" name="bqsaiaenlace_fecha" id="bqsaiaenlace_fecha_factura" value="y" />
						</div>
						<br />
						</td>
					</tr>

					<tr>
						<td>
						<div class="control-group">
							<label class="string required control-label"> <strong>N&uacute;mero Factura</strong>
								<input type="hidden" name="bksaiacondicion_numero_factura" id="bksaiacondicion_numero_factura" value="=">
							</label>
							<div class="controls">
								<input id="bqsaia_numero_factura" name="bqsaia_numero_factura"  size="50" type="text">
							</div>
						</div>
						<div class="btn-group" data-toggle="buttons-radio" >
							<button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_numero_factura',this.id)">
								Y
							</button>
							<button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_numero_factura',this.id)">
								O
							</button>
							<input type="hidden" name="bqsaiaenlace_numero_factura" id="bqsaiaenlace_numero_factura" value="y" />
						</div>
						<br>
						</td>

						<td>
						<div class="control-group">
							<label class="string required control-label"> <strong>Ventanilla</strong>
								<input type="hidden" name="bksaiacondicion_ventanilla_radicacion" id="bksaiacondicion_ventanilla_radicacion" value="=">
							</label>
							<div class="controls">
								<select id="bqsaia_ventanilla_radicacion" name="bqsaia_ventanilla_radicacion">
									<?php echo($options); ?>
								</select>
							</div>
						</div>
						<!--div class="btn-group" data-toggle="buttons-radio" >
							<button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ventanilla_radicacion',this.id)">
								Y
							</button>
							<button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ventanilla_radicacion',this.id)">
								O
							</button>
							<input type="hidden" name="bqsaiaenlace_ventanilla_radicacion" id="bqsaiaenlace_ventanilla_radicacion" value="y" />
						</div-->
						<br>
						</td>
					</tr>

					<tr>
						<td colspan="2">
						<input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>">
						<input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
						<input type="hidden" name="bqtipodato" value="date|fecha_radicacion_x,fecha_radicacion_y,fecha_factura_x,fecha_factura_y">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</body>
	<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
</html>