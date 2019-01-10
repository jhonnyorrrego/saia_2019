
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
echo(librerias_jquery());
echo(librerias_notificaciones());
?>
<html>
<body>
<head>
</head>
  <meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
<script type="text/javascript" src="<?php echo $ruta_db_superior;?>js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="<?php echo $ruta_db_superior;?>js/dhtmlXTree.js"></script>
    <link rel="STYLESHEET" type="text/css" href="<?php echo $ruta_db_superior;?>css/dhtmlXTree.css">
			  <!--span style="font-family: Verdana; font-size: 9px;">CLASIFICACI&Oacute;N DEL DOCUMENTO<br><br></span>
			  <span style="font-family: Verdana; font-size: 9px;">
        <a href='serieadd.php' target='serielist'>Adicionar&nbsp;</a>
        <a href='asignarserie_entidad.php' target='serielist'>Asignar o quitar serie/categoria</a>
        <br><br-->
			  <br />  Buscar: <input type="text" id="stext_serie_idserie" width="200px" size="25"><a href="javascript:void(0)" onclick="tree2.findItem(htmlentities(document.getElementById('stext_serie_idserie').value),1)"> <img src="<?php echo $ruta_db_superior;?>botones/general/anterior.png" alt="Buscar Anterior" border="0px"></a><a href="javascript:void(0)" onclick="tree2.findItem(htmlentities(document.getElementById('stext_serie_idserie').value),0,1)"> <img src="<?php echo $ruta_db_superior;?>botones/general/buscar.png" alt="Buscar" border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree2.findItem(htmlentities(document.getElementById('stext_serie_idserie').value))"><img src="<?php echo $ruta_db_superior;?>botones/general/siguiente.png" alt="Buscar Siguiente" border="0px"></a>
                          </span>
			  <div id="esperando_serie"><img src="<?php echo $ruta_db_superior;?>imagenes/cargando.gif"></div>
				<div id="treeboxbox_tree2" width="100px" height="100px"></div>
	<script type="text/javascript"	alert('termino');>
  <!--
      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","85%",0);
			tree2.setImagePath("<?php echo $ruta_db_superior;?>imgs/");
			tree2.enableTreeImages(false);
			tree2.enableIEImageFix(true);
			tree2.setXMLAutoLoadingBehaviour("id");
			tree2.setOnClickHandler(onNodeSelect);
			tree2.setOnLoadingStart(cargando_serie);
      		tree2.setOnLoadingEnd(fin_cargando_serie);
      
			tree2.loadXML("<?php echo $ruta_db_superior;?>pantallas/configuracion/test_tabla_cf.php?tabla=cf_docentes_comision");
			function onNodeSelect(nodeId){
        var datos=nodeId.split("-");
        if(datos[1])
        	parent.serielist.location = "<?php echo $ruta_db_superior;?>serieview.php?key=" + datos[1];
        else
        	notificacion_saia("Esto es una dependencia","error","",2500);
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

	--> 		
	</script>
	</body>
</html>
