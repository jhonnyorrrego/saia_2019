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
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

function nombre_control_cita($idformato,$iddoc){
	global $conn;
	
	if($_REQUEST["anterior"]){
		$nombre_paciente=busca_filtro_tabla("a.nombre_paciente","ft_solicitud_cita a","a.documento_iddocumento=".$_REQUEST["anterior"],"",$conn);
		$nombre_paciente=utf8_encode(html_entity_decode($nombre_paciente[0]["nombre_paciente"]));
	}
	
	if($_REQUEST["iddoc"]){
		$nombre_paciente=busca_filtro_tabla("a.nombre_paciente_control","ft_control_cita","a.documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
		$nombre_paciente=utf8_encode(html_entity_decode($nombre_paciente[0]["nombre_paciente_control"]));
	}
	

?>
<script type="text/javascript">
	$(document).ready(function(){
		var nombre="<?php echo($nombre_paciente);?>";
		$("#nombre_paciente_control").attr("value",nombre);
		$("#nombre_paciente_control").attr("readonly",true);
		

	});

</script>
<?php
}

?>