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
include_once ($ruta_db_superior . "header.php");
include_once ($ruta_db_superior . "librerias_saia.php");
$archivo = "test_calidad.php";
$cadena = "";

?>
<link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css">
<script type="text/javascript" src="../../js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="../../js/dhtmlXTree.js"></script>
<style type="text/css" media="screen">
#div_contenido {
   overflow: hidden;
}
	</style>
<table  border="0" >
  <tr>
    <td>
        <?php
					echo(librerias_jquery('1.7'));
					global $raiz_saia;
					$raiz_saia="../../";
					echo(librerias_notificaciones());
        ?>
      
    	<div id="esperando"><img src="../../imagenes/cargando.gif"></div>
      <hr/>   
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
				tree_calidad = new dhtmlXTreeObject("treeboxbox_tree_calidad", "340px", $(document).height(), 0);
				tree_calidad.setImagePath("../../botones/formatos/");
				tree_calidad.enableIEImageFix(true);
				tree_calidad.setXMLAutoLoadingBehaviour("id");
				tree_calidad.setImageArrays("plus", "plus.gif", "plus.gif", "plus.gif", "plus.gif", "plus.gif");
				tree_calidad.setImageArrays("minus", "minus.gif", "minus.gif", "minus.gif", "minus.gif", "minus.gif");
				tree_calidad.setOnLoadingStart(cargando);
				tree_calidad.setOnLoadingEnd(fin_cargando);
				tree_calidad.setOnClickHandler(onNodeSelect);
				tree_calidad.enableAutoTooltips(true);
				tree_calidad.setXMLAutoLoading("<?php echo($archivo); ?>");
				tree_calidad.enableSmartXMLParsing(true);
				tree_calidad.loadXML("<?php echo($archivo); ?>");
				
				function onNodeSelect(nodeId) {
					var accion = 0;
					var llave = 0;
					llave = tree_calidad.getParentId(nodeId);
					tree_calidad.closeAllItems(tree_calidad.getParentId(nodeId))
					tree_calidad.openItem(nodeId);
					tree_calidad.openItem(tree_calidad.getParentId(nodeId));
			
					var bases_calidad = nodeId.split('|');
			
					if (bases_calidad[0] == 'bcp') {//PADRE: BASES DE CALIDAD
						conexion = "../bases_calidad/previo_mostrar_bases_calidad.php?iddoc=todos";
					} else if (bases_calidad[0] == 'bc') {//HIJOS DE BASES DE CALIDAD
						conexion = "../bases_calidad/previo_mostrar_bases_calidad.php?iddoc=" + bases_calidad[1];
					} else {//MACROPROCESO-PROCESO,
						accion = "mostrar";
						conexion = "parsear_accion_arbol.php?riesgos=2&id=" + nodeId + "&accion=" + accion + "&llave=" + llave + "&pantalla=calidad";
					}
					window.parent.open(conexion, "detalles");
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
			
				function fin_cargando() {
					if (browserType == "gecko")
						document.poppedLayer = eval('document.getElementById("esperando")');
					else if (browserType == "ie")
						document.poppedLayer = eval('document.getElementById("esperando")');
					else
						document.poppedLayer = eval('document.layers["esperando"]');
					document.poppedLayer.style.visibility = "hidden";
					
					<?php if(@$_REQUEST["item"]){ ?>
					var item="<?php echo $_REQUEST["item"]; ?>";
					tree_calidad.selectItem(item,true,false);
					<?php } 
					$iddoc_mapa_proceso=busca_filtro_tabla("idformato","formato","lower(nombre)='proceso'","",$conn);
					?>
					if (parseInt($('#ejecutar_evento_mapa_proceso').val()) == 1) {
						tree_calidad.selectItem(parseInt('<?php echo($iddoc_mapa_proceso[0]['idformato']); ?>'),true,false); /*por defecto Mapa de proceso*/
						$('#ejecutar_evento_mapa_proceso').val(0);
					}
				}
			</script>
    </td>
  </tr>
</table>
<input type="hidden" id="ejecutar_evento_mapa_proceso" value="1">