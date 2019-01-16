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
?>
<form>
  <div class="form-group">
    <label for="flow_file">Adjuntar definici&oacute;n del proceso</label>
    <div id="flow_file" class="dropzone" data-multiple="simple" data-extensiones=".bpmn">
      <div class="dz-message"><span>Haga clic para elegir un archivo o Arrastre acá el archivo.</span></div>
    </div>
  </div>

</form>
<script src="<?= $ruta_db_superior ?>views/flujos/js/flujos.js"></script>

<div id="canvas"></div>

<button id="save-button">Guardar diagrama</button>

<script>

    var diagramUrl = '<?= $ruta_db_superior ?>/views/flujos/flujo_ejemplo.bpmn';

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
  	  'element.out',*/
  	  'element.click',
  	  'element.dblclick',
  	  /*'element.mousedown',
  	  'element.mouseup'*/
  	];

    events.forEach(function(event) {
        eventBus.on(event, function(e) {
  	    // e.element = the model element
  	    // e.gfx = the graphical element
  	    var tipoElem = e.element.businessObject.$type;
  	    if(tipoElem == "bpmn:Task" || /Gateway/.test(tipoElem) ) {
  	    	canvas.addMarker(e.element, 'highlight');
  	    }
  	    //console.log(event, 'on', e.element);
  	    console.log(e.element.businessObject);
  	  });
  	});

    /**
     * Save diagram contents and print them to the console.
     */
    function exportDiagram() {

      bpmnModeler.saveXML({ format: true }, function(err, xml) {

        if (err) {
          return console.error('could not save BPMN 2.0 diagram', err);
        }

        alert('Diagram exported. Check the developer tools!');

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
          html: '<div class="diagram-note">Mixed up the labels?</div>'
        });

        // add marker
        canvas.addMarker('SCAN_OK', 'needs-discussion');
      });
    }


    // load external diagram file via AJAX and open it
    $.get(diagramUrl, openDiagram, 'text');

    // wire save button
    $('#save-button').click(exportDiagram);
</script>
