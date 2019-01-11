<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_notificaciones.js"></script>
<script>
$(document).ready(function(){
  $(".enlace_listado_tareas").live("click",function(){
    if($(this).attr("enlace") !==undefined && $(this).attr("enlace") !==''){
      $("#iframe_detalle").attr({
         'src':'<?php echo($ruta_db_superior);?>'+$(this).attr("enlace")+"&rand=<?php echo(rand());?>",
         'height': ($("#panel_body").height())
      });
    }
    else{
      $("#iframe_detalle").attr({
         'src':'<?php echo($ruta_db_superior);?>pantallas/listado_tareas/detalles_listado_tareas.php?idlistado_tareas='+$(this).attr("idregistro")+"&idbusqueda_componente=<?php echo($_REQUEST["idbusqueda_componente"]);?>&rand=<?php echo(rand());?>",
         'height': ($("#panel_body").height())
      });  
    }  
  });
  
  $(".eliminar_listado_tarea").live("click",function(){
  	var idregistro=$(this).attr("idregistro");
  	var confirmacion=confirm("Esta seguro de eliminar este listado de tareas y sus tareas?");
  	if(confirmacion){
	  	$.ajax({
	      type:'POST',
	      async:false,
	      dataType:'json',
	      url: "<?php echo($ruta_db_superior);?>pantallas/listado_tareas/ejecutar_acciones.php",
	      data: "ejecutar_accion=delete_listado_tarea&tipo_retorno=1&idlistado_tareas="+idregistro,
	      success: function(objeto2){
	        if(objeto2.exito){
	        	notificacion_saia(objeto2.mensaje,"success","",2500);
	        	$("#resultado_pantalla_"+idregistro).remove();
	        	$("#iframe_detalle").attr('src','');
	        }
	      }
	    });
		}
  });
  
  $("#adicionar_expediente").live("click",function(){    
    window.open("<?php echo($ruta_db_superior);?>"+$(this).attr("enlace"),"iframe_detalle");
  });
  
 
  
  $('.checkbox_listado_tareas').live('click',function(){  	
  	
  	var accion='';
  	if( $(this).children().hasClass('icon-uncheck') ){  //no chequeado
  		
  		$(this).children().removeClass('icon-uncheck');
  		$(this).children().addClass('icon-check');
  		accion='adicionar';
  		$(this).children().removeClass('listado_no_seleccionado');
  		$(this).children().addClass('listado_seleccionado');
  		
  		
  		$(this).parent().addClass('alert-info');
  		
  	}else{ //checkeado
  		$(this).children().removeClass('icon-check');
  		$(this).children().addClass('icon-uncheck'); 
  		accion='remover';	
  		
  		$(this).children().removeClass('listado_seleccionado');
  		$(this).children().addClass('listado_no_seleccionado');  
  		$(this).parent().removeClass('alert-info');		
  	}
  	
  	var idregistro=$(this).attr('idregistro');
  	var seleccionados=$('#seleccionados').val();

  	if(accion=='adicionar'){
  		seleccionados=seleccionados+idregistro+',';
  	}else{
  		
  		var vector_seleccionados=seleccionados.split(',');
  		seleccionados='';
	  	for(i=0;i<vector_seleccionados.length;i++){
	  		if(vector_seleccionados[i]!=idregistro && vector_seleccionados[i]!=''){
	  			seleccionados=seleccionados+vector_seleccionados[i]+',';
	  		}	
	  	}  		
  	}
  	$('#seleccionados').val(seleccionados);

  });
  
  
  $('#filtrar_listado').click(function(){
  		$('.listado_no_seleccionado').parent().parent().hide();
  });
  $('#restaurar_listado').click(function(){
  		$('.listado_no_seleccionado').parent().parent().show();
  });
   
  
});
</script>