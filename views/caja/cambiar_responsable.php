<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}

require_once $ruta_db_superior . "core/autoload.php";

$idcaja = $_REQUEST['idcaja'];
$Caja = new Caja($idcaja);
if (!$idcaja || !$Caja->isResponsable()) {
	return;
}

$params = [
	'responsable' => $Caja->responsable,
	'baseUrl' => $ruta_db_superior
];
?>
<form id="formularioCaja" name="formularioCaja" class="form-horizontal">
	<div class="form-group row">
		<label for="actual" class="col-md-4 control-label">Responsable actual</label>
		<div class="col-md-8">
			<input class="form-control" type="text" value="<?= $Caja->getResponsable() ?>">
		</div>
	</div>

	<div class="form-group row">
		<label for="responsable" class="col-md-4 control-label">Nuevo responsable</label>
		<div class="col-md-8">
			<select class="form-control" id="newResponsable" multiple="multiple" name="newResponsable" placeholder="Nombre del funcionario"></select>
		</div>
	</div><br>
	
	<div class="row">
		<div class="col-md-12">
			<input type="hidden" id="idcaja" name="idcaja" value="<?= $idcaja ?>">
			<button class="btn btn-complete" id="btnActualizar">Actualizar</button>
		</div>
	</div>
</form>
<script id="scriptResponsableCaja" src="<?= $ruta_db_superior ?>views/caja/js/cambiar_responsable.js" data-params='<?=json_encode($params)?>'></script>