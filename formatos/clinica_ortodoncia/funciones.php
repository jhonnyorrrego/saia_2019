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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");


function activar_campo_tiempo($idformato,$iddoc){
	global $conn;
	

?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#cuanto_tiempo").parent().parent().hide();
		$("#edad").parent().parent().hide();
		
		$("input[name='tratamientos_previos']").click(function(){
		
			if(parseInt($(this).val()) === 1){
	 				
	 			$("#cuanto_tiempo").parent().parent().show();
	 			$("#cuanto_tiempo").val(" ");
	 		}
	 		if(parseInt($(this).val()) === 0){
	 				
	 			$("#cuanto_tiempo").parent().parent().hide();
	 			$("#cuanto_tiempo").val(" ");
	 		}
			
			});
		
	});
	
</script>
<?php
}

function calcular_edad($idformato,$iddoc){
	global $conn;
	$fecha=busca_filtro_tabla("fecha_nacimiento","ft_clinica_ortodoncia","documento_iddocumento=".$iddoc,"",$conn);
	
	$datos=explode("-",$fecha[0]["fecha_nacimiento"]);
	
$fecha = time();         
date ( "Y:n:j" , $fecha ); 

$anno=date("Y")-$datos[0];
$meses=date("m")-$datos[1];
$dia=date("d")-$datos[2];

if($dias<0){
	$dias+=$dias_del_mes[$hoy['mon']];
	$meses--;
}
if($meses<0){
	$meses+=12;
	$anno--;
}
echo($anno." años y ".$meses." meses");

}
?>
