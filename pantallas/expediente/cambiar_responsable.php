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
			<select class="form-control" id="responsable" multiple="multiple" name="responsable" placeholder="Nombre del funcionario"></select>
		</div>
	</div><br>
	
	<div class="row">
		<div class="col-md-12">
			<input type="hidden" id="idexpediente" name="idexpediente" value="<?= $idexpediente ?>">
			<button class="btn btn-complete" id="btnActualizar">Actualizar</button>
		</div>
	</div>
</form>

<script type="text/javascript">
$(document).ready(function (){
	var params=<?= json_encode($params) ?>;
	
	$('#responsable').select2({
		minimumInputLength: 4,
		ajax: {
			url: `${params.baseUrl}pantallas/ejecutar_acciones.php`,
			dataType: 'json',
			quietMillis: 1000,
			data: function (paramsSelect2) {
				var query = {
					search: paramsSelect2.term,
					methodInstance: 'listFuncionarios',
					nameInstance:'ExpedienteController',
					where: ` and idfuncionario<>${params.responsable}`
				}
				return query;
			},
			processResults: function (data, paramsSelect2) {
				return {
					results: data.results,
					pagination: {
						more: false
					}
				};
			},
			cache:true
		}
	});

	$('#responsable').on("select2:selecting", function (e) { 
		$('#responsable').val('').trigger('change');
	});
	
	$("#formularioExp").validate({
		rules : {
			responsable : {
				required : true
			},
			idexpediente : {
				required : true
			}
		},
		submitHandler : function(form) {
			let idexpediente=$("#idexpediente").val();
			let funcionario=$("#responsable").val();
			$('#nombre').val(null).trigger('change');
			$.ajax({
				type : 'POST',
				async:false,
				url: `${params.baseUrl}pantallas/ejecutar_acciones.php`,
				data: {nameInstance:'ExpedienteController',methodInstance:'updateResponsableExpedienteCont',idexpediente:idexpediente,responsable:funcionario},
				dataType: 'json',
				success: function(response){
					if(response.exito){
						$("#dinamic_modal").modal('hide');
						top.notification({
							message : response.message,
							type : 'success',
							duration : 3000
						});
					}else{
						top.notification({
							message : response.message,
							type : "error",
							duration : 3000
						});
					}
				},
				error : function() {
					top.notification({
						message : "Error al procesar la solicitud",
						type : "error",
						duration : 3000
					});
				}
			});
		}
	});
});
</script>