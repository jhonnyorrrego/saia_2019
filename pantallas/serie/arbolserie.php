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
		<?= librerias_UI("1.12") ?>
		<?= librerias_arboles_ft("2.24", 'filtro'); ?>

		<style type="text/css">
			.estilo-dependencia {
				font-weight: bold;
			}
		</style>
	</head>

	<body>
		<div class="container m-0 p-0 mw-100 mx-100">
			<div class="row mx-0">
				<div class="col-12">
                      <a class="btn btn-complete" href="serieadd.php" target='serielist'>
                        <i class="fa fa-plus"></i> Adicionar
                      </a>
					<div id="treebox_campo_idserie"></div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			$(document).ready(function() {
				var configuracion = {
					icon : false,
					lazy : false,
					autoScroll: true,
					strings : {
						loadError : "Error en la carga!",
						moreData : "Mas...",
						noData : "Cargando...."
					},
					selectMode : 1,
					source : {
						url : "../../arboles/arbol_dependencia_serie.php",
						data : {
							cargar_partes : 1,
							otras_categorias : 1,
							serie_sin_asignar : 1
						}
					},
					lazyLoad : function(event, data) {
						let node = data.node;
						data.result = $.ajax({
							url : "../../arboles/arbol_dependencia_serie.php",
							data : {
								cargar_partes : 1,
								id : node.key
							},
							cache : true
						});
					},
					focus : function(event, data) {
						let
						nodeId = data.node.key;
						if (nodeId != "0.0") {
							let datos = nodeId.split(".");
							if (datos[1] != 0) {
								parent.serielist.location = "serieview.php?key=" + datos[1] + "&idnode=" + nodeId + "&identidad_serie=" + data.node.data.entidad_serie;
							}else{
							    parent.serielist.location = "../../vacio.php";
							}
						}else{
						    parent.serielist.location = "../../vacio.php";
						}

					}
				};
				$("#treebox_campo_idserie").fancytree(configuracion);
			});
		</script>
	</body>
</html>