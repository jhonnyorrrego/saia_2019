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

$est_check = array(
	1 => "",
	0 => ""
);

$id = 0;
$accion = "add_plantilla_word";
$nombre = "";
$descrip = "";
$ruta_anexo = "";
$estado = 1;

if (isset($_REQUEST["idplantilla_word"])) {
	if ($_REQUEST["idplantilla_word"] != 0) {
		$datos = busca_filtro_tabla("", "plantilla_word", "idplantilla_word=" . $_REQUEST["idplantilla_word"], "", $conn);
		if ($datos["numcampos"]) {
			$accion = "edit_plantilla_word";
			$id = $datos[0]["idplantilla_word"];
			$nombre = $datos[0]["nombre"];
			$descrip = $datos[0]["descripcion"];
			$ruta_anexo = base64_encode($datos[0]["ruta_anexo"]);
			$estado = $datos[0]["estado"];
		}
	}
}
$est_check[$estado] = 'checked';

$option = '<option value="">Seleccione</option>';
$cons_contador = busca_filtro_tabla("idcontador,nombre", "contador", "", "nombre asc", $conn);
if ($cons_contador["numcampos"]) {
	for ($i = 0; $i < $cons_contador["numcampos"]; $i++) {
		if ($cons_contador[$i]["idcontador"] == $contador) {
			$option .= '<option value="' . $cons_contador[$i]["idcontador"] . '" selected>' . $cons_contador[$i]["nombre"] . '</option>';
		} else {
			$option .= '<option value="' . $cons_contador[$i]["idcontador"] . '">' . $cons_contador[$i]["nombre"] . '</option>';
		}
	}
}

include_once ($ruta_db_superior . "librerias_saia.php");
echo estilo_bootstrap();
echo librerias_jquery("1.7");
echo librerias_validar_formulario("11");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	</head>
	<body>
		<div class="container">
			<form id="formulario" name="formulario" method="post" action="ejecutar_acciones.php" enctype="multipart/form-data">
				<table class="table table-bordered" style="margin: 20px;">
					<tbody>
						<tr>
							<td><strong>NOMBRE</strong></td>
							<td>
							<input type="text" name="nombre" id="nombre" placeholder="Nombre Plantilla" value="<?php echo $nombre; ?>" >
							</td>
						</tr>
						<tr>
							<td><strong>DESCRIPCI&Oacute;N</strong></td>
							<td>							<textarea name="descripcion" id="descripcion" style="width: 500px; height: 150px;"><?php echo $descrip; ?></textarea></td>
						</tr>
						<tr>
							<td><strong>PLANTILLA</strong></td>
							<td>
							<input type="file" id="anexo" name="anexo">
							</td>
						</tr>
						<tr>
							<td><strong>ESTADO</strong></td>
							<td>
							<input type="radio" name="estado" <?php echo $est_check[1]; ?> value="1">
							SI
							<input type="radio" name="estado" <?php echo $est_check[0]; ?> value="0">
							NO</td>
						</tr>
						<tr>
							<td colspan="2">
							<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
							<input type="hidden" name="ruta_anexo" id="ruta_anexo" value="<?php echo $ruta_anexo; ?>" />
							<input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>" />
							<input type="submit" value="Guardar" class="btn btn-mini btn-primary">
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
		<script src="<?php echo $ruta_db_superior; ?>js/additional-methods.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#formulario").validate({
					rules : {
						nombre : {
							required : true
						},
						anexo : {
							required : true,
							extension : "xls|xlsx|doc|docx"
						}
					},
					messages : {
						nombre : "Por favor ingrese el nombre",
						anexo : {
							required : "Por favor ingrese la plantilla",
							extension : "Extensi&oacute;n no valida (xls|xlsx|doc|docx)"
						}
					}
				});
			});
		</script>
	</body>
</html>
