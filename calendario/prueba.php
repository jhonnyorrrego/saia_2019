<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
	if (is_file($ruta . 'db.php')) {
		$ruta_db_superior = $ruta;
		break;
	}

	$ruta .= '../';
	$max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';
include_once $ruta_db_superior . 'assets/librerias.php';

?>
<!DOCTYPE html>
<html>

<head>
	<?= jquery() ?>
	<?= bootstrap() ?>
	<meta charset='utf-8' />
	<!-- Se debe reemplazar las librerias y verificar que mas puede afectar el cambio 
  La libreria gcalc.js es para poner en funcionamiento los calendarios de google
  Se debe  
  
  -->
	<link href='<?php echo ($ruta_db_superior); ?>/css/fullcalendar.min.css' rel='stylesheet' />
	<link href='<?php echo ($ruta_db_superior); ?>/css/fullcalendar.print.css' rel='stylesheet' media='print' />
	<link href='<?php echo $ruta_db_superior ?>anexosdigitales/highslide-4.0.10/highslide/highslide.css' rel='stylesheet' />
	<script type="text/javascript" src="<?php echo $ruta_db_superior ?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
	<script src='<?php echo ($ruta_db_superior); ?>js/moment.min.js'></script>
	<script src='jquery-ui.custom.min.js'></script>
	<script src='<?php echo ($ruta_db_superior); ?>js/fullcalendar.min.js'></script>
	<script src='es.js'></script>
	<script type='text/javascript'>
		hs.graphicsDir = '<?php echo $ruta_db_superior ?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
		hs.outlineType = 'rounded-white';
	</script>
	<?php
	echo (bootstrap());

	$configuracion = array();
	if (@$_REQUEST["iddoc"]) {
		if (!$_REQUEST["iddoc"])
			$_REQUEST["iddoc"] = @$_REQUEST["iddoc"];
		include_once($ruta_db_superior . "pantallas/documento/menu_principal_documento.php");
		menu_principal_documento($_REQUEST["iddoc"]);
	}
	if ($_REQUEST['idcalendario'] != '') {
		/*
   * busca la configuracioón en la DB con el $_REQUEST['idcalendario]  
   */
		$configuracion = busca_filtro_tabla(fecha_db_obtener('fecha') . ' AS fecha, tipo, estilo, datos, encabezado_izquierda, encabezado_centro, encabezado_derecho, adicionar_evento ', "calendario_saia", "idcalendario_saia=" . $_REQUEST['idcalendario'], "");
		//$calendario_fun=busca_filtro_tabla("idcalendario_saia","calendario_saia","","");


		if ($configuracion[0]['fecha'] == '0000-00-00') {
			$configuracion[0]['fecha'] = date('Y-m-d');
		}
		$fecha = date_parse($configuracion[0]['fecha']);
	} else {
		?>
		<script type="text/javascript">
			alert('No se encuentra la configuración del calendario');
		</script>
	<?php
	}
	?>
	<script>
		$(document).ready(function() {
			/* initialize the external events
			-----------------------------------------------------------------*/
			$('#external-events .fc-event').each(function() {
				// store data so the calendar knows to render an event upon drop
				$(this).data('event', {
					title: $.trim($(this).text()), // use the element's text as the event title
					stick: true // maintain when user navigates (see docs on the renderEvent method)
				});
				// make the event draggable using jQuery UI
				$(this).draggable({
					zIndex: 999,
					revert: false, // will cause the event to go back to its
					revertDuration: 0 //  original position after the drag
				});
			});
			/* initialize the calendar
			-----------------------------------------------------------------*/
			var adicionar_evento = "<?php echo $configuracion[0]['adicionar_evento'] ?>";
			switch ("<?php echo $configuracion[0]['tipo']; ?>") {
				case '1':
					viewCalendar = 'basicDay';
					break;
				case '2':
					viewCalendar = 'basicWeek';
					break;
				default:
					viewCalendar = 'month';
			}
			$('#calendar').fullCalendar({

				defaultView: viewCalendar,
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
				editable: true,
				lang: "es",
				droppable: true, // this allows things to be dropped onto the calendar
				drop: function() {
					$(this).remove();
				},
				events: function(start, end, timezone, callback) {
					$.ajax({
						url: "<?php echo $configuracion[0]['datos']; ?>",
						data: 'start=' + start.toISOString() + '&end=' + end.toISOString() + "&iddoc=<?php echo ($_REQUEST['iddoc']) ?>",
						success: function(datos) {
							var events = [];
							var objeto = jQuery.parseJSON(datos);
							if (objeto.exito) {
								$.each(objeto.rows, function(i, item) {
									events.push({
										id: item.id,
										title: item.titulo,
										start: item.inicio,
										end: item.fin,
										url: item.url,
										color: item.color,
									});
								});
							}
							/*carga los eventos en el calendario
							 */
							callback(events);
						}
					});
				},
				dayClick: function(date, jsEvent, view) {
					alert("AQUI");
					hs.htmlExpand(null, {
						contentId: 'cuerpo',
						src: adicionar_evento + '&fecha=' + date.toISOString(),
						objectType: 'iframe',
						//outlineWhileAnimating: true,
						width: 500
					});
				},
				eventClick: function(calEvent, jsEvent, view) {
					jsEvent.preventDefault();
					console.log(this);
					console.log(calEvent);
					hs.htmlExpand(null, {
						contentId: 'cuerpo',
						src: adicionar_evento + '&fecha=' + calEvent.id,
						objectType: 'iframe',
						//outlineWhileAnimating: true,
						width: 500
					});
				}
			});
		});
	</script>
	<style>
		body {
			margin-top: 40px;
			text-align: center;
			font-size: 14px;
			font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
		}

		#wrap {
			width: 1100px;
			margin: 0 auto;
		}

		#external-events {
			float: left;
			width: 150px;
			padding: 0 10px;
			border: 1px solid #ccc;
			background: #eee;
			text-align: left;
		}

		#external-events h4 {
			font-size: 16px;
			margin-top: 0;
			padding-top: 1em;
		}

		#external-events .fc-event {
			margin: 10px 0;
			cursor: pointer;
		}

		#external-events p {
			margin: 1.5em 0;
			font-size: 11px;
			color: #666;
		}

		#external-events p input {
			margin: 0;
			vertical-align: middle;
		}

		#calendar {
			float: right;
			width: 900px;
		}
	</style>
</head>

<body>
	<div id='wrap'>
		<div id='external-events'>
			<h4>Mis tareas pendientes</h4>
			<div class='fc-event'>My Event 1</div>
			<div class='fc-event'>My Event 2</div>
			<div class='fc-event'>My Event 3</div>
			<div class='fc-event'>My Event 4</div>
			<div class='fc-event'>My Event 5</div>
		</div>
		<div id='calendar'></div>
		<div style='clear:both'></div>
	</div>
</body>

</html>