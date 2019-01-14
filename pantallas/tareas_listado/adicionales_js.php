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
//echo(estilo_bootstrap());
echo(estilo_file_upload());
//echo(librerias_jquery("1.7"));
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


?>
<style>

.linea_primaria{
	vertical-align:middle;
}
.contenedor_informacion_primaria{
	width:100%;   
}

.contenedor_enlace_componente li div{
	padding-left:2px;
	padding-right:2px;

	border-top-left-radius:0px;
	border-top-right-radius:0px;
	border-bottom-right-radius:0px;
	border-bottom-left-radius:0px;

}
.contenedor_enlace_componente{
	
}
.reescribir_navbar{
	background:none;
	background-color:none;
	margin:0px;
	width:230;
	border-style:none;
}
.reescribir_navbar-inner{
	border:0px;
	background:none;
	background-color:none;
	border-style:none;
	padding:0px;
}




.estrellas{display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:20px;}
.highlight, .estrella_seleccionada {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}


.contenedor_componentes{
	background-color: #fff;
}
.navbar-fixed-top, .navbar-fixed-bottom, .navbar-static-top{margin-right: 0px; margin-left: 0px;}
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
/*
.form-horizontal .control-label{
  width: 60%;
}
*/
.slider_saia{
  padding-left:20px;
}


.fechas_tarea{ display:none; /*Si falla pilas que oculta el componente*/}
.progress{margin-bottom:0px;}

	  div.rating-cancel,div.rating-cancel a{background:url(<?php echo($ruta_db_superior);?>images/delete.gif) no-repeat 0 -16px}
  div.star-rating,div.star-rating a{background:url(<?php echo($ruta_db_superior);?>images/star.gif) no-repeat 0 0px}


.separador_info_tarea{
    margin-top: 5px;
}

.info_tarea{
	margin-top: 5px;
}
</style>
<link rel="stylesheet" href="<?php echo($ruta_db_superior);?>css/jslider/jslider.css" type="text/css">
<link rel="stylesheet" href="<?php echo($ruta_db_superior);?>css/jslider/jslider.blue.css" type="text/css">
<link rel="stylesheet" href="<?php echo($ruta_db_superior);?>css/jslider/jslider.plastic.css" type="text/css">
<link rel="stylesheet" href="<?php echo($ruta_db_superior);?>css/jslider/jslider.round.css" type="text/css">
<link rel="stylesheet" href="<?php echo($ruta_db_superior);?>css/jslider/jslider.round.plastic.css" type="text/css">
<link rel="stylesheet" href="<?php echo($ruta_db_superior);?>css/daterangepicker_new.css" type="text/css" >




<style>
.date-picker-wrapper .month-wrapper td{
  width:10px;
}
.date-picker-wrapper .caption th{
  width: 10px;
}
.date-picker-wrapper .month-wrapper th{
  width:10px;
}
/*.date-picker-wrapper .month-wrapper{
	width:385px;
}
.month1 .month2{
	width:40%;
}*/

.well:hover{
  color: #3a87ad;
  background-color: #d9edf7;
  border-color: #bce8f1;
}
.well{
	margin-bottom:3px;
	padding-bottom:1px;
	/*padding-top:11px;*/
}

.contenedor_primario td {
 border: 0px;
}

.texto_cajon{
	color:#424242;
	font-size:10px;
	
}

.contenedor_prioridad_tarea i{
	margin-top:0px;
}
.contenedor_nombre_tarea{
	font-size:12px;
	/*font-weight:bold;*/
	min-width: 20%;
}

.contenedor_fecha_vencimiento,.contenedor_fecha_inicio{
	font-size:10px;
	color:white;
	border-style:none;
	border-radius:5px;
	
}
.contenedor_progreso_tarea{
	font-weight:bold;
	color:#3a87ad;
	
}


</style>

  <script src="<?php echo($ruta_db_superior);?>js/moment.js"></script>
  <script src="<?php echo($ruta_db_superior);?>js/daterangepicker_new.js"></script>
  <script src="<?php echo($ruta_db_superior);?>js/jquery_slider_plugin/jquery.dependClass-0.1.js"></script>
  <script src="<?php echo($ruta_db_superior);?>js/jquery_slider_plugin/jshashtable-2.1_src.js"></script>
  <script src="<?php echo($ruta_db_superior);?>js/jquery_slider_plugin/jquery.numberformatter-1.2.3.js"></script>
  <script src="<?php echo($ruta_db_superior);?>js/jquery_slider_plugin/tmpl.js"></script>
  <script src="<?php echo($ruta_db_superior);?>js/jquery_slider_plugin/draggable-0.1.js"></script>
  <script src="<?php echo($ruta_db_superior);?>js/jquery_slider_plugin/jquery.slider.js"></script>
  <script src="<?php echo($ruta_db_superior);?>pantallas/anexos/js/anexos.js"></script>




<script type="text/javascript">
function save_progreso_tarea(idtarea, val_progreso){
  $.ajax({
    type:'POST',
    dataType: 'json',
    url: "<?php echo($ruta_db_superior);?>pantallas/tareas_listado/ejecutar_acciones.php",
    data:{idtareas_listado:idtarea,ejecutar_accion_tarea:"update_campos_tarea_listado","progreso":val_progreso,campos:"progreso", mensaje_exito:"El progreso de su tarea ahora es de "+val_progreso+"%"},
    success: function(datos){
    
      	$('#progreso'+idtarea).click();
      if(datos.sin_tiempo_registrado){
           		notificacion_saia("<span style='color:white;'>ATENCI&Oacute;N! <br> No es posible dar un progreso del 100% sin tener Tiempo registrado</span>","error","",5000);
           		$('#progreso'+idtarea).click();
           		$('#bprogreso'+idtarea).click();
       }else{
       		$("#progreso_titulo_"+idtarea).html(val_progreso+"%");
      notificacion_saia(datos.mensaje,"success","",3000);
       }	
    	
      
    } 
  });
} 
function save_fechas_tarea(idtarea,tarea_inicio,tarea_limite){
  $.ajax({
    type:'POST',
    dataType: 'json',
    url: "<?php echo($ruta_db_superior);?>pantallas/tareas_listado/ejecutar_acciones.php",
    data:{idtareas_listado:idtarea,ejecutar_accion_tarea:"update_campos_tarea_listado","fecha_inicio":tarea_inicio,"fecha_limite":tarea_limite,campos:"fecha_inicio,fecha_limite", mensaje_exito:"Las fechas de inicio y fin fueron actualizadas"},
    success: function(datos){
      notificacion_saia(datos.mensaje,"success","",3000);
      $('#progreso'+idtarea).click();
      if(datos.fecha_limite){
			  $.ajax({
				    type:'POST',
				    dataType: 'json',
				    url: "<?php echo($ruta_db_superior);?>pantallas/tareas_listado/ejecutar_acciones.php",
				    data:{ejecutar_accion_tarea:"calcular_color_dias_fecha_limite","idtareas_listado":idtarea},
				    success: function(datos_calculo){
				    	
				    	var cadena_fecha_limite='&nbsp;'+datos_calculo.fecha_limite+'&nbsp;'
						$('#contenedor_fecha_vencimiento_'+idtarea).css('background-color',datos_calculo.color).html(cadena_fecha_limite);	
						$('#contenedor_fecha_vencimiento_'+idtarea).parent().attr('data-original-title',datos_calculo.aviso);
				      	//$('#contenedor_dias_fecha_vencimiento_'+idtarea).html(datos_calculo.aviso);
				    } 
  				});
      }
      
    } 
  });
}

function guardar_notas_tareas(idtarea,nota,enviar_email){
	$.ajax({
    type:'POST',
    dataType: 'json',
    url: "<?php echo($ruta_db_superior);?>pantallas/tareas_listado/ejecutar_acciones.php",
    data:{fk_tareas_listado:idtarea,enviar_correo:enviar_email,ejecutar_accion_tarea:"guardar_campos_tarea_listado_notas",descripcion:nota,campos:"fk_tareas_listado,descripcion", mensaje_exito:"se ha guardado con exito la nota"},
    success: function(datos){
      notificacion_saia(datos.mensaje,"success","",3000);
      if(datos.exito==1){
      	 $("#notas"+idtarea).click();
      	// $("#bnotas"+idtarea).click();
      	 	

      	 
      }
    } 
  });
}

function guardar_prioridad(idtarea,priorid){
	$.ajax({
    type:'POST',
    dataType: 'json',
    url: "<?php echo($ruta_db_superior);?>pantallas/tareas_listado/ejecutar_acciones.php",
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
	      $("#icon-prioridad_"+idtarea).attr('data-original-title',label);
	     // $("#span-prioridad_"+idtarea).empty().html(label);
      }
    } 
  });
}
$(document).ready(function(){
  $(".month-wrapper").width(385);
  
  //-----------------ELIMINACION Y EDICION DE LAS TAREAS
  
                      $(".get_tiempo_crono").live("click",function(){
					  
					  if( $("#timer",top.document).is(':hidden') ){
					  
					      var f=new Date();
                          var cad=f.getHours()+":"+f.getMinutes(); 
					  
                        var idtarea=$(this).attr("idtarea");
                        $("#timer",top.document).show();
                        $("#btn_guardar_crono",top.document).attr("idtarea",parseInt($(this).attr("idtarea")));
                        $("#btn_guardar_crono",top.document).attr("hora_ini",cad);
                        $("#btn_guardar_crono",top.document).attr("fecha_inicio",$("#fecha_inicio_"+idtarea).val());
                        $("#btn_iniciar_crono",top.document).attr("estado_crono","1");
                        $("#btn_iniciar_crono",top.document).click();
                      }else{
					   notificacion_saia("ATENCI&Oacute;N! <br> Ya existe un avance en progreso","warning","",3000);
					  }
					  });   
  
  
 	//ELIMINA AVANCES tabla: tareas_listado_tiempo
	$(".eliminar_avance_tarea").live("click",function(){
		var idtareas_listado=$(this).attr('idtareas_listado');
		var idtareas_listado_tiempo=$(this).attr('idtareas_listado_tiempo');
		$.ajax({
        	type:'POST',
            dataType: 'json',
            url: "<?php echo($ruta_db_superior);?>pantallas/tareas_listado/ejecutar_acciones.php",
            data: {
          		idtareas_listado_tiempo:idtareas_listado_tiempo,
          		accion:'eliminar',
          		ejecutar_accion_tarea:'editar_eliminar_avance_tarea'
            },
            success: function(datos){
				if(datos.exito){
					notificacion_saia(datos.mensaje,"success","",2500);
					$("#cronometro"+idtareas_listado).click();
				}else{
					notificacion_saia(datos.mensaje,"error","",2500);
				}
            }
        });       	
    	
  	}); 
 
	$(".editar_avance_tarea").live("click",function(){
		var idtareas_listado_tiempo=$(this).attr('idtareas_listado_tiempo');
		var accion=$(this).attr('accion');
		var idtareas_listado=$(this).attr('idtareas_listado');
		
    	switch(accion){
    		case 'cargar_info':
				$.ajax({
		        	type:'POST',
		            dataType: 'json',
		            url: "<?php echo($ruta_db_superior);?>pantallas/tareas_listado/ejecutar_acciones.php",
		            data: {
		          		idtareas_listado_tiempo:idtareas_listado_tiempo,
		          		accion:accion,
		          		ejecutar_accion_tarea:'editar_eliminar_avance_tarea'
		            },
		            success: function(datos){
						if(datos.exito){
							$('#guardar_avance_tarea_'+idtareas_listado).hide();
							$('#get_tiempo_crono_'+idtareas_listado).hide();
							
						
							$('#fecha_inicio_'+idtareas_listado).val(datos.fecha_inicio);
							$('#estado_tarea_'+idtareas_listado).children('option[value="'+datos.estado_avance+'"]').attr('selected','selected');
							$('#comentario_avance_tarea_'+idtareas_listado).val(datos.comentario);
							$('#hora_inicio_'+idtareas_listado).val(datos.hora_inicio);
							$('#hora_final_'+idtareas_listado).val(datos.hora_final);
							$('#datetimepicker_hora_ini_'+idtareas_listado).trigger('changeDate');
							
							var boton_edit='<div class="btn btn-mini btn-success editar_avance_tarea" accion="editar_info" idtareas_listado="'+idtareas_listado+'" idtareas_listado_tiempo="'+idtareas_listado_tiempo+'">Editar</div>';
							$('#guardar_avance_tarea_'+idtareas_listado).after(boton_edit);
							
						}else{
							notificacion_saia("<font color=\'EEEEEE\'>Inconvenientes al Cargar la Informacion a Editar, Por Favor Intentelo Nuevamente</font>","error","",4500);
						}
		            }
		        });     			
    			break;
    		case 'editar_info':
    		
    			var hora_fin=$("#hora_final_"+idtareas_listado).val();
                if(hora_fin!=""){
                    var fecha_ini=$("#fecha_inicio_"+idtareas_listado).val();
                    var hora_ini=$("#hora_inicio_"+idtareas_listado).val();
                    var estado=$("#estado_tarea_"+idtareas_listado).val();
                   	var comentario=$("#comentario_avance_tarea_"+idtareas_listado).val();               	
 					var minutos=parseInt($("#minutos_tiempo_"+idtareas_listado).val())*60;
                    if(isNaN(minutos)){minutos=0;}
                    var horas=parseInt($("#horas_tiempo_"+idtareas_listado).val())*3600;
                    if(isNaN(horas)){horas=0;}
                    var tiempo_tarea=minutos+horas; 
                    

					$.ajax({
			        	type:'POST',
			            dataType: 'json',
			            url: "<?php echo($ruta_db_superior);?>pantallas/tareas_listado/ejecutar_acciones.php",
			            data: {
			          		idtareas_listado_tiempo:idtareas_listado_tiempo,
			          		accion:accion,
			          		ejecutar_accion_tarea:'editar_eliminar_avance_tarea',
			          		
			          		tiempo_registrado:tiempo_tarea,
			          		comentario:comentario,
			          		fecha_inicio:fecha_ini,
			          		hora_inicio:hora_ini,
			          		hora_final:hora_fin,
			          		estado_avance:estado
			            },
			            success: function(datos){
							if(datos.exito){
								notificacion_saia(datos.mensaje,"success","",2500);
								$("#cronometro"+idtareas_listado).click();
							}
			            }
			        }); 

                    
                }else{
                	notificacion_saia("<font color=\'EEEEEE\'>Por favor ingrese el Tiempo</font>","error","",3000);
                }         	
    			break;	
    	}
    	
    	
  	});  
  
  
  
  
	$(".enlace_tareas").live("click",function(){
    if($(this).attr("enlace") !==undefined && $(this).attr("enlace") !==''){
    	window.open('<?php echo($ruta_db_superior);?>'+$(this).attr("enlace")+'&rand=<?php echo(rand());?>',"iframe_detalle");
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
  
  
  
  $('.generar_tarea_recurrencia').live('click',function(){
	$.ajax({
        type:'POST',
        dataType: 'json',
        async:true,
        url: "<?php echo($ruta_db_superior);?>pantallas/tareas_listado/ejecutar_acciones.php?ejecutar_accion_tarea=crear_tarea_recurrencia",
        data: {
	        idtareas_listado:$(this).attr('idtarea')
        },
        success: function(datos){
        	if(datos.exito==1){
	        	notificacion_saia("Tarea generada satisfactoriamente","success","",2500);  
	        	//cargar_datos_scroll();
	        	location.reload();
        	}else{
        		notificacion_saia("No es posible generar mas recurrencias a la tarea","error","",2500);  
        	}
    	}
  	});   	
  }); 
  


  $('.boton_linea_primaria').live('click',function(){
		
		var seleccionado=$(this).hasClass("btn-primary");
		var idtarea=$(this).attr("idtarea");
		var id=$(this).attr("id");
		
		$('#binformacion'+idtarea+',#bprogreso'+idtarea+',#bcronometro'+idtarea+',#bprioridades'+idtarea+',#bfecha'+idtarea+',#bnotas'+idtarea+',#banexos'+idtarea+',#bcalificacion'+idtarea+',#brecurrencia'+idtarea+',#bseguidores'+idtarea+',#betiquetas'+idtarea).removeClass('btn-primary');	
		$('#informacion'+idtarea+',#progreso'+idtarea+',#cronometro'+idtarea+',#prioridades'+idtarea+',#fecha'+idtarea+',#notas'+idtarea+',#anexos'+idtarea+',#calificacion'+idtarea+',#recurrencia'+idtarea+',#seguidores'+idtarea+',#etiquetas'+idtarea).removeClass('active');	
		var res = id.substring(1, id.length); 
		$('#'+res).addClass('active');	
		
		if($("#div_info_doc_"+idtarea).hasClass("in")  &&  $("#div_info_doc_"+idtarea).hasClass("collapse")){ //esta abierto
			if(seleccionado){
				$('#'+idtarea).click();
				$('#informacion'+idtarea+',#progreso'+idtarea+',#cronometro'+idtarea+',#prioridades'+idtarea+',#fecha'+idtarea+',#notas'+idtarea+',#anexos'+idtarea+',#calificacion'+idtarea+',#recurrencia'+idtarea+',#seguidores'+idtarea+',#etiquetas'+idtarea).removeClass('active');		
				$('#tab4_'+idtarea+',#tab1_'+idtarea+',#tab5_'+idtarea+',#tab6_'+idtarea+',#tab7_'+idtarea+',#tab9_'+idtarea+',#tab10_'+idtarea+',#tab11_'+idtarea+',#tab3_'+idtarea+',#tab8_'+idtarea+',#tab12_'+idtarea).removeClass('active');	
			}
		}else{  //esta cerrado
			$('#'+idtarea).click();
		}
		
		
		if(seleccionado){
			$(this).removeClass("btn-primary");		
		}else{
			$(this).addClass("btn-primary");
			
			
		}			 	
  });   
  
  
  $('.boton_linea_secundaria').live('click',function(){
  		var id=$(this).attr('id');
  		var idtarea=$(this).attr('idtarea');
  		$('#binformacion'+idtarea+',#bprogreso'+idtarea+',#bcronometro'+idtarea+',#bprioridades'+idtarea+',#bfecha'+idtarea+',#bnotas'+idtarea+',#banexos'+idtarea+',#bcalificacion'+idtarea+',#brecurrencia'+idtarea+',#bseguidores'+idtarea+',#betiquetas'+idtarea).removeClass('btn-primary');	
  		$('#b'+id).addClass('btn-primary');
  });
  
  
});


	$(document).ready(function(){
	  $(".fecha_tarea").live("click",function(){
	    $(".shortcuts").find("b").hide();
	    $(".next-days").find("a").text(function(buscar,reemplazar){
        return reemplazar.replace(/Dias/g, " Dias");
      });
	  });
		$('.eliminar_anexo_tareas').live('click',function(){
			var idanexo=$(this).attr('identificador');
			$.ajax({
        type:'GET',
        dataType: 'json',
        url: "<?php echo($ruta_db_superior);?>pantallas/tareas_listado/eliminar_anexo_tareas_listado.php?idtareas_listado_anexos="+idanexo,
        success: function(datos){
        	notificacion_saia("Anexo eliminado satisfactoriamente","success","",2500);
        	$('#contenedor_anexo_'+idanexo).remove();
        }
      });   			
		});
	});

	$(document).ready(function(){
	$(".div_idtareas_listado").live('click',function (){
		
		var idtarea=$(this).attr("id");
		
		
		if($("#div_info_doc_"+idtarea).hasClass("in")  &&  $("#div_info_doc_"+idtarea).hasClass("collapse")){ //esta abierto
				setTimeout(function(){  //desarrollo que muestra la informacion al click del nombre de la tarea
					if( !$('#binformacion'+idtarea+',#bprogreso'+idtarea+',#bcronometro'+idtarea+',#bprioridades'+idtarea+',#bfecha'+idtarea+',#bnotas'+idtarea+',#bcalificacion'+idtarea+',#brecurrencia'+idtarea+',#bseguidores'+idtarea+',#betiquetas'+idtarea).hasClass("btn-primary") ){	
						$("#informacion"+idtarea).addClass('active');	
						$("#binformacion"+idtarea).addClass("btn-primary");
						$("#informacion"+idtarea).click();
						$("#tab4_"+idtarea).addClass('active');
					}				
				}, 200);
		}else{  //esta cerrado
			$('#binformacion'+idtarea+',#bprogreso'+idtarea+',#bcronometro'+idtarea+',#bprioridades'+idtarea+',#bfecha'+idtarea+',#bnotas'+idtarea+',#banexos'+idtarea+',#bcalificacion'+idtarea+',#brecurrencia'+idtarea+',#bseguidores'+idtarea+',#betiquetas'+idtarea).removeClass('btn-primary');	
			
			$('#informacion'+idtarea+',#progreso'+idtarea+',#cronometro'+idtarea+',#prioridades'+idtarea+',#fecha'+idtarea+',#notas'+idtarea+',#anexos'+idtarea+',#calificacion'+idtarea+',#recurrencia'+idtarea+',#seguidores'+idtarea+',#etiquetas'+idtarea).removeClass('active');	
			$('#tab4_'+idtarea+',#tab1_'+idtarea+',#tab5_'+idtarea+',#tab6_'+idtarea+',#tab7_'+idtarea+',#tab9_'+idtarea+',#tab10_'+idtarea+',#tab11_'+idtarea+',#tab3_'+idtarea+',#tab8_'+idtarea+',#tab12_'+idtarea).removeClass('active');		
			
			
			
		}		
		
		
		/*
		var icon=$(this).children("#icono_mas").hasClass("icon-plus-sign");
		if(icon){
			$(this).children("#icono_mas").removeClass("icon-plus-sign");
			$(this).children("#icono_mas").addClass("icon-minus-sign");			
		}else{
			$(this).children("#icono_mas").removeClass("icon-minus-sign");
			$(this).children("#icono_mas").addClass("icon-plus-sign");
		}*/
		//var idtarea=$(this).attr("id");
		
		//$('#binformacion'+idtarea).click();
	});
	});
	
	
	$('.reescribir_navbar-inner').live('mouseenter',function(){
		$(this).children('div').stop( true, true ).stop( true, true ).fadeIn('slow','swing');
	});
	$('.reescribir_navbar-inner').live('mouseleave',function(){
		$(this).children('div').stop( true, true ).stop( true, true ).fadeOut('slow','swing');
	});	
	



	$('.etiquetar_tarea').live('click',function(){
		var idtarea=$(this).attr('idtarea');
		var cantidad_etiquetas=$('[name="cantidad_etiquetas_'+idtarea+'"]').val();
		var cadena_etiquetas='';
		for(i=0;i<cantidad_etiquetas;i++){
			if($('#eti_'+idtarea+'_'+i).is(':checked') ){
				cadena_etiquetas+=$('#eti_'+idtarea+'_'+i).val();		
				cadena_etiquetas+=',';	
			}			
		}

		$.ajax({
	        type:'POST',
	        dataType: 'json',
	        async:true,
	        url: "<?php echo($ruta_db_superior);?>pantallas/tareas_listado/ejecutar_acciones.php?ejecutar_accion_tarea=actualizar_etiquetas_tarea",
	        data: {
		        idtareas_listado:idtarea,
		        etiquetas:cadena_etiquetas
	        },
	        success: function(datos){
	        	if(datos.exito==1){
					notificacion_saia("Tarea etiquetada satisfactoriamente","success","",3000);
	        	}
	    	}
	  	});		
		
		
	});
	
</script>
				<script type="text/javascript" src="<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
				 <link rel="stylesheet" type="text/css" href="<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
				 <script type='text/javascript'>
				 
				   hs.graphicsDir = '<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
				   hs.outlineType = 'rounded-white';
				</script>	


