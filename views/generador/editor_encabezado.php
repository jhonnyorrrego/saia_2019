<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
	if (is_file($ruta . 'db.php')) {
		$ruta_db_superior = $ruta;
	}

	$ruta .= '../';
	$max_salida--;
}
include_once $ruta_db_superior . 'core/autoload.php';
include_once $ruta_db_superior . 'assets/librerias.php';

if (isset($_REQUEST['idencabezado'])) {
	$idencabezado = $_REQUEST['idencabezado'];
}

if (isset($_REQUEST['idpie'])) {
	$idencabezado = $_REQUEST['idpie'];
}
$encabezados = busca_filtro_tabla("", "encabezado_formato", "idencabezado_formato=" . $idencabezado, "etiqueta", $conn);
$contenido_enc = $encabezados[0]["contenido"];
$etiqueta_enc = $encabezados[0]["etiqueta"];

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<?= validate() ?>
	<?= ckeditor() ?>
</head>

<body>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="">
				<div class="">
					<div class="">
						<div class="" id="pantalla_editar_encabezado">
							<br>
							<form name="formulario_editor_encabezado" id="formulario_editor_encabezado" action="">
								<input type="hidden" name="idencabezado" id="idencabezado" value="<?= $idencabezado ?>">
								<input type="hidden" name="accion_encab" id="accion_encabezado" value="1"></input>
								<div id="div_etiqueta_encabezado" class="form-group">
									<label for="etiqueta_encabezado">Etiqueta<br></label>
									<input type="text" id="etiqueta_encabezado" name="etiqueta_encabezado" style="border:1px solid rgba(0, 0, 0, 0.1);color:#626262;" value="<?php echo $etiqueta_enc; ?>" class="form-control"></input>
								</div>
								<textarea name="editor_encabezado" id="editor_encabezado">
									<?= $idencabezado ? $contenido_enc : '' ?>
	                  			</textarea>
							</form>
							<br>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(function() {
			var editor_encabezado = CKEDITOR.replace("editor_encabezado");

			$(document).off("click", "#btn_success").on("click", "#btn_success", function(e) {
				var formulario_encabezado = $("#formulario_editor_encabezado");
				formulario_encabezado.validate({
					ignore: [],
					debug: false,
					rules: {
						"etiqueta_encabezado": {
							required: true,
							minlength: 1
						},
						editor_encabezado: {
							required: function() {
								CKEDITOR.instances.editor_encabezado.updateElement();
							},
							minlength: 1
						}
					}
				});
				if (formulario_encabezado.valid()) {
					var etiqueta = $("#etiqueta_encabezado").val();
					var contenido = CKEDITOR.instances['editor_encabezado'].getData();

					$.post(
						"<?= $ruta_db_superior ?>app/generador/actualizar_contenido_encabezado.php", {
							key: localStorage.getItem('key'),
							token: localStorage.getItem('token'),
							idencabezado: $("#idencabezado").val(),
							etiqueta: etiqueta,
							contenido: contenido
						},
						function(response) {
							if (response.success) {
								top.notification({
									type: 'success',
									message: 'Encabezado modificado'
								});
								top.successModalEvent();
							} else {
								top.notification({
									type: 'error',
									message: response.message
								});
							}
						},
						'json'
					);
				}
			});
		});
	</script>
</body>

</html>