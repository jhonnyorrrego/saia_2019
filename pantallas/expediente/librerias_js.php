<script>
$(document).ready(function(){

    $(document).on("click", "#addExpediente,#addDocumentExp", function() {  
        window.open("<?=$ruta_db_superior?>"+$(this).attr("enlace"),"iframe_detalle");
    });

    $(document).on("click","#shareExp",function(){    
        let seleccionados=$("#seleccionados_expediente").val();
        if(seleccionados){
            window.open("<?= $ruta_db_superior ?>"+$(this).attr("enlace")+"&idexpediente="+seleccionados,"iframe_detalle");
        }else{
            alert("Seleccione por lo menos un expediente");
        }
    });

    $(document).on("click","#transDocument",function(){
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

	$(document).on("click","#prestDocument",function(){
		var seleccionados=$("#seleccionados_expediente").val();
		var estado_archivo='$estado';
		if(seleccionados){
			enlace_katien_saia("<?= FORMATOS_CLIENTE ?>solicitud_prestamo/adicionar_solicitud_prestamo.php?id="+seleccionados+"&estado_archivo="+estado_archivo,"Solicitud de prestamo","iframe","");
		}else{
			alert("Seleccione por lo menos un expediente");
		}
	});

  //Selector check/uncheck
  
	$(document).on("click",".selExp",function(){
		let i=$(this).children("i");
		if(i.hasClass("icon-uncheck")){
			i.removeClass("icon-uncheck").addClass("icon-check");
		}else{
			i.removeClass("icon-check").addClass("icon-uncheck");
		}
	});
  
  // Informacion del expediente

  $(document).on("click",".infoExp",function(){
    let idexp=$(this).data("id");
    let idcomp=$(this).data("componente");
    $("#iframe_detalle").attr({
      'src':'<?=$ruta_db_superior?>pantallas/expediente/detalles_expediente.php?idexpediente='+idexp+'&idbusqueda_componente='+idcomp
    });  
  });

  // Creacion de tomo del expediente

  $(document).on("click",".tomoExp",function(){
    let idexp=$(this).data("id");
    var idcomponente=$(this).data("componente");
    if(confirm("Esta seguro de crear un tomo a este expediente?")){
      $.ajax({
        type : 'POST',
        async:false,
        url: "<?= $ruta_db_superior ?>pantallas/expediente/ejecutar_acciones.php",
        data: {methodExp:'createTomoExpedienteCont',idexpediente:idexp},
        dataType: 'json',
        success: function(response){
          if(response.exito){
            top.notification({
              message : "Tomo creado",
              type : "success",
              duration : 3000
            });
            window.location.reload();
          }else{
            top.notification({
              message : response.message,
              type : "error",
              duration : 3000
            });
          }
        },
        error : function() {
          top.notification({
            message : "Error al procesar la solicitud",
            type : "error",
            duration : 3000
          });
        }
      });
    }
  });

  // Editar el expediente

  $(document).on("click",".editExp",function(){
    let idexp=$(this).data("id");
    let idcomp=$(this).data("componente");
    $("#iframe_detalle").attr({
      'src':'<?= $ruta_db_superior ?>pantallas/expediente/editar_expediente.php?idexpediente='+idexp+'&idbusqueda_componente='+idcomp
    });  
  });

  //Eliminar el expediente
 $(document).on("click",".delExp",function(){
    let idexp=$(this).data("id");
    if(confirm("Esta seguro de eliminar el expediente?")){
      $.ajax({
        type : 'POST',
        async:false,
        url: "<?= $ruta_db_superior ?>pantallas/expediente/ejecutar_acciones.php",
        data: {methodExp:'deleteExpedienteCont',idexpediente:idexp},
        dataType: 'json',
        success: function(response){
          if(response.exito){
            $("#resultado_pantalla_"+idexp).remove();
            top.notification({
              message : "Expediente eliminado",
              type : "success",
              duration : 3000
            });
          }else{
            top.notification({
              message : response.message,
              type : "error",
              duration : 3000
            });
          }
        },
        error : function() {
          top.notification({
            message : "Error al procesar la solicitud",
            type : "error",
            duration : 3000
          });
        }
      });
    }
  });

/*
$(document).on('click', '.adicionar_seleccionados', function () {
  $(this).removeClass("adicionar_seleccionados");
  $(this).addClass("eliminar_seleccionado");
  $(this).children("i").removeClass("icon-uncheck");
  $(this).children("i").addClass("icon-check");
  var idregistro=$(this).attr('idregistro');
  if(idregistro!='undefined'){
    if($("#seleccionados").val()==''){
      $("#seleccionados").val(idregistro);
    }
    else{
      $("#seleccionados").val($("#seleccionados").val()+","+idregistro);            
    }
    $('#resultado_pantalla_'+idregistro).removeClass("well");
    $('#resultado_pantalla_'+idregistro).addClass("alert");
    $('#resultado_pantalla_'+idregistro).addClass("alert-info"); 
    $('.alert-info').css("padding","4px");
  }    
}); 
$(document).on('click', '.eliminar_seleccionado', function () {
  $(this).removeClass("eliminar_seleccionado");
  $(this).addClass("adicionar_seleccionados");
  $(this).children("i").removeClass("icon-check");
  $(this).children("i").addClass("icon-uncheck");
  var idregistro=$(this).attr('idregistro');
  if($("#seleccionados").val()!=''){
      var selec=$("#seleccionados").val().split(",");
      var unicos=$.unique(selec);
      var idx=unicos.indexOf(idregistro);
      if(idx!=-1){  
        unicos.splice(idx,1);
        $("#seleccionados").val(unicos);
      }
    }
    else{
      alert("no existen datos seleccionados");
    }
  $("#seleccionado_"+idregistro).remove();  
  $('#resultado_pantalla_'+idregistro).removeClass("alert");
  $('#resultado_pantalla_'+idregistro).removeClass("alert-info");
  $('#resultado_pantalla_'+idregistro).addClass("well");
});
$("#filtrar_seleccionados").click(function(){
  $("#panel_body .well").hide();
});
$("#restaurar_listado").click(function(){
  $("#panel_body .alert").addClass("well");
  $("#panel_body .alert").removeClass("alert");  
  $("#panel_body .alert").removeClass("alert-info");
  $("#panel_body .well").show();
});
$("#restaurar_seleccionados").click(function(){
  $("#panel_body .well").show();
});
$(document).on('click', '.adicionar_seleccionados_expediente', function () {
  $(this).removeClass("adicionar_seleccionados_expediente");
  $(this).addClass("eliminar_seleccionado_expediente");
  $(this).children("i").removeClass("icon-uncheck");
  $(this).children("i").addClass("icon-check");
  var idregistro=$(this).attr('idregistro');
  if(idregistro!='undefined'){
    if($("#seleccionados_expediente").val()==''){
      $("#seleccionados_expediente").val(idregistro);
    }
    else{
      $("#seleccionados_expediente").val($("#seleccionados_expediente").val()+","+idregistro);            
    }
         
  }    
});
$(document).on('click', '.eliminar_seleccionado_expediente', function () {
  $(this).removeClass("eliminar_seleccionado_expediente");
  $(this).addClass("adicionar_seleccionados_expediente");
  $(this).children("i").removeClass("icon-check");
  $(this).children("i").addClass("icon-uncheck");
  var idregistro=$(this).attr('idregistro');
  if($("#seleccionados_expediente").val()!=''){
      var selec=$("#seleccionados_expediente").val().split(",");
      var unicos=$.unique(selec);
      var idx=unicos.indexOf(idregistro);
      if(idx!=-1){  
        unicos.splice(idx,1);
        $("#seleccionados_expediente").val(unicos);
      }
    }
    else{
      alert("no existen datos seleccionados");
    }
  $("#seleccionado_"+idregistro).remove();  
  $('#resultado_pantalla_'+idregistro).removeClass("alert");
  $('#resultado_pantalla_'+idregistro).removeClass("alert-success");
  $('#resultado_pantalla_'+idregistro).addClass("well");
});


//--------


 
  
  $(".eliminar_expediente").on("click",function(){
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

 
  
  $(".sacar_expediente").on("click",function(){
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
 $('.enlace_documento_bloqueado').on('click',function(){
   
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
