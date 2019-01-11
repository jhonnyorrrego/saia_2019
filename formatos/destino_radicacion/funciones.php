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
//include_once($ruta_db_superior."formatos/librerias_funciones_generales.php");

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
    //die('fine5');
    if($datos[0]['tipo_origen']==1){
    	
		
        ?>
            <script>
            $(document).ready(function(){
            	$('[name="origen_externo"]').val("<?php echo $datos[0]["persona_natural"]; ?>");         	
                $('[name="origen_externo"]').addClass('required');
               
            });       
            </script>
        <?php 
    }else{
        ?>
            <script>
            $(document).ready(function(){
                $('[name="nombre_origen"]').addClass('required');
               
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
     $('[name="nombre_origen"]').val("<?php echo($datos[0]["area_responsable"]); ?>");
   });
   </script>
   <?php }    
}
?>