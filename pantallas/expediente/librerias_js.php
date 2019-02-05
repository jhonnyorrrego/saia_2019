<script>
$(document).ready(function(){

    $(document).on("click", "#addExpediente,#addDocumentExp", function() {
      let idexp=$(this).data("id");
      let idcomp=$(this).data("componente");
      if($(this).attr("id")=="addExpediente"){
        $("#iframe_detalle").attr({
          'src':'<?= $ruta_db_superior ?>pantallas/expediente/adicionar_expediente.php?codPadre='+idexp+'&idbusqueda_componente='+idcomp
        });
      }else{
        $("#iframe_detalle").attr({
          'src':'<?= $ruta_db_superior.FORMATOS_CLIENTE ?>vincular_doc_expedie/adicionar_vincular_doc_expedie.php?idexpediente='+idexp+'&idbusqueda_componente='+idcomp
        });
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

  //Selector check/uncheck
  
	$(document).on("click",".selExp",function(){
		let i=$(this).children("i");
    let idexp=$(this).data("id");
		if(i.hasClass("icon-uncheck")){
			i.removeClass("icon-uncheck").addClass("icon-check");
      $('#resultado_pantalla_'+idexp).addClass("alert-info");
		}else{
			i.removeClass("icon-check").addClass("icon-uncheck");
      $('#resultado_pantalla_'+idexp).removeClass("alert-info");
		}
    
	});
  
  // Informacion del expediente

  $(document).on("click",".infoExp",function(){
    let idexp=$(this).data("id");
    let idcomp=$(this).data("componente");
    $("[id^='resultado_pantalla_']").removeClass("alert-warning");
    $('#resultado_pantalla_'+idexp).addClass("alert-warning");
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

  // Compartir documento
  $(document).on("click","#shareExp,.shareExp",function(){
    let idcomp=$(this).data("componente");
    if($(this).attr("id")=="shareExp"){
      if($(".selExp > .icon-check").length){
        let ids=[];
        let i=0;
        $(".icon-check").each(function() {
          ids[i]=$(this).parent().data("id");
          i++;
        });
        
       $("#iframe_detalle").attr({
          'src':'<?= $ruta_db_superior ?>pantallas/expediente/asignar_permiso_expediente.php?opcion=2&ids='+ids+'&idbusqueda_componente='+idcomp
        });
      }else{
        alert("Seleccione por lo menos un expediente");
      }
    }else{
      let idexp=$(this).data("id");      
      $("#iframe_detalle").attr({
        'src':'<?= $ruta_db_superior ?>pantallas/expediente/asignar_permiso_expediente.php?opcion=1&idexpediente='+idexp+'&idbusqueda_componente='+idcomp
      });  
    }
  });
  
});
</script>
