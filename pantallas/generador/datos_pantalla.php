<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
if($_REQUEST['idpantalla']){
	$pantalla = busca_filtro_tabla("","pantalla","idpantalla=".$_REQUEST['idpantalla'],"",$conn);
	$pantalla[0]["etiqueta"]=utf8_encode(html_entity_decode($pantalla[0]["etiqueta"]));
	$pantalla[0]["ayuda"]=utf8_encode(html_entity_decode($pantalla[0]["ayuda"]));
	$cod_padre=$pantalla[0]["cod_padre"];
	$clase=$pantalla[0]["clase"];
	$pantalla = json_encode($pantalla);

	if($cod_padre){
		$nombre_cod_padre=busca_filtro_tabla("","pantalla a","a.idpantalla=".$cod_padre,"",$conn);
		$adicional_cod_padre="&seleccionado=".$cod_padre;
	}
	if($clase){
		$nombre_clase=busca_filtro_tabla("","pantalla a","a.idpantalla=".$clase,"",$conn);
		$adicional_clase="&seleccionado=".$clase;
	}
}
?>
<form class="form-horizontal" name="datos_pantalla" id="datos_pantalla">
  <fieldset id="content_form_name">
  </fieldset>
  <div class="control-group">
    <label class="control-label" for="nombre">Nombre*</label>
    <div class="controls">
      <input type="text" name="nombre" id="nombre_pantalla" placeholder="Nombre" value="" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="etiqueta">Etiqueta*</label>
    <div class="controls">
      <input type="text" name="etiqueta" id="etiqueta_pantalla" placeholder="Etiqueta" value="" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="ruta_pantalla">Ruta</label>
    <div class="controls">
      <input type="text" name="ruta_pantalla" id="ruta_pantalla" placeholder="Ruta almacenamiento" value="pantallas">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="ayuda">Ayuda</label>
    <div class="controls">
      <textarea name="ayuda" id="ayuda_pantalla" placeholder="Ayuda"></textarea>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="tipo_pantalla">Tipo de pantalla</label>
    <div class="controls">
      Sistema<input type="radio" name="tipo_pantalla" id="tipo_pantalla_1" value="1" checked="checked">
      Formato<input type="radio" name="tipo_pantalla" id="tipo_pantalla_2" value="2">
      Auxiliar<input type="radio" name="tipo_pantalla" id="tipo_pantalla_3" value="3">
      Clase<input type="radio" name="tipo_pantalla" id="tipo_pantalla_4" value="4">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="pertenece_nucleo">Versionar</label>
    <div class="controls">
      Si<input type="radio" name="versionar" id="versionar_1" value="1">
      No<input type="radio" name="versionar" id="versionar_0" value="0" checked="checked">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="accion_eliminar">Acci&oacute;n al eliminar</label>
    <div class="controls">
      Eliminar<input type="radio" name="accion_eliminar" id="accion_eliminar_1" value="1">
      Inactivar<input type="radio" name="accion_eliminar" id="accion_eliminar_2" value="2" checked="checked">
    </div>
  </div>
  <div id="campos_formato" style="display:none">
  	<div class="control-group">
	    <label class="control-label" for="tipo_pantalla">Aprobacion automatica</label>
	    <div class="controls">
	      Si<input type="radio" name="aprobacion_automatica" id="aprobacion_automatica_1" value="1">
	      No<input type="radio" name="aprobacion_automatica" id="aprobacion_automatica_0" value="0" checked="checked">
	    </div>
	  </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="tiempo">Tiempo autoguardado</label>
    <div class="controls">
      <input id="tiempo_pantalla" type="number" name="tiempo" min="0" max="" step="1" value="6" style="width:50px;">Minutos
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="codigo_padre">Padre</label>
    <div class="controls">
    	<div id="esperando_codigo_padre_pantalla"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
    	<?php echo($nombre_cod_padre[0]["nombre"]);?>
      <div id="treebox_codigo_padre_pantalla" class="arbol_saia"></div>
      <input id="codigo_padre_pantalla" type="hidden" name="cod_padre" value="<?php echo($cod_padre);?>">
      <?php crear_arbol("codigo_padre_pantalla",$ruta_db_superior."pantallas/generador/arbol_pantallas.php?excluido=".$_REQUEST['idpantalla'].$adicional_cod_padre);?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="clase">Heredar funcionalidad de</label>
    <div class="controls">
    	<div id="esperando_clase_pantalla"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
    	<?php echo($nombre_clase[0]["nombre"]);?>
      <div id="treebox_clase_pantalla" class="arbol_saia"></div>
      <input id="clase_pantalla" type="hidden" name="clase" value="<?php echo($clase);?>">
      <?php crear_arbol("clase_pantalla",$ruta_db_superior."pantallas/generador/arbol_pantallas.php?tipo_pantalla=4&excluido=".$_REQUEST['idpantalla'].$adicional_clase);?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="librerias_clase">Importar funciones a la clase desde</label>
    <div class="controls">
      <input type="text" name="librerias" id="librerias_pantalla" placeholder="Archivo con funciones de la clase" value="">
    </div>
  </div>
  <div class="form-actions">
  	<input type="hidden" name="ruta_almacenamiento" id="ruta_almacenamiento_pantalla" value="{*fecha_ano*}/{*fecha_mes*}/{*idpantalla*}">
  	<input type="hidden" name="prefijo" id="prefijo_pantalla" value="">
  	<input type="hidden" name="idfuncionario" id="idfuncionario" value="<?php echo(usuario_actual("idfuncionario")); ?>">
  	<input type="hidden" name="banderas_pantalla" id="banderas" value="">
  	<input type="hidden" name="idpantalla" id="idpantalla" value="">
    <button type="button" name="adicionar" class="btn btn-primary" id="enviar_datos_pantalla" value="adicionar_datos_pantalla">Aceptar</button>
    <button type="reset" name="cancelar" class="btn" id="cancelar_formulario_saia" value="cancelar">Cancel</button>
    <button type="button" name="eliminar" class="btn btn-danger kenlace_saia_propio" id="eliminar_formulario_saia" enlace="../pantallas/generador/eliminar_pantalla.php?idpantalla=<?php echo($_REQUEST['idpantalla']);?>" titulo="Eliminar pantalla" eliminar_hijos="0" value="eliminar">Eliminar</button>
    <div class="pull-right" id="cargando_enviar"></div>
  </div>
</form>
<?php
echo(librerias_jquery("1.7"));
echo(librerias_notificaciones());
echo(librerias_kaiten());
echo(librerias_acciones_kaiten());
?>
<script type="text/javascript">
$("document").ready(function(){
  $("input:radio[name='tipo_pantalla']").change(function(){
    //1=Sistema;2=formato;3=Auxiliar;4=clase
    if($(this).val()==2){
    	$("#campos_formato").show();
    }
    else{
    	$("#campos_formato").hide();
    }
    if($(this).val()==1 || $(this).val()==2 || $(this).val()==3){
      alert("Pendiente mostrar todas las tabs");
    }
    else if($(this).val()==4){
      alert("Pendiente ocultar los tabs de mostrar y listar");
    }
  });
	var formulario = $("#datos_pantalla");
	$("#enviar_datos_pantalla").click(function(){
		if(formulario.valid()){
			$('#cargando_enviar').html("Procesando <i id='icon-cargando'>&nbsp;</i>");
			var buttonAcep = $(this);
			buttonAcep.attr('disabled', 'disabled');
			parsear_items();
			$.ajax({
        type:'POST',
        url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias_pantalla.php",
        data: "ejecutar_datos_pantalla="+buttonAcep.attr('value')+"&tipo_retorno=1&rand="+Math.round(Math.random()*100000)+'&'+formulario.serialize(),
        success: function(html){
          if(html){
            var objeto=jQuery.parseJSON(html);
            if(objeto.exito){
              $('#cargando_enviar').html("Terminado ...");
              buttonAcep.attr('value','editar_datos_pantalla');
              buttonAcep.removeAttr('disabled');
              $('#idpantalla').attr('value',objeto.idpantalla);
              var tipo_pantallas=$("input:radio[name='tipo_pantalla']:checked").val();
              if(tipo_pantallas==3){
                $(".check_genera").prop("checked",false);
                $("#generar_version_pantalla").prev().children(":checkbox").prop("checked",true);
                $("#generar_pantalla_libreria").prev().children(":checkbox").prop("checked",true);
                $("#generar_clase").prev().children(":checkbox").prop("checked",true);
                $("#generar_adicionar").prev().children(":checkbox").prop("checked",true);
              }
              else if(tipo_pantallas==4){
                $(".check_genera").prop("checked",false);
                $("#generar_version_pantalla").prev().children(":checkbox").prop("checked",true);
                $("#generar_clase").prev().children(":checkbox").prop("checked",true);
               }

              else{
                //Para el tipo auxiliar se debe quitar la opcion de generar tabla
                $(".check_genera").prop("checked",true);
              }
              notificacion_saia('El registro se a insertado exitosamente','success','topCenter',3000);
              $('#cargando_enviar').html("");
              $('#tabs_formulario a[href="#formulario-tab"]').tab('show');
    					$('.nav li').removeClass('disabled');
    					$("#contenidos_componentes").show();
            }else{
            	notificacion_saia(objeto.error,'error','topCenter',3000);
            	buttonAcep.removeAttr('disabled');
            }
        	}
        }
    	});
		}
		else{
    	notificacion_saia('Debe diligenciar los campos obligatorios','warning','topCenter',3000);
			$(".error").first().focus();
		}
	});
	var pantalla=jQuery.parseJSON('<?php echo($pantalla);?>');
	if(pantalla!==null && pantalla.numcampos){
    $('#nombre_pantalla').attr('value',pantalla[0].nombre);
    //$('#tabla_pantalla').attr('value',pantalla[0].tabla);
    $('#librerias_pantalla').attr('value',pantalla[0].librerias);
    $('#etiqueta_pantalla').attr('value',pantalla[0].etiqueta);
    $('#ruta_pantalla').attr('value',pantalla[0].ruta_pantalla);
    $('#ayuda_pantalla').attr('value',pantalla[0].ayuda);
    $('#tiempo_pantalla').attr('value',pantalla[0].tiempo_autoguardado);
    $('#banderas_pantalla').attr('value',pantalla[0].banderas);
    $('#prefijo_pantalla').attr('value',pantalla[0].prefijo);
    $('#ruta_almacenamiento_pantalla').attr('value',pantalla[0].ruta_almacenamiento);
    $('#idpantalla').attr('value',pantalla[0].idpantalla);
    $('#tipo_pantalla_'+pantalla[0].tipo_pantalla).attr('checked',"checked");
    $('#versionar_'+pantalla[0].versionar).attr('checked',"checked");
    $('#accion_eliminar_'+pantalla[0].accion_eliminar).attr('checked',"checked");
    if(pantalla[0].tipo_pantalla==2){
    	$("#campos_formato").show();
    }
    $('#aprobacion_automatica_'+pantalla[0].aprobacion_automatica).attr('checked',"checked");
    $('#enviar_datos_pantalla').attr('value','editar_datos_pantalla');
  	$('#tabs_formulario a[href="#formulario-tab"]').tab('show');
  	$('.nav li').removeClass('disabled');
	}
	else{
		$('.nav li').addClass('disabled');
		$("#contenidos_componentes").hide();
		$('#tabs_formulario li:first').removeClass('disabled');
		$('#tabs_formulario a[href="#datos_formulario-tab"]').tab('show');
	}
});
function parsear_items(){
	var tipo=$("input:radio[name='tipo_pantalla']:checked").val();
	if(tipo==2){//Tipo formato
		var nombre_pantalla=$("#nombre_pantalla").val();
		if(nombre_pantalla.indexOf("ft_")=="-1"){
			$("#nombre_pantalla").val("ft_"+nombre_pantalla);
		}
		$("#prefijo_pantalla").val("ft_");
	}
	else{
		$("#prefijo_pantalla").val("");
	}
}
</script>
<?php
function crear_arbol($nombre,$url){
	global $ruta_db_superior;
	?>
<script>
$("document").ready(function(){
	var browserType;
	if (document.layers) {browserType = "nn4"}
  if (document.all) {browserType = "ie"}
  if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}

  tree_<?php echo($nombre);?>=new dhtmlXTreeObject("treebox_<?php echo($nombre);?>","100%","",0);
  tree_<?php echo($nombre);?>.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
  tree_<?php echo($nombre);?>.enableTreeImages(false);
  tree_<?php echo($nombre);?>.enableTextSigns(true);
  tree_<?php echo($nombre);?>.enableIEImageFix(true);
	tree_<?php echo($nombre);?>.setOnLoadingStart(cargando_arbol_<?php echo($nombre);?>);
	tree_<?php echo($nombre);?>.setOnLoadingEnd(fin_cargando_arbol_<?php echo($nombre);?>);

  tree_<?php echo($nombre);?>.enableCheckBoxes(1);
	tree_<?php echo($nombre);?>.enableRadioButtons(true);
  /*tree_<?php echo($nombre);?>.enableThreeStateCheckboxes(true);*/
  tree_<?php echo($nombre);?>.setOnCheckHandler(onNodeSelect_<?php echo($nombre);?>);

  tree_<?php echo($nombre);?>.loadXML("<?php echo($url);?>");

  function fin_cargando_arbol_<?php echo($nombre);?>(){
		if (browserType == "gecko")
			document.poppedLayer = eval('document.getElementById("esperando_<?php echo($nombre);?>")')
		else if (browserType == "ie")
			document.poppedLayer = eval('document.getElementById("esperando_<?php echo($nombre);?>")');
		else
			document.poppedLayer = eval('document.layers["esperando_<?php echo($nombre);?>"]');
		document.poppedLayer.style.display = "none";
	}
	function cargando_arbol_<?php echo($nombre);?>(){
		if (browserType=="gecko")
			document.poppedLayer=eval('document.getElementById("esperando_<?php echo($nombre);?>")');
		else if (browserType=="ie")
			document.poppedLayer=eval('document.getElementById("esperando_<?php echo($nombre);?>")');
		else
			document.poppedLayer=eval('document.layers["esperando_<?php echo($nombre);?>"]');
		document.poppedLayer.style.display="";
	}
	function onNodeSelect_<?php echo($nombre);?>(nodeId){
		var valor_destino=document.getElementById("<?php echo($nombre);?>");
		if(tree_<?php echo($nombre);?>.isItemChecked(nodeId)){
			if(valor_destino.value!=="")
				tree_<?php echo($nombre);?>.setCheck(valor_destino.value,false);
			if(nodeId.indexOf("_")!=-1)
				nodeId=nodeId.substr(0,nodeId.indexOf("_"));
			valor_destino.value=nodeId;
		}else{
			valor_destino.value="";
		}
	}
});
</script>
	<?php
}
?>
