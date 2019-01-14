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
<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css">

    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= icons() ?>
    <?= theme() ?>
    <?= librerias_UI("1.12") ?>
    <?= librerias_arboles_ft("2.24")?>

<script type="text/javascript" src="<?php echo $ruta_db_superior;?>js/selectize.js"></script>

</head>
<body>
<ul class="nav nav-pills nav-fill" id="tab_flujos">
  <li class="nav-item">
    <a class="nav-link active" id="pills-flow_info" data-url="flow_info.php" data-toggle="pill" href="#flow_info" role="tab" aria-controls="flow_info" aria-selected="true">Informaci&oacute;n</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-flow_diagram" data-toggle="pill" href="#flow_diagram" role="tab" aria-controls="flow_diagram" aria-selected="false">Flujo de proceso</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-flow_notification" data-toggle="pill" href="#flow_notification" aria-controls="flow_notification" aria-selected="false">Notificaciones</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" id="pills-flow_view" data-toggle="pill" href="#flow_view" aria-controls="flow_view" aria-selected="false">Vista previa</a>
  </li>
</ul>

<div class="container">
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="flow_info" role="tabpanel" aria-labelledby="pills-flow_info" style="overflow-y: scroll; height: 650px">...</div>
      <div class="tab-pane fade" id="flow_diagram" role="tabpanel" aria-labelledby="pills-flow_diagram">...</div>
      <div class="tab-pane fade" id="flow_notification" role="tabpanel" aria-labelledby="pills-flow_notification">...</div>
      <div class="tab-pane fade" id="flow_view" role="tabpanel" aria-labelledby="pills-flow_view">...</div>
    </div>
</div>

<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/dropzone.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    /*$('a[data-toggle="pill"]').on('show.bs.tab', function (e) {
        console.log(e.target); // newly activated tab
        console.log(e.relatedTarget); // previous active tab
    })*/

    $("#pills-flow_info").trigger("click");
    $('#tab_flujos a').on('click', function (e) {
        //e.preventDefault();
        //console.log(e);

        var url = $(this).attr("data-url");
        var href = this.hash;
        var pane = $(this);
    	// ajax load from data-url
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