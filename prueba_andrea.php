<?php

include_once("db.php");

if(@$_REQUEST["tabla"]){
	$tabla=$_REQUEST["tabla"];
}else{
	$tablas=busca_filtro_tabla("table_name","INFORMATION_SCHEMA.tables","TABLE_SCHEMA='saia_release1' AND table_type ='BASE TABLE' AND table_name NOT LIKE'ft_%' AND table_name NOT LIKE'buzon_%' AND table_name NOT LIKE'documento' AND table_name NOT LIKE'anexos' AND table_name NOT LIKE'pagina'","",$conn);
	for ($i=0; $i < $tablas['numcampos']; $i++) { 
		genera_insert_oracle($tablas[$i]['table_name']);
		echo("<br>-----------------------------------------<br><br>");
	}
}
function genera_insert_sql_server($tabla){
	global $conn;
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
}
function genera_insert_oracle($tabla){
	global $conn;
	$datos=busca_filtro_tabla("column_name,data_type","information_schema.columns","TABLE_NAME = '".$tabla."' AND TABLE_SCHEMA='".DB."'","ordinal_position",$conn);
	
	$datos_tabla=busca_filtro_tabla("",$tabla,"","",$conn);
	
	$campos=extrae_campo($datos,"column_name","");
	
	$cadena=array();

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
				else $valores[]="TO_DATE('".$datos_tabla[$j][$datos[$i]["column_name"]]."','YYYY-MM-DD HH24:MI:SS')";
			}
			else if($datos[$i]["data_type"]=='datetime'){
				if($datos_tabla[$j][$datos[$i]["column_name"]]=='0000-00-00 00:00:00')$valores[]="NULL";
				else if(!$datos_tabla[$j][$datos[$i]["column_name"]])$valores[]="NULL";
				else $valores[]="TO_DATE('".$datos_tabla[$j][$datos[$i]["column_name"]]."','YYYY-MM-DD HH24:MI:SS')";
			}else if($datos[$i]["data_type"]=='date'){
				if($datos_tabla[$j][$datos[$i]["column_name"]]=='0000-00-00')$valores[]="NULL";
				else if(!$datos_tabla[$j][$datos[$i]["column_name"]])$valores[]="NULL";
				else $valores[]="TO_DATE('".$datos_tabla[$j][$datos[$i]["column_name"]]."','YYYY-MM-DD')";
			}
			else{
				$valores[]="'".str_replace("'","''",$datos_tabla[$j][$datos[$i]["column_name"]])."'";
			}
		}
		$cadena[]="insert into ".$tabla."(".strtolower(implode(",",$campos)).")values(".implode(",",$valores).");";
	}
	echo(implode("\r",$cadena));
}
?>