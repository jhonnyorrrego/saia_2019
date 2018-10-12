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
include_once ($ruta_db_superior . "arboles/crear_arbol_ft.php");

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
<?php
echo (estilo_bootstrap());

echo(librerias_jquery("2.2"));
?>
<script src="<?php echo $ruta_db_superior;?>js/jquery-migrate/jquery-migrate-1.4.1.js"></script>
<?php

echo librerias_UI("1.12");

echo librerias_arboles_ft("2.24", 'filtro');
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
    width: 100%;
    height: 80%;
    overflow: auto;
    position: relative;
    border: none;
}
</style>

<script type="text/javascript">
	$(function() {
   	   	var configuracion = {
    	   	icon: false,
    	   	lazy: true,
            strings: {
                loading: "Cargando...",
                loadError: "Error en la carga!",
                moreData: "Mas...",
                noData: "Sin datos."
            },
            debugLevel: 4,
            extensions: ["filter"],
            //autoScroll: true,
            quicksearch: true,
            //keyboard: true,
            selectMode:1,
            clickFolderMode:2,

            source: {
                url: "../../arboles/arbol_dependencia_serie.php",
                data: {
					cargar_partes: 1,
                    otras_categorias: 1,
                	serie_sin_asignar: 1
                }
            },
			lazyLoad: function(event, data){
			      var node = data.node;
			      // Load child nodes via Ajax GET /getTreeData?mode=children&parent=1234
			      data.result = $.ajax({
			        url: "../../arboles/arbol_dependencia_serie.php",
			        data: {
				        cargar_partes: 1,
				        id: node.key
				    },
			        cache: false
			      });
			      //console.log(data.result);
			},
			loadChildren: function(event, data) {
				var match = $("#buscador").val();
				data.node.visit(function(subNode){
					// quitar la condicion subNode.isExpanded() si filtra
				    if(match && match != "" && subNode.isUndefined() && !subNode.isExpanded() ) {
				        subNode.load();
				    }
				});
			},
            filter: {
                autoApply: true,
                autoExpand: true,
                counter: true,
                fuzzy: false,
                hideExpandedCounter: true,
                hideExpanders: false,
                highlight: true,
                leavesOnly: false,
                nodata: true,
                mode: "hide"
            },
            select: function(event, data) { // Display list of selected nodes
				var seleccionados = Array();
				var items = data.tree.getSelectedNodes();
				for(var i=0;i<items.length;i++){
					seleccionados.push(items[i].key);
				}
				var s = seleccionados.join(",");
				$("#campo_idserie").val(s);
			},
            click: function(event, data) {
                var nodeId = data.node.key;
                var elemento_evento = $.ui.fancytree.getEventTargetType(event.originalEvent);
                if(elemento_evento == 'title') {
            		if(nodeId!="0.0.0" && nodeId!="0.0.-1"){
            			var datos=nodeId.split(".");
            			if(parent.serielist && datos[1]==0){
            				parent.serielist.location = "asignarserie_entidad.php?tvd="+datos[2]+"&seleccionados="+datos[0]+"&idnode=" + nodeId;
            			}else if(datos[1]!=0){
            				parent.serielist.location = "serieview.php?key="+datos[1]+"&idnode="+nodeId+"&identidad_serie="+data.node.data.entidad_serie;
            			}
            		} else if(parent.serielist) {
            			parent.serielist.location = "<?php echo $ruta_db_superior;?>vacio.php";
            		}
                }
                if(data.node.isFolder()) {
        			data.tree.activateKey(nodeId);
                }
			}
		};
   	   	$("#treebox_campo_idserie").fancytree(configuracion);

   	   	var tree = $("#treebox_campo_idserie").fancytree("getTree");

   	   	$("input[name=stext_campo_idserie]").keyup(function(e) {
	      var coincidencias = " coincidencias";
	      var n;
	      var tree = $.ui.fancytree.getTree();
	      var opts = {};
	      var filterFunc = tree.filterNodes;
	      var match = $(this).val();

	      opts.mode = "dimm";

	      if(e && e.which === $.ui.keyCode.ESCAPE || $.trim(match) === ""){
	          $("button#btnResetSearch_campo_idserie").click();
	          return;
	      }
	      // Pass a string to perform case insensitive matching. Puede pasar un 3er parametro opts
	      n = filterFunc.call(tree, match);
	      if(n == 1) {
	          coincidencias = " coincidencia";
	      }
          if(n > 0) {
  	        $("button#btnResetSearch_campo_idserie").attr("disabled", false);
  	        $("span#matches_campo_idserie").text("(" + n + coincidencias + ")");
          } else {
  	        var raiz = tree.getRootNode();
  	        //console.log(raiz);
  	        raiz.visit(function(subNode){
  		        //console.log(subNode.children);
                  // Cargar todos los nodos hijos lazy/sin cargar
                  // (esto disparará `loadChildren` recursivamente)
                  if(match != "" && subNode.lazy && subNode.children == null && subNode.isUndefined() && !subNode.isExpanded() ) {
                      subNode.load();
                  }
              });
          }
  	  }).focus();

	  $("button#btnResetSearch_campo_idserie").click(function(e){
          $("input[name=stext_campo_idserie]").val("");
          $("span#matches_campo_idserie").text("");
          tree.clearFilter();
	  }).attr("disabled", true);

   	});
  </script>
</head>
<body>
		<span style="font-family: Verdana; font-size: 9px;">
			<a href='serieadd.php' target='serielist'>ADICIONAR</a>
		</span>

   <p style="font-family: Verdana; font-size: 9px;">
	       <label>Buscar:</label>
	       <input name="stext_campo_idserie" id="buscador" placeholder="Buscar..." autocomplete="off">
	       <button type="button" id="btnResetSearch_campo_idserie">&times;</button>
	       <span id="matches_campo_idserie"></span>
        </p>

<div id="treebox_campo_idserie" class="arbol_saia"></div>
        <input type="hidden" class="required" name="campo_idserie" id="campo_idserie">

<script type="text/javascript">
$(document).ready(function() {
	function receiveMessage(event) {
		// Do we trust the sender of this message?  (might be
		// different from what we originally opened, for example).
		/*if (event.origin !== "http://example.org") {
		  return;
		}*/

		var source = event.source.frameElement; //this is the iframe that sent the message
		var message = event.data; //this is the message
		//console.log(message);

		var tree = $("#treebox_campo_idserie").fancytree('getTree');

		var newSourceOption = {
		    url: "<?php echo $ruta_db_superior;?>arboles/arbol_dependencia_serie.php",
		    type: 'POST',
		    data: {
				otras_categorias: 1,
				serie_sin_asignar: 1
		    },
		    dataType: 'json'
		};

		if(message) {
			if(message.accion && message.accion == "refrescar_arbol" && message.expandir) {
				tree.reload(newSourceOption).done(function() {
					var node = tree.getNodeByKey(message.expandir);
					//console.log("Expandiendo: " + message.expandir);
					//console.log(node);
					if(node) {
						node.setActive();
						node.setFocus();
						node.setExpanded(true);
						//$(tree.$container).focus();
					}
				});
			} else if(message.accion && message.accion == "refrescar_arbol") {
				tree.reload(newSourceOption);
			}
		}

	}
	window.addEventListener("message", receiveMessage, false);

});
</script>
</body>
</html>
