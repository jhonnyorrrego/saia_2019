<?php
$ruta_actual='../saia/';
include_once $ruta_actual . 'core/autoload.php';
$registros=@$_REQUEST["registros"];
if(!$registros){
	$registros=40;
}
$datos=json_decode($_REQUEST["typehead_datos"]);
$separador=@$_REQUEST["separador"];
$tablas=array();
$where=array();
$retorno=new stdClass();
$campos_consulta=array();
$campos_retorno=array();
foreach($datos AS $key=>$valor){
	$alias="A".rand(0,10);
	array_push($tablas,$key." ".$alias);
	foreach($valor AS $key2=>$valor2){
		if($key2=="campos"){
			foreach($valor2 AS $key3=>$valor3){
				foreach($valor3 AS $key4=>$valor4){
					if(strpos($valor4,"*")!==false){
						$val=@$_REQUEST[str_replace("*","",$valor4)];
						array_push($where,$alias.".".$key4." LIKE '%".htmlentities($val)."%'");
					}
					else{
						array_push($where,$alias.".".$key4."=".$valor4);
					}
				}
			}
		}
		if($key2=="retorno"){
			foreach($valor2 AS $key3=>$valor3){			
				array_push($campos_consulta,$alias.".".$valor3);
				array_push($campos_retorno,$valor3);
			}
		}
	}
}

$consulta=busca_filtro_tabla(implode(",",$campos_consulta),implode(",",$tablas),implode(" AND ",$where),"",$conn);
$retorno->numcampos=$consulta["numcampos"];
if($consulta["numcampos"]){
	for($i=0;$i<$registros&&$i<$consulta["numcampos"];$i++){
		$cadena=array();
		foreach($campos_retorno AS $key=>$valor){
			array_push($cadena,$consulta[$i][$valor]);
		}
		$retorno->datos[]=html_entity_decode(implode($separador,$cadena));
	}
}
echo(json_encode($retorno));