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

include_once($ruta_db_superior."class_transferencia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."formatos/librerias/header_formato.php");
include_once($ruta_db_superior."assets/librerias.php");

?>
<?= jquery() ?>
<?= bootstrap() ?>
<?= breakpoint() ?>
<?= toastr() ?>
<?= icons() ?>
<?= moment() ?><?= validate() ?>
<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen">
<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" media="screen">

<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<link class="main-stylesheet"
                                	href="<?= $ruta_db_superior ?>assets/theme/pages/css/pages.css"
                                	rel="stylesheet" type="text/css" />
                                <link
                                	href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/font-awesome/css/font-awesome.css"
                                	rel="stylesheet" type="text/css" />
                                
                                <script
                                	src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-validation/js/jquery.validate.min.js"
                                	type="text/javascript"></script>
<div class="card card-default">
	<div class="card-body"><h5>ADICIONAR</h5>
		<form name="formulario_tareas" id="formulario_tareas" class="form-vertical">
<?php

$campos=explode(",",$_REQUEST['campos']);
$tipo_fecha='';


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
		$categorias=1;
	}
}


if($_REQUEST['guardar']==1){
		
	if(@$_REQUEST["tipo_fecha"]!=''){
		$fecha=explode(',',$_REQUEST["tipo_fecha"]);
		for($j=0;$j<count($fecha);$j++){
			$tipo_fecha[$fecha[$j]]=fecha_db_almacenar($_REQUEST[$fecha[$j]],"Y-m-d");
			unset($_REQUEST[$fecha[$j]]);
		}
	}else{
		$tipo_fecha=array();	
	}
	unset($_REQUEST["tipo_fecha"]);	
		
	$tabla=$_REQUEST['tabla'];
	$llave=array_keys($_REQUEST);
	unset($_REQUEST['tabla']);
	unset($_REQUEST['submit']);
	unset($_REQUEST['guardar']);
		
	$valores=array();
	for($i=0;$i<count($llave);$i++){
		if(is_array($_REQUEST[$llave[$i]])){
			$_REQUEST[$llave[$i]]=implode(",",array_filter($_REQUEST[$llave[$i]]));		
		}
	}	
	if($tabla=='cf_convenio'){
		$nombre_contador=str_replace(" ", "_", strtolower($_REQUEST['nombre']));
		$insert_convenio="insert into contador (consecutivo,nombre,reiniciar_cambio_anio) values (1,'".$nombre_contador."',0)";
		phpmkr_query($insert_convenio);
		$insert=phpmkr_insert_id();
		if($insert){
			$_REQUEST['contador_idcontador']=$insert;
		}
	}
	if(count($tipo_fecha)){
		$sql="INSERT INTO ".$tabla." (".implode(",",array_keys($_REQUEST)).",".implode(",",array_keys($tipo_fecha)).") VALUES('".implode("','",array_values($_REQUEST))."',".implode(",",array_values($tipo_fecha)).")";
	}else{
		$sql="INSERT INTO ".$tabla." (".implode(",",array_keys($_REQUEST)).") VALUES('".implode("','",array_values($_REQUEST))."')";
	}
	
	phpmkr_query($sql);
	echo('<script>parent.window.location.reload();</script>');
}else{
  
  
	?>
	<div class="form-group" id="tr_fecha_radicacion_entrada">
		<label class="etiqueta_campo" title="">NOMBRE*</label>
		<input type="text" name="nombre" id="nombre" class="required form-control" value="">
	</div>
	<div class="form-group">
			
			<?php 
			autocompletar_categoria();
			if($cod_padre){?>
			<div class="form-group">
				<label class="etiqueta_campo" for="etiqueta"><b>PADRE:</b></label>
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
			<div class="form-group">
				<label class="etiqueta_campo" for="etiqueta"><b>DESCRIPCI&oacute;N:</b></label>
				<div class="controls">
					<textarea class="form-control" id="descripcion" maxlength="255" name="descripcion" placeholder="Descripcion"></textarea>
				</div>
			</div>
			<?php 
			}
			if($tipo){
			?>
			<div class="form-group">
				<label class="etiqueta_campo" for="etiqueta"><b>TIPO:</b></label>
				<input class="form-control" type="text" name="tipo" id="tipo">
				<div id='completar_tipo' class='ac_results'></div>
			</div>
			<?php 
			}
			if($categorias){
			?>
			<div class="form-group">
				<label class="etiqueta_campo" for="etiqueta"><b>CATEGORIA:</b></label>
				<input class="form-control" type="text"  name="categoria" id="categoria">
				<div id='completar_categoria' class='ac_results'></div>
			</div>
			<?php 
			}
			?>
			
			<div class="form-group">
				<label class="etiqueta_campo" for="etiqueta"><b>ESTADO*:</b></label>
				<div class="radio radio-success">
					<input type="radio" value="1" name="estado" id="estado1" class="required" checked="checked">
                    <label for="estado1">Activo</label>
                    <input type="radio" value="0" name="estado" id="estado0">
                    <label for="estado0">Inactivo</label>
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
				
				$html='<label class="etiqueta_campo" for="'.$nombre_campo.'"><b>'.strtoupper(str_replace("_", " ", $nombre_campo)).':</b></label> <select id="'.$nombre_campo.'" name="'.$nombre_campo.'"><option val="">Por favor seleccione...</option>';			
				for($j=0;$j<count($opcion);$j++){
					$opciones=explode("|",$opcion[$j]);
					$eti_opcion=$opciones[0];
					$valor_opcion=$opciones[1];
					$html.='<option value="'.$valor_opcion.'">'.$eti_opcion.'</option>';
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
					
					$html.=' <input type="radio" id="'.$nombre_campo.$j.'" name="'.$nombre_campo.'" value="'.$valor_opcion.'"> '.$eti_opcion;
				}
				$html.='<br/><br/>';
				echo($html);
	
			break;
			
			case 'checkbox':
				$opcion=explode("||",$opcion_campo[1]);
				
				$html='<b>'.strtoupper(str_replace("_", " ", $nombre_campo)).':</b><br/> ';
				for($j=0;$j<count($opcion);$j++){
					$opciones=explode("|",$opcion[$j]);
					$eti_opcion=$opciones[0];
					$valor_opcion=$opciones[1];
					
					$html.=' <input type="checkbox" id="'.$nombre_campo.$j.'" name="'.$nombre_campo.'[]" value="'.$valor_opcion.'"> '.$eti_opcion;
				}
				$html.='<br/><br/>';
				echo($html);
			
			break;
			
			case 'date':
				$html='<div class="control-group">
				<b>'.strtoupper(str_replace("_", " ", $nombre_campo)).':</b><br/>
		            <input id="'.$nombre_campo.'" name="'.$nombre_campo.'" style="width:100px" type="text" value="" placeholder="Inicio">';
	       		echo($html);
				echo(selector_fecha($nombre_campo,"formulario_tareas","Y-m-d",date("m"),date("Y"),"default.css","../../","").'</div>');
				$tipo_fecha[]=$nombre_campo;
					
			break;
			
			case 'text':
				$html='<b>'.strtoupper(str_replace("_", " ", $nombre_campo)).':</b><br/> ';
				$html.='<input type="text" id="'.$nombre_campo.'" name="'.$nombre_campo.'"><br/>';
				echo($html);
			break; 
			
			case 'area':
				$html='<b>'.strtoupper(str_replace("_", " ", $nombre_campo)).' </b><br/> ';
				$html.='<textarea tabindex="4" cols="53" rows="3" class="tiny_avanzado" id="'.$nombre_campo.'" name="'.$nombre_campo.'">&nbsp;</textarea>';
				echo($html);
			break;  
			
			default:
				if($nombre_campo!=''){
					$html='<b>'.strtoupper(str_replace("_", " ", $nombre_campo)).':</b><br/> ';
					$html.='<input required type="text" id="'.$nombre_campo.'" name="'.$nombre_campo.'"><br/>';
					echo($html);
				}
			break;
		}

	}
}






?>			
			
		<div class="control-group">
				<div class="controls">
					<input type='submit' class="btn btn-complete" name="submit" id="submit" value="continuar">
					<input type="hidden" name="tabla" value="<?php echo($_REQUEST['tabla'])?>">
					<input type="hidden" name="guardar" value="1">
					<input type="hidden" name="tipo_fecha" value="<?php echo(implode(",",$tipo_fecha))?>">
				</div>
			</div>
			
		</form>
	</div>
	</div>
	<style>
	label.error {
		font-weight: bold;
		color: red;
	}
	</style>
	<script>
		
	$(document).ready(function(){
		$("#formulario_tareas").validate();
		
		$('.datetimepicker').datetimepicker({			
			language: 'es',
			pick12HourFormat: true,
			pickTime: false
		}).on('changeDate', function(e){
        	$(this).datetimepicker('hide');
		});
		
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
	if($_REQUEST["librerias_cf"]){
		include_once($ruta_db_superior.$_REQUEST["librerias_cf"]);	
	}
?>