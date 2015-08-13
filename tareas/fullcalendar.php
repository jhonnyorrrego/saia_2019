<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<link rel='stylesheet' type='text/css' href='../css/tema_fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='../css/fullcalendar.css' />
<script type='text/javascript' src='../js/jquery0.js'></script>
<script type='text/javascript' src='../js/ui.core.js'></script>
<script type='text/javascript' src='../js/ui.draggable.js'></script>
<script type='text/javascript' src='../js/ui.resizable.js'></script>
<script type='text/javascript' src='../js/fullcalendar.min.js'></script>
<script type='text/javascript'>
/*
<Clase>
<Nombre>Calendario</Nombre>
<Parametros>
admin:permite modificar drag/drop de los eventos;
estado:define el estado de la busqueda en las tareas, vencidas,en_ejecucion,pendientes;
tipo_busqueda:define la asignacion que debe buscar asignacion,festivos,pendientes
</Parametros>
<Responsabilidades><Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
	$(document).ready(function() {
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();                 
		var name = $("#name"),
			email = $("#email"),
			password = $("#password"),
			allFields = $([]).add(name).add(email).add(password);
		$('#calendar').fullCalendar({
			theme: true,
			dayClick: function(date, allDay, jsEvent, view) {
        $('#dialog').dialog('open');
    },
			header: {
				left: 'today',
				center: 'prevYear,prev,title,next,nextYear',
				right: 'month,agendaWeek,agendaDay'
			},
			monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
	    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
	    dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
	    dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
      buttonText: {
        prev: '&nbsp;&#9668;&nbsp;',
        next: '&nbsp;&#9658;&nbsp;',
        prevYear: '&nbsp;&lt;&lt;&nbsp;',
        nextYear: '&nbsp;&gt;&gt;&nbsp;',
        today: 'Hoy',
        month: 'Mes',
        week: 'Semana',
        day: 'D&iacute;a'
      },
      <?php if(@$_REQUEST["admin"]) echo('editable: true,'); ?>
      events: "asignaciones_calendario.php?random="+Math.floor(Math.random()*11)+"<?php if(@$_REQUEST["tipo_busqueda"])echo('&tipo_busqueda='.$_REQUEST["tipo_busqueda"]);if(@$_REQUEST["estado"])echo('&estado='.$_REQUEST["estado"]); ?>",
      /*eventSources: [
        $("#calendar").fullCalendar.gcalFeed("http://www.google.com/calendar/feeds/dhemian@gmail.com/public/basic")
    ],*/
      loading: function(bool) {
				if (bool) $('#loading').show();
				else $('#loading').hide();
			},
      eventDrop: function(event, delta) {
				$.ajax({
        type:'POST',
        url:'actualizar_tarea.php',
        data:'idtarea='+event.id+"&delta="+delta,
        success: function(datos,exito){
          $.ajax({
            type:'POST',
            url:'actualizar_tarea_unica.php',
            data:'idasignacion='+event.id,
            success: function(datos,exito){
              event.title=datos;
              alert('La asignacion '+event.title + ' ha sido movida ' + delta + ' dias\n');
              $("#calendar").fullCalendar('renderEvent', event )
            }
            });
        }
        });
			}
		});
		$("#dialog").dialog({
			bgiframe: true,
			autoOpen: false,
			height: 300,
			modal: true,
			buttons: {
        Crear: function() {
					$(this).dialog('close');
				},
        Cancelar: function() {
					$(this).dialog('close');
				}
			},
			close: function() {
				allFields.val('').removeClass('ui-state-error');
			}
		});
		<?php if(@$_REQUEST["admin"]){ echo("$('#admin').attr('disabled', 'disabled');");} ?>
		<?php if(@$_REQUEST["estado"]=="vencidas"){ echo("$('#vencidas').attr('disabled', 'disabled');");} ?>
		<?php if(@$_REQUEST["estado"]=="en_ejecucion"){ echo("$('#en_ejecucion').attr('disabled', 'disabled');");} ?>
		<?php if(@$_REQUEST["tipo_busqueda"]=="asignacion"){ echo("$('#asignacion').attr('disabled', 'disabled');");} ?>
		<?php if(@$_REQUEST["tipo_busqueda"]=="festivos"){ echo("$('#festivos').attr('disabled', 'disabled');");} ?>
    <?php if(@$_REQUEST["tipo_busqueda"]=="doc_pendientes"){ echo("$('#doc_pendientes').attr('disabled', 'disabled');");} ?>
	});
function enviar(opcion,valor){
  window.open(window.location+'&'+opcion+'='+valor,'_self');
}
</script>
<style type='text/css'>
	body {
		margin-top: 40px;
		text-align: center;
		font-size: 13px;
		font-family: Verdana,Helvetica,Arial,sans-serif;
		}
	#calendar {
		width: 600px;
		margin: 0 auto;
		}
		label, input { display:block; }
		input.text { margin-bottom:12px; width:95%; padding: .4em; }
		fieldset { padding:0; border:0; margin-top:25px; }
		h1 { font-size: 1.2em; margin: .6em 0; }
		div#users-contain {  width: 350px; margin: 20px 0; }
		div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
		div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
		.ui-button { outline: 0; margin:0; padding: .4em 1em .5em; text-decoration:none;  !important; cursor:pointer; position: relative; text-align: center; }
		.ui-dialog .ui-state-highlight, .ui-dialog .ui-state-error { padding: .3em;  }
</style>
</head>
<body>
<table>
<tr>
  <td align='left'>&nbsp;
    <div id="loading"><b>Cargando...</b></div>
  </td>
  <td><h1>CALENDARIO</h1></td>
</tr>
<tr>
  <td valign="top" align="left">
    <form method='GET' action='fullcalendar.php'>
      <fieldset>
      Estado<br><select name="estado">
        <option value='sin_estado'>Por favor Seleccione...</option>
        <option value='vencidas' <?php if(@$_REQUEST["estado"]=="vencidas"){echo(" SELECTED ");} ?>>Asignaciones Vencidas</option>
        <option value='en_ejecucion' <?php if(@$_REQUEST["estado"]=="en_ejecucion"){echo(" SELECTED ");}?>>Asignaciones En ejecucion</option>
        <option value='pendientes' <?php if(@$_REQUEST["estado"]=="pendientes"){echo(" SELECTED ");}?>>Asignaciones Pendientes</option>
      </select>
      <br>Buscar en<br><select name="tipo_busqueda">
        <option value='sin_tipo_busqueda'>Por favor Seleccione...</option>
        <option value='doc_pendientes' <?php if(@$_REQUEST["tipo_busqueda"]=='doc_pendientes') echo(" SELECTED ");?>>Documentos Pendientes</option>
        <option value='asignaciones' <?php if(@$_REQUEST["tipo_busqueda"]=='asignaciones') echo(" SELECTED ");?>>Tareas</option>
        <option value='festivos' <?php if(@$_REQUEST["tipo_busqueda"]=='festivos') echo(" SELECTED ");?>>Festivos</option>
      </select>
      <br>
      Administrar<input type="checkbox" value="1" name="admin" <?php if($_REQUEST["admin"]) echo(' CHECKED ');?> style="display:inline"><br><br>
      <input type="submit">
      </fieldset>
    </form>
  </td>
  <td><div id='calendar'></div></td>
</tr>
</table>
<div id="dialog" title="Asignar Tareas">
	<form>
	<fieldset>
		<label for="name">Name</label>
		<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
		<label for="email">Email</label>
		<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" />
		<label for="password">Password</label>
		<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>
</body>                               
</html>