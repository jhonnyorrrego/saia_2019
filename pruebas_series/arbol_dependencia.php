<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");

?>
<!DOCTYPE html>
<html>
<head>

<?php
echo (estilo_bootstrap());

?>
<script src="../editor_codigo/js/jquery-2.2.4.js"></script>
<script src="../editor_codigo/js/jquery-migrate-1.4.1.js"></script>
<script src="../editor_codigo/js/jquery-ui/jquery-ui.min.js"></script>
<style type="text/css">
.estilo-dependencia {font-family:verdana; font-size:7pt;font-weight:bold;}
.estilo-serie {font-family:verdana; font-size:7pt;}
.estilo-serie-sa {font-family:verdana; font-size:7pt;color: red;}

</style>
<?php
echo (librerias_notificaciones());
?>

  <link href="../editor_codigo/js/skin-win8/ui.fancytree.css" rel="stylesheet">
  <!-- <link href="../editor_codigo/js/skin-lion/ui.fancytree.css" rel="stylesheet">  -->
  <script src="../editor_codigo/js/jquery.fancytree.js"></script>
  <script src="../editor_codigo/js/src/jquery.fancytree.filter.js"></script>

  <script type="text/javascript">
	$(function() {
		var nodoSeleccionado;

		$("#treeboxbox_tree3").fancytree({
			icon: false,
    		strings: {
    			loading: "Cargando...",
    			loadError: "Error en la carga!",
    			moreData: "Mas...",
    			noData: "Sin datos."
    		},
			debugLevel: 4,
			extensions: ["filter"],
			//autoScroll: true, // Automatically scroll nodes into visible area.
			quicksearch: true, // Navigate to next node by typing the first letters.
			//keyboard: true, // Support keyboard navigation.
			source: $.ajax({
				url: "arbol_dependencia_serie.php?otras_categorias=1&serie_sin_asignar=1"
			}),
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
    		    select: function(event, data) {
    			    console.log(event);
    		            // Display list of selected nodes
    		            //var s = data.tree.getSelectedNodes().join(", ");
    			    //$("#echoSelection1").text(s);
    			    //console.log(s);
       		      }

	        },
	        activate: function(event, data) {
	            //$("#echoActive").text(data.node.title);
                console.log(data.node.getKeyPath());
	            if(data.node.url)
	              window.open(data.node.url, data.node.target);
	          },

		    click: function(event, data) {
			    console.log(data.node.key);
   		      }


		});
		//var rootNode = $("#treeboxbox_tree3").fancytree("getRootNode");

		var tree = $("#treeboxbox_tree3").fancytree("getTree");

	    $("input[name=search]").keyup(function(e){
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
	          $("button#btnResetSearch").click();
	          return;
	        }
	          // Pass a string to perform case insensitive matching. Puede pasar un 3er parametro opts
	        n = filterFunc.call(tree, match);
	        if(n == 1) {
	        	coincidencias = " coincidencia";
	        }
	        $("button#btnResetSearch").attr("disabled", false);
	        $("span#matches").text("(" + n + coincidencias + ")");
	      }).focus();

	      $("button#btnResetSearch").click(function(e){
	        $("input[name=search]").val("");
	        $("span#matches").text("");
	        tree.clearFilter();
	      }).attr("disabled", true);

	});
  </script>
</head>
<body>

<!-- <div id="esperando_archivo">
	<img src="<?php echo($ruta_db_superior);?>imagenes/cargando.gif">
</div>-->
  <p>
    <label>Filtro:</label>
    <input name="search" placeholder="Filtrar..." autocomplete="off">
    <button id="btnResetSearch">&times;</button>
    <span id="matches"></span>
  </p>

<div id="treeboxbox_tree3" class="arbol_saia"></div>
<div id="dialog-confirm"></div>

<script type="text/javascript">
$(document).ready(function() {
	var alto = <?php echo(intval($_REQUEST["alto"]));?>;
	var browserType;
	var tab_acciones = false;
	if (document.layers) {
		browserType = "nn4"
	}
	if (document.all) {
		browserType = "ie"
	}
	if (window.navigator.userAgent.toLowerCase().match("gecko")) {
		browserType = "gecko"
	}

	function receiveMessage(event) {
		// Do we trust the sender of this message?  (might be
		// different from what we originally opened, for example).
		/*if (event.origin !== "http://example.org") {
		  return;
		}*/

		var source = event.source.frameElement; //this is the iframe that sent the message
		var message = event.data; //this is the message
		//viene json event.data.campo
		// message.nodeId contiene la ruta original (no traducida a ../../archivo
		alert('Llego respuesta: ' + message.nodeId);
		if (message.exito == 'false') {
			//volver a seleccionar el anterior
			tree3.selectItem(message.nodeId, false, false);
		}
		nodoSeleccionado = message.nodeId;
		// event.source is popup
		// event.data is "hi there yourself!  the secret response is: rheeeeet!"
	}
	window.addEventListener("message", receiveMessage, false);

});
</script>
<?php

?>

