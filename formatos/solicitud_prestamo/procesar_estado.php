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
$componente=busca_filtro_tabla("","busqueda_componente A","A.nombre='reporte_solicitud_prestamo'","",$conn);

if(@$_REQUEST["accion"]){
	$idft_item_prestamo_exp=@$_REQUEST["idft_item_prestamo_exp"];
	$observaciones=@$_REQUEST["observaciones"];
	$usuario=usuario_actual('idfuncionario');
	$fecha=date('Y-m-d H:i:s');
	if($_REQUEST["accion"]==1){
		$sql1="UPDATE ft_item_prestamo_exp SET fecha_prestamo=".fecha_db_almacenar($fecha,'Y-m-d H:i:s').", funcionario_prestamo=".$usuario.", observacion_prestamo='".$observaciones."', estado_prestamo=1 WHERE idft_item_prestamo_exp in(".$idft_item_prestamo_exp.")";
	}
	if($_REQUEST["accion"]==2){
		$sql1="UPDATE ft_item_prestamo_exp SET fecha_devolucion=".fecha_db_almacenar($fecha,'Y-m-d H:i:s').", funcionario_devoluci=".$usuario.", observacion_devolver='".$observaciones."', estado_prestamo=2 WHERE idft_item_prestamo_exp in(".$idft_item_prestamo_exp.")";
	}
	
	phpmkr_query($sql1);
	abrir_url($ruta_db_superior."pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=".$componente[0]["idbusqueda_componente"],"_self");
}
?>