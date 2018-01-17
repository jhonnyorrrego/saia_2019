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

$_REQUEST["iddoc"]=2;

$documento = busca_filtro_tabla("ejecutor,serie,iddocumento", "documento", "iddocumento=" . $_REQUEST["iddoc"], "", $conn);
if ($documento["numcampos"]) {
	if (is_object($documento[0]["fecha_creacion"])) {
		$fecha_creacion = $documento[0]["fecha_creacion"] -> format("Y-m-d");
	} else {
		$fecha_creacion = $documento[0]["fecha_creacion"];
	}
	$nom_creador = "";
	$creador = busca_filtro_tabla("nombres,apellidos", "funcionario", "funcionario_codigo=" . $documento[0]["ejecutor"], "", $conn);
	if ($creador["numcampos"]) {
		$nom_creador = $creador[0]["nombres"] . " " . $creador[0]["apellidos"];
	}
	$nom_serie = "";
	$serie = busca_filtro_tabla("nombre", "serie", "idserie=" . $documento[0]["serie"], "", $conn);
	if ($serie["numcampos"]) {
		$nom_serie = $serie[0]["nombre"];
	}
	$nom_expe = "";
	$expediente = busca_filtro_tabla("C.nombre", "expediente_doc B,expediente C", " B.expediente_idexpediente=C.idexpediente AND B.documento_iddocumento=" . $documento[0]["iddocumento"], "", $conn);
	if ($expediente["numcampos"]) {
		for ($i = 0; $i < $expediente["numcampos"]; $i++) {
			$nom_expe .= ($expediente[$i]["nombre"] . "<br/>");
		}
	}
} else {
	die();
}

echo(estilo_bootstrap());
echo(librerias_jquery("1.7"));
echo(librerias_validar_formulario('11'));
echo(librerias_datepicker_bootstrap());
echo (librerias_highslide());
?>
<div class="container">
	<legend>Informaci&oacute;n</legend>
	<br>
		<table align="center" style="width: 90%;" class="table table-bordered">
			<tr>
				<td><strong>Fecha de Creaci&oacute;n</strong></td>
				<td><?php echo($fecha_creacion); ?></td>
				<td><strong>Creado por</td>
				<td><?php echo($nom_creador); ?></td>
			</tr>
			<tr>
				<td><strong>&uacute;ltima modificaci&oacute;n</strong></td>
				<td>No se tiene esta informacion</td>
				<td><strong>Modificado por</strong></td>
				<td>No se tiene esta informacion</td>
			</tr>
			<tr>
				<td><strong>Tipo documental</strong></td>
				<td><?php echo($nom_serie); ?></td>
				<td><strong>Expedientes</strong></td>
				<td><?php echo($nom_expe); ?></td>
			</tr>
			<tr>
				<td><strong>Estado</strong></td>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td><strong>Descripci&oacute;n del documento</strong></td>
				<td colspan="3"><?php echo($documento[0]["descripcion"]); ?></td>
			</tr>			
		</table>
		
    <legend>Acciones</legend>
    <br>
		<form name="formulario_adicionar_ruta_aprobacion" id="formulario_adicionar_ruta_aprobacion" method="POST" action="librerias.php">
			<table align="center" style="width: 90%;" class="table table-bordered">
				<tr>
					<td colspan="2">
						<div class="control-group element">
							<label class="control-label" for="enviar_a">Enviar a * </label>
							<div class="controls"> 
								<a class="btn btn-mini btn-info highslide" href='adicionar_responsables.php?iddoc=<?php echo $_REQUEST["iddoc"];?>' onclick='return hs.htmlExpand(this, { objectType: "iframe",width:500, height:500,preserveContent:false } )'>Adicionar</a>
							</div>
						</div>
					</td>
				</tr>
				
				<tr>
					<td><strong>Aprobaci&oacute;n en:</strong></td>
					<td>
						<div class="control-group element">
							<label class="control-label" for="aprobacion_en"></label>
							<div class="controls">
								<input type="radio" name="aprobacion_en" id="aprobacion_en1" value="1" class="required" checked="true">Aprobaci&oacute;n en serie
								<input type="radio" name="aprobacion_en" id="aprobacion_en2" value="2">Aprobaci&oacute;n en paralelo
							</div>
						</div>
					</td>
				</tr>
				
				<tr>
					<td><strong>Fecha Vencimiento</strong></td>
					<td>
						<div class="control-group element">
							<div class="controls"> 
								<div id="fecha_vencimiento" class="input-append date">
									<input data-format="yyyy-MM-dd" type="text" name="fecha_vencimiento" readonly="true"/>
									<span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
								</div>
							</div>
						</div>
					</td>
				</tr>
				
				<tr>
					<td><strong>Asunto</strong></td>
					<td>
						<div class="control-group element">				
							<div class="controls"> 
								<input type="text" name="asunto" id="asunto" class="required">
							</div>        
						</div>
					</td>
				</tr>
				
				<tr>
					<td><strong>Descripci&oacute;n</strong></td>
					<td>
						<div class="controls"> 
							<textarea name="descripcion" id="descripcion"></textarea>
						</div>  
					</td>
				</tr>
				
				<tr>
					<td><strong>Anexos</strong></td>
					<td>
						<div class="control-group element">
							<div class="controls"> 
								<input type="file" name="anexos" id="anexos" multiple>
							</div>        
						</div> 
					</td>
				</tr>
				
				<tr>
					<td colspan="2" style="text-align: center">
						<input type="hidden" name="ejecutar_funcion" value="set_ruta_aprobacion">
						<input type="hidden" name="iddoc" value="<?php echo $_REQUEST["iddoc"];?>">
						<button class="btn btn-primary btn-mini" id="submit_formulario_adicionar_ruta_aprobacion">Aceptar</button>
					</td>
				</tr>
			</table>
		</form>
</div>

<script type='text/javascript'>
  hs.graphicsDir = '<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
  hs.outlineType = 'rounded-white';
	$(document).ready(function() {
		$('#fecha_vencimiento').datetimepicker({
			language : 'es',
			pick12HourFormat : true,
			pickTime : false
		});
		$('#formulario_adicionar_ruta_aprobacion').validate();
	});
</script>