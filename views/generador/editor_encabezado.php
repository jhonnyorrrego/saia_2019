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
include_once $ruta_db_superior . 'assets/librerias.php';

$params = json_encode([
	'baseUrl' => $ruta_db_superior,
	'identificator' => $_REQUEST['identificator']
])

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
			<div class="col-12">
				<form name="form_header" id="form_header" action="">
					<input type="hidden" name="identificator" id="identificator">
					<div class="form-group">
						<label for="name">Etiqueta<br></label>
						<input type="text" id="name" name="name" class="form-control">
					</div>
					<textarea name="content" id="content"></textarea>
				</form>
			</div>
		</div>
	</div>

	<script src="<?= $ruta_db_superior ?>views/generador/js/editor_encabezado.js" id="script_edit_header" data-params='<?= $params ?>'></script>
</body>

</html>