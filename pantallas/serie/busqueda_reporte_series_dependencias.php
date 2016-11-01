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
include_once($ruta_db_superior."calendario/calendario.php");
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_html5());
echo(librerias_jquery("1.7"));
echo(librerias_arboles());
echo(estilo_bootstrap()); 
global $conn;


?>
<!DOCTYPE html>     
<html>
  <body>
 
    <div class="container master-container">
         
		<div class="container master-container">
       <form accept-charset="UTF-8" id="kformulario_saia"  method="post" >  
        <div class="control-group">
          <label class="string required control-label" for="codigo">
			<b>C&oacute;digo:</b>
			<input type="hidden" name="bksaiacondicion_s@codigo" id="bksaiacondicion_s-codigo" value="=">
          </label>
          <div class="controls">
            <input id="bqsaia_codigo" name="bqsaia_s@codigo" size="50" type="text">
            <input type="hidden" name="bqsaiaenlace_s@codigo" id="bqsaiaenlace_s-codigo" value="y">
          </div>
        </div> 
        
    <br>
    
        <div class="row">
          <div class="control-group radio_buttons span4">
            <label class="radio_buttons optional control-label"><b>Tipo</b>
            <input type="hidden" name="bksaiacondicion_s@tipo" id="bksaiacondicion_s-tipo" value="=">
            </label>
            <div class="controls">
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_s-tipo1" name="bqsaia_s@tipo" type="radio" value="1">Serie
              </label>
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_s-tipo2" name="bqsaia_s@tipo" type="radio" value="2">Subserie
              </label>
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_s-tipo3" name="bqsaia_s@tipo" type="radio" value="3">Tipo Documental
              </label>
            </div>          
          </div> 
      </div><br>


	<br>
        
        <div class="container master-container">
       <form accept-charset="UTF-8" id="kformulario_saia"  method="post" >  
        <div class="control-group">
          <label class="string required control-label" for="nombre">
			<b>Nombre:</b>
			<input type="hidden" name="bksaiacondicion_s@nombre" id="bksaiacondicion_s-nombre" value="like">
          </label>
          <div class="controls">
            <input id="bqsaia_nombre" name="bqsaia_s@nombre" size="50" type="text">
            <input type="hidden" name="bqsaiaenlace_s@nombre" id="bqsaiaenlace_s-nombre" value="y">
          </div>
        </div> 
       


        <div class="row">
          <div class="control-group radio_buttons span4">
            <label class="radio_buttons optional control-label"><b>Estado</b>
            <input type="hidden" name="bksaiacondicion_s@estado" id="bksaiacondicion_s-estado" value="=">
            </label>
            <div class="controls">
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_s-estado1" name="bqsaia_s@estado" type="radio" value="1">Activo
              </label>
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_s-estado2" name="bqsaia_s@estado" type="radio" value="0">Inactivo
              </label>
            </div>          
          </div> 
      </div><br>


	<br>
	


        <div class="form-actions">    
          <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>">
          <input type="hidden" name="bqtipodato" value="date|fecha_radicacion_entrada_x,fecha_radicacion_entrada_y,fecha_radicacion_entrada_x,fecha_radicacion_entrada_y">
           <input type="hidden" name="campos_especiales" id="campos_especiales" value="funcionario_evaluado@arbol">          
          <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">

          <button type="button" class="btn btn-primary" id="ksubmit_saia" enlace="<?php echo $ruta_db_superior; ?>pantallas/busquedas/procesa_filtro_busqueda.php" titulo="Resultado">Buscar</button>    
          <input class="btn btn-danger" name="commit" type="reset" value="Cancelar">  
        </div>
      </form>
    </div>  
  </body>
  <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
</html>
<?php
echo(librerias_bootstrap());
echo(librerias_datepicker_bootstrap());
function arbol($campo,$nombre_arbol,$url,$cargar_todos=0,$padresehijos=false,$quitar_padres=false,$adicionales=false,$tipo_etiqueta='check',$agreg_depen=false,$tipo_funcionario='rol',$check_hijos=0){
	global $ruta_db_superior;
	$entidad=$nombre_arbol;
	?>
	<input type="text" id="stext<?php echo $entidad; ?>" width="200px" size="25" placeholder="Buscar">
<a href="javascript:void(0)" onclick="stext<?php echo $entidad; ?>.findItem(htmlentities(document.getElementById('stext<?php echo $entidad; ?>').value),1)">
<img src="<?php echo $ruta_db_superior; ?>botones/general/anterior.png" alt="Buscar Anterior" border="0px"></a>
<a href="javascript:void(0)" onclick="tree<?php echo $entidad; ?>.findItem(htmlentities(document.getElementById('stext<?php echo $entidad; ?>').value),0,1)">
<img src="<?php echo $ruta_db_superior; ?>botones/general/buscar.png" alt="Buscar" border="0px"></a>
<a href="javascript:void(0)" onclick="tree<?php echo $entidad; ?>.findItem(htmlentities(document.getElementById('stext<?php echo $entidad; ?>').value))">
<img src="<?php echo $ruta_db_superior; ?>botones/general/siguiente.png" alt="Buscar Siguiente" border="0px"></a>
</span>

<!--a href="javascript:seleccionar_todos<?php echo $entidad; ?>(1)"><img src="<?php echo $ruta_db_superior; ?>imgs/iconCheckAll.gif" alt="Seleccionar todos" title="Seleccionar todos"></a>
	<a href="javascript:seleccionar_todos<?php echo $entidad; ?>(0)"><img src="<?php echo $ruta_db_superior; ?>imgs/iconUncheckAll.gif" alt="Quitar todos" title="Quitar todos"></a><br-->
<div id="esperando<?php echo $entidad; ?>"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
<div id="treeboxbox<?php echo $entidad; ?>"></div>
<input type="hidden" class="required" name="<?php echo $campo; ?>" id="<?php echo $entidad; ?>">
<script type="text/javascript">
	$("document").ready(function(){
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
      <?php if($tipo_etiqueta=='check'){?>
      tree<?php echo $entidad; ?>.enableCheckBoxes(1);
      <?php }else if($tipo_etiqueta=='radio'){?>
      tree<?php echo $entidad; ?>.enableRadioButtons(true);
      tree<?php echo $entidad; ?>.enableCheckBoxes(1);
      <?php }
      if($entidad!='plantilla'&&$entidad!='serie'){ ?>
      tree<?php echo $entidad; ?>.enableSmartXMLParsing(true);
      <?php } 
      if($padresehijos){?>
      tree<?php echo $entidad; ?>.enableThreeStateCheckboxes(true);
      <?php }?>
      
			tree<?php echo $entidad; ?>.loadXML("<?php echo $ruta_db_superior.$url; ?>");
      tree<?php echo $entidad; ?>.setOnCheckHandler(onNodeSelect<?php echo $entidad; ?>);
    
			function onNodeSelect<?php echo $entidad; ?>(nodeId){
				

				
				
				var adicional_dep="";
				var valores=tree<?php echo $entidad; ?>.getAllChecked();
				<?php if($quitar_padres){?>
					var nuevos_valores=valores.split(",");
					var cantidad=nuevos_valores.length;
					var funcionarios=new Array();
					var indice=0;
					for(var i=0;i<cantidad;i++){
						if(nuevos_valores[i].indexOf("#")=='-1'){
							if(nuevos_valores[i]!=""){
								funcionarios[indice]=nuevos_valores[i];
								indice++;
							}
						}
					}
					var valores=funcionarios.join(",");
				<?php }
				if(is_array($adicionales)){?>
					if(valores!=''){
						if($("#bksaiacondicion_<?php echo $adicionales[0];?>").val()=="" && $("#bqsaia_<?php echo $adicionales[0];?>").val()==""){
							$("#bksaiacondicion_<?php echo $adicionales[0];?>").val("<?php echo $adicionales[1];?>");
							$("#bqsaia_<?php echo $adicionales[0];?>").val("<?php echo $adicionales[2];?>");
						}
					}
					else{
						$("#bksaiacondicion_<?php echo $adicionales[0];?>").val("");
						$("#bqsaia_<?php echo $adicionales[0];?>").val("");
					}
				<?php } 
				if($tipo_etiqueta=='radio'){ ?>
					valor_destino=document.getElementById("<?php echo $entidad; ?>");
					if(tree<?php echo $entidad; ?>.isItemChecked(nodeId)){
						if(valor_destino.value!==""){
							tree<?php echo $entidad; ?>.setCheck(valor_destino.value,false);
						}
						if(nodeId.indexOf("_")!=-1){
							nodeId=nodeId.substr(0,nodeId.length);
						}
						valor_destino.value=nodeId;
					}else{
						valor_destino.value="";
					}               
				<?php } 				
				if($agreg_depen){
					?>
					$.ajax({
						type:'POST',
						url: "dependencias_padres.php",
						async: false,
						data: {funcionario:valores,tipo_funcionario:'<?php echo $tipo_funcionario;?>'} ,
						success: function(retorno){
							if(retorno!=""){
								adicional_dep=","+retorno;
							}
						}  
					});
					<?php
				}
				if($tipo_etiqueta!='radio' || $quitar_padres){
				?>
					document.getElementById("<?php echo $entidad; ?>").value=valores+adicional_dep;
				<?php	
				}
				?>
				
				
				
				
				<?php
				if($check_hijos){
					?>
						var set_hijos=nodeId.split(",");
						var check_uncheck=0;
						if(tree<?php echo $entidad; ?>.isItemChecked(nodeId)){
							check_uncheck=1;
						}
						
						for(i=0;i<set_hijos.length;i++){
							tree<?php echo $entidad; ?>.setCheck( set_hijos[i],check_uncheck ); 
						}
						var valores=tree<?php echo $entidad; ?>.getAllChecked();
						
						
						//limpio cadena
						var vector_valores=valores.split(",");
						
						var names = vector_valores;
						var uniqueNames = [];
						$.each(names, function(i, el){
   						 if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
						});
						
						vector_valores=uniqueNames;
						
						valores='';
						for(i=0;i<vector_valores.length;i++){
							if(vector_valores[i]!=''){
								valores+=vector_valores[i]+',';
							}
						}	
						
						
						if(valores.substring(valores.length-1)==','){
							valores=valores.substr(0, valores.length-1);
						}											
						//fin limpio cadena			
						document.getElementById("<?php echo $entidad; ?>").value=valores;
					<?php
				}
				?>
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
    
   });
   function seleccionar_todos<?php echo $entidad; ?>(tipo)
    {lista=tree<?php echo $entidad; ?>.getAllChildless();
     vector=lista.split(",");
     for(i=0;i<vector.length;i++)
      {tree<?php echo $entidad; ?>.setCheck(vector[i],tipo);
      }
     document.getElementById("<?php echo $entidad; ?>").value=tree<?php echo $entidad; ?>.getAllChecked(); 
    }
--></script><br>
<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/codificacion_funciones.js"></script>
	<?php
	}
?>
<script>
$(document).keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13') {
    	$("#ksubmit_saia").click();
    }
});

</script>
</html>