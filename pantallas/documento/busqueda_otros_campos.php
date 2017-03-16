<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");

?>
<div id="busqueda_avanzada">
	<legend>Busqueda avanzada</legend>  
	
	<label class="string required control-label" for="nombre">
		Transferidos a
	<input type="hidden" name="bksaiacondicion_A@oficio" id="bksaiacondicion_A@oficio" value="in">
	</label>
	<div class="controls">
		<?php echo arbol_avanzado("1","1","test.php?inactivos=1"); ?>
	</div>
	
	<input type="hidden" name="bqsaiaenlace_A@oficio" value="y">
	
	<label class="string required control-label" for="nombre">
		Transferidos por
	<input type="hidden" name="bksaiacondicion_A@fecha_x" id="bksaiacondicion_A@fecha_x" value=">=">
	</label>
	<div class="controls">
		<?php echo arbol_avanzado("2","2","test.php?inactivos=1"); ?>
	</div>
	
	<input type="hidden" name="bqsaiaenlace_A@fecha_x" value="y">
	
	<label class="string required control-label" for="nombre">
		Elaborado por
	<input type="hidden" name="bksaiacondicion_A@fecha_x" id="bksaiacondicion_A@fecha_x" value=">=">
	</label>
	<div class="controls">
		<?php echo arbol_avanzado("3","3","test.php?inactivos=1"); ?>
	</div>
	
	<input type="hidden" name="bqsaiaenlace_A@fecha_y" value="y">
	
	<label class="string required control-label" for="nombre">
		Aprobado por
	<input type="hidden" name="bksaiacondicion_A@fecha_x" id="bksaiacondicion_A@fecha_x" value=">=">
	</label>
	<div class="controls">
		<?php echo arbol_avanzado("4","4","test.php?inactivos=1"); ?>
	</div>
		
	<div class="form-actions">
	  <button type="button" class="btn btn-primary" id="ksubmit_saia" enlace="pantallas/busquedas/procesa_filtro_busqueda.php" titulo="Resultado">Buscar</button>    
	  <input class="btn btn-danger" name="commit" type="reset" value="Cancelar">  
	</div>

<?php
function arbol_avanzado($campo,$nombre_arbol,$url,$cargar_todos=0){
	global $ruta_db_superior;
	$entidad=$nombre_arbol;
	?>
	<div ><?php //echo $seleccionados; ?></div>
	<label class="string required control-label" for="nombre">
	Buscar:
	</label>
	<input type="text" id="stext<?php echo $entidad; ?>" width="200px" size="25">
<a href="javascript:void(0)" onclick="stext<?php echo $entidad; ?>.findItem((document.getElementById('stext<?php echo $entidad; ?>').value),1)"> 
<img src="<?php echo $ruta_db_superior; ?>botones/general/anterior.png" alt="Buscar Anterior" border="0px"></a>
<a href="javascript:void(0)" onclick="tree<?php echo $entidad; ?>.findItem((document.getElementById('stext<?php echo $entidad; ?>').value),0,1)">
<img src="<?php echo $ruta_db_superior; ?>botones/general/buscar.png" alt="Buscar" border="0px"></a>
<a href="javascript:void(0)" onclick="tree<?php echo $entidad; ?>.findItem((document.getElementById('stext<?php echo $entidad; ?>').value))">
<img src="<?php echo $ruta_db_superior; ?>botones/general/siguiente.png" alt="Buscar Siguiente" border="0px"></a>
</span>
<div id="esperando<?php echo $entidad; ?>"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
<div id="treeboxbox<?php echo $entidad; ?>" ></div>
<input type="hidden" class="required" name="<?php echo $campo; ?>" id="<?php echo $entidad; ?>">
<script type="text/javascript">
      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree<?php echo $entidad; ?>=new dhtmlXTreeObject("treeboxbox<?php echo $entidad; ?>","","",0);
			tree<?php echo $entidad; ?>.setImagePath("<?php echo $ruta_db_superior; ?>imgs/");
		  	tree<?php echo $entidad; ?>.enableIEImageFix(true);
			tree<?php echo $entidad; ?>.setOnLoadingStart(cargando<?php echo $entidad; ?>);
      tree<?php echo $entidad; ?>.setOnLoadingEnd(fin_cargando<?php echo $entidad; ?>);
      tree<?php echo $entidad; ?>.enableCheckBoxes(1);
      <?php if($entidad==1 || $entidad==2){?>
      tree<?php echo $entidad; ?>.enableThreeStateCheckboxes(true);
      tree<?php echo $entidad; ?>.setOnCheckHandler(onNodeSelect<?php echo $entidad; ?>);
      <?php }?>
			tree<?php echo $entidad; ?>.loadXML("<?php echo $ruta_db_superior.$url; ?>");
      tree<?php echo $entidad; ?>.setOnCheckHandler(onNodeSelect<?php echo $entidad; ?>);
			function onNodeSelect<?php echo $entidad; ?>(nodeId){
      		document.getElementById("<?php echo $entidad; ?>").value=tree<?php echo $entidad; ?>.getAllChecked();
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
      document.getElementById('<?php echo $entidad; ?>').value=tree<?php echo $entidad; ?>.getAllChecked();
      <?php
      if($cargar_todos==1){
      	echo "seleccionar_todos".$entidad."(1);";
      }
      ?>
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
    function seleccionar_todos<?php echo $entidad; ?>(tipo)
    {lista=tree<?php echo $entidad; ?>.getAllChildless();
     vector=lista.split(",");
     for(i=0;i<vector.length;i++)
      {tree<?php echo $entidad; ?>.setCheck(vector[i],tipo);
      }
     document.getElementById("<?php echo $entidad; ?>").value=tree<?php echo $entidad; ?>.getAllChecked(); 
    }
                    
                  --></script><br>
	<?php
	
}
?>
</div>