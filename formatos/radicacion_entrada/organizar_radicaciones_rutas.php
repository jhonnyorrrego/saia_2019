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


$destinos_radicacion=busca_filtro_tabla("idft_destino_radicacion","ft_destino_radicacion","estado_item<>3","",$conn);
for($r=0;$r<$destinos_radicacion['numcampos'];$r++){
	$idft_ruta_distribucion=0;
	$idft_destino_radicacion=$destinos_radicacion[$r]['idft_destino_radicacion'];
		

		
	  $datos=busca_filtro_tabla('','ft_destino_radicacion','idft_destino_radicacion='.$idft_destino_radicacion,'',$conn);
	
//-------------------------------------------------

	$destino_externo=0;
    if($datos[0]['tipo_origen']==2 && !$datos[0]['estado_recogida']){  //SI ES RECOGIDA
    	$iddependencia=busca_filtro_tabla("iddependencia","vfuncionario_dc","iddependencia_cargo=".$datos[0]['nombre_origen'],"",$conn);
		$nombre_ruta=busca_filtro_tabla("a.idft_ruta_distribucion,c.mensajero_ruta","ft_ruta_distribucion a, ft_dependencias_ruta b, ft_funcionarios_ruta c,documento d","a.documento_iddocumento=d.iddocumento AND lower(d.estado)='aprobado' AND b.estado_dependencia=1 AND c.estado_mensajero=1 AND a.idft_ruta_distribucion=b.ft_ruta_distribucion AND a.idft_ruta_distribucion=c.ft_ruta_distribucion AND b.dependencia_asignada=".$iddependencia[0]['iddependencia'],"",$conn);
		$idft_ruta_distribucion="ruta_origen=".$nombre_ruta[0]['idft_ruta_distribucion'];
		$mensajero_ruta=$nombre_ruta[0]['mensajero_ruta'];
		
		
    }else if($datos[0]['tipo_destino']==2 && $datos[0]['estado_recogida']){  //SI ES ENTREGA INTERNA POSTERIOR A RECOGIDA
    	$iddependencia=busca_filtro_tabla("iddependencia","vfuncionario_dc","iddependencia_cargo=".$datos[0]['nombre_destino'],"",$conn);
		$nombre_ruta=busca_filtro_tabla("a.idft_ruta_distribucion,c.mensajero_ruta","ft_ruta_distribucion a, ft_dependencias_ruta b, ft_funcionarios_ruta c,documento d","a.documento_iddocumento=d.iddocumento AND lower(d.estado)='aprobado' AND b.estado_dependencia=1 AND c.estado_mensajero=1 AND a.idft_ruta_distribucion=b.ft_ruta_distribucion AND a.idft_ruta_distribucion=c.ft_ruta_distribucion AND b.dependencia_asignada=".$iddependencia[0]['iddependencia'],"",$conn);
		$idft_ruta_distribucion="ruta_destino=".$nombre_ruta[0]['idft_ruta_distribucion'];
				$mensajero_ruta=$nombre_ruta[0]['mensajero_ruta'];
    }else if($datos[0]['tipo_origen']==1 && $datos[0]['tipo_destino']==2){  //SI ES ENTREGA INTERNA DE UN ORIGEN EXTERNO
    	$iddependencia=busca_filtro_tabla("iddependencia","vfuncionario_dc","iddependencia_cargo=".$datos[0]['nombre_destino'],"",$conn);
		$nombre_ruta=busca_filtro_tabla("a.idft_ruta_distribucion,c.mensajero_ruta","ft_ruta_distribucion a, ft_dependencias_ruta b, ft_funcionarios_ruta c,documento d","a.documento_iddocumento=d.iddocumento AND lower(d.estado)='aprobado' AND b.estado_dependencia=1 AND c.estado_mensajero=1 AND a.idft_ruta_distribucion=b.ft_ruta_distribucion AND a.idft_ruta_distribucion=c.ft_ruta_distribucion AND b.dependencia_asignada=".$iddependencia[0]['iddependencia'],"",$conn);
		$idft_ruta_distribucion="ruta_destino=".$nombre_ruta[0]['idft_ruta_distribucion'];
		$mensajero_ruta=$nombre_ruta[0]['mensajero_ruta'];	
    }else if($datos[0]['tipo_destino']==1 && $datos[0]['estado_recogida']){
    	$idft_ruta_distribucion=0;
		
		$destino_externo=1;
		
    } 
	
	$up='';
	if($destino_externo){
		$up="  UPDATE ft_destino_radicacion SET ruta_destino=0  WHERE idft_destino_radicacion=".$idft_destino_radicacion;
	}else{
		$up=" UPDATE ft_destino_radicacion SET mensajero_encargado=".$mensajero_ruta.",".$idft_ruta_distribucion." WHERE idft_destino_radicacion=".$idft_destino_radicacion;
	}
	
	if($up!=''){
		phpmkr_query($up);
	}
	
	
	if(!$datos[0]['ruta_origen'] && !$datos[0]['ruta_destino'] && !$destino_externo){
		$up3=" UPDATE ft_destino_radicacion SET mensajero_encargado=0 WHERE  idft_destino_radicacion=".$idft_destino_radicacion;
		phpmkr_query($up3);
	}
	
	echo($up.'<br>');

	
	
	
} //fin for $destinos_radicacion


?>