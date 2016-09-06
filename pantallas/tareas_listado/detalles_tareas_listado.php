<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php"); 
echo(estilo_bootstrap());
echo(estilo_file_upload());
echo(librerias_jquery("1.7"));
echo(librerias_bootstrap());
echo(librerias_datepicker_bootstrap());
echo(librerias_notificaciones());
echo(librerias_file_upload());
include_once($ruta_db_superior."pantallas/documento/librerias.php");
include_once($ruta_db_superior."pantallas/almacenamiento/librerias.php");
include_once($ruta_db_superior."pantallas/tareas_listado/librerias.php");
include_once($ruta_db_superior."pantallas/anexos/librerias.php");
include_once($ruta_db_superior."pantallas/tareas/librerias.php");
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");
if(@$_REQUEST['idlistado_tareas']){
	$where_tareas='';
	if(@$_REQUEST["idtareas_listado"]){
		$where_tareas=" AND idtareas_listado=".$_REQUEST["idtareas_listado"];
	}
	$tareas_listado=busca_filtro_tabla("","tareas_listado a","a.generica=0 AND a.listado_tareas_fk=".$_REQUEST['idlistado_tareas'].$where_tareas,"a.fecha_creacion DESC",$conn);
}
?>   
<style>
.well{ margin-bottom: 1px; min-height: 11px; padding: 7px;}.alert{ margin-bottom: 3px;  padding: 10px;}  
body{ font-size:12px; line-height:100%;}.navbar-fixed-top, .navbar-fixed-bottom{ position: fixed;} .navbar-fixed-top, .navbar-fixed-bottom, .navbar-static-top{margin-right: 0px; margin-left: 0px;}
.texto-azul{ color:#3176c8}
.pull-center.navbar .nav,.pull-center.navbar .nav > li { float:none; display:inline-block; *display:inline;    *zoom:1; vertical-align: top;}
.pull-center .navbar-inner {text-align:center;}
.pull-center .dropdown-menu {text-align: left;}
.pull-center{text-align:center;}
.table th, .table td {line-height: 9px;text-align: left;}
.layout { padding: 50px; font-family: Georgia, serif; }
.layout-slider { margin-bottom: 60px; width: 50%; }
.layout-slider-settings { font-size: 12px; padding-bottom: 10px; }
.layout-slider-settings pre { font-family: Courier; }
.date-picker-wrapper th, .date-picker-wrapper td {
     border-left: 0px; 
 }
label.error {
  font-weight: bold;
  color: red;
}
.form-horizontal .control-label{
  width: 60%;
}
.slider_saia{
  padding-left:20px;
}


.fechas_tarea{ display:none; /*Si falla pilas que oculta el componente*/}
.progress{margin-bottom:0px;}
</style>
<link rel="stylesheet" href="<?php echo($ruta_db_superior);?>css/jslider/jslider.css" type="text/css">
<link rel="stylesheet" href="<?php echo($ruta_db_superior);?>css/jslider/jslider.blue.css" type="text/css">
<link rel="stylesheet" href="<?php echo($ruta_db_superior);?>css/jslider/jslider.plastic.css" type="text/css">
<link rel="stylesheet" href="<?php echo($ruta_db_superior);?>css/jslider/jslider.round.css" type="text/css">
<link rel="stylesheet" href="<?php echo($ruta_db_superior);?>css/jslider/jslider.round.plastic.css" type="text/css">
<link rel="stylesheet" href="<?php echo($ruta_db_superior);?>css/daterangepicker_new.css" type="text/css" >
<link rel="stylesheet" href="<?php echo($ruta_db_superior);?>css/jquery.rating.css" type="text/css" >
<style>
  div.rating-cancel,div.rating-cancel a{background:url(<?php echo($ruta_db_superior);?>images/delete.gif) no-repeat 0 -16px}
  div.star-rating,div.star-rating a{background:url(<?php echo($ruta_db_superior);?>images/star.gif) no-repeat 0 0px}
</style>
<style>

.contenedor_primario td {
border: 0px;
}
</style>
<body>
  <script src="<?php echo($ruta_db_superior);?>js/moment.js"></script>
  <script src="<?php echo($ruta_db_superior);?>js/daterangepicker_new.js"></script>
  <script src="<?php echo($ruta_db_superior);?>js/jquery_slider_plugin/jquery.dependClass-0.1.js"></script>
  <script src="<?php echo($ruta_db_superior);?>js/jquery_slider_plugin/jshashtable-2.1_src.js"></script>
  <script src="<?php echo($ruta_db_superior);?>js/jquery_slider_plugin/jquery.numberformatter-1.2.3.js"></script>
  <script src="<?php echo($ruta_db_superior);?>js/jquery_slider_plugin/tmpl.js"></script>
  <script src="<?php echo($ruta_db_superior);?>js/jquery_slider_plugin/draggable-0.1.js"></script>
  <script src="<?php echo($ruta_db_superior);?>js/jquery_slider_plugin/jquery.slider.js"></script>
  <script src="<?php echo($ruta_db_superior);?>js/jquery.rating.pack.js"></script>
  <script src="<?php echo($ruta_db_superior);?>pantallas/anexos/js/anexos.js"></script>
  <br />
<?php if(!@$_REQUEST["noadiciona"]){ ?> 


		<div>
			<button class="btn dropdown-toggle btn-mini btn-primary" onclick="window.open('<?php echo($ruta_db_superior);?>pantallas/tareas_listado/adicionar_tareas_listado.php?idlistado_tareas=<?php echo $_REQUEST["idlistado_tareas"];?>','iframe_detalle');">Adicionar Tarea</button>	
		</div>
</br>
<?php } ?>
<div id="container" class="container"> 
<?php 
$papa=busca_filtro_tabla("","listado_tareas","generica=0 AND idlistado_tareas=".$tareas_listado[0]['listado_tareas_fk'],"",$conn);
for ($i=0;$i<$tareas_listado['numcampos']; $i++) {
	$sql="SELECT SUM(tiempo_registrado) AS total_tiempo FROM tareas_listado_tiempo WHERE fk_tareas_listado=".$tareas_listado[$i]["idtareas_listado"]; 
	$dato_tiempo=ejecuta_filtro_tabla($sql,$conn);
	$total_tiempo=intval($dato_tiempo[0]["total_tiempo"]);
?>

<div class="well" id="well_<?php echo $tareas_listado[$i]['idtareas_listado'];?>">
  <span class="div_idtareas_listado" id="<?php echo $tareas_listado[$i]['idtareas_listado'];?>" data-toggle="collapse" data-target="#div_info_doc_<?php echo $tareas_listado[$i]['idtareas_listado'];?>" ><i id="icono_mas" class="icon-plus-sign"></i>  <b><?php echo $tareas_listado[$i]['nombre_tarea']." - ".$papa[0]['nombre_lista']; ?></b></span>
  <div class="btn btn-mini pull-right eliminar_tarea" title="Eliminar" titulo="Eliminar" idtarea="<?php echo $tareas_listado[$i]['idtareas_listado'];?>"><i class="icon-remove"></i></div>
  <div class="btn btn-mini enlace_tareas pull-right" title="editar" titulo="Editar" enlace="pantallas/tareas_listado/editar_tareas_listado.php?idtareas_listado=<?php echo $tareas_listado[$i]['idtareas_listado'];?>"><i class="icon-pencil"></i></div>
  </br>
  <div id="info_tarea_<?php echo ($tareas_listado[$i]['idtareas_listado']);?>">
  	<table class="table table-bordered contenedor_primario" style="border:0px">
  		<tr>
  			<td colspan="2"><?php echo substr($tareas_listado[$i]['descripcion_tarea'], 0,140);?>
  				<br/>
  				<?php echo mostrar_funcionarios($tareas_listado[$i]["responsable_tarea"]);?>
  			</td>
  		</tr>
  		<tr>
  			<td width="40%">Tiempo Transcurrido:<span id="time_transcurrido_<?php echo ($tareas_listado[$i]['idtareas_listado']);?>"><?php if ($total_tiempo){	echo conversor_segundos_hm($total_tiempo);} else {echo(0);}?></span></td>
  			<td width="60%"><?php echo mostrar_prioridad_tarea($tareas_listado[$i]['idtareas_listado'],$tareas_listado[$i]["prioridad"],$tareas_listado[$i]["progreso"]);?></td>
  		</tr>
  	</table>
  </div>
</div>


<div id="div_info_doc_<?php echo $tareas_listado[$i]['idtareas_listado'];?>"  class="collapse ">
	
<table class="table table-bordered">
	<tr>
  	<td width="40%"  colspan="3">
  		<div class="tabbable" id="secciones<?php echo $tareas_listado[$i]['idtareas_listado'];?>">
  			<ul class="nav nav-tabs">
  				<li id="informacion<?php echo $tareas_listado[$i]['idtareas_listado'];?>" class="active"><a href="#tab4_<?php echo $tareas_listado[$i]['idtareas_listado']?>" data-toggle="tab"><i class="icon-info-sign" data-toggle="tooltip" title="Información"></i></a></li>
  				
  				<li id="progreso<?php echo $tareas_listado[$i]['idtareas_listado'];?>" ><a href="#tab1_<?php echo $tareas_listado[$i]['idtareas_listado']?>" data-toggle="tab" ><i class="icon-resize-horizontal" data-toggle="tooltip" title="Progreso"></i></a></li>			
  				
  				<li id="cronometro<?php echo $tareas_listado[$i]['idtareas_listado'];?>" ><a href="#tab3_<?php echo $tareas_listado[$i]['idtareas_listado']?>" data-toggle="tab"><i class="icon-time" data-toggle="tooltip" title="Avance"></i></a></li>
  				
  				<li id="prioridades<?php echo $tareas_listado[$i]['idtareas_listado'];?>" ><a href="#tab5_<?php echo $tareas_listado[$i]['idtareas_listado']?>" data-toggle="tab"><i class="icon-flag" data-toggle="tooltip" title="Prioridad"></i></a></li>
  					
  				<li id="fecha<?php echo $tareas_listado[$i]['idtareas_listado'];?>"><a href="#tab6_<?php echo $tareas_listado[$i]['idtareas_listado']?>" data-toggle="tab"><i class="icon-calendar" data-toggle="tooltip" title="Fecha de la Tarea"></i></a></li>
  				
  				<li id="notas<?php echo $tareas_listado[$i]['idtareas_listado'];?>"><a href="#tab7_<?php echo $tareas_listado[$i]['idtareas_listado']?>" data-toggle="tab"><i class="icon-comment" data-toggle="tooltip" title="Notas"></i></a></li>
  				
  				<li id="anexos<?php echo $tareas_listado[$i]['idtareas_listado'];?>"><a href="#tab8_<?php echo $tareas_listado[$i]['idtareas_listado']?>" data-toggle="tab"><i class="icon-file" data-toggle="tooltip" title="Anexos"></i></a></li>
  				
  				<li id="calificacion<?php echo $tareas_listado[$i]['idtareas_listado'];?>" ><a href="#tab9_<?php echo $tareas_listado[$i]['idtareas_listado']?>" data-toggle="tab"><i class="icon-ok" data-toggle="tooltip" title="Calificación"></i></a></li>
  			</ul>
  			
  			<div class="tab-content">
	        <div class="tab-pane active" id="tab4_<?php echo $tareas_listado[$i]['idtareas_listado']?>">
		        <script>
		        $('#informacion<?php echo $tareas_listado[$i]['idtareas_listado'];?>').live("click",function(){
		          $.ajax({
		            type:'POST',
		            dataType: 'json',
		            url: "mostrar_informacion_opcion.php",
		            data:{opcion:4,idtareas_listado:<?php echo $tareas_listado[$i]['idtareas_listado'];?>},
		            success: function(datos){
		              $('#tab4_<?php echo $tareas_listado[$i]['idtareas_listado']?>').html('');
		              $('#tab4_<?php echo $tareas_listado[$i]['idtareas_listado']?>').append(datos.valor);
		            } 
		            }); 
		        });
		        </script>
		        <script>
					$(document).ready(function(){
					    $('[data-toggle="tooltip"]').tooltip();   
					});
				</script>
	        </div>
  			
  				<div class="tab-pane" id="tab1_<?php echo $tareas_listado[$i]['idtareas_listado']?>">
  				  <div class="layout-slider slider_saia">
              <input id="slider_<?php echo $tareas_listado[$i]['idtareas_listado']?>" type="slider" name="porcentaje_<?php echo $tareas_listado[$i]['idtareas_listado']?>" value="<?php echo($tareas_listado[$i]['progreso'])?>" class="slider_saia_value" idtarea="<?php echo $tareas_listado[$i]['idtareas_listado']?>" />
            </div>
            <script type="text/javascript" charset="utf-8">
                $("#slider_<?php echo $tareas_listado[$i]['idtareas_listado']?>").slider({ from: 0, to: 100, step: 1, round: 1, dimension: "&nbsp;%", skin: "round", callback: function( value ){save_progreso_tarea(<?php echo $tareas_listado[$i]['idtareas_listado']?>,value);} });
            </script>
  				</div>
  				
					<div class="tab-pane" id="tab3_<?php echo $tareas_listado[$i]['idtareas_listado']?>">
            <script>
            $("#cronometro<?php echo $tareas_listado[$i]['idtareas_listado'];?>").live("click",function(){
            	$.ajax({
            		type:'POST',
            		dataType: 'json',
            		url: "mostrar_informacion_opcion.php",
            		data:{opcion:3,idtareas_listado:<?php echo $tareas_listado[$i]['idtareas_listado'];?>},
            		success: function(datos){
              		$('#tab3_<?php echo $tareas_listado[$i]['idtareas_listado'];?>').empty().append(datos.valor);
              			if(datos.time_transcurrido!=0){
											$("#time_transcurrido_<?php echo $tareas_listado[$i]['idtareas_listado'];?>").empty().html(datos.time_transcurrido);
						    		}
              		
	              	//------------------------INICIAR-----------------------//
									$("[id^='datetimepicker_fecha_ini_']").datetimepicker({
												language: 'es',
												pick12HourFormat: true,
												pickTime: false
											}).on('changeDate', function(e){
												$(this).datetimepicker('hide');
											});
											
										$("[id^='datetimepicker_hora_ini_'],[id^='datetimepicker_hora_fin_']").datetimepicker({
											pickDate: false,
											pickSeconds: false
										}).on('changeDate', function(e){
												validar_tiempo(1,$(this).attr("idtarea"));
										});
										
										$("[id^='hora_inicio_'],[id^='hora_final_']").blur(function (){
											validar_tiempo(1,$(this).attr("idtarea"));
										});
										$("[id^='horas_tiempo_'],[id^='minutos_tiempo_']").keyup(function (){
									    this.value = (this.value + '').replace(/[^0-9]/g, '');
									  });
									  $("[id^='horas_tiempo_']").blur(function (){
									    var valor=parseInt($(this).val());
									    if(valor>23){
									    	$(this).val("23");
									    }
									    if(valor<10){
									    	$(this).val("0"+valor);
									    }
									    validar_tiempo(2,$(this).attr("idtarea"));
									  });
									  $("[id^='minutos_tiempo_']").blur(function (){
									    var valor=parseInt($(this).val());
									    if(valor>59){
									    	$(this).val("59");
									    }
									    if(valor<10){
									    	$(this).val("0"+valor);
									    }
									    validar_tiempo(2,$(this).attr("idtarea"));
									  });
									  
										function validar_tiempo(opt,idtarea){
												if(opt==1){
													var h_ini=$("#hora_inicio_"+idtarea).val();
													var h_fin=$("#hora_final_"+idtarea).val();	
													if(h_ini>=h_fin){
														$("#horas_tiempo_"+idtarea).val("");
														$("#minutos_tiempo_"+idtarea).val("");
														return false;
													}else{
														$.ajax({
													    type:'POST',
													    dataType: 'json',
													    url: "ejecutar_acciones.php",
													    data:{idtarea:idtarea,hora_ini:h_ini,hora_fin:h_fin,ejecutar_accion_tarea:"obtenter_tiempo_tareas", mensaje_exito:"Tiempo Cargado"},
													    success: function(datos){
													    	if(datos.exito!=1){
													    		notificacion_saia("<font color='EEEEEE'>"+datos.mensaje+"</font>","error","",3000);
													    	}else{
													    		tiempo=datos.tiempo.split("-");
													    		$("#horas_tiempo_"+idtarea).val(tiempo[0]);
													    		$("#minutos_tiempo_"+idtarea).val(tiempo[1]);
													    	}
													    } 
													  });
													}
												}else if(opt==2){
													var hora_ini=$("#hora_inicio_"+idtarea).val();
													var h=parseInt($("#horas_tiempo_"+idtarea).val());
													if(isNaN(h)){h=0}
													var m=parseInt($("#minutos_tiempo_"+idtarea).val());
													if(isNaN(m)){m=0}
													if(hora_ini==""){
														$("#horas_tiempo_"+idtarea).val("");
														$("#minutos_tiempo_"+idtarea).val("");
														notificacion_saia("<font color='EEEEEE'>Ingrese Hora Inicial</font>","error","",3000);
														return false;
													}else if(h!=0 || m!=0){
														$.ajax({
													    type:'POST',
													    dataType: 'json',
													    url: "ejecutar_acciones.php",
													    data:{idtarea:idtarea,hora:h,minutos:m,hora_inicial:hora_ini,ejecutar_accion_tarea:"obtenter_fecha_final_tareas", mensaje_exito:"Tiempo Cargado"},
													    success: function(datos){
													    	if(datos.exito!=1){
													    		notificacion_saia("<font color='EEEEEE'>"+datos.mensaje+"</font>","error","",3000);
													    	}else{
													    		$("#hora_final_"+idtarea).val(datos.tiempo);
													    	}
													    } 
													  });
													}else{
														$("#hora_final_"+idtarea).val("");
													}
												}
											}
											
										  $(".guardar_avance_tarea").click(function(){
										    var idtarea=$(this).attr("idtarea");
										    var hora_fin=$("#hora_final_"+idtarea).val();
										    if(hora_fin!=""){
											    var fecha_ini=$("#fecha_inicio_"+idtarea).val();
											    var hora_ini=$("#hora_inicio_"+idtarea).val();
											    var estado=$("#estado_tarea_"+idtarea).val();
											    var comentario=$("#comentario_avance_tarea_"+idtarea).val();
											    var minutos=parseInt($("#minutos_tiempo_"+idtarea).val())*60;
											    if(isNaN(minutos)){minutos=0;}
											    var horas=parseInt($("#horas_tiempo_"+idtarea).val())*3600;
											    if(isNaN(horas)){horas=0;}
											    var tiempo_tarea=minutos+horas;
											    
													$.ajax({
												    type:'POST',
												    dataType: 'json',
												    url: "ejecutar_acciones.php",
												    data:{idtarea:idtarea,tiempo_tarea:tiempo_tarea,fecha_inicial:fecha_ini,hora_inicio:hora_ini,hora_final:hora_fin,estado:estado,comentario:comentario,ejecutar_accion_tarea:"registrar_tiempo_tarea_listado", mensaje_exito:"Tiempo Guardado"},
												    success: function(datos){
												    	if(datos.exito!=1){
												    		notificacion_saia("<font color='EEEEEE'>"+datos.mensaje+"</font>","error","",3000);
												    	}else{
												    		notificacion_saia(datos.mensaje,"success","",3000);
												    		 $("#cronometro"+idtarea).click();
												    	}
												    } 
												  });
											 	}else{
											 		notificacion_saia("<font color='EEEEEE'>Por favor ingrese el Tiempo</font>","error","",3000);
											 	}
										  });
											
										  $(".get_tiempo_crono").click(function(){
										    var idtarea=$(this).attr("idtarea");
										    $("#timer",top.document).show();
										    $("#btn_guardar_crono",top.document).attr("idtarea",parseInt($(this).attr("idtarea")));
										    $("#btn_guardar_crono",top.document).attr("hora_ini","<?php echo date("H:i");?>");
										    $("#btn_guardar_crono",top.document).attr("fecha_inicio",$("#fecha_inicio_"+idtarea).val());
												$("#btn_iniciar_crono",top.document).attr("estado_crono","1");
										    $("#btn_iniciar_crono",top.document).click();
										  }); 
											
									  //------------------------TERMINA-----------------------//
										

            		} 
            	}); 
        		});
            </script>
					</div>
          

          
          <div class="tab-pane" id="tab5_<?php echo $tareas_listado[$i]['idtareas_listado']?>">
            <script>
            $("#prioridades<?php echo $tareas_listado[$i]['idtareas_listado'];?>").click(function(){
            	$.ajax({
            		type:'POST',
            		dataType: 'json',
            		url: "mostrar_informacion_opcion.php",
            		data:{opcion:5,idtareas_listado:<?php echo $tareas_listado[$i]['idtareas_listado'];?>},
            		success: function(datos){
            			$('#tab5_<?php echo $tareas_listado[$i]['idtareas_listado']?>').html('');
              		$('#tab5_<?php echo $tareas_listado[$i]['idtareas_listado']?>').append(datos.valor);
              		
              		$("[name='prioridad_<?php echo $tareas_listado[$i]['idtareas_listado']?>']").change(function(){
              				var priorid=$(this).val();
              				var idtarea=parseInt(<?php echo $tareas_listado[$i]['idtareas_listado'];?>);
              				guardar_prioridad(idtarea,priorid);
              			});
            		} 
            	}); 
        	});
            </script>
          </div>
          
          <div class="tab-pane" id="tab6_<?php echo $tareas_listado[$i]['idtareas_listado']?>">
              <input id="date-range<?php echo $tareas_listado[$i]['idtareas_listado']?>" size="40" value="" class="fechas_tarea">
            <div  id="date-range<?php echo $tareas_listado[$i]['idtareas_listado']?>-container"></div>
              <script>
                    $('#date-range<?php echo $tareas_listado[$i]['idtareas_listado']?>').dateRangePicker({
                      inline:true,
                      separator:'|',
                      container: '#date-range<?php echo $tareas_listado[$i]['idtareas_listado']?>-container', 
                      alwaysOpen:true,
                      shortcuts : {
                        'next-days': [3,5,7],
                        'next': ['week','month','year']
                      },
                      showShortcuts: true
                    }).bind('datepicker-change',function(event,obj){
                        var fecha1=obj.date1.toISOString().split("T");
                        var fecha2=obj.date2.toISOString().split("T");
                        save_fechas_tarea(<?php echo $tareas_listado[$i]['idtareas_listado']?>,"'"+fecha1[0]+"'","'"+fecha2[0]+"'");
                    });
              </script>          
          </div>
          <div class="tab-pane" id="tab7_<?php echo $tareas_listado[$i]['idtareas_listado']?>">
 			<script>
            $("#notas<?php echo $tareas_listado[$i]['idtareas_listado'];?>").click(function(){
            	$.ajax({
            		type:'POST',
            		dataType: 'json',
            		url: "mostrar_informacion_opcion.php",
            		data:{opcion:7,idtareas_listado:<?php echo $tareas_listado[$i]['idtareas_listado'];?>},
            		success: function(datos){
            			$('#tab7_<?php echo $tareas_listado[$i]['idtareas_listado'];?>').html('');
              			$('#tab7_<?php echo $tareas_listado[$i]['idtareas_listado'];?>').append(datos.valor);
              			$('#registrar_nota_<?php echo $tareas_listado[$i]['idtareas_listado'];?>').click(function(){
              				var idtarea=parseInt(<?php echo $tareas_listado[$i]['idtareas_listado'];?>);
              				var nota=$("#avance_notas_"+idtarea).val();
              				var enviar_email=$("[name='enviar_correo_"+idtarea+"']:checked").val();
              				if(nota.trim()==""){
              					notificacion_saia("<font color='EEEEEE'>Ingrese el avance</font>","error","",3000);
              				}else{
              					guardar_notas_tareas(idtarea,nota,enviar_email);
              				}
              			});
            		} 
            	}); 
        	});
            </script>            
          </div>
          <div class="tab-pane" id="tab8_<?php echo $tareas_listado[$i]['idtareas_listado']?>">

<!-- DESARROLLO UPLOAD -->

			
			<form class="form-horizontal" id="subir_anexo_componente_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>" method="POST"  action="" enctype="multipart/form-data">
					<legend class="texto-azul">Anexos </legend>  
					<br>
				  <div id="mensaje_file_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>"></div>
			    
			        
			        	  
			            <!--div class="btn btn-mini btn-primary" id="start_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>" disabled="disabled">
			                <i class="glyphicon-upload"></i>
			                <span>Aceptar</span>
			            </div>
			            <div class="btn btn-mini btn-danger cancel_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>" disabled="disabled">
                      <i class="glyphicon-upload"></i>
                      <span>Cancelar</span>
                  </div-->        
			            <span class="btn btn-mini btn-success fileinput-button" ng-class="{disabled: disabled}" style="margin-left:10px;" >
			                <i class="glyphicon-plus"></i>
			                <span>Examinar</span>
			                <input type="file" name="files[]" multiple ng-disabled="disabled" id="files_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>">
			            </span>
			          
			          
			</form>
			       		<br/>
			   			
			    <table class="table table-striped" id="archivos_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>"></table>			
				<div id="muestra_anexos_componente_<?php echo $tareas_listado[$i]['idtareas_listado'];?>"></div>


<script>
$("#anexos<?php echo $tareas_listado[$i]['idtareas_listado'];?>").click(function(){
	$.ajax({
		type:'POST',
		dataType: 'json',
		url: "mostrar_informacion_opcion.php",
		data:{opcion:10,idtareas_listado:<?php echo $tareas_listado[$i]['idtareas_listado'];?>,idlistado_tareas:<?php echo $_REQUEST['idlistado_tareas'];?>},
		success: function(datos){
			$('#muestra_anexos_componente_<?php echo $tareas_listado[$i]['idtareas_listado'];?>').html('');
			$('#muestra_anexos_componente_<?php echo $tareas_listado[$i]['idtareas_listado'];?>').append(datos.valor);
			$('#archivos_<?php echo $tareas_listado[$i]['idtareas_listado'];?>').html('');
		} 
	}); 
});
$(document).ready(function(){            
  var archivos = 0;
  var falla_archivos = 0;
  var exito_archivos = 0;
  var formulario= $('#subir_anexo_componente_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>');
  var error=0;
  var data_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>=null;
  redireccion=1;
  $('#subir_anexo_componente_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>').fileupload({        
      url: '<?php echo($ruta_db_superior);?>pantallas/tareas_listado/subir_archivo_tareas_listado.php?idlistado_tareas=<?php echo(@$_REQUEST['idlistado_tareas']); ?>&idtareas_listado=<?php echo($tareas_listado[$i]['idtareas_listado']); ?>&aleatorio=<?php echo(rand());?>',
      dataType: 'json',             
      autoUpload: true                 
  }).on('fileuploadadd', function (e, data_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>) {
    redirecciona=0;
    archivos++;  
    $.each(data_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>.files, function (index, file) {       
      var texto='<tr id="file_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>_'+index+'"><td>'+file.name+'</td><td>'+tamanio_archivo(file.size,2)+'</td><!--td><i class="icon-trash eliminar_file_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>"></i></td--><td width="100px"><div class="progress progress-striped active"><div class="bar bar-success" id="'+file.size+'" ></div></div></td></tr>';   
                
      $("#archivos_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>").append(texto); 
      $("#start_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>").attr('disabled',false);
      $(".cancel_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>").attr('disabled',false);                    
    });                           
  }).on('fileuploadprogress', function (e, data_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>){
  	
      var progress = parseInt(data_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>.loaded / data_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>.total * 100, 10);        
      $.each(data_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>.files, function(index,file){                                  
        $('#'+file.size).css('width',(progress)+ '%');
        $('#'+file.size).html((progress)+"%");
      });                     
  }).on('fileuploaddone', function(e, data_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>){
    redirecciona=0;
    $.each(data_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>.result.files, function(index,file){
      if(typeof(file.error)!="undefined"){
        $('#'+file.size).removeClass('bar-success');
        $('#'+file.size).addClass('bar-danger');
        falla_archivos++;
        notificacion_saia('Error:'+file.name+"<br>"+file.error,'error','',3500);
      }                   
      else{
        exito_archivos++;
        delete file;
        file=null;
        $("#file_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>_"+index).remove();
        
      }
    });  
    delete data_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>.result.files;
    if((parseInt(falla_archivos)+parseInt(exito_archivos)==parseInt(archivos)) && (parseInt(falla_archivos)==0)){
      notificacion_saia("Todos los archivos se cargaron con &eacute;xito","success","",2500);
      redireccion=1;
    }  
    else if(parseInt(falla_archivos)==0){
      notificacion_saia("Archivos faltantes cargados con &eacute;xito","success","",2500);
      redireccion=1;        
    } 
  	$("#anexos<?php echo $tareas_listado[$i]['idtareas_listado'];?>").click();
  	$("#start_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>").attr('disabled',true);
  	$(".cancel_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>").attr('disabled',true);
  	$('#files_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>').val("");
  	archivos=0;
  	exito_archivos=0;
  	falla_archivos=0; 
  	delete(data_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>);
  }).on('fileuploadfail', function(e, data){ 
    $.each(data_<?php echo($tareas_listado[$i]['idtareas_listado']); ?>.files, function(index,file){              
      notificacion_saia('Error:'+file.name+" <br> "+file.error,'error','',3500);   
      falla_archivos++; 
      redireccion=1;
    });    
  });       
});  
</script>
<!-- CIERRA DESARROLLO UPLOAD -->


          </div>
          
          <div class="tab-pane" id="tab9_<?php echo $tareas_listado[$i]['idtareas_listado']?>">
            <?php
            $retorno_calif = '<div class="controls">';
            for ($j = 1; $j < 6; $j++) {
              $required = "";
              if ($j == 1) {
                $required = ' required';
              }
              $checked = "";
              if ($j == $tareas_listado[$i]["calificacion"]) {
                $checked = 'checked=true';
              }
              $retorno_calif .= '<input type="radio" ' . $required . ' name="calificacion_' . $tareas_listado[$i]['idtareas_listado']. '" id="calificacion' . $tareas_listado[$i]["calificacion"]."_".$j . '" value="' . $j . '" ' . $checked . ' class="calificacion '.$required.'" idtareas_listado="'.$tareas_listado[$i]['idtareas_listado'].'">';
            }
            $retorno_calif .= '<label class="error" for="calificacion"></label>';
            $retorno_calif.='';
            echo($retorno_calif);
            ?>
          </div>
          
  		</div>
  	</td>
 </tr>
</table>
</div>
<?php 
}

?>


</div>
<script type="text/javascript">
function save_progreso_tarea(idtarea, val_progreso){
  $.ajax({
    type:'POST',
    dataType: 'json',
    url: "ejecutar_acciones.php",
    data:{idtareas_listado:idtarea,ejecutar_accion_tarea:"update_campos_tarea_listado","progreso":val_progreso,campos:"progreso", mensaje_exito:"El progreso de su tarea ahora es de "+val_progreso+"%"},
    success: function(datos){
      $("#progreso_titulo_"+idtarea).html(val_progreso+"%");
      notificacion_saia(datos.mensaje,"success","",3000);
    } 
  });
} 
function save_fechas_tarea(idtarea,tarea_inicio,tarea_limite){
  $.ajax({
    type:'POST',
    dataType: 'json',
    url: "ejecutar_acciones.php",
    data:{idtareas_listado:idtarea,ejecutar_accion_tarea:"update_campos_tarea_listado","fecha_inicio":tarea_inicio,"fecha_limite":tarea_limite,campos:"fecha_inicio,fecha_limite", mensaje_exito:"Las fechas de inicio y fin fueron actualizadas"},
    success: function(datos){
      notificacion_saia(datos.mensaje,"success","",3000);
    } 
  });
}

function guardar_notas_tareas(idtarea,nota,enviar_email){
	$.ajax({
    type:'POST',
    dataType: 'json',
    url: "ejecutar_acciones.php",
    data:{fk_tareas_listado:idtarea,enviar_correo:enviar_email,ejecutar_accion_tarea:"guardar_campos_tarea_listado_notas",descripcion:nota,campos:"fk_tareas_listado,descripcion", mensaje_exito:"se ha guardado con exito la nota"},
    success: function(datos){
      notificacion_saia(datos.mensaje,"success","",3000);
      if(datos.exito==1){
      	 $("#notas"+idtarea).click();
      }
    } 
  });
}

function guardar_prioridad(idtarea,priorid){
	$.ajax({
    type:'POST',
    dataType: 'json',
    url: "ejecutar_acciones.php",
    data:{idtarea:idtarea,prioridad:priorid,ejecutar_accion_tarea:"actualizar_prioridad_tareas", mensaje_exito:"Se ha actualizado la Prioridad"},
    success: function(datos){
     notificacion_saia(datos.mensaje,"success","",3000);
      if(datos.exito==1){
				switch(parseInt(priorid)) {
					case 0:
						clase="icon-flag-amarillo";
						label="Baja";
					break;
					
					case 1:
						clase="icon-flag-naranja";
						label="Media";
					break;
					
					case 2:
						clase="icon-flag-morado";
						label="Alta";
					break;
					
					case 3:
						clase="icon-flag-rojo";
						label="Critica";
					break;
				}
	      $("#icon-prioridad_"+idtarea).removeClass().addClass(clase);
	      $("#span-prioridad_"+idtarea).empty().html(label);
      }
    } 
  });
}

function guardar_calificacion(idtarea,calif){
	$.ajax({
    type:'POST',
    dataType: 'json',
    url: "ejecutar_acciones.php",
    data:{idtarea:idtarea,calificacion:calif,ejecutar_accion_tarea:"actualizar_calificacion", mensaje_exito:"Se ha actualizado la Calificacion"},
    success: function(datos){
     notificacion_saia(datos.mensaje,"success","",3000);
    } 
  });
}

$(document).ready(function(){
  $.fn.addBack = function (selector) {
    return this.add(selector == null ? this.prevObject : this.prevObject.filter(selector));
  }
   $('.calificacion').rating({
    callback: function(value, link){
     guardar_calificacion($(this).attr("idtareas_listado"),$(this).val());
    }
  });
	$(".div_idtareas_listado").click(function (){
		var icon=$(this).find("#icono_mas").attr("class");
		if(icon=="icon-plus-sign"){
			$(this).find("#icono_mas").removeClass("icon-plus-sign");
			$(this).find("#icono_mas").addClass("icon-minus-sign");
		}else{
			$(this).find("#icono_mas").removeClass("icon-minus-sign");
			$(this).find("#icono_mas").addClass("icon-plus-sign");
		}
		var idtarea=$(this).attr("id");
		$('#informacion'+idtarea).click();
	});
  //-----------------ELIMINACION Y EDICION DE LAS TAREAS
  
	$(".enlace_tareas").live("click",function(){
    if($(this).attr("enlace") !==undefined && $(this).attr("enlace") !==''){
    	window.open('<?php echo($ruta_db_superior);?>'+$(this).attr("enlace")+'&rand=<?php echo(rand());?>',"_self");
    	return;
    }else{
    	notificacion_saia("Error","error","",2500);
    	return false;
    }
  });
  
  $(".eliminar_tarea").live("click",function(){
  	var idregistro=$(this).attr("idtarea");
  	var confirmacion=confirm("Esta seguro de eliminar este listado de tareas?");
  	if(confirmacion){
	  	$.ajax({
	      type:'POST',
	      dataType:'json',
	      async:false,
	      url: "<?php echo($ruta_db_superior);?>pantallas/tareas_listado/ejecutar_acciones.php",
	      data: "ejecutar_accion_tarea=delete_tarea_listado&tipo_retorno=1&idtareas_listado="+idregistro,
	      success: function(data){
	      	if(data.exito){
	      		notificacion_saia(data.mensaje,"success","",2500);
        		$("#well_"+idregistro).remove();
        		$("#div_info_doc_"+idregistro).remove();
	      	}else{
	      		notificacion_saia(data.mensaje,"error","",2500);
	      	}
	       }
	    });
		}
  });
  
});

	$(document).ready(function(){
		$('.eliminar_anexo_tareas').live('click',function(){
			var idanexo=$(this).attr('identificador');
			$.ajax({
        type:'GET',
        dataType: 'json',
        url: "eliminar_anexo_tareas_listado.php?idtareas_listado_anexos="+idanexo,
        success: function(datos){
        	notificacion_saia("Anexo eliminado satisfactoriamente","success","",2500);
        	$('#contenedor_anexo_'+idanexo).remove();
        }
      });   			
		});
	});
</script>
</body>