<?php
include_once("../../db.php");
include_once("../../header.php");
?>
<table width=100% height=100% border=0>
  <tr height=70%>
    <td colspan="2">
      <link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css">
    	<script type="text/javascript" src="../../js/dhtmlXCommon.js"></script>
    	<script type="text/javascript" src="../../js/dhtmlXTree.js"></script>
    	<div id="treeboxbox_tree_calidad" style="height:100%;width:100%" ></div>
    	<script type="text/javascript">
      <!--
    			tree_calidad=new dhtmlXTreeObject("treeboxbox_tree_calidad","100%","100%",0);
    			tree_calidad.setImagePath("../../imgs/");
    			tree_calidad.enableIEImageFix(true);
    			tree_calidad.setOnClickHandler(onNodeSelect);
    			tree_calidad.loadXML("test_upload.xml");
    			tree_calidad.enableCheckBoxes(true);
    			tree_calidad.enableThreeStateCheckboxes(true);
    	function onNodeSelect(nodeId){
        var accion=0;
        var llave=0;
        llave=tree_calidad.getParentId(nodeId);
        tree_calidad.closeAllItems(tree_calidad.getParentId(nodeId))
        tree_calidad.openItem(nodeId);
        tree_calidad.openItem(tree_calidad.getParentId(nodeId));
        //tree2.refreshItem(nodeId);
        accion="mostrar";
        conexion="parsear_accion_arbol.php?id="+nodeId+"&accion="+accion+"&llave="+llave;
        window.parent.open(conexion,"detalles");
      }
    	-->
    	</script>
    </td>
  </tr>
</table>
<?php
include_once("../../footer.php");
?>
