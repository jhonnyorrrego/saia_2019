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
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/header_formato.php");
echo(estilo_bootstrap());
echo(librerias_jquery('1.7'));
echo(librerias_arboles());
?>
<style>
	.bs-docs-example {
		position: relative;
		margin: 15px 0px 0px 41px;
		padding: 39px 19px 14px;
		background-color: #fff;
		border: 1px solid #ddd;
		-webkit-border-radius: 4px;
		-moz-border-radius: 4px;
		border-radius: 4px;
	}
</style>
<div class="container bs-docs-example">
	<form class="form-horizontal" id="formulario_formatos">
	  <div class="control-group">
	    <label class="control-label" for="inputEmail">Funcionario</label>
	    <div class="controls">				
			<?php generar_arbol('actualizar_funcionario','test.php'); ?>    	
		</div>	    
	  </div>	  
	  <div class="form-actions">
	  	<input type="hidden" name="iddocumento" value="<?php echo($_REQUEST["iddocumento"]); ?>">
	  	<input type="hidden" name="idformato" value="<?php echo($_REQUEST["idformato"]); ?>">
	  	<input type="hidden" name="campo" value="<?php echo($_REQUEST["campo"]); ?>">	  	
  		<button class="btn btn-primary" id="enviar_formulario">Aceptar</button>  		
	  </div>
	</form>
</div>
<<script type="text/javascript">
	$(document).ready(function() {
				 	
		 	$("#formulario_formatos").submit(function(){		 		

		 		$.ajax({
		 			url: '<?php echo($ruta_db_superior); ?>formatos/hallazgo/modificar_funcionario.php',
					type: 'POST',
					dataType: 'html',
					data: $(this).serialize(),
					success: function (data){
						parent.hs.close();
					}
				});
				return false;
			});
		});
</script>
<?php
function generar_arbol($campo,$ruta_xml='test_serie_funcionario.php'){
	global $ruta_db_superior;
	?>
   <br />  Buscar: <input type="text" id="stext_<?php echo $campo; ?>" width="200px" size="25"><br><a href="javascript:void(0)" onclick="tree_<?php echo $campo; ?>.findItem((document.getElementById('stext_<?php echo $campo; ?>').value),0,1)"> Buscar</a>  |
    <a href="javascript:void(0)" onclick="tree_<?php echo $campo; ?>.findItem((document.getElementById('stext_<?php echo $campo; ?>').value))"> Siguiente</a>  |
    <a href="javascript:void(0)" onclick="tree_<?php echo $campo; ?>.findItem((document.getElementById('stext_<?php echo $campo; ?>').value),1)"> Anterior</a><br /><div id="esperando_<?php echo $campo; ?>"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
   <div class="quitar_borde_arbol"><div id="treeboxbox_tree_<?php echo $campo; ?>"></div></div>
	<script type="text/javascript">
  <!--
      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree_<?php echo $campo; ?>=new dhtmlXTreeObject("treeboxbox_tree_<?php echo $campo; ?>","100%","",0);
			tree_<?php echo $campo; ?>.setImagePath("<?php echo $ruta_db_superior; ?>imgs/");
			tree_<?php echo $campo; ?>.enableIEImageFix(true);			
			tree_<?php echo $campo; ?>.enableCheckBoxes(true);
			tree_<?php echo $campo; ?>.enableRadioButtons(false);
			tree_<?php echo $campo; ?>.setOnLoadingStart(cargando_<?php echo $campo; ?>);
      tree_<?php echo $campo; ?>.setOnLoadingEnd(fin_cargando_<?php echo $campo; ?>);
			tree_<?php echo $campo; ?>.enableThreeStateCheckboxes(true);
			tree_<?php echo $campo; ?>.loadXML("<?php echo $ruta_db_superior.$ruta_xml; ?>");
			tree_<?php echo $campo; ?>.setOnCheckHandler(onNodeSelect_<?php echo $campo; ?>);
      function fin_cargando_<?php echo $campo; ?>() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_<?php echo $campo; ?>")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_<?php echo $campo; ?>")');
        else
           document.poppedLayer =
              eval('document.layers["esperando_<?php echo $campo; ?>"]');
        document.poppedLayer.style.visibility = "hidden";
      }

      function cargando_<?php echo $campo; ?>() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_<?php echo $campo; ?>")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_<?php echo $campo; ?>")');
        else
           document.poppedLayer =
               eval('document.layers["esperando_<?php echo $campo; ?>"]');
        document.poppedLayer.style.visibility = "visible";
      }
      
    function onNodeSelect_<?php echo $campo; ?>(nodeId){
    	valor_destino=document.getElementById("<?php echo $campo; ?>");      
     	destinos=tree_<?php echo $campo; ?>.getAllChecked();
     	
     	nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
     	
     	nuevo=nuevo.replace(/\,$/gi,"");
     	
     	vector=destinos.split(",");	
     	
     	
     	for(i=0;i<vector.length;i++){
     		if(vector[i].indexOf("_")!=-1){
     			vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
        }
        
        nuevo=vector.join(",");
          
        if(vector[i].indexOf("#")!=-1){
        	hijos=tree_<?php echo $campo; ?>.getAllSubItems(vector[i]);
          hijos=hijos.replace(/\,{2,}(d)*/gi,",");
          hijos=hijos.replace(/\,$/gi,"");
          vectorh=hijos.split(",");
           
          for(h=0;h<vectorh.length;h++){
          	if(vectorh[h].indexOf("_")!=-1)
            	vectorh[h]=vectorh[h].substr(0,vectorh[h].indexOf("_"));
              nuevo=eliminarItem(nuevo,vectorh[h]);
          } 
        }
      }
     	nuevo=nuevo.replace(/\,{2,}(d)*/gi,",");
     	nuevo=nuevo.replace(/\,$/gi,"");    	   
     	valor_destino.value=nuevo;      
   }        
	-->	
	</script>	
	<input type="hidden" name="<?php echo $campo; ?>" id="<?php echo $campo; ?>">
	<?php
}
?>
