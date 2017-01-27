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
        $('.enlace_detalles_categoria_formato').live('click',function(){
            var idcategoria_formato=$(this).attr('idregistro');
            
            $("#iframe_detalle").attr({
                 'src':'<?php echo($ruta_db_superior);?>pantallas/categoria_formato/detalles_categoria_formato.php?idcategoria_formato='+idcategoria_formato,
                 'height': ($("#panel_body").height())
            });  
        });  
        
        $('.enlace_adicionar_categoria_formato').live('click',function(){
            var enlace=$(this).attr('enlace');
            $("#iframe_detalle").attr({
                 'src':'<?php echo($ruta_db_superior);?>'+enlace,
                 'height': ($("#panel_body").height())
            });            
        });
        $('.enlace_editar_categoria_formato').live('click',function(){
            var enlace=$(this).attr('enlace');
            var idcategoria_formato=$(this).attr('idregistro');
            enlace=enlace+'?idcategoria_formato='+idcategoria_formato;
            $("#iframe_detalle").attr({
                 'src':'<?php echo($ruta_db_superior);?>'+enlace,
                 'height': ($("#panel_body").height())
            });            
        });        
        $('.enlace_inactivar_categoria_formato').live('click',function(){
            var idcategoria_formato=$(this).attr('idregistro');
            var title=$(this).attr('title');
            if(confirm('Esta seguro de inactivar la categoria '+title+'?')){
                $.ajax({
                    type:'POST',
                    dataType: 'html',
                    url: "<?php echo($ruta_db_superior); ?>pantallas/categoria_formato/librerias.php",
                    data: {
                        ejecutar_funcion:'inactivate_categoria',
                        idcategoria_formato:idcategoria_formato
                    },
                    success: function(datos){
                        notificacion_saia(datos,'success','',4000);
                        $('#busqueda_pagina').val(1);
                        $("#fila_actual").val(0);
                        $("#resultado_busqueda<?php echo(@$_REQUEST['idbusqueda_componente']);?>").html('');
                        cargar_datos_scroll();                        
                    }
                });                
            }           
        });        
        $('.enlace_activar_categoria_formato').live('click',function(){
            var idcategoria_formato=$(this).attr('idregistro');
            var title=$(this).attr('title');
            if(confirm('Esta seguro de Activar la categoria '+title+'?')){
                $.ajax({
                    type:'POST',
                    dataType: 'html',
                    url: "<?php echo($ruta_db_superior); ?>pantallas/categoria_formato/librerias.php",
                    data: {
                        ejecutar_funcion:'activate_categoria',
                        idcategoria_formato:idcategoria_formato
                    },
                    success: function(datos){
                        notificacion_saia(datos,'success','',4000);
                        $('#busqueda_pagina').val(1);
                        $("#fila_actual").val(0);
                        $("#resultado_busqueda<?php echo(@$_REQUEST['idbusqueda_componente']);?>").html('');
                        cargar_datos_scroll();                        
                    }
                });                
            }           
        });          
         
        
    });
</script>


