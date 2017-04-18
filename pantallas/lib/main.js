$('.adicionar_seleccionados').live('click',function(){
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
$(".eliminar_seleccionado").live('click',function(){
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
$('.adicionar_seleccionados_expediente').live('click',function(){
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
    //$('#resultado_pantalla_'+idregistro).removeClass("well");
    //$('#resultado_pantalla_'+idregistro).addClass("alert");
    //$('#resultado_pantalla_'+idregistro).addClass("alert-success"); 
         
  }    
}); 
$(".eliminar_seleccionado_expediente").live('click',function(){
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