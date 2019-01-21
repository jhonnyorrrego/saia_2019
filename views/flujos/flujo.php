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

include_once ($ruta_db_superior . "librerias_saia.php");
include_once ($ruta_db_superior . "arboles/crear_arbol_ft.php");

//echo librerias_arboles_ft("2.24", 'filtro');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>SAIA - SGDEA</title>
<link rel="stylesheet" type="text/css" href="<?php echo $ruta_db_superior;?>css/selectize.css" />
<link href="<?= $ruta_db_superior ?>dropzone/dist/dropzone_saia.css" rel="stylesheet" type="text/css">

    <!-- required modeler styles -->
    <link rel="stylesheet" href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bpmn-js/3.1.0/assets/diagram-js.css">
    <link rel="stylesheet" href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bpmn-js/3.1.0/assets/bpmn-font/css/bpmn.css">

    <!-- modeler distro -->
    <?= bpmnModeler() ?>
    <!-- <script src="https://unpkg.com/bpmn-js@3.1.0/dist/bpmn-modeler.development.js"></script>  -->

    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= icons() ?>
    <?= theme() ?>
    <?= librerias_UI("1.12") ?>
    <?= librerias_arboles_ft("2.24")?>

<script type="text/javascript" src="<?php echo $ruta_db_superior;?>js/selectize.js"></script>

<style type="text/css">
ul.fancytree-container {
    border: none;
}

#canvas {
    height: 100%;
    padding: 0;
    margin: 0;
}

.diagram-note {
    background-color: rgba(66, 180, 21, 0.7);
    color: White;
    border-radius: 5px;
    font-family: Arial;
    font-size: 12px;
    padding: 5px;
    min-height: 16px;
    width: 50px;
    text-align: center;
}

.needs-discussion:not(.djs-connection) .djs-visual > :nth-child(1) {
    stroke: rgba(66, 180, 21, 0.7) !important; /* color elements as red */
}

#save-button {
    position: fixed;
    bottom: 20px;
    left: 20px;
}

.highlight:not(.djs-connection) .djs-visual > :nth-child(1) {
  fill: yellow !important; /* color elements as green */
}

.form-group label {
letter-spacing: unset !important;
}

.table thead tr th {
letter-spacing: unset !important;
}

</style>
</head>
<body>
    <div class="container-fluid px-0 mx-0">
        <div class="row mx-0">
            <div class="col-12">
                <ul class="nav nav-pills nav-fill" id="tab_flujos">
                  <li class="nav-item">
                    <a class="nav-link active etiqueta_titulo" id="pills-flow_info" data-url="flow_info.php" data-toggle="pill" href="#flow_info" role="tab" aria-controls="flow_info" aria-selected="true">Informaci&oacute;n</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link etiqueta_titulo" id="pills-flow_diagram" data-url="flow_editor.php" data-toggle="pill" href="#flow_diagram" role="tab" aria-controls="flow_diagram" aria-selected="false">Flujo de proceso</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link etiqueta_titulo" id="pills-flow_notification" data-url="flow_notification.php" data-toggle="pill" href="#flow_notification" aria-controls="flow_notification" aria-selected="false">Notificaciones</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled etiqueta_titulo" id="pills-flow_view" data-toggle="pill" href="#flow_view" aria-controls="flow_view" aria-selected="false">Vista previa</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="flow_info" role="tabpanel" aria-labelledby="pills-flow_info" style="overflow-y: scroll; height: 650px; width=100%">...</div>
                  <div class="tab-pane fade" id="flow_diagram" role="tabpanel" aria-labelledby="pills-flow_diagram" style="overflow-y: scroll; height: 650px; width=100%">...</div>
                  <div class="tab-pane fade" id="flow_notification" role="tabpanel" aria-labelledby="pills-flow_notification">...</div>
                  <div class="tab-pane fade" id="flow_view" role="tabpanel" aria-labelledby="pills-flow_view">...</div>
                </div>
            </div>
        </div>
    </div>

<input type="hidden" id="idflujo" name="idflujo" value="<?= $idflujo ?>">

<script src="<?= $ruta_db_superior ?>dropzone/dist/dropzone.js"></script>

<script type="text/javascript">
var lista_archivos = new Object();

$(document).ready(function() {
    /*$('a[data-toggle="pill"]').on('show.bs.tab', function (e) {
        console.log(e.target); // newly activated tab
        console.log(e.relatedTarget); // previous active tab
    })*/

    $('#flow_info').load($('a.active').attr("data-url"), function(result) {
        console.log(result);
    	$('a.active').tab('show');
    });

    $("#pills-flow_info").trigger("click");
    $('#tab_flujos a').on('click', function (e) {
        //e.preventDefault();
        //console.log(e);

        var url = $(this).attr("data-url");
        var href = this.hash;
        var pane = $(this);
    	// ajax load from data-url
    	//TODO: Activar para produccion
    	//if(url && !$(href).children().length) {
    	if(url) {
        	$(href).load(url,function(result) {
    	    	pane.tab('show');
    		});
    	}
	});
});
</script>
</body>
</html>