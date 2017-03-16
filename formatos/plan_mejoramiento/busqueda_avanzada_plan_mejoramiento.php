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
?>    
<!DOCTYPE html>     
<html>
  <head>
  </head>
  <body>
    <div class="container master-container">
       <form accept-charset="UTF-8" id="kformulario_saia"  method="post" >  
        <legend>Filtrar Planes de mejoramiento aprobados</legend>
        
        <div class="control-group"><!--Filtro para numero documento-->
          <label class="string required control-label" for="nombre">
			<strong>N&uacute;mero de radicado</strong>
			<input type="hidden" name="bksaiacondicion_numero" id="bksaiacondicion_numero" value="in">
          </label>
          <div class="controls">
            <input id="bqsaia_numero" name="bqsaia_numero" size="50" type="text">
          </div>
        </div>
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_numero',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_numero',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_numero" id="bqsaiaenlace_numero" value="" />
		</div><!--Termina filtro de numero -->
		<br />
		
		<div class="control-group"><!--Filtro para tipo_plan-->
          <label class="string required control-label" for="nombre">
			<strong>Tipo de plan</strong>
			<input type="hidden" name="bksaiacondicion_tipo_plan" id="bksaiacondicion_tipo_plan" value="like">
          </label>
          <div class="controls">
			<select id="bqsaia_pm@tipo_plan" name="bqsaia_pm@tipo_plan">
				<option value="">Seleccione...</option>
				<option value="1">Institucional</option>
				<option value="2">De proceso</option>
				<option value="3">Individual</option>
			</select>            
          </div>
        </div>
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_plan',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_plan',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_tipo_plan" id="bqsaiaenlace_tipo_plan" value="" />
		</div><!--Termina filtro de tipo_plan -->
		<br />
		
		<strong>Entre las fechas</strong><!--Filtro para fecha-->
            <input type="hidden" name="bksaiacondicion_d@fecha_x" id="bksaiacondicion_d@fecha_x" value=">=">
        <div class="controls">
            <input id="bqsaia_d@fecha_x" name="bqsaia_d@fecha_x" style="width:100px" type="text" value="" placeholder="Inicio">
            <?php selector_fecha("bqsaia_d@fecha_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../",""); ?>
            <input type="hidden" name="bqsaiaenlace_d@fecha_x" id="bqsaiaenlace_d@fecha_x" value="y" />
            &nbsp;&nbsp;y&nbsp;&nbsp;
            <input type="hidden" name="bksaiacondicion_d@fecha_y" id="bksaiacondicion_d@fecha_y" value="<=">
            <input id="bqsaia_d@fecha_y" name="bqsaia_d@fecha_y" style="width:100px" type="text" value="" placeholder="Fin">
            <?php selector_fecha("bqsaia_d@fecha_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../",""); ?>
        </div>

        <input type="hidden" name="bqsaiaenlace_d@fecha_y" id="bqsaiaenlace_d@fecha_y" value="y" />
		<div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_fecha" id="bqsaiaenlace_fecha" value="" />
		</div><!--Termina filtro de fecha -->
		<br />	
		
		<div class="form-actions">    
          <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo(@$_REQUEST["idbusqueda_componente"]); ?>">
		  <input type="hidden" name="bqtipodato" value="date|d@fecha_x,d@fecha_y">
          <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
		  <input type="hidden" name="campos_especiales" id="campos_especiales" value="nombre_secretaria@arbol">		  
          <button type="button" class="btn btn-primary" id="ksubmit_saia" enlace="pantallas/busquedas/procesa_filtro_busqueda.php" titulo="Resultado">Buscar</button>   		  
          <input class="btn btn-danger" name="commit" type="reset" value="Cancelar">  
        </div>		
      </form>
    </div>  
  </body>
  <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
<?php 
//echo(librerias_validar_formulario());
echo(librerias_bootstrap());

function arbol($campo,$nombre_arbol,$url,$cargar_todos=0,$padresehijos=false,$quitar_padres=false,$adicionales=false,$tipo_etiqueta='check'){
	global $ruta_db_superior;
	$entidad=$nombre_arbol;
	?>
	<div ><?php //echo $seleccionados; ?></div>
	<input type="text" id="stext<?php echo $entidad; ?>" width="200px" size="25" placeholder="Buscar">
<a href="javascript:void(0)" onclick="stext<?php echo $entidad; ?>.findItem((document.getElementById('stext<?php echo $entidad; ?>').value),1)">
<img src="<?php echo $ruta_db_superior; ?>botones/general/anterior.png" alt="Buscar Anterior" border="0px"></a>
<a href="javascript:void(0)" onclick="tree<?php echo $entidad; ?>.findItem((document.getElementById('stext<?php echo $entidad; ?>').value),0,1)">
<img src="<?php echo $ruta_db_superior; ?>botones/general/buscar.png" alt="Buscar" border="0px"></a>
<a href="javascript:void(0)" onclick="tree<?php echo $entidad; ?>.findItem((document.getElementById('stext<?php echo $entidad; ?>').value))">
<img src="<?php echo $ruta_db_superior; ?>botones/general/siguiente.png" alt="Buscar Siguiente" border="0px"></a>
</span>

<!--a href="javascript:seleccionar_todos<?php echo $entidad; ?>(1)"><img src="<?php echo $ruta_db_superior; ?>imgs/iconCheckAll.gif" alt="Seleccionar todos" title="Seleccionar todos"></a>
	<a href="javascript:seleccionar_todos<?php echo $entidad; ?>(0)"><img src="<?php echo $ruta_db_superior; ?>imgs/iconUncheckAll.gif" alt="Quitar todos" title="Quitar todos"></a><br-->
<div id="esperando<?php echo $entidad; ?>"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
<div id="treeboxbox<?php echo $entidad; ?>"></div>
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
      <?php } ?>
      
      <?php /*if($padresehijos){?>
      tree<?php echo $entidad; ?>.enableThreeStateCheckboxes(true);
      tree<?php echo $entidad; ?>.enableSmartXMLParsing(true);
      <?php }*/?>
      <?php if($entidad!='plantilla'&&$entidad!='serie'){ ?>
      tree<?php echo $entidad; ?>.enableSmartXMLParsing(true);
      <?php } ?>
      <?php /*Esta condicion reemplaza a la que está comentada arriba, tomada de opav*/      
       if($padresehijos){?>
      tree<?php echo $entidad; ?>.enableThreeStateCheckboxes(true);
      tree<?php echo $entidad; ?>.setOnCheckHandler(onNodeSelect<?php echo $entidad; ?>);
      <?php }?>
      
			tree<?php echo $entidad; ?>.loadXML("<?php echo $ruta_db_superior.$url; ?>");
			tree<?php echo $entidad; ?>.setXMLAutoLoading("<?php echo $ruta_db_superior.$url; ?>");
      tree<?php echo $entidad; ?>.setOnCheckHandler(onNodeSelect<?php echo $entidad; ?>);
    
			function onNodeSelect<?php echo $entidad; ?>(nodeId){
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
				<?php } ?>
				<?php if(is_array($adicionales)){?>
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
				<?php } ?>
				
				<?php if($tipo_etiqueta=='radio'){ ?>
					valor_destino=document.getElementById("<?php echo $entidad; ?>");
                       if(tree<?php echo $entidad; ?>.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree<?php echo $entidad; ?>.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.length);
                          	 valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                         var nuevo_valor=valor_destino.value.replace("'","");
                         nuevo_valor=nuevo_valor.replace("'","");
                         var formato=nuevo_valor.toLowerCase();
                         var ruta_sup="<?php echo $ruta_db_superior; ?>";
                         var comp="<?php echo $idbusqueda_componente[0]["idbusqueda_componente"]; ?>";
                         if(formato!=''){
                         	//$("#gestion_mostrar").hide();
                         	<?php
							$cantidad=count($nombre_arbol);
							for($i=0;$i<$cantidad;$i++){
								//echo 'seleccionar_todos'.$nombre_arbol[$i]."(0); ";
							}
							?>
                         	$("#filtro_adicional").remove();
                         }
                         else{
                         	//$("#gestion_mostrar").show();
                         	$("#filtro_adicional").val("buzon_salida z@ AND iddocumento=z.archivo_idarchivo");
                         }
                         llamado_formulario(formato,ruta_sup,comp);
                         return;
				<?php } ?>
				
				document.getElementById("<?php echo $entidad; ?>").value=valores;
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
                  --></script>
<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/codificacion_funciones.js"></script>
	<?php	
}
?>
</html>