<?php
if(!@$_SESSION["LOGIN".LLAVE_SAIA]){
@session_start();
$_SESSION["LOGIN".LLAVE_SAIA]="cerok";
$_SESSION["usuario_actual"]="1";
}
//ini_set("display_errors",true);
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
include_once($ruta_db_superior."class_transferencia.php");
include_once($ruta_db_superior."librerias/funciones_formatos_generales.php");

$enviar=envio_recordatorio();
function envio_recordatorio(){
	global $conn;
	
	$periodo=busca_filtro_tabla("responsable_tarea,documento_iddocumento,numero,horas_recordar,dias_recordar,tipo_periodo,semanas_recordar,meses_recordar,periodicidad,fecha_formato","ft_recordar_tarea, documento","documento_iddocumento=iddocumento and estado not in ('ELIMINADO','ANULADO') ","",$conn);

	$fecha_actual=date("Y-m-d");
	
	for($i=0;$i<$periodo["numcampos"];$i++){
		
		$respo=explode(",", $periodo[$i]["responsable_tarea"]);
		$tam=sizeof($respo);
		
		for ($k=0;$k<$tam;$k++){
		
		$responsable=busca_filtro_tabla("funcionario_codigo","funcionario f, dependencia_cargo dc","dc.estado=1 and funcionario_idfuncionario=idfuncionario and iddependencia_cargo=".$respo[$k],"",$conn);		

		$estado_avance=busca_filtro_tabla("B.estado,A.ejecutado","ft_recordar_tarea A, ft_avance B","ft_recordar_tarea=idft_recordar_tarea and A.documento_iddocumento=".$periodo[$i]["documento_iddocumento"],"",$conn);

		if($periodo[$i]["periodicidad"]==2){
			$Fecha2 = $periodo[$i]["fecha_formato"];
			$fech2= date("Y-m-d", strtotime("$Fecha2 +1 day"));
		}
		if($periodo[$i]["periodicidad"]==3){
			$Fecha2= $periodo[$i]["fecha_formato"]; 
			$fech2= date("Y-m-d", strtotime("$Fecha2 +7 day"));
		}	
		if($periodo[$i]["periodicidad"]==4){
			$Fecha2 = $periodo[$i]["fecha_formato"]; 
			$fech2= date("Y-m-d", strtotime("$Fecha2 +1 month"));
		}	
		if($periodo[$i]["periodicidad"]==5){
			$Fecha2 = $periodo[$i]["fecha_formato"]; 
			$fech2= date("Y-m-d", strtotime("$Fecha2 +1 year"));
		}
		if($periodo[$i]["periodicidad"]==6){
			$Fecha2 = $periodo[$i]["fecha_formato"]; 
			$fech2= date("Y-m-d", strtotime("$Fecha2 +6 month"));
		}
		if($periodo[$i]["periodicidad"]==7){
			$Fecha2 = $periodo[$i]["fecha_formato"]; 
			$fech2= date("Y-m-d", strtotime("$Fecha2 +2 month"));
		}
		if($periodo[$i]["periodicidad"]==8){
			$Fecha2 = $periodo[$i]["fecha_formato"]; 
			$fech2= date("Y-m-d", strtotime("$Fecha2 +3 month"));
		}
		if($periodo[$i]["periodicidad"]==9){
			$Fecha2 = $periodo[$i]["fecha_formato"];
			$fech2= date("Y-m-d", strtotime("$Fecha2 +14 day"));
		}
	/////
		if($periodo[$i]["periodo_recordar"]==1&&$periodo[$i]["periodicidad"]<>1){
			$Fecha = $fech2;
			$fech= date("Y-m-d", strtotime("$Fecha -".$periodo[$i]["horas_recordar"]." hour"));
		}
		if($periodo[$i]["periodo_recordar"]==2&&$periodo[$i]["periodicidad"]<>1){
			$Fecha = $fech2;
			$fech= date("Y-m-d", strtotime("$Fecha -".$periodo[$i]["dias_recordar"]." day"));
		}
		if($periodo[$i]["periodo_recordar"]==3&&$periodo[$i]["periodicidad"]<>1){
			$Fecha = $fech2;
			$fech= date("Y-m-d", strtotime("$Fecha -".$periodo[$i]["semanas_recordar"]." week"));
		}
		if($periodo[$i]["periodo_recordar"]==4&&$periodo[$i]["periodicidad"]<>1){
			$Fecha = $fech2;
			$fech= date("Y-m-d", strtotime("$Fecha -".$periodo[$i]["meses_recordar"]." month"));
		}
		if($fecha_actual>=$fech&&$fecha_actual&&$fech&&$estado_avance[0]["ejecutado"]<>1){			
			$usuarios=array($responsable[0][0]);//array($responsable[0][0]);
			$mensaje='<p>Se&ntilde;or Usuario,<br /><br /> recuerde que tiene una tarea asignada pronto a cumplirse con el No. '.$periodo[$i]["numero"];//texto del correo
			//enviar_notificaciones_nucleo($usuarios,$mensaje);
		}
		}
	}
}
if(@$_SESSION["LOGIN".LLAVE_SAIA]){
 @session_unset();
 @session_destroy();
}	
?>