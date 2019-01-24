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

require_once $ruta_db_superior . "controllers/autoload.php";
require_once $ruta_db_superior . "arboles/crear_arbol_ft.php";

$idserie = $_REQUEST['x_idserie'];
if (!$idserie) {
	alerta('Identificador NO encontrado', 'error');
	return false;
}

$Serie = new Serie($idserie);
$sAction = $_POST['a_add'];
if ($sAction == "A") {
	if ($_POST['categoria'] == 3) {
		$_POST['dias_entrega'] = 0;
		$_POST['retencion_gestion'] = 0;
		$_POST['retencion_central'] = 0;
		$_POST['copia'] = -1;
		$_POST['tipo'] = -1;
		$_POST['fk_dependencia'] = '';
	}

	$attributes = [
		'nombre' => $_POST['nombre'],
		'cod_padre' => $_POST['cod_padre'],
		'dias_entrega' => $_POST['dias_entrega'],
		'codigo' => $_POST['codigo'],
		'retencion_gestion' => $_POST['retencion_gestion'],
		'retencion_central' => $_POST['retencion_central'],
		'conservacion' => $_POST['conservacion'],
		'digitalizacion' => $_POST['digitalizacion'],
		'seleccion' => $_POST['seleccion'],
		'otro' => $_POST['otro'],
		'procedimiento' => $_POST['procedimiento'],
		'copia' => $_POST['copia'],
		'tipo' => $_POST['tipo'],
		'estado' => $_POST['estado'],
		'categoria' => $_POST['categoria']
	];
	$Serie->SetAttributes($attributes);
	$response = $Serie->updateSerie();
	if ($response['exito']) {
		alerta($response['message']);
	} else {
		alerta($response['message'], 'error');
	}
	echo "<script>
		window.parent.location.href='serielist.php';
	</script>";
	return false;
} else {
	$categoria = [
		2 => '',
		3 => ''
	];

	$tipo = [
		1 => '',
		2 => '',
		3 => ''
	];

	$conservacion = [
		1 => '',
		0 => ''
	];

	$seleccion = [
		0 => '',
		1 => ''
	];

	$digitalizacion = [
		0 => '',
		1 => ''
	];

	$copia = [
		0 => '',
		1 => ''
	];

	$estado = [
		0 => '',
		1 => ''
	];
	if ($Serie->categoria == 3) {
		$Serie->SetAttributes([
			'conservacion' => 1,
			'copia' => 1,
			'tipo' => 1,
			'seleccion' => 0
		]);
	}

	$SerieCodPadre = $Serie->getCodPadre();
	$nombrePadre = '';
	if ($SerieCodPadre) {
		$nombrePadre = $SerieCodPadre->nombre;
	}

	$tipo[$Serie->tipo] = 'checked';

	$conservacion[$Serie->conservacion] = 'checked';
	$categoria[$Serie->categoria] = 'checked';
	$seleccion[$Serie->seleccion] = 'checked';
	$digitalizacion[$Serie->digitalizacion] = 'checked';
	$copia[$Serie->copia] = 'checked';
	$estado[$Serie->estado] = 'checked';

	$params = [
		'idserie' => $idserie,
		'categoria' => $Serie->categoria
	];

}

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
	</head>

	<body>
		<div class="container m-0 p-0 mw-100 mx-100">
			<div class="row mx-0">
				<div class="col-12">

					<form name="formulario" id="formulario" method="post">
						<table class="table tabled-bordered">
							<tr>
								<td>CATEGORIA*</td>
								<td>
								<div class="selData">
									<input type="radio" name="categoria" value="2" <?= $categoria[2] ?>/>
									Produccion Documental
									<input type="radio" name="categoria" value="3" <?= $categoria[3] ?>/>
									Otras Categorias
								</div>
								<div class="viewData"><?= $Serie->getCategoria(); ?></div></td>
							</tr>

							<tr class="ocultar">
								<td>TIPO SERIE*</td>
								<td>
								    <?= $Serie->getTipo(); ?>
								    <div class="hide">
        								<input type="radio" name="tipo" value="1" <?= $tipo[1] ?> />
                                        Serie
                                        <input type="radio" name="tipo" value="2" <?= $tipo[2] ?> />
                                        Subserie
                                        <input type="radio" name="tipo" value="3" <?= $tipo[3] ?> />
                                        Tipo Documental
								    </div>
								 </td>
							</tr>

							<tr class="ocultar">
								<td>C&Oacute;DIGO</td>
								<td>
								<input type="text" name="codigo" id="codigo" value="<?= $Serie->codigo ?>"/>
								</td>
							</tr>

							<tr>
								<td>NOMBRE *</td>
								<td>
								<input type="text" name="nombre" id="nombre" value="<?= $Serie->nombre ?>"/>
								</td>
							</tr>

							<tr id="trCodPadre">
								<td>NOMBRE PADRE </td>
								<td>
								    <div id="divCodPadreSel" class="selData">
								        <input type="text" name="cod_padre" id="cod_padre" value="<?= $Serie->cod_padre; ?>"/>
								    </div>
								    <div id="divCodPadreView" class="viewData">
                                        <?= $nombrePadre; ?>
                                    </div>
								</td>
							</tr>

							<tr class="ocultar">
								<td>TIEMPO DE RESPUESTA EN (D&Iacute;AS) *</td>
								<td>
								<input type="number" name="dias_entrega" id="dias_entrega" value="<?= $Serie->dias_entrega ?>" />
								</td>
							</tr>

							<tr class="ocultar">
								<td>MESES ARCHIVO GESTI&Oacute;N *</td>
								<td>
								<input type="number" name="retencion_gestion" id="retencion_gestion" value="<?= $Serie->retencion_gestion ?>" />
								</td>
							</tr>

							<tr class="ocultar">
								<td>MESES ARCHIVO CENTRAL *</td>
								<td>
								<input type="number" name="retencion_central" id="retencion_central" value="<?= $Serie->retencion_central ?>" />
								</td>
							</tr>

							<tr class="ocultar">
								<td>CONSERVACI&Oacute;N / ELIMINACI&Oacute;N *</td>
								<td>
								<input type="radio" id="conservacion1" name="conservacion" value="1" <?= $conservacion[1] ?>>
								Conservacion
								<input type="radio" id="conservacion2" name="conservacion" value="0" <?= $conservacion[0] ?>>
								Eliminacion </td>
							</tr>

							<tr class="ocultar">
								<td>SELECCI&Oacute;N *</td>
								<td>
								<input type="radio" id="seleccion1" name="seleccion" value="1" <?= $seleccion[1] ?>/>
								SI
								<input type="radio" id="seleccion0" name="seleccion" value="0" <?= $seleccion[0] ?>/>
								NO </td>
							</tr>

							<tr class="ocultar">
								<td>DIGITALIZACI&Oacute;N</td>
								<td>
								<input type="radio" id="digitalizacion1" name="digitalizacion" value="1" <?= $digitalizacion[1] ?>/>
								SI
								<input type="radio" id="digitalizacion0" name="digitalizacion" value="0" <?= $digitalizacion[0] ?>/>
								NO </td>
							</tr>

							<tr class="ocultar">
								<td>OTRO</td>
								<td>
								<input type="text" name="otro" id="otro" value="<?= $Serie->otro ?>" />
								</td>
							</tr>

							<tr class="ocultar">
								<td>PROCEDIMIENTO CONSERVACI&Oacute;N</td>
								<td><textarea cols="35" rows="4" id="procedimiento" name="procedimiento"><?= $Serie->procedimiento ?></textarea></td>
							</tr>

							<tr class="ocultar">
								<td>PERMITIR COPIA *</td>
								<td>
								<input type="radio" id="copia1" name="copia" value="1" <?= $copia[1] ?>>
								SI
								<input type="radio" id="copia0" name="copia" value="0" <?= $copia[0] ?>>
								NO </td>
							</tr>
							<tr>
								<td>ESTADO *</td>
								<td>
								<input type="radio" id="estado1" name="estado" value="1" <?= $estado[1] ?>>
								SI
								<input type="radio" id="estado0" name="estado" value="0" <?= $estado[0] ?>>
								NO </td>
							</tr>
							<tr>
								<td colspan="2">
								<input type="hidden" name="a_add" value="A">
								<input type="hidden" name="x_idserie" value="<?=$idserie;?>">
								<button id="editarSerie" type="submit" class="btn btn-complete">
									Editar
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

				$("#formulario").validate({
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
						$("#editarSerie").attr('disabled',true);
						form.submit();
					}
				});

				$("[name='categoria']").change(function() {
					if ($(this).val() == 3) {
						$("#fk_dependencia").val('0');
						$(".ocultar").hide();
					} else {
						if (!params.idserie) {
							$("#fk_dependencia").val('');
						}
						$(".ocultar").show();
					}
				});
				$("[name='categoria']:checked").trigger("change");

			});
		</script>
	</body>
</html>