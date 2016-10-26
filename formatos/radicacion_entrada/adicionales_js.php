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

?>
<script>
    $(document).ready(function(){
        
        $("#nav_busqueda").after("<div style='margin:5px' class='ui-state-default ui-jqgrid-pager ui-corner-bottom'><button class='btn btn-mini' title='Realizar despacho' id='boton_seleccionar_registros'>Realizar despacho</button></div>");
        
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
                        
                    });   
        });
        
        $("#filtro_mensajeros").live("change",function(){
            var mensajero_filtro=$(this).val();
            parent.window.location.href = "<?php echo $ruta_db_superior;?>pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=269&variable_busqueda="+mensajero_filtro;
            
        });
        
    });
</script>