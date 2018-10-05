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

echo(librerias_jquery("2.2"));
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
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

</head>

<body>
		<span style="font-family: Verdana; font-size: 9px;">
			<a href='serieadd.php' target='serielist'>ADICIONAR</a>
		</span>
<?php
$origen = array("url" => "arboles/arbol_dependencia_serie.php", "ruta_db_superior" => $ruta_db_superior,
    "params" => array(
        "otras_categorias" => 1,
        "serie_sin_asignar" => 1
    ));
$opciones_arbol = array("keyboard" => true, "onNodeClick" => "evento_click", "busqueda_item" => 1);
$extensiones = array("filter" => array());
$arbol = new ArbolFt("campo_idserie", $origen, $opciones_arbol, $extensiones);
echo $arbol->generar_html();
?>
<script type="text/javascript">

	function evento_click(event, data) {
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

	function receiveMessage(event) {
		// Do we trust the sender of this message?  (might be
		// different from what we originally opened, for example).
		/*if (event.origin !== "http://example.org") {
		  return;
		}*/

		var source = event.source.frameElement; //this is the iframe that sent the message
		var message = event.data; //this is the message

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
		tree.reload(newSourceOption);

	}
	window.addEventListener("message", receiveMessage, false);

</script>
	</body>
</html>
