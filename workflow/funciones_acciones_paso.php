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


$idaccion = $_REQUEST["idaccion"];
$funcion = busca_filtro_tabla("","funciones_paso_accion,funciones_paso","paso_idfunciones_paso=idfunciones_paso and accion_idaccion=".$idaccion,"",$conn);
$funcion_accion = $funcion[0]["idfunciones_paso"];
switch($funcion_accion){
	case '1' : accion_responder();
	break;
	case '2' : accion_responder();
	break;
}


function accion_responder(){
	$entidad = $_REQUEST["accion"];
	$campo = $_REQUEST["campo"];
	if(isset($_REQUEST["idpaso_actividad"]))
		$seleccionados = seleccionados($_REQUEST["idpaso_actividad"],$_REQUEST["idaccion"]);
	?>
	<div ><?php echo $seleccionados; ?></div>
	<br>
	Buscar: <input type="text" id="stext<?php echo $entidad; ?>" width="200px" size="25">
<a href="javascript:void(0)" onclick="stext<?php echo $entidad; ?>.findItem(htmlentities(document.getElementById('stext<?php echo $entidad; ?>').value),1)"> 
<img src="../botones/general/anterior.png" alt="Buscar Anterior" border="0px"></a>
<a href="javascript:void(0)" onclick="tree<?php echo $entidad; ?>.findItem(htmlentities(document.getElementById('stext<?php echo $entidad; ?>').value),0,1)">
<img src="../botones/general/buscar.png" alt="Buscar" border="0px"></a>
<a href="javascript:void(0)" onclick="tree<?php echo $entidad; ?>.findItem(htmlentities(document.getElementById('stext<?php echo $entidad; ?>').value))">
<img src="../botones/general/siguiente.png" alt="Buscar Siguiente" border="0px"></a>
</span>
<div id="esperando<?php echo $entidad; ?>"><img src="../imagenes/cargando.gif"></div>
<div id="treeboxbox<?php echo $entidad; ?>" width="100px" height="100px"></div>
<input type="hidden" class="required" name="<?php echo $campo; ?>" id="<?php echo $campo; ?>">
<script type="text/javascript">
      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree<?php echo $entidad; ?>=new dhtmlXTreeObject("treeboxbox<?php echo $entidad; ?>","100%","70%",0);
			tree<?php echo $entidad; ?>.setImagePath("../imgs/");
		  	tree<?php echo $entidad; ?>.enableIEImageFix(true);
			tree<?php echo $entidad; ?>.setOnLoadingStart(cargando<?php echo $entidad; ?>);
      tree<?php echo $entidad; ?>.setOnLoadingEnd(fin_cargando<?php echo $entidad; ?>);
      tree<?php echo $entidad; ?>.enableCheckBoxes(1);
      <?php if($entidad==1 || $entidad==2){?>
      tree<?php echo $entidad; ?>.enableThreeStateCheckboxes(true);
      <?php }?>
			tree<?php echo $entidad; ?>.loadXML(ruta_xmlx);
      tree<?php echo $entidad; ?>.setOnCheckHandler(onNodeSelect<?php echo $entidad; ?>);
			function onNodeSelect<?php echo $entidad; ?>(nodeId){
      		document.getElementById("<?php echo $campo; ?>").value=tree<?php echo $entidad; ?>.getAllChecked();
      }

      function fin_cargando<?php echo $entidad; ?>() {
      if (browserType == "gecko" )
         document.poppedLayer =
         eval('document.getElementById("esperando<?php echo $entidad; ?>")');
      else if (browserType == "ie")
         document.poppedLayer =
            eval('document.getElementById("esperando<?php echo $entidad; ?>")');
      else
         document.poppedLayer =
            eval('document.layers["esperando<?php echo $entidad; ?>"]');
      document.poppedLayer.style.display = "none";
      document.getElementById('<?php echo $campo; ?>').value=tree<?php echo $entidad; ?>.getAllChecked();
    }
    function cargando<?php echo $entidad; ?>() {
      if (browserType == "gecko" )
         document.poppedLayer =
             eval('document.getElementById("esperando<?php echo $entidad; ?>")');
      else if (browserType == "ie")
         document.poppedLayer =
            eval('document.getElementById("esperando<?php echo $entidad; ?>")');
      else
         document.poppedLayer =
             eval('document.layers["esperando<?php echo $entidad; ?>"]');
      document.poppedLayer.style.display = "";
    }
                    
                    --></script>
	<?php
	
}

function seleccionados($idpaso_actividad,$accion){
	$sel = busca_filtro_tabla("","paso_actividad","idpaso_actividad=".$idpaso_actividad." and accion_idaccion=".$accion,"",$conn);
	
	$seleccionado = explode(",",$sel[0]["formato_idformato"]);
	$cantidad = count($seleccionado);
	
	$retorno = '';
	for($i=0;$i<$cantidad;$i++){
		$formato = busca_filtro_tabla("","formato","idformato=".$seleccionado[$i],"",$conn);
		$retorno .= $formato[0]["etiqueta"];
		if(($cantidad-1) > $i)
			$retorno .= ', ';
		
		$retorno .= '<br>';
	}
	return $retorno;
}
?>