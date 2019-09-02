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

echo validate();

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
</head>

<body>

	<script src="<?= $ruta_db_superior ?>js/ckeditor/4.11/ckeditor_cust/ckeditor.js"></script>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="">
				<div class="">

					<div class="">
						<div class="" id="pantalla_editar_encabezado">
							<br>
							<form name="formulario_editor_encabezado" id="formulario_editor_encabezado" action="">
								<input type="hidden" name="idencabezado" id="idencabezado" value="<?php echo $idencabezado; ?>"></input>
								<input type="hidden" name="accion_encab" id="accion_encabezado" value="1"></input>
								<div id="div_etiqueta_encabezado" class="form-group">
									<label for="etiqueta_encabezado">Etiqueta<br>
									</label>
									<input type="text" id="etiqueta_encabezado" name="etiqueta_encabezado" style="border:1px solid rgba(0, 0, 0, 0.1);color:#626262;" value="<?php echo $etiqueta_enc; ?>" class="form-control"></input>

								</div>
								<textarea name="editor_encabezado" id="editor_encabezado">
                  			<?php
								if ($idencabezado) {
									echo $contenido_enc;
								}
								?>
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
					//var editor = tinymce.get('editor_encabezado');
					var etiqueta = $("#etiqueta_encabezado").val();
					//var contenido = editor.getContent();
					var contenido = CKEDITOR.instances['editor_encabezado'].getData();
					var id = $("#idencabezado").val();

					var datos = {
						ejecutar_libreria_encabezado: "actualizar_contenido_encabezado",
						idencabezado: id,
						rand: Math.round(Math.random() * 100000),
						etiqueta: etiqueta,
						contenido: contenido,
						tipo_retorno: 1
					};
					$.ajax({
						type: 'POST',
						dataType: "json",
						url: "<?php echo ($ruta_db_superior); ?>pantallas/generador/librerias_formato.php",
						data: datos,
						success: function(data) {
							if (data.exito == 1) {
								top.notification({
									type: 'success',
									message: 'Encabezado creado'
								});
								top.successModalEvent(data.datos);
								top.closeTopModal();
							} else {
								top.notification({
									type: 'error',
									message: 'Error'
								});
							}
						}
					});
				}
			});
		});
	</script>
</body>

</html>