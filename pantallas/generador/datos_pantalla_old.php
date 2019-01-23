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
include_once ($ruta_db_superior . "pantallas/lib/librerias_componentes.php");

$serie_idserie = "";
if($_REQUEST['idformato']) {
	$formato = busca_filtro_tabla("","formato","idformato=".$_REQUEST['idformato'],"",$conn);
	$formato = procesar_cadena_json($formato,array("cuerpo","ayuda","etiqueta"));
	$cod_padre=$formato[0]["cod_padre"];
	$serie_idserie = $formato[0]["serie_idserie"];

	$cod_proceso_pertenece=$formato[0]["proceso_pertenece"];
	$categoria=$formato[0]["fk_categoria_formato"];
	if($formato[0]["tiempo_autoguardado"]>3000){
		$formato[0]["tiempo_autoguardado"]=$formato[0]["tiempo_autoguardado"]/60000;
	}
	$documentacion_formato =$formato[0]["documentacion"];
	$anexos_formato = busca_filtro_tabla("","formato_previo","idformato=".$_REQUEST['idformato']." and idformato_previo=".$documentacion_formato,"",$conn);

	if($anexos_formato["numcampos"]){
		$ruta = $anexos_formato[0]["ruta"];
	}
	$formato = json_encode($formato);
	if($cod_proceso_pertenece){
		$adicional_cod_proceso="&seleccionado=".$cod_proceso_pertenece;
	}
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
	for($i=0; $i<$resultado["numcampos"]; $i++) {
		$busqueda=$resultado[$i];
		foreach($busqueda AS $key=>$valor) {
			if(is_numeric($key)) {
				unset($busqueda[$key]);
			}	else if(in_array($key, $lista_valores)) {
				$busqueda[$key]=str_replace("\n","",$busqueda[$key]);
				$busqueda[$key]=str_replace("\r","",$busqueda[$key]);
				$busqueda[$key]=html_entity_decode($busqueda[$key]);
				$busqueda[$key]=addslashes($busqueda[$key]);
			}
		}
		$resultado[$i]=$busqueda;
	}
return($resultado);
}
?>
<style type="text/css">
.arbol_saia>.containerTableStyle {overflow:hidden;}
</style>
<form class="form-horizontal" name="datos_formato" id="datos_formato">
  <fieldset id="content_form_name">
  </fieldset>
  <?php
  if($_SESSION["LOGIN" . LLAVE_SAIA]=="cerok"){
  ?>
	  <div class="control-group">
	    <label class="control-label" for="nombre">Nombre*</label>
	    <div class="controls">
	      <input type="text" name="nombre_formato" id="nombre_formato" placeholder="Nombre" value="" required  <?php if($_REQUEST["idformato"]) echo("disabled");?>>
	    </div>
	  </div>
	 <?php
  }
  ?>
  <div class="control-group">
    <label class="control-label" for="etiqueta">Nombe del formato*</label>
    <div class="controls">
      <input type="text" name="etiqueta" id="etiqueta_formato" placeholder="Nombre" value="" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="descripcion">Descripci&oacute;n del formato*</label>
    <div class="controls">
      <input type="text" name="descripcion_formato" id="descripcion_formato" placeholder="Descripci&oacute;n" value="" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="proceso">Proceso al que pertenece*</label>
    <div class="controls">
      <div id="esperando_proceso_pertenece"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
      <div id="treebox_proceso_pertenece" class="arbol_saia"></div>
      <input id="proceso_pertenece" type="hidden" name="proceso_pertenece" required value="<?php echo($cod_proceso_pertenece);?>">
      <?php crear_arbol("proceso_pertenece",$ruta_db_superior."test_serie.php?estado=1&tabla=cf_procesos_formato".$adicional_cod_proceso);?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="version">Versi&oacute;n*</label>
    <div class="controls">
      <input type="text" name="version" id="version" placeholder="Versi&oacute;n" value="" required>
    </div>
  </div>
  <!--<div class="control-group">
    <label class="control-label" for="documentacion">Documentaci&oacute;n del formato</label>
    <div class="controls">
      <input type="hidden" name="anexos" id="anexos">
      <div id="dz_campo" class="saia_dz dz-clickable dropzone " data-nombre-campo="anexos" data-extensiones=".jpg, .png, .pdf" data-multiple=""><div class="dz-message"><span>Arrastra el anexo hasta aquí. <br> O si prefieres...<br><br> <span class="boton_upload">Elije un anexo para subir.</span> </span></div></div>
    <?php
      if($documentacion_formato){
      	$ruta_anexo = base64_encode($ruta);
    	?>
    	<a href="../../filesystem/mostrar_binario.php?ruta=<?php echo $ruta_anexo;?>" target="_blank">Ver Anexos</a>
			<?php
    }
    ?>
    </div>
    <script type="text/javascript" src="../../dropzone/dist/dropzone.js"></script>
    <script type="text/javascript" src="../../dropzone/dist/dropzone.js"></script>
    <script type="text/javascript" src="../../anexosdigitales/highslide-5.0.0/highslide/highslide-with-html.js"></script>
    <link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-5.0.0/highslide/highslide.css" /></style>
    <link href="../../dropzone/dist/dropzone_saia.css" type="text/css" rel="stylesheet" />
    <script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-5.0.0/highslide/graphics/';
    hs.outlineType = 'rounded-white';
    </script>
    <?php
    include_once($ruta_db_superior."../../anexosdigitales/funciones_archivo.php");
    $js_archivos = "";
    $js_archivos = crear_campo_dropzone(null, null);
    ?>
  </div>-->


  <div class="control-group">
   <label class="control-label" for="codigo_padre" data-toggle="tooltip" title="Seleccione el formato principal al cual pertenece">Padre</label>
    <div class="controls">
    	<div id="esperando_codigo_padre_formato"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
    	<?php echo($nombre_cod_padre[0]["etiqueta"]);?>
      <div id="treebox_codigo_padre_formato" class="arbol_saia"></div>
      <input id="codigo_padre_formato" type="hidden" name="cod_padre" value="<?php echo($cod_padre);?>">
      <?php crear_arbol("codigo_padre_formato",$ruta_db_superior."test_formatos.php?tabla=formato&excluido=".$_REQUEST['idformato'].$adicional_cod_padre);?>
      </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="serie_idserie">Serie documental</label>
    <div class="controls">
    	<div id="esperando_arbol_serie_formato"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
    	<?php echo($serie[0]["nombre"]);?>
      <div id="treebox_arbol_serie_formato" class="arbol_saia"></div>
      <input id="arbol_serie_formato" type="hidden" name="serie_idserie" value="<?php echo($serie_idserie);?>">
      <?php crear_arbol("arbol_serie_formato",$ruta_db_superior."test_serie.php?tabla=serie&filtrar_arbol=documental&arbol_series=1");?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="contador">Contador</label>
    <div class="controls">
      <select name="contador_idcontador" data-toggle="tooltip" title="Escoja un contador" id="contador_idcontador">
      	<?php
      	$contadores=busca_filtro_tabla("","contador","nombre<>'' and estado=1","nombre",$conn);
      	$reinicia_contador=1;
      	for($i=0;$i<$contadores["numcampos"];$i++){
      		echo('<option value="'.$contadores[$i]["idcontador"].'"');
      		if($datos_formato[0]["contador_idcontador"]==$contadores[$i]["idcontador"]){
				echo(" selected='selected' ");
				$reinicia_contador=$contadores[$i]["reiniciar_cambio_anio"];
      		}
      		echo('>'.$contadores[$i]["nombre"].'</option>');
      	}
      	?>
      </select>
      <!--span id="reinicio_contador"> </span><input type="checkbox" name="reiniciar_contador" id="reiniciar_contador" <?php if($reinicia_contador){echo(' value="1" checked="checked"'); } else{echo( ' value="0" '); }?>>Reiniciar contador con el cambio de a&ntilde;o</span-->
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="tipos">Tipo de formato</label>
    <div class="controls">
      <input type="radio" name="item" id="item_0" value="1" <?php if(@$datos_formato[0]["item"]==1) echo(' checked="checked"');?> data-toggle="tooltip" title="Seleccione un tipo de formato">Item
      <input type="radio" name="item" id="item_1" value="<?php echo $datos_formato[0]["item"]; ?>" <?php  if(@$datos_formato[0]["item"]==0) echo(' checked="checked"');?> data-toggle="tooltip" title="Seleccione un tipo de formato">Formato

      </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="banderas">Atributos del formato</label>
    <div class="controls">
      <input type="checkbox" name="tipo_edicion" id="tipo_edicion" <?php check_banderas('tipo_edicion');?>>Edicion Continua
      <input type="checkbox" name="banderas[]" id="banderas" <?php check_banderas('aprobacion_automatica');?>>Aprobacion Automatica
      <input type="checkbox" name="mostrar" id="mostrar" <?php check_banderas('mostrar');?>>Mostrar
      <input type="checkbox" name="paginar" id="paginar" <?php check_banderas('paginar');?>>Paginar al mostrar
      <input type="checkbox" name="banderas[]"	id="banderas" <?php check_banderas('asunto_padre');?>>Tomar el asunto del padre al responder
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="font_size">Tama&ntilde;o de letra</label>
    <div class="controls">
      <select name="font_size" id="font_size" style="max-width:7%;" data-toggle="tooltip" title="Seleccione el tamaño de letra para los formatos">
      	<?php
      	$default_font_size=11;
      	if(@$datos_formato["numcampos"]){
      		$default_font_size=$datos_formato[0]["font_size"];
      	}
      	for($i=7;$i<31;$i++){
      		echo('<option value="'.$i.'"');
      		if($i==$default_font_size)
      			echo(' selected="selected"');
      		echo('>'.$i.'</option>');
      	}
      	?>
      </select>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="margenes">Margenes (mm)</label>
    <div class="controls">
      Izquierda<select class="input-mini" name="mizq" id="mizq">
      	<?php
      	$defaul_margen=array(15,20,15,30);
      	if(@$datos_formato["numcampos"]){
      		$defaul_margen=explode(",",$datos_formato[0]["margenes"]);
      	}
      	for($i=0;$i<11;$i++){
      		echo('<option value="'.($i*5).'"');
      		if(($i*5)==$defaul_margen[0])
      			echo(' selected="selected"');
      		echo('>'.($i*5).'</option>');
      	}
      	?>
      </select>
      Derecha<select class="input-mini" name="mder" id="mder">
      	<?php
      	for($i=0;$i<11;$i++){
      		echo('<option value="'.($i*5).'"');
      		if(($i*5)==$defaul_margen[1])
      			echo(' selected="selected"');
      		echo('>'.($i*5).'</option>');
      	}
      	?>
      </select>
      Superior<select class="input-mini" name="msup" id="msup">
      	<?php
      	for($i=0;$i<11;$i++){
      		echo('<option value="'.($i*5).'"');
      		if(($i*5)==$defaul_margen[2])
      			echo(' selected="selected"');
      		echo('>'.($i*5).'</option>');
      	}
      	?>
      </select>
      Inferior<select class="input-mini" name="minf" id="minf">
      	<?php
      	for($i=0;$i<11;$i++){
      		echo('<option value="'.($i*5).'"');
      		if(($i*5)==$defaul_margen[3])
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
      Horizontal<input type="radio" name="orientacion" id="orientacion_1" value="1" <?php if(@$datos_formato[0]["orientacion"]) echo(' checked="checked"');?>>
      Vertical<input type="radio" name="orientacion" id="orientacion_0" value="0" <?php if(!@$datos_formato[0]["orientacion"]) echo(' checked="checked"');?>>
    </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="papel">Tama&ntilde;o papel</label>
    <div class="controls">
      <select name="papel" id="papel" style="max-width:12%;">
      	<option value="letter" <?php if(@$datos_formato[0]["papel"]=="letter") echo(' selected');?>>Carta</option>
      	<option value="A4" <?php if(@$datos_formato[0]["papel"]=="A4") echo(' selected');?>>A4</option>
      	<option value="A5" <?php if(@$datos_formato[0]["papel"]=="A5") echo(' selected');?>>Media Carta</option>
      	<option value="legal" <?php if(@$datos_formato[0]["papel"]=="legal") echo(' selected');?>>Oficio</option>
      </select>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="mostrar_pdf">Vista del formato</label>
    <div class="controls">
      Vista en Navegador (HTML)<input type="radio" name="mostrar_pdf" id="mostrar_pdf_0" value="0" <?php if(@$datos_formato[0]["mostrar_pdf"]==0) echo(' checked="checked"');?>>
      <!--PDF WORD <input type="radio" name="mostrar_pdf" id="mostrar_pdf_2" value="2" <?php if(@$datos_formato[0]["mostrar_pdf"]==2) echo(' checked="checked"');?>-->
      PDF<input type="radio" name="mostrar_pdf" id="mostrar_pdf_1" value="1"  <?php if(@$datos_formato[0]["mostrar_pdf"]==1) echo(' checked="checked"');?>>
    </div>
  </div>
  <?php
  if($_SESSION["LOGIN" . LLAVE_SAIA]=="cerok"){
  ?>
	  <div class="control-group">
	    <label class="control-label" for="exportar">M&eacute;todo exportar</label>
	    <div class="controls">
	      <!--HTML2PS<input type="radio" name="exportar" id="exportar_1" value="html2ps"  <?php if(@$datos_formato[0]["exportar"]=="html2ps") echo(' checked="checked"');?>-->
	      mPDF<input type="radio" name="exportar" id="exportar_2" value="mpdf" <?php if(@$datos_formato[0]["exportar"]=="mpdf") echo(' checked="checked"');?>>
	      TCPDF<input type="radio" name="exportar" id="exportar_0" value="tcpdf"  <?php if(@$datos_formato[0]["exportar"]=="tcpdf" || !@$datos_formato) echo(' checked="checked"');?>>
	    </div>
	  </div>

	  <div class="control-group">
	    <label class="control-label" for="pertenece_nucleo">Formato Pertenece a n&uacute;cleo</label>
	    <div class="controls">
	      Si<input type="radio" name="pertenece_nucleo" id="pertenece_nucleo_1" value="1" <?php if(@$datos_formato[0]["pertenece_nucleo"]==1) echo(' checked="checked"');?>>
	      No<input type="radio" name="pertenece_nucleo" id="pertenece_nucleo_0" value="0"  <?php if(@$datos_formato[0]["pertenece_nucleo"]==0) echo(' checked="checked"');?>>
	    </div>
	  </div>

  <div class="control-group">
    <label class="control-label" for="tiempo_autoguardado">Tiempo autoguardado</label>
    <div class="controls">
    <?php $defaul_tiempo=6;
    if(@$datos_formato[0]["tiempo_autoguardado"]){
		$defaul_tiempo=$datos_formato[0]["tiempo_autoguardado"]/60000;
    }
    ?>
      <input id="tiempo_formato" type="number" name="tiempo_autoguardado" min="0" max="3600" step="1" value="<?php echo($defaul_tiempo)?>" style="width:50px;">Minutos
    </div>
  </div>
  <?php
  }
	else{
		?>
		<input type="hidden" name="exportar" value="tcpdf">
		<input type="hidden" name="pertenece_nucleo" value="0">
		<input type="hidden" id="tiempo_formato" name="tiempo_autoguardado" value="5">
		<?php
	}
  ?>
  <div class="control-group">
    <label class="control-label" for="fk_categoria_formato" data-toggle="tooltip" title="Escoja en donde será ubicado el formato">Categoria del formato</label>
    <div class="controls">
    	<div id="esperando_fk_categoria_formato"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
    	<?php echo($categoria_formato[0]["nombre"]);?>
      <div id="treebox_fk_categoria_formato" class="arbol_saia"></div>
      <input id="fk_categoria_formato" type="hidden" name="fk_categoria_formato" value="<?php echo($fk_categoria_formato);?>">
      <?php crear_arbol("fk_categoria_formato",$ruta_db_superior."test_categoria.php?tipo=1&seleccionados=".@$datos_formato[0]["fk_categoria_formato"],"checkbox");?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="funcion_predeterminada">Ruta de aprobaci&oacute;n</label>
    <div class="controls">
      Varios responsables<input type="checkbox" name="funcion_predeterminada[]" id="funcion_predeterminada_1" value="1" data-toggle="tooltip" title="Opción que realiza ruta de aprobación">
      Digitalizaci&oacute;n<input type="checkbox" name="funcion_predeterminada[]" id="funcion_predeterminada_2" value="2" data-toggle="tooltip" title="Opción que indica si el formato permite digitalizar">
    </div>
  </div>
  <div class="form-actions">
  	<input type="hidden" name="ruta_almacenamiento" id="ruta_almacenamiento_formato" value="{*fecha_ano*}/{*fecha_mes*}/{*idformato*}">
  	<!--input type="hidden" name="prefijo" id="prefijo_formato" value=""-->
  	<input type="hidden" name="idfuncionario" id="idfuncionario" value="<?php echo(usuario_actual("idfuncionario")); ?>">
  	<input type="hidden" name="banderas_formato" id="banderas" value="">
  	<input type="hidden" name="idformato" id="idformato" value="">
    <button type="button" name="adicionar" class="btn btn-primary" id="enviar_datos_formato" value="adicionar_datos_formato">Aceptar</button>
    <!-- button type="reset" name="cancelar" class="btn" id="cancelar_formulario_saia" value="cancelar">Cancel</button-->
    <?php if($_REQUEST["idformato"]){?>
    <!-- button type="button" name="eliminar" class="btn btn-danger kenlace_saia_propio" id="eliminar_formulario_saia" enlace="../formatos/generador/eliminar_formato.php?idformato=<?php echo($_REQUEST['idformato']);?>" titulo="Eliminar formato" eliminar_hijos="0" value="eliminar">Eliminar</button-->
    <?php }
    $texto .= "<input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''>";
    $id_unico = uniqid();
    $texto .= "<input type='hidden' name='form_uuid' id='form_uuid' value='$id_unico'>";
	echo $texto;
    ?>
    <div class="pull-right" id="cargando_enviar"></div>
  </div>
</form>
<?php
echo $js_archivos;
//echo(librerias_jquery("1.7"));
echo(librerias_notificaciones());
echo(librerias_kaiten());
echo(librerias_acciones_kaiten());
?>
<script type="text/javascript">
 /*$("#elemento1").mouseenter(function(e){
      $("#tip1").css("left", e.pageX + 5);
      $("#tip1,").css("top", e.pageY + 5);
      $("#tip1").css("display", "block");
   });
   $("#elemento1").mouseleave(function(e){
      $("#tip1").css("display", "none");
   }); */
$("document").ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	$("#nombre_formato").blur(function(){
		console.log($("#nombre_formato").val());
		if($("#nombre_formato").val()){
			$.ajax({
			  type:'POST',
			  dataType:'json',
			  url: "<?php echo($ruta_db_superior);?>pantallas/lib/llamado_ajax.php",
			  async:false,
			  data: "librerias=pantallas/generador/librerias_formato.php&funcion=verificar_nombre_formato&parametros="+$("#nombre_formato").val()+"&rand="+Math.round(Math.random()*100000),
			  success: function(objeto){
			      if(objeto.exito){
			    	  notificacion_saia(objeto.mensaje,'success','topCenter',3000);
			      }
			      else{
			    	  //notificacion_saia(objeto.mensaje,'error','topCenter',3000);
			    	  $("#nombre_formato").focus();
			      }

			  }
			});
		}
	});
	var formulario = $("#datos_formato");
	var formato=jQuery.parseJSON('<?php echo($formato);?>');
	window.console.log(formato);
	var nombre_formato="";
	if($("#nombre_formato").val()!=""){
		var nombre_formato=$("#nombre_formato").val();
	}

	$("#enviar_datos_formato").click(function() {
		if(formulario.valid()) {
			$('#cargando_enviar').html("Procesando <i id='icon-cargando'>&nbsp;</i>");
			var buttonAcep = $(this);
			//buttonAcep.attr('disabled', 'disabled');
			//parsear_items();
			$.ajax({
        type:'POST',
        dataType:'json',
        url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias_pantalla.php",
        data: "ejecutar_datos_pantalla="+buttonAcep.attr('value')+"&tipo_retorno=1&rand="+Math.round(Math.random()*100000)+'&'+formulario.serialize()+"&nombre="+nombre_formato,
        success: function(objeto) {
            if(objeto.exito) {
              $('#cargando_enviar').html("Terminado ...");
              var ruta_iframe=$(".k-focus",window.parent.document).find("iframe").attr("src");
              ruta_iframe=ruta_iframe.substr(0,ruta_iframe.indexOf("generador_pantalla"));
              var data_iframe= { url:ruta_iframe+"generador_pantalla.php?idformato="+objeto.idformato,  kTitle:"Formato "+$("#etiqueta_formato").val()};
              var kaiten_actual=obtener_panel_kaiten();
              parent.Kaiten.reload(kaiten_actual,data_iframe);
              notificacion_saia('El registro se a insertado exitosamente','success','topCenter',3000);

            } else {
            	notificacion_saia(objeto.error,'error','topCenter',3000);
            	buttonAcep.removeAttr('disabled');
            }

        }
    	});
		} else {
    	notificacion_saia('Debe diligenciar los campos obligatorios','warning','topCenter',3000);
			$(".error").first().focus();
		}
	});


		if(formato!==null && formato.numcampos){
    $('#nombre_formato').attr('value',formato[0].nombre);
    //$('#tabla_formato').attr('value',formato[0].tabla);
    $('#descripcion_formato').attr('value',formato[0].descripcion_formato);
    $('#proceso_pertenece').attr('value',formato[0].proceso_pertenece);
    $('#serie_idserie').attr('value',formato[0].serie_idserie);
    $('#version').attr('value',formato[0].version);
    $('#librerias_formato').attr('value',formato[0].librerias);
    $('#etiqueta_formato').attr('value',formato[0].etiqueta);
    $('#ruta_formato').attr('value',formato[0].ruta_formato);
    $('#ayuda_formato').attr('value',formato[0].ayuda);
    //$('#prefijo_formato').attr('value',formato[0].prefijo);
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
	} else {
		$('.nav li').addClass('disabled');
		$("#contenidos_componentes").hide();
		$('#tabs_formulario li:first').removeClass('disabled');
		$('#tabs_formulario a[href="#datos_formulario-tab"]').tab('show');
	}
});
function parsear_items(){
	var nombre_formato=$("#nombre_formato").val();
	if(nombre_formato.indexOf("ft_")=="-1"){
		$("#nombre_formato").val("ft_"+nombre_formato);
	}
	$("#prefijo_formato").val("ft_");
}
</script>
<?php
function check_banderas($bandera){
	global $datos_formato;
	if($bandera=="aprobacion_automatica"){
		echo(' value="e" ');
		if(strpos("e",$datos_formato[0]["banderas"])!==false){
			echo(' checked="checked" ');
		}
	}
	else if($bandera=="asunto_padre"){
		echo(' value="r" ');
		if(strpos("r",$datos_formato[0]["banderas"])!==false){
			echo(' checked="checked" ');
		}
	}
	else if($bandera && $datos_formato[0][$bandera]){
		echo(' value="'.$datos_formato[0][$bandera].'" checked="checked" ');
	}
}
function crear_arbol($nombre,$url,$tipo="radio"){
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
  <?php if($tipo=="radio"){ ?>
		tree_<?php echo($nombre);?>.enableRadioButtons(true);
		tree_<?php echo($nombre);?>.setOnCheckHandler(onNodeSelect_<?php echo($nombre);?>);
		function onNodeSelect_<?php echo($nombre);?>(nodeId){
			//alert(nodeId);
			var valor_destino=document.getElementById("<?php echo($nombre);?>");
			if(tree_<?php echo($nombre);?>.isItemChecked(nodeId)){
				//alert(valor_destino.value);
				if(valor_destino.value!=="")
					tree_<?php echo($nombre);?>.setCheck(valor_destino.value,false);
				if(nodeId.indexOf("_")!=-1)
					nodeId=nodeId.substr(0,nodeId.indexOf("_"));
				valor_destino.value=nodeId;
			}else{
				valor_destino.value="";
			}
		}
  <?php }
  else{
  ?>
  tree_<?php echo($nombre);?>.setOnCheckHandler(onNodeSelect_check_<?php echo($nombre);?>);
  function onNodeSelect_check_<?php echo($nombre);?>(nodeId){
  		var valor_destino=document.getElementById("<?php echo($nombre);?>");
		valor_destino.value=tree_<?php echo($nombre);?>.getAllChecked();
	}
  <?php
  }
  ?>
  /*tree_<?php echo($nombre);?>.enableThreeStateCheckboxes(true);*/


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
});
</script>
	<?php
}

function crear_campo_dropzone($nombre, $parametros) {
        $js_archivos = "<script type='text/javascript'>
            var upload_url = '../../dropzone/cargar_archivos_anexos.php';
            var mensaje = 'Arrastre aquí los archivos';
            Dropzone.autoDiscover = false;
            var lista_archivos = new Object();
            $(document).ready(function () {
                Dropzone.autoDiscover = false;
                $('.saia_dz').each(function () {
                    var paramName = $(this).attr('data-nombre-campo');
                	var extensiones = $(this).attr('data-extensiones');
                	var multiple_text = $(this).attr('data-multiple');
                	var multiple = false;
                	var form_uuid = $('#form_uuid').val();
                	var maxFiles = 1;
                	if(multiple_text == 'multiple') {
                		multiple = true;
                		maxFiles = 10;
                	}
                    var opciones = {
                    	ignoreHiddenFiles : true,
                    	maxFiles : maxFiles,
                    	acceptedFiles: extensiones,
                   		addRemoveLinks: true,
                   		dictRemoveFile: 'Quitar anexo',
                   		dictMaxFilesExceeded : 'No puede subir mas archivos',
                   		dictResponseError : 'El servidor respondió con código {{statusCode}}',
                		uploadMultiple: multiple,
                    	url: upload_url,
                    	paramName : paramName,
                    	params : {
                        	nombre_campo : paramName,
                        	uuid : form_uuid
                        },
                            removedfile : function(file) {
                                if(lista_archivos && lista_archivos[file.upload.uuid]) {
                                	$.ajax({
                                		url: upload_url,
                                		type: 'POST',
                                		data: {
                                    		accion:'eliminar_temporal',
                                        	archivo: lista_archivos[file.upload.uuid]}
                                		});
                                }
                                if (file.previewElement != null && file.previewElement.parentNode != null) {
                                    file.previewElement.parentNode.removeChild(file.previewElement);
                                	delete lista_archivos[file.upload.uuid];
                                	$('#'+paramName).val(Object.values(lista_archivos).join());
                                }
                                return this._updateMaxFilesReachedClass();
                            },
                            success : function(file, response) {

                            	for (var key in response) {
                                	if(Array.isArray(response[key])) {
                                    	for(var i=0; i < response[key].length; i++) {
                                    		archivo=response[key][i];
                                        	if(archivo.original_name == file.upload.filename) {
                                        		lista_archivos[file.upload.uuid] = archivo.id;
                                        	}
                                    	}
                                	} else {
                                		if(response[key].original_name == file.upload.filename) {
                                    		lista_archivos[file.upload.uuid] = response[key].id;
                                		}
                                	}
                            	}
                            	$('#'+paramName).val(Object.values(lista_archivos).join());
                                if($('#dz_campo').find('label.error').length) {
                                    $('#dz_campo').find('label.error').remove()
                                }
                            }
                    };
                    $(this).dropzone(opciones);
                    $(this).addClass('dropzone');
                });
            });</script>";
        return $js_archivos;
    }

?>