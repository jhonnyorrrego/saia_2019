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
include_once ($ruta_db_superior . "db.php");
//include_once ($ruta_db_superior . "librerias_saia.php");

//echo(librerias_jquery("3.3"));
if ($_REQUEST["xml"] != "" && $_REQUEST["campo"]) {
	$parametros = array(
		"selectMode" => 2,
		//"abrir_cargar" => 0,
		"busqueda_item" => 0,
		"onNodeSelect" => "",
		"ruta_db_superior" => "",
		"expandir"=> 4,
		"seleccionar_todos"=> ""
	);	
	if (isset($_REQUEST["selectMode"])) {
		$parametros["selectMode"] = $_REQUEST["selectMode"];
	}
	/*if (isset($_REQUEST["abrir_cargar"])) {
		$parametros["abrir_cargar"] = $_REQUEST["abrir_cargar"];
	}*/
	if (isset($_REQUEST["onNodeSelect"])) {
		$parametros["onNodeSelect"] = $_REQUEST["onNodeSelect"];
	}
	if (isset($_REQUEST["ruta_db_superior"])) {
		$parametros["ruta_db_superior"] = $_REQUEST["ruta_db_superior"];
	}
	if (isset($_REQUEST["busqueda_item"])) {
		$parametros["busqueda_item"] = $_REQUEST["busqueda_item"];
	}
	if (isset($_REQUEST["seleccionar_todos"])) {
		$parametros["seleccionar_todos"] = $_REQUEST["seleccionar_todos"];
	}
	if (isset($_REQUEST["expandir"])) {
		$parametros["expandir"]=$_REQUEST["expandir"];
	}
	if (isset($_REQUEST["onNodeDblClick"])) {
		$parametros["onNodeDblClick"]=$_REQUEST["onNodeDblClick"];
	}
}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
<script src="<?php echo $parametros["ruta_db_superior"];?>js/jquery-migrate/jquery-migrate-1.4.1.js"></script>
<?php

/*echo librerias_UI("1.12");
echo librerias_arboles_ft("2.24", 'filtro');
*/

	crear_arbol($_REQUEST["xml"], $_REQUEST["campo"], $parametros);
?>
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
    border: none;
    background-color:#F5F5F5;
}
</style>
</head>
<?php
function crear_arbol($xml,$campo,$parametros) {
	if($parametros["busqueda_item"]){
	?>	
	    <p>
	        <label>Buscar:</label>
	        <input name="stext_<?php echo $campo; ?>" placeholder="Buscar..." autocomplete="off">
	        <button id="btnSearch_<?php echo $campo; ?>">&times;</button>
	        <span id="matches_<?php echo $campo; ?>"></span>
	    </p>
	 <?php
	 }
	 ?>
	<div id="treebox_<?php echo $campo; ?>"></div>
	<input type="hidden" class="required" name="<?php echo $campo; ?>" id="<?php echo $campo; ?>">
	<script type="text/javascript">
	$(document).ready(function() { 
	var nodoSeleccionado="<?php echo($parametros["onNodeSelect"]); ?>";
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
    		//keyboard: true, // Support keyboard navigation.
    		selectMode: <?php echo $parametros["selectMode"]; ?>,
    		clickFolderMode:2,
    		source: {
    			url: "<?php echo $parametros["ruta_db_superior"].$xml; ?>",
    			data: {
        			/*otras_categorias: 1,
        			serie_sin_asignar: 1*/
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
    		    mode: "hide",      // Grayout unmatched nodes (pass "hide" to remove unmatched node instead)
            },
			select: function(event, data) { // Display list of selected nodes 
				var seleccionados = Array();
				var items = data.tree.getSelectedNodes();
				for(var i=0;i<items.length;i++){
					seleccionados.push(items[i].key);
				}
				var s = seleccionados.join(","); 
				$("#<?php echo $campo; ?>").val(s);
			},
            /*activate: function(event, data) {
                var nodeId = data.node.key;
                console.log(nodeId);
           },*/
		};
		if(nodoSeleccionado != "") {
			delete configuracion.select;
		}
//	$(document).ready(function() {    	
    	$("#treebox_<?php echo $campo; ?>").fancytree(configuracion);
	//var rootNode = $("#treeboxbox_tree3").fancytree("getRootNode");
	
	var tree = $("#treebox_<?php echo $campo; ?>").fancytree("getTree");
	
	<?php if($parametros["onNodeSelect"]!=""){?>
		$("#treebox_<?php echo $campo; ?>").on("fancytreeselect", (<?php echo $parametros["onNodeSelect"]; ?>));
	<?php }?>
	
	<?php if($parametros["onNodeDblClick"]!=""){?>
		$("#treebox_<?php echo $campo; ?>").on("fancytreedblclick", (<?php echo $parametros["onNodeDblClick"]; ?>));
	<?php }?>
	
    $("input[name=stext_<?php echo $campo; ?>]").keyup(function(e){
	    var coincidencias = " coincidencias";
        var n,
          //tree = $.ui.fancytree.getTree(),
          opts = {};
        //var filterFunc = tree.filterBranches;
        var filterFunc = tree.filterNodes;
        var match = $(this).val();

        //opts.mode = "hide";
        opts.mode = "dimm";

        if(e && e.which === $.ui.keyCode.ESCAPE || $.trim(match) === ""){
          $("button#btnSearch_<?php echo $campo; ?>").click();
          return;
        }
          // Pass a string to perform case insensitive matching. Puede pasar un 3er parametro opts
        n = filterFunc.call(tree, match);
        if(n == 1) {
        	coincidencias = " coincidencia";
        }
        $("button#btnSearch_<?php echo $campo; ?>").attr("disabled", false);
        $("span#matches_<?php echo $campo; ?>").text("(" + n + coincidencias + ")");
      }).focus();

      $("button#btnSearch_<?php echo $campo; ?>").click(function(e){
        $("input[name=stext_<?php echo $campo; ?>]").val("");
        $("span#matches_<?php echo $campo; ?>").text("");
        tree.clearFilter();
      }).attr("disabled", true);
	});

	function receiveMessage(event) {
		// Do we trust the sender of this message?  (might be
		// different from what we originally opened, for example).
		/*if (event.origin !== "http://example.org") {
		  return;
		}*/

		var source = event.source.frameElement; //this is the iframe that sent the message
		var message = event.data; //this is the message

		var tree = $("#treebox_<?php echo $campo; ?>").fancytree('getTree');
		console.log("<?php echo $parametros["ruta_db_superior"].$xml; ?>");
		var newSourceOption = {
		    url: "<?php echo $parametros["ruta_db_superior"].$xml; ?>",
		    type: 'POST',
		    data: {
				/*otras_categorias: 1,
				serie_sin_asignar: 1*/
		    },
		    dataType: 'json'
		  };
		tree.reload(newSourceOption);

	}
	window.addEventListener("message", receiveMessage, false);

</script>
</html>

<?php
/*  $("#tree").on("fancytreeselect", function(event, data){ if( data.node.isFolder() ){ return false; } });*/
}
?>
