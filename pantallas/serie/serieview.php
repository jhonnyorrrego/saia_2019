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
include_once $ruta_db_superior . "controllers/autoload.php";

$idserie = $_REQUEST["key"];
$entidad_serie = $_REQUEST["identidad_serie"];
$idnode = ($_REQUEST["idnode"] != "") ? $_REQUEST["idnode"] : 0;

$datos = new Serie($idserie);
$datosPadre = $datos -> getCodPadre();
$nomPadre = '';
if ($datosPadre !== false) {
    $nomPadre = $datosPadre -> nombre;
}

$lectura = 0;
$add = 0;
$ent = 0;
if ($datos -> countDocuments()) {
    $lectura = 1;
} else {
    $add = 1;
    if (!empty($entidad_serie)) {
        $ent = 1;
        $id = explode(".", $idnode);
    }
}

include_once $ruta_db_superior . 'assets/librerias.php';
include_once ($ruta_db_superior . "librerias_saia.php");
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
				    <?php if(!$lectura):?>
				    <a class="btn btn-complete mx-1" href="serieedit.php?idnode=<?= $idnode ?>&x_idserie=<?= $idserie ?>">
                        <i class="fa fa-plus"></i> Editar
                    </a>
                        <?php if($add):?>
                            <a class="btn btn-complete mx-1" href="serieadd.php?idnode=<?= $idnode ?>&x_idserie=<?= $idserie ?>">
                                <i class="fa fa-plus"></i> Adicionar
                            </a>
                        <?php endif; ?>
                        
                        <?php if($ent):?>
                            <a class="btn btn-complete my-2" href="permiso_serie.php?idserie=<?= $idserie ?>&identidad_serie=<?= $entidad_serie ?>" target="serielist">
                                <i class="fa fa-plus"></i> Permisos
                            </a>
                            <a class="btn btn-complete mx-1" href="asignarserie_entidad.php?seleccionados=<?= $id[1] ?>&idnode=<?= $idnode ?>" target="serielist">
                                <i class="fa fa-plus"></i> Asociar a dependencia
                            </a>
                        <?php endif; ?>
                        
                    <?php else: ?>
                     Serie de solo lectura. Tiene documentos vinculados
                    <?php endif; ?>
                    <table class="table tabled-bordered">
                        <tr>
                            <td>CATEGORIA</td>
                            <td><?=$datos -> getCategoria(); ?></td>
                        </tr>
                    
                        <tr class="ocultar">
                            <td>TIPO SERIE</td>
                            <td><?=$datos -> getTipo(); ?></td>
                        </tr>
                    
                        <tr>
                            <td>C&Oacute;DIGO</td>
                            <td><?=$datos -> codigo ?></td>
                        </tr>
                    
                        <tr>
                            <td>NOMBRE</td>
                            <td><?=$datos -> nombre; ?></td>
                        </tr>
                    
                        <tr>
                            <td>PADRE</td>
                            <td><?=$nomPadre; ?></td>
                        </tr>
                    
                        <tr class="ocultar">
                            <td>TIEMPO DE RESPUESTA (D&Iacute;AS)</td>
                            <td><?=$datos -> dias_entrega; ?></td>
                        </tr>
                    
                        <tr class="ocultar">
                            <td>MESES ARCHIVO GESTI&Oacute;N</td>
                            <td><?=$datos -> retencion_gestion; ?></td>
                        </tr>
                    
                        <tr class="ocultar">
                            <td>MESES ARCHIVO CENTRAL</td>
                            <td><?=$datos -> retencion_central; ?></td>
                        </tr>
                    
                        <tr class="ocultar">
                            <td>CONSERVACI&Oacute;N / ELIMINACI&Oacute;N</td>
                            <td><?=$datos -> getConservacion(); ?></td>
                        </tr>
                    
                        <tr class="ocultar">
                            <td>SELECCI&Oacute;N</td>
                            <td><?=$datos -> getLabelCampo('seleccion'); ?></td>
                        </tr>
                    
                        <tr class="ocultar">
                            <td>DIGITALIZACI&Oacute;N</td>
                            <td><?=$datos -> getLabelCampo('digitalizacion'); ?></td>
                        </tr>
                    
                        <tr class="ocultar">
                            <td>OTRO</td>
                            <td><?=$datos -> otro; ?></td>
                        </tr>
                    
                        <tr class="ocultar">
                            <td>PERMITIR COPIA</td>
                            <td><?=$datos -> getLabelCampo('copia'); ?></td>
                        </tr>
                    
                        <tr class="ocultar">
                            <td>PROCEDIMIENTO CONSERVACI&Oacute;N</td>
                            <td><?=$datos -> procedimiento; ?></td>
                        </tr>
                    
                        <tr>
                            <td>ESTADO</td>
                            <td><?=$datos -> getEstado(); ?></td>
                        </tr>
                    </table>
				</div>
			</div>
		</div>

		<script data-categoria='<?= $datos -> categoria ?>'>
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