<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
if(@$_REQUEST["idcaja"]){
	$adicional="?idcaja=".@$_REQUEST["idcaja"];
}

?>
<link rel="STYLESHEET" type="text/css" href="<?php echo $ruta_db_superior; ?>css/dhtmlXTree.css">
	<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>js/dhtmlXTree.js"></script>
	<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>js/dhtmlXTree_xw.js"></script> 
	<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>asset/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>asset/js/main.js"></script>
  Buscar :<br />
  <input type="text" id="stext_3" width="200px" size="20">      
      <a href="javascript:void(0)" onclick="tree_equipos.findItem(document.getElementById('stext_3').value,1)">
      <img src="<?php echo $ruta_db_superior; ?>assets/images/anterior.png" border="0px" alt="Anterior"></a>
      <a href="javascript:void(0)" onclick="tree_equipos.findItem(document.getElementById('stext_3').value,0,1)">
      <img src="<?php echo $ruta_db_superior; ?>assets/images/buscar.png" border="0px" alt="Buscar"></a>
      <a href="javascript:void(0)" onclick="tree_equipos.findItem(document.getElementById('stext_3').value)">
      <img src="<?php echo $ruta_db_superior; ?>assets/images/siguiente.png" border="0px" alt="Siguiente"></a>  
	<br><div id="esperando_serie">
    <img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
	<div id="treeboxbox_tree_equipos" style="height:89%;width:95%" ></div>
	<script type="text/javascript">
  <!--		
  	$(document).ready(function  () {
			top.setTitulo("Ingreso de documentos");  
	});	
  	
      var browserType;
      
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree_equipos=new dhtmlXTreeObject("treeboxbox_tree_equipos","100%","100%",0);
			tree_equipos.setImagePath("<?php echo $ruta_db_superior; ?>imgs/");
			tree_equipos.enableIEImageFix(true);
			tree_equipos.setOnClickHandler(onNodeSelect);  
			tree_equipos.setOnLoadingStart(cargando_serie);
      tree_equipos.setOnLoadingEnd(fin_cargando_serie);
      tree_equipos.setXMLAutoLoading("test_almacenamiento.php<?php echo $adicional; ?>");
      //tree_equipos.enableSmartXMLParsing(true);
			tree_equipos.loadXML("test_almacenamiento.php<?php echo $adicional; ?>");
	    function onNodeSelect(nodeId){
	     if(nodeId.indexOf('#',0)==-1){
            window.parent.previsualizar.location='parsear_almacenamiento.php?id='+nodeId;
	     }
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
        document.poppedLayer.style.visibility = "hidden";
        tree_equipos.openAllItems(0);
        <?php if(@$_REQUEST["idcaja"]){ ?>
        var item="<?php echo @$_REQUEST["idcaja"]; ?>-caja";
        <?php } ?>
        <?php if(@$_REQUEST["idcarpeta"]){ ?>
        var item="<?php echo @$_REQUEST["idcarpeta"]; ?>-carpeta";
        <?php } ?>
        tree_equipos.selectItem(item,true,false);
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
        document.poppedLayer.style.visibility = "visible";
      }                            	
	--> 		
	</script>