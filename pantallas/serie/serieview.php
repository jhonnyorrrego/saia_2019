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

if (!$_REQUEST["key"]) {
    return false;
}
include_once $ruta_db_superior . 'controllers/autoload.php';

$idserie = $_REQUEST["key"];
if (!$idserie) {
    alerta('Identificador NO encontrado', 'error');
    return false;
}

$entidad_serie = $_REQUEST["identidad_serie"];
$idnode = ($_REQUEST["idnode"] != "") ? $_REQUEST["idnode"] : 0;

$Serie = new Serie($idserie);
$datosPadre = $Serie->getCodPadre();
$nomPadre = '';
if ($datosPadre !== false) {
    $nomPadre = $datosPadre->nombre;
}

$lectura = 0;
$ent = 0;
$add = 1;
if ($Serie->countDocuments()) {
    $lectura = 1;
}
if ($Serie->tipo == 3) {
    $add = 0;
}
if (!empty($entidad_serie)) {
    $ent = 1;
    $id = explode(".", $idnode);
}
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
		<?= icons() ?>
		<?= theme() ?>
	</head>

	<body>
		<div class="container m-0 p-0 mw-100 mx-100">
			<div class="row mx-0">
				<div class="col-12">
				    <?php if (!$lectura) : ?>
				    <a class="btn btn-complete mx-1" href="serieedit.php?idnode=<?= $idnode ?>&x_idserie=<?= $idserie ?>">
                        <i class="fa fa-plus"></i> Editar
                    </a>
                    <?php else : ?>
                     No se permite editar, Tiene documentos vinculados<br/>
                    <?php endif; ?>

                    <?php if ($add) : ?>
                        <a class="btn btn-complete mx-1" href="serieadd.php?idnode=<?= $idnode ?>&x_idserie=<?= $idserie ?>">
                            <i class="fa fa-plus"></i> Adicionar
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($ent) : ?>
                        <a class="btn btn-complete my-2" href="permiso_serie.php?identidad_serie=<?= $entidad_serie ?>" target="serielist">
                            <i class="fa fa-plus"></i> Permisos
                        </a>
                        <a class="btn btn-complete mx-1" href="asignarserie_entidad.php?x_idserie=<?= $idserie ?>" target="serielist">
                            <i class="fa fa-plus"></i> Asociar a dependencia
                        </a>
                    <?php endif; ?>
                        
                    <table class="table tabled-bordered">
                        <tr>
                            <td>CATEGORIA</td>
                            <td><?= $Serie->getCategoria(); ?></td>
                        </tr>
                    
                        <tr class="ocultar">
                            <td>TIPO SERIE</td>
                            <td><?= $Serie->getTipo(); ?></td>
                        </tr>
                    
                        <tr class="ocultar">
                            <td>C&Oacute;DIGO</td>
                            <td><?= $Serie->codigo ?></td>
                        </tr>
                    
                        <tr>
                            <td>NOMBRE</td>
                            <td><?= $Serie->nombre; ?></td>
                        </tr>
                    
                        <tr>
                            <td>PADRE</td>
                            <td><?= $nomPadre; ?></td>
                        </tr>
                    
                        <tr class="ocultar">
                            <td>TIEMPO DE RESPUESTA (D&Iacute;AS)</td>
                            <td><?= $Serie->dias_entrega; ?></td>
                        </tr>
                    
                        <tr class="ocultar">
                            <td>MESES ARCHIVO GESTI&Oacute;N</td>
                            <td><?= $Serie->retencion_gestion; ?></td>
                        </tr>
                    
                        <tr class="ocultar">
                            <td>MESES ARCHIVO CENTRAL</td>
                            <td><?= $Serie->retencion_central; ?></td>
                        </tr>
                    
                        <tr class="ocultar">
                            <td>CONSERVACI&Oacute;N / ELIMINACI&Oacute;N</td>
                            <td><?= $Serie->getConservacion(); ?></td>
                        </tr>
                    
                        <tr class="ocultar">
                            <td>SELECCI&Oacute;N</td>
                            <td><?= $Serie->getLabelCampo('seleccion'); ?></td>
                        </tr>
                    
                        <tr class="ocultar">
                            <td>DIGITALIZACI&Oacute;N</td>
                            <td><?= $Serie->getLabelCampo('digitalizacion'); ?></td>
                        </tr>
                    
                        <tr class="ocultar">
                            <td>OTRO</td>
                            <td><?= $Serie->otro; ?></td>
                        </tr>
                    
                        <tr class="ocultar">
                            <td>PERMITIR COPIA</td>
                            <td><?= $Serie->getLabelCampo('copia'); ?></td>
                        </tr>
                    
                        <tr class="ocultar">
                            <td>PROCEDIMIENTO CONSERVACI&Oacute;N</td>
                            <td><?= $Serie->procedimiento; ?></td>
                        </tr>
                    
                        <tr>
                            <td>ESTADO</td>
                            <td><?= $Serie->getEstado(); ?></td>
                        </tr>
                    </table>
				</div>
			</div>
		</div>

		<script data-categoria='<?= $Serie->categoria ?>'>
			$(document).ready(function() {
				let
				categoria = $("script[data-categoria]").data("categoria");
				if (categoria == 3) {
					$(".ocultar").hide();
				}
			});
		</script>
	</body>
</html>