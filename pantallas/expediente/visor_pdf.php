<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
 if(is_file($ruta."db.php")){
   $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
 }
 $ruta.="../";
 $max_salida--;
}

include_once($ruta_db_superior."db.php");
?>

<iframe id="detalles_pdf" width="100%" height="100%" frameborder="0" name="detalles_pdf" src="<?php echo((@$_REQUEST["ruta"])); ?>"></iframe>
<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>js/jquery/1.4.2/jquery.js"></script>
<script>
$(document).ready(function(){
 var alto=($(document).height());
 $("#detalles_pdf").height(alto+450);
});
</script>