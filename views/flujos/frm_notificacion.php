<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
	if (is_file($ruta . 'db.php')) {
		$ruta_db_superior = $ruta;
	}
	
	$ruta .= '../';
	$max_salida--;
}

include_once $ruta_db_superior . 'assets/librerias.php';

include_once $ruta_db_superior . 'librerias_saia.php';
include_once $ruta_db_superior . 'controllers/autoload.php';
require_once ($ruta_db_superior . "arboles/crear_arbol_ft.php");

//$opciones_arbol = array("keyboard" => true, "onNodeClick" => "evento_click", "busqueda_item" => 1);
$opciones_arbol = array("keyboard" => true, "selectMode" => 2);
$extensiones = array("filter" => array());

$idflujo = null;
if(isset($_REQUEST["idflujo"])) {
	$idflujo = $_REQUEST["idflujo"];
	//$flujo = new Flujo($idflujo);
	$eventos = EventoNotificacion::findAll('', 0, true);
	$tipoTarea = TipoElemento::findByBpmnName(TipoElemento::TIPO_TAREA);
	$actividades = Elemento::findAllByAttributes(["fk_flujo" => $idflujo, "fk_tipo_elemento" => $tipoTarea->idtipo_elemento]);
	$formatoFlujo= FormatoFlujo::conFkFlujo($idflujo);
	$formatos = $formatoFlujo->findFormatosByFlujo();
	$listaIdsFmt = [];
	foreach ($formatos as $fila) {
		$listaIdsFmt[] = $fila["idformato"];
	}
	
	$origen = array("url" => "arboles/arbol_formatos.php", "ruta_db_superior" => $ruta_db_superior,
		"params" => array(
			"seleccionable" => "checkbox",
			"obligatorio" => 1,
			"filtrar" => implode(",", $listaIdsFmt)
		));
	$origenCampos = array("url" => "arboles/arbol_formatos_campos.php", "ruta_db_superior" => $ruta_db_superior,
		"params" => array(
			"obligatorio" => 1,
			"filtrar" => implode(",", $listaIdsFmt)
		));
	$arbolFormato = new ArbolFt("formato_notificacion", $origen, $opciones_arbol, $extensiones);
	$arbolCampos = new ArbolFt("campos_formato_notificacion", $origenCampos, ["keyboard" => true, "selectMode" => 2, "onNodeClick" => "seleccionarCampo"], $extensiones);
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<meta name="description" content="">

    <?= jquery() ?>
    <?= validate() ?>
    <?= bootstrap() ?>
    <?= icons() ?>
    <?= theme() ?>
    <?= librerias_UI("1.12") ?>
    <?= librerias_arboles_ft("2.24")?>

</head>
<body>

	<form id="notificationForm">
	<input type="hidden" name="idnotificacion" id="idnotificacion" value="">
		<fieldset>
			<legend>Definiendo las notificaciones</legend>
			<div class="row mb-2">
				<div class="col col-md-3">
					<label for="sel_tipo_notificacion">Seleccione en que momento se enviar&aacute; la notificaci&oacute;n *</label>
				</div>
				<div class="col col-md-6">
					<select class="form-control" name="idevento_notificacion" id="sel_tipo_notificacion" required>
						<option value="0">Por favor seleccione...</option>
						<?php if(!empty($eventos)) {
							foreach ($eventos as $evento) {
								echo '<option value="' . $evento["idevento_notificacion"] . '">' . $evento["evento"] . '</option>';
							}
						}
						?>
					</select>
				</div>
			</div>
			<div class="row mb-2 tipo_opcion tipo_opcion_1" style="display: none;">
				<div class="col col-md-3">
					<label for="sel_actividad_evento">Elija el cambio de estado</label>
				</div>
				<div class="col col-md-6">
					<select class="form-control" name="actividad_evento" id="sel_actividad_evento">
						<option value="0">Por favor seleccione...</option>
						<?php if(!empty($actividades)) {
							foreach ($actividades as $tarea) {
								echo '<option value="' . $tarea->idelemento . '">' . $tarea->nombre . '</option>';
							}
						}
						?>
					</select>
				</div>
			</div>
			<div class="row mb-2 tipo_opcion tipo_opcion_2" style="display: none;">
				<div class="col col-md-3">
					<label for="sel_formato_evento">Elija el formato asociado</label>
				</div>
				<div class="col col-md-6">
					<select class="form-control" name="formato_evento" id="sel_formato_evento">
						<option value="0">Por favor seleccione...</option>
						<?php if(!empty($formatos)) {
							foreach ($formatos as $formato) {
								echo '<option value="' . $formato["idformato"] . '">' . $formato["etiqueta"] . '</option>';
							}
						}
						?>
					</select>
				</div>
			</div>
			<!-- <div class="tipo_opcion tipo_opcion_3" style="display: none;">
				<label>Elija el formato asociado</label>
			</div> -->
			<div class="row mb-2">
				<div class="col col-md-3">
					<label for="notificacion_asunto">Asunto del email *</label>
				</div>
				<div class="col col-md-9">
					<input type="text" id="asunto_notificacion" name="asunto" required>
				</div>
			</div>
			<div class="row mb-2">
				<div class="col col-md-3">
					<label for="mensaje_notificacion">Mensaje *</label>
				</div>
				<div class="col col-md-5">
					<textarea class="form-control" id="mensaje_notificacion" name="mensaje" required></textarea>
				</div>
				<div class="col col-md-4" style="height:150px; overflow: auto;">
				<?php
				if(!empty($listaIdsFmt)) {
					echo $arbolCampos->generar_html();
				} else {
				    echo 'No ha seleccionado formatos para el proceso';
				}
				?>
				</div>
			</div>

			<div class="row mb-2">
				<div class="col col-md-3">
				    <input type="hidden" id="anexos_notificacion" name="anexos_notificacion" value="">
	    			<label for="dropzone">Adjuntar anexos preestablecidos que se enviar&aacute;n en cada notificaci&oacute;n</label>
				</div>
				<div class="col col-md-9">
				    <div id="dropzone" class="dropzone" data-campo="anexos_notificacion" data-multiple="multiple">
				      <div class="dz-message"><span>Haga clic para elegir un archivo o Arrastre acá el archivo.</span></div>
    				</div>
  				</div>
			</div>
			<div class="row mb-2">
				<div class="col col-md-3">
	    			<label for="formato_notificacion">Elija los Registros que se deben enviar adjunto al email</label>
				</div>
				<div class="col col-md-9">
				<?php
				if(!empty($listaIdsFmt)) {
				    echo $arbolFormato->generar_html();
				} else {
				    echo 'No ha seleccionado formatos para el proceso';
				}
				?>
  				</div>
			</div>

		</fieldset>
		<button type="button" class="btn btn-primary btn-sm" id="guardarNotificacion">Guardar notificaci&oacute;n</button>
	</form>
	
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownDestinatario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Adicionar destinatario
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownDestinatario">
    <a class="dropdown-item tipo1" href="#" data-toggle="modal">Funcionarios de la Organizaci&oacute;n</a>
    <a class="dropdown-item" href="#">Asociado a campos de registros</a>
    <a class="dropdown-item" href="#">Personas externas</a>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalTipoNotificacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width: auto;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Destinatarios de correo de la Organización</h4>
      </div>
      <div class="modal-body">
          <iframe id="frameTipoNotificacion" src="<?= $ruta_db_superior ?>views/flujos/modal_persona_saia.php" width="600" height="400" frameborder="0" allowtransparency="true"></iframe>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <!-- <button type="button" class="btn btn-primary">Guardar cambios</button>  -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript" data-params='{"idflujo" : "<?= $idflujo?>"}'>
	//var $table = $('#tabla_notificaciones');
	//$table.bootstrapTable();

$(function(){
   	var idflujo = $("script[data-idflujo]").data("idflujo");
    console.log("notificacion", "idflujo", idflujo);

	$(".tipo1").click(function() {
		var idnotificacion = $("#idnotificacion").val();
		if(idnotificacion) {
			var $iframe = $('#frameTipoNotificacion');
			var url = "<?= $ruta_db_superior ?>views/flujos/modal_persona_saia.php?idnotificacion=" + idnotificacion;
		    if ($iframe.length) {
		        $iframe.attr('src', url);   
				$('#modalTipoNotificacion').modal('show');
		    }
		} else {
			var idnotificacion = guardarNotificacion();
			console.log(idnotificacion);
		}
		
	});
    
	$("#guardarNotificacion").click(guardarNotificacion());

	$.each(['show', 'hide'], function (i, ev) {
	    var el = $.fn[ev];
	    $.fn[ev] = function () {
	      this.trigger(ev);
	      return el.apply(this, arguments);
	    };
	});

	$("#sel_tipo_notificacion").change(function() {
		var tipo = $(this).val();
		if(tipo == 3) {
			tipo = 2;
		}
		var nombre = "tipo_opcion_" + tipo;
		$("." + nombre).show();
		$(".tipo_opcion").each(function(){
			if(!$(this).hasClass(nombre)) {
				$(this).hide();
			}
		});
	});
	$('.tipo_opcion').on('show', function() {
	      //console.log('#foo is now visible');
	});
	$('.tipo_opcion').on('hide', function() {
	      //console.log('#foo is hidden');
	});


	function guardarNotificacion() {
		if($("#notificationForm").valid()) {
			var formData = new FormData(document.getElementById("notificationForm"));
			formData.append('key', localStorage.getItem("key"));
			//var idflujo = $("#idflujo").val();
			if(idflujo && idflujo != "") {
				formData.append('idflujo', idflujo);
			}
			for (var pair of formData.entries()) {
		    	console.log(pair[0]+ ' => ' + pair[1]);
			}
			return false;
			$.ajax({
				dataType: "json",
				url: "<?= $ruta_db_superior ?>app/flujo/guardarNotificacion.php",
				type: "POST",
				data: formData,
				async: false,
				processData: false,  // tell jQuery not to process the data
				contentType: false,  // tell jQuery not to set contentType
				success: function(response) {
				  if(response["success"] == 1) {
					$('#tabla_notificaciones').bootstrapTable('refresh', {url: "listado_notificaciones.php?idflujo="+idflujo});
					top.notification({type: "success", message: response.message});
				  } else {
					  top.notification({type: "error", message: response.message});
				  }
				}
			});
		}
	}
	
	function ajaxRequest(params) {

	    // data you may need
	    console.log(params.data);

	    $.ajax({
	        type: "POST",
	        url: "listado_notificaciones.php",
	        data: "idflujo=1",
	// You are expected to receive the generated JSON (json_encode($data))
	        dataType: "json",
	        success: function (data) {
	            params.success({
	// By default, Bootstrap table wants a "rows" property with the data
	                "rows": data,
	// You must provide the total item ; here let's say it is for array length
	                "total": data.total
	            })
	        },
	        error: function (er) {
	            params.error(er);
	        }
	    });
	}
});

function seleccionarCampo(event, data) {
	//var elemento_evento = $.ui.fancytree.getEventTargetType(event.originalEvent);
    console.log(event, data);
    if(!data.node.isFolder()) {
		//alert("it works");
		let tag = '{*' + data.node.data.nombre + '*}';
		var area = $("#mensaje_notificacion");

	    var cursorPos = area.prop('selectionStart');
	    var v = area.val();
	    var textBefore = v.substring(0,  cursorPos);
	    var textAfter  = v.substring(cursorPos, v.length);

	    area.val(textBefore + tag + textAfter);
	}
}

</script>

	
