<?php

include('db.php');

function paso_anterior($idpaso,$iddiagram){
	global $conn;
	$paso_enlace=busca_filtro_tabla("a.origen,a.tipo_origen","paso_enlace a","a.diagram_iddiagram='".$iddiagram."' AND a.destino='".$idpaso."'","idpaso_enlace",$conn);
	if($paso_enlace['numcampos']){
		if($paso_enlace[0]['tipo_origen']!='bpmn_condicional'){
			if($paso_enlace[0]['origen']!='-1'){
				return $paso_enlace[0]['origen'];
			}else{
				return(0); 
			}		
		}else{
			return $idpaso_anterior=paso_anterior($paso_enlace[0]['origen'],$iddiagram);
		}		
	}else{
		return(0); 
	}	
}



$idpaso=22;
$iddiagram=5;
$idpaso_anterior=paso_anterior($idpaso,$iddiagram);



print_r($idpaso_anterior);



/*
 $iddoc=1879;
 
$ruta=busca_filtro_tabla("a.idruta,a.origen,a.tipo_origen","ruta a","a.origen<>-1 AND a.documento_iddocumento=".$iddoc,"a.idruta ASC",$conn);

$vector_ruta=array('idruta'=>array(),'funcionario_codigo'=>array());

for($i=0;$i<$ruta['numcampos'];$i++){
	if($ruta[$i]['tipo_origen']==1){ //funcionario_codigo
		$funcionario=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc a, ruta b","a.estado_dc=1 AND a.funcionario_codigo=b.origen AND b.documento_iddocumento=".$iddoc." AND a.funcionario_codigo=".$ruta[$i]['origen'],"",$conn);
		$vector_ruta['idruta'][]=$ruta[$i]['idruta'];
		$vector_ruta['funcionario_codigo'][]=$funcionario[0]['funcionario_codigo'];
		
	}else{ //iddependencia_cargo
		$funcionario=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc a, ruta b","b.documento_iddocumento=".$iddoc." AND  a.iddependencia_cargo=b.origen AND a.iddependencia_cargo=".$ruta[$i]['origen'],"",$conn);
		$vector_ruta['idruta'][]=$ruta[$i]['idruta'];
		$vector_ruta['funcionario_codigo'][]=$funcionario[0]['funcionario_codigo'];
	}
}

$bzn_salida=busca_filtro_tabla("a.origen,a.ruta_idruta","buzon_salida a, ruta b","a.ruta_idruta=b.idruta AND a.nombre='REVISADO' AND a.ruta_idruta IN(".implode(',',$vector_ruta['idruta']).") AND a.archivo_idarchivo=".$iddoc,"a.idtransferencia ASC",$conn);

if($bzn_salida['numcampos']){
	
	$bzn_entrada=busca_filtro_tabla("a.destino,a.origen,a.idtransferencia,a.ruta_idruta","buzon_entrada a, ruta b","a.ruta_idruta=b.idruta AND a.nombre='POR_APROBAR' AND a.destino='".$bzn_salida[$bzn_salida['numcampos']-1]['origen']."' AND a.archivo_idarchivo=".$iddoc,"a.idtransferencia ASC",$conn);
	
	$bzn_entrada_anterior=busca_filtro_tabla("a.origen,a.idtransferencia,a.ruta_idruta","buzon_entrada a","a.nombre='POR_APROBAR' AND a.origen='".$bzn_entrada[  $bzn_entrada['numcampos']-1 ]['destino']."' AND a.archivo_idarchivo=".$iddoc,"a.idtransferencia ASC",$conn);	
	
	
	//RUTA
	
	if($bzn_entrada['numcampos']){
		$sql7="UPDATE ruta SET origen='-1' WHERE idruta=".$bzn_entrada[  $bzn_entrada['numcampos']-1 ]['ruta_idruta'];
	}
	if($bzn_entrada_anterior['numcampos']){
		$sql8="UPDATE ruta SET destino='-1' WHERE idruta=".$bzn_entrada_anterior[  $bzn_entrada_anterior['numcampos']-1 ]['ruta_idruta'];
	}	
	
	//BUZON SALIDA
	if($bzn_entrada_anterior['numcampos']){
		$idruta_anterior=busca_filtro_tabla("","ruta","idruta<'".$bzn_entrada_anterior[  $bzn_entrada_anterior['numcampos']-1 ]['ruta_idruta']."' AND documento_iddocumento='".$iddoc."' AND condicion_transferencia='POR_APROBAR' ","",$conn);

		if($idruta_anterior['numcampos']){
			$bzn_salida_partir=busca_filtro_tabla("","buzon_salida","ruta_idruta='".$idruta_anterior[ $idruta_anterior['numcampos']-1 ]['idruta']."' AND  archivo_idarchivo=".$iddoc,"",$conn);
			if($bzn_salida_partir['numcampos']){
				$sql9="DELETE FROM buzon_salida WHERE idtransferencia>'".$bzn_salida_partir[ $bzn_salida_partir['numcampos']-1 ]['idtransferencia']."' AND archivo_idarchivo=".$iddoc;
			}
		}
	}

	//BUZON ENTRADA
	
	if($bzn_entrada_anterior['numcampos']){
		$sql10="UPDATE buzon_entrada SET origen='-1',activo='1' WHERE archivo_idarchivo='".$iddoc."' AND ruta_idruta='".$bzn_entrada_anterior[  $bzn_entrada_anterior['numcampos']-1 ]['ruta_idruta']."'  ";
	}	
	if($bzn_entrada['numcampos']){
		$sql11="UPDATE buzon_entrada SET destino='-1',activo='1' WHERE archivo_idarchivo='".$iddoc."' AND ruta_idruta='".$bzn_entrada[  $bzn_entrada['numcampos']-1 ]['ruta_idruta']."'  ";
	}
	
	if($bzn_entrada_anterior['numcampos']){
		$idruta_anterior2=busca_filtro_tabla("","ruta","idruta<'".$bzn_entrada_anterior[  $bzn_entrada_anterior['numcampos']-1 ]['ruta_idruta']."' AND documento_iddocumento='".$iddoc."' AND condicion_transferencia='POR_APROBAR' ","",$conn);
		
		if($idruta_anterior2['numcampos']){
			$bzn_entrada_partir=busca_filtro_tabla("","buzon_entrada","ruta_idruta='".$idruta_anterior2[ $idruta_anterior2['numcampos']-1 ]['idruta']."' AND  archivo_idarchivo=".$iddoc,"",$conn);
			if($bzn_entrada_partir['numcampos']){
				$sql12="DELETE FROM buzon_entrada WHERE idtransferencia>'".$bzn_entrada_partir[ $bzn_entrada_partir['numcampos']-1 ]['idtransferencia']."' AND archivo_idarchivo=".$iddoc;
			}
		}		
		
	}
}

print_r($sql6);

print_r('<br>');
print_r('<br>');

$fun_anterior=busca_filtro_tabla("","vfuncionario_dc","funcionario_codigo=".$bzn_salida[$bzn_salida['numcampos']-2]['origen'],"",$conn);

$fun_firmo=busca_filtro_tabla("","vfuncionario_dc","funcionario_codigo=".$bzn_salida[$bzn_salida['numcampos']-1]['origen'],"",$conn);

$fun_siguiente=busca_filtro_tabla("","vfuncionario_dc","funcionario_codigo=".$bzn_entrada[$bzn_entrada['numcampos']-1]['origen'],"",$conn);

print_r('anterior: '.$fun_anterior[0]['nombres'].' '.$fun_anterior[0]['apellidos']);
print_r('<br>');
print_r('actual: '.$fun_firmo[0]['nombres'].' '.$fun_firmo[0]['apellidos']);
print_r('<br>');
print_r('siguiente: '.$fun_siguiente[0]['nombres'].' '.$fun_siguiente[0]['apellidos']);

*/










?>       