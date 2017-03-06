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
if($_REQUEST['guardar']==1){
	print_r($_REQUEST);die();
	$sql="INSERT INTO tareas (fecha,tarea,responsable,descripcion,prioridad,fecha_tarea,ejecutor,documento_iddocumento) VALUES(".fecha_db_almacenar($_REQUEST['fecha'],"Y-m-d H:i:s").",'".($_REQUEST['tarea'])."','".$_REQUEST['responsable']."','".($_REQUEST[descripcion])."','".$_REQUEST[prioridad]."',".fecha_db_almacenar($_REQUEST['fecha_tarea'],"Y-m-d").",'".usuario_actual("funcionario_codigo")."','".$_REQUEST['iddoc']."')";
	phpmkr_query($sql);
	$formato=busca_filtro_tabla("b.idformato","documento a, formato b","lower(a.plantilla)=b.nombre AND a.iddocumento=".$_REQUEST['iddoc'],"",$conn);
	$responsable=str_replace(",", "@", $_REQUEST['responsable']);
	
	transferencia_automatica($formato[0]["idformato"],$_REQUEST["iddoc"],$responsable,1);
	alerta("Tarea asignada!");
	redirecciona("adicionar_tareas.php?iddoc=".$_REQUEST['iddoc']);
}else{
  if(@$_REQUEST["fecha"]){
    $fecha_tarea=date("Y-m-d",$_REQUEST["fecha"]);
  }
  if($_REQUEST["iddoc"]){
    include_once($ruta_db_superior."pantallas/documento/menu_principal_documento.php");
    menu_principal_documento($_REQUEST["iddoc"]);
    echo(librerias_arboles());
    //echo(librerias_bootstrap());
    echo(librerias_datepicker_bootstrap());
  }
  else{
    echo(librerias_jquery("1.7"));
    echo(librerias_arboles());
    echo(librerias_bootstrap());
    echo(librerias_datepicker_bootstrap());
  }
	?>
	<div class="container">
		<div class="control-group" nombre="etiqueta">
			<legend>Asignar tarea al documento</legend>
		</div>
		<form id="formulario_tareas" class="form-horizontal">
			<div class="control-group">
				<label class="control-label" for="etiqueta">Fecha*:</label>
				<div class="controls">
					<input type="text" name="fecha" id="fecha" class="required" readonly="" value="<?php echo(date("Y-m-d H:i:s"));?>">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="etiqueta">Responsable*:</label>
				<div class="controls">
					<?php
						echo arbol("responsable","responsable","test.php?rol=1&sin_padre=1",0,1,1,false,'radio');
					?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="etiqueta">Tarea a realizar*:</label>
				<div class="controls">
					<input type="text" class="required" name="tarea" id="etiqueta" placeholder="Tarea a realizar">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="etiqueta">Descripci&oacute;n:</label>
				<div class="controls">
					<textarea id="descripcion" name="descripcion" placeholder="Descripcion"></textarea>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="etiqueta">Prioridad*:</label>
				<div class="controls">
					<input type="radio" class="required" name="prioridad" id="prioridad0" value="0">Baja
					<input type="radio" name="prioridad" id="prioridad0" value="1">Media
					<input type="radio" name="prioridad" id="prioridad0" value="2">Alta
					<label class="error" for="prioridad"></label>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="etiqueta">Fecha tarea*:</label>
				<div class="controls">
					<div class="input-append date" id="datepicker">
						<input class="required" id="fecha_tarea" name="fecha_tarea" data-format="yyyy-MM-dd" value="<?php echo($fecha_tarea);?>">
						<span class="add-on"><i class="icon-th"></i></span>
						<label class="error" for="fecha_tarea"></label>
					</div>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<input type='submit' class="btn btn-primary btn-mini" name="submit" id="submit" value="continuar">
					<input type="hidden" name="iddoc" value="<?php echo($_REQUEST['iddoc'])?>">
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
		$('#datepicker').datetimepicker({
			language: 'es',
			pick12HourFormat: true,
			pickTime: false
		}).on('changeDate', function(e){
			$(this).datetimepicker('hide');
		});
		$("#formulario_tareas").validate();
	});
	</script>
<?php
}
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
<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/codificacion_funciones.js"></script>
	<?php
	}
	
?>
