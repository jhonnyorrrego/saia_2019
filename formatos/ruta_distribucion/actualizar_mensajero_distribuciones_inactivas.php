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




$idft_ruta_distribucion=$_REQUEST['idft_ruta_distribucion'];
$mensajero_ruta=$_REQUEST['mensajero_ruta'];


//VINCULACION DISTRIBUCIONES DE MENSAJEROS INCACTIVOS

$mensajeros_inactivos_ruta=busca_filtro_tabla("c.idft_funcionarios_ruta","ft_ruta_distribucion a, ft_funcionarios_ruta c,documento d","a.documento_iddocumento=d.iddocumento AND lower(d.estado)='aprobado' AND c.estado_mensajero=2 AND a.idft_ruta_distribucion=c.ft_ruta_distribucion AND a.idft_ruta_distribucion=".$idft_ruta_distribucion,"",$conn);

if($mensajeros_inactivos_ruta['numcampos']){

	$lista_ft_funcionarios_ruta_incactivos=implode(',',extrae_campo($mensajeros_inactivos_ruta,'idft_funcionarios_ruta'));
	
	$destinos_radicacion_inactivos=busca_filtro_tabla("a.idft_destino_radicacion","ft_destino_radicacion a, ft_funcionarios_ruta b, ft_radicacion_entrada c, documento d ","c.idft_radicacion_entrada=a.ft_radicacion_entrada AND c.documento_iddocumento=d.iddocumento AND lower(d.estado)='aprobado' AND a.mensajero_encargado=b.mensajero_ruta AND b.estado_mensajero=2 AND b.idft_funcionarios_ruta IN(".$lista_ft_funcionarios_ruta_incactivos.") AND a.estado_item=1 AND a.tipo_mensajero='i'","",$conn);  //solo asigna mensajeros a distribuciones (por distribuir)
	
	
	for($i=0;$i<$destinos_radicacion_inactivos['numcampos'];$i++){
		$updr=" UPDATE ft_destino_radicacion SET tipo_mensajero='i',mensajero_encargado=".$mensajero_ruta." WHERE idft_destino_radicacion=".$destinos_radicacion_inactivos[$i]['idft_destino_radicacion'];
		phpmkr_query($updr);
	}
	
}

	
	
//VINCULACION DISTRIBUCIONES QUE NUNCA HAN TENIDO UN MENSAJERO
$dependencias_ruta=busca_filtro_tabla("dependencia_asignada","ft_dependencias_ruta","estado_dependencia=1 AND ft_ruta_distribucion=".$idft_ruta_distribucion,"",$conn);
	
if($dependencias_ruta['numcampos']){
		
	$listado_dependencia_ruta=implode(',',extrae_campo($dependencias_ruta,'dependencia_asignada'));
		
	$destinos_sin_mensajero=busca_filtro_tabla("b.idft_destino_radicacion","vfuncionario_dc a, ft_destino_radicacion b, ft_radicacion_entrada c, documento d ","a.iddependencia IN(".$listado_dependencia_ruta.") AND a.iddependencia_cargo=b.nombre_destino AND b.mensajero_encargado IS NULL AND b.ft_radicacion_entrada=c.idft_radicacion_entrada AND c.documento_iddocumento=d.iddocumento AND lower(d.estado)='aprobado' AND b.estado_item=1","",$conn);

	for($i=0;$i<$destinos_sin_mensajero['numcampos'];$i++){
		$updr=" UPDATE ft_destino_radicacion SET tipo_mensajero='i',mensajero_encargado=".$mensajero_ruta." WHERE idft_destino_radicacion=".$destinos_sin_mensajero[$i]['idft_destino_radicacion'];
		phpmkr_query($updr);		
	}		
		
}
	
	



?>