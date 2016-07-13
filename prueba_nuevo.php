<?php

phpinfo();

die();
include_once('db.php');

$idbusqueda=46;
$consulta=busca_filtro_tabla("","busqueda","idbusqueda=".$idbusqueda,"",$conn);
$busqueda=$consulta;
for($i=0;$i<count($busqueda[0]);$i++){
	unset($busqueda[0][$i]);
}
unset($busqueda[0]['idbusqueda']);
$tabla="busqueda";
$fieldList=array();
		
$strsql = "INSERT INTO ".$tabla." (";
$strsql .= implode(",", array_keys($busqueda[0]));			
$strsql .= ") VALUES ('";			
$strsql .= implode("','", array_values($busqueda[0]));			
$strsql .= "')";
		
echo($strsql); //imprimo busqueda

echo('<br><br><br>');

$consulta_componente=busca_filtro_tabla("","busqueda_componente","busqueda_idbusqueda=".$idbusqueda,"",$conn);
$busqueda_componente=$consulta_componente;

for($j=0;$j<$busqueda_componente['numcampos'];$j++){
	for($i=0;$i<count($busqueda_componente[$j]);$i++){
		unset($busqueda_componente[$j][$i]);
	}
	unset($busqueda_componente[$j]['idbusqueda_componente']);
	$tabla="busqueda_componente";
	$fieldList=array();
			
	$strsql = "INSERT INTO ".$tabla." (";
	$strsql .= implode(",", array_keys($busqueda_componente[$j]));			
	$strsql .= ") VALUES ('";			
	$strsql .= implode("','", array_values($busqueda_componente[$j]));			
	$strsql .= "')";
			
	echo($strsql); //imprimo busqueda componente
	echo('<br><br>');
	$sql_condicion='&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>';
	
	$consulta_condicion=busca_filtro_tabla("","busqueda_condicion","fk_busqueda_componente=".$consulta_componente[$j]['idbusqueda_componente'],"",$conn);
	
	if(!$consulta_condicion['numcampos']){
		$consulta_condicion=busca_filtro_tabla("","busqueda_condicion","busqueda_idbusqueda=".$idbusqueda,"",$conn);
	}
	if($consulta_condicion['numcampos']){
		
		for($x=0;$x<count($consulta_condicion[0]);$x++){
			unset($consulta_condicion[0][$x]);
		}
		unset($consulta_condicion[0]['idbusqueda_condicion']);
		$tabla="busqueda_condicion";
		$fieldList=array();
					
		$strsql = "INSERT INTO ".$tabla." (";
			$strsql .= implode(",", array_keys($consulta_condicion[0]));			
			$strsql .= ") VALUES ('";			
			$strsql .= implode("','", array_values($consulta_condicion[0]));			
			$strsql .= "')";
					
		$sql_condicion.=$strsql.'</b>';
		echo($sql_condicion); //imprimo busqueda condicion
		echo('<br><br><br>');		
	}	
}
die();
?>