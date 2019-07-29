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
include_once $ruta_db_superior . "assets/librerias.php";
?>
<?= select2() ?>
<?= dateTimePicker() ?>

<div class="container px-0">
	<form id="recurrence_form">
		<div class="row mx-0">
			<div class="col-12">
				<h5 class="bold text-complete mt-0">Recurrencia</h5>
			</div>
		</div>
		<div class="row mx-0">
			<div class="col-12">
				<div class="form-group form-group-default form-group-default-select2 required">
					<label class="">Repetir cada:</label>
					<select class="full-width select2" name="default_recurrence"></select>
				</div>
			</div>
		</div>
		<div class="row mx-0 py-1 d-none custom_option" id="recurrence_container">
			<div class="col-12 col-md-auto py-1">
				<span class="bold">Repetir cada &nbsp;&nbsp;</span>
			</div>
			<div class="col-12 col-md-auto py-1">
				<input type="number" name="unity" class="form-control d-inline" value="1">
			</div>
			<div class="col-12 col-md py-1">
				<select name="period" class="form-control d-inline select2 full-width">
					<option value="1">Días</option>
					<option value="2">Semanas</option>
					<option value="3">Meses</option>
					<option value="4">Años</option>
				</select>
			</div>
		</div>
		<div class="row mx-0 py-1 d-none custom_option" id="week_day_container">
			<div class="col-12">
				<div class="form-group">
					<span class="mt-1 bold">Repetir el</span>
					<div class="radio radio-complete ml-4 ml-md-0 mt-0">
						<input type="radio" value="1" name="week_day" id="Lu">
						<label class="d-block d-md-inline-block mb-0" for="Lu">Lunes</label>
						<input type="radio" value="2" name="week_day" id="Ma">
						<label class="d-block d-md-inline-block mb-0" for="Ma">Martes</label>
						<input type="radio" value="3" name="week_day" id="Mi">
						<label class="d-block d-md-inline-block mb-0" for="Mi">Miércoles</label>
						<input type="radio" value="4" name="week_day" id="Ju">
						<label class="d-block d-md-inline-block mb-0" for="Ju">Jueves</label>
						<input type="radio" value="5" name="week_day" id="Vi">
						<label class="d-block d-md-inline-block mb-0" for="Vi">Viernes</label>
						<input type="radio" value="6" name="week_day" id="Sa">
						<label class="d-block d-md-inline-block mb-0" for="Sa">Sábado</label>
						<input type="radio" value="7" name="week_day" id="Do">
						<label class="d-block d-md-inline-block mb-0" for="Do">Domingo</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row mx-0 d-none custom_option" id="month_option_container">
			<div class="col-12">
				<select class="full-width select2" name="month_day"></select>
			</div>
		</div>
		<div class="row mx-0 d-none pt-3" id="finish_container">
			<div class="col-12">
				<span class="bold">Terminar</span>
				<div class="radio radio-success my-1">
					<input type="radio" value="1" name="end" id="end_date" checked class="d-none">
					<label for="end_date" class="d-block mr-0">
						<div class="row d-flex align-items-end">
							<div class="col-auto pr-0">
								El &nbsp;
							</div>
							<div class="col pl-1 pr-0">
								<input type="text" name="end_date" class="d-inline form-control">
							</div>
						</div>
					</label>
					<input type="radio" value="2" name="end" id="end_after" class="d-none">
					<label for="end_after" class="d-block mr-0">
						<div class="row d-flex align-items-end">
							<div class="col-auto pr-0">
								Despues de
							</div>
							<div class="col px-1">
								<input type="number" name="iterations" class="d-inline form-control w-100" id="iterations" value="1">
							</div>
							<div class="col-auto pl-0">
								Ocurrencias
							</div>
						</div>
					</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<hr>
			</div>
		</div>
		<div class="row mx-0">
			<div class="col-12">
				<h5 class="bold text-complete">Notificación</h5>
			</div>
		</div>

		<div class="row">
			<div class="col-12" id="notification_items"></div>
		</div>
		<div class="row">
			<div class="col-12">
				<button class="btn btn-small btn-success">
					Crear Notificación
				</button>
			</div>
		</div>
		<script src="<?= $ruta_db_superior ?>views/tareas/js/recurrencia.js"></script>
	</form>
	<div class="row">
		<div class="col-12">
			<div class="btn btn-complete float-right" id="save_recurrence">Guardar</div>
		</div>
	</div>
</div>