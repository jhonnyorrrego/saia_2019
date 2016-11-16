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
$componente=33;
if(@$_REQUEST["idbusqueda_componente"]){
	$componente=$_REQUEST["idbusqueda_componente"];
}
$idbusqueda_componente=busca_filtro_tabla("","busqueda_componente","idbusqueda_componente='".$componente."'","",$conn);
global $ruta_db_superior;

?>  
<style>
.busqueda_general{
	
}
.control-group{
	font-size:9pt;
}
.clase_capas{
	margin-bottom: 3px;
  min-height: 11px;
  padding: 10px;
  border: 1px solid #E3E3E3;
}
.clase_sin_capas{
	margin-bottom: 0px;
  min-height: 0px;
  padding: 0px;
  border: 0px solid #E3E3E3;
}
</style>
        
        
        <div data-toggle="collapse" data-target="#contenido_formato">
				  <i class="icon-minus-sign"></i><b>B&uacute;squeda por contenido del documento</b>
				</div>
        <div id="contenido_formato" class="collapse in opcion_informacion well">
        <?php 
        $nombre_arbol[1]="plantilla";
        echo arbol("bqsaia_A@plantilla",$nombre_arbol[1],"pantallas/inventario_documental/test_inventario.php","","","","","radio",1); ?>
        <input type="hidden" name="bksaiacondicion_A@plantilla" id="bksaiacondicion_A@plantilla" value="in">
        <input type="hidden" name="bqsaiaenlace_A@plantilla" value="y" />
        </div>
        
        <div id="muestra_plantilla" style="font-size:9pt;" class="well clase_sin_capas">
        </div>
        <!--hr width="75%" color="black" style="text-align:left"/-->
        
        
	<!--div class="form-actions">
	  <button type="button" class="btn btn-primary" id="ksubmit_saia" enlace="pantallas/busquedas/procesa_filtro_busqueda.php" titulo="Resultado">Buscar</button>    
	  <input class="btn btn-danger" name="commit" type="reset" value="Cancelar">  
	</div-->
        <input type="hidden" name="bqcondicion_adicional">
        <input type="hidden" name="bqtipodato" value="date|A@fecha_x,A@fecha_y">
        <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo $idbusqueda_componente[0]["idbusqueda_componente"]; ?>">
    
<?php
function arbol($campo,$nombre_arbol,$url,$cargar_todos=0,$padresehijos=false,$quitar_padres=false,$adicionales=false,$tipo_etiqueta='check',$abrir_arbol=0){
	global $ruta_db_superior;
	$entidad=$nombre_arbol;
	?>
	<div ><?php //echo $seleccionados; ?></div>
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
			if($abrir_arbol==1){
				echo "tree".$entidad.".openAllItems(0);";
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
$("#ksubmit_saia").click(function(){
	<?php if($idbusqueda_componente[0]["nombre"]=="documentos_serie"){ ?>
	var series=$("#serie").val();
	if(!series){
		notificacion_saia('Debe seleccionar una serie','success','',3500);
		return false;
	}
	<?php } ?>
	if(typeof(tree<?php echo $nombre_arbol[2]; ?>) != 'undefined'){
		$("#<?php echo $nombre_arbol[2]; ?>").val(codificar_repetidos(tree<?php echo $nombre_arbol[2]; ?>.getAllChecked()));
	}
	if(typeof(tree<?php echo $nombre_arbol[3]; ?>) != 'undefined'){
		$("#<?php echo $nombre_arbol[3]; ?>").val(codificar_repetidos(tree<?php echo $nombre_arbol[3]; ?>.getAllChecked()));
	}
	if(typeof(tree<?php echo $nombre_arbol[4]; ?>) != 'undefined'){
		$("#<?php echo $nombre_arbol[4]; ?>").val(codificar_repetidos(tree<?php echo $nombre_arbol[4]; ?>.getAllChecked()));
	}
	if(typeof(tree<?php echo $nombre_arbol[5]; ?>) != 'undefined'){
		$("#<?php echo $nombre_arbol[5]; ?>").val(codificar_repetidos(tree<?php echo $nombre_arbol[5]; ?>.getAllChecked()));
	}
	//return false;
	var filtro_actual=$("#filtro_adicional").val();
	var tablas=filtro_actual.split("@");
	var fin=strpos(tablas[0], ', (');
	if(fin){
		tablas[0]=tablas[0].substr(0,fin);
	}
	var fin_camp=strpos(tablas[1], ' and (');
	if(fin_camp){
		tablas[1]=tablas[1].substr(0,fin_camp);
	}
	var nuevas_tablas=tablas[0];
	var nuevos_campos=tablas[1];
	
	var valor1=$("#<?php echo $nombre_arbol[2]; ?>").val();
	var valor2=$("#<?php echo $nombre_arbol[3]; ?>").val();
	var valor3=$("#<?php echo $nombre_arbol[4]; ?>").val();
	var valor4=$("#<?php echo $nombre_arbol[5]; ?>").val();
	
	if((valor1!=''&&valor1!=undefined)||(valor2!=''&&valor2!=undefined)||(valor3!=''&&valor3!=undefined)){
		if(!strpos(nuevas_tablas,'uzon_salida z')){
			nuevas_tablas+=',buzon_salida z';
			nuevos_campos+=' AND iddocumento=z.archivo_idarchivo';
		}
	}
	else{
		//nuevas_tablas=nuevas_tablas.replace('buzon_salida z','');
		//nuevos_campos=nuevos_campos.replace(' AND iddocumento=z.archivo_idarchivo','');
	}
	if((valor4!=''&&valor4!=undefined)){
		if(!strpos(nuevas_tablas,'uzon_entrada w')){
			nuevas_tablas+=',buzon_entrada w';
			nuevos_campos+=' AND iddocumento=w.archivo_idarchivo';
		}
	}
	else{
		nuevas_tablas=nuevas_tablas.replace(',buzon_entrada w','');
		nuevos_campos=nuevos_campos.replace(' AND iddocumento=w.archivo_idarchivo','');
	}
	$("#filtro_adicional").val(nuevas_tablas+' @ '+nuevos_campos);
	//return false;
});

function strpos (haystack, needle, offset) {
  var i = (haystack + '').indexOf(needle, (offset || 0));
  return i === -1 ? false : i;

}
function codificar_repetidos(lista){
	vector=lista.split(",");
	var a=0;
	var vector2=new Array();
	for(i=0;i<vector.length;i++){
		if(vector[i].indexOf("_")!=-1){
    		vector2[a]=vector[i].substr(0,vector[i].indexOf("_"));
    		a++;
	    }
	    else if(vector[i]!=''){
	    	vector2[a]=vector[i];
	    	a++;
	    }
	}
 	return(vector2.join(','));      
}
$(".opcion_informacion").on("hide",function(){
  $(this).prev().children("i").removeClass();
  $(this).prev().children("i").addClass("icon-plus-sign");
  $(this).removeClass('clase_capas');
  $(this).addClass('clase_sin_capas');
});
$(".opcion_informacion").on("show",function(){
  $(this).prev().children("i").removeClass();
  $(this).prev().children("i").addClass("icon-minus-sign");
  $(this).removeClass('clase_sin_capas');
  $(this).addClass('clase_capas');
});
</script>
</div>