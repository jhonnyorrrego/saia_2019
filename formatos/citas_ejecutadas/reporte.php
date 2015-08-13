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


function ver_documento($iddocumento,$radicado){
	$enlace = "<div class='link kenlace_saia' enlace='ordenar.php?accion=mostrar&amp;amp;mostrar_formato=1&amp;amp;key=".$iddocumento."' conector='iframe' titulo='Documento No - ".$radicado."'>".$radicado."</div>";
	return($enlace);
}

function ver_fecha($fecha){
	$opt=1;
	if($fecha=="fecha_temp"){
		$opt=0;
		$fecha=date("Y-m-d");
	}
	$date = new DateTime($fecha);
	$html=date_format($date, 'Y-m-d');
	
	if($opt){
		return($html);
	}else{
		return("");
	}

}

function remitir($idtem,$fecha,$idfuncionario,$anterior,$padre){
	$html="";
	if($idfuncionario!="funcionario_remitio"){
		$funcionario=busca_filtro_tabla("","funcionario","idfuncionario=".$idfuncionario,"",$conn);
		$date = new DateTime($fecha);
		$html.=$funcionario[0]['nombres']." ".$funcionario[0]['apellidos']."<br/>";
		$html.=date_format($date, 'Y-m-d H:i');
	}else{
		$html.="<center><input type='checkbox' anterior='".$anterior."' padre='".$padre."' value='".$idtem."' class='_remitir'></center>";
	}
	return($html);
}

function recibido($idtem,$fecha,$idfuncionario,$nro,$idfuncionario_remitente){
	$html="";
	if($idfuncionario_remitente!="funcionario_remitio"){
		if($idfuncionario!="funcionario_recibio"){
			$funcionario=busca_filtro_tabla("","funcionario","idfuncionario=".$idfuncionario,"",$conn);
			$date = new DateTime($fecha);
			$html.=$funcionario[0]['nombres']." ".$funcionario[0]['apellidos']."<br/>";
			$html.=date_format($date, 'Y-m-d H:i')."<br/>";
			$html.="<b>No Aut: </b> ".$nro;
		}else{
			$html.="<center><input  idtem='".$idtem."' id='nro_autorizacion_".$idtem."' type='text' class='_recibido' style='width:100px;' placeholder='Nro Autorizacion'></center>";
		}
	}else{
		$html.="<center><font color='red'>Falta Remitir</font></center>";
	}

	return($html);
}

function ejecutado($idtem,$fecha,$idfuncionario,$observacion,$idfuncionario_recibio){
	$html="";
	if($idfuncionario_recibio!="funcionario_recibio"){
		if($idfuncionario!="funcionario_ejecuto"){
			$funcionario=busca_filtro_tabla("","funcionario","idfuncionario=".$idfuncionario,"",$conn);
			$date = new DateTime($fecha);
			$html.=$funcionario[0]['nombres']." ".$funcionario[0]['apellidos']."<br/>";
			$html.=date_format($date, 'Y-m-d H:i')."<br/>";
			$html.="<b>Obs: </b> ".$observacion;
		}else{
			$html.="<center><textarea  idtem='".$idtem."' id='observacion_".$idtem."' type='text' class='_ejecutado' style='width:100px;' placeholder='Observaciones'></textarea></center>";
		}
	}else{
		$html.="<center><font color='red'>Falta Recibir</font></center>";
	}
	return($html);
}

function tiempo_remitido_recibido(){
	global $conn;
	$fecha_inicial=0;
	$fecha_final=0;
	$info=busca_filtro_tabla("fecha_remicion,fecha_recibido","temp_citas_ejecutadas","fecha_remicion is not null and fecha_recibido is not null","",$conn);
	for($i=0;$i<$info['numcampos'];$i++){
		$fecha_inicial=$fecha_inicial+(strtotime($info[$i]['fecha_remicion']));
		$fecha_final=$fecha_final+(strtotime($info[$i]['fecha_recibido']));
	}
	$promedio=($fecha_final-$fecha_inicial)/$info['numcampos'];
	$diferencia=restar_fechas($promedio);
	$html='<div style="text-align:center; font-family:Georgia;">';
	$html.='<h3 style="line-height: 100px;">'.$diferencia.'</h3>';
	$html.="</div>";
	
	return($html);
}

function tiempo_inicio_ejecutado(){
	global $conn;
	$fecha_inicial=0;
	$fecha_final=0;
	$info=busca_filtro_tabla("fecha,fecha_ejecutado","temp_citas_ejecutadas","fecha is not null and fecha_ejecutado is not null","",$conn);
	for($i=0;$i<$info['numcampos'];$i++){
		$fecha_inicial=$fecha_inicial+(strtotime($info[$i]['fecha']));
		$fecha_final=$fecha_final+(strtotime($info[$i]['fecha_ejecutado']));
	}
	$promedio=($fecha_final-$fecha_inicial)/$info['numcampos'];
	$diferencia=restar_fechas($promedio);
	$html='<div style="text-align:center; font-family:Georgia;">';
	$html.='<h3 style="line-height: 100px;">'.$diferencia.'</h3>';
	$html.="</div>";
	
	return($html);
}

function restar_fechas($timestamp)
{
	$return="";
	# Obtenemos el numero de dias
	$days=floor((($timestamp/60)/60)/24);
	if($days>0)
	{
		$timestamp-=$days*24*60*60;
		$return.=$days." dias ";
	}
	# Obtenemos el numero de horas
	$hours=floor(($timestamp/60)/60);
	if($hours>0)
	{
		$timestamp-=$hours*60*60;
		$return.=str_pad($hours, 2, "0", STR_PAD_LEFT).":";
	}else
		$return.="00:";
	# Obtenemos el numero de minutos
	$minutes=floor($timestamp/60);
	if($minutes>0)
	{
		$timestamp-=$minutes*60;
		$return.=str_pad($minutes, 2, "0", STR_PAD_LEFT).":";
	}else
		$return.="00:";
	# Obtenemos el numero de segundos
	$return.=str_pad($timestamp, 2, "0", STR_PAD_LEFT);
	return $return;
} 




/*AJAX*/
if(isset($_REQUEST['opt'])){
	$usuario_actual=usuario_actual("idfuncionario");
	$fecha_actual=date("Y-m-d H:i:s");
	
	switch ($_REQUEST['opt']){
		case 1:
			$update="UPDATE temp_citas_ejecutadas SET fecha_remicion='".$fecha_actual."',funcionario_remitio=".$usuario_actual." WHERE idtemp_citas_ejecutadas IN (".$_REQUEST['idtem'].")";
		break;
			
		case 2:
			$update="UPDATE temp_citas_ejecutadas SET fecha_recibido='".$fecha_actual."',funcionario_recibio=".$usuario_actual.",nro_autorizacion='".$_REQUEST['nro_autorizacion']."' WHERE idtemp_citas_ejecutadas=".$_REQUEST['idtem'];
		break;
			
		case 3:
				$update="UPDATE temp_citas_ejecutadas SET fecha_ejecutado='".$fecha_actual."',funcionario_ejecuto=".$usuario_actual.",observacion_ejecutado='".$_REQUEST['observaciones']."'  WHERE idtemp_citas_ejecutadas=".$_REQUEST['idtem'];
		break;
	}
	phpmkr_query($update);
}
/**/

?>