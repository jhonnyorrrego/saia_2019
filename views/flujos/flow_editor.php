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

$idflujo = null;
if(isset($_REQUEST["idflujo"])) {
    $idflujo = $_REQUEST["idflujo"];
}

?>
<form>
  <div class="form-group">
    <label for="flow_file">Adjuntar definici&oacute;n del proceso</label>
    <div id="flow_file" class="dropzone dz-clickable" data-multiple="simple" data-extensiones=".bpmn">
      <div class="dz-message"><span>Haga clic para elegir un archivo o Arrastre acá el archivo.</span></div>
    </div>
  </div>

</form>

<div id="canvas"></div>

<button type="button" class="btn btn-primary btn-sm" id="save-button">Guardar diagrama</button>

<script>

    var diagramUrl = '<?= $ruta_db_superior ?>views/flujos/flujo_ejemplo.bpmn';

    // modeler instance
    var bpmnModeler = new BpmnJS({
      container: document.querySelector('#canvas'),
      keyboard: {
        bindTo: window
      }
    });

    var elementRegistry = bpmnModeler.get('elementRegistry');
    var element1 = elementRegistry.get('sid-52EB1772-F36E-433E-8F5B-D5DFD26E6F26');
    var elements = elementRegistry.getAll();
    console.log(elementRegistry);

    var modeling = bpmnModeler.get('modeling');
    var canvas = bpmnModeler.get('canvas');

    //canvas.addMarker(element1, 'highlight');
    //canvas.addMarker('', 'highlight');

    var eventBus = bpmnModeler.get('eventBus');

    var events = [
  	  /*'element.hover',
  	  'element.out',
  	  'element.click',*/
  	  'element.dblclick',
  	  /*'element.mousedown',
  	  'element.mouseup'*/
  	];

    events.forEach(function(event) {
        eventBus.on(event, function(e) {
  	    // e.element = the model element
  	    // e.gfx = the graphical element
  	    var objeto = e.element.businessObject;
  	    var tipoElem = e.element.businessObject.$type;
  	    var id = 1;
  	    if(tipoElem == "bpmn:Task" || /Gateway/.test(tipoElem) ) {
  	    	canvas.addMarker(e.element, 'highlight');
  	    	top.topModal({
  	  	    	title: "Opciones de la tarea",
  	  	    	url: "<?= $ruta_db_superior ?>views/flujos/modal_datos_tarea.php",
  	  	    	params: {idflujo: id, idtarea: e.element.id, nombreTarea: objeto.name}
	  	    });
  	    }
  	    //console.log(event, 'on', e.element);
  	    //console.log(e.element.businessObject);
  	    console.log(e.element);
  	  });
  	});

    /**
     * Save diagram contents and print them to the console.
     */
    function exportDiagram() {
        bpmnModeler.saveXML({ format: true }, function(err, xml) {
        if (err) {
        	//console.error('No se pudo guardar el digagraam BPMN 2.0', err);
        	top.notification({type: "error", message: "No se pudo guardar el digagraam BPMN 2.0"});
          // return console.error('No se pudo guardar el digagraam BPMN 2.0', err);
        }
        console.log(bpmnModeler); return false;

        $.ajax({
            url: 'test.jsp',
            processData: false,
            type: "POST",  // type should be POST
            data: {datos: xml, idflujo: id},// send the string directly
            success: function(response) {
                if(response.status == 1) {
                	top.notification({type: "success", message: response.message});
                } else {
                	top.notification({type: "error", message: response.message});
                }
            },
            error: function(response) {
            	top.notification({type: "error", message: response.message});
            }
         });
        console.log('DIAGRAM', xml);
      });
    }

    /**
     * Open diagram in our modeler instance.
     *
     * @param {String} bpmnXML diagram to display
     */
    function openDiagram(bpmnXML) {

      // import diagram
      bpmnModeler.importXML(bpmnXML, function(err) {

        if (err) {
          return console.error('could not import BPMN 2.0 diagram', err);
        }

        // access modeler components
        var canvas = bpmnModeler.get('canvas');
        var overlays = bpmnModeler.get('overlays');


        // zoom to fit full viewport
        canvas.zoom('fit-viewport');

        // attach an overlay to a node
        overlays.add('SCAN_OK', 'note', {
          position: {
            bottom: 0,
            right: 0
          },
          html: '<div class="diagram-note">Mezcladas las etiquetas?</div>'
        });

        // add marker
        canvas.addMarker('SCAN_OK', 'needs-discussion');
      });
    }

$(function() {

	// load external diagram file via AJAX and open it
    $.get(diagramUrl, openDiagram, 'text');

    // wire save button
    $('#save-button').click(exportDiagram);

    var upload_url = 'cargar_archivos_flujo.php';
    Dropzone.autoDiscover = false;
    var lista_archivos = new Object();
    Dropzone.autoDiscover = false;
    $('.dropzone').each(function () {
    	var idcampo = $(this).attr('id');
    	var paramName = $(this).attr('name');
    	var idcampoFormato = $(this).data('idcampo-formato');
    	var extensiones = $(this).data('extensiones');
    	var multiple_text = $(this).data('multiple');
    	var multiple = false;
    	var form_uuid = $('#form_uuid').val();
    	var maxFiles = 1;
    	if(multiple_text == 'multiple') {
    		multiple = true;
    		maxFiles = 10;
    	}
        var opciones = {
        	autoProcessQueue: false,
        	ignoreHiddenFiles : true,
        	maxFiles : maxFiles,
        	acceptedFiles: extensiones,
       		addRemoveLinks: true,
       		dictRemoveFile: 'Quitar anexo',
       		dictMaxFilesExceeded : 'No puede subir mas archivos',
       		dictResponseError : 'El servidor respondio con codigo {{statusCode}}',
       		dictDefaultMessage: 'Haga clic para elegir un archivo o Arrastre acá el archivo.',
       		dictInvalidFileType: "No puede cargar archivos de este tipo",
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
                if($('#dz_campo_'+idcampoFormato).find('label.error').length) {
                    $('#dz_campo_'+idcampoFormato).find('label.error').remove()
                }
            },
            accept: function(file, done) {
                var reader = new FileReader();
                var dz = this;

                reader.addEventListener("loadend", function(event) {
                    //console.log(event.target.result);
                    openDiagram(event.target.result);
                    dz.removeFile(file);
                });
                reader.readAsText(file);
            }
        };
        let dropzoneControl = $(this)[0].dropzone;
        if (!dropzoneControl) {
        	$(this).dropzone(opciones);
        	$(this).addClass('dropzone');
            //dropzoneControl.destroy();
        }
    });

});
</script>
