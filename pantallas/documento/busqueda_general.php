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
<div data-toggle="collapse" data-target="#busqueda_general">
  <i class="icon-plus-sign"></i><b>B&uacute;squeda r&aacute;pida</b>
</div>
<div id="busqueda_general" class="busqueda_general collapse opcion_informacion well clase_sin_capas">
        <strong>Por tipo de documento (series documentales)</strong>
        <?php
        $nombre_arbol[0]="serie";
        echo arbol("bqsaia_A@serie",$nombre_arbol[0],"test_serie_funcionario.php",0,1); ?>
        <input type="hidden" name="bksaiacondicion_A@serie" id="bksaiacondicion_A@serie" value="in">
        <input type="hidden" name="bqsaiaenlace_A@serie" id="bqsaiaenlace_A@serie" value="y" />
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
        </div>
        
        
        <div data-toggle="collapse" data-target="#contenido_formato">
				  <i class="icon-minus-sign"></i><b>B&uacute;squeda por contenido del documento</b>
				</div>
        <div id="contenido_formato" class="collapse in opcion_informacion well">
        <?php 
        $nombre_arbol[1]="plantilla";
        echo arbol("bqsaia_A@plantilla",$nombre_arbol[1],"test_formatos2.php","","","","","radio",1); ?>
        <input type="hidden" name="bksaiacondicion_A@plantilla" id="bksaiacondicion_A@plantilla" value="in">
        <input type="hidden" name="bqsaiaenlace_A@plantilla" value="y" />
        </div>
        
        <div id="muestra_plantilla" style="font-size:9pt;" class="well clase_sin_capas">
        </div>
        <!--hr width="75%" color="black" style="text-align:left"/-->
        
        <div data-toggle="collapse" data-target="#gestion_mostrar">
				  <i class="icon-plus-sign"></i><b>B&uacute;squeda por tipo de gesti&oacute;n del documento</b>
				</div>
        <div id="gestion_mostrar" class="collapse opcion_informacion well clase_sin_capas">
        <?php
        $name="bqsaia";
        $namecon="bksaiacondicion";
        $namenlace="bqsaiaenlace";
        $componente=busca_filtro_tabla("","busqueda_componente a","a.idbusqueda_componente=".$_REQUEST["idbusqueda_componente"]." and nombre='listado_documentos'","",$conn);
        if($componente["numcampos"]){
            $name="subsaia";
            $namecon="subcondicion";
            $namenlace="subsaiaenlace";
        }
        ?>
			<strong>Transferidos a</strong>
		<input type="hidden" name="<?php echo $namecon; ?>_z@destino" id="bksaiacondicion_z@destino" value="in">
		<div class="controls">
			<?php 
			$nombre_arbol[2]="bqsaia_destino";
			echo arbol($name."_z@destino",$nombre_arbol[2],"test.php?inactivos=1",0,1,1,array('z-nombre__1','in',"'transferido'")); ?>
		</div>
		
		<input type="hidden" name="<?php echo $namenlace; ?>_z@destino" value="y">
		
		<input type="hidden" name="<?php echo $namecon; ?>_z@nombre__1" id="bksaiacondicion_z-nombre__1" value="">
		<input type="hidden" id="bqsaia_z-nombre__1" name="<?php echo $name; ?>_z@nombre__1" value="">
		<br>
		<!--hr width="75%" color="black" style="text-align:left"/-->
		
		<input type="hidden" name="<?php echo $namenlace; ?>_z@nombre" value="y">
		
			<strong>Transferidos por</strong>
		<input type="hidden" name="<?php echo $namecon; ?>_z@origen__1" id="bksaiacondicion_z@origen__1" value="in">
		<div class="controls">
			<?php 
			$nombre_arbol[3]="bqsaia_origen";
			echo arbol($name."_z@origen__1",$nombre_arbol[3],"test.php?inactivos=1",0,1,1,array('z-nombre__2','in',"'transferido'")); ?>
		</div>
		
		<input type="hidden" name="<?php echo $namenlace; ?>_z@origen__1" value="y">
		
		<input type="hidden" name="<?php echo $namecon; ?>_z@nombre__2" id="bksaiacondicion_z-nombre__2" value="">
		<input type="hidden" id="bqsaia_z-nombre__2" name="<?php echo $name; ?>_z@nombre__2" value="">
		
		<input type="hidden" name="<?php echo $namenlace; ?>_z@nombre" value="y">
		<br>
		<!--hr width="75%" color="black" style="text-align:left"/-->
		
			<strong>Elaborado por</strong>
		<input type="hidden" name="bksaiacondicion_a@ejecutor" id="bksaiacondicion_a@ejecutor" value="in">
		<div class="controls">
			<?php 
			$nombre_arbol[4]="ejecutor";
			echo arbol("bqsaia_a@ejecutor",$nombre_arbol[4],"test.php?inactivos=1",0,1,1,array('a-ejecutor','in',"'borrador'")); ?>
		</div>
		
		<input type="hidden" name="bqsaiaenlace_a@ejecutor" value="y">
		<br>
		<!--hr width="75%" color="black" style="text-align:left"/-->
		
		
			<strong>Aprobado por</strong>
		<input type="hidden" name="<?php echo $namecon; ?>_w@destino" id="bksaiacondicion_w@destino" value="in">

		<div class="controls">
			<?php 
			$nombre_arbol[5]="bqsaia_destino2";
			echo arbol($name."_w@destino",$nombre_arbol[5],"test.php?inactivos=1",0,1,1,array('w-nombre','in',"'aprobado'")); ?>
		</div>
		
		<input type="hidden" name="<?php echo $namenlace; ?>_w@destino" value="y">
		<input type="hidden" name="<?php echo $namecon; ?>_w@nombre" id="bksaiacondicion_w-nombre" value="">
		<input type="hidden" id="bqsaia_w-nombre" name="<?php echo $name; ?>_w@nombre" value="">
		
		<div class="row">
          <div class="control-group radio_buttons span4">
            <label class="radio_buttons optional control-label">Etiqueta
            <input type="hidden" name="bksaiacondicion_etiqueta_idetiqueta" id="bksaiacondicion_etiqueta_idetiqueta" value="=">
            </label>
            <div class="controls">
              	<select name="bqsaia_etiqueta_idetiqueta" id="bqsaia_etiqueta_idetiqueta">
              		<option value="">Seleccione...</option>
              		<?php
              		$etiquetas=busca_filtro_tabla("","etiqueta","","",$conn);
					for($i=0;$i<$etiquetas["numcampos"];$i++){
						echo '<option value="'.$etiquetas[$i]["idetiqueta"].'">'.$etiquetas[$i]["nombre"].'</option>';
					}
              		?>
              	</select>
            </div>          
          </div> 
        </div>
    </div>
		
		<input type="hidden" id="filtro_adicional" name="filtro_adicional" value="buzon_salida z@ AND iddocumento=z.archivo_idarchivo">
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
	var etiqueta=$("#bqsaia_etiqueta_idetiqueta").val();
	if(etiqueta!=''){
		if(!strpos(nuevas_tablas,'ocumento_etiqueta')){
			nuevas_tablas+=',documento_etiqueta x';
			nuevos_campos+=' AND iddocumento=x.documento_iddocumento';
		}
	}
	else{
		nuevas_tablas=nuevas_tablas.replace(',documento_etiqueta x','');
		nuevos_campos=nuevos_campos.replace(' AND iddocumento=x.documento_iddocumento','');
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