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
require_once $ruta_db_superior . "db.php";

if ($_REQUEST["xml"] != "" && $_REQUEST["campo"]) {
	$parametros = array(
		"selectMode" => 2,
		"abrir_cargar" => 0,
		"busqueda_item" => 0,
		"onNodeSelect" => "",
		"ruta_db_superior" => ""
	);

	if (isset($_REQUEST["selectMode"])) {
		$parametros["selectMode"] = $_REQUEST["selectMode"];
	}
	if (isset($_REQUEST["abrir_cargar"])) {
		$parametros["abrir_cargar"] = $_REQUEST["abrir_cargar"];
	}
	if (isset($_REQUEST["onNodeSelect"])) {
		$parametros["onNodeSelect"] = $_REQUEST["onNodeSelect"];
	}
	if (isset($_REQUEST["ruta_db_superior"])) {
		$parametros["ruta_db_superior"] = $_REQUEST["ruta_db_superior"];
	}
	if (isset($_REQUEST["busqueda_item"])) {
		$parametros["busqueda_item"] = $_REQUEST["busqueda_item"];
	}
	if (isset($_REQUEST["seleccionados"])) {
		$parametros["seleccionados"] = $_REQUEST["seleccionados"];
	}

	if (isset($_REQUEST["onNodeDblClick"])) {
		$parametros["onNodeDblClick"] = $_REQUEST["onNodeDblClick"];
	}
	if (isset($_REQUEST["onNodeClick"])) {
		$parametros["onNodeClick"] = $_REQUEST["onNodeClick"];
	}
}

function crear_arbol($xml, $campo, $parametros)
{
	$html = "";
	if ($parametros["busqueda_item"]) {
		$html .= <<<FINHTML
	        <label>Buscar:</label>
	        <input name="stext_{$campo}" placeholder="Buscar..." autocomplete="off">
	        <button id="btnSearch_{$campo}">&times;</button>
	        <span id="matches_{$campo}"></span>
		</p>
FINHTML;
	}

	$html .= <<<FINHTML
	<input type="hidden" class="required" name="{$campo}" id="{$campo}" value="{$parametros['seleccionados']}">
	<div id="treebox_{$campo}"></div>

	<script>
		$(document).ready(function(){
			var nodoSeleccionado = "{$parametros['onNodeSelect']}";
			var configuracion={
				icon: false,
				strings: {
					loading: "Cargando...",
					loadError: "Error en la carga!",
					moreData: "Mas...",
					noData: "Sin datos."
				},
				debugLevel: 1,
				extensions: ["filter"],
				//autoScroll: true, // Automatically scroll nodes into visible area.
				quicksearch: true, // Navigate to next node by typing the first letters.
				selectMode: {$parametros['selectMode']},
				clickFolderMode:2,
				source: {
					url: "{$parametros['ruta_db_superior']}{$xml}",
					data:{
						seleccionados:"{$parametros['seleccionados']}"
					}
				},
				filter: {
					autoApply: true,   // Re-apply last filter if lazy data is loaded
					autoExpand: true, // Expand all branches that contain matches while filtered
					counter: true,     // Show a badge with number of matching child nodes near parent icons
					fuzzy: false,      // Match single characters in order, e.g. 'fb' will match 'FooBar'
					hideExpandedCounter: true,  // Hide counter badge if parent is expanded
					hideExpanders: false,       // Hide expanders if all child nodes are hidden by filter
					highlight: true,   // Highlight matches by wrapping inside <mark> tags
					leavesOnly: false, // Match end nodes only
					nodata: true,      // Display a 'no data' status node if result is empty
					mode: "hide"     // Grayout unmatched nodes (pass "hide" to remove unmatched node instead)
				},
				select: function(event, data) {
					let seleccionados = Array();
					let items = data.tree.getSelectedNodes();
					for(let i=0;i<items.length; i++){
						seleccionados.push(items[i].key);
					}
					let s = seleccionados.join(",");
					$("#{$campo}").val(s);
				}
			};
			if(nodoSeleccionado != "") {
				delete configuracion.select;
			}
			$("#treebox_{$campo}").fancytree(configuracion);

			var tree = $("#treebox_{$campo}").fancytree("getTree");
FINHTML;

	if ($parametros["onNodeSelect"] != "") {
		$html .= <<<FINHTML
			$("#treebox_{$campo}").on("fancytreeselect", ({$parametros['onNodeSelect']}));
FINHTML;
	}

	if ($parametros["onNodeDblClick"] != "") {
		$html .= <<<FINHTML
			$("#treebox_{$campo}").on("fancytreedblclick", ({$parametros['onNodeDblClick']}));
FINHTML;
	}

	if ($parametros["onNodeClick"] != "") {
		$html .= <<<FINHTML
			$("#treebox_{$campo}").on("fancytreeclick", ({$parametros['onNodeClick']}));
FINHTML;
	}

	$html .= <<<FINHTML
			$("input[name=stext_{$campo}]").keyup(function(e){
				var coincidencias = " coincidencias";
				var n, opts = {};
				var filterFunc = tree.filterNodes;
				var match = $(this).val();
				opts.mode = "dimm";

				if(e && e.which === $.ui.keyCode.ESCAPE || $.trim(match) === ""){
					$("button#btnSearch_{$campo}").click();
					return;
				}
				n = filterFunc.call(tree, match);
				if(n == 1) {
					coincidencias = " coincidencia";
				}
				$("button#btnSearch_{$campo}").attr("disabled", false);
				$("span#matches_{$campo}").text("(" + n + coincidencias + ")");
			}).focus();

			$("button#btnSearch_{$campo}").click(function(e){
				$("input[name=stext_{$campo}]").val("");
				$("span#matches_{$campo}").text("");
				tree.clearFilter();
			}).attr("disabled", true);

		});
	</script>
FINHTML;

	return $html;
}
echo crear_arbol($_REQUEST["xml"], $_REQUEST["campo"], $parametros);
