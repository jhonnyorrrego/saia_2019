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
include_once($ruta_db_superior."assets/librerias.php");
echo (jquery());  

?>
<script type="text/javascript">
$(".estado_verificacion").live("change",function(){
	var estado=$(this).val();
	var iddoc=$(this).attr("iddocumento");
	if(estado!=""){
		$.ajax({
			type:'POST',
			url: "../../formatos/pqrsf/reporte.php",
			data: {estado_verif:estado, iddoc_verificacion:iddoc},
			success: function(respuesta){
				$("#funcionario_"+iddoc).html(respuesta);
				$("#estado_veri_"+iddoc).html("Verificado");
			}	
		});
	}
});
</script>