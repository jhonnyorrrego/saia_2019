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
              	},
        		url: '<?php echo($ruta_db_superior); ?>distribucion/cambiar_mensajero_distribucion.php',
        		success : function(data) {
          			notificacion_saia('Mensajero asignado exitosamente','success','',4000);
                    window.location.reload();
        		}
    		}); 			
			
		});
		
		
		
				
	});  //FIN IF documento.ready

</script>


<?php


?>