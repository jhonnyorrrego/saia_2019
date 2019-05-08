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
	'documentId' => $_REQUEST['documentId'],
	'number' => $_REQUEST['number']
]);
include_once $ruta_db_superior . 'assets/librerias.php';
?>
<div id="managers_container">
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
			<span class="text-complete float-right py-2 toggle_forms">
				<i class="fa fa-2x fa-plus-circle cursor"></i>
			</span>
			<table class="table table-striped">
				<thead class="thead-light">
					<tr>
						<th class="text-center bold">Orden</th>
						<th class="text-center bold">Funcionario</th>
						<th class="text-center bold">Tipo firma</th>
						<th class="text-center bold"></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-12" id="approbation_route_container" style="display:none">
			<div class="py-2">
				<div class="form-group float-left pl-2">
					<label class="pl-1 mb-0 mt-1">Flujo de Aprobación</label>
					<div class="radio radio-success my-0">
						<input type="radio" value="1" name="flow" id="serie" checked>
						<label for="serie">Serie</label>
						<input type="radio" value="0" name="flow" id="parallel">
						<label for="parallel">Paralelo</label>
					</div>
				</div>

				<span class="text-complete float-right py-2 toggle_forms">
					<i class="fa fa-2x fa-plus-circle cursor"></i>
				</span>
			</div>
			<table class="table table-striped">
				<thead class="thead-light">
					<tr>
						<th class="text-center bold">Orden</th>
						<th class="text-center bold">Funcionario</th>
						<th class="text-center bold">Acción</th>
						<th class="text-center bold"></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
	<div class="row pt-3">
		<div class="col-12 text-right">
			<button class="btn btn-complete" id="save_routes">Guardar</button>
		</div>
	</div>
</div>
<div id="item_form_container" style="display:none">
	<div class="row">
		<div class="col">
			<div class="form-group form-group-default form-group-default-select2 required">
				<label class="">Responsable</label>
				<select class="full-width" id="manager" multiple></select>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col">

			<div id="firm_type_container" class="form-group form-group-default form-group-default-select2 required">
				<label class="">Tipo firma</label>
				<select class="full-width" multiple id="firm_type_select">
					<option value="3">Visto bueno - oculto</option>
					<option value="2">Visto bueno - visible</option>
					<option value="0">Firma oculta</option>
					<option value="1">Firma visible</option>
					<option value="4">Firma manual</option>
					<option value="5">Firma externa</option>
				</select>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col">
			<div id="action_type_container" class="form-group form-group-default form-group-default-select2 required">
				<label class="">Acción</label>
				<select class="full-width" multiple id="action_type_select">
					<option value="1">Visto bueno</option>
					<option value="2">Aprobar</option>
				</select>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col text-right">
			<button class="btn btn-danger toggle_forms">Cancelar</button>
			<button class="btn btn-complete" id="save_item">Guardar</button>
		</div>
	</div>
</div>
<?= select2() ?>
<script src="<?= $ruta_db_superior ?>views/documento/js/responsables.js" data-route='<?= $params ?>'></script>