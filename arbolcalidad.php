<?php
include_once("db.php");
 include_once("header.php");
  echo '<table width=100% height=100% border=0>';
  echo '<tr><td width="50%">&nbsp;';
   agrega_boton("texto","botones/configuracion/default.gif","estructura_calidadlist.php","derecha","Estructura Calidad","","estructura_calidad");
   echo '</td><td>&nbsp;</td></tr>';
  echo '<tr height=95%><td colspan="2">
  <link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree_xw.js"></script>
	<div id="treeboxbox_tree_calidad" style="height:100%;width:100%" ></div>
	<script type="text/javascript">
  <!--		
			tree_calidad=new dhtmlXTreeObject("treeboxbox_tree_calidad","100%","100%",0);
			tree_calidad.setImagePath("imgs/");
			tree_calidad.enableIEImageFix(true);
			tree_calidad.setOnClickHandler(onNodeSelect);
			tree_calidad.loadXML("test_calidad.php");
	    function onNodeSelect(nodeId){
      var datos=nodeId.split("#"); 
       if(datos[2]==2){
        if(datos[3]){
          if(datos[3]=="proceso"){
            tree_calidad.closeAllItems(0);
            tree_calidad.openItem("1#0#1#proceso#");
          }            
          tree_calidad.openAllItems(nodeId); 
          window.parent.derecha.location="formatos/"+datos[3]+"/mostrar_"+datos[3]+".php?tipo=1&iddoc="+datos[1];
        }
        else
          window.parent.derecha.location="documentoview.php?key="+datos[1];   
       }   
       else if(datos[2]==1){
          tree_calidad.openItem(nodeId);
          window.parent.derecha.location="formatos/"+datos[3]+"/descripcion_"+datos[3]+".php";
       }   
       else   
          window.parent.derecha.location="about:blank";   
      }	
	--> 		
	</script></td></tr><tr height=30%><td align=center>';
  agrega_boton("texto","","../calidad_list.php","izquierda","ESTRUCTURA","","calidad");
  echo '</td></tr></table>';
include_once("footer.php");  
?>
