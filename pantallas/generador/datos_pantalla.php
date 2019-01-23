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

if($_REQUEST['idformato']) {
	$formato = busca_filtro_tabla("","formato","idformato=".$_REQUEST['idformato'],"",$conn);
	$formato = procesar_cadena_json($formato,array("cuerpo","ayuda","etiqueta"));
	$cod_padre=$formato[0]["cod_padre"];

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
	//$formato = json_encode($formato);
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
<!DOCTYPE html>
<html >
<head>
<style type="text/css">
.arbol_saia>.containerTableStyle {overflow:hidden;}
</style>

	<script type="text/javascript" src="<?=$ruta_db_superior?>pantallas/generador/editar_componente_generico.js"></script>

</head>
<body>

<form name="datos_formato" id="datos_formato">

  <h5>Informaci&oacute;n general</h5>
  <hr>

  <?php
  if($_SESSION["LOGIN" . LLAVE_SAIA]=="cerok") {
  ?>
  <div class="row-fluid"><div class="span12">
	  <div class="control-group">
	    <label class="control-label" for="nombre"><strong>Nombre*</strong></label>
	    <div class="controls">
	      <input type="text" name="nombre_formato" id="nombre_formato" placeholder="Nombre" value="" required readonly>
	    </div>
	  </div>
	  </div></div>
	 <?php
  } else {
?>
      <input type="hidden" name="nombre_formato" id="nombre_formato" value="" required>
<?php
  }
  ?>

  <div class="row-fluid">
    <div class="span8">
      <div class="control-group">
        <label class="control-label" for="etiqueta"><strong>Nombre del formato *</strong></label>
        <div class="controls">
          <input type="text" style="width: 80%;" name="etiqueta" id="etiqueta_formato" placeholder="Nombre" value="" required <?php if($_REQUEST["idformato"]) echo("readonly");?>>
        </div>
      </div>
    </div>
    <div class="span4">
      <div class="control-group">
        <label class="control-label" for="version"><strong>Versi&oacute;n *</strong></label>
        <div class="controls">
          <input type="text" name="version" id="version" placeholder="Versi&oacute;n" value="" required>
        </div>
      </div>
    </div>
  </div>

<?php
$valor_item = 0;
$valor_mostrar = "0";
if($datos_formato["numcampos"]) {
    $valor_item = $datos_formato[0]["item"];
    $valor_mostrar = $datos_formato[0]["mostrar_pdf"];
}
?>

  <input type="hidden" name="item" id="item" value="<?=$valor_item?>">
  <input type="hidden" name="mostrar_pdf" id="mostrar_pdf" value="<?=$valor_mostrar?>">

  <div class="row-fluid">
    <div class="span8">
      <div class="control-group">
        <label class="control-label" for="descripcion"><strong>Descripci&oacute;n del formato</strong></label>
        <div class="controls">
          <textarea style="width: 80%" name="descripcion_formato" id="descripcion_formato" placeholder="Descripci&oacute;n" rows="3"></textarea>
        </div>
      </div>
    </div>

    <div class="span4">
      <div class="control-group">
        <label class="control-label" for="tipos"><strong>Tipo de registro</strong></label>
        <div class="controls">
          <select name="tipo_registro" id="tipo_registro">
            <option value="">Por favor seleccione</option>
            <option value="1">Documento oficial (PDF)</option>
            <option value="2">Registro de apoyo</option>
            <option value="3">Registro del tipo Item</option>
          </select>
        </div>
      </div>
    </div>
  </div>

  <!-- <div class="control-group">
    <label class="control-label" for="proceso">Proceso al que pertenece*</label>
    <div class="controls">
      <div id="esperando_proceso_pertenece"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
      <div id="treebox_proceso_pertenece" class="arbol_saia"></div>
      <input id="proceso_pertenece" type="hidden" name="proceso_pertenece" required value="<?php echo($cod_proceso_pertenece);?>">
      <?php crear_arbol("proceso_pertenece",$ruta_db_superior."test_serie.php?estado=1&tabla=cf_procesos_formato".$adicional_cod_proceso);?>
    </div>
  </div> -->

  <div class="row-fluid">
    <div  class="span8">
      <div class="control-group">
       <label class="control-label" for="codigo_padre" data-toggle="tooltip" title="Seleccione el formato principal al cual pertenece"><strong>Relaci&oacute;n con otro Formato</strong></label>
        <div class="controls">
        	<div id="esperando_codigo_padre_formato"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
        	<?php echo($nombre_cod_padre[0]["etiqueta"]);?>
          <div id="treebox_codigo_padre_formato" class="arbol_saia"></div>
          <input id="codigo_padre_formato" type="hidden" name="cod_padre" value="<?php echo($cod_padre);?>">
          <?php crear_arbol("codigo_padre_formato",$ruta_db_superior."test_formatos.php?tabla=formato&excluido=".$_REQUEST['idformato'].$adicional_cod_padre);?>
          </div>
      </div>
    </div>
    <div class="span4">
      <div class="control-group">
        <label class="control-label" for="contador"><strong>Consecutivo asociado *</strong></label>
        <div class="controls">
          <select name="contador_idcontador" data-toggle="tooltip" title="Escoja un contador" id="contador_idcontador" required>
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
    </div>
  </div>

  <div class="row-fluid"> <!-- FILA SERIE -->
    <div class="span4">
      <div class="control-group">
        <label class="control-label" for="serie_idserie"><strong>Tipo documental asociado</strong></label>
        <div class="controls">
        	<div id="esperando_arbol_serie_formato"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
        	<?php
        	$url = $ruta_db_superior."test_serie.php?tabla=serie&filtrar_arbol=documental&arbol_series=1";
        	if($datos_formato["numcampos"] && !empty($datos_formato[0]["serie_idserie"])) {
        	    $url .= "&seleccionado=" . $datos_formato[0]["serie_idserie"];
        	    $datos_serie = busca_filtro_tabla("codigo, nombre", "serie", "idserie=" . $datos_formato[0]["serie_idserie"], "", $conn);
        	    //echo($datos_serie[0]["nombre"]);
        	}
        	?>
          <div id="treebox_arbol_serie_formato" class="arbol_saia"></div>
          <input id="arbol_serie_formato" type="hidden" name="serie_idserie" value="<?=$datos_formato[0]["serie_idserie"]?>">
          <?php
          crear_arbol("arbol_serie_formato", $url);
          ?>
        </div>
      </div>
    </div>

    <div class="span4">
      <div class="control-group">
        <label class="control-label" for="codigo_serie"><strong>C&oacute;digo</strong></label>
        <div class="controls">
          <input type="text" id="codigo_serie" value="<?php
          if($datos_serie["numcampos"]) {
              echo $datos_serie[0]["codigo"];
          }
          ?>" disabled="disabled">
        </div>
      </div>
    </div>
    <div class="span4">
      <div class="control-group">
        <label class="control-label" for="mostrar_tipodoc_pdf">&nbsp;</label>
        <div class="controls">
          <input type="checkbox" name="mostrar_tipodoc_pdf" id="mostrar_tipodoc_pdf" value="1" <?php if(@$datos_formato[0]["mostrar_tipodoc_pdf"]==1) echo(' checked="checked"');?>>
             Mostrar código en el nombre del Formato.
        </div>
      </div>
    </div>

  </div>  <!-- FIN FILA SERIE -->

 <div class="control-group">
    <label class="control-label" for="banderas"><strong>Atributos del formato</strong></label>
    <div class="controls">
      <input type="checkbox" name="tipo_edicion" id="tipo_edicion" <?php check_banderas('tipo_edicion');?>>Edicion Continua
      <!--<input type="checkbox" name="mostrar" id="mostrar" <?php check_banderas('mostrar');?>>Mostrar-->
      <input type="checkbox" name="paginar" id="paginar" <?php check_banderas('paginar');?>>Paginar al mostrar
      <input type="checkbox" name="banderas[]" id="banderas" <?php check_banderas('aprobacion_automatica');?>>Aprobacion Automatica
      <input type="checkbox" name="banderas[]"	id="banderas" <?php check_banderas('asunto_padre');?>>Tomar el asunto del padre al responder
    </div>
  </div> 

  <input type="hidden" name="mostrar" id="mostrar" <?php check_banderas('mostrar', false);?>>
  <input type="hidden" name="paginar" id="paginar" <?php check_banderas('paginar', false);?>>

<p>&nbsp;</p>
  <h5>Configuraci&oacute;n de página</h5>
  <hr>

  <div class="row-fluid">
    <div class="span6"> <!-- COLUMNA IZQUIERDA -->

      <div class="row-fluid">
        <div class="span6">
          <div class="control-group">
            <label class="control-label" for="papel"><strong>Tama&ntilde;o de la p&aacute;gina</strong></label>
            <div class="controls">
              <select name="papel" id="papel">
              	<option value="letter" <?php if(@$datos_formato[0]["papel"]=="letter") echo(' selected');?>>Carta (21,6 cm x 27,9 cm)</option>
              	<option value="legal" <?php if(@$datos_formato[0]["papel"]=="legal") echo(' selected');?>>Legal (21,6 cm x 35,6 cm)</option>
              	<option value="A4" <?php if(@$datos_formato[0]["papel"]=="A4") echo(' selected');?>>A4 (21,0 cm x 29,7 cm)</option>
              	<option value="A5" <?php if(@$datos_formato[0]["papel"]=="A5") echo(' selected');?>>Media Carta (14,0 cm x 21,6 cm)</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="row-fluid">
        <div class="span6">
          <div class="control-group">
            <label class="control-label" for="orientacion"><strong>Orientaci&oacute;n</strong></label>
            <div class="controls">            
               Vertical <input type="radio" name="orientacion" id="orientacion_0" value="0" <?php if(!@$datos_formato[0]["orientacion"]) echo(' checked="checked"');?>>
               Horizontal <input type="radio" name="orientacion" id="orientacion_1" value="1" <?php if(@$datos_formato[0]["orientacion"]) echo(' checked="checked"');?>>
            </div>
          </div>
        </div>
      </div>

      <div class="row-fluid">
        <div class="span12">
          <div class="control-group">
            <label class="control-label" for="font_size"><strong>Tama&ntilde;o de letra</strong></label>
            <div class="controls">
              <select name="font_size" id="font_size" data-toggle="tooltip" title="Seleccione el tamaño de letra para los formatos">
              	<?php
              	$tam_letras = [8, 10, 11, 12, 14, 16, 18, 22, 24, 30, 36];
              	$default_font_size=11;
              	if(@$datos_formato["numcampos"]){
              		$default_font_size=$datos_formato[0]["font_size"];
              	}
              	
              	foreach ($tam_letras as $value) {
              	    echo('<option value="' . $value . '"');
              	    if($value == $default_font_size) {
              	        echo(' selected="selected"');
              	    }
              	    echo('>'. $value .'</option>');
              	}
              	?>
              </select>
            </div>
          </div>
        </div>
      </div>

    </div> <!-- FIN COLUMNA IZQUIERDA -->

  	<?php
  	$margen_defecto=array(2.5, 2.5, 2.5, 2.5);
  	if($datos_formato["numcampos"] && !empty($datos_formato[0]["margenes"])) {
  	    $margen_defecto=explode(",", $datos_formato[0]["margenes"]);
  	    $margen_defecto = array_map(function($val) {
  	        return $val/10; // esta guardado en milimetros
  	    }, $margen_defecto);
  	}
  	?>

    <div class="span6"> <!-- COLUMNA DERECHA -->
      <label class="control-label" for="margenes"><strong>M&aacute;rgenes (cent&iacute;metros)</strong></label>
      <div class="row-fluid">
        <div class="span2">
          <label for="msup">Superior</label>
        </div>
        <div class="span2">
          <div class="controls">
            <input type="number" min="0" max="10" step="0.1" class="input-mini" name="msup" id="msup" value="<?=$margen_defecto[2]?>">
          </div>
        </div>
      </div> <!-- FIN FILA -->
      <div class="row-fluid">
        <div class="span2">
          <label for="minf">Inferior</label>
        </div>
        <div class="span2">
          <div class="controls">
            <input type="number" min="0" max="10" step="0.1" class="input-mini" name="minf" id="minf" value="<?=$margen_defecto[3]?>">
          </div>
        </div>
      </div> <!-- FIN FILA -->
      <div class="row-fluid">
        <div class="span2">
          <label for="mizq">Izquierda</label>
        </div>
        <div class="span2">
          <div class="controls">
            <input type="number" min="0" max="10" step="0.1" class="input-mini" name="mizq" id="mizq" value="<?=$margen_defecto[0]?>">
          </div>
        </div>
      </div> <!-- FIN FILA -->
      <div class="row-fluid">
        <div class="span2">
          <label>Derecha</label>
        </div>
        <div class="span2">
          <div class="controls">
            <input type="number" min="0" max="10" step="0.1" class="input-mini" name="mder" id="mder" value="<?=$margen_defecto[1]?>">
          </div>
        </div>
      </div> <!-- FIN FILA -->
    </div> <!-- FIN COLUMNA DERECHA -->
  </div>

    <input type="hidden" name="exportar" value="mpdf">
    <input type="hidden" name="pertenece_nucleo" value="0">
    <input type="hidden" id="tiempo_formato" name="tiempo_autoguardado" value="5">

  <div class="row-fluid">
    <div class="span12">
      <div class="control-group">
        <label class="control-label" for="fk_categoria_formato" data-toggle="tooltip" title="Escoja en donde ser&aacute; ubicado el formato"><strong>Categor&iacute;a del formato</strong></label>
        <div class="controls">
        	<div id="esperando_fk_categoria_formato"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
        	<?php echo($categoria_formato[0]["nombre"]);?>
          <div id="treebox_fk_categoria_formato" class="arbol_saia"></div>
          <input id="fk_categoria_formato" type="hidden" name="fk_categoria_formato" value="<?php echo($datos_formato[0]["fk_categoria_formato"]);?>">
          <?php crear_arbol("fk_categoria_formato",$ruta_db_superior."test_categoria.php?tipo=1&seleccionados=".@$datos_formato[0]["fk_categoria_formato"],"checkbox");?>
        </div>
      </div>
    </div>
  </div>

  <!-- <div class="control-group">
    <label class="control-label" for="funcion_predeterminada">Ruta de aprobaci&oacute;n</label>
    <div class="controls">
      Varios responsables<input type="checkbox" name="funcion_predeterminada[]" id="funcion_predeterminada_1" value="1" data-toggle="tooltip" title="Opción que realiza ruta de aprobación">
      Digitalizaci&oacute;n<input type="checkbox" name="funcion_predeterminada[]" id="funcion_predeterminada_2" value="2" data-toggle="tooltip" title="Opción que indica si el formato permite digitalizar">
    </div>
  </div> -->

  <div class="container">
  <div class="row-fluid">
  	<input type="hidden" name="ruta_almacenamiento" id="ruta_almacenamiento_formato" value="{*fecha_ano*}/{*fecha_mes*}/{*idformato*}">
  	<!--input type="hidden" name="prefijo" id="prefijo_formato" value=""-->
  	<input type="hidden" name="idfuncionario" id="idfuncionario" value="<?php echo(usuario_actual("idfuncionario")); ?>">
  	<input type="hidden" name="banderas_formato" id="banderas" value="">
  	<input type="hidden" name="idformato" id="idformato" value="">
    <button type="button" name="adicionar" class="btn btn-info" id="enviar_datos_formato" value="adicionar_datos_formato" style="background: #48b0f7;color:fff;"><span  style="color:fff; background: #48b0f7;">Aceptar</span></button>
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
	/*$("#nombre_formato").blur(function() {
		//console.log($("#nombre_formato").val());
		if($("#nombre_formato").val()) {
			$.ajax({
			    type:'POST',
			    dataType:'json',
			    url: "<?php echo($ruta_db_superior);?>pantallas/lib/llamado_ajax.php",
			    async:false,
			    data: "librerias=pantallas/generador/librerias_formato.php&funcion=verificar_nombre_formato&parametros="+$("#nombre_formato").val()+"&rand="+Math.round(Math.random()*100000),
			    success: function(objeto) {
			        if(objeto.exito) {
			      	  notificacion_saia(objeto.mensaje,'success','topCenter',3000);
			        } else {
			      	  //notificacion_saia(objeto.mensaje,'error','topCenter',3000);
			      	  $("#nombre_formato").focus();
			        }
			    }
			});
		}
	});*/

	$("#etiqueta_formato").change(function() {
        var valor = $(this).val();
        console.log(valor);
        if (valor) {
        	var nombre = normalizar(valor);
            console.log(nombre);
        	$("#nombre_formato").val(nombre);
        }
	});

	var formulario = $("#datos_formato");
	var formato=<?php echo(json_encode($formato));?>;
	//window.console.log(formato);
	var nombre_formato="";
	if($("#nombre_formato").val()!="") {
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
                        //var iframe = $("#iframe_generador", window.parent.document);
                        //var ruta_iframe = $(iframe).attr("src");
                        var ruta_iframe = window.location.href;
                        var ruta_iframe=$(".k-focus", window.parent.parent.document).find("iframe").attr("src");
                       
                        //ruta_iframe=ruta_iframe.substr(0,ruta_iframe.indexOf("generador_pantalla"));
                        //var data_iframe= { url:ruta_iframe+"generador_pantalla.php?idformato="+objeto.idformato,  kTitle:"Formato "+$("#etiqueta_formato").val()};
                        var data_iframe= { url:ruta_iframe+"&idformato="+objeto.idformato,  kTitle:"Formato "+$("#etiqueta_formato").val()};

                        $id = $(".k-focus", parent.parent.document).attr("id").replace("kp", "");
                        var kaiten_actual = parent.parent.$("#contenedor_busqueda").kaiten("getPanel", ($id - 1));                        
                        parent.parent.Kaiten.reload(kaiten_actual, data_iframe);
                        notificacion_saia('El registro se ha insertado exitosamente','success','topCenter',3000);
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

	$("#tipo_registro").change(function() {
		var valor = $(this).val();
		console.log(valor);
		switch (valor) {
		case "1":
			$("#item").val("0");
			$("#mostrar_pdf").val("1");
			break;
		case "2":
			$("#item").val("0");
			$("#mostrar_pdf").val("0");
			break;
		case "3":
			$("#item").val("1");
			$("#mostrar_pdf").val("0");
			break;
		default:
			$("#item").val("0");
			$("#mostrar_pdf").val("0");
			break;
		}
	});

	if(formato!==null && formato.numcampos) {
        $('#nombre_formato').attr('value',formato[0].nombre);
        $('#etiqueta_formato').attr('value',formato[0].etiqueta);
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
        if(formato[0].tipo_formato==2) {
        	$("#campos_formato").show();
        }
        $('#aprobacion_automatica_'+formato[0].aprobacion_automatica).attr('checked',"checked");
        $('#enviar_datos_formato').attr('value','editar_datos_formato');
  	    $('#tabs_formulario a[href="#datos_formulario-tab"]').tab('show');
  	    $('#componentes_acciones').hide();
  	    $('.nav li').removeClass('disabled');

        var item = formato[0].item;
        var mostrar_pdf = formato[0].mostrar_pdf;
        if(item == 0 && mostrar_pdf == 0) {
        	$("#tipo_registro").val(2);
        }
        if(item == 0 && mostrar_pdf == 1) {
        	$("#tipo_registro").val(1);
        }
        if(item == 1 && mostrar_pdf == 0) {
        	$("#tipo_registro").val(3);
        }

	} else {
		$('.nav li').addClass('disabled');
		$('#generar_pantalla').addClass('disabled');

		$("#contenidos_componentes").hide();
		$('#tabs_formulario li:first').removeClass('disabled');
		$('#tabs_formulario a[href="#datos_formulario-tab"]').tab('show');
	}

	tree_arbol_serie_formato.setOnCheckHandler(parsear_serie_formato);

});

   function parsear_serie_formato(nodeId) {
		//console.log(nodeId);
		var datos = tree_arbol_serie_formato.getUserData(nodeId, "serie_codigo");
		//console.log(datos);
		$("#codigo_serie").val(datos);
		/*if(datos) {
			$('[name="expediente_serie"]').val(datos);
		} else {
			$('[name="expediente_serie"]').val("");
		}
		if(idexpediente_idserie.length > 1) {
			$('[name="expediente_serie"]').val(idexpediente_idserie[0]);
		}
		var seleccionados = tree_serie_idserie.getAllChecked();
		var vector_seleccionados = seleccionados.split(',');
		for ( i = 0; i < vector_seleccionados.length; i++) {
			if (vector_seleccionados[i] != nodeId) {
				tree_serie_idserie.setCheck(vector_seleccionados[i], 0);
			}
		}*/
	}


function parsear_items(){
	var nombre_formato=$("#nombre_formato").val();
	if(nombre_formato.indexOf("ft_")=="-1"){
		$("#nombre_formato").val("ft_"+nombre_formato);
	}
	$("#prefijo_formato").val("ft_");
}
</script>

</body>
</html>

<?php
function check_banderas($bandera, $chequear = true){
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
	    $texto = ' value="'.$datos_formato[0][$bandera].'"';
	    if($chequear) {
	        $texto .= ' checked="checked" ';
	    }
		echo $texto;
	}
}

function crear_arbol($nombre, $url, $tipo="radio") {
	global $ruta_db_superior;
	?>
<script>
$("document").ready(function(){
  var browserType;
  if (document.layers) {
	  browserType = "nn4"
  }
  if (document.all) {
	  browserType = "ie"
  }
  if (window.navigator.userAgent.toLowerCase().match("gecko")) {
	  browserType= "gecko"
  }

  tree_<?php echo($nombre);?>=new dhtmlXTreeObject("treebox_<?php echo($nombre);?>","100%","",0);
  tree_<?php echo($nombre);?>.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
  tree_<?php echo($nombre);?>.enableTreeImages(false);
  tree_<?php echo($nombre);?>.enableTextSigns(true);
  tree_<?php echo($nombre);?>.enableIEImageFix(true);
  tree_<?php echo($nombre);?>.setOnLoadingStart(cargando_arbol_<?php echo($nombre);?>);
  tree_<?php echo($nombre);?>.setOnLoadingEnd(fin_cargando_arbol_<?php echo($nombre);?>);

  tree_<?php echo($nombre);?>.enableCheckBoxes(1);
  <?php if($tipo == "radio") { ?>
	tree_<?php echo($nombre);?>.enableRadioButtons(true);
	tree_<?php echo($nombre);?>.setOnCheckHandler(onNodeSelect_<?php echo($nombre);?>);
	function onNodeSelect_<?php echo($nombre);?>(nodeId) {
		//alert(nodeId);
		var valor_destino=document.getElementById("<?php echo($nombre);?>");
		if(tree_<?php echo($nombre);?>.isItemChecked(nodeId)) {
			//alert(valor_destino.value);
			if(valor_destino.value!=="") {
				tree_<?php echo($nombre);?>.setCheck(valor_destino.value,false);
			}
			if(nodeId.indexOf("_") != -1) {
				nodeId=nodeId.substr(0,nodeId.indexOf("_"));
			}
			valor_destino.value=nodeId;
		} else {
			valor_destino.value="";
		}
	}
  <?php } else {
  ?>
  tree_<?php echo($nombre);?>.setOnCheckHandler(onNodeSelect_check_<?php echo($nombre);?>);
  function onNodeSelect_check_<?php echo($nombre);?>(nodeId) {
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

?>