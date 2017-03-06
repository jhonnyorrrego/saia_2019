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
	$sql_upd="UPDATE listado_tareas SET nombre_lista='".($_REQUEST['nombre_lista'])."',descripcion_lista='".($_REQUEST['descripcion'])."',cliente_proyecto='".$_REQUEST['cliente_proyecto']."',macro_proceso='".$_REQUEST["macro_proceso"]."' WHERE idlistado_tareas=".$_REQUEST['idlistado_tareas'];
	phpmkr_query($sql_upd);
	$idbin = phpmkr_insert_id();
	alerta("Listado Actualizado!");
	redirecciona("detalles_listado_tareas.php?idlistado_tareas=".$_REQUEST['idlistado_tareas']);
}else{
  echo(librerias_jquery("1.7"));
  echo(librerias_arboles());
  echo(librerias_bootstrap());
  echo(librerias_datepicker_bootstrap());
	$listado=busca_filtro_tabla("","listado_tareas","idlistado_tareas=".$_REQUEST["idlistado_tareas"],"",$conn);
	?>
	<div class="container">
		<div class="control-group" nombre="etiqueta">
			<legend>Listado de Tareas</legend>
		</div>
		<form id="formulario_tareas" class="form-horizontal">
			<div class="control-group">
				<label class="control-label" for="etiqueta">Nombre de la lista*:</label>
				<div class="controls">
					<input type="text" class="required" name="nombre_lista" id="nombre_lista" value="<?php echo $listado[0]["nombre_lista"];?>" placeholder="Nombre de la Lista">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label" for="etiqueta">Descripci&oacute;n:</label>
				<div class="controls">
					<textarea id="descripcion" name="descripcion" placeholder="Descripcion"><?php echo $listado[0]["descripcion_lista"];?></textarea>
				</div>
			</div>
			
			
			<?php
			
		  $perfil_usuario_actual=usuario_actual('perfil');
			
		  $busca_perfil_admin=busca_filtro_tabla("idperfil","perfil","lower(nombre)='admin_interno'","",$conn);
			
		  if($busca_perfil_admin[0]['idperfil']==$perfil_usuario_actual || usuario_actual('login')=='cerok'){
			?>			
			<div class="control-group">
				<label class="control-label" for="etiqueta">Cliente:</label>
				<div class="controls">
					<input type="text" name="cliente_proyecto" id="cliente_proyecto" value="<?php echo $listado[0]["cliente_proyecto"];?>"/>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label" for="etiqueta">Macroproceso/Proceso:</label>
				<div class="controls">
					<input type="text" name="macro_proceso" id="macro_proceso" value="<?php echo $listado[0]["macro_proceso"];?>" />
				</div>
			</div>
			
			<?php
		  	}
			?>			
			
						
			<div class="control-group">
				<div class="controls">
					<input type='submit' class="btn btn-primary btn-mini" name="submit" id="submit" value="Continuar">
					<input type="hidden" name="iddoc" value="<?php echo($_REQUEST['iddoc'])?>">
					<input type="hidden" name="guardar" value="1">
					<input type="hidden" name="idlistado_tareas" value="<?php echo($_REQUEST['idlistado_tareas']);?>">
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
	.form-horizontal .control-label{
		width: 40%;
	}
	/*---------------- AUTOCOMPLETAR---------------------*/	
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
	/*---------------- TERMINA AUTOCOMPLETAR---------------------*/
	</style>
	<script>
	$(document).ready(function(){
		$("#formulario_tareas").validate();
		//---------------- AUTOCOMPLETAR---------------------//	
		var delay = (function(){
		  var timer = 0;
		  return function(callback, ms){
		    clearTimeout (timer);
		    timer = setTimeout(callback, ms);
		  };
		})();
	
	 $("#cliente_proyecto").hide();
		$("#cliente_proyecto").parent().append("<input type='text' id='buscar_radicado' size='50' name='buscar_radicado'><div id='ul_completar' class='ac_results'></div>");
		$("#buscar_radicado").keyup(function (){
		  delay(function(){
	      var valor=$("#buscar_radicado").val();
	      if(valor==0 || valor==""){
	        alert("Ingrese nombre del Cliente");
	      }else{
	        $("#ul_completar").empty().load( "autocompletar_procesos.php", { cliente:valor,opt:1});
	      }
	    }, 500 );
		});
		
	$("#macro_proceso").hide();
	$("#macro_proceso").parent().append("<input type='text' id='buscar_macro' size='50' name='buscar_macro'><div id='ul_completar_macro' class='ac_results'></div>");
	$("#buscar_macro").keyup(function (){
	  delay(function(){
      var valor=$("#buscar_macro").val();
      if(valor==0 || valor==""){
        alert("Ingrese nombre del macroproceso-proceso");
      }else{
        $("#ul_completar_macro").empty().load( "autocompletar_procesos.php", { nombre_macro:valor,opt:4});
      }
    }, 500 );
	});
		
		var seleccionados=$("#cliente_proyecto").val().split(",");
		$("#cliente_proyecto").val("");
		for(var i=0;i<seleccionados.length;i++){
		  $.ajax({
		    type:'POST',
		    async: false,
		    url: "autocompletar_procesos.php",
		    data: {iddoc:seleccionados[i],opt:3},
		    success: function(retorno){
		      cargar_datos(seleccionados[i],retorno);
		    } 
		  });
		}
		
		var seleccionados_macro=$("#macro_proceso").val().split(",");
		$("#macro_proceso").val("");
		for(var i=0;i<seleccionados_macro.length;i++){
		  $.ajax({
		    type:'POST',
		    async: false,
		    url: "autocompletar_procesos.php",
		    data: {idserie:seleccionados_macro[i],opt:5},
		    success: function(retorno){
		      cargar_datos_macro(seleccionados_macro[i],retorno);
		    } 
		  });
		}
		//---------------- TERMINA AUTOCOMPLETAR---------------------//
	});
	
	//---------------- AUTOCOMPLETAR---------------------//		
	function cargar_datos(iddoc,descripcion){
		$("#ul_completar").empty();
    if(!$("#informacion_buscar_radicado").length){
      $("#buscar_radicado").after("<br/><table style='font-size:10px;'  id='informacion_buscar_radicado'></table>");
    }
		if(iddoc!=0){
			$("#informacion_buscar_radicado").append("<tr id='fila_"+iddoc+"' opt='"+iddoc+"'><td>"+descripcion+"</td><td><img style='cursor:pointer' src='<?php echo($ruta_db_superior); ?>imagenes/eliminar_nota.gif' registro='"+iddoc+"' onclick='eliminar_asociado("+iddoc+");'></td></tr>");
			if($("#cliente_proyecto").val()!=''){
				$("#cliente_proyecto").val($("#cliente_proyecto").val()+","+iddoc);
			}else{
				$("#cliente_proyecto").val(iddoc);
			}
		}
    $("#buscar_radicado").val("");
  }
  
	function eliminar_asociado(iddoc){
		$("#informacion_buscar_radicado #fila_"+iddoc).remove();
		var datos=$("#cliente_proyecto").val().split(",");
		var cantidad=datos.length;
		var nuevos_datos=new Array();
		var a=0;
		for(var i=0;i<cantidad;i++){
			if(iddoc!=datos[i]){
				nuevos_datos[a]=datos[i];
				a++;
			}
		}
		var datos_guardar=nuevos_datos.join(",");
		$("#cliente_proyecto").val(datos_guardar);
	}	
	
	function cargar_datos_macro(iddoc,descripcion){
		$("#ul_completar_macro").empty();
    if(!$("#informacion_buscar_radicado_macro").length){
      $("#buscar_macro").after("<br/><table style='font-size:10px;'  id='informacion_buscar_radicado_macro'></table>");
    }
		if(iddoc!=0){
			$("#informacion_buscar_radicado_macro").append("<tr id='fila_"+iddoc+"' opt='"+iddoc+"'><td>"+descripcion+"</td><td><img style='cursor:pointer' src='<?php echo($ruta_db_superior); ?>imagenes/eliminar_nota.gif' registro='"+iddoc+"' onclick='eliminar_asociado_macro("+iddoc+");'></td></tr>");
			if($("#macro_proceso").val()!=''){
				$("#macro_proceso").val($("#macro_proceso").val()+","+iddoc);
			}else{
				$("#macro_proceso").val(iddoc);
			}
		}
    $("#buscar_macro").val("");
  }
  
	function eliminar_asociado_macro(iddoc){
		$("#informacion_buscar_radicado_macro #fila_"+iddoc).remove();
		var datos=$("#macro_proceso").val().split(",");
		var cantidad=datos.length;
		var nuevos_datos=new Array();
		var a=0;
		for(var i=0;i<cantidad;i++){
			if(iddoc!=datos[i]){
				nuevos_datos[a]=datos[i];
				a++;
			}
		}
		var datos_guardar=nuevos_datos.join(",");
		$("#macro_proceso").val(datos_guardar);
	}
	//---------------- TERMINA AUTOCOMPLETAR---------------------//
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


<?php

if(@$_REQUEST['idlistado_tareas']){

?>
<script>
  $(".documento_actual",parent.document).removeClass("alert-info");
  $(".documento_actual",parent.document).removeClass("documento_actual");
  $("#resultado_pantalla_<?php echo($_REQUEST['idlistado_tareas']);?>",parent.document).children().addClass("documento_actual").addClass("alert-info");
  
</script>
<?php
	
}


?>
