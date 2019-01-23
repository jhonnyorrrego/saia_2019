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
include_once ($ruta_db_superior . "librerias_saia.php");

echo(librerias_jquery("2.2"));
?>
<script src="<?php echo $ruta_db_superior;?>js/jquery-migrate/jquery-migrate-1.4.1.js"></script>
<?php

echo librerias_UI("1.12");

echo librerias_arboles_ft("2.24", 'filtro');
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
	</head>
	<body>
		<span style="font-family: Verdana; font-size: 9px;">
			<a href='serieadd.php' target='serielist'>ADICIONAR</a>
		</span>
	    <p>
            <label>Buscar:</label>
            <input name="search" placeholder="Buscar..." autocomplete="off">
            <button id="btnResetSearch">&times;</button>
            <span id="matches"></span>
        </p>

		<div id="treeboxbox_tree3"></div>
<script type="text/javascript">

	var nodoSeleccionado;

	$(document).ready(function() {
    	$("#treeboxbox_tree3").fancytree({
    		icon: false,
    		debugLevel: 4,
    		extensions: ["filter"],
    		//autoScroll: true, // Automatically scroll nodes into visible area.
    		quicksearch: true, // Navigate to next node by typing the first letters.
    		//keyboard: true, // Support keyboard navigation.
    		source: $.ajax({
    			url: "arbol_dependencia_serie.php",
    			data: {
        			otras_categorias: 1,
        			serie_sin_asignar: 1
    			}
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
            },

            activate: function(event, data) {
                var nodeId = data.node.key;
                //console.log(data.node.getKeyPath());
    			if(nodeId!="0.0.0" && nodeId!="0.0.-1"){
    				var datos=nodeId.split(".");
    				if(parent.serielist && datos[1]==0){
    					parent.serielist.location = "asignarserie_entidad.php?tvd="+datos[2]+"&seleccionados="+datos[0]+"&idnode=" + nodeId;
    				}else if(datos[1]!=0){
    					parent.serielist.location = "serieview.php?key="+datos[1]+"&idnode="+nodeId;
    				}
    			} else if(parent.serielist) {
    				parent.serielist.location = "<?php echo $ruta_db_superior;?>vacio.php";
    			}
           },
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
	</body>
</html>