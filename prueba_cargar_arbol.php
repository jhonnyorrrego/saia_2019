<?php include_once("formatos/librerias/header_formato.php"); ?>
<?php		
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../		
$ruta_db_superior=$ruta="";		
while($max_salida>0){		
  if(is_file($ruta."db.php")){		
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada		
  }		
  $ruta.="../";		
  $max_salida--;		
}    		
include_once($ruta_db_superior."db.php");		
include_once($ruta_db_superior."librerias_saia.php");		
include_once("formatos/librerias/header_formato.php");		
echo(librerias_jquery());
echo(librerias_notificaciones());
?>
<html>
<body>
<head>
</head>
  <meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="js/dhtmlXTree.js"></script>
<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
<button id="crear_nodo">Crear Nodo</button>
<br>	
<br>	
<div id="esperando_serie"><img src="imagenes/cargando.gif"></div>
<div id="treeboxbox_tree2" width="100px" height="100px"></div>
<script type="text/javascript">

    $(document).ready(function(){
        $('#crear_nodo').click(function(){
            var seleccionado = tree2.getAllChecked();
            var subItems = tree2.getAllSubItems(seleccionado);
            tree2.loadXML("prueba_test_hernando.php?padre="+seleccionado+"&cantidad_hijos="+subItems.length);
        });
    });


      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","85%",0);
			tree2.setImagePath("imgs/");
			tree2.enableTreeImages(false);
			tree2.enableIEImageFix(true);
			tree2.setXMLAutoLoadingBehaviour("id");
			//tree2.setOnClickHandler(onNodeSelect);
			tree2.setOnCheckHandler(onNodeSelect);
			tree2.setOnLoadingStart(cargando_serie);
            tree2.setOnLoadingEnd(fin_cargando_serie);
            tree2.enableCheckBoxes(1);
            tree2.enableRadioButtons(true);            
            //tree2.setXMLAutoLoading("test_serie_funcionario2.php?tabla=dependencia&admin=1");
			//tree2.loadXML("test_serie_funcionario2.php?tabla=dependencia&admin=1");
			tree2.setXMLAutoLoading("prueba_test_hernando.php");
			tree2.loadXML("prueba_test_hernando.php");
	  function onNodeSelect(nodeId){
        var valor=tree2.getAllChecked();
        var vector_valor=valor.split(",");
        
        for(i=0;i<vector_valor.length;i++){
            if(vector_valor[i]!=nodeId){
                tree2.setCheck(vector_valor[i],false);
            }
        }
        
       // alert( tree2.getAllChecked() );
        
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
	</script>
	</body>
</html>
