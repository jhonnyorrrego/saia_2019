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

function validar_ingreso_cierre($idformato,$iddoc){
	global $conn;
	
	$band=0;
	//$papa=buscar_papa_formato($idformato,$iddoc,"ft_avance_tarea");
	$papa=$_REQUEST["anterior"];
	
	$avance=busca_filtro_tabla("B.estado","ft_recordar_tarea A, ft_avances B","ft_recordar_tarea=idft_recordar_tarea and A.documento_iddocumento=".$papa,"",$conn);
	
	for ($i=0;$i<$avance["numcampos"];$i++) { 
		if($avance[$i]["estado"]=='Ejecutada'){
			$band=1;
		}
	}
	if($band==0){
		alerta("La tarea aún no está en estado Ejecutada!");
		redirecciona("../../vacio.php");
	}
}
?>