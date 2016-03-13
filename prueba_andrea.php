<?php


include('db.php');

$condiciona_fecha='';
if(@$_REQUEST['variable_busqueda']){
	$fechas=explode('|',$_REQUEST['variable_busqueda']);
	
	$fecha_filtrar_x=$fechas[0];
	$fecha_filtrar_y=$fechas[1];
	
	$condiciona_fecha=" AND (a.fecha<='".$fecha_filtrar_x."' AND a.fecha>='".$fecha_filtrar_y."' ) ";
}

$dependencia_cargo=busca_filtro_tabla("b.dependencia","documento a, ft_carta b","a.iddocumento=b.documento_iddocumento AND a.estado='APROBADO'".$condicion_adicional,"",$conn);

$cadena_dependencia_cargo=implode(',',extrae_campo($dependencia_cargo,'dependencia'));

$dependencias=busca_filtro_tabla("","dependencia a, dependencia_cargo b","a.iddependencia=b.dependencia_iddependencia AND b.iddependencia_cargo IN(".$cadena_dependencia_cargo.") AND a.iddependencia=".$dependencia,"",$conn);

return($dependencias['numcampos']);

print_r($dependencias);



?>       