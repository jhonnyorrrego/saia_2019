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

?>
<script>
    $(document).ready(function(){
        
        $("#nav_busqueda").after("<div style='margin:5px' class='ui-state-default ui-jqgrid-pager ui-corner-bottom'><button class='btn btn-mini' title='Realizar despacho' id='boton_seleccionar_registros'>Generar Planilla de Entrega</button></div>");
        /*Genera Planilla de Mensajeros*/
        $("#boton_seleccionar_registros").live("click",function(){
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
			            console.log(mensajero+mensajero_temp);
			        console.log(mensajero+mensajero_temp);
			            if(mensajero_temp!=mensajero){
			                error=1;
			            }
			        }
			        mensajero_temp=$(this).attr('mensajero');
				}
			});
				registros_seleccionados = registros_seleccionados.substring(0, registros_seleccionados.length-1);
				
				if(registros_seleccionados==""){
					top.noty({text: 'No ha seleccionado ningun campo',type: 'error',layout: "topCenter",timeout:3500});
				}else if(error=1){
				    top.noty({text: 'No puede seleccionar diferentes mensajeros',type: 'error',layout: "topCenter",timeout:3500});
				}else{
					$("#boton_seleccionar_registros").after("<div id='ir_adicionar_documento' class='link kenlace_saia' enlace='formatos/despacho_ingresados/idft="+registros_seleccionados+"&mensajero="+mensajero+"' conector='iframe' titulo='Generar Planilla Mensajeros'>---</div>");
					$("#ir_adicionar_documento").trigger("click");
					$("#ir_adicionar_documento").remove();
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
                        }
                        
            });   
        });
        
        $("#filtro_mensajeros").live("change",function(){
            var mensajero_filtro=$(this).val();
            window.location.href = "<?php echo $ruta_db_superior;?>pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=269&variable_busqueda="+mensajero_filtro;
            
        });
        
        $("#recepcion").live("change",function(){
            var idft=$(this).attr("data-idft");
            var funcionario=$(this).val();
            $.ajax({
                        type:'POST',
                        dataType: 'json',
                        url: "<?php echo $ruta_db_superior;?>formatos/radicacion_entrada/actualizar_recepcion.php",
                        data: {
                                        idft_destino_radicacion:idft,
                                        funcionario:funcionario
                        },
                        
            }); 
            
        });
        
    });
</script>