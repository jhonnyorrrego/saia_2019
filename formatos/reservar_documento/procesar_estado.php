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
$componente=busca_filtro_tabla("","busqueda_componente A","A.nombre='reporte_reserva_documentos'","");

if(@$_REQUEST["accion"]==1){//Entregar documentos
	$documentos=@$_REQUEST["documentos"];
	$observaciones=@$_REQUEST["observaciones"];
	$usuario=usuario_actual('idfuncionario');
	$fecha=date('Y-m-d H:i:s');
	
	$sql1="UPDATE ft_reservar_documento SET fecha_entrega=".fecha_db_almacenar($fecha,'Y-m-d H:i:s').", usuario_entrega=".$usuario.", observacion_entrega='".$observaciones."', estado_doc=2 WHERE documento_iddocumento in(".$documentos.")";
	phpmkr_query($sql1);
	abrir_url($ruta_db_superior."pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=".$componente[0]["idbusqueda_componente"],"_self");
}
else if(@$_REQUEST["accion"]==2){//Devolver documentos
	$documentos=@$_REQUEST["documentos"];
	$observaciones=@$_REQUEST["observaciones"];
	
	$usuario=usuario_actual('idfuncionario');
	$fecha=date('Y-m-d H:i:s');
	
	$sql1="UPDATE ft_reservar_documento SET fecha_devolver=".fecha_db_almacenar($fecha,'Y-m-d H:i:s').", usuario_devolver=".$usuario.", observacion_devolver='".$observaciones."', estado_doc=3 WHERE documento_iddocumento in(".$documentos.")";
	phpmkr_query($sql1);
	abrir_url($ruta_db_superior."pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=".$componente[0]["idbusqueda_componente"],"_self");
}
?>