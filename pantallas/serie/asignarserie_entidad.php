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

include_once $ruta_db_superior . "controllers/autoload.php";
require_once $ruta_db_superior . "arboles/crear_arbol_ft.php";

$idserie = $_REQUEST['x_idserie'];
if (!$idserie) {
	alerta('Identificador NO encontrado', 'error');
	return false;
}

$sAction = $_POST["a_add"];
$Serie = new Serie($idserie);
if ($sAction == "A") {

	echo "<script>
		window.parent.location.href='serielist.php';
	</script>";
	return false;
}

$EntidadSerie = $Serie->getEntidadSerieFk();
$cant = count($EntidadSerie);
$idsDep = [];
if ($cant) {
	for ($i = 0; $i < $cant; $i++) {
		$idsDep[] = $EntidadSerie[$i]->fk_dependencia;
	}
}
$selecccionados = '';
if (count($idsDep)) {
	$selecccionados = implode(",", $idsDep);
}

$origen = array(
	"url" => "arboles/arbol_dependencia.php",
	"ruta_db_superior" => $ruta_db_superior,
	"params" => array(
		"checkbox" => 1,
		"seleccionados" => $selecccionados
	)
);

$opcionArbol = array(
	"keyboard" => true,
	"selectMode" => 2,
	"busqueda_item" => 1,
	"expandir" => 3
);
$extensiones = array("filter" => array());
$arbol = new ArbolFt("fk_dependencia", $origen, $opcionArbol, $extensiones);

$params = [
	'idserie' => $idserie,
	'categoria' => $Serie->categoria
];


include_once $ruta_db_superior . 'assets/librerias.php';
include_once $ruta_db_superior . "librerias_saia.php";
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>SAIA - SGDEA</title>
		<?= jquery() ?>
		<?= bootstrap() ?>
		<?= theme() ?>
		<?= librerias_UI("1.12") ?>
		<?= librerias_validar_formulario() ?>
		<?= librerias_arboles_ft("2.24", 'filtro'); ?>
	</head>

	<body>
		<div class="container m-0 p-0 mw-100 mx-100">
			<div class="row mx-0">
				<div class="col-12">

					<form name="serieadd" id="serieadd" method="post">
						<table class="table tabled-bordered">
							<tr>
								<td>DEPENDENCIA ASOCIADA *</td>
								<td><?= $arbol->generar_html(); ?></td>
							</tr>
							<tr>
								<td colspan="2">
								<input type="hidden" name="a_add" value="A">
								<input type="hidden" name="x_idserie" value="<?= $idserie; ?>">
								<button id="vincularSerie" type="submit" class="btn btn-complete">
									Vincular
								</button></td>
							</tr>
						</table>

					</form>
				</div>
			</div>
		</div>

		<script data-params='<?= json_encode($params); ?>'>
			$(document).ready(function() {
				var params = $("script[data-params]").data("params");
				if (params.idserie) {
					$("#trCodPadre").show();
					$(".viewData").show();
					$(".selData").hide();
				} else {
					$("#trCodPadre").hide();

					$(".viewData").hide();
					$(".selData").show();
				}

				$("#serieadd").validate({
					rules : {
						categoria : {
							required : true
						},
						tipo : {
							required : true
						},
						nombre : {
							required : true
						},

						dias_entrega : {
							required : true
						},
						retencion_gestion : {
							required : true
						},
						retencion_central : {
							required : true
						},
						conservacion : {
							required : true
						},
						seleccion : {
							required : true
						},
						copia : {
							required : true
						},
						fk_dependencia : {
							required : true
						}
					},
					submitHandler : function(form) {
						$("#vincularSerie").attr('disabled',true);
						form.submit();
					}
				});

			});
		</script>
	</body>
</html>