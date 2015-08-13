<?php
include_once("../../db.php");
$archivo="test_clientes.php";
$cadena="";
?>
<head>
<link type="text/css" rel="stylesheet" media="screen" href="../librerias/estilo.css">
<script type="text/javascript" src="../../js/jquery.js"></script>
<?php
$alto=90;
$ancho=260;
$estilo='
<style type="text/css">
#sliderWrap {
margin: 0 auto;
width: '.$ancho.'px;
background-color:#00FF00;
z-index=999;
}
#slider {
position: absolute;
background-color:#000000;
background-repeat:no-repeat;
background-position: bottom;
width: '.($ancho+5).'px;
height: '.$alto.'px;
margin-top: -'.$alto.'px;
z-index=999;
}
#slider img {
border: 0;
z-index=999;
}
#sliderContent {
margin: 1px 0 0 1px;
position: absolute;
text-align:center;
background-color:#FFFFFF;
color:#333333;
font-weight:bold;
padding: 10px;
height:'.($alto-2).'px;
width: '.($ancho+3).'px;
z-index=999;
}
#header {
margin: 0 auto;
width: 100%;
background-color: #FFFFFF;
height: '.($alto).'px;
padding: 0px;
z-index=999;
}
#openCloseWrap {
position:absolute;
margin: '.($alto+3).'px 0 0 '.($ancho-60).'px;
font-size:9px;
font-weight:bold;
font-family:verdana;
z-index=999;
}
</style>
';
echo($estilo);
?>
<script type="text/javascript">
$(document).ready(function() {
	$(".topMenuAction").click( function() {
		click_menu();
	});
});
function click_menu(){
if ($("#openCloseIdentifier").is(":hidden")) {
			$("#slider").animate({
				marginTop: "-<?php echo($alto);?>px"
				}, 500 );
			$("#topMenuImage").html('Acciones <img src="../../images/open.png" alt="Acciones" />');
			$("#openCloseIdentifier").show();
		} else {
			$("#slider").animate({
				marginTop: "-10px"
				}, 500 );
			$("#topMenuImage").html('Acciones <img src="../../images/close.png" alt="Acciones" />');
			$("#openCloseIdentifier").hide();
		}
} 
</script>
</head>
<link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css">
<script type="text/javascript" src="../../js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="../../js/dhtmlXTree.js"></script>
<table width=100% height=95% border="0">
  <tr>
    <td valign='top'>
    	<div id="sliderWrap">
		<div id="openCloseIdentifier"></div>
		<div id="slider">
			<div id="sliderContent">
        Por Favor Seleccione un Documento
      </div>
			<div id="openCloseWrap" valign="top">
				<a href="#" class="topMenuAction" id="topMenuImage" style="text-decoration:none;">Acciones <img src="../../images/open.png" alt="Acciones" /></a>
			</div>
		</div>
	 </div>
 	  <div id="header">
     <div id="esperando"><img src="../../imagenes/cargando.gif"></div>
     <span class="phpmaker"><br>
     Listado de Clientes: <br />                                 
      Buscar:<br><input type="text" id="stext" width="200px" size="20">      
      <a href="javascript:void(0)" onclick="tree_clientes.findItem(document.getElementById('stext').value,1)">
      <img src="../../botones/general/anterior.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree_clientes.findItem(document.getElementById('stext').value,0,1)">
      <img src="../../botones/general/buscar.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree_clientes.findItem(document.getElementById('stext').value)">
      <img src="../../botones/general/siguiente.png"border="0px"></a>
     </span>  	
    </div><br />
    <div id="treeboxbox_tree_clientes"></div>
    </td>
  </tr>
</table>
<script type="text/javascript">
      <!--
      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko";
      }        
			tree_clientes=new dhtmlXTreeObject("treeboxbox_tree_clientes","280px","300px",0);
      tree_clientes.setImagePath("../../botones/formatos/");
			tree_clientes.enableIEImageFix(true);
			tree_clientes.enableAutoTooltips(1);
			tree_clientes.enableTreeImages("false");
      tree_clientes.enableTreeLines("true");
      tree_clientes.enableTextSigns("true");
			tree_clientes.setOnLoadingStart(cargando);
      tree_clientes.setOnLoadingEnd(fin_cargando);
      //tree_clientes.enableSmartXMLParsing(true);
      tree_clientes.setOnClickHandler(onNodeSelect);
			tree_clientes.loadXML("<?php echo($archivo); ?>");
			//alert(item);
			//tree_clientes.focusItem(item);
			//tree_clientes.openItem(98);
			//click_menu();
      //setTimeout('tree_clientes.selectItem(item,true,false)',400);
      <?php
      if(!isset($_REQUEST["no_seleccionar"]))
         echo "setTimeout('tree_clientes.selectItem(item,true,false)',400);";
      ?> 
			function esperar(){
      }
			function onNodeSelect(nodeId)
      {
        var llave=0;
        llave=tree_clientes.getParentId(nodeId);
        tree_clientes.closeAllItems(tree_clientes.getParentId(nodeId))
        tree_clientes.openItem(nodeId);
        tree_clientes.openItem(tree_clientes.getParentId(nodeId));
        genera_menu(nodeId);
        $("#slider").animate({
				marginTop: "-10px"
				}, 500 );
				$("#topMenuImage").html('Acciones <img src="../../images/close.png" alt="Acciones" />');
			  $("#openCloseIdentifier").hide();
        conexion="../arboles/parsear_accion_arbol.php?id="+nodeId+"&accion=mostrar&llave="+llave+"&enlace_adicionar_formato=1";
        window.parent.frames["detalles"].location=conexion;
      }
			function seleccion_accion(accion,id)
      {
        var nodeId=0;
        var llave=0;
        nodeId=tree_clientes.getSelectedItemId();
        if(!nodeId){
          alert("Por Favor seleccione un documento del arbol");
          return;
        }
        llave=tree_clientes.getParentId(nodeId);

        tree_clientes.closeAllItems(tree_clientes.getParentId(nodeId))
        tree_clientes.openItem(nodeId);
        tree_clientes.openItem(tree_clientes.getParentId(nodeId));
        conexion="parsear_accion_arbol.php?id="+nodeId+"&accion="+accion+"&llave="+llave;
        window.parent.open(conexion,"detalles");
      }
      function genera_menu(nodeId){
        $.ajax({
          type:'POST',
          url:'../arboles/genera_menu_documento.php',
          data:'nodo='+nodeId,
          success: function(datos,exito){
            $("#sliderContent").empty();
            $("#sliderContent").append(datos);
          }
        });
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
              eval('document.layers["esperando_"]');
        document.poppedLayer.style.visibility = "hidden";
      }

      function cargando() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando")');
        else
           document.poppedLayer =
               eval('document.layers["esperando"]');
        document.poppedLayer.style.visibility = "visible";
        
      }
      function actualizar_papa(nodeId){
        var papa=tree_clientes.getParentId(nodeId);
        tree_clientes.closeItem(papa);
        tree_clientes.deleteItem(nodeId,true);
        //tree_clientes.refreshItem(nodeId);
        tree_clientes.findItem(papa);
      }
    	-->
    	</script>
<?php
//include_once("../../footer.php");
?>