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

include_once $ruta_db_superior . 'librerias_saia.php';
include_once $ruta_db_superior . 'controllers/autoload.php';
require_once ($ruta_db_superior . "arboles/crear_arbol_ft.php");

echo estilo_tabla_bootstrap("1.13");

echo librerias_tabla_bootstrap("1.13", false, false);

//$opciones_arbol = array("keyboard" => true, "onNodeClick" => "evento_click", "busqueda_item" => 1);
$opciones_arbol = array("keyboard" => true, "selectMode" => 2);
$extensiones = array("filter" => array());

$idflujo = null;
if(isset($_REQUEST["idflujo"])) {
	$idflujo = $_REQUEST["idflujo"];
	//$flujo = new Flujo($idflujo);
	$tipoTarea = TipoElemento::findByBpmnName(TipoElemento::TIPO_TAREA);
	$formatoFlujo= FormatoFlujo::conFkFlujo($idflujo);
	$formatos = $formatoFlujo->findFormatosByFlujo();
	$listaIdsFmt = [];
	foreach ($formatos as $fila) {
		$listaIdsFmt[] = $fila["idformato"];
	}
	
}

?>
<div>
	<p>Permite la configuración y personalización del envío de
		notificaciones en tiempo real a usuario del Sistema o usuarios
		externos notificando el cambio de estado y/o enviando documentación
		que se haya creado.</p>
</div>
<div>
	<button type="button" id="crearNotificacion"
		class="btn btn-primary btn-sm">Crear notificaci&oacute;n</button>
</div>
<div id="notificacion_frm" style="display: none">
	<script src="<?= $ruta_db_superior ?>views/flujos/js/flujos.js"></script>
</div>

<!-- data-url="<?= $ruta_db_superior ?>/views/flujos/listado_notificaciones.php?idflujo=<?= $idflujo?>" -->
<table id="tabla_notificaciones"

  data-toggle="table"
  data-url="listado_notificaciones.php?idflujo=<?= $idflujo?>"
  data-height="400"
  data-side-pagination="server"
  data-pagination="true"
  data-page-list="[5, 10, 20, 50, 100, 200]"
  data-search="true">
	<thead>
		<tr>
			<th data-field="">Acci&oacute;n para la notificaci&oacute;n</th>
			<th>Asunto</th>
			<th>Destinatario</th>
			<th></th>
		</tr>
	</thead>
</table>

<script type="text/javascript" data-params='{"idflujo" : "<?= $idflujo?>"}'>
	//var $table = $('#tabla_notificaciones');
	//$table.bootstrapTable();

$(function(){
   	var idflujo = $("script[data-idflujo]").data("idflujo");
    console.log("notificacion", "idflujo", idflujo);

	$("#crearNotificacion").click(function() {
        if($("#notificacion_frm").is(":visible")) {
        	$("#notificacion_frm").empty();
        	$("#notificacion_frm").hide();
        } else {
        	$("#notificacion_frm").show();
            $('#notificacion_frm').append('<div id="iframe"><iframe src="frm_notificacion.php?idflujo=<?= $idflujo ?>" width="80%" height="600" frameborder="0"></iframe></div>');
        }
		//$("#notificacion_frm").toggle();
	});
});

</script>
