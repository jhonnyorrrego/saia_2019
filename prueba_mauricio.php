<?php
include_once("db.php");


$tabla="modulo";
if(@$_REQUEST["tabla"])$tabla=$_REQUEST["tabla"];
$datos=busca_filtro_tabla("column_name,data_type","information_schema.columns","TABLE_NAME = '".$tabla."' AND TABLE_SCHEMA='".DB."'","ordinal_position",$conn);

$datos_tabla=busca_filtro_tabla("",$tabla,"","",$conn);

$campos=extrae_campo($datos,"column_name","");

$cadena=array();
$cadena[]="set identity_insert ".$tabla." on;";
for($j=0;$j<$datos_tabla["numcampos"];$j++){
$valores=array();
	for($i=0;$i<$datos["numcampos"];$i++){
		if($datos[$i]["data_type"]=='int'){
			if($datos_tabla[$j][$datos[$i]["column_name"]]==0)$valores[]=0;
			else if($datos_tabla[$j][$datos[$i]["column_name"]])$valores[]=$datos_tabla[$j][$datos[$i]["column_name"]];
			else $valores[]="NULL";
		}
		else if($datos[$i]["data_type"]=='blob' || $datos[$i]["data_type"]=='mediumblob'){
			$valores[]="NULL";
			//$valores[]="'".$datos_tabla[$j][$datos[$i]["column_name"]]."'";
		}
		else if($datos[$i]["data_type"]=='timestamp'){
			if(!$datos_tabla[$j][$datos[$i]["column_name"]])$valores[]="NULL";
			else $valores[]="CONVERT(datetime,'".$datos_tabla[$j][$datos[$i]["column_name"]].".000',20)";
		}
		else if($datos[$i]["data_type"]=='datetime'){
			if($datos_tabla[$j][$datos[$i]["column_name"]]=='0000-00-00 00:00:00')$valores[]="NULL";
			else if(!$datos_tabla[$j][$datos[$i]["column_name"]])$valores[]="NULL";
			else $valores[]="CONVERT(datetime,'".$datos_tabla[$j][$datos[$i]["column_name"]].".000',20)";
		}
		else{
			$valores[]="'".str_replace("'","''",$datos_tabla[$j][$datos[$i]["column_name"]])."'";
		}
	}
	$cadena[]="insert into ".$tabla."(".strtolower(implode(",",$campos)).")values(".implode(",",$valores).");";
}
$cadena[]="set identity_insert ".$tabla." off;";
echo(implode("\r",$cadena));
?>