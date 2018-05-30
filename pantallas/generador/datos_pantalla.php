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
if($_REQUEST['idformato']){
	$formato = busca_filtro_tabla("","formato","idformato=".$_REQUEST['idformato'],"",$conn);
	$formato=procesar_cadena_json($formato,array("cuerpo","ayuda","etiqueta"));
	$cod_padre=$formato[0]["cod_padre"];
	$categoria=$formato[0]["fk_categoria_formato"];
	if($formato[0]["tiempo_autoguardado"]>3000){
		$formato[0]["tiempo_autoguardado"]=$formato[0]["tiempo_autoguardado"]/60000;
	}
	$formato = json_encode($formato);
	if($cod_padre){
		$nombre_cod_padre=busca_filtro_tabla("","formato a","a.idformato=".$cod_padre,"",$conn);
		$adicional_cod_padre="&seleccionado=".$cod_padre;
	}
	if($categoria){
		$nombre_categoria=busca_filtro_tabla("","categoria_formato a","a.idcategoria_formato=".$categoria,"",$conn);
		$adicional_categoria="&seleccionado=".$categoria;
	}
}
/**
 * Esta funcion puede servir para 
 */
function procesar_cadena_json($resultado,$lista_valores){
	for($i=0;$i<$resultado["numcampos"];$i++){
		$busqueda=$resultado[$i];
		foreach($busqueda AS $key=>$valor){
			if(is_numeric($key)){
				unset($busqueda[$key]);
			}
			else if(in_array($key,$lista_valores)){
				$busqueda[$key]=str_replace("\n","",$busqueda[$key]);
				$busqueda[$key]=str_replace("\r","",$busqueda[$key]);
				$busqueda[$key]=codifica_encabezado($busqueda[$key]);
				$busqueda[$key]=addslashes($busqueda[$key]);
			}
		}
		$resultado[$i]=$busqueda;
	}
return($resultado);	
}
?>
<style type="text/css">
.containerTableStyle {overflow:hidden;}
</style>
<form class="form-horizontal" name="datos_formato" id="datos_formato">
  <fieldset id="content_form_name">
  </fieldset>
  <div class="control-group">
    <label class="control-label" for="nombre">Nombre*</label>
    <div class="controls">
      <input type="text" name="nombre" id="nombre_formato" placeholder="Nombre" value="" required  <?php if($_REQUEST["idformato"]) echo("disabled");?>>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="etiqueta">Etiqueta*</label>
    <div class="controls">
      <input type="text" name="etiqueta" id="etiqueta_formato" placeholder="Etiqueta" value="" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="codigo_padre">Padre</label>
    <div class="controls">
    	<div id="esperando_codigo_padre_formato"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
    	<?php echo($nombre_cod_padre[0]["nombre"]);?>
      <div id="treebox_codigo_padre_formato" class="arbol_saia"></div>
      <input id="codigo_padre_formato" type="hidden" name="cod_padre" value="<?php echo($cod_padre);?>">
      <?php crear_arbol("codigo_padre_formato",$ruta_db_superior."test_serie.php?tabla=formato&excluido=".$_REQUEST['idformato'].$adicional_cod_padre);?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="serie_idserie">Serie documental</label>
    <div class="controls">
    	<div id="esperando_serie_idserie"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
    	<?php echo($serie[0]["nombre"]);?>
      <div id="treebox_serie_idserie" class="arbol_saia"></div>
      <input id="serie_idserie" type="hidden" name="serie_idserie" value="<?php echo($serie_idserie);?>">
      <?php crear_arbol("serie_idserie",$ruta_db_superior."test_serie.php?tabla=serie");?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="contador">Contador</label>
    <div class="controls">
      <select name="contador_idcontador" id="contador_idcontador">
      	<option value="">Crear contador</option>
      	<?php 
      	$contadores=busca_filtro_tabla("","contador","nombre<>''","nombre",$conn);
      	for($i=0;$i<$contadores["numcampos"];$i++){
      		echo('<option value="'.$contadores[$i]["idcontador"].'">'.$contadores[$i]["nombre"].'</option>');
      	}
      	?>
      </select> <span id="reinicio_contador"> </span><input type="checkbox" name="reiniciar_contador" id="reiniciar_contador" value="1">Reiniciar contador con el cambio de a&ntilde;o</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="banderas">Banderas del formato</label>
    <div class="controls">
      <input type="checkbox" name="item" id="item" value="1">Item 
      <input type="checkbox" name="tipo_edicion" id="tipo_edicion" value="1">Edicion Continua 
      <input type="checkbox" name="banderas[]" id="banderas" value="e">Aprobacion Automatica 
      <input type="checkbox" name="mostrar" id="mostrar" value="1" checked>Mostrar
      <input type="checkbox" name="paginar" id="paginar" value="1" checked>Paginar al mostrar 
      <input type="checkbox" name="banderas[]"	id="banderas" value="r">Tomar el asunto del padre al responder
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="font_size">Tama&ntilde;o de Letra</label>
    <div class="controls">
      <select name="font_size" id="font_size">
      	<?php 
      	for($i=7;$i<31;$i++){
      		echo('<option value="'.$i.'"');
      		if($i==11)
      			echo(' selected="selected"');
      		echo('>'.$i.'</option>');
      	}
      	?>
      </select>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="margenes">Margenes</label>
    <div class="controls">
      Izquierda<select class="input-mini" name="mizq" id="mizq">
      	<?php 
      	for($i=0;$i<11;$i++){
      		echo('<option value="'.($i*5).'"');
      		if(($i*5)==15)
      			echo(' selected="selected"');
      		echo('>'.($i*5).'</option>');
      	}
      	?>
      </select>
      Derecha<select class="input-mini" name="mder" id="mder">
      	<?php 
      	for($i=0;$i<11;$i++){
      		echo('<option value="'.($i*5).'"');
      		if(($i*5)==20)
      			echo(' selected="selected"');
      		echo('>'.($i*5).'</option>');
      	}
      	?>
      </select>
      Superior<select class="input-mini" name="msup" id="msup">
      	<?php 
      	for($i=0;$i<11;$i++){
      		echo('<option value="'.($i*5).'"');
      		if(($i*5)==15)
      			echo(' selected="selected"');
      		echo('>'.($i*5).'</option>');
      	}
      	?>
      </select>
      Inferior<select class="input-mini" name="minf" id="minf">
      	<?php 
      	for($i=0;$i<11;$i++){
      		echo('<option value="'.($i*5).'"');
      		if(($i*5)==30)
      			echo(' selected="selected"');
      		echo('>'.($i*5).'</option>');
      	}
      	?>
      </select>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="orientacion">Orientaci&oacute;n</label>
    <div class="controls">
      Horizontal<input type="radio" name="orientacion" id="orientacion_1" value="1">
      Vertical<input type="radio" name="orientacion" id="orientacion_0" value="0" checked="checked">
    </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="papel">Tama&ntilde;o papel</label>
    <div class="controls">
      <select name="papel" id="papel">
      	<option value="A4">A4</option>
      	<option value="A5">Media Carta</option>
      	<option value="letter">Carta</option>
      	<option value="legal">Oficio</option>
      </select>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="mostrar_pdf">Mostrar PDF</label>
    <div class="controls">
      HTML<input type="radio" name="mostrar_pdf" id="mostrar_pdf_1" value="1">
      PDF<input type="radio" name="mostrar_pdf" id="mostrar_pdf_0" value="0" checked="checked">
      PDF Word<input type="radio" name="mostrar_pdf" id="mostrar_pdf_2" value="2">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="exportar">M&eacute;todo exportar</label>
    <div class="controls">
      HTML2PS<input type="radio" name="exportar" id="exportar_1" value="html2ps">
      TCPDF<input type="radio" name="exportar" id="exportar_0" value="tcpdf" checked="checked">
      mPDF<input type="radio" name="exportar" id="exportar_2" value="mpdf">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="pertenece_nucleo">Formato Pertenece a n&uacute;cleo</label>
    <div class="controls">
      Si<input type="radio" name="pertenece_nucleo" id="pertenece_nucleo_1" value="1">
      No<input type="radio" name="pertenece_nucleo" id="pertenece_nucleo_0" value="0" checked="checked">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="tiempo_autoguardado">Tiempo autoguardado</label>
    <div class="controls">
      <input id="tiempo_formato" type="number" name="tiempo_autoguardado" min="0" max="3600" step="1" value="6" style="width:50px;">Minutos
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="fk_categoria_formato">Categoria del formato</label>
    <div class="controls">
    	<div id="esperando_fk_categoria_formato"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
    	<?php echo($categoria_formato[0]["nombre"]);?>
      <div id="treebox_fk_categoria_formato" class="arbol_saia"></div>
      <input id="fk_categoria_formato" type="hidden" name="fk_categoria_formato" value="<?php echo($fk_categoria_formato);?>">
      <?php crear_arbol("fk_categoria_formato",$ruta_db_superior."test_categoria.php?tipo=1");?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="funcion_predeterminada">Funciones predeterminadas</label>
    <div class="controls">
      Varios responsables<input type="checkbox" name="funcion_predeterminada[]" id="funcion_predeterminada_1" value="1">
      Digitalizaci&oacute;n<input type="checkbox" name="funcion_predeterminada[]" id="funcion_predeterminada_2" value="2">
    </div>
  </div>
  <div class="form-actions">
  	<input type="hidden" name="ruta_almacenamiento" id="ruta_almacenamiento_formato" value="{*fecha_ano*}/{*fecha_mes*}/{*idformato*}">
  	<input type="hidden" name="prefijo" id="prefijo_formato" value="">
  	<input type="hidden" name="idfuncionario" id="idfuncionario" value="<?php echo(usuario_actual("idfuncionario")); ?>">
  	<input type="hidden" name="banderas_formato" id="banderas" value="">
  	<input type="hidden" name="idformato" id="idformato" value="">
    <button type="button" name="adicionar" class="btn btn-primary" id="enviar_datos_formato" value="adicionar_datos_formato">Aceptar</button>
    <!-- button type="reset" name="cancelar" class="btn" id="cancelar_formulario_saia" value="cancelar">Cancel</button-->
    <?php if($_REQUEST["idformato"]){?>
    <!-- button type="button" name="eliminar" class="btn btn-danger kenlace_saia_propio" id="eliminar_formulario_saia" enlace="../formatos/generador/eliminar_formato.php?idformato=<?php echo($_REQUEST['idformato']);?>" titulo="Eliminar formato" eliminar_hijos="0" value="eliminar">Eliminar</button-->
    <?php } ?>
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
	$("#nombre_formato").blur(function(){
		$.ajax({
		  type:'POST',
		  url: "<?php echo($ruta_db_superior);?>pantallas/lib/llamado_ajax.php",
		  async:false,
		  data: "librerias=pantallas/generador/librerias_formato.php&funcion=verificar_nombre_formato&parametros="+$("#nombre_formato").val()+"&rand="+Math.round(Math.random()*100000),
		  success: function(html){
		    if(html){
		      var objeto=jQuery.parseJSON(html);
		      if(objeto.exito){
		    	  notificacion_saia(objeto.mensaje,'success','topCenter',3000);
		      }
		      else{
		    	  notificacion_saia(objeto.mensaje,'error','topCenter',3000);
		    	  $("#nombre_formato").focus();
		      }
		  	}
		  }
		});
	});
	var formulario = $("#datos_formato");
	var formato=jQuery.parseJSON('<?php echo($formato);?>');
	$("#enviar_datos_formato").click(function(){
		if(formulario.valid()){
			$('#cargando_enviar').html("Procesando <i id='icon-cargando'>&nbsp;</i>");
			var buttonAcep = $(this);
			//buttonAcep.attr('disabled', 'disabled');
			parsear_items();
			$.ajax({
        type:'POST',
        url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias_pantalla.php",
        data: "ejecutar_datos_pantalla="+buttonAcep.attr('value')+"&tipo_retorno=1&rand="+Math.round(Math.random()*100000)+'&'+formulario.serialize()+"&nombre="+formato[0].nombre,
        success: function(html){
          if(html){
            var objeto=jQuery.parseJSON(html);
            if(objeto.exito){
              $('#cargando_enviar').html("Terminado ...");
              var ruta_iframe=$(".k-focus",window.parent.document).find("iframe").attr("src");
              ruta_iframe=ruta_iframe.substr(0,ruta_iframe.indexOf("generador_pantalla"));
              var data_iframe= { url:ruta_iframe+"generador_pantalla.php?idformato="+objeto.idformato,  kTitle:"Formato "+$("#etiqueta_formato").val()};
              var kaiten_actual=obtener_panel_kaiten();
              parent.Kaiten.reload(kaiten_actual,data_iframe);
              notificacion_saia('El registro se a insertado exitosamente','success','topCenter',3000);
         
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
	if(formato!==null && formato.numcampos){
    $('#nombre_formato').attr('value',formato[0].nombre);
    //$('#tabla_formato').attr('value',formato[0].tabla);
    $('#librerias_formato').attr('value',formato[0].librerias);
    $('#etiqueta_formato').attr('value',formato[0].etiqueta);
    $('#ruta_formato').attr('value',formato[0].ruta_formato);
    $('#ayuda_formato').attr('value',formato[0].ayuda);
    $('#tiempo_formato').attr('value',formato[0].tiempo_autoguardado);
    $('#banderas_formato').attr('value',formato[0].banderas);
    $('#prefijo_formato').attr('value',formato[0].prefijo);
    $('#ruta_almacenamiento_formato').attr('value',formato[0].ruta_almacenamiento);
    $('#idformato').attr('value',formato[0].idformato);
    $('#tipo_formato_'+formato[0].tipo_formato).attr('checked',"checked");
    $('#versionar_'+formato[0].versionar).attr('checked',"checked");
    $('#accion_eliminar_'+formato[0].accion_eliminar).attr('checked',"checked");
    if(formato[0].tipo_formato==2){
    	$("#campos_formato").show();
    }
    $('#aprobacion_automatica_'+formato[0].aprobacion_automatica).attr('checked',"checked");
    $('#enviar_datos_formato').attr('value','editar_datos_formato');
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
	var tipo=$("input:radio[name='tipo_formato']:checked").val();
	if(tipo==2){//Tipo formato
		var nombre_formato=$("#nombre_formato").val();
		if(nombre_formato.indexOf("ft_")=="-1"){
			$("#nombre_formato").val("ft_"+nombre_formato);
		}
		$("#prefijo_formato").val("ft_");
	}
	else{
		$("#prefijo_formato").val("");
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
