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

$contenidoDefecto = json_encode('<div class="row">
<div class="col-md-12 px-0">
<table border="0" cellspacing="0" class="table table-condensed" style="text-align:left; width:100%">
	<tbody><tr>
  <td style="text-align:center;">{*logo_empresa*}</td>
  <td style="text-align:center;"><p><br />{*nombre_formato*}<br /><br />{*nombre_empresa*}</p></td>
  <td style="text-align:center;">{*formato_numero*}<br><br>{*fecha_creacion*}<br><br>Pagina {PAGENO}<br></td>
</tr>
</tbody>
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
								<label for="etiqueta_encabezado">Etiqueta
								</label> <br><input type="text" id="etiqueta_encabezado" name="etiqueta_encabezado" class="form-control">

							</div>
							<textarea name="editor_pie" id="editor_pie"></textarea>
							<script>
								var editor_pie = CKEDITOR.replace("editor_pie");
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
		CKEDITOR.instances.editor_pie.setData(<?php echo $contenidoDefecto ?>);
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
					editor_pie: {
						required: function() {
							CKEDITOR.instances.editor_pie.updateElement();
						},
						minlength: 1
					}
				}
			});
			if (formulario_encabezado.valid()) {
				var etiqueta = $("#etiqueta_encabezado").val();
				var contenido = CKEDITOR.instances['editor_pie'].getData();
				var id = $("#idencabezado").val();
				var datos = {
					ejecutar_libreria_encabezado: "actualizar_contenido_encabezado",
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
							top.successModalEvent(data.datos);
							top.notification({
								type: 'success',
								message: 'Pie creado'
							});
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