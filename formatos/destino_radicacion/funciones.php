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
include_once($ruta_db_superior."formatos/librerias_funciones_generales.php");

function ocultar_campos_destino_radicacion($idformato,$iddoc){
    global $conn,$ruta_db_superior;
    
    $datos=busca_filtro_tabla('','ft_radicacion_entrada','idft_radicacion_entrada='.$_REQUEST['padre'],'',conn);
    //print_r($datos);
    
    ?>
        <script>
            $(document).ready(function(){
                //alert('entra');
                $('[name="tipo_origen"]').val('<?php echo $datos[0]["tipo_origen"];?>');
                $('[name="tipo_destino"]').val('<?php echo $datos[0]["tipo_destino"];?>');
                $('#opcion_item2').attr('checked','checked');
            });
        </script>
    <?php
    if($datos[0]['tipo_origen']==1){
    	
		$datos_ejecutor=busca_filtro_tabla("b.nombre,b.identificacion,b.idejecutor","datos_ejecutor a, ejecutor b","a.ejecutor_idejecutor=b.idejecutor AND a.iddatos_ejecutor=".$datos[0]["persona_natural"],"",$conn);
        ?>
            <script>
            $(document).ready(function(){
 				$("#frame_origen_externo").load(function(){
     				$(this.contentDocument).find('#estado_actualizacion').html("<?php echo codifica_encabezado(html_entity_decode($datos_ejecutor[0]["nombre"])); ?>");
     				$(this.contentDocument).find('#nombre_ejecutor').val("<?php echo codifica_encabezado(html_entity_decode($datos_ejecutor[0]["nombre"])); ?>");	
     				$(this.contentDocument).find('#identificacion_ejecutor').val("<?php echo $datos_ejecutor[0]["identificacion"]; ?>");		
     				$("#origen_externo").val("<?php echo $datos[0]["persona_natural"]; ?>");
	 				$(this.contentDocument).find("#destinos_seleccionados").val("<?php echo $datos[0]["persona_natural"]; ?>");
   				});            	
            	
                $('[name="origen_externo"]').addClass('required');
                $('[name="nombre_origen"]').parent().parent().hide();
                				loadIframe('frame_origen_externo','../librerias/acciones_ejecutor.php?formulario_autocompletar=formulario_formatos&campo_autocompletar=origen_externo&tabla=ft_destino_radicacion&campos_auto=nombre,identificacion&tipo=unico&campos=cargo,empresa,direccion,telefono,email,titulo,ciudad&funcion_javascript=llenar_ejecutor@<?php echo($datos_ejecutor[0]['idejecutor']); ?>');
            });
				function loadIframe(iframeName, url) {
				    var $iframe = $('#' + iframeName);
				    if ( $iframe.length ) {
				        $iframe.attr('src',url);   
				        return false;
				    }
				    return true;
				}            
            
            </script>
        <?php 
    }else{
        ?>
            <script>
            $(document).ready(function(){
                $('[name="nombre_origen"]').addClass('required');
                $('[name="origen_externo"]').parent().parent().hide();
            });
            </script>
        <?php 
    }
    if($datos[0]['tipo_destino']==1){
        ?>
            <script>
            $(document).ready(function(){
                $('[name="destino_externo"]').addClass('required');
                $('[name="nombre_destino"]').parent().parent().hide();
            });
            </script>
        <?php 
    }else{
        ?>
            <script>
            $(document).ready(function(){
                $('[name="nombre_destino"]').addClass('required');
                $('[name="destino_externo"]').parent().parent().hide();
            });
            </script>
        <?php 
    }
    
    //Seleccionar origen automaticamente
   if($datos[0]['tipo_origen']==2){?>
   <script>
   $(document).ready(function(){
     tree_nombre_origen.setOnLoadingEnd(fin_cargando_nombre_origen2);
   });
   
   function fin_cargando_nombre_origen2(){
     tree_nombre_origen.setCheck(<?php echo($datos[0]["area_responsable"]); ?>,true);
     $("#nombre_origen").val("<?php echo($datos[0]["area_responsable"]); ?>");
     tree_nombre_origen.openItem(<?php echo($datos[0]["area_responsable"]); ?>);
   }
   </script>
   <?php }    
}
?>