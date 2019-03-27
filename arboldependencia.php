<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery("1.7"));
?>
<html>
<head>
</head>
	<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
	<script type="text/javascript" src="<?php echo($ruta_db_superior); ?>pantallas/lib/librerias_arboles.js"></script>
</head>
<body>
<span style="font-family: Verdana; font-size: 9px;">DEPENDENCIAS:&nbsp;<br><br><br /></span> 
<span style="font-family: Verdana; font-size: 9px;"><a href='dependenciaadd.php' target='dependencialist'>Adicionar&nbsp;</a><br></span>
<div id="esperando_serie"><img src="imagenes/cargando.gif"></div>
    <span style="font-family: Verdana; font-size: 9px;">
  	  <br>
			<input type="text" id="stext" width="200px" size="20" style="font-family: Verdana; font-size: 9px;">
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,1)">
      <img src="assets/images/anterior.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,0,1)"-->
      <!--a href="javascript:void(0)" onclick="tree2.openAllItems(0);find_item_tree(document.getElementById('stext').value,'')"-->
      <img src="assets/images/buscar.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value)">
      <img src="assets/images/siguiente.png"border="0px"></a>
     </span><br><br>

				<div id="treeboxbox_tree2"></div>
	<script type="text/javascript">
  <!--
  var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","290px",0);
			tree2.setImagePath("imgs/");
			tree2.enableIEImageFix(true);
			tree2.setOnClickHandler(onNodeSelect);
			tree2.setXMLAutoLoading("test_serie.php?tabla=dependencia");
			tree2.setOnLoadingStart(cargando_serie);
      tree2.setOnLoadingEnd(fin_cargando_serie);
			tree2.loadXML("test_serie.php?tabla=dependencia");

			function onNodeSelect(nodeId)
      {
        parent.dependencialist.location="dependenciaview.php?key="+nodeId;
      }   
      function fin_cargando_serie() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_serie")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_serie")');
        else
           document.poppedLayer =
              eval('document.layers["esperando_serie"]');
        document.poppedLayer.style.display = "none";
      }

      function cargando_serie() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_serie")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_serie")');
        else
           document.poppedLayer =
               eval('document.layers["esperando_serie"]');
        document.poppedLayer.style.display = "";
      }
 // document.top.ap_showWaitMessage('waitDiv', 0);       
	--> 		
	</script>
	</body>
</html>
