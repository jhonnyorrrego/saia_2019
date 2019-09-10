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

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<?= validate() ?>
</head>

<body>
	<?php

	$contenidoDefecto = json_encode('<div class="row">
<div class="col-md-12 px-0">
<table border="0" cellspacing="0" class="table table-condensed" style="text-align:left; width:100%">
	<tbody>
  <td rowspan="3" style="text-align:center;">{*logo_empresa*}</td>
  <td style="text-align:center;">{*nombre_empresa*}</td>
  <td style="text-align:center;">{*formato_numero*}</td>
</tr>
<tr>
  <td style="text-align:center;">{*nombre_formato*}</td>
  <td style="text-align:center;">{*fecha_creacion*}</td>
</tr>
<tr>
  <td></td>
  <td style="text-align:center;">Pagina {PAGENO}</td>
</tr></tbody>
</table></div>
</div>');

	?>

	<script src="<?= $ruta_db_superior ?>js/ckeditor/4.11/ckeditor_cust/ckeditor.js"></script>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="">
				<div class="">
					<div class="">
						<div class="" id="pantalla_mostrar-tab">
							<br>
							<form name="formulario_encabezado" id="formulario_encabezado" action="">
								<div id="div_etiqueta_encabezado" class="form-group">
									<label for="etiqueta_encabezado">Etiqueta encabezado<br>

									</label><input type="text" id="etiqueta_encabezado" name="etiqueta_encabezado" class="form-control">
								</div>
								<textarea name="editor_encabezado_pie" id="editor_encabezado_pie"></textarea>
								<script>
									var editor_encabezado_pie = CKEDITOR.replace("editor_encabezado_pie");
								</script>
							</form>
							</select>
							<br>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(function() {
			CKEDITOR.instances.editor_encabezado_pie.setData(<?php echo $contenidoDefecto ?>);
			$(document).off("click", "#btn_success").on("click", "#btn_success", function(e) {
				var formulario_encabezado = $("#formulario_encabezado");
				formulario_encabezado.validate({
					ignore: [],
					debug: false,
					rules: {
						"etiqueta_encabezado": {
							required: true,
							minlength: 1
						},
						editor_encabezado_pie: {
							required: function() {
								CKEDITOR.instances.editor_encabezado_pie.updateElement();
							},
							minlength: 1
						}
					}
				});
				if (formulario_encabezado.valid()) {
					var etiqueta = $("#etiqueta_encabezado").val();
					var contenido = CKEDITOR.instances['editor_encabezado_pie'].getData();
					var id = $("#idencabezado").val();
					var datos = {
						ejecutar_libreria_encabezado: "actualizar_contenido_encabezado",
						rand: Math.round(Math.random() * 100000),
						etiqueta: etiqueta,
						contenido: contenido,
						tipo_retorno: 1
					};
					$.ajax({
						async: false,
						type: 'POST',
						dataType: "json",
						url: "<?php echo ($ruta_db_superior); ?>pantallas/generador/librerias_formato.php",
						data: datos,
						success: function(data) {
							if (data.exito == 1) {
								//$("#sel_encabezado", window.parent.document).attr("idencabezado", data.idInsertado);
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