<?php

$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
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

/*
 * <parametros>$impacto = Campo impacto del riesgo
 * </parametros>
 * <responsabilidades>Retorna el texto correspondiente al que pertenece el impacto
 * </responsabilidades>
 */
function impacto($impacto){
	$cadena='';
	if($impacto==1){
		$texto="Insignificante";
	}
	if($impacto==2){
		$texto="Menor";
	}
	if($impacto==3){
		$texto="Moderado";
	}
	if($impacto==4){
		$texto="Mayor";
	}
	if($impacto==5){
		$texto="Catastr&oacute;fico";
	}
	if($texto!='')
		$cadena.='('.$impacto.')<br>'.$texto;
	return $cadena;
}
/*
 * <parametros>$probabilidad = Campo probabilidad del riesgo
 * </parametros>
 * <responsabilidades>Retorna el texto correspondiente al que pertenece la probabilidad
 * </responsabilidades>
 */
function probabilidad($probabilidad){
	$cadena='';
	if($probabilidad==1){
		$texto="Raro";
	}
	if($probabilidad==2){
		$texto="Improbable";
	}
	if($probabilidad==3){
		$texto="Posible";
	}
	if($probabilidad==4){
		$texto="Probable";
	}
	if($probabilidad==5){
		$texto="Casi seguro";
	}
	if($texto!='')
		$cadena.='('.$probabilidad.')<br>'.$texto;
	return $cadena;
}
/*
 * <parametros>$probabilidad = Campo probabilidad del riesgo
 * $impacto= Campo impacto del riesgo
 * </parametros>
 * <responsabilidades>Retorna la letra correspondiente de probabilidad vs impacto
 * </responsabilidades>
 */
function tabla_evaluacion($probabilidad,$impacto){
	$evaluacion[1][1]="B";
	$evaluacion[1][2]="B";
	$evaluacion[1][3]="M";
	$evaluacion[1][4]="A";
	$evaluacion[1][5]="A";
	
	$evaluacion[2][1]="B";
	$evaluacion[2][2]="B";
	$evaluacion[2][3]="M";
	$evaluacion[2][4]="A";
	$evaluacion[2][5]="E";
	
	$evaluacion[3][1]="B";
	$evaluacion[3][2]="M";
	$evaluacion[3][3]="A";
	$evaluacion[3][4]="E";
	$evaluacion[3][5]="E";
	
	$evaluacion[4][1]="M";
	$evaluacion[4][2]="A";
	$evaluacion[4][3]="A";
	$evaluacion[4][4]="E";
	$evaluacion[4][5]="E";
	
	$evaluacion[5][1]="A";
	$evaluacion[5][2]="A";
	$evaluacion[5][3]="E";
	$evaluacion[5][4]="E";
	$evaluacion[5][5]="E";
	
	return $evaluacion[$probabilidad][$impacto];
}
/*
 * <parametros>$letra = Letra al que corresponde probabilidad vs impacto
 * $tipo= 1: Cuando es una simple evaluacion.
 * 2: Cuando es calculando con la valoracion
 * </parametros>
 * <responsabilidades>Retorna el texto correspondiente segun la letra probabilidad vs impacto
 * </responsabilidades>
 */
function texto_evaluacion($letra,$tipo=1){
	if($tipo==1){
		if($letra=="A"){
			$texto="Zona de riesgo alta";
		}
		else if($letra=="B"){
			$texto="Zona de riesgo baja";
		}
		else if($letra=="E"){
			$texto="Zona de riesgo extrema";
		}
		else if($letra=="M"){
			$texto="Zona de riesgo moderada";
		}
	}
	else if($tipo==2){
		if($letra=="A"){
			$texto="Reducir el riesgo, evitar, compartir o transferir";
		}
		else if($letra=="B"){
			$texto="Asumir el riesgo";
		}
		else if($letra=="E"){
			$texto="Reducir el riesgo, evitar, compartir o transferir";
		}
		else if($letra=="M"){
			$texto="Asumir el riesgo, reducir el riesgo";
		}
	}
	return $texto;
}
/*
 * <parametros>$resultado = Letra al que corresponde probabilidad vs impacto</parametros>
 * <responsabilidades>Retorna el color correspondiente al vincular probabilidad vs impacto
 * </responsabilidades>
 */
function color_evaluacion($resultado){
	if($resultado=="A"){
		$color="colar_A";
	}
	if($resultado=="B"){
		$color="colar_B";
	}
	if($resultado=="E"){
		$color="colar_E";
	}
	if($resultado=="M"){
		$color="colar_M";
	}
	return $color;
}
/*
 * <parametros>$id = idft_riesgos_proceso</parametros>
 * <responsabilidades>Retorna en un arreglo la cantidad de pasos a disminuir.
 * ejemplo:
 * $arreglo[0]=Cantidad de pasos a disminuir en la probabilidad
 * $arreglo[1]=Cantidad de pasos a disminuir en el impacto
 * </responsabilidades> 
 *
 */
function valoraciones($id){
	$conn;
	$probabilidad=busca_filtro_tabla("","ft_control_riesgos a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO', 'ANULADO') and desplazamiento='1' and ft_riesgos_proceso=".$id,"",$conn);
	
	$probabilidades=array();
	$disminuir_prob=0;
	for($i=0;$i<$probabilidad["numcampos"];$i++){
		$puntaje=0;
		if($probabilidad[$i]["herramienta_ejercer"]==1){
			$puntaje+=15;
		}
		if($probabilidad[$i]["procedimiento_herram"]==1){
			$puntaje+=15;
		}
		if($probabilidad[$i]["herramienta_efectiva"]==1){
			$puntaje+=30;
		}
		if($probabilidad[$i]["responsables_ejecuci"]==1){
			$puntaje+=15;
		}
		if($probabilidad[$i]["frecuencia_ejecucion"]==1){
			$puntaje+=25;
		}
		
		if($puntaje>=0&& $puntaje<=50){
			$disminuir_prob+=0;
		}
		else if($puntaje>=51&& $puntaje<=75){
			$disminuir_prob+=1;
		}
		else if($puntaje>=76&& $puntaje<=100){
			$disminuir_prob+=2;
		}
		//$probabilidades[]=$puntaje;
	}
	
	//$promedio_probabilidad=(array_sum($probabilidades)/count($probabilidades));
	
	$impacto=busca_filtro_tabla("","ft_control_riesgos a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO', 'ANULADO') and desplazamiento='2' and ft_riesgos_proceso=".$id,"",$conn);	
	
	$impactos=array();
	$disminuir_imp=0;
	for($i=0;$i<$impacto["numcampos"];$i++){
		$puntaje=0;
		if($impacto[$i]["herramienta_ejercer"]==1){
			$puntaje+=15;
		}
		if($impacto[$i]["procedimiento_herram"]==1){
			$puntaje+=15;
		}
		if($impacto[$i]["herramienta_efectiva"]==1){
			$puntaje+=30;
		}
		if($impacto[$i]["responsables_ejecuci"]==1){
			$puntaje+=15;
		}
		if($impacto[$i]["frecuencia_ejecucion"]==1){
			$puntaje+=25;
		}
		
		if($puntaje>=0&& $puntaje<=50){
			$disminuir_imp+=0;
		}
		else if($puntaje>=51&& $puntaje<=75){
			$disminuir_imp+=1;
		}
		else if($puntaje>=76&& $puntaje<=100){
			$disminuir_imp+=2;
		}
		//$impactos[]=$puntaje;
	}
	
	//$promedio_impacto=(array_sum($impactos)/count($impactos));
	
	return array($disminuir_prob,$disminuir_imp);
}
/*
 * <parametros>$punto= sea el impacto o la probabilidad
 * $disminuir= Cantidad de pasos a retroceder
 * </parametros>
 * <responsabilidades>Retorna el nuevo impacto o probabilidad despues de la resta.
 * </responsabilidades> 
 */
function nuevo_punto_matriz($punto,$disminuir){
	
	//print_r('punto : '.$punto.' disminuir: '.$disminuir);
	//return '';
	if(($punto-$disminuir)>0){
		return ($punto-$disminuir);
	}else if(($punto-$disminuir)<=0){
		return 1;
	}
}

/*
 * <parametros>
 * 	$idft_riesgos_proceso= es el identificador propio del riesgo
 * 	$probabilidad = Probabilidad inicial del riesgo
 * </parametros>
 * <responsabilidades>
 * 	Retorna la nueva probabilidad, calculada según las valoraciones en probabilidad.
 * </responsabilidades> 
 */
function obtener_probabilidad_riesgo($idft_riesgos_proceso, $probabilidad){
	global $conn;	
	$control_riesgos_probabilidad = busca_filtro_tabla("a.herramienta_ejercer, a.procedimiento_herram, a.herramienta_efectiva, a.responsables_ejecuci,  a.frecuencia_ejecucion","ft_control_riesgos a, documento b","a.tipo_control=1 and a.documento_iddocumento=b.iddocumento and lower(b.estado) not in('eliminado','anulado') and ft_riesgos_proceso=".$idft_riesgos_proceso,"a.idft_control_riesgos desc",$conn);	
	/*print_r($control_riesgos_probabilidad);
	die();*/
	$posiciones = 0;
	for ($i=0; $i < $control_riesgos_probabilidad["numcampos"]; $i++) {		
		$mover_probabilidad = 0;
		
		if($control_riesgos_probabilidad[0]["herramienta_ejercer"] == 1){
			$mover_probabilidad += 15;
		}
		
		if($control_riesgos_probabilidad[0]["procedimiento_herram"] == 1){
			$mover_probabilidad += 15;
		}
		
		if($control_riesgos_probabilidad[0]["herramienta_efectiva"] == 1){
			$mover_probabilidad += 30;
		}
		
		if($control_riesgos_probabilidad[0]["responsables_ejecuci"] == 1){
			$mover_probabilidad += 15;
		}
		
		if($control_riesgos_probabilidad[0]["frecuencia_ejecucion"] == 1){
			$mover_probabilidad += 25;
		}		
		
		if($mover_probabilidad >= 0 && $mover_probabilidad <= 50){
			$posiciones += 0;
		}elseif($mover_probabilidad >= 51  && $mover_probabilidad <= 75){
			$posiciones += 1;
		}elseif($mover_probabilidad >= 76){
			$posiciones += 2;
		}		
	}	
	
	
	$nueva_probabilidad = $probabilidad - $posiciones;
	
	if($nueva_probabilidad < 1){
		$nueva_probabilidad = 1;
	}elseif($nueva_probabilidad > 5){
		$nueva_probabilidad = 5;
	}
	
	return($nueva_probabilidad);
}

/*
 * <parametros>
 * 	$idft_riesgos_proceso= es el identificador propio del riesgo
 * 	$impacto = Impacto inicial del riesgo
 * </parametros>
 * <responsabilidades>
 * 	Retorna el nuevo impacto, calculado según las valoraciones en impacto.
 * </responsabilidades> 
 */
function obtener_impacto_riesgo($idft_riesgos_proceso, $impacto){
	global $conn;		
	
	$control_riesgos_impacto = busca_filtro_tabla("a.herramienta_ejercer, a.procedimiento_herram, a.herramienta_efectiva, a.responsables_ejecuci,  a.frecuencia_ejecucion","ft_control_riesgos a, documento b","a.tipo_control=2 and a.documento_iddocumento=b.iddocumento and lower(b.estado) not in('eliminado','anulado') and ft_riesgos_proceso=".$idft_riesgos_proceso,"a.idft_control_riesgos desc",$conn);
	
	$posiciones = 0;			
	for ($i=0; $i < $control_riesgos_impacto["numcampos"]; $i++){		
		
		$mover_impacto = 0;
			
		if($control_riesgos_impacto[0]["herramienta_ejercer"] == 1){
			$mover_impacto += 15;
		}
		
		if($control_riesgos_impacto[0]["procedimiento_herram"] == 1){
			$mover_impacto += 15;
		}
		
		if($control_riesgos_impacto[0]["herramienta_efectiva"] == 1){
			$mover_impacto += 30;
		}
		
		if($control_riesgos_impacto[0]["responsables_ejecuci"] == 1){
			$mover_impacto += 15;
		}
		
		if($control_riesgos_impacto[0]["frecuencia_ejecucion"] == 1){
			$mover_impacto += 25;
		}
		
		if($mover_impacto >= 0 && $mover_impacto <= 50){
			$posiciones += 0;
		}elseif($mover_impacto >= 51  && $mover_impacto <= 75){
			$posiciones += 1;
		}elseif($mover_impacto >= 76){
			$posiciones += 2;
		}				
	}
	
	$nuevo_impacto = $impacto - $posiciones;
		
	
	if($nuevo_impacto < 1){
		$nuevo_impacto = 1;
	}elseif($nuevo_impacto > 5){
		$nuevo_impacto = 5;
	}
		
	return($nuevo_impacto);
}
?>