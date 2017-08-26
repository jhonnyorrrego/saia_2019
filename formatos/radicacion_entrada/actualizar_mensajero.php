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
$mensajero_vector=explode('-',$_REQUEST['mensajero_encargado']);

$update_adicional="";

	$idft_ruta_distribucion=@$_REQUEST['idft_ruta_distribucion'];
	$idft_destino_radicacion=$_REQUEST['idft_destino_radicacion'];
	
	$destino=busca_filtro_tabla("tipo_origen,estado_recogida,tipo_destino","ft_destino_radicacion","idft_destino_radicacion=".$idft_destino_radicacion,"",$conn);
	
	if(!$destino[0]['estado_recogida'] && $destino[0]['tipo_origen']==2){
		$update_adicional=" ,ruta_origen=".$idft_ruta_distribucion;	
	}else if($destino[0]['tipo_destino']==2){
		$update_adicional=" ,ruta_destino=".$idft_ruta_distribucion;
	}
	

$sql="UPDATE ft_destino_radicacion SET mensajero_encargado=".$mensajero_vector[0].",tipo_mensajero='".$mensajero_vector[1]."' ".$update_adicional." WHERE idft_destino_radicacion={$_REQUEST['idft_destino_radicacion']}";

phpmkr_query($sql);