<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
?>
<link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css">
<script type="text/javascript" src="../../js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="../../js/dhtmlXTree.js"></script>
<table width=100% border="0">
	<tr>
		<td>
		<div id="esperando"><img src="../../imagenes/cargando.gif">
		</div> Buscar:
		<input type="text" id="stext" width="200px" size="25">
		<br>
		<a href="javascript:void(0)" onclick="tree_calidad.findItem(document.getElementById('stext').value,0,1)"> Buscar</a> | <a href="javascript:void(0)" onclick="tree_calidad.findItem(document.getElementById('stext').value)"> Siguiente</a> | <a href="javascript:void(0)" onclick="tree_calidad.findItem(document.getElementById('stext').value,1)"> Anterior</a>
		<br />
		<br />
		<div id="treeboxbox_tree_calidad"></div>
		<script type="text/javascript">
			var browserType;
			if (document.layers) {
				browserType = "nn4"
			}
			if (document.all) {
				browserType = "ie"
			}
			if (window.navigator.userAgent.toLowerCase().match("gecko")) {
				browserType = "gecko"
			}
			tree_calidad = new dhtmlXTreeObject("treeboxbox_tree_calidad", "100%", "100%", 0);
			tree_calidad.setImagePath("../../botones/formatos/");
			tree_calidad.enableIEImageFix(true);

			tree_calidad.setOnLoadingStart(cargando);
			tree_calidad.setOnLoadingEnd(fin_cargando);
			tree_calidad.enableSmartXMLParsing(true);
			tree_calidad.setOnClickHandler(onNodeSelect);
			tree_calidad.enableAutoTooltips(true);
			tree_calidad.loadXML("test_calidad.php");
			
			function onNodeSelect(nodeId) {
				var llave = 0;
				llave = tree_calidad.getParentId(nodeId);
				tree_calidad.closeAllItems(tree_calidad.getParentId(nodeId))
				tree_calidad.openItem(nodeId);
				tree_calidad.openItem(tree_calidad.getParentId(nodeId));

				conexion = "parsear_accion_arbol.php?id=" + nodeId + "&accion=mostrar&llave=" + llave;
				window.parent.open(conexion, "detalles");
			}

			function fin_cargando() {
				if (browserType == "gecko")
					document.poppedLayer = eval('document.getElementById("esperando")');
				else if (browserType == "ie")
					document.poppedLayer = eval('document.getElementById("esperando")');
				else
					document.poppedLayer = eval('document.layers["esperando"]');
				document.poppedLayer.style.visibility = "hidden";
			}

			function cargando() {
				if (browserType == "gecko")
					document.poppedLayer = eval('document.getElementById("esperando")');
				else if (browserType == "ie")
					document.poppedLayer = eval('document.getElementById("esperando")');
				else
					document.poppedLayer = eval('document.layers["esperando"]');
				document.poppedLayer.style.visibility = "visible";
			}

		</script></td>
	</tr>
</table>