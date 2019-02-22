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

require_once $ruta_db_superior . "controllers/autoload.php";

$idexpediente = $_REQUEST['idexpediente'];
$Expediente = new Expediente($idexpediente);
if (!$idexpediente || !$Expediente->isResponsable()) {
	return;
}

$params = [
	'responsable' => $Expediente->responsable,
	'baseUrl' => $ruta_db_superior
];

include_once $ruta_db_superior . 'assets/librerias.php';
echo validate();
echo select2();
?>
<form id="formularioExp" name="formularioExp" class="form-horizontal">
	<div class="form-group row">
		<label for="actual" class="col-md-4 control-label">Responsable actual</label>
		<div class="col-md-8">
			<input class="form-control" type="text" value="<?= $Expediente->getResponsable() ?>">
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
			<input type="hidden" id="idexpediente" name="idexpediente" value="<?= $idexpediente ?>">
			<button class="btn btn-complete" id="btnActualizar">Actualizar</button>
		</div>
	</div>
</form>

<script data-params='<?=json_encode($params)?>'></script>
<script src="<?= $ruta_db_superior ?>views/expediente/js/cambiar_responsable.js"></script>