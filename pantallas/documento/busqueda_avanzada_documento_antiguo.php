<meta http-equiv="X-UA-Compatible" content="IE=9">
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
?>
<!DOCTYPE html>     
<html>
  <head>
  <?php
  echo(librerias_html5());
  echo(librerias_jquery("1.7"));
  echo(estilo_bootstrap()); 
  //echo(librerias_validar_formulario());
  ?>    
  <link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>pantallas/documento/css/documento.css">
  </head>
  <body data-spy="scroll" data-target="#barra_lateral" data-offset="10">
  	<form accept-charset="UTF-8" id="kformulario_saia" method="post" name="kformulario_saia">
  	
  <div class="navbar navbar-fixed-top">
    <div class="navbar-inner">                           
      <ul class="nav pull-left">                                         
        <li>          
  	        <button type="button" class="btn btn-primary btn-mini" id="ksubmit_saia" enlace="<?php echo $ruta_db_superior; ?>pantallas/busquedas/procesa_filtro_busqueda.php" titulo="Resultado">
  	        	&nbsp;Buscar&nbsp;
  	        </button>
        </li>                 
        <li class="divider-vertical">
        </li>
        <li>                     
  	      <input class="btn btn-danger btn-mini reset" name="commit" type="reset" value="Cancelar">                    
        </li>
        <li class="divider-vertical">
        </li> 
      </ul>      
    </div>
  </div>
    <div class="container master-container span9" style="left:250px;position:absolute">
        <div id="mostrar_contenido">
        	
        	
<?php
include_once($ruta_db_superior."calendario/calendario.php"); 
$componente=33;
if(@$_REQUEST["idbusqueda_componente"]){
	$componente=$_REQUEST["idbusqueda_componente"];
}
$idbusqueda_componente=busca_filtro_tabla("","busqueda_componente","idbusqueda_componente='".$componente."'","",$conn);

?>  
<style>
.busqueda_general{
	
}
.control-group{
	font-size:9pt;
}
</style>
<div id="busqueda_general" class="busqueda_general">   
        <legend style="font-size:9pt;color:#0885C8;line-height:15px" id="principal"><strong>B&uacute;squeda r&aacute;pida</strong></legend>
        
        <strong>Por tipo de documento (series documentales)</strong>
        <?php 
        $nombre_arbol[0]="serie";
        echo arbol("bqsaia_A@serie",$nombre_arbol[0],"test_serie.php?tabla=serie&categoria=2",0,1); ?>
        <input type="hidden" name="bksaiacondicion_A@serie" id="bksaiacondicion_A@serie" value="in">
        <input type="hidden" name="bqsaiaenlace_A@serie" id="bqsaiaenlace_A@serie" value="y" />
        <br>
        
        <div class="row">
          <div class="control-group radio_buttons span4">
            <strong>Tipo radicaci&oacute;n</strong>
            <input type="hidden" name="bksaiacondicion_tipo_radicado" id="bksaiacondicion_tipo_radicado" value="=">
            <div class="controls">
              	<select name="bqsaia_tipo_radicado" id="bqsaia_tipo_radicado">
              		<option value="">Seleccione...</option>
              		<option value="1">Radicaci&oacute;n entrada</option>
              		<option value="2">Radicaci&oacute;n salida</option>
              	</select>
            </div>          
          </div> 
        </div>
        <input type="hidden" name="bqsaiaenlace_tipo_radicado" id="bqsaiaenlace_tipo_radicado" value="y" />
        <br>
        <!--hr width="75%" color="black" style="text-align:left"/-->
        
        <strong>N&uacute;mero de radicado</strong>
            <input type="hidden" name="bksaiacondicion_A@numero" id="bksaiacondicion_A@numero" value="in">
        
        <div class="controls">
            <input id="bqsaia_numero" name="bqsaia_A@numero" size="50" type="text">
        </div>
        <input type="hidden" name="bqsaiaenlace_A@numero" id="bqsaiaenlace_A@numero" value="y" />
        <br>
        <!--hr width="75%" color="black" style="text-align:left"/-->
        
        <strong>Asunto o descripci&oacute;n</strong>
            <input type="hidden" name="bksaiacondicion_A@descripcion" id="bksaiacondicion_A@descripcion" value="like_total">
        <div class="controls" >
            <textarea id="bqsaia_A@descripcion" name="bqsaia_A@descripcion" rows="4"></textarea>
        </div>
        <input type="hidden" name="bqsaiaenlace_A@descripcion" id="bqsaiaenlace_A@descripcion" value="y" />
        <br>
        <!--hr width="75%" color="black" style="text-align:left"/-->
        
        <strong>Entre las fechas</strong>
            <input type="hidden" name="bksaiacondicion_A@fecha_x" id="bksaiacondicion_A@fecha_x" value=">=">
        <div class="controls">
            <input id="bqsaia_A@fecha_x" name="bqsaia_A@fecha_x" style="width:100px" type="text" value="" placeholder="Inicio">
            <?php selector_fecha("bqsaia_A@fecha_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../",""); ?>
            <input type="hidden" name="bqsaiaenlace_A@fecha_x" id="bqsaiaenlace_A@fecha_x" value="y" />
            &nbsp;&nbsp;y&nbsp;&nbsp;
            <input type="hidden" name="bksaiacondicion_A@fecha_y" id="bksaiacondicion_A@fecha_y" value="<=">
            <input id="bqsaia_A@fecha_y" name="bqsaia_A@fecha_y" style="width:100px" type="text" value="" placeholder="Fin">
            <?php selector_fecha("bqsaia_A@fecha_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../",""); ?>
        </div>

        <input type="hidden" name="bqsaiaenlace_A@fecha_y" id="bqsaiaenlace_A@fecha_y" value="y" />
        <br>
        <!--hr width="75%" color="black" style="text-align:left"/-->
        
        <legend style="font-size:9pt;color:#0885C8;line-height:15px" id="contenido"><strong>Destinos</strong></legend>
        <div class="control-group;" style="background-color:#F5F5F5">
	        <b>Nombre</b>
	        <input id="bksaiacondicion_c@nombre" type="hidden" value="like_total" name="bksaiacondicion_c@nombre">
	        <div class="controls">
	        	<input id="destinos-nombre" type="text" name="bqsaia_c@nombre" maxlength="2000">
	        </div>
	        <input type="hidden" name="bqsaiaenlace_c@nombre" value="y" />
	        
	        <b>Identificaci&oacute;n</b>
	        <input id="bksaiacondicion_c@identificacion" type="hidden" value="like_total" name="bksaiacondicion_c@identificacion">
	        <div class="controls">
	        	<input id="destinos-identificacion" type="text" name="bqsaia_c@identificacion" maxlength="2000">
	        </div>
	        <input type="hidden" name="bqsaiaenlace_c@identificacion" value="y" />
	        
	        <b>Empresa</b>
	        <input id="bksaiacondicion_b@empresa" type="hidden" value="like_total" name="bksaiacondicion_b@empresa">
	        <div class="controls">
	        	<input id="destinos-empresa" type="text" name="bqsaia_b@empresa" maxlength="2000">
	        </div>
	        <input type="hidden" name="bqsaiaenlace_b@empresa" value="y" />
	     </div>
        <br>
		
		<input type="hidden" id="filtro_adicional" name="filtro_adicional" value="">
	<!--div class="form-actions">
	  <button type="button" class="btn btn-primary" id="ksubmit_saia" enlace="pantallas/busquedas/procesa_filtro_busqueda.php" titulo="Resultado">Buscar</button>    
	  <input class="btn btn-danger" name="commit" type="reset" value="Cancelar">  
	</div-->
        <input type="hidden" name="bqcondicion_adicional">
        <input type="hidden" name="bqtipodato" value="date|A@fecha_x,A@fecha_y">
        <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo $idbusqueda_componente[0]["idbusqueda_componente"]; ?>">
    
<?php
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
                  --></script><br>
	<?php
	
}
?>
<script>
$(".reset").live('click',function(){
	<?php
	$cantidad=count($nombre_arbol);
	for($i=0;$i<$cantidad;$i++){
		echo 'seleccionar_todos'.$nombre_arbol[$i]."(0); ";
	}
	?>
});

</script>
</div>
        	
        	
        </div>
                
        <div id="div_otros_campos" style="display:none">
        	
        </div>
	    <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
      </form>
    </div>  
  </body>
  <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
  <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/documento/js/carga_formulario.js"></script>
  <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/codificacion_funciones.js"></script>
  <script>
  $(document).keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13') {
        $("#ksubmit_saia").click();
    }
});
  </script>
<?php 
echo(librerias_arboles());
echo(librerias_bootstrap());
echo(librerias_datepicker_bootstrap());

?>
<script src="<?php echo $ruta_db_superior; ?>js/jquery.js"></script>
</html>