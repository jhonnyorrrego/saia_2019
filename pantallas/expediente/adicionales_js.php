<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_notificaciones.js"></script>
<script>
$(document).ready(function(){
  $(".enlace_expediente").live("click",function(){
    if($(this).attr("enlace") !==undefined && $(this).attr("enlace") !==''){
      $("#iframe_detalle").attr({
         'src':'<?php echo($ruta_db_superior);?>'+$(this).attr("enlace")+"&rand=<?php echo(rand());?>",
         'height': ($("#panel_body").height())
      });
    }
    else{
      $("#iframe_detalle").attr({
         'src':'<?php echo($ruta_db_superior);?>pantallas/expediente/detalles_expediente.php?idexpediente='+$(this).attr("idregistro")+"&idbusqueda_componente=<?php echo($_REQUEST["idbusqueda_componente"]);?>&rand=<?php echo(rand());?>",
         'height': ($("#panel_body").height())
      });  
    }  
  });
  
  $(".eliminar_expediente").live("click",function(){
  	var idregistro=$(this).attr("idregistro");
  	var cantidad=parseInt($("#contador_docs_"+$(this).attr("idregistro")).html());
  	if(cantidad>0){
  		notificacion_saia("El expediente tiene documentos almacenados, desvinculelos para eliminar","warning","",3000);
  		return false;
  	}
  	var confirmacion=confirm("Esta seguro de eliminar este expediente?");
  	if(confirmacion){
	  	$.ajax({
	      type:'GET',
	      async:false,
	      url: "<?php echo($ruta_db_superior);?>pantallas/expediente/ejecutar_acciones.php",
	      data: "ejecutar_expediente=delete_expediente&tipo_retorno=1&idexpediente="+idregistro,
	      success: function(html2){
	        if(html2){
	          var objeto2=jQuery.parseJSON(html2);
	          if(objeto2.exito){
	          	notificacion_saia(objeto2.mensaje,"success","",2500);
	          	$("#resultado_pantalla_"+idregistro).remove();
	          }
	        }
	      }
	    });
		}
  });


  $(".crear_folio_expediente").live("click",function(){
  	var idregistro=$(this).attr("idregistro");
  	var confirmacion=confirm("Esta seguro de crear un folio a este expediente?");
  	if(confirmacion){
	  	$.ajax({
	      type:'GET',
	      async:false,
	      url: "<?php echo($ruta_db_superior);?>pantallas/expediente/ejecutar_acciones.php",
	      data: "ejecutar_expediente=crear_folio_expediente&tipo_retorno=1&idexpediente="+idregistro,
	      success: function(html2){
	        if(html2){
	          var objeto2=jQuery.parseJSON(html2);
	          if(objeto2.exito){
	          	notificacion_saia(objeto2.mensaje,"success","",2500);
	          	$("#resultado_pantalla_"+idregistro).remove();
	          }
	        }
	      }
	    });
		}
  });
  
  
  
  
  
  $("#adicionar_expediente").live("click",function(){    
    window.open("<?php echo($ruta_db_superior);?>"+$(this).attr("enlace"),"iframe_detalle");
  });
  
  $(".sacar_expediente").live("click",function(){
  	var iddocumento=$(this).attr("iddocumento");
  	var idexpediente=$(this).attr("idexpediente");
  	if(iddocumento && idexpediente){
  		var confirmacion=confirm("Esta seguro de eliminar el documento de este expediente?");
	  	if(confirmacion){
	  		var padre=$(this).parent().parent().parent();
		  	$.ajax({
		      type:'GET',
		      async:false,
		      url: "<?php echo($ruta_db_superior);?>pantallas/expediente/ejecutar_acciones.php",
		      data: "ejecutar_expediente=delete_documento_expediente&tipo_retorno=1&idexpediente="+idexpediente+"&iddocumento="+iddocumento,
		      success: function(html2){
		        if(html2){
		          var objeto2=jQuery.parseJSON(html2);
		          if(objeto2.exito){
		          	notificacion_saia(objeto2.mensaje,"success","",2500);
		          	padre.remove();
		          }
		        }
		      }
		    });
			}
  	}
  });
});
</script>