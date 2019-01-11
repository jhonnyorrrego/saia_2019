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

$idft_funcionario=json_decode(@$_REQUEST['idft_funcionario'],1);
$sql1='';
for($i=0;$i<count($idft_funcionario);$i++){
	$separacion_idft_funcionario=explode('|',$idft_funcionario[$i]['value']);
	
	$tipo_mensajeria_radicacion=busca_filtro_tabla("tipo_mensajeria,area_responsable,tipo_destino","ft_radicacion_entrada","idft_radicacion_entrada=".$separacion_idft_funcionario[2],"",$conn);
	$datos=busca_filtro_tabla('nombre_destino,estado_recogida,recepcion','ft_destino_radicacion','idft_destino_radicacion='.$separacion_idft_funcionario[0],'',$conn);
	if(($tipo_mensajeria_radicacion[0]['tipo_mensajeria']==2 || $tipo_mensajeria_radicacion[0]['tipo_mensajeria']==1) && !$datos[0]['estado_recogida']){
		$adicional="tipo_mensajero='i'";
		if($tipo_mensajeria_radicacion[0]['tipo_destino']==1){
			$responsable[0]['mensajero_ruta']='';
			$responsable[0]['idft_ruta_distribucion']='';
			$adicional="tipo_mensajero=''";
		}else{
			$destino=busca_filtro_tabla("iddependencia","vfuncionario_dc","iddependencia_cargo=".$datos[0]['nombre_destino'],"",$conn);
			$responsable=busca_filtro_tabla("mensajero_ruta,a.idft_ruta_distribucion","documento d,ft_ruta_distribucion a, ft_dependencias_ruta b, ft_funcionarios_ruta c","d.iddocumento=a.documento_iddocumento AND lower(d.estado)='aprobado' AND b.estado_dependencia=1 AND c.estado_mensajero=1 AND a.idft_ruta_distribucion=b.ft_ruta_distribucion AND a.idft_ruta_distribucion=c.ft_ruta_distribucion AND b.dependencia_asignada=".$destino[0]['iddependencia'],"",$conn);
		}
		$sql="UPDATE ft_destino_radicacion SET estado_recogida=1,estado_item=1 WHERE idft_destino_radicacion=".$separacion_idft_funcionario[0];	
		
		$sql1="UPDATE ft_destino_radicacion SET ruta_destino=".$responsable[0]['idft_ruta_distribucion'].",".$adicional.",mensajero_encargado='".$responsable[0]['mensajero_ruta']."' WHERE idft_destino_radicacion=".$separacion_idft_funcionario[0];		 
		
	}else{
		if($datos[0]['recepcion']==0){
			$sql="UPDATE ft_destino_radicacion SET recepcion='".$separacion_idft_funcionario[1]."', recepcion_fecha=".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").", estado_item=3 WHERE idft_destino_radicacion=".$separacion_idft_funcionario[0];		
		}		
	}
	phpmkr_query($sql);	   
	
	if($sql1!=''){
		phpmkr_query($sql1);
	}
}
?>