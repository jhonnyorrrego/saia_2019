<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once ($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery('1.7'));
echo(estilo_bootstrap());

$configuracion = array();
if(@$_REQUEST["iddoc"]){
	if(!$_REQUEST["iddoc"])
		$_REQUEST["iddoc"]=@$_REQUEST["iddoc"];
	include_once($ruta_db_superior."pantallas/documento/menu_principal_documento.php");
	menu_principal_documento($_REQUEST["iddoc"]);
}
if($_REQUEST['idcalendario'] != '' ){
  /*
   * busca la configuracioón en la DB con el $_REQUEST['idcalendario]  
   */
  $configuracion = busca_filtro_tabla(fecha_db_obtener('fecha').' AS fecha, tipo, estilo, datos, encabezado_izquierda, encabezado_centro, encabezado_derecho, adicionar_evento ',"calendario_saia","idcalendario_saia=".$_REQUEST['idcalendario'],"",$conn);
  //$calendario_fun=busca_filtro_tabla("idcalendario_saia","calendario_saia","","",$conn);


  if($configuracion[0]['fecha'] == '0000-00-00'){
    $configuracion[0]['fecha'] = date('Y-m-d');
  }
  $fecha = date_parse($configuracion[0]['fecha']);      
}
else{
?>  
  <script type="text/javascript">
    top.noty({
      text: 'No se encuentra la configuración del calendario',
      type: 'error',
      layout: "topCenter"     
    });   
  </script>
<?php
}
?>

<!DOCTYPE html>
<html>
<head>
<!-- hojas de estilo css-->
<link rel="stylesheet" type="text/css" href="<?php echo $ruta_db_superior?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<link href='<?php echo $ruta_db_superior?>css/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo $ruta_db_superior?><?php echo $configuracion[0]['estilo']?>' rel='stylesheet' />
<style>

  body {
    margin-top: 10px;
    text-align: center;
    font-size: 13px;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    }

  #calendar {
    width: 900px;
    margin: 0 auto;
    }
    
    #enlace {
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    font-size: 13px;
    /*margin-left: 550px;*/
    margin-top: 5px;
    position: absolute;
    text-align: center;
    }

</style>

</head>
<body>
<!--
  /*
   * Carga el calendario que genera el jquery por medio de la función fullcalendar
   */
-->

<?php if($_REQUEST['idcalendario']==7 || $_REQUEST['idcalendario']==8 || $_REQUEST['idcalendario']==9){?>
<!--div id='enlace'><a href='fullcalendar.php?idcalendario=6'>Tareas asignadas por mi</a></div-->
<div id="enlace_sel">
	<div class="btn btn-mini tareas" id="tarea_2" titulo="Listados"><a href="<?php echo($ruta_db_superior);?>pantallas/buscador_principal.php?idbusqueda=55&default_componente=listado_tareas_documento">Listados</a></div>
	<div class="btn btn-mini tareas" id="tarea_3" titulo="Tareas totales"><a href="fullcalendar.php?idcalendario=7">Tareas Totales</a></div>
	<div class="btn btn-mini tareas" id="tarea_4" titulo="Tareas asignadas por mi"><a href="fullcalendar.php?idcalendario=8">Tareas Asignadas por mi</a></div>
	<div class="btn btn-mini tareas" id="tarea_5" titulo="Tareas Asignadas a mi"><a href="fullcalendar.php?idcalendario=9">Tareas Asignadas a mi</a></div>
</div>
<br/><br/>
<?php } ?>

<div id='calendar'></div>  
   

<!-- scriptś JS -->
<script type="text/javascript" src="<?php echo $ruta_db_superior?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<script src='<?php echo $ruta_db_superior?>js/jquery-ui-1.7.2.custom.min.js'></script>
<script src='<?php echo $ruta_db_superior?>js/fullcalendar.min.js'></script>

<script type='text/javascript'>
    hs.graphicsDir = '<?php echo $ruta_db_superior?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>

<script type="text/javascript">
$(document).ready(function() {
    var viewCalendar;

    
    /*
     * adicionar_evento: toma la ruta del script que contiene el formulario que 
     * adicionar eventos al calendario
     */
    var adicionar_evento = "<?php echo $configuracion[0]['adicionar_evento'] ?>";
    
    /*
     * viewCalendar: muestra el calendario según el tipo almacenado en la DB
     * si no se almaceno ningún valor o un valor fuera del ranfo [1-3] se 
     * mostrara por mes
     */ 
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
          
    //$('#calendar').fullCalendar('gotoDate', 1979,8,10); // El mes empieza en 0 (Enero = 0, Febrero = 1)      
      
      
     
      
      //$('#calendar').fullCalendar('changeView', 'agendaDay');
	//		$('#calendar').fullCalendar('gotoDate', date);
          
    $('#calendar').fullCalendar({
    	
            
      year :'<?php echo($fecha['year']);?>',      
      month :'<?php echo($fecha['month']-1);?>',
      date :'<?php echo($fecha['day']);?>' ,
      
      buttonText: {
            month:    'Mes',
          week:     'Semana',
          day:      'Día',
          today:    'Hoy'
       },   
       
       allDayText: 'Todo el D&iacute;a',
       monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
           monthNamesShort: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
           dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
           dayNamesShort: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
      
      /*
       * configuración del encabazado del calendario ver archivo README del paquete
       * actualización calendario saia
       */
      header: {
        left: "<?php echo $configuracion[0]['encabezado_izquierda']; ?>",
        center: "<?php echo $configuracion[0]['encabezado_centro']; ?>",
        right: "<?php echo $configuracion[0]['encabezado_derecho']; ?>"
      },
            
      defaultView: viewCalendar,
          
      editable: true,
      
      /*
       * events: se encarga de traer y cargar los eventos 
       * del calendario por medio de una petición ajax que carga
       * el script que arma los datos (vease el archivo README del paquete 
       *  actualización calendario saia)
       */   
      events: function(start, end, callback){           
            $.ajax({
              url:"<?php echo $configuracion[0]['datos']; ?>",
              data: 'start='+Math.round(start.getTime() / 1000 )+'&end='+Math.round(end.getTime() / 1000)+"&iddoc=<?php echo($_REQUEST['iddoc'])?>",
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
      
      /*
       * dayClick: permite adicionar nuevos eventos al calendario  
       * al hacer click sobre el día al cual se le van a añadir eventos
       * (vease el archivo README del paquete actualización calendario saia)
       */   
       
       
       
      dayClick: function(date){ 
      	        
            hs.htmlExpand(null, {
          contentId: 'cuerpo',           
          src: adicionar_evento+'&fecha='+Math.round(date.getTime() / 1000 ),
          objectType: 'iframe', 
          
          //outlineWhileAnimating: true,
          width: 500 
        });         
        },         
       
        
		
           
      
    });
    
  }); 
</script>
</body>
</html>
