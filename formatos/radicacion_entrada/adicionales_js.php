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
echo(librerias_jquery('1.7'));
echo(librerias_notificaciones());
$busca_componente=busca_filtro_tabla("nombre","busqueda_componente","idbusqueda_componente=".$_REQUEST['idbusqueda_componente'],"",$conn);

?>
<script>
    $(document).ready(function(){        
        
        /*CHECK planilla y finalizar checkbox cuando es endistribucion, para que desde un solo checkbox se pueda usar finalizar y generar planilla*/
       $('.asignar_planilla_finalizar').live("click",function(){
       		var checkbox = $(this);
       		var idft=$(this).val();
       		
       		//endistribucion_f_
       		//endistribucion_p_
       		if(checkbox.is(':checked')===true){
       			$('#endistribucion_f_'+idft).attr('checked',true);
       			$('#endistribucion_p_'+idft).attr('checked',true);
       		}else{
       			$('#endistribucion_f_'+idft).attr('checked',false);
       			$('#endistribucion_p_'+idft).attr('checked',false);       			
       		}
       });
        
        $(".mensajeros").live("change",function(){
            var idft=$(this).attr("data-idft");
            var mensajero=$(this).val();
            $.ajax({
                        type:'POST',
                        dataType: 'json',
                        url: "<?php echo $ruta_db_superior;?>formatos/radicacion_entrada/actualizar_mensajero.php",
                        data: {
                                        idft_destino_radicacion:idft,
                                        mensajero_encargado:mensajero
                        },
                        success: function(datos){
                            notificacion_saia('Mensajero asignado exitosamente','success','',4000);
                            window.location.reload();
                        }
                        
            });   
        });
        
        $("#filtro_mensajeros").live("change",function(){
            var mensajero_filtro=$(this).val();
            <?php                 
            $var_idbusqueda_componente_reporte_radicacion_correspondencia=$_REQUEST['idbusqueda_componente'];
            ?>
            var idbusqueda_componente_reporte_radicacion_correspondencia='<?php echo($var_idbusqueda_componente_reporte_radicacion_correspondencia); ?>';
            window.location.href = "<?php echo $ruta_db_superior;?>pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente="+idbusqueda_componente_reporte_radicacion_correspondencia+"&variable_busqueda="+mensajero_filtro;
            
        });
        
        $('#finalizar_generar_item').live("change",function(){
        	
        	var valor=$(this).val();
        	if(valor=='boton_seleccionar_registros'){

		        /*Genera Planilla de Mensajeros*/
		            var mensajero_temp="";
		            var registros_seleccionados="";
					var mensajero="";
					var error=0;
					$('.planilla_mensajero').each(function(){
					    var checkbox = $(this);
					    if(checkbox.is(':checked')===true){
					        mensajero=$(this).attr('mensajero');
					        registros_seleccionados+=$(this).val()+",";
					        
					        if(mensajero_temp){
					            if(mensajero_temp!=mensajero){
					                error=1;
					            }
					        }
					        mensajero_temp=$(this).attr('mensajero');
						}
					});
						registros_seleccionados = registros_seleccionados.substring(0, registros_seleccionados.length-1);
						console.log(registros_seleccionados);
						if(registros_seleccionados==""){
							top.noty({text: 'No ha seleccionado ningun campo',type: 'error',layout: "topCenter",timeout:3500});
						}else if(error==1){
						    top.noty({text: 'No puede seleccionar diferentes mensajeros',type: 'error',layout: "topCenter",timeout:3500});
						}else{
							$("#finalizar_generar_item").after("<div style='display:none;' id='ir_adicionar_documento' class='link kenlace_saia' enlace='formatos/despacho_ingresados/adicionar_despacho_ingresados.php?idft="+registros_seleccionados+"&mensajero="+mensajero+"' conector='iframe' titulo='Generar Planilla Mensajeros'>---</div>");
							$("#ir_adicionar_documento").trigger("click");
							$("#ir_adicionar_documento").remove();
						}
        	} //fin if boton_seleccionar_registros
        	
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
         		$('.planilla_mensajero').attr('checked',true);
        		$('[name="recepcion[]"]').attr('checked',true);
        		$('.asignar_planilla_finalizar').attr('checked',true);       		
        	}
        	if( valor=='quitar_seleccionados_accion_distribucion' ){
        		$('.planilla_mensajero').attr('checked',false);
        		$('[name="recepcion[]"]').attr('checked',false);
        		$('.asignar_planilla_finalizar').attr('checked',false);
        	}
        	
       		$(this).val(''); 	
        });
        
    });
</script>