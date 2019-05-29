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

include_once $ruta_db_superior . "assets/librerias.php";
include_once $ruta_db_superior . "librerias_saia.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>SGDA</title>
	<?= jquery() ?>
	<?= bootstrap() ?>
	<?= theme() ?>
	<?= icons() ?>
	<?= validate() ?>
	<?= librerias_arboles() ?>
</head>

<body>
	<div class="container-fluid p-3">
		<div class="row justify-content-md-center">
			<div class="col-12 col-md-4">
				<div class="card card-default mb-0">
					<div class="card-body py-2">
						<form method="POST" id="form_radicacion_rapida" action="<?= $ruta_db_superior ?>colilla.php">
							<input type="hidden" name="enlace" id="enlace" value="pantallas/buscador_principal.php?idbusqueda=7">
							<input type="hidden" name="enlace2" id="enlace2" value="formatos/radicacion_entrada/radicacion_rapida.php">

							<h5 class="bold">Generar Sello</h5>
							<p>Los campos con <span class="text-danger">*</span> son obligatorios</p>
							<div class="form-group form-group-default required">
								<label>Seleccione Tipo de Radicación:</label>
								<div id="esperando_serie">
									<img src="<?= $ruta_db_superior ?>imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_tree_equipos" class="arbol_saia"></div>
								<input type="hidden" id="generar_consecutivo" name="generar_consecutivo" class="required">
							</div>
							<div class="form-group form-group-default required">
								<label>Descripción General:</label>
								<input type="text" id="descripcion_general" class="required form-control" name="descripcion_general">
							</div>
							<div class="form-group">
								<label class="pl-1 mb-0 mt-1">Colilla</label>
								<div class="radio radio-success my-0">
									<input type="radio" name="colilla_vertical" checked value="1" id="vertical_radio">
									<label for="vertical_radio">Vertical</label>
									<input type="radio" name="colilla_vertical" value="0" id="horizontal_radio">
									<label for="horizontal_radio">Horizontal</label>
								</div>
							</div>
							<div class="form-group pt-3">
								<input class="btn btn-complete mx-1" type="submit" value="Radicar" id="enviar" name="enviar" />
								<input type="hidden" name="target" value="_self">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			var browserType;
			if (document.layers) {
				browserType = "nn4"
			}
			if (document.all) {
				browserType = "ie"
			}
			if (window.navigator.userAgent.toLowerCase().match("gecko")) {
				browserType = "gecko"
			}
			tree_equipos = new dhtmlXTreeObject("treeboxbox_tree_equipos", "100%", "100%", 0);
			tree_equipos.setImagePath("<?php echo $ruta_db_superior; ?>imgs/");
			tree_equipos.enableTreeImages("false");
			tree_equipos.enableIEImageFix(true);
			tree_equipos.setOnCheckHandler(onNodeSelect);
			tree_equipos.enableCheckBoxes(1);
			tree_equipos.enableRadioButtons(true);
			tree_equipos.setOnLoadingStart(cargando_serie);
			tree_equipos.setOnLoadingEnd(fin_cargando_serie);
			tree_equipos.setXMLAutoLoading("<?php echo ($ruta_db_superior); ?>formatos/radicacion_entrada/test_radicacion_rapida.php");
			tree_equipos.loadXML("<?php echo ($ruta_db_superior); ?>formatos/radicacion_entrada/test_radicacion_rapida.php");

			function onNodeSelect(nodeId) {
				if (nodeId.indexOf('#', 0) == -1) {
					$('#generar_consecutivo').val(nodeId);
					$('#enlace').val("views/documento/index_acordeon.php");

				}
			}

			function fin_cargando_serie() {
				if (browserType == "gecko")
					document.poppedLayer = eval('document.getElementById("esperando_serie")');
				else if (browserType == "ie")
					document.poppedLayer = eval('document.getElementById("esperando_serie")');
				else
					document.poppedLayer = eval('document.layers["esperando_serie"]');
				document.poppedLayer.style.visibility = "hidden";
				tree_equipos.openAllItems(0);
			}

			function cargando_serie() {
				if (browserType == "gecko")
					document.poppedLayer = eval('document.getElementById("esperando_serie")');
				else if (browserType == "ie")
					document.poppedLayer = eval('document.getElementById("esperando_serie")');
				else
					document.poppedLayer = eval('document.layers["esperando_serie"]');
				document.poppedLayer.style.visibility = "visible";
			}
			$("#form_radicacion_rapida").validate({
				ignore: []
			});
		});
	</script>
</body>

</html>