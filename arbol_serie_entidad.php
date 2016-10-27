<?php
$radio=@$_REQUEST["radio"]; 
if($radio==1){
$anidado="false";
}else{
$anidado="true";
}
$entidad=@$_REQUEST["entidad"];
$series=@$_REQUEST["series"];
$campo="entidad_identidad";
 if($entidad=="1")
   {$xml="test.php?sin_padre=1&series=$series&sin_rol=1";
   }
 elseif($entidad=="2")
   {$xml="test_serie_entidad.php?tabla=dependencia&estado=1&series=$series";
   }
 elseif($entidad=="4")
   {$xml="test_serie_entidad.php?tabla=cargo&estado=1&series=$series";
   }
 elseif($entidad=='serie')
   {$xml="test_serie_entidad.php?tabla=serie&estado=1";
    if(@$_REQUEST["filtrar_serie"])
      $xml.="&id=".$_REQUEST["filtrar_serie"];
    elseif(@$_REQUEST["filtrar_categoria"]) 
      $xml.="&categoria=".$_REQUEST["filtrar_categoria"];
 
    $campo="serie_idserie"; 
   }
if(@$_REQUEST["tipo_entidad"] && @$_REQUEST["llave_entidad"]) 
   $xml.="&tipo_entidad=".$_REQUEST["tipo_entidad"]."&llave_entidad=".$_REQUEST["llave_entidad"]; 
         
if($xml && $campo)
{   
?>
Buscar: <input type="text" id="stext<?php echo $entidad; ?>" width="200px" size="25">
<a href="javascript:void(0)" onclick="stext<?php echo $entidad; ?>.findItem(htmlentities(document.getElementById('stext<?php echo $entidad; ?>').value),1)"> 
<img src="botones/general/anterior.png" alt="Buscar Anterior" border="0px"></a>
<a href="javascript:void(0)" onclick="tree<?php echo $entidad; ?>.findItem(htmlentities(document.getElementById('stext<?php echo $entidad; ?>').value),0,1)"> 
<img src="botones/general/buscar.png" alt="Buscar" border="0px"></a>
<a href="javascript:void(0)" onclick="tree<?php echo $entidad; ?>.findItem(htmlentities(document.getElementById('stext<?php echo $entidad; ?>').value))">
<img src="botones/general/siguiente.png" alt="Buscar Siguiente" border="0px"></a>
</span>
<div id="esperando<?php echo $entidad; ?>"><img src="imagenes/cargando.gif"></div>
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
			tree<?php echo $entidad; ?>.setImagePath("imgs/");
		tree<?php echo $entidad; ?>.enableIEImageFix(true);
			tree<?php echo $entidad; ?>.setOnLoadingStart(cargando<?php echo $entidad; ?>);
      tree<?php echo $entidad; ?>.setOnLoadingEnd(fin_cargando<?php echo $entidad; ?>);
      tree<?php echo $entidad; ?>.enableCheckBoxes(1);
      //tree<?php echo $entidad; ?>.enableThreeStateCheckboxes("<?php echo $anidado;?>");
			tree<?php echo $entidad; ?>.loadXML("<?php echo $xml; ?>");
      tree<?php echo $entidad; ?>.setOnCheckHandler(onNodeSelect<?php echo $entidad; ?>);
			function onNodeSelect<?php echo $entidad; ?>(nodeId)
      {document.getElementById("<?php echo $campo; ?>").value=tree<?php echo $entidad; ?>.getAllChecked();
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
      
      tree<?php echo $entidad; ?>.openItem( <?php echo(@$_REQUEST['llave_entidad']); ?> );
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
 </script><br>

<a onclick="todos_check(tree<?php echo $entidad; ?>,'<?php echo $campo; ?>')" href="#">TODOS</a>&nbsp;&nbsp;&nbsp;
<a onclick="ninguno_check(tree<?php echo $entidad; ?>,'<?php echo $campo; ?>')" href="#">NINGUNO</a>
<?php
}
?>  