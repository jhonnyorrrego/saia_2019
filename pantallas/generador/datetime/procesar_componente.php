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
function procesar_datetime($idcampo='',$seleccionado='',$accion='',$campo=''){
	global $conn;
  if($idcampo==''){
    return("<div class='alert alert-error'>No existe campo para procesar</div>");
  }
	if($campo==''){
		$dato=busca_filtro_tabla("A.*, B.idpantalla_componente","campos_formato A,pantalla_componente B","A.etiqueta_html=B.nombre AND A.idcampos_formato=".$idcampo,"",$conn);      
	  $campo=$dato[0];  
	}
	$datos=explode("|",$campo["valor"]);
	if($datos[1]=="now()"){
		$datos[1]=date('Y-m-d H:i:s');
	}
	else{
		$datos[1]=$seleccionado;
	}
	return '<input data-format="'.$datos[0].'" type="text" name="'.$campo["nombre"].'" id="'.$campo["nombre"].'" value="'.$datos[1].'" readonly class="span5">
	<script type="text/javascript">
$(document).ready(function(){		
	$("#'.$campo["nombre"].'").datetimepicker({
    language: "es",
    pick12HourFormat: true
  });
	
});
</script>';
}
?>