<?php
include_once("../../db.php");
include_once("../../header.php");
$archivo="test_riesgos2.php";
if(@$_REQUEST["iddocumento"]){
 $archivo.= '?iddocumento='.$_REQUEST["iddocumento"];
}
if($_REQUEST["seleccionar"]){
	$datos_seleccionar=explode("-",$_REQUEST["seleccionar"]);
   	$id=busca_filtro_tabla("id".$datos_seleccionar[2],$datos_seleccionar[2],"documento_iddocumento=".$datos_seleccionar[3],"");
   	$nodoinicial=$datos_seleccionar[0]."-".$datos_seleccionar[1]."-".$id[0]["id".$datos_seleccionar[2]];
}
$cadena="";
?>
<link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css">
<script type="text/javascript" src="../../js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="../../js/dhtmlXTree.js"></script>
<style type="text/css" media="screen">
#div_contenido {
   overflow: hidden;
}
	</style>
<table  border="0">
  <tr>
    <td>
    	<div id="esperando"><img src="../../assets/images/cargando.gif"></div>
    	Buscar: <input type="text" id="stext" width="200px" size="25"><br>
          <a href="javascript:void(0)" onclick="tree_riesgos.findItem(document.getElementById('stext').value,0,1)"> Buscar</a>  |
            <a href="javascript:void(0)" onclick="tree_riesgos.findItem(document.getElementById('stext').value)"> Siguiente</a>  |
            <a href="javascript:void(0)" onclick="tree_riesgos.findItem(document.getElementById('stext').value,1)"> Anterior</a><br /><br />
            <a href="../../graficos/listado_graficos.php?lreportes=161&lgraficos=-1" target="detalles">Gr&aacute;ficos y Reportes</a><br /><br />
    	<div id="treeboxbox_tree_riesgos" ></div>
    	<script type="text/javascript">
      <!--
      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree_riesgos=new dhtmlXTreeObject("treeboxbox_tree_riesgos","340px","300px",0);
			tree_riesgos.setImagePath("../../botones/formatos/");
			tree_riesgos.enableIEImageFix(true);
			tree_riesgos.setXMLAutoLoadingBehaviour("id");
			tree_riesgos.setImageArrays("plus","plus.gif","plus.gif","plus.gif","plus.gif","plus.gif");
			tree_riesgos.setImageArrays("minus","minus.gif","minus.gif","minus.gif","minus.gif","minus.gif");
      tree_riesgos.setOnLoadingStart(cargando);
      tree_riesgos.setOnLoadingEnd(fin_cargando);
      tree_riesgos.enableSmartXMLParsing(true);
			tree_riesgos.setOnClickHandler(onNodeSelect);
			tree_riesgos.enableAutoTooltips(true);
			tree_riesgos.setXMLAutoLoading("<?php echo($archivo); ?>");
			tree_riesgos.loadXML("<?php echo($archivo); ?>");
    	function onNodeSelect(nodeId){
        var accion=0;
        var llave=0;
        llave=tree_riesgos.getParentId(nodeId);
        tree_riesgos.closeAllItems(tree_riesgos.getParentId(nodeId))
        tree_riesgos.openItem(nodeId);
        tree_riesgos.openItem(tree_riesgos.getParentId(nodeId));
        //tree2.refreshItem(nodeId);
        accion="mostrar";
        conexion="parsear_accion_arbol.php?id="+nodeId+"&accion="+accion+"&llave="+llave+"&enlace_adicionar_formato=1&riesgos=2";
        window.parent.open(conexion,"detalles");
      }
      function fin_cargando() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando")');
        else
           document.poppedLayer =
              eval('document.layers["esperando"]');
        document.poppedLayer.style.visibility = "hidden";
        <?php if(@$_REQUEST["seleccionar"]!=''){ ?>
        //tree_riesgos.selectItem("170-ft_riesgos_proceso-25",true,false);
        tree_riesgos.selectItem("<?php echo $nodoinicial; ?>",true,false);
        <?php } ?>
      }
      function cargando() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando")');
        else
           document.poppedLayer =
               eval('document.layers["esperando"]');
        document.poppedLayer.style.visibility = "visible";
      }
    	-->
    	</script>
    </td>
  </tr>
</table>
<?php
include_once("../../footer.php");
?>

