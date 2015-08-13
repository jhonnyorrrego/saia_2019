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
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");

	$start = date("Y-m-d",($_REQUEST["start"]));	
	$end   = date("Y-m-d",($_REQUEST["end"]));
	
	$tareas=busca_filtro_tabla("A.*,A.fecha_formato,C.estado,D.fecha","ft_recordar_tarea A left join ft_avances C ON C.ft_recordar_tarea=A.idft_recordar_tarea left join ft_cierre_tarea D ON D.ft_recordar_tarea=A.idft_recordar_tarea, documento B","B.iddocumento=A.documento_iddocumento and B.estado not in ('ELIMINADO','ANULADO')","GROUP BY A.documento_iddocumento",$conn);	
 		
	$fecha_actual=date("Y-m-d");
		for ($i=0;$i<$tareas["numcampos"];$i++) {
		$fech = $tareas[$i]["fecha_entraga"];
		$respo=explode(",", $tareas[$i]["responsable"]);
		 
				$tam=sizeof($respo);
		
		$fecha2 = $tareas[$i]["fecha_entraga"]; 
		$fecha_serie=(date("Y-m-d", strtotime("$fecha2 +5 day")));
		
		$color="blue";
	
	if(!$tareas[$i]["fecha"]||$tareas[$i]["fecha"]==NULL||$tareas[$i]["fecha"]==""){
		$resta=diferenciaEntreFechas2($fecha_serie, $fecha_actual, $obtener = 'DIAS', $redondear = TRUE);
		if($tareas[$i]["estado"]=="Ejecutada"||$tareas[$i]["estado"]=="Cancelada"||$tareas[$i]["ejecutado"]==1)
		  $color="#2E8702";
		   //print_r($tareas[$i]["estado"]);
		if($resta>0&&$tareas[$i]["estado"]!="Ejecutada"&&$tareas[$i]["estado"]!="Cancelada"&&$tareas[$i]["ejecutado"]!=1)
			$color="#0000FF";
		if($resta<=0&&$tareas[$i]["estado"]!="Ejecutada"&&$tareas[$i]["estado"]!="Cancelada"&&$tareas[$i]["ejecutado"]!=1)
			$color="#FF3333";
		}else{
		$resta=diferenciaEntreFechas2($fecha_serie, $tareas[$i]["fecha"], $obtener = 'DIAS', $redondear = TRUE);	
		if($tareas[$i]["estado"]=="Ejecutada"||$tareas[$i]["estado"]=="Cancelada"||$tareas[$i]["ejecutado"]==1){
			$color="#2E8702";
			 
		}
		if($resta>0&&$tareas[$i]["estado"]!="Ejecutada"&&$tareas[$i]["estado"]!="Cancelada"&&$tareas[$i]["ejecutado"]!=1){
			$color="#0000FF";
		}	
		if($resta<=0&&$tareas[$i]["estado"]!="Ejecutada"&&$tareas[$i]["estado"]!="Cancelada"&&$tareas[$i]["ejecutado"]!=1){
			$color="#FF3333";
		}
	}		
		//for ($j=0;$j<$tam;$j++) { 
			$responsable=busca_filtro_tabla("nombres, apellidos","dependencia_cargo A,funcionario B","funcionario_idfuncionario=idfuncionario and iddependencia_cargo=".$respo[0],"",$conn);
   		$datos.= strip_tags(utf8_encode(html_entity_decode($tareas[$i]["idft_recordar_tarea"].'&&'.$tareas[$i]["tarea_asiganda"].' -Responsable: '.$responsable[0]["nombres"].' '.$responsable[0]["apellidos"].'&&'.$fech.'&&'.$fech.'&&../ordenar.php?accion=mostrar&tipo_destino=1&mostrar_formato=1&key='.$tareas[$i]["documento_iddocumento"]."&&".$color."@")));
		//}
	}
	echo $datos;	
?>
