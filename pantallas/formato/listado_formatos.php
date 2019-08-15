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
include_once $ruta_db_superior . 'core/autoload.php';
include_once($ruta_db_superior . "librerias_saia.php");
include_once($ruta_db_superior . "assets/librerias.php");
include_once($ruta_db_superior . "arboles/crear_arbol_ft.php");
echo jquery();
echo bootstrap();
echo jqueryUi();
echo icons();

if (!isset($_REQUEST['no_kaiten'])) {
	echo librerias_acciones_kaiten();
}

if (!isset($_REQUEST['id'])) {
	?>
	<!doctype html>
	<html lang="es">

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


		<style type="text/css">
			td.alignLeft {
				text-align: left;
			}

			td.alignCenter {
				text-align: center;
			}

			td.alignRight {
				text-align: right;
			}

			.table tbody tr td {
				padding: 13px;
			}
		</style>
		<link href="../../js/jquery.fancytree/2.30.0/skin-lion/ui.fancytree.css" rel="stylesheet">
		<!-- <link href="../editor_codigo/js/skin-lion/ui.fancytree.css" rel="stylesheet">  -->
		<script src="../../js/jquery.fancytree/2.30.0/modules/jquery.fancytree.js"></script>
		<script src="../../js/jquery.fancytree/2.30.0/modules/jquery.fancytree.table.js"></script>
		<script src="../../js/jquery.fancytree/2.30.0/modules/jquery.fancytree.filter.js"></script>


		<!-- (Irrelevant source removed.) -->

		<script type="text/javascript">
			var ruta_db_superior = "<?php echo $ruta_db_superior; ?>";
			$(function() {
				// Attach the fancytree widget to an existing <div id="tree"> element
				// and pass the tree options as an argument to the fancytree() function:
				$("#tree_campo_idformato").fancytree({
					icon: false,
					lazy: true,
					extensions: ["filter", "table"],
					table: {
						indentation: 20, // indent 20px per node level
						nodeColumnIdx: 1,
						checkboxColumnIdx: 0 // render the node title into the 2nd column
						// render the checkboxes into the 1st column
					},
					click: function(event, data) {
						var nodeId = data.node.key;
						var title = data.node.title;
						var elemento_evento = $.ui.fancytree.getEventTargetType(event.originalEvent);
						if (elemento_evento == 'title') {
							abrir_kaiten("pantallas/generador/iframe_generador.php?nokaiten=1&idformato=" + nodeId, title);
							//window.location= ruta_db_superior+"pantallas/generador/generador_pantalla.php?idformato="+nodeId;
						}
					},
					filter: {
						autoApply: true, // Re-apply last filter if lazy data is loaded
						autoExpand: true, // Expand all branches that contain matches while filtered
						counter: true, // Show a badge with number of matching child nodes near parent icons
						fuzzy: false, // Match single characters in order, e.g. 'fb' will match 'FooBar'
						hideExpandedCounter: true, // Hide counter badge if parent is expanded
						hideExpanders: false, // Hide expanders if all child nodes are hidden by filter
						highlight: true, // Highlight matches by wrapping inside <mark> tags
						leavesOnly: false, // Match end nodes only
						nodata: true, // Display a 'no data' status node if result is empty
						mode: "hide", // Grayout unmatched nodes (pass "hide" to remove unmatched node instead)
					},
					source: {
						url: ruta_db_superior + "arboles/arbol_formatos.php"
					},
					lazyLoad: function(event, data) {
						data.result = {
							url: "ajax-sub2.json"
						}
					},
					renderColumns: function(event, data) {

						var node = data.node,
							$tdList = $(node.tr).find(">td");
						// (index #0 is rendered by fancytree by adding the checkbox)
						$tdList.eq(0).text(node.getIndexHier());
						// (index #2 is rendered by fancytree)
						$tdList.eq(2).text(node.data.descripcion);

						$tdList.eq(3).text(node.data.version);
						// Rendered by row template:
						//        $tdList.eq(4).html("<input type='checkbox' name='like' value='" + node.key + "'>");
					}
				});

				var tree = $("#tree_campo_idformato").fancytree("getTree");
				$("input[name=search]").keyup(function(e) {
					var coincidencias = " coincidencias";
					var n,
						//tree = $.ui.fancytree.getTree(),
						opts = {};
					//var filterFunc = tree.filterBranches;
					var filterFunc = tree.filterNodes;
					var match = $(this).val();

					//opts.mode = "hide";
					opts.mode = "dimm";

					if (e && e.which === $.ui.keyCode.ESCAPE || $.trim(match) === "") {
						$("i#btnResetSearch").click();
						return;
					}
					// Pass a string to perform case insensitive matching. Puede pasar un 3er parametro opts
					n = filterFunc.call(tree, match);
					if (n == 1) {
						coincidencias = " coincidencia";
					}
					$("i#btnResetSearch").attr("disabled", false);
					$("span#matches").text("(" + n + coincidencias + ")");
				}).focus();

				$("i#btnResetSearch").click(function(e) {
					$("input[name=search]").val("");
					$("span#matches").text("");
					tree.clearFilter();
				}).attr("disabled", true);

			});
		</script>

		<?= theme() ?>

	</head>

	<body>
		<div class="container-fluid">
			<!-- Add a <table> element where the tree should appear: -->

			<div class="row mt-4">
				<div class="col-sm-10">

					<div class="d-lg-inline-block align-middle d-none">
						<div class="input-group transparent">
							<div class="input-group-prepend">
								<span class="input-group-text transparent">
									<i class="fa fa-search"></i>
								</span>
							</div>
							<input id="document_finder" type="text" class="form-control" name="search" placeholder="Buscar..." style="width:250px" autocomplete="off">
							<div class="input-group-append ">
								<span class="input-group-text transparent">
									<i class="fa fa-times" id="btnResetSearch"></i>

								</span>
							</div>
						</div>
					</div>
					<span id="matches"></span>
				</div>

				<div id="menu_buscador">
					<?= $btn_search ?>
					<?= $actions ?>
					<?= $btn_add ?>

					<button class="btn btn-secondary" title="Descargar" id="boton_exportar_excel">
						<i class="fa fa-download"></i>
					</button>
					<div class="pull-right d-none" valign="middle">
						<iframe name="iframe_exportar_saia" id="iframe_exportar_saia" allowtransparency="1" frameborder="0" framespacing="2px" scrolling="no" width="10%" src="" hspace="0" vspace="0" height="40px"></iframe>
					</div>
				</div>
			</div>
			<table class="table table-bordered" id="tree_campo_idformato" heigt="50%;" width="85%;" data-pagination="true" data-toolbar="#menu_buscador" data-show-refresh="true" data-maintain-selected="true">
				<thead>
					<tr>
						<td class="bold Default alignCenter" style="font-size: 11px;">N°</td>
						<td class="bold Default alignCenter" style="font-size: 11px;">Formatos</td>
						<td class="bold Default alignCenter" style="font-size: 11px;">Descripci&oacute;n</td>
						<td class="bold Default alignCenter" style="font-size: 11px;">Versi&oacute;n</td>
					</tr>
				</thead>
				<!-- Otionally define a row that serves as template, when new nodes are created: -->
				<tbody>
					<tr>
						<td class="hint-text alignCenter" style="font-size: 11px; padding:8px;"></td>
						<td class="hint-text" style="font-size: 11px;  padding:8px;"></td>
						<td class="hint-text" style="font-size: 11px;  padding:8px;"></td>
						<td class="hint-text alignCenter" style="font-size: 11px;  padding:8px;"></td>

					</tr>
				</tbody>
			</table>
			<script type="text/javascript">
				$(document).ready(function() {
					$("#nuevo_formato").click(function() {
						abrir_kaiten("pantallas/generador/iframe_generador.php?nokaiten=1", "Nuevo formato");
					});
				});
			</script>
			<!-- (Irrelevant source removed.) -->
	</body>
	</div>

	</html>
<?php
} else {
	echo librerias_jquery("3.3");
	echo estilo_bootstrap();
	echo librerias_UI("1.12");
	echo librerias_arboles_ft("2.24", 'filtro');
	$origen = array("url" => "arboles/arbol_formatos.php", "ruta_db_superior" => $ruta_db_superior, "params" => array("id" => $_REQUEST['id'], "cargar_seleccionado" => $_REQUEST['cargar_seleccionado']));
	$opciones_arbol = array("keyboard" => true, "onNodeClick" => "evento_click", "busqueda_item" => 1);
	$extensiones = array("filter" => array());
	$arbol = new ArbolFt("campo_idformato", $origen, $opciones_arbol, $extensiones, $validaciones);
	?>
	<!doctype html>
	<html lang="es">

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<style type="text/css">
			.estilo-dependencia {
				font-family: verdana;
				font-size: 7pt;
				font-weight: bold;
			}

			.estilo-serie {
				font-family: verdana;
				font-size: 7pt;
			}

			.estilo-serie-sa {
				font-family: verdana;
				font-size: 7pt;
				color: red;
			}

			ul.fancytree-container {
				width: 100%;
				height: 80%;
				overflow: auto;
				position: relative;
				border: none;
			}
		</style>

	</head>

	<body>
		<div class="container"><br>
			<div class="row mx-0 px-0">
				<div class="col-auto px-0 mx-0">
					<?= $arbol->generar_html() ?>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(".buscar_arboles").hide();
			$("#contenido_arbol").css({
				"margin-top": "8px"
			})
			var ruta_db_superior = "<?php echo $ruta_db_superior; ?>";
			var idformato = "<?php echo $_REQUEST['id']; ?>";

			if (!idformato) {
				function evento_click(event, data) {
					var nodeId = data.node.key;
					var title = data.node.title;
					var elemento_evento = $.ui.fancytree.getEventTargetType(event.originalEvent);
					if (elemento_evento == 'title') {
						abrir_kaiten("pantallas/generador/iframe_generador.php?nokaiten=1&idformato=" + nodeId, title);
					}
				}
			} else {
				function evento_click(event, data) {
					var nodeId = data.node.key;
					var title = data.node.title;
					var elemento_evento = $.ui.fancytree.getEventTargetType(event.originalEvent);
					if (elemento_evento == 'title') {
						$("#iframe_generador", window.parent.document).attr("src", ruta_db_superior + "pantallas/generador/generador_pantalla.php?idformato=" + nodeId)
					}
				}
			}
		</script>
	</body>

	</html>
<?php

}
?>