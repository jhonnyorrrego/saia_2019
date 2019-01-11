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
echo(librerias_arboles());

function select_tipo_plan($campo) {
	global $conn;
	$estados = busca_filtro_tabla("cf.valor", "formato f,campos_formato cf", "cf.formato_idformato=f.idformato and cf.nombre='" . $campo . "' and f.nombre='plan_mejoramiento'", "", $conn);
	$tipos = str_replace("&", "", str_replace("acute;", "", $estados[0][0]));
	$campos_estado = explode(";", $tipos);
	$html = "<option value=''>Seleccione</option>";
	for ($i = 0; $i < count($campos_estado); $i++) {
		$valor = explode(",", $campos_estado[$i]);
		$html .= "<option value='" . $valor[0] . "'>" . $valor[1] . "</option>";
	}
	return ($html);
}
$tipo_plan = select_tipo_plan("tipo_plan");

$perm = new PERMISO();
$ok = $perm -> acceso_modulo_perfil("reporte_plan_mejoramiento_admin");
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
							<label class="string required control-label"> <strong>Fecha Suscripci&oacute;n</strong>
								<input type="hidden" name="bksaiacondicion_fecha_suscripcion_x" id="bksaiacondicion_fecha_suscripcion_x" value=">=">
							</label>
							<div class="controls">
								<input id="bqsaia_fecha_suscripcion_x" name="bqsaia_fecha_suscripcion_x" style="width:100px" type="text" value="" placeholder="Inicio">
								<?php selector_fecha("bqsaia_fecha_suscripcion_x", "kformulario_saia", "Y-m-d", date("m"), date("Y"), "default.css", "../../", ""); ?>
								&nbsp;&nbsp;y&nbsp;&nbsp;
								<input type="hidden" name="bksaiacondicion_fecha_suscripcion_y" id="bksaiacondicion_fecha_suscripcion_y" value="<=">
								<input id="bqsaia_fecha_suscripcion_y" name="bqsaia_fecha_suscripcion_y" style="width:100px" type="text" value="" placeholder="Fin">
								<?php selector_fecha("bqsaia_fecha_suscripcion_y", "kformulario_saia", "Y-m-d", date("m"), date("Y"), "default.css", "../../", ""); ?>
							</div>
						</div>
						<div class="btn-group" data-toggle="buttons-radio" >
							<button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_suscripcion',this.id)">
								Y
							</button>
							<button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_suscripcion',this.id)">
								O
							</button>
							<input type="hidden" name="bqsaiaenlace_fecha_suscripcion" id="bqsaiaenlace_fecha_suscripcion" value="y" />
						</div>
						<br />
						</td>
					</tr>

					<tr>
						<td>
						<div class="control-group">
							<label class="string required control-label"> <strong>Recepci&oacute;n Informe Final</strong>
								<input type="hidden" name="bksaiacondicion_fecha_informe_x" id="bksaiacondicion_fecha_informe_x" value=">=">
							</label>
							<div class="controls">
								<input id="bqsaia_fecha_informe_x" name="bqsaia_fecha_informe_x" style="width:100px" type="text" value="" placeholder="Inicio">
								<?php selector_fecha("bqsaia_fecha_informe_x", "kformulario_saia", "Y-m-d", date("m"), date("Y"), "default.css", "../../", ""); ?>
								&nbsp;&nbsp;y&nbsp;&nbsp;
								<input type="hidden" name="bksaiacondicion_fecha_informe_y" id="bksaiacondicion_fecha_informe_y" value="<=">
								<input id="bqsaia_fecha_informe_y" name="bqsaia_fecha_informe_y" style="width:100px" type="text" value="" placeholder="Fin">
								<?php selector_fecha("bqsaia_fecha_informe_y", "kformulario_saia", "Y-m-d", date("m"), date("Y"), "default.css", "../../", ""); ?>
							</div>
						</div>
						<div class="btn-group" data-toggle="buttons-radio" >
							<button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_informe',this.id)">
								Y
							</button>
							<button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_informe',this.id)">
								O
							</button>
							<input type="hidden" name="bqsaiaenlace_fecha_informe" id="bqsaiaenlace_fecha_informe" value="y" />
						</div>
						<br />
						</td>

						<td>
						<div class="control-group">
							<label class="string required control-label"> <strong>Periodo Evaluado</strong>
								<input type="hidden" name="bksaiacondicion_periodo_evaluado" id="bksaiacondicion_periodo_evaluado" value="like">
							</label>
							<div class="controls">
								<input id="bqsaia_periodo_evaluado" name="bqsaia_periodo_evaluado"  size="50" type="text">
							</div>
						</div>
						<div class="btn-group" data-toggle="buttons-radio" >
							<button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_periodo_evaluado',this.id)">
								Y
							</button>
							<button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_periodo_evaluado',this.id)">
								O
							</button>
							<input type="hidden" name="bqsaiaenlace_periodo_evaluado" id="bqsaiaenlace_periodo_evaluado" value="y" />
						</div>
						<br>
						</td>
					</tr>

					<tr>
						<td>
						<div class="control-group">
							<label class="string required control-label"> <strong>Tipo Plan</strong>
								<input type="hidden" name="bksaiacondicion_tipo_plan" id="bksaiacondicion_tipo_plan" value="=">
							</label>
							<div class="controls">
								<select id="bqsaia_tipo_plan" name="bqsaia_tipo_plan">
								<?php echo $tipo_plan;?>
								</select>
							</div>
						</div>
						<div class="btn-group" data-toggle="buttons-radio" >
							<button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_plan',this.id)">
								Y
							</button>
							<button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_plan',this.id)">
								O
							</button>
							<input type="hidden" name="bqsaiaenlace_tipo_plan" id="bqsaiaenlace_tipo_plan" value="y" />
						</div>
						<br>
						</td>
						<?php
						if($ok){
							?>
							<td>
							<div class="control-group">
								<label class="string required control-label"> <strong>Planes de Mejoramiento:</strong>
									<input type="hidden" name="bksaiacondicion_ejecutor" id="bksaiacondicion_ejecutor" value="=">
								</label>
								<div class="controls">
									<select id="bqsaia_ejecutor" name="bqsaia_ejecutor">
										<option value="">De todos</option>
										<option value="<?php echo $_SESSION["usuario_actual"];?>">Propios</option>
									</select>
								</div>
							</div>
							<!--div class="btn-group" data-toggle="buttons-radio">
								<button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ejecutor',this.id)">
									Y
								</button>
								<button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ejecutor',this.id)">
									O
								</button>
								<input type="hidden" name="bqsaiaenlace_ejecutor" id="bqsaiaenlace_ejecutor" value="y" />
							</div>
							<br!-->
							</td>
							<?php
						}else{
							?>
							<td>&nbsp;</td>
							<?php
						}
						?>
					</tr>

					<tr>
						<td colspan="2">
						<input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>">
						<input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
						<input type="hidden" name="bqtipodato" value="date|fecha_informe_x,fecha_informe_y,fecha_suscripcion_x,fecha_suscripcion_y">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</body>
	<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
</html>