<script>
$(document).ready(function(){
  $(".enlace_caja").live("click",function(){
    if($(this).attr("enlace") !==undefined && $(this).attr("enlace") !==''){
      $("#iframe_detalle").attr({
         'src':'<?php echo($ruta_db_superior);?>'+$(this).attr("enlace")+"&rand=<?php echo(rand());?>",
         'height': ($("#panel_body").height())
      });
    }
    else{
      $("#iframe_detalle").attr({
         'src':'<?php echo($ruta_db_superior);?>pantallas/caja/detalles_caja.php?idcaja='+$(this).attr("idregistro")+"&idbusqueda_componente=<?php echo($_REQUEST["idbusqueda_componente"]);?>&rand=<?php echo(rand());?>",
         'height': ($("#panel_body").height())
      });  
    }  
  });
  
  $(".eliminar_caja").live("click",function(){
  	var confirmacion=confirm("Esta seguro de eliminar esta caja?");
  	if(confirmacion){
	  	var idregistro=$(this).attr("idregistro");
	  	$.ajax({
	      type:'GET',
	      async:false,
	      url: "<?php echo($ruta_db_superior);?>pantallas/caja/ejecutar_acciones.php",
	      data: "ejecutar_caja=delete_caja&tipo_retorno=1&idcaja="+idregistro,
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
  
  $("#adicionar_caja").live("click",function(){    
    window.open("<?php echo($ruta_db_superior);?>"+$(this).attr("enlace"),"iframe_detalle");
  });
});
</script>