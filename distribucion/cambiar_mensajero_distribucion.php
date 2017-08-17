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
include_once($ruta_db_superior."distribucion/funciones_distribucion.php");

$iddistribucion=@$_REQUEST['iddistribucion'];
if($iddistribucion){

	$vector_mensajero_nuevo=explode('-',@$_REQUEST['mensajero']);
	
	$distribucion=busca_filtro_tabla("tipo_origen,estado_recogida","distribucion","iddistribucion=".$iddistribucion,"",$conn);
	$diligencia=mostrar_diligencia_distribucion($distribucion[0]['tipo_origen'],$distribucion[0]['estado_recogida']);
	
	switch($diligencia){
		case 'RECOGIDA':
			$upm=" UPDATE  distribucion SET mensajero_origen=".$vector_mensajero_nuevo[0]." WHERE iddistribucion=".$iddistribucion;
			break;
		case 'ENTREGA':	
			$upm=" UPDATE  distribucion SET mensajero_destino=".$vector_mensajero_nuevo[0]." WHERE iddistribucion=".$iddistribucion;
			break;
	}
	phpmkr_query($upm);	
}
?>