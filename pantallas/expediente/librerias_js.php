<script>
$(document).ready(function(){

    $("#addExpediente,#addDocumentExp").live("click",function(){    
        window.open("<?=$ruta_db_superior?>"+$(this).attr("enlace"),"iframe_detalle");
    });


    $("#shareExp").live("click",function(){    
        let seleccionados=$("#seleccionados_expediente").val();
        if(seleccionados){
            window.open("<?= $ruta_db_superior ?>"+$(this).attr("enlace")+"&idexpediente="+seleccionados,"iframe_detalle");
        }else{
            alert("Seleccione por lo menos un expediente");
        }
    });

    $("#transDocument").live("click",function(){ 
        let seleccionados=$("#seleccionados_expediente").val();
        $.ajax({
            type : "POST",
            url : "../expediente/validar_cierre_expedientes.php",
            data : {idexpedientes : seleccionados},
            dataType:"json",
            success : function (response){
                if(response.exito == 1){
                    enlace_katien_saia("<?= FORMATOS_CLIENTE ?>transferencia_doc/adicionar_transferencia_doc.php?id="+seleccionados,"Transferencia documental","iframe","");
                }else{
                    alert(response.msn);
                }
            },
            error : function (err){
                alert("Error al procesar la solicitud");
            }
        });
    });

	$("#prestDocument").click(function(){
		var seleccionados=$("#seleccionados_expediente").val();
		var estado_archivo='$estado';
		if(seleccionados){
			enlace_katien_saia("<?= FORMATOS_CLIENTE ?>solicitud_prestamo/adicionar_solicitud_prestamo.php?id="+seleccionados+"&estado_archivo="+estado_archivo,"Solicitud de prestamo","iframe","");
		}else{
			alert("Seleccione por lo menos un expediente");
		}
	});

/*
  $(".enlace_expediente").live("click",function(){
    if($(this).attr("enlace") !==undefined && $(this).attr("enlace") !==''){
      $("#iframe_detalle").attr({
         'src':'<?php echo ($ruta_db_superior); ?>'+$(this).attr("enlace")+"&rand=<?php echo (rand()); ?>",
         'height': ($("#panel_body").height())
      });
    }
    else{
      $("#iframe_detalle").attr({
         'src':'<?php echo ($ruta_db_superior); ?>pantallas/expediente/detalles_expediente.php?idexpediente='+$(this).attr("idregistro")+"&idbusqueda_componente=<?php echo ($_REQUEST["idbusqueda_componente"]); ?>&rand=<?php echo (rand()); ?>",
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
	      url: "<?php echo ($ruta_db_superior); ?>pantallas/expediente/ejecutar_acciones.php",
	      data: "ejecutar_expediente=delete_expediente&tipo_retorno=1&idexpediente="+idregistro,
	      success: function(html2){
	        if(html2){
	          var objeto2=jQuery.parseJSON(html2);
	          if(objeto2.exito){
	          	notificacion_saia(objeto2.mensaje,"success","",2500);
	          	$("#resultado_pantalla_"+idregistro).remove();
	          	window.location.reload();
	          }
	        }
	      }
	    });
		}
  });


  $(".crear_tomo_expediente").live("click",function(){
  	var idregistro=$(this).attr("idregistro");
  	var confirmacion=confirm("Esta seguro de crear un tomo a este expediente?");
  	if(confirmacion){
	  	$.ajax({
	      type:'GET',
	      async:false,
	      url: "<?php echo ($ruta_db_superior); ?>pantallas/expediente/ejecutar_acciones.php",
	      data: "ejecutar_expediente=crear_tomo_expediente&tipo_retorno=1&idexpediente="+idregistro,
	      success: function(html2){
	        if(html2){
	          var objeto2=jQuery.parseJSON(html2);
	          if(objeto2.exito){
	          	notificacion_saia(objeto2.mensaje,"success","",2500);
							window.location.reload();
	          }
	        }
	      }
	    });
		}
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
		      url: "<?php echo ($ruta_db_superior); ?>pantallas/expediente/ejecutar_acciones.php",
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
  
  
  
 //usted no tiene autorizacion para acceder, favor solicitar 
 $('.enlace_documento_bloqueado').live('click',function(){
   
   var iddoc=$(this).attr('iddoc');
    $.ajax({
        type:'POST',
        dataType: 'json',
        url: "<?php echo ($ruta_db_superior); ?>pantallas/expediente/ejecutar_acciones.php",
        data: {
            iddoc:iddoc,
            ejecutar_expediente:'obtener_rastro_documento_expediente'
        },
        success: function(datos){
            var alerta="<b>ATENCI&Oacute;N!<b><br><br>Usted no tiene autorizaci&oacute;n para acceder, favor solicitar el permiso a: "+datos.msn;
            notificacion_saia(alerta,"warning","",6000);
          }
      });       
     
 });

$('.enlace_documento_bloqueado').parent().css("opacity","0.2");*/
});
</script>
