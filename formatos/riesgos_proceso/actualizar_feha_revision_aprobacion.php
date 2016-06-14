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

$fecha = date("d/m/Y H:i:s");

switch($_REQUEST['tipo']){
	case 'revisado':
		$update_proceso = "UPDATE ft_proceso SET fecha_revision_riesgo=".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s")." WHERE documento_iddocumento=".$_REQUEST['iddocumento'];		
	break;
	case 'aprobado':
		$update_proceso = "UPDATE ft_proceso SET fecha_aprobacion_riesgo=".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s")." WHERE documento_iddocumento=".$_REQUEST['iddocumento'];
	break;
	case 'reiniciar':
		$proceso = busca_filtro_tabla("a.documento_iddocumento","ft_proceso a, ft_riesgos_proceso b","a.idft_proceso=b.ft_proceso AND b.documento_iddocumento=".$_REQUEST['iddocumento'],"",$conn);
		
		$update_proceso = "UPDATE ft_proceso SET fecha_aprobacion_riesgo= '', fecha_revision_riesgo='' WHERE documento_iddocumento=".$proceso[0]['documento_iddocumento'];
	break;
	case 'chequeo':
		$proceso = busca_filtro_tabla("fecha_aprobacion_riesgo, fecha_revision_riesgo","ft_proceso","documento_iddocumento=".$_REQUEST['iddocumento'],"",$conn);		
		
		$fecha = array(
			'fecha_aprobacion' => $proceso[0]['fecha_aprobacion_riesgo'],
			'fecha_revision'   => $proceso[0]['fecha_revision_riesgo'],
		);
		
		$fecha = json_encode($fecha);		
	break;
}

if($update_proceso){
	phpmkr_query($update_proceso,$conn);
}

echo($fecha);

