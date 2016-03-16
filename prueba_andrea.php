<?php


include('db.php');

$iddoc=1874;

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

$bzn_salida=busca_filtro_tabla("a.origen","buzon_salida a, ruta b","a.ruta_idruta=b.idruta AND a.nombre='REVISADO' AND a.ruta_idruta IN(".implode(',',$vector_ruta['idruta']).") AND a.archivo_idarchivo=".$iddoc,"a.idtransferencia ASC",$conn);



$bzn_entrada=busca_filtro_tabla("a.destino,a.origen,a.idtransferencia","buzon_entrada a, ruta b","a.ruta_idruta=b.idruta AND a.nombre='POR_APROBAR' AND a.destino='".$bzn_salida[$bzn_salida['numcampos']-1]['origen']."' AND a.archivo_idarchivo=".$iddoc,"a.idtransferencia ASC",$conn);

$bzn_entrada_anterior=busca_filtro_tabla("a.origen,a.idtransferencia","buzon_entrada a","a.nombre='POR_APROBAR' AND a.origen='".$bzn_entrada[  $bzn_entrada['numcampos']-1 ]['destino']."' AND a.archivo_idarchivo=".$iddoc,"a.idtransferencia ASC",$conn);

$sql1="UPDATE buzon_entrada SET destino='-1' WHERE idtransferencia=".$bzn_entrada[  $bzn_entrada['numcampos']-1 ]['idtransferencia'];
$sql2="UPDATE buzon_entrada SET origen='-1',activo='1' WHERE idtransferencia=".$bzn_entrada_anterior[  $bzn_entrada_anterior['numcampos']-1 ]['idtransferencia'];

$sql3="UPDATE ruta SET origen='-1',activo='1' WHERE idtransferencia=".$bzn_entrada_anterior[  $bzn_entrada_anterior['numcampos']-1 ]['idtransferencia'];




$fun_anterior=busca_filtro_tabla("","vfuncionario_dc","funcionario_codigo=".$bzn_salida[$bzn_salida['numcampos']-2]['origen'],"",$conn);

$fun_firmo=busca_filtro_tabla("","vfuncionario_dc","funcionario_codigo=".$bzn_salida[$bzn_salida['numcampos']-1]['origen'],"",$conn);

$fun_siguiente=busca_filtro_tabla("","vfuncionario_dc","funcionario_codigo=".$bzn_entrada[$bzn_entrada['numcampos']-1]['origen'],"",$conn);

print_r('anterior: '.$fun_anterior[0]['nombres'].' '.$fun_anterior[0]['apellidos']);
print_r('<br>');
print_r('actual: '.$fun_firmo[0]['nombres'].' '.$fun_firmo[0]['apellidos']);
print_r('<br>');
print_r('siguiente: '.$fun_siguiente[0]['nombres'].' '.$fun_siguiente[0]['apellidos']);







?>       