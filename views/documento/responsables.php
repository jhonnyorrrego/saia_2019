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

$params = json_encode([
	'baseUrl' => $ruta_db_superior,
	'documentId' => $_REQUEST['documentId']
]);
include_once $ruta_db_superior . 'assets/librerias.php';
?>

<div class="row">
	<div class="col">
		<div class="form-group form-group-default form-group-default-select2 required">
			<label class="">Tipo de ruta</label>
			<select class="full-width" id="route_type">
				<option value="">Seleccione...</option>
				<option value="1">Radicación</option>
				<option value="2">Aprobación</option>
				<option value="3">Radicación / Aprobación</option>
			</select>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-12" id="radication_route_container" style="display:none">
		<table class="table table-condensed table-striped">
			<thead class="thead-light">
				<tr>
					<th class="text-center bold">Orden</th>
					<th class="text-center bold">Funcionario</th>
					<th class="text-center bold">Tipo firma</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-12" id="approbation_route_container" style="display:none">
		<table class="table table-condensed table-striped">
			<thead class="thead-light">
				<tr>
					<th class="text-center bold">Orden</th>
					<th class="text-center bold">Funcionario</th>
					<th class="text-center bold">Acción</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<?= select2() ?>
<script src="<?= $ruta_db_superior ?>views/documento/js/responsables.js" data-route='<?= $params ?>'></script>