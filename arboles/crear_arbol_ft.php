<?php

class ArbolFt {

	private $cadenas = [
		"loading" => "Cargando...",
		"loadError" => "Error en la carga!",
		"moreData" => "Mas...",
		"noData" => "Sin datos."
	];
	
	private $opciones_filtro = [
		"autoApply" => true,   // Re-apply last filter if lazy data is loaded
		"autoExpand" => true, // Expand all branches that contain matches while filtered
		"counter" => true,     // Show a badge with number of matching child nodes near parent icons
		"fuzzy" => false,      // Match single characters in order, e.g. 'fb' will match 'FooBar'
		"hideExpandedCounter" => true,  // Hide counter badge if parent is expanded
		"hideExpanders" => false,       // Hide expanders if all child nodes are hidden by filter
		"highlight" => true,   // Highlight matches by wrapping inside <mark> tags
		"leavesOnly" => false, // Match end nodes only
		"nodata" => true,      // Display a 'no data' status node if result is empty
		"mode" => "hide"      // Grayout unmatched nodes (pass "hide" to remove unmatched node instead)
	];
	
	private $opciones = [
		"icon" => false,
		"debugLevel" => 1,
		"autoScroll" => true, // Automatically scroll nodes into visible area.
		"quicksearch" => true, // Navigate to next node by typing the first letters.
		"keyboard" => false, // Support keyboard navigation.
		"selectMode" => 1, //1: single 2: multi 3: multi-hier
	    "clickFolderMode" =>2            
	];

	private $campo;
	private $fuente_datos;
	private $opciones_arbol;
	private $extensiones;
	private $con_filtro = false;

	public function __construct($campo, $fuente_datos, $opciones_arbol = array(), $extensiones = array()) {
		$this->fuente_datos = $fuente_datos;
		$this->opciones_arbol = $opciones_arbol;
		$this->extensiones = $extensiones;
		$this->campo = $campo;
	}
	
	private function procesar_opciones() {
		//Poner traducciones de los mensajes
		$this->opciones_arbol["strings"] = $this->cadenas;
		
		$this->opciones_arbol["source"] = $this->fuente_datos["url"];
		$this->opciones_arbol["source"]["data"] = $this->fuente_datos["url"]["params"];
		
		if(isset($this->opciones_arbol["busqueda_item"]) && $this->opciones_arbol["busqueda_item"]) {
			$this->con_filtro = true;
			$opciones_filtro = array();
			if(isset($this->extensiones["filter"])) {
				if(!empty($this->extensiones["filter"])) {
					$opciones_filtro = $this->extensiones["filter"];
					$this->opciones_filtro = array_merge($this->opciones_filtro, $opciones_filtro);
				} else {
					$this->extensiones["filter"] = $this->opciones_filtro;
				}
			} else {
				$this->extensiones["filter"] = $this->opciones_filtro;
			}
		}
		if(empty($this->opciones_arbol)) {
			$this->opciones_arbol = $this->opciones;
		} else {
			$opciones = array_merge($this->opciones, $this->opciones_arbol);
			$this->opciones_arbol = $opciones;
		}
		
	}
	
	function crear_arbol($xml, $campo, $parametros) {
		if($this->con_filtro) {
			?>
	    <p>
	<label>Buscar:</label> <input name="stext_<?php echo $campo; ?>"
		placeholder="Buscar..." autocomplete="off">
	<button id="btnSearch_<?php echo $campo; ?>">&times;</button>
	<span id="matches_<?php echo $campo; ?>"></span>
</p>
	 <?php
	}
	?>
	<div id="treebox_<?php echo $campo; ?>"></div>
<input type="hidden" class="required" name="<?php echo $campo; ?>"
	id="<?php echo $campo; ?>">
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

</script>
</html>

<?php
	/* $("#tree").on("fancytreeselect", function(event, data){ if( data.node.isFolder() ){ return false; } }); */
}
}

if(isset($_REQUEST["xml"]) && isset($_REQUEST["campo"])) {
	$parametros = procesar_solicitud();
	$url = parse_url($_REQUEST["xml"]);
	$params_url = array();
	if(isset($url["query"])) {
		$params_url = $url["query"];
	}
	$fuente = array("url" => $url["path"], "params" => $params_url, "ruta_db_superior" => $parametros["ruta_db_superior"]);
	unset($parametros["ruta_db_superior"]);

	$arbol = new ArbolFt($_REQUEST["campo"], $fuente, $parametros);
/*
data: {
	xml: xml1,
	campo: "iddependencia",
	selectMode: 1,
	ruta_db_superior: "../../",
	seleccionar_todos: 1,
	busqueda_item: 1,
	expandir: 3
}*/
$arbol -> crear_arbol($parametros);	
}


function procesar_solicitud() {
	$parametros = array();
	if($_REQUEST["xml"] != "" && $_REQUEST["campo"]) {
		$parametros = array(
			"selectMode" => 2,
			// "abrir_cargar" => 0,
			"busqueda_item" => 0,
			"onNodeSelect" => "",
			"ruta_db_superior" => "",
			"expandir" => 4,
			"seleccionar_todos" => ""
		);
		if(isset($_REQUEST["selectMode"])) {
			$parametros["selectMode"] = $_REQUEST["selectMode"];
		}
		/*
		 * if (isset($_REQUEST["abrir_cargar"])) {
		 * $parametros["abrir_cargar"] = $_REQUEST["abrir_cargar"];
		 * }
		 */
		if(isset($_REQUEST["onNodeSelect"])) {
			$parametros["onNodeSelect"] = $_REQUEST["onNodeSelect"];
		}
		if(isset($_REQUEST["ruta_db_superior"])) {
			$parametros["ruta_db_superior"] = $_REQUEST["ruta_db_superior"];
		}
		if(isset($_REQUEST["busqueda_item"])) {
			$parametros["busqueda_item"] = $_REQUEST["busqueda_item"];
		}
		if(isset($_REQUEST["expandir"])) {
			$parametros["expandir"] = $_REQUEST["expandir"];
		}
	}
	return $parametros;
}
?>
