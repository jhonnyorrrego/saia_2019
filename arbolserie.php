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
echo(librerias_jquery("1.7"));
echo(librerias_arboles());
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
	</head>
	<body>
		<span style="font-family: Verdana; font-size: 9px;">
			<a href='serieadd.php' target='serielist'>ADICIONAR</a>
			<a href="permiso_serie.php" target='serielist'>PERMISOS</a>
			<br/><br/>
			 Buscar:
			<input type="text" id="stext_serie_idserie" width="200px" size="25">
			<a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById('stext_serie_idserie').value),1)"><img src="botones/general/anterior.png" alt="Buscar Anterior" border="0px"></a> <a href="javascript:void(0)" onclick="buscar_nodo();"> <img src="botones/general/buscar.png" alt="Buscar" border="0px"></a> <a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById('stext_serie_idserie').value))"><img src="botones/general/siguiente.png" alt="Buscar Siguiente" border="0px"></a> </span>
		<div id="esperando_serie"><img src="imagenes/cargando.gif">
		</div>
		<div id="treeboxbox_tree2" width="100px" height="100px"></div>
		<script type="text/javascript">
			idNodes = "";
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
			tree2 = new dhtmlXTreeObject("treeboxbox_tree2", "100%", "85%", 0);
			tree2.setImagePath("imgs/");
			tree2.enableTreeImages(false);
			tree2.enableIEImageFix(true);
			tree2.setOnClickHandler(onNodeSelect);
			tree2.setOnLoadingStart(cargando_serie);
			tree2.setOnLoadingEnd(fin_cargando_serie);
			tree2.setXMLAutoLoading("test/test_dependencia_serie.php?serie_sin_asignar=1&cargar_partes=1");
			tree2.loadXML("test/test_dependencia_serie.php?serie_sin_asignar=1&cargar_partes=1");


			function onNodeSelect(nodeId) {
				//iddep.idserie.tipo_tvd
				var datos=nodeId.split(".");
				if(datos[1]==0){
					parent.serielist.location = "asignarserie_entidad.php?tvd="+datos[2]+"&seleccionados="+datos[0]+"&idnode=" + nodeId;
				}else if(datos[1]!=0){
					parent.serielist.location = "serieview.php?key="+datos[1]+"&idnode="+nodeId;
				}
			}

			function fin_cargando_serie(opt) {
				if (browserType == "gecko") {
					document.poppedLayer = eval('document.getElementById("esperando_serie")');
				} else if (browserType == "ie") {
					document.poppedLayer = eval('document.getElementById("esperando_serie")');
				} else {
					document.poppedLayer = eval('document.layers["esperando_serie"]');
				}
				document.poppedLayer.style.display = "none";
			}

			function cargando_serie() {
				if (browserType == "gecko")
					document.poppedLayer = eval('document.getElementById("esperando_serie")');
				else if (browserType == "ie")
					document.poppedLayer = eval('document.getElementById("esperando_serie")');
				else
					document.poppedLayer = eval('document.layers["esperando_serie"]');
				document.poppedLayer.style.display = "";
			}
		</script>
	</body>
</html>
