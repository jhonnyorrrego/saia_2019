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
        <legend>Filtrar despachos</legend>  
		<div class="container master-container">
       <form accept-charset="UTF-8" id="kformulario_saia"  method="post" >  
        <div class="control-group">
          <label class="string required control-label" for="numero">
			<b>N&uacute;mero radicación:</b>
			<input type="hidden" name="bksaiacondicion_numero" id="bksaiacondicion_numero" value="=">
          </label>
          <div class="controls">
            <input id="bqsaia_numero" name="bqsaia_numero" size="50" type="text">
            <input type="hidden" name="bqsaiaenlace_numero" id="bqsaiaenlace_numero" value="y">
          </div>
        </div> 
         <strong>Entre las fechas</strong>
            <input type="hidden" name="bksaiacondicion_fecha_radicacion_entrada_x" id="bksaiacondicion_fecha_radicacion_entrada_x" value=">=">
        <div class="controls">
            <input id="bqsaia_fecha_radicacion_entrada_x" name="bqsaia_fecha_radicacion_entrada_x" style="width:100px" type="text" value="" placeholder="Inicio">
            <?php selector_fecha("bqsaia_fecha_radicacion_entrada_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../",""); ?>
            <input type="hidden" name="bqsaiaenlace_fecha_radicacion_entrada_x" id="bqsaiaenlace_fecha_radicacion_entrada_x" value="y" />
            &nbsp;&nbsp;y&nbsp;&nbsp;
            <input type="hidden" name="bksaiacondicion_fecha_radicacion_entrada_y" id="bksaiacondicion_fecha_radicacion_entrada_y" value="<=">
            <input id="bqsaia_fecha_radicacion_entrada_y" name="bqsaia_fecha_radicacion_entrada_y" style="width:100px" type="text" value="" placeholder="Fin">
            <?php selector_fecha("bqsaia_fecha_radicacion_entrada_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../",""); ?>
        </div>

        <input type="hidden" name="bqsaiaenlace_fecha_radicacion_entrada_y" id="bqsaiaenlace_fecha_radicacion_entrada_y" value="y" />
        
       
        <br>
		

		
		<div class="control-group">
        	<strong>Funcionario Evaluado</strong><br/>
        	<?php 
	      
			
			if($_SESSION['LOGIN'.LLAVE_SAIA]=='cerok'){
			
				echo arbol("bqsaia_funcionario_evaluado","funcionario_evaluado","test.php?sin_padre=1","","","","","check","","",1); 
				
				//arbol($campo,$nombre_arbol,$url,$cargar_todos=0,$padresehijos=false,$quitar_padres=false,$adicionales=false,$tipo_etiqueta='check',$agreg_depen=false,$tipo_funcionario='rol',$check_hijos=0)
			}else{
				//echo arbol("bqsaia_r@cliente_proceso","cliente_proceso","formatos/requerimientos/test_cliente_proyecto.php?sin_padre=1","","","","","check"); 
				echo arbol("bqsaia_funcionario_evaluado","funcionario_evaluado","test.php?sin_padre=1","","","","","check","","",1); 
			}
			
	        ?>
	        <input type="hidden" name="bksaiacondicion_funcionario_evaluado" id="bksaiacondicion_funcionario_evaluado" value="in">
	         	<input type="hidden" name="bqsaiaenlace_funcionario_evaluado" id="bqsaiaenlace_funcionario_evaluado" value="y" />
        </div>	
        
        
        
		<br>


        <div class="control-group">
          <label class="string required control-label" for="area_seguimiento">
			<b>Area</b>
          </label>
          <div class="controls">
            <input type="checkbox" name="area_seguimiento" id="area_seguimiento1" value="1">Desarrollo
            <input type="checkbox" name="area_seguimiento" id="area_seguimiento2" value="2">Soporte
          </div>
		<input type="hidden" name="bksaiacondicion_area_seguimiento" id="bksaiacondicion_area_seguimiento" value="in">
		<input type="hidden" name="bqsaiaenlace_area_seguimiento" id="bqsaiaenlace_area_seguimiento" value="y" />    		<input id="bqsaia_area_seguimiento" name="bqsaia_area_seguimiento" size="50" type="hidden">
			<script>
				$(document).ready(function(){
					$('input[name="area_seguimiento"]').click(function(){
						document.getElementById('bqsaia_area_seguimiento').value='';
						var cadena='';
						for(i=1;i<=2;i++){
							if(document.getElementById('area_seguimiento'+i).checked){
								cadena+=document.getElementById('area_seguimiento'+i).value+',';
							}
						}
						document.getElementById('bqsaia_area_seguimiento').value=cadena;						
					});		
				});
			</script>
        </div>


		<br>


        <div class="control-group">
          <label class="string required control-label" for="estado_seguimiento">
			<b>Estado</b>
          </label>
          <div class="controls">
            <input type="checkbox" name="estado_seguimiento" id="estado_seguimiento1" value="1">Aprobado
            <input type="checkbox" name="estado_seguimiento" id="estado_seguimiento2" value="2">Rechazado
          </div>
		<input type="hidden" name="bksaiacondicion_estado_seguimiento" id="bksaiacondicion_estado_seguimiento" value="in">
		<input type="hidden" name="bqsaiaenlace_estado_seguimiento" id="bqsaiaenlace_estado_seguimiento" value="y" />    		<input id="bqsaia_estado_seguimiento" name="bqsaia_estado_seguimiento" size="50" type="hidden">
			<script>
				$(document).ready(function(){
					$('input[name="estado_seguimiento"]').click(function(){
						document.getElementById('bqsaia_estado_seguimiento').value='';
						var cadena='';
						for(i=1;i<=2;i++){
							if(document.getElementById('estado_seguimiento'+i).checked){
								cadena+=document.getElementById('estado_seguimiento'+i).value+',';
							}
						}
						document.getElementById('bqsaia_estado_seguimiento').value=cadena;						
					});		
				});
			</script>
        </div>


	<br>
	
        <div class="control-group">
          <label class="string required control-label" for="evaluador">
			<b>Evaluador</b>
          </label>
          <div class="controls">
            <?php 
        	$evaluador=busca_filtro_tabla("","vfuncionario_dc","idcargo=90","",$conn);
			for ($i=0; $i <$evaluador['numcampos']; $i++) { 
				echo '<input type="checkbox" name="evaluador" id="evaluador'.$i.'" value="'.$evaluador[$i]["idfuncionario"].'">'.$evaluador[$i]["nombres"].' '.$evaluador[0]["apellidos"];
			} 
	        ?>
          </div>
		<input type="hidden" name="bksaiacondicion_evaluador" id="bksaiacondicion_evaluador_seguimiento" value="in">
		<input type="hidden" name="bqsaiaenlace_evaluador" id="bqsaiaenlace_evaluador" value="y" />    		<input id="bqsaia_evaluador" name="bqsaia_evaluador" size="50" type="hidden">
			<script>
				$(document).ready(function(){
					$('input[name="evaluador"]').click(function(){
						document.getElementById('bqsaia_evaluador').value='';
						var cadena='';
						for(i=0;i<<?php echo $evaluador['numcampos'];?>;i++){
							if(document.getElementById('evaluador'+i).checked){
								cadena+=document.getElementById('evaluador'+i).value+',';
							}
						}
						document.getElementById('bqsaia_evaluador').value=cadena;						
					});		
				});
			</script>
        </div>
		



        <div class="form-actions">    
          <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo@$_REQUEST["idbusqueda_componente"]; ?>">
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