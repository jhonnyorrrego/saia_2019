<?php
date_default_timezone_set('America/Bogota');
include_once('festivos_colombia.php');
include_once 'PeriodoDiasHabilesIterador.php';

function esCambioAnio($fecha, $dias) {
	$fecha_fin = calculaFecha("days", $dias, $fecha);

	$ar_fechafin = date_parse($fecha_fin);
	$aniofinal = $ar_fechafin["year"];
	$mesfinal = $ar_fechafin["month"];
	$diafinal = $ar_fechafin["day"];

	$ar_fechaini = date_parse($fecha);
	$anioini = $ar_fechaini["year"];
	$mesini = $ar_fechaini["month"];
	$diaini = $ar_fechaini["day"];

	$retorno = array(
			'cambio' => 0
	);
	if ($aniofinal > date('Y')) {
		$retorno['cambio'] = 1;
		// $retorno['fecha_part1']=$anioini.'-'.$mesini.'-'.$diaini.'|'.$anioini.'-12-31';
		$part1_date1 = date_create($anioini . '-' . $mesini . '-' . $diaini);
		$part1_date2 = date_create($anioini . '-12-31');
		$diff = date_diff($part1_date1, $part1_date2);
		$diferencia_parte_uno = $diff->format("%a");

		$part1_date1 = $anioini . '-' . $mesini . '-' . $diaini;
		$festivos2 = new CalendarCol(date('Y'));
		$cantidad_festivos_part1 = 0;
		for($i = 1; $i <= $diferencia_parte_uno; $i++) {
			$fecha = calculaFecha("days", $i, $part1_date1);

			if ($festivos2->esFestivo($fecha)) {
				$cantidad_festivos_part1++;
			}
		}

		$part2_fecha_fin = calculaFecha("days", $cantidad_festivos_part1, $aniofinal . '-' . $mesfinal . '-' . $diafinal);
		$part2_date1 = date_create(($aniofinal - 1) . '-12-31');
		$part2_date2 = date_create($part2_fecha_fin);
		$diff2 = date_diff($part2_date1, $part2_date2);
		$retorno['dias_validar'] = $diff2->format("%a");
		$retorno['fecha_validar'] = $aniofinal . '-01-01';
		$retorno['anio_validar'] = $aniofinal;
	}

	return ($retorno);
}

function calculaFecha($modo,$valor,$fecha_inicio=false,$formato=false){

    if(!$formato){
        $formato="Y-m-d";
    }
	if($fecha_inicio!=false) {
		$fecha_base = strtotime($fecha_inicio);

	}else {
   		$time=time();
		$fecha_actual=date($formato,$time);
		$fecha_base=strtotime($fecha_actual);
	}
	$calculo = strtotime("$valor $modo","$fecha_base");
	return date($formato, $calculo);
}



$version_php=explode('.',phpversion());
$version_php=array_map('intval', $version_php);
if($version_php[0]>=5 && $version_php[1]>=5){ //si la version de php es mayor a 5.5 trabaja con el nuevo generador de festivos, sino todo como antes

	function dias_habiles_listado($dias, $formato = NULL, $fecha_inicial = NULL) {
		global $conn;

		if (empty($formato)) {
			$formato = "d-m-Y";
		}
		$formato_bd = "dd-mm-YYYY"; // Formato validor para el motor y DEBE SER COMPATIBLE CON $formato
		if (!$fecha_inicial) {
			$fecha_inicial = date($formato);
		}
	
		$dias_no_habiles = busca_filtro_tabla("valor", "configuracion", "tipo='festivos' AND nombre='dias_no_habiles'", "", $conn);
		$sabado_habil = false;
		if($dias_no_habiles["numcampos"]) {
			$vector_dias_no_habiles = explode(',', $dias_no_habiles[0]['valor']);
			$sabado_habil = !in_array("s", $vector_dias_no_habiles);
		}
	
		$begin = new \DateTime($fecha_inicial);
		$end = clone $begin;
		$end->add(new \DateInterval('P' . $dias . 'D'))->setTime(23, 59, 59);
		$period = new \DatePeriod($begin, new \DateInterval('P1D'), $end);
	
		$periodIterator = new PeriodoDiasHabilesIterador($period, $sabado_habil);
		$adjustedEndingDate = clone $begin;
	
		$years = array();
		while($periodIterator->valid()) {
			$adjustedEndingDate = $periodIterator->current();
			$years[] = $adjustedEndingDate->format('Y');
			// If we run into a weekend, extend our days
			if ($periodIterator->isWeekend()) {
				$periodIterator->extend();
			}
			if ($periodIterator->isHollyday()) {
				$periodIterator->extend();
			}
			$periodIterator->next();
		}
		$years = array_unique($years);
		// print_r($adjustedEndingDate->format($formato));
		$fecha_legal= $adjustedEndingDate->format($formato);
		return($fecha_legal);
	}


}else{

	function dias_habiles_listado($dias, $formato = NULL, $fecha_inicial = NULL) {
		global $conn;
		if (!$formato)
			$formato = "d-m-Y";
		$formato_bd = "dd-mm-YYYY"; // Formato validor para el motor y DEBE SER COMPATIBLE CON $formato
		if (!$fecha_inicial)
			$fecha_inicial = date($formato);
	
		$ar_fechaini = date_parse($fecha_inicial);
		$anioinicial = $ar_fechaini["year"];
		$mesinicial = $ar_fechaini["month"];
		$diainicial = $ar_fechaini["day"];
	
		$cambio_anio = esCambioAnio($anioinicial . '-' . $mesinicial . '-' . $diainicial, $dias);
	
		if ($cambio_anio['cambio']) {
			$festivos = new CalendarCol(intval($cambio_anio['anio_validar']));
			$dias = $cambio_anio['dias_validar'];
			$fecha_inicial = $cambio_anio['fecha_validar'];
			$ar_fechaini = date_parse($fecha_inicial);
			$anioinicial = $ar_fechaini["year"];
			$mesinicial = $ar_fechaini["month"];
			$diainicial = $ar_fechaini["day"];
		} else {
			$festivos = new CalendarCol(date('Y'));
		}
		$cantidad_festivos = 0;
		for($i = 1; $i <= $dias; $i++) {
			$fecha = calculaFecha("days", $i, $fecha_inicial, $formato);
			if ($festivos->esFestivo($fecha)) {
	
				$cantidad_festivos++;
			}
		}
	
		if ($cantidad_festivos) {
			$no_laborales = $cantidad_festivos;
			$fecha_legal = date($formato, mktime(0, 0, 0, $mesinicial, $diainicial + $dias, $anioinicial));
			return (dias_habiles_listado($no_laborales, $formato, $fecha_legal));
		}
		$fecha_legal = date($formato, mktime(0, 0, 0, $mesinicial, $diainicial + $dias, $anioinicial));
		return ($fecha_legal);
	}


} //fin else version php






/*
function dias_habiles_listado($dias,$formato=NULL,$fecha_inicial=NULL){
  global $conn;
   if(!$formato)
     $formato="d-m-Y";
   $formato_bd= "dd-mm-YYYY"; // Formato validor para el motor y DEBE SER COMPATIBLE CON $formato
   if(!$fecha_inicial)
     $fecha_inicial =date($formato);

   $ar_fechaini=date_parse($fecha_inicial);
   $anioinicial=$ar_fechaini["year"];
   $mesinicial=$ar_fechaini["month"];
   $diainicial=$ar_fechaini["day"];

   $fecha_final=date($formato, mktime( 0, 0, 0,$mesinicial, $diainicial + $dias,$anioinicial));
    $asignaciones=busca_filtro_tabla("idasignacion,".fecha_db_obtener("fecha_inicial",'Y-m-d')." as fecha_inicial,".fecha_db_obtener("fecha_final",'Y-m-d')." as fecha_final","asignacion","asignacion.documento_iddocumento='-1'  AND asignacion.fecha_inicial < ".fecha_db_almacenar($fecha_final,$formato)." AND asignacion.fecha_final > ".fecha_db_almacenar($fecha_inicial,$formato),"",$conn);

  if($asignaciones["numcampos"]){
    $no_laborales=$asignaciones["numcampos"];
	  $fecha_legal= date($formato, mktime( 0, 0, 0,$mesinicial, $diainicial + $dias,$anioinicial));
    return(dias_habiles_listado($no_laborales,$formato,$fecha_legal));
   }
 $fecha_legal= date($formato, mktime( 0, 0, 0,$mesinicial, $diainicial + $dias - 1 ,$anioinicial));
 return($fecha_legal);
}
*/

function mostrar_fecha_saia($fecha){
$fecha1=date_parse($fecha);
$year=($fecha1["year"]);
$mes=mes_saia($fecha1["month"]);
if(strpbrk(":",$fecha)){
  return($fecha1["day"]."-".$mes."-".$year." ".poner_ceros($fecha1["hour"],'1','1').":".poner_ceros($fecha1["minute"],'1','1').":".poner_ceros($fecha1["second"],'1','1'));
}
else{
  return($fecha1["day"]."-".$mes."-".$year);
}
}
function mes_saia($mes){
  switch ($mes){
    case 1:return "Ene";
    case 2:return "Feb";
    case 3:return "Mar";
    case 4:return "Abr";
    case 5:return "May";
    case 6:return "Jun";
    case 7:return "Jul";
    case 8:return "Ago";
    case 9:return "Sep";
    case 10:return "Oct";
    case 11:return "Nov";
    case 12:return "Dic";
  }
}

function poner_ceros($str,$numero,$cantidad){
  if(strlen($str) == $numero ){
    return str_repeat('0', $cantidad).$str;
  }
  else{
    return $str;
  }
}
/*
 * @fecha_base: corresponde a la fecha base del calculo
 * @fecha_ref: corresponde a la fecha con la que se quiere comparar la base  o fecha de referencia
 * Se realiza la resta de la fecha_base - fecha_ref
 * Retorna un objeto tipo diff de la clase DateTime
 * */
function resta_dos_fechas_saia($fecha_base='',$fecha_ref=''){
  if($fecha_ref==''){
    $fecha_r=new DateTime();
  }
  else{
    $fecha_r=new DateTime($fecha_ref);
  }
  if($fecha_base==''){
    $fecha_b=new DateTime();
  }
  else{
    $fecha_b=new DateTime($fecha_base);
  }
  $diff=$fecha_b->diff($fecha_r);
  return($diff);
}
function fecha_atrasada($fecha_base,$fecha_ref){
$diff=resta_dos_fechas_saia($fecha_base,$fecha_ref);
if($diff->invert){
  return(true);
}
return(false);
}
function sumar_fechas_saia($fecha_base,$intervalo){

}
function texto_atraso_saia($diferencia,$formato){
  $vencimiento='<b>';
  $vencimiento.=texto_atraso_saia_componente($diferencia,$formato,"y","a&ntilde;o");
  $vencimiento.=texto_atraso_saia_componente($diferencia,$formato,"m","mes","es");
  $vencimiento.=texto_atraso_saia_componente($diferencia,$formato,"d","d&iacute;a");
  $vencimiento.=texto_atraso_saia_componente($diferencia,$formato,"h","hora");
  $vencimiento.=texto_atraso_saia_componente($diferencia,$formato,"i","minuto");
  $vencimiento.='</b>';
  return($vencimiento);
}
function texto_atraso_saia_componente($diferencia,$formato,$componente,$cadena,$plural="s"){
$vencimiento='';
  if($diferencia->$componente && strpos($formato,$componente)!==FALSE){
    $vencimiento.=" ".$diferencia->$componente.' '.$cadena;
    if($diferencia->$componente>1){
      $vencimiento.=$plural;
    }
  }
return($vencimiento);
}

function conversor_segundos_hm($tiempo_en_segundos) {
  $horas = floor($tiempo_en_segundos / 3600);
  $minutos = floor(($tiempo_en_segundos - ($horas * 3600)) / 60);
  $segundos=0;
  if($mostrar_segundos){
    $segundos = $tiempo_en_segundos - ($horas * 3600) - ($minutos * 60);
  }

  $hora_texto = "";
  if ($horas > 0 ) {
    $hora_texto .= $horas . "h &nbsp;";
  }

  if ($minutos > 0 ) {
    $hora_texto .= $minutos . "m &nbsp;";
  }

  if ($segundos > 0 ) {
    $hora_texto .= $segundos . "s &nbsp;";
  }
  return $hora_texto;
}

?>
