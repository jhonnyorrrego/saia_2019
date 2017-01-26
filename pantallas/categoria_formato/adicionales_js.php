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
        $('.enlace_detalles_categoria_formato').live('click',function(){
            var idcategoria_formato=$(this).attr('idregistro');
            
            $("#iframe_detalle").attr({
                 'src':'<?php echo($ruta_db_superior);?>pantallas/expediente/detalles_categoria_formato.php?idcategoria_formato='+idcategoria_formato,
                 'height': ($("#panel_body").height())
            });  
        });    
    });
</script>


