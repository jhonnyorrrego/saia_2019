<!DOCTYPE html>
<html>
<head>
<?php  
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_html5());
echo(librerias_jquery("1.7"));
echo(estilo_bootstrap());
?>
<meta charset='utf-8' />
<!-- Se debe reemplazar las librerias y verificar que mas puede afectar el cambio 
  La libreria gcalc.js es para poner en funcionamiento los calendarios de google
  Se debe  
  
  -->
<link href='<?php echo($ruta_db_superior);?>css/fullcalendar.min.css' rel='stylesheet' />   <!-- TRASLADADO -->
<link href='<?php echo($ruta_db_superior);?>css/fullcalendar.print.css' rel='stylesheet' media='print' /> <!-- TRASLADADO -->

<link href='<?php echo $ruta_db_superior?>anexosdigitales/highslide-4.0.10/highslide/highslide.css' rel='stylesheet'/> 
<script type="text/javascript" src="<?php echo $ruta_db_superior?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<script src='<?php echo($ruta_db_superior);?>js/moment.min.js'></script> <!-- MISMA VERSION -->
<script src='jquery-ui.custom.min.js'></script>
<script src='<?php echo($ruta_db_superior);?>js/fullcalendar.min.js'></script> <!-- TRASLADADO (ANTIGUO: .old) -->
<script src='es.js'></script>
<script type='text/javascript'>
    hs.graphicsDir = '<?php echo $ruta_db_superior?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<?php
echo(estilo_bootstrap()); 

$configuracion = array();
if(@$_REQUEST["iddoc"]){
  if(!$_REQUEST["iddoc"])
    $_REQUEST["iddoc"]=@$_REQUEST["iddoc"];
  include_once($ruta_db_superior."pantallas/documento/menu_principal_documento.php");
  menu_principal_documento($_REQUEST["iddoc"]);
}
if(@$_REQUEST['idcalendario'] != '' || @$_REQUEST['nombre_calendario']!=''){
  /*
   * busca la configuracioón en la DB con el $_REQUEST['idcalendario]  
   */
   
   if(@$_REQUEST['nombre_calendario']!=''){
       
       $idcalendario=busca_filtro_tabla("idcalendario_saia","calendario_saia","lower(nombre)='".$_REQUEST['nombre_calendario']."'","",$conn);
       if($idcalendario['numcampos']){
           $_REQUEST['idcalendario']=$idcalendario[0]['idcalendario_saia'];
       }
   }
   
  $configuracion = busca_filtro_tabla(fecha_db_obtener('fecha').' AS fecha, tipo, estilo, datos, encabezado_izquierda, encabezado_centro, encabezado_derecho, adicionar_evento,busqueda_avanzada,nombre',"calendario_saia","idcalendario_saia=".$_REQUEST['idcalendario'],"",$conn);

  //$calendario_fun=busca_filtro_tabla("idcalendario_saia","calendario_saia","","",$conn);


  if($configuracion[0]['fecha'] == '0000-00-00'){
    $configuracion[0]['fecha'] = date('Y-m-d');
  }
  $fecha = date_parse($configuracion[0]['fecha']);      
}
else{
?>  
  <script type="text/javascript">
    alert('No se encuentra la configuración del calendario');   
  </script>
<?php
}
?>
<script>
	$(document).ready(function() {
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
			displayEventTime: false,
			droppable: true, // this allows things to be dropped onto the calendar
			drop: function(date, jsEvent, ui, resourceId) {
			  //TODO:Pilas falta generalizar para el tema de los drop en la base de datos adicionar la ruta del ajax que se debe acceder y los parametros que se envian son idevento (llave del evento que se quiere actualizar)
			  console.log(date);
        update_drop_event(jsEvent.target.attributes.idevento.value,date.toISOString(),date.toISOString());	
        $(this).remove();
      },
      eventResize: function(event, delta, revertFunc, jsEvent, ui, view){
         var start=event.start.format();
         var end=event.start.format();
         if(event.end){
             end=event.end.format();
         }
          update_drop_event(event.id,start,end);          
      },
      eventDrop: function(event,dayDelta,minuteDelta,allDay) {
         var start=event.start.format();
         var end=event.start.format();
         if(event.end){
             end=event.end.format();
         }
          update_drop_event(event.id,start,end);
      },
      eventDragStop: function( event, jsEvent, ui, view ) {
        if(isEventOverDiv(jsEvent.clientX, jsEvent.clientY)) {
            update_drop_event(event.id,'0000-00-00 00:00:00','0000-00-00 00:00:00');
            $('#calendar').fullCalendar('removeEvents', event._id);
            var siguiente=$("#external-events").find("[orden='"+(event.orden+1)+"']").attr("id");
            if(typeof(siguiente)!=="undefined"){
              var el = $(event.info).insertBefore("#"+siguiente).text( event.title );
              el.draggable({
                zIndex: 999,
                revert: true, 
                revertDuration: 0 
              });
              el.data('event', { title: event.title, orden:event.orden, id :event.id, color:event.color, url:event.url, stick: true });
            }
            else{
              var el = $( "<div id='evento_"+event.id+"' idevento='"+event.id+"' class='fc-event' orden='"+event.orden+"' style='background-color:"+event.color+"; border-color:"+event.color+";'>" ).appendTo('#external-events').text(event.title);
              el.draggable({
                zIndex: 999,
                revert: true, 
                revertDuration: 0 
              });
              el.data('event', { title: event.title, orden:event.orden, id :event.id, color:event.color, url:event.url, stick: true });
            }
            
        }
      },
			events: function(start, end, timezone,callback){          
            $.ajax({
              url:"<?php echo $ruta_db_superior.$configuracion[0]['datos']; ?>",
              data: 'start='+start.toISOString()+'&end='+end.toISOString()+"&iddoc=<?php echo($_REQUEST['iddoc'])?>",
              success: function(datos){   
                var events = [];  
                var objeto=jQuery.parseJSON(datos);
                if(objeto.exito){
                  $.each(objeto.rows,function(i,item){
                    events.push({
                      id : item.id,
                      title : item.titulo,
                      start : item.inicio,
                      end : item.fin,
                      url : item.url,
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
			  if(adicionar_evento!==''){
          hs.htmlExpand(null, {  //cuadro vacio
            contentId: 'cuerpo',           
            src: '<?php echo($ruta_db_superior);?>'+adicionar_evento+'&fecha='+date.toISOString(),
            objectType: 'iframe', 
            //outlineWhileAnimating: true,
            width: 1024,
            height:600
          });          
        }
      },
      eventClick: function(calEvent, jsEvent, view) { //tarea especifica
      	var url='<?php echo($ruta_db_superior);?>'+calEvent.url+'&id='+calEvent.id+'';
        jsEvent.preventDefault();
        console.log(this);
        console.log(calEvent);
        hs.htmlExpand(null, {
          contentId: 'cuerpo',           
          src: url,
          objectType: 'iframe', 
          //outlineWhileAnimating: true,
          width: 500,
          height:600
        });         
      }
		});
		var isEventOverDiv = function(x, y) {
      var external_events = $( '#external-events' );
      var offset = external_events.offset();
      offset.right = external_events.width() + offset.left;
      offset.bottom = external_events.height() + offset.top;
      // Compare
      if (x >= offset.left
          && y >= offset.top
          && x <= offset.right
          && y <= offset .bottom) { return true; }
      return false;
    }
	});
</script>
<style>
	body {
		margin-top: 10px;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
	}
	#wrap {
		/*width: 1100px;*/
		/*margin: 0 auto;*/
	}
	#external-events {
		text-align: left;
		margin-left: 10px;
		overflow:scroll;
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
		float: left;
		/*margin-left:10px;*/
		width: 800px;
	}
	.fc-toolbar {
	  margin-bottom:2px;
	}
	#panel_body{
	  overflow:hidden;
	}
	.fc-view-container{
		margin-top:38px;
	}	
</style>
</head>
<body>
<?php 
   

    $calendarios_tareas=array('calendario_tareas_responsable','calendario_tareas_coparticipante','calendario_tareas_seguidor','calendario_tareas_planeador');
   
    
    if(in_array($configuracion[0]['nombre'],$calendarios_tareas)){ ?>
	
<?php
	$responsable="";$coparticipante="";$seguidor="";
	if($configuracion[0]['nombre']==$calendarios_tareas[0]){
		$responsable="class='active'";
		$titulo_calendario=" Responsable";
	}
	if($configuracion[0]['nombre']==$calendarios_tareas[1]){
		$coparticipante="class='active'";
		$titulo_calendario=" Co-participante";
	}
	if($configuracion[0]['nombre']==$calendarios_tareas[2]){
		$seguidor="class='active'";
		$titulo_calendario=" Seguidor";
	}
  if($configuracion[0]['nombre']==$calendarios_tareas[3]){
    $planeador="class='active'";
    $titulo_calendario=" Planeador";
  }	
  $componente_planeador=busca_filtro_tabla("idbusqueda_componente","busqueda_componente","lower(nombre)='tareas_listado_paneador'","",$conn);
?>	
	
<div class="container">
	<!--h4>Calendario <?php echo($titulo_calendario);?></h4-->
	<ul class="nav nav-tabs">
		 <li <?php echo($responsable); ?>><a href='fullcalendar.php?nombre_calendario=calendario_tareas_responsable'>Responsable</a ></li>
		<li <?php echo($coparticipante); ?>><a href='fullcalendar.php?nombre_calendario=calendario_tareas_coparticipante'>Co-participante</a ></li>
			<li <?php echo($seguidor); ?>><a href='fullcalendar.php?nombre_calendario=calendario_tareas_seguidor'>Seguidor</a ></li>
			<li <?php echo($planeador); ?>><a href='fullcalendar.php?idbusqueda_componente=<?php echo($componente_planeador[0]['idbusqueda_componente']); ?>&nombre_calendario=calendario_tareas_planeador'>Planeador</a ></li>
	</ul>		
</div>
<?php } ?>
<div id='wrap' >
  <div id='calendar' class="span8"></div>  
  
 <?php
if($configuracion[0]['busqueda_avanzada']){
	?>
		<div id="formulario_busqueda_avanzada" class="well span4  pull-right">
			
		</div>
		<br>
		<script>
			$(document).ready(function(){
				$("#formulario_busqueda_avanzada").load("<?php echo($ruta_db_superior.$configuracion[0]["busqueda_avanzada"]);?>?idcalendario=<?php echo(@$_REQUEST['idcalendario']);?>&idbusqueda_componente=<?php echo(@$_REQUEST['idbusqueda_componente']); ?>&variable_busqueda=<?php echo(@$_REQUEST['variable_busqueda']); ?>",function(){
			  	});				
			});			
		</script>			
	<?php
}
?>	  
  
<?php 
$funciones=array();
$datos_componente=@$_REQUEST["idbusqueda_componente"];
$datos_busqueda=busca_filtro_tabla("","busqueda A,busqueda_componente B","A.idbusqueda=B.busqueda_idbusqueda AND B.idbusqueda_componente=".$datos_componente,"",$conn);
if($datos_busqueda["numcampos"]){
?>  
<div id="panel_body" class="well span4 pull-right">
        <button type="button" class="btn btn-mini " id="loadmoreajaxloader_parent" >
          <span id="loadmoreajaxloader">Cargando (... 
          </span> 
          <span id="cantidad_maxima" >...)</span>
        </button> 
        <br>
        <br>
		<input type="hidden" value="<?php echo($datos_busqueda[0]['cantidad_registros']);?>" name="busqueda_total_registros" id="busqueda_registros">  
        <input type="hidden" value="1" name="busqueda_pagina" id="busqueda_pagina">  
        <input type="hidden" value="1" name="busqueda_total_paginas" id="busqueda_total_paginas">  
        <input type="hidden" value="<?php echo($datos_componente);?>" name="iddatos_componente" id="iddatos_componente">
        <input type="hidden" value="0" name="fila_actual" id="fila_actual">
        <input type="hidden" value="<?php echo($datos_busqueda[0]['cantidad_registros']); ?>" name="cantidad_total" id="cantidad_total">
        <input type="hidden" value="0" name="cantidad_total_copia" id="cantidad_total_copia">
        <input type="hidden" value="<?php echo(@$_REQUEST["variable_busqueda"]);?>" name="variable_busqueda" id="variable_busqueda">    
        <input type="hidden" value="1" name="complementos_busqueda" id="complementos_busqueda">        
		<div id='external-events'>

          <legend>Mis tareas pendientes</legend>
        </div>
</div>
<br><br> 

    <?php }?>
    <div style='clear:both'></div>
	</div >
</body>
</html>
<script type="text/javascript">
  var forma_cargar=<?php echo($datos_busqueda[0]["cargar"]);?>;
  var espacio_menu=$(".nav").height()+$(".fc-toolbar").height();
  var alto_inicial=($(window).height()-espacio_menu-200); 
  $(document).ready(function(){
    $("#panel_body").height(alto_inicial);
    cargar_datos_scroll();
    setTimeout("contador_buzon("+<?php echo($datos_componente);?>+",'cantidad_maxima')",<?php echo($datos_busqueda[0]["tiempo_refrescar"]); ?>);
    /*$("#panel_body").scroll(function(){   
      if($("#panel_body").scrollTop()==($("#external-events").height()-$("#panel_body").height()+3) || $("#panel_body").scrollTop()==($("#external-events").height()-$("#panel_body").height())){
        cargar_datos_scroll();
      }
    });*/
  });
  $("#external-events").height(alto_inicial);
  var carga_final=false;
  function cargar_datos_scroll(){
    if($('#loadmoreajaxloader_parent').hasClass("disabled"))return;
    $('#loadmoreajaxloader').html("Cargando (... de ");
    $.ajax({
      type:'GET',
      url: "<?php echo($ruta_db_superior);?>pantallas/busquedas/servidor_busqueda.php",
      data: "idbusqueda_componente=<?php echo($datos_componente);?>&page="+$("#busqueda_pagina").val()+"&rows="+$("#busqueda_registros").val()+"&idbusqueda_filtro_temp=<?php echo(@$_REQUEST['idbusqueda_filtro_temp']);?>&idbusqueda_filtro=<?php echo(@$_REQUEST['idbusqueda_filtro']);?>&idbusqueda_temporal=<?php echo (@$_REQUEST['idbusqueda_temporal']);?>&actual_row="+$("#fila_actual").val()+"&variable_busqueda="+$("#variable_busqueda").val()+"&cantidad_total="+$("#cantidad_total").val(),
      success: function(html){
        if(html){
          var objeto=jQuery.parseJSON(html);
          if(objeto.exito){  
            $("#busqueda_pagina").val(objeto.page);
            $("#busqueda_total_paginas").val(objeto.total);
            $("#fila_actual").val(objeto.actual_row);          
            $.each(objeto.rows,function(i,item){
               if(!$("#resultado_pantalla_"+item.llave).length){
              if(forma_cargar==1)         
                  $("#external-events").prepend(item.info).data('event', {
                    id:item.llave,
                    orden:i,
                    color:$(this).attr('color'),
                    title: item.nombre_tarea, // use the element's text as the event title
                    url:$("#evento_"+item.llave).attr("url"),
                    info:item.info,
                    stick: true // maintain when user navigates (see docs on the renderEvent method)
                  }).draggable({
                    zIndex: 999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                  });
                else{
                  $("#external-events").append(item.info);
                  
                  $("#evento_"+item.llave).attr('orden',i);
                  $("#evento_"+item.llave).data('event', {
                    id:item.llave,
                    orden:i, 
                    color:$("#evento_"+item.llave).attr('color'),
                    title: item.nombre_tarea, // use the element's text as the event title
                    url:$("#evento_"+item.llave).attr("url"),
                    info:item.info,
                    stick: true // maintain when user navigates (see docs on the renderEvent method)
                  }).draggable({
                    zIndex: 999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                  });
               }
             }  
            });
            if($("#external-events").height()<alto_inicial){
              alert("prueba");
              cargar_datos_scroll();
            }
            if(objeto.actual_row>=objeto.records){
              finalizar_carga_datos(objeto.records);
            }
            else{
              $('#loadmoreajaxloader').html("resultados("+objeto.actual_row+" de ");
            }
         } 
          else{
            $("#cantidad_total_copia").val("0");
            finalizar_carga_datos(0);
          }   
        }else{
          $("#cantidad_total_copia").val("0");
            finalizar_carga_datos(0);
        }
      }
    });
  } 
  function finalizar_carga_datos(total){
    $('#loadmoreajaxloader').html('resultados('+total+" de ");
    if(parseInt(total)<=parseInt($("#cantidad_total_copia").val())){
      $('#loadmoreajaxloader_parent').addClass("disabled");
    }
    carga_final=true;
  } 
  $('#loadmoreajaxloader').click(function(){
     cargar_datos_scroll();
  });  
  function contador_buzon(idcomponente,capa){
    $.ajax({
      type:'POST',
      url: "<?php echo($ruta_db_superior);?>pantallas/busquedas/servidor_busqueda.php",     
      data: "idbusqueda_componente="+idcomponente+"&page=0&rows="+$("#busqueda_registros").val()+"&actual_row=0&idbusqueda_filtro_temp=<?php echo(@$_REQUEST['idbusqueda_filtro_temp']);?>&idbusqueda_filtro=<?php echo(@$_REQUEST['idbusqueda_filtro']);?>&idbusqueda_temporal=<?php echo (@$_REQUEST['idbusqueda_temporal']);  if(@$_REQUEST['variable_busqueda']){ echo("&variable_busqueda=".$_REQUEST['variable_busqueda']); } ?>&variable_busqueda="+$("#variable_busqueda").val(),
      success: function(html){
        if(html){  
          var objeto=jQuery.parseJSON(html);
          $("#busqueda_total_paginas").val(objeto.total);
          if(objeto.total)$("#boton_exportar_excel").show();
          $("#"+capa).html(objeto.records+")"); 
          $("#cantidad_total").val(objeto.records);
          $("#cantidad_total_copia").val(objeto.records);
          if(parseInt($("#fila_actual").val())>=parseInt(objeto.records)){
            $('#loadmoreajaxloader_parent').addClass("disabled");
          }
        }
      }
    });
  }
  
  
  function update_drop_event(idevento,fecha_evento,fecha_evento_fin){
  	var ruta="<?php echo($ruta_db_superior); ?>pantallas/tareas_listado/ejecutar_acciones.php?ejecutar_accion_tarea=actualizar_fecha_planeada&idtareas_listado="+idevento+"&fecha_planeada="+fecha_evento+"&fecha_planeada_fin="+fecha_evento_fin;
  	
    $.ajax({
        type:'GET',
        dataType: 'json',
        url: ruta,
        success: function(datos){
				
    	}
  	});  	
  }
  
</script>