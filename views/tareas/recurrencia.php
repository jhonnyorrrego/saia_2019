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

<div class="container">
	<form id="recurrence_form">
		<div class="row mx-0">
			<div class="col-12">
				<h5 class="bold text-complete">Recurrencia</h5>
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
			<div class="col-12">
				Repetir cada &nbsp;&nbsp;
				<input type="number" name="unity" class="form-control d-inline" style="width:100px" value="1">
				<select name="period" class="form-control d-inline select2" style="width:100px">
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
					<label class="pl-1 mb-0 mt-1">Repetir el</label>
					<div class="radio radio-complete">
						<input type="radio" value="1" name="week_day" id="Lu">
						<label for="Lu">Lunes</label>
						<input type="radio" value="2" name="week_day" id="Ma">
						<label for="Ma">Martes</label>
						<input type="radio" value="3" name="week_day" id="Mi">
						<label for="Mi">Miércoles</label>
						<input type="radio" value="4" name="week_day" id="Ju">
						<label for="Ju">Jueves</label>
						<input type="radio" value="5" name="week_day" id="Vi">
						<label for="Vi">Viernes</label>
						<input type="radio" value="6" name="week_day" id="Sa">
						<label for="Sa">Sábado</label>
						<input type="radio" value="7" name="week_day" id="Do">
						<label for="Do">Domingo</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row mx-0 py-1 d-none custom_option" id="month_option_container">
			<div class="col-12">
				<select class="full-width select2" name="month_day"></select>
			</div>
		</div>
		<div class="row mx-0">
			<div class="col-12">
				<label class="pl-1 mb-0 mt-1">Terminar</label>
				<div class="radio radio-success my-0">
					<input type="radio" value="1" name="end" id="end_date" checked>
					<label for="end_date" class="d-block my-0 py-0">
						El &nbsp;
						<input type="text" name="end_date" class="d-inline form-control" style="width:300px">
					</label>
					<input type="radio" value="2" name="end" id="end_after">
					<label for="end_after" class="d-block my-0 py-0">
						Despues de
						<input type="number" name="iterations" class="d-inline form-control" id="iterations" style="width:100px" value="1">
						Ocurrencias
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
		<script src="<?= $ruta_db_superior ?>views/tareas/js/recurrencia.js"></script>
	</form>
	<div class="row">
		<div class="col-12">
			<div class="btn btn-complete float-right" id="save_recurrence">Guardar</div>
		</div>
	</div>
</div>