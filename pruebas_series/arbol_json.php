<!--pro-->
<html>
<head>
	<title>Arbol desde JSON</title>
  <meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
	<link rel="stylesheet" type="text/css" href="../css/dhtmlXTree.css">
	<script type="text/javascript" src="../js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="../js/dhtmlXTree.js"></script>
	<script type="text/javascript" src="../js/dhtmlxtree_json.js"></script>
</head>
<body>

	<div id="treeboxbox_tree2"></div>
	<script type="text/javascript">
      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
      tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","100%",0);
      tree2.setImagePath("../imgs/");
      tree2.enableIEImageFix(true);
      tree2.enableCheckBoxes(1);
      tree2.enableRadioButtons(true);
      //tree2.setOnLoadingStart(cargando_serie);
      //tree2.setOnLoadingEnd(fin_cargando_serie);
      tree2.enableThreeStateCheckboxes(true);
      tree2.enableThreeStateCheckboxes(true);
      tree2.setDataMode("json");
      tree2.setXMLAutoLoading("test_json.php");
      tree2.loadXML("test_json.php");

  	</script>
</body>
</html>