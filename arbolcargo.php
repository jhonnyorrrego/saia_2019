<html>
<head>
</head>
	<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
</head>
<body>
<span style="font-family: Verdana; font-size: 9px;">CARGOS:<br /></span>
<span style="font-family: Verdana; font-size: 9px;"><a href='cargoadd.php' target='cargolist'>Adicionar&nbsp;</a><br></span>
<div id="esperando_serie"><img src="imagenes/cargando.gif"></div>
    <span style="font-family: Verdana; font-size: 9px;">
  	  <br>
      Buscar:<br><input type="text" id="stext" width="200px" size="20" style="font-family: Verdana; font-size: 9px;">
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,1)">
      <img src="assets/images/anterior.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,0,1)">
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
			tree2.setXMLAutoLoading("test_serie.php?tabla=cargo");
			tree2.setOnLoadingStart(cargando_serie);
      tree2.setOnLoadingEnd(fin_cargando_serie);
			tree2.loadXML("test_serie.php?tabla=cargo&estado=1");

			function onNodeSelect(nodeId)
      {
        parent.cargolist.location="cargoview.php?key="+nodeId;
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
  //document.top.ap_showWaitMessage('waitDiv', 0);
	-->
	</script>
	</body>
</html>
