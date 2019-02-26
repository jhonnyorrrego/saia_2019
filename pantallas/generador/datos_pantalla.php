<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
  }
  $ruta .= "../";
  $max_salida--;
}
include_once $ruta_db_superior . "db.php";
include_once $ruta_db_superior . "librerias_saia.php";
include_once $ruta_db_superior . "pantallas/lib/librerias_componentes.php";
include_once $ruta_db_superior . "pantallas/generador/librerias_pantalla.php";
include_once $ruta_db_superior . "arboles/crear_arbol_ft.php";
echo librerias_UI("1.12");
echo librerias_arboles_ft("2.24", 'filtro');

if ($_REQUEST['idformato']) {
  $formato = busca_filtro_tabla("", "formato", "idformato=" . $_REQUEST['idformato'], "", $conn);
  $formato = procesar_cadena_json($formato, array("cuerpo", "ayuda", "etiqueta"));
  $cod_padre = $formato[0]["cod_padre"];

  $cod_proceso_pertenece = $formato[0]["proceso_pertenece"];
  $categoria = $formato[0]["fk_categoria_formato"];
  if ($formato[0]["tiempo_autoguardado"] > 3000) {
    $formato[0]["tiempo_autoguardado"] = $formato[0]["tiempo_autoguardado"] / 60000;
  }
  $funcionPredeterminada = strpos($formato[0]['funcion_predeterminada'], "1");
  $checkResponsables = '';
  if($funcionPredeterminada !== false){
    $checkResponsables = "checked";
  }
	//$formato = json_encode($formato);
  if ($cod_proceso_pertenece) {
    $adicional_cod_proceso = "&seleccionado=" . $cod_proceso_pertenece;
  }
  if ($cod_padre) {
    $nombre_cod_padre = busca_filtro_tabla("", "formato a", "a.idformato=" . $cod_padre, "", $conn);
    $adicional_cod_padre = "&seleccionado=" . $cod_padre;
  }
  if ($categoria) {
    $nombre_categoria = busca_filtro_tabla("", "categoria_formato a", "a.idcategoria_formato IN($categoria)", "", $conn);
    $adicional_categoria = "&seleccionado=" . $categoria;
  }

  $origen = array("url" => "arboles/arbol_formatos.php", "ruta_db_superior" => $ruta_db_superior, "params" => array("id" => $_REQUEST['id'], "excluido" => $_REQUEST['idformato'], "seleccionados" => $cod_padre, "seleccionable" => "radio"));
  $opciones_arbol = array("keyboard" => true, "selectMode" => 1, "seleccionarClick" => 1, "busqueda_item" => 1, "checkbox" => radio);
  $extensiones = array("filter" => array());
  $arbol = new ArbolFt("codigo_padre_formato", $origen, $opciones_arbol, $extensiones, $validaciones);

  $origenCategoria = array("url" => "arboles/arbol_categoria_formatos.php", "ruta_db_superior" => $ruta_db_superior, "params" => array("tipo" => "1", "seleccionados" => $formato[0]["fk_categoria_formato"], "seleccionable" => "checkbox"));
  $opcionesArbolCategoria = array("keyboard" => true, "selectMode" => 3, "seleccionarClick" => 1, "busqueda_item" => 1, "checkbox" => checkbox);
  $extensionesCategoria = array("filter" => array());
  $arbolCategoria = new ArbolFt("fk_categoria_formato", $origenCategoria, $opcionesArbolCategoria, $extensionesCategoria, $validaciones);
}else{

  $origen = array("url" => "arboles/arbol_formatos.php", "ruta_db_superior" => $ruta_db_superior, "params" => array("seleccionable" => "radio"));
  $opciones_arbol = array("keyboard" => true, "selectMode" => 1, "seleccionarClick" => 1, "busqueda_item" => 1, "checkbox" => radio);
  $extensiones = array("filter" => array());
  $arbol = new ArbolFt("codigo_padre_formato", $origen, $opciones_arbol, $extensiones, $validaciones);

  $origenCategoria = array("url" => "arboles/arbol_categoria_formatos.php", "ruta_db_superior" => $ruta_db_superior, "params" => array("tipo" => "1", "seleccionado" => $formato[0]["fk_categoria_formato"], "seleccionable" => "checkbox"));
  $opcionesArbolCategoria = array("keyboard" => true, "selectMode" => 3, "seleccionarClick" => 1, "busqueda_item" => 1, "checkbox" => checkbox);
  $extensionesCategoria = array("filter" => array());
  $arbolCategoria = new ArbolFt("fk_categoria_formato", $origenCategoria, $opcionesArbolCategoria, $extensionesCategoria, $validaciones);

}
/**
 * Esta funcion puede servir para
 */
function procesar_cadena_json($resultado, $lista_valores)
{
  for ($i = 0; $i < $resultado["numcampos"]; $i++) {
    $busqueda = $resultado[$i];
    foreach ($busqueda as $key => $valor) {
      if (is_numeric($key)) {
        unset($busqueda[$key]);
      } else if (in_array($key, $lista_valores)) {
        $busqueda[$key] = str_replace("\n", "", $busqueda[$key]);
        $busqueda[$key] = str_replace("\r", "", $busqueda[$key]);
        $busqueda[$key] = html_entity_decode($busqueda[$key]);
        $busqueda[$key] = addslashes($busqueda[$key]);
      }
    }
    $resultado[$i] = $busqueda;
  }
  return ($resultado);
}

?>
<!DOCTYPE html>
<html >
<head>
<meta charset="utf-8" />
<style type="text/css">
.arbol_saia>.containerTableStyle {overflow:hidden;}
ul.fancytree-container {
	overflow: auto;
	position: relative;
	border: none !important;
    outline:none !important;
}
span.fancytree-title {
    font-family: Ubuntu, sans-serif;
	font-size: 12px;
}
span.fancytree-checkbox.fancytree-radio {
    vertical-align: middle;
}
span.fancytree-expander {
    vertical-align: middle !important;
}

</style>

	<script type="text/javascript" src="<?= $ruta_db_superior ?>pantallas/generador/editar_componente_generico.js"></script>

</head>
<body>
<h4 class="title" style="margin-top: 20px;">Información general</h4><hr style="margin-top:10px;">
<form name="datos_formato" id="datos_formato">
 <input type="hidden" name="nombre_formato" id="nombre_formato" value="" required>
  <div class="row-fluid">
    <div class="span8">
      <div class="control-group">
        <label class="control-label" for="etiqueta"><strong>Nombre del formato<span class="require-input">*</span></strong></label>
        <div class="controls">
          <input type="text" class="span12" name="etiqueta" id="etiqueta_formato" placeholder="Nombre" value="" required <?php if ($_REQUEST["idformato"]) echo ("readonly"); ?>>
        </div>
      </div>
    </div>
    <div class="span4">
      <div class="control-group">
        <label class="control-label" for="version"><strong>Versi&oacute;n<span class="require-input">*</span></strong></label>
        <div class="controls">
          <input type="text" class="span10" name="version" id="version" placeholder="Versi&oacute;n" value="" required>
        </div>
      </div>
    </div>
  </div>

<?php
$valor_item = 0;
$valor_mostrar = "0";

if ($formato["numcampos"]) {
  $valor_item = $formato[0]["item"];
  $valor_mostrar = $formato[0]["mostrar_pdf"];
  $descripcionFormato = html_entity_decode($formato[0]["descripcion_formato"]);
}
?>

  <input type="hidden" name="item" id="item" value="<?= $valor_item ?>">
  <input type="hidden" name="mostrar_pdf" id="mostrar_pdf" value="<?= $valor_mostrar ?>">
  <div class="row-fluid">

    <div class="span6">
      <div class="control-group">
        <label class="control-label" for="contador"><strong>Consecutivo asociado<span class="require-input">*</span></strong></label>
        <div class="controls">
          <select class="span12" name="contador_idcontador" data-toggle="tooltip" title="Escoja un contador" id="contador_idcontador" required>
          	<?php
          $contadores = busca_filtro_tabla("", "contador", "nombre<>'' and estado=1", "nombre", $conn);
          $reinicia_contador = 1;
          for ($i = 0; $i < $contadores["numcampos"]; $i++) {
            echo ('<option value="' . $contadores[$i]["idcontador"] . '"');
            if ($formato[0]["contador_idcontador"] == $contadores[$i]["idcontador"]) {
              echo (" selected='selected' ");
              $reinicia_contador = $contadores[$i]["reiniciar_cambio_anio"];
            }
            echo ('>' . $contadores[$i]["etiqueta_contador"] . '</option>');
          }
          ?>
          </select>
        </div>
      </div>
    </div>

    <div class="span6">
      <div class="control-group">
        <label class="control-label" for="tipos"><strong>Tipo de registro<span class="require-input">*</span></strong></label>
        <div class="controls">
          <select class="span12" name="tipo_registro" id="tipo_registro" data-toggle="tooltip">
            <option value="">Por favor seleccione</option>
            <option value="1">Documento oficial (PDF)</option>
            <option value="2">Registro de apoyo</option>
            <option value="3">Registro del tipo Item</option>
          </select>
        </div>
      </div>
    </div>


  </div>

  <div class="row-fluid">
    <div class="span12">
      <div class="control-group">
        <label class="control-label" for="descripcion"><strong>Descripci&oacute;n del formato</strong></label>
        <div class="controls">
          <textarea class="span6" name="descripcion_formato" id="descripcion_formato" placeholder="Descripci&oacute;n" rows="3"></textarea>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="control-group">
    <label class="control-label" for="proceso">Proceso al que pertenece*</label>
    <div class="controls">
      <div id="esperando_proceso_pertenece"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
      <div id="treebox_proceso_pertenece" class="arbol_saia"></div>
      <input id="proceso_pertenece" type="hidden" name="proceso_pertenece" required value="<?php echo ($cod_proceso_pertenece); ?>">
      <?php crear_arbol("proceso_pertenece", $ruta_db_superior . "test_serie.php?estado=1&tabla=cf_procesos_formato" . $adicional_cod_proceso); ?>
    </div>
  </div> -->

  <div class="row-fluid"> <!-- FILA SERIE -->
    <div class="span4">
      <div class="control-group">
        <label class="control-label" for="serie_idserie"><strong>Tipo documental asociado</strong></label>
        <div class="controls">
        	<div id="esperando_arbol_serie_formato"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
        	<?php
        $url = $ruta_db_superior . "test_serie.php?tabla=serie&filtrar_arbol=documental&arbol_series=1";
        if ($formato["numcampos"] && !empty($formato[0]["serie_idserie"])) {
          $url .= "&seleccionado=" . $formato[0]["serie_idserie"];
          $datos_serie = busca_filtro_tabla("codigo, nombre", "serie", "idserie=" . $formato[0]["serie_idserie"], "", $conn);
              //echo($datos_serie[0]["nombre"]);

        }
        ?>
          <div id="treebox_arbol_serie_formato" class="arbol_saia"></div>
          <input id="arbol_serie_formato" type="hidden" name="serie_idserie" value="<?= $formato[0]["serie_idserie"] ?>">
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
          <input type="text" id="codigo_serie" value="<?= $datos_serie["numcampos"] ? $datos_serie[0]["codigo"] : '' ?>" disabled="disabled">
        </div>
      </div>
    </div>
    <div class="span4">
      <div class="control-group">
        <label class="control-label" for="mostrar_tipodoc_pdf">&nbsp;</label>
        <div class="controls">
          <input type="checkbox" name="mostrar_tipodoc_pdf" id="mostrar_tipodoc_pdf" value="1" <?php if (@$formato[0]["mostrar_tipodoc_pdf"] == 1) echo (' checked="checked"'); ?>>
             <span id="texto_tipodoc">Mostrar código en el nombre del Formato.</span>
        </div>
      </div>
    </div>

  </div>  <!-- FIN FILA SERIE -->

  <div class="row-fluid">
    <div  class="span12">
      <div class="control-group">
       <label class="control-label" for="codigo_padre" data-toggle="tooltip" title="Seleccione el formato principal al cual pertenece"><strong>Relaci&oacute;n con otro Formato</strong></label>
        <div class="controls">
          <?php echo ($nombre_cod_padre[0]["etiqueta"]); ?>
          <div class="col-auto px-0 mx-0">
            <input id="codigo_padre_formato" type="hidden" name="cod_padre" value="<?php echo ($cod_padre); ?>">
            <?= $arbol->generar_html() ?>
          </div>
         </div>
      </div>
    </div>

  </div>


 <div class="control-group">
    <label class="control-label" for="banderas"><strong>Atributos del formato</strong></label>
    <div class="controls">
      <input type="checkbox" class="tipo_edicion" name="tipo_edicion" id="tipo_edicion" <?php check_banderas('tipo_edicion'); ?>><span class="tipo_edicion">Edicion Continua</span>
      <!--<input type="checkbox" name="mostrar" id="mostrar" <?php check_banderas('mostrar'); ?>>Mostrar-->
      <input type="checkbox" class="paginar" name="paginar" id="paginar" <?php check_banderas('paginar'); ?>><span class="paginar">Paginar al mostrar</span>
      <input type="checkbox" name="banderas[]" id="banderas" <?= check_banderas('aprobacion_automatica'); ?>>Aprobacion Automatica
      <input type="checkbox" name="banderas[]"	style="display:none;" id="banderas" <?php check_banderas('asunto_padre'); ?> checked><!--Tomar el asunto del padre al responder-->
    </div>
  </div>

  <input type="hidden" name="mostrar" id="mostrar" <?php check_banderas('mostrar', false); ?>>
  <input type="hidden" name="paginar" id="paginar" <?php check_banderas('paginar', false); ?>>

<p>&nbsp;</p>
  <h4 class="title" style="margin-top: 20px;">Configuraci&oacute;n de página</h4><hr style="margin-top:10px;">
  <hr>

  <div class="row-fluid">
    <div class="span8"> <!-- COLUMNA IZQUIERDA -->

      <div class="row-fluid">
        <div class="span6">
          <div class="control-group">
            <label class="control-label" for="papel"><strong>Tama&ntilde;o de la p&aacute;gina</strong></label>
            <div class="controls">
              <select name="papel" id="papel">
              	<option value="Letter" <?= $formato[0]["papel"] == "Letter" ? ' selected' : '' ?>>Carta (21,6 cm x 27,9 cm)</option>
              	<option value="Legal" <?= $formato[0]["papel"] == "Legal" ? ' selected' : '' ?>>Legal (21,6 cm x 35,6 cm)</option>
              	<option value="A4" <?= $formato[0]["papel"] == "A4" ? ' selected' : '' ?>>A4 (21,0 cm x 29,7 cm)</option>
              	<option value="A5" <?= $formato[0]["papel"] == "A5" ? ' selected' : '' ?>>Media Carta (14,0 cm x 21,6 cm)</option>
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
              <input type="radio" name="orientacion" id="orientacion_0" value="0" <?php if (!@$formato[0]["orientacion"]) echo (' checked="checked"'); ?>> Vertical  &nbsp;&nbsp;
              <input type="radio" name="orientacion" id="orientacion_1" value="1" <?php if (@$formato[0]["orientacion"]) echo (' checked="checked"'); ?>> Horizontal
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
              $default_font_size = 11;
              if (@$formato["numcampos"]) {
                $default_font_size = $formato[0]["font_size"];
              }

              foreach ($tam_letras as $value) {
                echo ('<option value="' . $value . '"');
                if ($value == $default_font_size) {
                  echo (' selected="selected"');
                }
                echo ('>' . $value . '</option>');
              }
              ?>
              </select>
            </div>
          </div>
        </div>
      </div>

    </div> <!-- FIN COLUMNA IZQUIERDA -->

  	<?php
  $margen_defecto = array(2.5, 2.5, 1.9, 2.5);
  if ($formato["numcampos"] && !empty($formato[0]["margenes"])) {
    $margen_defecto = explode(",", $formato[0]["margenes"]);
    $margen_defecto = array_map(function ($val) {
      return $val / 10; // esta guardado en milimetros
    }, $margen_defecto);
  }
  ?>

    <div class="span4"> <!-- COLUMNA DERECHA -->
      <label class="control-label" for="margenes"><strong>M&aacute;rgenes (cent&iacute;metros)</strong></label>
      <div class="row-fluid">
        <div class="span4">
          <label for="msup">Superior</label>
        </div>
        <div class="span4">
          <div class="controls">
            <input type="number" min="0" max="10" step="0.1" class="input-mini" name="msup" id="msup" value="<?= $margen_defecto[2] ?>">
          </div>
        </div>
      </div> <!-- FIN FILA -->
      <div class="row-fluid">
        <div class="span4">
          <label for="minf">Inferior</label>
        </div>
        <div class="span4">
          <div class="controls">
            <input type="number" min="0" max="10" step="0.1" class="input-mini" name="minf" id="minf" value="<?= $margen_defecto[3] ?>">
          </div>
        </div>
      </div> <!-- FIN FILA -->
      <div class="row-fluid">
        <div class="span4">
          <label for="mizq">Izquierda</label>
        </div>
        <div class="span4">
          <div class="controls">
            <input type="number" min="0" max="10" step="0.1" class="input-mini" name="mizq" id="mizq" value="<?= $margen_defecto[0] ?>">
          </div>
        </div>
      </div> <!-- FIN FILA -->
      <div class="row-fluid">
        <div class="span4">
          <label>Derecha</label>
        </div>
        <div class="span4">
          <div class="controls">
            <input type="number" min="0" max="10" step="0.1" class="input-mini" name="mder" id="mder" value="<?= $margen_defecto[1] ?>">
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
          <?= $arbolCategoria->generar_html() ?>
        </div>
      </div>
    </div>
  </div>

 <div class="control-group">
    <label class="control-label" for="funcion_predeterminada"><strong>Ruta de aprobaci&oacute;n</strong></label>
    <div class="controls">
      Varios responsables <input type="checkbox" name="funcion_predeterminada[]" id="funcion_predeterminada_1" value="1" <?php echo $checkResponsables; ?> data-toggle="tooltip" title="Opción que realiza ruta de aprobación">
    </div>
  </div>

  <div class="row-fluid">
  	<input type="hidden" name="ruta_almacenamiento" id="ruta_almacenamiento_formato" value="{*fecha_ano*}/{*fecha_mes*}/{*idformato*}">
  	<!--input type="hidden" name="prefijo" id="prefijo_formato" value=""-->
  	<input type="hidden" name="idfuncionario" id="idfuncionario" value="<?php echo (usuario_actual("idfuncionario")); ?>">
  	<input type="hidden" name="banderas_formato" id="banderas" value="">
  	<input type="hidden" name="idformato" id="idformato" value="">
    <button type="button" name="adicionar" class="btn btn-info" id="enviar_datos_formato" value="adicionar_datos_formato" style="background: #48b0f7;color:fff;"><span  style="color:fff; background: #48b0f7;">Aceptar</span></button>
    <!-- button type="reset" name="cancelar" class="btn" id="cancelar_formulario_saia" value="cancelar">Cancel</button-->
    <?php if ($_REQUEST["idformato"]) { ?>
    <!-- button type="button" name="eliminar" class="btn btn-danger kenlace_saia_propio" id="eliminar_formulario_saia" enlace="../formatos/generador/eliminar_formato.php?idformato=<?php echo ($_REQUEST['idformato']); ?>" titulo="Eliminar formato" eliminar_hijos="0" value="eliminar">Eliminar</button-->
    <?php
  }
  $texto .= "<input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''>";
  $id_unico = uniqid();
  $texto .= "<input type='hidden' name='form_uuid' id='form_uuid' value='$id_unico'>";
  echo $texto;
  ?>
    <div class="pull-right" id="cargando_enviar"></div>
     </div>
</form>

<?php
//echo(librerias_jquery("1.7"));
echo librerias_notificaciones();

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
  $("input[name='when_is_escrow_set_to_close']").hide();
  if($("#codigo_serie").val()==''){
     $("#mostrar_tipodoc_pdf").hide();
     $("#texto_tipodoc").hide();
  }
  $(".paginar").hide();
	$('[data-toggle="tooltip"]').tooltip();
	/*$("#nombre_formato").blur(function() {
		//console.log($("#nombre_formato").val());
		if($("#nombre_formato").val()) {
			$.ajax({
			    type:'POST',
			    dataType:'json',
			    url: "<?php echo ($ruta_db_superior); ?>pantallas/lib/llamado_ajax.php",
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
        if (valor) {
        	var nombre = normalizar(valor);
        	$("#nombre_formato").val(nombre);
        }
	});
  var descripcion_formato = "<?php echo $descripcionFormato; ?>";
	var formulario = $("#datos_formato");
	var formato=<?php echo (json_encode($formato)); ?>;


	var nombre_formato="";
	if($("#nombre_formato").val()!="") {
		var nombre_formato=$("#nombre_formato").val();
	}

	$("#enviar_datos_formato").click(function(event) {
    event.preventDefault();
		if(formulario.valid()) {

			var buttonAcep = $(this);
			//buttonAcep.attr('disabled', 'disabled');
			//parsear_items();
			$.ajax({
                type:'POST',
                dataType:'json',
                url: "<?php echo ($ruta_db_superior); ?>pantallas/generador/librerias_pantalla.php",
                data: "ejecutar_datos_pantalla="+buttonAcep.attr('value')+"&tipo_retorno=1&rand="+Math.round(Math.random()*100000)+'&'+formulario.serialize()+"&nombre="+nombre_formato,
                success: function(objeto) {
                    if(objeto.exito) {
                        notificacion_saia(objeto.mensaje,'success','topCenter',3000);
                        window.parent.location.href = window.parent.location.pathname+"?idformato="+objeto.idformato;

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
		switch (valor) {
		case "1":
			$("#item").val("0");
			$("#mostrar_pdf").val("1");
      $(".tipo_edicion").show();
      $("input[name='paginar']").attr("checked","checked");
			break;
		case "2":
			$("#item").val("0");
			$("#mostrar_pdf").val("0");
      $(".tipo_edicion").hide();
      $("input[name='paginar']").attr("checked",false);
			break;
		case "3":
			$("#item").val("1");
			$("#mostrar_pdf").val("0");
      $(".tipo_edicion").hide();
			break;
		default:
			$("#item").val("0");
			$("#mostrar_pdf").val("0");
      $("input[name='paginar']").attr("checked",false);
			break;
		}
	});

	if(formato!==null && formato.numcampos) {
        $('#nombre_formato').val(formato[0].nombre);
        $('#etiqueta_formato').val(formato[0].etiqueta);
        //$('#tabla_formato').val(formato[0].tabla);
        $('#descripcion_formato').val(descripcion_formato);
        $('#proceso_pertenece').val(formato[0].proceso_pertenece);
        $('#serie_idserie').val(formato[0].serie_idserie);
        $('#version').val(formato[0].version);
        $('#librerias_formato').val(formato[0].librerias);
        $('#etiqueta_formato').val(formato[0].etiqueta);
        $('#ruta_formato').val(formato[0].ruta_formato);
        $('#ayuda_formato').val(formato[0].ayuda);
        //$('#prefijo_formato').val(formato[0].prefijo);
        $('#ruta_almacenamiento_formato').val(formato[0].ruta_almacenamiento);
        $('#idformato').val(formato[0].idformato);
        $('#tipo_formato_'+formato[0].tipo_formato).attr('checked',"checked");
        $('#versionar_'+formato[0].versionar).attr('checked',"checked");
        $('#accion_eliminar_'+formato[0].accion_eliminar).attr('checked',"checked");
        if(formato[0].tipo_formato==2) {
        	$("#campos_formato").show();
        }
        $('#aprobacion_automatica_'+formato[0].aprobacion_automatica).attr('checked',"checked");
        $('#enviar_datos_formato').val('editar_datos_formato');
  	    $('#tabs_formulario a[href="#datos_formulario-tab"]').tab('show');
  	    $('#componentes_acciones').hide();
  	    $('.nav li').removeClass('disabled');

        var item = formato[0].item;
        var mostrar_pdf = formato[0].mostrar_pdf;
        if(item == 0 && mostrar_pdf == 0) {
        	$("#tipo_registro").val(2);
          $(".tipo_edicion").hide();
        }
        if(item == 0 && mostrar_pdf == 1) {
        	$("#tipo_registro").val(1);
          $(".tipo_edicion").show();
        }
        if(item == 1 && mostrar_pdf == 0) {
        	$("#tipo_registro").val(3);
          $(".tipo_edicion").hide();
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
    if(datos){
      $("#mostrar_tipodoc_pdf").show();
      $("#texto_tipodoc").show();
    }else{
      $("#mostrar_tipodoc_pdf").hide();
      $("#texto_tipodoc").hide();
    }

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

<?php
function check_banderas($bandera, $chequear = true)
{
  global $formato;

  if ($bandera == "aprobacion_automatica") {
    echo ' value="e" ';
    if (strpos($formato[0]["banderas"], "e") !== false) {
      echo ' checked="checked" ';
    }
  } else if ($bandera == "asunto_padre") {
    echo ' value="r" ';
    if (strpos($formato[0]["banderas"], "r") !== false) {
      echo ' checked="checked" ';
    }
  } else if ($bandera && $formato[0][$bandera]) {
    $texto = ' value="' . $formato[0][$bandera] . '"';
    if ($chequear) {
      $texto .= ' checked="checked" ';
    }
    echo $texto;
  }
}

function crear_arbol($nombre, $url, $tipo = "radio")
{
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

  tree_<?php echo ($nombre); ?>=new dhtmlXTreeObject("treebox_<?php echo ($nombre); ?>","100%","",0);
  tree_<?php echo ($nombre); ?>.setImagePath("<?php echo ($ruta_db_superior); ?>imgs/");
  tree_<?php echo ($nombre); ?>.enableTreeImages(false);
  tree_<?php echo ($nombre); ?>.enableTextSigns(true);
  tree_<?php echo ($nombre); ?>.enableIEImageFix(true);
  tree_<?php echo ($nombre); ?>.setOnLoadingStart(cargando_arbol_<?php echo ($nombre); ?>);
  tree_<?php echo ($nombre); ?>.setOnLoadingEnd(fin_cargando_arbol_<?php echo ($nombre); ?>);

  tree_<?php echo ($nombre); ?>.enableCheckBoxes(1);
  <?php if ($tipo == "radio") { ?>
	tree_<?php echo ($nombre); ?>.enableRadioButtons(true);
	tree_<?php echo ($nombre); ?>.setOnCheckHandler(onNodeSelect_<?php echo ($nombre); ?>);
	function onNodeSelect_<?php echo ($nombre); ?>(nodeId) {
		//alert(nodeId);
		var valor_destino=document.getElementById("<?php echo ($nombre); ?>");
		if(tree_<?php echo ($nombre); ?>.isItemChecked(nodeId)) {
			//alert(valor_destino.value);
			if(valor_destino.value!=="") {
				tree_<?php echo ($nombre); ?>.setCheck(valor_destino.value,false);
			}
			if(nodeId.indexOf("_") != -1) {
				nodeId=nodeId.substr(0,nodeId.indexOf("_"));
			}
			valor_destino.value=nodeId;
		} else {
			valor_destino.value="";
		}
	}
  <?php
} else {
  ?>
  tree_<?php echo ($nombre); ?>.setOnCheckHandler(onNodeSelect_check_<?php echo ($nombre); ?>);
  function onNodeSelect_check_<?php echo ($nombre); ?>(nodeId) {
  	var valor_destino=document.getElementById("<?php echo ($nombre); ?>");
	valor_destino.value=tree_<?php echo ($nombre); ?>.getAllChecked();
  }
  <?php

}
?>
  /*tree_<?php echo ($nombre); ?>.enableThreeStateCheckboxes(true);*/


  tree_<?php echo ($nombre); ?>.loadXML("<?php echo ($url); ?>");

  function fin_cargando_arbol_<?php echo ($nombre); ?>(){
		if (browserType == "gecko")
			document.poppedLayer = eval('document.getElementById("esperando_<?php echo ($nombre); ?>")')
		else if (browserType == "ie")
			document.poppedLayer = eval('document.getElementById("esperando_<?php echo ($nombre); ?>")');
		else
			document.poppedLayer = eval('document.layers["esperando_<?php echo ($nombre); ?>"]');
		document.poppedLayer.style.display = "none";
	}
	function cargando_arbol_<?php echo ($nombre); ?>(){
		if (browserType=="gecko")
			document.poppedLayer=eval('document.getElementById("esperando_<?php echo ($nombre); ?>")');
		else if (browserType=="ie")
			document.poppedLayer=eval('document.getElementById("esperando_<?php echo ($nombre); ?>")');
		else
			document.poppedLayer=eval('document.layers["esperando_<?php echo ($nombre); ?>"]');
		document.poppedLayer.style.display="";
	}
});
</script>

</body>
</html>
	<?php

}

?>
