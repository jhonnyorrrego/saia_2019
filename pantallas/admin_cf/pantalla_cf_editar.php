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
include_once($ruta_db_superior."calendario/calendario.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."formatos/librerias/header_formato.php");
echo(estilo_bootstrap());

$campos=explode(",",$_REQUEST['campos']);

$tipo_fecha='';
$html='<div class="container">
		<br>
		<div class="control-group" nombre="etiqueta">
			<legend>Editar </legend>
		</div>
		<form id="formulario_tareas" class="form-vertical">';

echo($html);

for($i=0;$i<count($campos);$i++){
	if($campos[$i]=='cod_padre'){
		$cod_padre=1;
	}
	if($campos[$i]=='descripcion'){
		$descripcion=1;
	}
	if($campos[$i]=='tipo'){
		$tipo=1;
	}
	if($campos[$i]=='categoria'){
		$categoria=1;
	}
}

if($_REQUEST['guardar']==1){

	$valores='';
	$tabla=$_REQUEST['tabla'];
	$id=$_REQUEST["id"];
	$llave=array_keys($_REQUEST);
	unset($_REQUEST['tabla']);
	unset($_REQUEST['submit']);
	unset($_REQUEST['guardar']);
	unset($_REQUEST['id']);
	
	if($_REQUEST["tipo_fecha"]){
		$fecha=explode(',',$_REQUEST["tipo_fecha"]);		
		for($j=0;$j<count($fecha);$j++){
			$tipo_fecha[$fecha[$j]]=fecha_db_almacenar($_REQUEST[$fecha[$j]],"Y-m-d");
			unset($_REQUEST[$fecha[$j]]);		
		}			
	}
	
	unset($_REQUEST["tipo_fecha"]);
	
	foreach ($tipo_fecha as $key=>$temp) {
      $valores .= $key." = ".$temp.",";   
	}
	
	foreach ($_REQUEST as $key=>$temp) {
      $valores .= $key." = '".$temp."',";   
	}
	$sql="update ".$tabla." set ".trim($valores,",")." where id".$tabla."=".$id;
		
	phpmkr_query($sql);
	echo('<script>parent.window.location.reload();</script>');
	
}else{
$tabla=$_REQUEST['tabla'];
$id=$_REQUEST['key'];
$datos=busca_filtro_tabla("",$tabla,"id".$tabla."=".$id,"",$conn);

echo(librerias_jquery("1.7"));
echo(librerias_arboles());
echo(librerias_bootstrap());
?>
	
			<div class="control-group">
				<label class="control-label" for="etiqueta">Nombre*:</label>
				<div class="controls">
					<input type="text" name="nombre" id="nombre" class="required" value="<?php echo $datos[0]['nombre'];?>">
				</div>
			</div>
			<?php 
			autocompletar_categoria();
			if($cod_padre){?>
			<div class="control-group">
				<label class="control-label" for="etiqueta">Padre:</label>
				<div class="controls">
					<?php
						
						echo arbol("cod_padre","cod_padre","pantallas/admin_cf/test_tabla_cf.php?tabla=".$_REQUEST['tabla'],0,0,1,1,'radio',$datos[0]['cod_padre']);
					?>
				</div>
			</div>
			<?php 
			}
			if($descripcion){
			?>
			<div class="control-group">
				<label class="control-label" for="etiqueta">Descripci&oacute;n:</label>
				<div class="controls">
					<textarea id="descripcion" maxlength="255" name="descripcion" placeholder="Descripcion"><?php echo $datos[0]['descripcion'];?></textarea>
				</div>
			</div>
			<?php 
			}
			if($tipo){
			?>
			<div class="control-group">
				<label class="control-label" for="etiqueta">Tipo:</label>
				<div class="controls">
					<input type="text" name="tipo" id="tipo" value="<?php echo $datos[0]['tipo'];?>">
					<div id='completar_tipo' class='ac_results'></div>
				</div>
			</div>
			<?php 
			}
			if($categoria){
			?>
			<div class="control-group">
				<label class="control-label" for="etiqueta">Categoria:</label>
				<div class="controls">
					<input type="text"  name="categoria" id="categoria" value="<?php echo $datos[0]['categoria'];?>">
					<div id='completar_categoria' class='ac_results'></div>
				</div>
			</div>
			<?php 
			}
			?>
			<div class="control-group">
				<label class="control-label" for="etiqueta">Estado*:</label>
				<div class="controls">
					<input type="radio" class="required" name="estado" id="estado0" value="1" <?php if($datos[0]["estado"]==1)echo('checked="true"');?>>Activo
					<input type="radio" name="estado" id="estado1" value="0" <?php if($datos[0]["estado"]==0)echo('checked="true"');?>>Inactivo
					<label class="error" for="estado"></label>
				</div>
			</div> 
			
<?php

for($i=0;$i<count($campos);$i++){
		
	$opcion_campo=explode("|||",$campos[$i]);
	$categoria=explode("@",$opcion_campo[0]);
	$nombre_campo=$categoria[0];
	$tipo_campo=$categoria[1];
	
	if($campos[$i]=='cod_padre'){
		$cod_padre=1;
	}else if($campos[$i]=='descripcion'){
		$descripcion=1;
	}
	else if($campos[$i]=='tipo'){
		$tipo=1;
	}
	else if($campos[$i]=='categoria'){
		$categoria=1;
	}else{
	
		switch($tipo_campo){
			case 'select':
	        	$opcion=explode("||",$opcion_campo[1]);
				
				$html='<b>'.strtoupper(str_replace("_", " ", $nombre_campo)).':</b><br/> <select id="'.$nombre_campo.'" name="'.$nombre_campo.'"><option val="">Por favor seleccione...</option>';			
				for($j=0;$j<count($opcion);$j++){
					$opciones=explode("|",$opcion[$j]);
					$eti_opcion=$opciones[0];
					$valor_opcion=$opciones[1];
					if($valor_opcion==$datos[0][$nombre_campo]){
						$html.='<option value="'.$valor_opcion.'" selected>'.$eti_opcion.'</option>';
					}else{
						$html.='<option value="'.$valor_opcion.'">'.$eti_opcion.'</option>';
					}
					
				}
				
				$html.='</select><br/><br/>';
				echo($html);		
	        break;
			
			case 'radio':
				$opcion=explode("||",$opcion_campo[1]);
				
				$html='<b>'.strtoupper(str_replace("_", " ", $nombre_campo)).':</b><br/> ';
				for($j=0;$j<count($opcion);$j++){
					$opciones=explode("|",$opcion[$j]);
					$eti_opcion=$opciones[0];
					$valor_opcion=$opciones[1];
					
					$seleccionados=explode(",",$datos[0][$nombre_campo]);
					for($op=0;$op<count($seleccionados);$op++){
						if($seleccionados[$op]==$valor_opcion){
							$html.=' <input type="radio" id="'.$nombre_campo.$j.'" name="'.$nombre_campo.'" value="'.$valor_opcion.'" checked> '.$eti_opcion;
						}else{
							$html.=' <input type="radio" id="'.$nombre_campo.$j.'" name="'.$nombre_campo.'" value="'.$valor_opcion.'"> '.$eti_opcion;
						}
					}
					
					
				}
				$html.='<br/><br/>';
				echo($html);
	
			break;
			
			case 'checkbox':
				$opcion=explode("||",$opcion_campo[1]);
				
				$html='<b>'.strtoupper(str_replace("_", " ", $nombre_campo)).' </b><br/> ';
				for($j=0;$j<count($opcion);$j++){
					$opciones=explode("|",$opcion[$j]);
					$eti_opcion=$opciones[0];
					$valor_opcion=$opciones[1];
					
					$seleccionados=explode(",",$datos[0][$nombre_campo]);
					for($op=0;$op<count($seleccionados);$op++){
						if($seleccionados[$op]==$valor_opcion){
							$html.=' <input type="checkbox" id="'.$nombre_campo.$j.'" name="'.$nombre_campo.'[]" value="'.$valor_opcion.'" checked> '.$eti_opcion;
						}else{
							$html.=' <input type="checkbox" id="'.$nombre_campo.$j.'" name="'.$nombre_campo.'[]" value="'.$valor_opcion.'"> '.$eti_opcion;						}
					}
					
					
					
				}
				$html.='<br/><br/>';
				echo($html);
			
			break;
			
			case 'date':
				$html='<div class="control-group">
				<b>'.strtoupper(str_replace("_", " ", $nombre_campo)).' </b><br/>
		            <input id="'.$nombre_campo.'" value="'.$datos[0][$nombre_campo].'" name="'.$nombre_campo.'" style="width:100px" type="text" value="" placeholder="Inicio">';
	       		echo($html);
				echo(selector_fecha($nombre_campo,"formulario_tareas","Y-m-d",date("m"),date("Y"),"default.css","../../","").'</div>');
				$tipo_fecha[]=$nombre_campo;
					
			break;
			
			case 'text':
				$html='<b>'.strtoupper(str_replace("_", " ", $nombre_campo)).' </b><br/> ';
				$html.='<input required type="text" id="'.$nombre_campo.'" name="'.$nombre_campo.'" value="'.$datos[0][$nombre_campo].'"><br/>';
				echo($html);
			break;
			
			case 'area':
				$html='<b>'.strtoupper(str_replace("_", " ", $nombre_campo)).' </b><br/> ';
				
				$html.='<textarea tabindex="4" cols="53" rows="3" class="tiny_avanzado" id="'.$nombre_campo.'" name="'.$nombre_campo.'">'.$datos[0][$nombre_campo].'</textarea>';
				echo($html);
			break;  
			
			default:
				if($nombre_campo!=''){
					$html='<b>'.strtoupper(str_replace("_", " ", $nombre_campo)).' </b><br/> ';
					$html.='<input required type="text" id="'.$nombre_campo.'" name="'.$nombre_campo.'" value="'.$datos[0][$nombre_campo].'"><br/>';
					echo($html);
				}
			break;
		}

	}
}
?>
<div class="control-group">
				<div class="controls">
					<input type='submit' class="btn btn-primary btn-mini" name="submit" id="submit" value="continuar">
					<input type="hidden" name="tabla" value="<?php echo($tabla)?>">
					<input type="hidden" name="id" value="<?php echo($id)?>">
					<input type="hidden" name="tipo_fecha" value="<?php echo(implode(",",$tipo_fecha))?>">
					<input type="hidden" name="guardar" value="1">
				</div>
			</div>
		</form>
	</div>
	<script type="text/javascript" src="<?php echo($ruta_db_superior); ?>js/jquery.validate.1.13.1.js"></script>
	<style>
	label.error {
		font-weight: bold;
		color: red;
	}
	</style>
<script>	
	$(document).ready(function(){

		formulario = $("#formulario_tareas");
    	formulario.validate();
	});
	</script>
<?php
}

function autocompletar_categoria(){
	global $ruta_db_superior;
?>
<style >
.ac_results {
	padding: 0px;
	border: 0px solid black;
	background-color: white;
	overflow: hidden;
	z-index: 99999;
}

.ac_results ul {
	width: 100%;
	list-style-position: outside;
	list-style: none;
	padding: 0;
	margin: 0;
}
.ac_results li:hover {
background-color: A9E2F3;
}

.ac_results li {
	margin: 0px;
	padding: 2px 5px;
	cursor: default;
	display: block;
	font: menu;
	font-size: 10px;
	line-height:10px;
	overflow: hidden;
}
</style>
<script>
	$(document).ready(function(){
		//$("#categoria").hide();
		//$("#categoria").parent().append("<input type='text' id='buscar_categoria' size='50' name='buscar_categoria'><div id='ul_completar' class='ac_results'></div>");
		$("#categoria").keyup(function (){
			if($(this).val()==0 || $(this).val()==""){
				//alert("Ingrese el nombre da le categoria");
			}else{
				var tabla='<?php echo $_REQUEST['tabla']?>';
				var campo='categoria';
				var div='completar_categoria';
				$("#completar_categoria").load("buscar_categoria.php", { categoria: $(this).val(), tabla: tabla, campo:campo , div:div });
			}
		});
		$("#tipo").keyup(function (){
			if($(this).val()==0 || $(this).val()==""){
				//alert("Ingrese el nombre da le categoria");
			}else{
				var tabla='<?php echo $_REQUEST['tabla']?>';
				var campo='tipo';
				var div='completar_tipo';
				$("#completar_tipo").load("buscar_categoria.php", { categoria: $(this).val(), tabla: tabla, campo:campo, div:div });
			}
		});
	});
	function cargar_datos(categoria,campo,div){
		$("#"+campo).val(categoria);
		$("#"+div).empty();
	};
	
</script>
<?php 
}


function arbol($campo,$nombre_arbol,$url,$cargar_todos=0,$padresehijos=false,$quitar_padres=false,$adicionales=false,$tipo_etiqueta='check',$seleccionado){
	global $ruta_db_superior;
	if ($seleccionado=='') {
		$seleccionado=0;
	}
	$entidad=$nombre_arbol;
	?>
	<div><?php //echo $seleccionados; ?></div>
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
<input type="hidden" value="<?php echo $seleccionado;?>" name="<?php echo $campo; ?>" id="<?php echo $entidad; ?>" >
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
      tree<?php echo $entidad; ?>.enableSmartXMLParsing(false);
      <?php } ?>
      <?php /*Esta condicion reemplaza a la que está comentada arriba, tomada de opav*/      
       if($padresehijos){?>
      tree<?php echo $entidad; ?>.enableThreeStateCheckboxes(true);
      tree<?php echo $entidad; ?>.setOnCheckHandler(onNodeSelect<?php echo $entidad; ?>);
      <?php }?>
      
			tree<?php echo $entidad; ?>.loadXML("<?php echo $ruta_db_superior.$url; ?>");
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
      tree<?php echo $entidad; ?>.setCheck(<?php echo $seleccionado; ?>,true);
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
	if($_REQUEST["librerias_cf"]){
		include_once($ruta_db_superior.$_REQUEST["librerias_cf"]);	
	}
?>