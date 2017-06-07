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
include_once($ruta_db_superior."class_transferencia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
echo(estilo_bootstrap());

$campos=explode(",",$_REQUEST['campos']);
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
	
	$sql="INSERT INTO ".$_REQUEST['tabla']." (nombre,valor,cod_padre,descripcion,tipo,categoria,estado) VALUES('".htmlentities($_REQUEST['nombre'])."','".$_REQUEST['valor']."','".$_REQUEST['cod_padre']."','".htmlentities($_REQUEST[descripcion])."','".$_REQUEST[tipo]."','".htmlentities($_REQUEST['categoria'])."','".$_REQUEST['estado']."')";
	//print_r($sql);die();
	phpmkr_query($sql);
	echo('<script>parent.window.location.reload();</script>');
}else{
  
    echo(librerias_jquery("1.7"));
    echo(librerias_arboles());
    echo(librerias_bootstrap());
  
	?>
	<div class="container">
		<br>
		<div class="control-group" nombre="etiqueta">
			<legend>Adicionar </legend>
		</div>
		<form id="formulario_tareas" class="form-vertical">
			<div class="control-group">
				<label class="control-label" for="etiqueta">Nombre*:</label>
				<div class="controls">
					<input type="text" name="nombre" id="nombre" class="required" value="">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="etiqueta">Valor*:</label>
				<div class="controls">
					<input type="text" name="valor" id="valor" class="required" value="">
				</div>
			</div>
			<?php 
			autocompletar_categoria();
			if($cod_padre){?>
			<div class="control-group">
				<label class="control-label" for="etiqueta">Padre:</label>
				<div class="controls">
					<?php
						echo arbol("cod_padre","cod_padre","pantallas/admin_cf/test_tabla_cf.php?tabla=".$_REQUEST['tabla'],0,0,1,1,'radio');
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
					<textarea id="descripcion" maxlength="255" name="descripcion" placeholder="Descripcion"></textarea>
				</div>
			</div>
			<?php 
			}
			if($tipo){
			?>
			<div class="control-group">
				<label class="control-label" for="etiqueta">Tipo:</label>
				<div class="controls">
					<input type="text" name="tipo" id="tipo">
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
					<input type="text"  name="categoria" id="categoria">
					<div id='completar_categoria' class='ac_results'></div>
				</div>
			</div>
			<?php 
			}
			?>
			<div class="control-group">
				<label class="control-label" for="etiqueta">Estado*:</label>
				<div class="controls">
					<input type="radio" class="required" name="estado" id="estado0" value="1">Activo
					<input type="radio" name="estado" id="estado1" value="0">Inactivo
					<label class="error" for="estado"></label>
				</div>
			</div> 
			<div class="control-group">
				<div class="controls">
					<input type='submit' class="btn btn-primary btn-mini" name="submit" id="submit" value="continuar">
					<input type="hidden" name="tabla" value="<?php echo($_REQUEST['tabla'])?>">
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

		$("#formulario_tareas").validate();
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




function arbol($campo,$nombre_arbol,$url,$cargar_todos=0,$padresehijos=false,$quitar_padres=false,$adicionales=false,$tipo_etiqueta='check'){
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
<input type="hidden" name="<?php echo $campo; ?>" id="<?php echo $entidad; ?>">
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
