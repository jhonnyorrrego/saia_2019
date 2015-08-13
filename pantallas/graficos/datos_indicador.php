<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
} 
include_once($ruta_db_superior."db.php");
$reportes=busca_filtro_tabla("A.*,B.nombre AS componente,B.busqueda_idbusqueda,C.ruta_libreria","busqueda_indicador A,busqueda_componente B, busqueda C","B.busqueda_idbusqueda=C.idbusqueda AND A.busqueda_idbusqueda_componente=B.idbusqueda_componente AND A.idbusqueda_indicador=".$_REQUEST["idbusqueda_indicador"],"",$conn);
$i=0;
if($reportes[$i]["ruta_libreria"]!=''){
	$librerias=explode(",",$reportes[$i]["ruta_libreria"]);
	$cant_librerias=count($librerias);
	for($j=0;$j<$cant_librerias;$j++){			
		include_once($ruta_db_superior.$librerias[$j]);
	}		
}
$regs=array();	
$resultado=preg_match_all( '({\*([a-z]+[0-9]*[_]*[a-z]*[0-9]*[.]*[,]*[@]*)+\*})',$reportes[$i]["descripcion"], $regs );
unset($valor_variables);
$valor_variables=array();
if($resultado){
	$cadena=str_replace("{*", "", str_replace("*}", "", $regs[0][0]));				
	$funcion=explode("@",$cadena);
	$variables=array();		
	if(@$funcion[1]!=''){	
		$variables=explode(",",@$funcion[1]);
	}
	$cant_variables=count($variables);
	for($h=0;$h<$cant_variables;$h++){
	    array_push($valor_variables,$variables[$h]);
	}
	$resultado_call=call_user_func_array($funcion[0],$valor_variables);
	$reportes[$i]["descripcion"]=str_replace("{*".$cadena."*}",$resultado_call,$reportes[$i]["descripcion"]);
}
echo('<span style="font-family: verdana,tahoma,arial;font-size: 10px;">');
echo($reportes[$i]["descripcion"]);
echo('</span>');
?>