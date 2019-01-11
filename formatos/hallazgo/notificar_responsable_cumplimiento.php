<?php
@set_time_limit(0);
if(!@$_SESSION["LOGIN"]){
@session_start();
$_SESSION["LOGIN"]="0k";
$_SESSION["usuario_actual"]="1449"; 
}
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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."class_transferencia.php");

$responsables_cumplimiento = busca_filtro_tabla("responsables,documento_iddocumento","ft_hallazgo","ROUND(tiempo_cumplimiento-sysdate) IN(5,10,15)","",$conn);

if($responsables_cumplimiento["numcampos"]){
		
	for ($i=0; $i < $responsables_cumplimiento["numcampos"]; $i++) {
		
		$datos_documento = obtener_datos_documento($responsables_cumplimiento[$i]["documento_iddocumento"]);			
		$responsables = retornar_seleccionados($responsables_cumplimiento[$i]["responsables"]);		
		$responsables = implode("@", $responsables);		
		transferencia_automatica($datos_documento["idformato"],$datos_documento["iddocumento"],$responsables.'@',3,"Como responsable de cumplimiento de este hallazgo, por favor verifique o reporte cumplimiento del mismo");							
	}	
}

$nota = "Dia de ejecucion: ".date("Y-m-d H:m:s")."\nSQL ejecutado: ".$responsables_cumplimiento["sql"]."\n_________________\n";

$log=fopen($ruta_db_superior."tareas/tareas_administrativas_saia/logs/log_hallasgos_plan_mejoramiento_responsables_cumplimiento.txt","a+");
fwrite($log,$nota);
fclose($log);
@session_destroy(); 