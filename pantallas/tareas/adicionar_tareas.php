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
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("responsable");
desencriptar_sqli('form_info');
echo(librerias_jquery("1.7"));
include_once($ruta_db_superior."class_transferencia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
echo(estilo_bootstrap());
echo(librerias_jquery("1.7"));

if($_REQUEST['guardar']==1){
	$orden=0;
	$accion_tareas=0;
	if(@$_REQUEST["ruta_aprob"]!==0 && @$_REQUEST["iddoc"]){
		$tareas_ruta_aprob=busca_filtro_tabla("","tareas","documento_iddocumento=".$_REQUEST["iddoc"]." AND ruta_aprob=-1","",$conn);
		$orden=$tareas_ruta_aprob["numcampos"]+1;
		$accion_tareas=intval(@$_REQUEST["accion_tareas"]);
	}
	$sql="INSERT INTO tareas (fecha,tarea,responsable,descripcion,prioridad,fecha_tarea,ejecutor,documento_iddocumento,ruta_aprob,orden_tareas,accion_tareas) VALUES(".fecha_db_almacenar($_REQUEST['fecha'],"Y-m-d H:i:s").",'".($_REQUEST['tarea'])."','".$_REQUEST['responsable']."','".($_REQUEST[descripcion])."','".$_REQUEST[prioridad]."',".fecha_db_almacenar($_REQUEST['fecha_tarea'],"Y-m-d").",'".usuario_actual("funcionario_codigo")."','".$_REQUEST['iddoc']."',".$_REQUEST["ruta_aprob"].",".$orden.",".$accion_tareas.")";
	phpmkr_query($sql);
	if(@$_REQUEST["ruta_aprob"]==-1){
		?>
		<script>
			window.parent.hs.close();
			window.parent.location.reload();
		</script>
		<?php
		die();
	}
	else if($_REQUEST["iddoc"] && @$_REQUEST['responsable']){
		$formato=busca_filtro_tabla("b.idformato","documento a, formato b","lower(a.plantilla)=b.nombre AND a.iddocumento=".$_REQUEST['iddoc'],"",$conn);
		$responsable=str_replace(",", "@", $_REQUEST['responsable']);
		transferencia_automatica($formato[0]["idformato"],$_REQUEST["iddoc"],$responsable,1);
	}
	alerta("Tarea asignada!");
	?>
	<script type="text/javascript">
	    $("#div_actualizar_info_index",top.document).click();
	    var open_tab_tarea=$("#arbol_formato",parent.document).contents().find("#cantidad_tareas").closest("li").hasClass("active");
	    if(open_tab_tarea===false){
	        $("#arbol_formato",parent.document).contents().find("#cantidad_tareas").click();
	    }else{
	        $("#arbol_formato",parent.document).contents().find("#arbol_documento").click();
	        $("#arbol_formato",parent.document).contents().find("#cantidad_tareas").click();
	    }
	</script>
	<?php
	redirecciona("adicionar_tareas.php?iddoc=".$_REQUEST['iddoc']);
}else{
  if(@$_REQUEST["fecha"]){
    $fecha_tarea=date("Y-m-d",$_REQUEST["fecha"]);
  }
  if($_REQUEST["iddoc"]){
  	if(!isset($_REQUEST["tarea_ruta_aprob"])){
	    include_once($ruta_db_superior."pantallas/documento/menu_principal_documento.php");
	    menu_principal_documento($_REQUEST["iddoc"]);
			$ruta_aprob=0;
  	}else{
  		$ruta_aprob=-1;
  		$fecha_tarea=date("Y-m-d");
  	}
    echo(librerias_arboles());
    echo(librerias_datepicker_bootstrap());
  }
  else{
    echo(librerias_arboles());
    echo(librerias_bootstrap());
    echo(librerias_datepicker_bootstrap());
  }
	?>
	<div class="container">
		<div class="control-group" nombre="etiqueta">
			<legend>Asignar tarea al documento</legend>
		</div>
		<form id="formulario_tareas" class="form-horizontal" method="POST">
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
			
			<div class="control-group ocultar">
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
			<?php 
			if($ruta_aprob){
				?>
			<div class="control-group">
				<label class="control-label" for="accion_tareas">Acci&oacute;n*:</label>
				<div class="controls">
					<input type="radio" class="required" name="accion_tareas" id="accion_tarea1" value="1">Aprobar
					<input type="radio" class="required" name="accion_tareas" id="accion_tarea2" value="2">Con Visto bueno
					<input type="hidden" name="prioridad" id="prioridad0" value="1">
					<label class="error" for="accion_tarea"></label>
				</div>
			</div>
				<?php 
			}
			else{
			?>
			<div class="control-group">
				<label class="control-label" for="etiqueta">Prioridad*:</label>
				<div class="controls">
					<input type="radio" class="required" name="prioridad" id="prioridad0" value="0">Baja
					<input type="radio" name="prioridad" id="prioridad0" value="1">Media
					<input type="radio" name="prioridad" id="prioridad0" value="2" <?php if($ruta_aprob)echo('checked="checked"');?>>Alta
					<label class="error" for="prioridad"></label>
				</div>
			</div>
			<?php 
			}
			?>
			<div class="control-group ocultar">
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
					<input type="hidden" name="iddoc" value="<?php echo($_REQUEST['iddoc']);?>">
					<input type="hidden" name="ruta_aprob" value="<?php echo($ruta_aprob);?>">
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
		var opcion=parseInt("<?php echo $_REQUEST["tarea_ruta_aprob"];?>");
		if(opcion==1){
			$("#etiqueta").val("PENDIENTE");
			$(".ocultar").hide();
		}
		$('#datepicker').datetimepicker({
			language: 'es',
			pick12HourFormat: true,
			pickTime: false
		}).on('changeDate', function(e){
			$(this).datetimepicker('hide');
		});
		$("#formulario_tareas").validate({
			submitHandler: function(form) {
				<?php encriptar_sqli("formulario_tareas",0,"form_info",$ruta_db_superior);?>
			    form.submit();
			    
			  }
		});
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
    
		function onNodeSelect<?php echo $entidad;?>(nodeId) {
			valor_destino = document.getElementById("<?php echo $entidad;?>");
			destinos = tree<?php echo $entidad;?>.getAllChecked();
			nuevo = destinos.replace(/\,{2,}(d)*/gi, ",");
			nuevo = nuevo.replace(/\,$/gi, "");
			vector = destinos.split(",");
			for ( i = 0; i < vector.length; i++) {
				if (vector[i].indexOf("_") != -1) {
					vector[i] = vector[i].substr(0, vector[i].indexOf("_"));
				}
				nuevo = vector.join(",");
				if (vector[i].indexOf("#") != -1) {
					hijos = tree<?php echo $entidad;?>.getAllSubItems(vector[i]);
					hijos = hijos.replace(/\,{2,}(d)*/gi, ",");
					hijos = hijos.replace(/\,$/gi, "");
					vectorh = hijos.split(",");
	
					for ( h = 0; h < vectorh.length; h++) {
						if (vectorh[h].indexOf("_") != -1)
							vectorh[h] = vectorh[h].substr(0, vectorh[h].indexOf("_"));
						nuevo = eliminarItem(nuevo, vectorh[h]);
					}
				}
			}
			nuevo = nuevo.replace(/\,{2,}(d)*/gi, ",");
			nuevo = nuevo.replace(/\,$/gi, "");
			valor_destino.value = nuevo;
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