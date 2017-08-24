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


function cambiar_mensajero_distribucion(){
	global $conn;
	
	$iddistribucion=@$_REQUEST['iddistribucion'];
	if($iddistribucion){
	
		$vector_mensajero_nuevo=explode('-',@$_REQUEST['mensajero']);
		
		$distribucion=busca_filtro_tabla("tipo_origen,estado_recogida,tipo_destino","distribucion","iddistribucion=".$iddistribucion,"",$conn);
		$diligencia=mostrar_diligencia_distribucion($distribucion[0]['tipo_origen'],$distribucion[0]['estado_recogida']);
		
		switch($diligencia){
			case 'RECOGIDA':
				$upm=" UPDATE  distribucion SET mensajero_origen=".$vector_mensajero_nuevo[0]." WHERE iddistribucion=".$iddistribucion;
				break;
			case 'ENTREGA':
				$update_adicional=',mensajero_empresad=0';
				if($distribucion[0]['tipo_destino']==2 && $vector_mensajero_nuevo[1]=='e'){ //si es una empresa_transportadora es decir mensajero_empresad
					$update_adicional=',mensajero_empresad=1';
				}	
				$upm=" UPDATE  distribucion SET mensajero_destino=".$vector_mensajero_nuevo[0].$update_adicional." WHERE iddistribucion=".$iddistribucion;
				break;
		}
		phpmkr_query($upm);	
	}	
	$retorno=array('exito'=>1);
	return($retorno);
}


function finalizar_distribucion(){
	global $conn;
	$retorno=array('exito'=>0);
	if(@$_REQUEST['iddistribucion']){
		
		$vector_iddistribucion=explode(',',$_REQUEST['iddistribucion']);
		
		for($i=0;$i<count($vector_iddistribucion);$i++){
			$iddistribucion=$vector_iddistribucion[$i];
			
			$distribucion=busca_filtro_tabla("tipo_origen,estado_recogida","distribucion","iddistribucion=".$iddistribucion,"",$conn);
			$diligencia=mostrar_diligencia_distribucion($distribucion[0]['tipo_origen'],$distribucion[0]['estado_recogida']);
			$upd='';
			switch($diligencia){
				case 'RECOGIDA':
					$upd=" UPDATE distribucion SET estado_recogida=1,estado_distribucion=1 WHERE iddistribucion=".$iddistribucion;
					break;
				case 'ENTREGA':	
					$upd=" UPDATE distribucion SET estado_distribucion=3 WHERE iddistribucion=".$iddistribucion;			
					break;
			} //fin switch
			
			if($upd!=''){
				phpmkr_query($upd);	
			}
			
		} //fin for $vector_iddistribucion
		$retorno['exito']=1;
	} //fin if $_REQUEST['iddistribucion']
	return($retorno);
	
} //fin function finalizar_distribucion()


if(@$_REQUEST['ejecutar_accion']){
	$retorno=$_REQUEST['ejecutar_accion']();
	echo( json_encode($retorno) );
}


?>