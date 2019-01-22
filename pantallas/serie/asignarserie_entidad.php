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
$sAction = $_POST["a_add"];

if (!$idserie) {
	alerta('Identificador NO encontrado', 'error');
	return false;
}

$Serie = new Serie($idserie);
$EntidadSeries = $Serie->getEntidadSerieFk();
var_dump($EntidadSeries);
die();
$idsDep = [];
$idsEliminar = [];
if ($EntidadSeries) {
	foreach ($EntidadSeries as $EntSer) {
		print_r($EntSer->getPK());
		die("--");
		$idsDep[] = $EntSer->fk_dependencia;
		$idsEliminar[$EntSer->fk_dependencia] = $EntSer->getPK();
	}
}

if ($sAction == "A") {
	print_r($idsEliminar);
	die("--");
	$depActuales = explode(',', $_POST['fk_dependencia']);
	$eliminados = array_diff($idsDep, $depActuales);
	$cantDelete = count($eliminados);

	$nuevos = array_diff($depActuales, $idsDep);
	$cantNew = count($nuevos);
	$message = [];
	$exitoDel = 1;

	if ($cantDelete) {
		$okDel = 0;
		foreach ($eliminados as $iddependencia) {
			print_r($idsEliminar);
			var_dump($idsEliminar[$iddependencia]);
			die();
			$EntidadSerie = new EntidadSerie($idsEliminar[$iddependencia]);
			$info = $EntidadSerie->inactiveEntidadSerie();
			if ($info['exito']) {
				$okDel++;
			}
		}
		if ($cantDelete == $okDel) {
			$exitoDel = 1;
		} elseif ($okDel) {
			$message[] = 'NO se pudo desvincular/eliminar todas las dependencias de la serie';
			$exitoDel = 2;
		} else {
			$message[] = 'Error al desvincular la serie';
			$exitoDel = 0;
		}
	}

	$exitoNew = 1;
	if ($cantNew) {
		$okNew = 0;
		foreach ($nuevos as $iddependencia) {
			$attributes = [
				'fk_serie' => $idserie,
				'fk_dependencia' => $iddependencia,
				'estado' => 1,
				'fecha_creacion' => date('Y-m-d H:i:s')
			];
			$EntidadSerie = new EntidadSerie();
			$EntidadSerie->SetAttributes($attributes);
			$infoEntidadSerie = $EntidadSerie->CreateEntidadSerie();
			if ($infoEntidadSerie['exito']) {
				$okNew++;
			}
			ProcessExpedienteController::createEntidadSerieCodArbol($Serie->cod_arbol,$attributes);
		}
		if ($cantNew == $okNew) {
			$exitoNew = 1;
		} elseif ($okNew) {
			$message[] = 'No se pudieron vincular todas las dependencias a la serie ';
			$exitoNew = 2;
		} else {
			$message[] = 'Error al vincular las nuevas dependencias a la serie ';
			$exitoNew = 0;
		}
	}
	if ($exitoDel == 1 && $exitoNew == 1) {
		alerta('Datos guardados!');
	} else {
		alerta('Se presentaron los siguientes errores:<br/>' . implode('<br/>', $message), 'error', 6000);
	}
	echo "<script>
		window.parent.location.href='serielist.php';
	</script>";
	return false;
}

$selecccionados = '';
if (count($idsDep)) {
	$selecccionados = implode(',', $idsDep);
}

$origen = [
	'url' => 'arboles/arbol_dependencia.php',
	'ruta_db_superior' => $ruta_db_superior,
	'params' => [
		'seleccionados' => $selecccionados,
		'idserie' => $idserie,
		'origenPagina' => 'vincular'
	]
];
if ($Serie->tipo > 1) {
	$origen['params']['depserie'] = 1;
}

$opcionArbol = [
	'keyboard' => true,
	'selectMode' => 2,
	'busqueda_item' => 1,
	'expandir' => 3
];
$extensiones = ['filter' => []];
$arbol = new ArbolFt('fk_dependencia', $origen, $opcionArbol, $extensiones);

include_once $ruta_db_superior . 'assets/librerias.php';
include_once $ruta_db_superior . 'librerias_saia.php';
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

					<form name="formulario" id="formulario" method="post">
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

		<script>
			$(document).ready(function() {

				$("#formulario").validate({
					rules : {
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