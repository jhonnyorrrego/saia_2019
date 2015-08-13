<?php
/*
<Clase>
<Nombre>arbolserie
<Parametros>
<Responsabilidades>Codigo html para dibujar el arbol de las series
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
?>
<html>
<body>
<head>
</head>
  <meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
	<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
			  <span style="font-family: Verdana; font-size: 9px;">FORMATOS:&nbsp;<br><br></span>
				<div id="treeboxbox_tree2"></div>
	<script type="text/javascript">
  <!--		
			tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","100%",0);
			tree2.setImagePath("imgs/");
			tree2.enableIEImageFix(true);
			tree2.setOnClickHandler(onNodeSelect);
			tree2.setXMLAutoLoading("test_formatos.php");
			tree2.loadXML("test_formatos.php");
			function onNodeSelect(nodeId)
      {
        var datos=nodeId.split("#");
        if(datos[1]==2){
          window.parent.open("formatos/"+datos[2]+"/adicionar_"+datos[2]+".php","centro");
        }  
      }      
	--> 		
	</script>
	</body>
</html>
