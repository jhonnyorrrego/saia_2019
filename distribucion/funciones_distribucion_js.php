<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery('1.7'));

?>

<script>
	$(document).ready(function(){
	
	
		//Mensajero - class= select_mensajeros_ditribucion
		$('.select_mensajeros_ditribucion').live('change',function(){
			var mensajero=$(this).val();
			var iddistribucion=$(this).attr('iddistribucion');
			$.ajax({
        		type: "POST",
        		dataType: 'json',
        		data: { 
                	mensajero:mensajero,
                	iddistribucion:iddistribucion,
                	ejecutar_accion:'cambiar_mensajero_distribucion'
              	},
        		url: '<?php echo($ruta_db_superior); ?>distribucion/ejecutar_acciones_distribucion.php',
        		success : function(data) {
          			notificacion_saia('Mensajero asignado exitosamente','success','',4000);
                    window.location.reload();
        		}
    		}); 			
			
		});
		
		
		
		//Acción - class= accion_distribucion - select id: opciones_acciones_distribucion
        $('#opciones_acciones_distribucion').live("change",function(){
        	
        	var valor=$(this).val();
        	if(valor=='boton_generar_planilla'){

		    	/*Genera Planilla de Mensajeros*/
		        var mensajero_temp="";
		        var registros_seleccionados="";
				var mensajero="";
				var error=0;
				$('.accion_distribucion').each(function(){
					var checkbox = $(this);
					if(checkbox.is(':checked')===true){
						var iddistribucion=$(this).val();
					    mensajero=$('#select_mensajeros_ditribucion_'+iddistribucion).val();
					        
					    registros_seleccionados+=iddistribucion+",";
					        
					    if(mensajero_temp){
					    	if(mensajero_temp!=mensajero){
					        	error=1;
					        }
					    }
					    mensajero_temp=mensajero;
					}
				});
				
				registros_seleccionados = registros_seleccionados.substring(0, registros_seleccionados.length-1);
						
				if(registros_seleccionados==""){
					top.noty({text: 'No ha seleccionado ningun campo',type: 'error',layout: "topCenter",timeout:3500});
				}else if(error==1){
					top.noty({text: 'No puede seleccionar diferentes mensajeros',type: 'error',layout: "topCenter",timeout:3500});
				}else{
					
					$("#opciones_acciones_distribucion").after("<div style='display:none;' id='ir_adicionar_documento' class='link kenlace_saia' enlace='formatos/despacho_ingresados/adicionar_despacho_ingresados.php?iddistribucion="+registros_seleccionados+"&mensajero="+mensajero+"' conector='iframe' titulo='Generar Planilla Mensajeros'>---</div>");
					$("#ir_adicionar_documento").trigger("click");
					$("#ir_adicionar_documento").remove();
				}
        	} //fin if boton_generar_planilla
        	
        	if(valor=='boton_finalizar_entrega'){

		            var idft_funcionario=JSON.stringify($('[name="recepcion[]"]').serializeArray());
		 			if(idft_funcionario=='[]'){
		 				top.noty({text: 'Debe seleccionar al menos un Item!',type: 'warning',layout: "topCenter",timeout:3500});
		 			}else{
			            $.ajax({
			                type:'POST',
			                dataType: 'json',
			                url: "<?php echo $ruta_db_superior;?>formatos/radicacion_entrada/actualizar_recepcion.php",
			                data: {
			                    idft_funcionario:idft_funcionario
			                },
			                success: function(datos){
			                    top.noty({text: 'Items finalizados satisfactoriamente!',type: 'success',layout: "topCenter",timeout:3500});
			                    window.location.reload();
			                }
			            });
		 			}
        	} //fin if boton_finalizar_entrega
        	
        	
        	if( valor=='seleccionar_todos_accion_distribucion' ){
         		$('.accion_distribucion').attr('checked',true);
        	}
        	if( valor=='quitar_seleccionados_accion_distribucion' ){
        		$('.accion_distribucion').attr('checked',false);
        	}
        	
       		$(this).val(''); 	
      });  //FIN IF opciones_acciones_distribucion
		
		
				
	});  //FIN IF documento.ready

</script>


<?php


?>