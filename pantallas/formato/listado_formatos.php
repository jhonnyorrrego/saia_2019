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
include_once ($ruta_db_superior . "assets/librerias.php");
include_once ($ruta_db_superior . "arboles/crear_arbol_ft.php");
echo jquery();
echo bootstrap();
echo jqueryUi();
echo icons();

if(!isset($_REQUEST['no_kaiten'])){
	echo librerias_acciones_kaiten();
}

if(!isset($_REQUEST['id'])){
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
padding:13px;
}

</style>
   <link href="../../js/jquery.fancytree/2.30.0/skin-lion/ui.fancytree.css" rel="stylesheet">
  <!-- <link href="../editor_codigo/js/skin-lion/ui.fancytree.css" rel="stylesheet">  -->
  <script src="../../js/jquery.fancytree/2.30.0/modules/jquery.fancytree.js"></script>
  <script src="../../js/jquery.fancytree/2.30.0/modules/jquery.fancytree.table.js"></script>
  <script src="../../js/jquery.fancytree/2.30.0/modules/jquery.fancytree.filter.js"></script>


  <!-- (Irrelevant source removed.) -->

<script type="text/javascript">
  var ruta_db_superior="<?php echo $ruta_db_superior; ?>";
  $(function(){
    // Attach the fancytree widget to an existing <div id="tree"> element
    // and pass the tree options as an argument to the fancytree() function:
    $("#tree_campo_idformato").fancytree({
      icon: false,
      lazy: true,
      extensions: ["filter","table"],
      table: {
        indentation: 20,      // indent 20px per node level
        nodeColumnIdx: 1,
        checkboxColumnIdx: 0     // render the node title into the 2nd column
          // render the checkboxes into the 1st column
      },
      click: function(event,data){
      	var nodeId = data.node.key;
		var title =  data.node.title;
		var elemento_evento = $.ui.fancytree.getEventTargetType(event.originalEvent);
		if(elemento_evento == 'title') {
			abrir_kaiten("pantallas/generador/iframe_generador.php?nokaiten=1&idformato="+nodeId,title);
			//window.location= ruta_db_superior+"pantallas/generador/generador_pantalla.php?idformato="+nodeId;
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
      source: {
        url: ruta_db_superior+"arboles/arbol_formatos.php"
      },
      lazyLoad: function(event, data) {
        data.result = {url: "ajax-sub2.json"}
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


    /* Handle custom checkbox clicks */
     /*$("#tree_campo_idformato").on("onNodeClick", function(e){
     	console.log($.ui.fancytree.getEventTargetType())
      	var node = $.ui.fancytree.getNode(e),
        $input = $(e.target);
      	e.stopPropagation();  // prevent fancytree activate for this row
      	var nodeId = node.key;
		var title =  node.title;
		    	//abrir_kaiten("pantallas/generador/iframe_generador.php?nokaiten=1&idformato="+nodeId,title);
        	//window.location= ruta_db_superior+"pantallas/generador/generador_pantalla.php?idformato="+nodeId;
    });*/


    var tree = $("#tree_campo_idformato").fancytree("getTree");


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

 <?= theme() ?>
</head>
<body>
<div class="container">
  <!-- Add a <table> element where the tree should appear: -->
  	<div class="row">
      	<div class="col-sm">
            <label>Filtro:</label>
            <input name="search" placeholder="Filtrar..." autocomplete="off">
            <button id="btnResetSearch">&times;</button>
            <span id="matches"></span>
        </div>
        <div class="col-sm">
        	<input id="nuevo_formato" class="btn btn-primary" type="button" value="Nuevo">
        </div>
  </div>
  <table class="table table-bordered" id="tree_campo_idformato" width="85%;">
    <thead>
      <tr> <td class="bold Default alignCenter" style="font-size: 11px;">N°</td> <td class="bold Default alignCenter" style="font-size: 11px;">Formatos</td> <td class="bold Default alignCenter" style="font-size: 11px;">Descripci&oacute;n</td> <td class="bold Default alignCenter" style="font-size: 11px;">Versi&oacute;n</td> </tr>
    </thead>
    <!-- Otionally define a row that serves as template, when new nodes are created: -->
    <tbody>
      <tr>
        <td class="hint-text" style="font-size: 11px;"></td>
        <td class="hint-text" style="font-size: 11px;"></td>
        <td class="hint-text" style="font-size: 11px;"></td>
        <td class="hint-text" style="font-size: 11px;"></td>

      </tr>
    </tbody>
  </table>
<script type="text/javascript">
$(document).ready(function() {
	$("#nuevo_formato").click(function() {
		console.log("LCDTM");
		abrir_kaiten("pantallas/generador/iframe_generador.php?nokaiten=1","Nuevo formato");
	});
});
</script>
  <!-- (Irrelevant source removed.) -->
</body>
</div>
</html>
<?php
}else{
	echo (librerias_jquery("3.3"));
	echo (estilo_bootstrap());
	echo librerias_UI("1.12");
	echo librerias_arboles_ft("2.24", 'filtro');
	$origen = array("url" => "arboles/arbol_formatos.php", "ruta_db_superior" => $ruta_db_superior,"params" => array("id" => $_REQUEST['id'],"cargar_seleccionado" => $_REQUEST['cargar_seleccionado']));
	$opciones_arbol = array("keyboard" => true, "onNodeClick" => "evento_click", "busqueda_item" => 1);
	$extensiones = array("filter" => array());
	$arbol = new ArbolFt("campo_idformato", $origen, $opciones_arbol, $extensiones, $validaciones);
	?><!doctype html>
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
  	<div class="container">
  		<?= $arbol->generar_html() ?>
  	</div>
	<script type="text/javascript">
		var ruta_db_superior = "<?php echo $ruta_db_superior; ?>";
		var idformato = "<?php echo $_REQUEST['id']; ?>";

			if(!idformato){
				function evento_click(event, data) {
			        var nodeId = data.node.key;
			        var title =  data.node.title;
			        var elemento_evento = $.ui.fancytree.getEventTargetType(event.originalEvent);
			        if(elemento_evento == 'title') {
			        	abrir_kaiten("pantallas/generador/iframe_generador.php?nokaiten=1&idformato="+nodeId,title);
			        	//window.location= ruta_db_superior+"pantallas/generador/generador_pantalla.php?idformato="+nodeId;
					}
				}
			}else{
				function evento_click(event, data) {
			        var nodeId = data.node.key;
			        var title =  data.node.title;
	        		//console.log($("#admin_generador",window.parent.document));
	        		var elemento_evento = $.ui.fancytree.getEventTargetType(event.originalEvent);
			        if(elemento_evento == 'title') {
		        		$("#iframe_generador",window.parent.document).attr("src", ruta_db_superior+"pantallas/generador/generador_pantalla.php?idformato="+nodeId)
			        	//window.location= ruta_db_superior+"pantallas/generador/generador_pantalla.php?idformato="+nodeId;
					}
					//$("#admin_generador").attr("src","vacio.php");
			        /*var elemento_evento = $.ui.fancytree.getEventTargetType(event.originalEvent);
			        if(elemento_evento == 'title') {*/
			        	/*$("#admin_generador",window.parent.document).load(ruta_db_superior+"pantallas/generador/generador_pantalla.php?idformato="+idformato+" admin_generador",
				        	function(response){
				        		$("#admin_generador",window.parent.document).html($(response).find("#admin_generador").contents());
				        		//console.log($("#admin_generador",window.parent.document).length)
				        		}
			        	)
							//$("#admin_generador").load("vacio.php");*/
				//}
				}
			}
		</script>
	</body>
</html>
<?php
//echo librerias_UI("1.12");
}
?>
