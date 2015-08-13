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
$_REQUEST["page"]=0;
$_REQUEST["rows"]=1;
$_REQUEST["actual_row"]=0;
$_REQUEST["no_imprime"]=1;
$_REQUEST["idbusqueda_grafico"]=2;

$graficos=busca_filtro_tabla("","busqueda_grafico A,busqueda_grafico_serie B","A.idbusqueda_grafico=B.busqueda_grafico_idbusqueda_grafico AND A.idbusqueda_grafico=".@$_REQUEST["idbusqueda_grafico"]." AND A.estado=1","",$conn);
$_REQUEST["idbusqueda_componente"]=$graficos[0]["busqueda_idbusqueda_componente"];
include_once($ruta_db_superior."pantallas/busquedas/servidor_busqueda.php");
$mascaras=array();
$enmascarar=false;
$condicion_adicional="";
$tick=array();
$series=array();
$datos["serie"]=array();
$datos["serie_temp"]=array();
for($i=0;$i<$graficos["numcampos"];$i++){
	if($graficos[$i]['condicion_adicional']!=""){
		$condicion_adicional.= " ".$graficos[$i]['condicion_adicional'];
	}
	// enmascarar H
	$resultados=busca_filtro_tabla($graficos[$i]["dato"]." AS dato, ".$graficos[$i]["valor"]." AS valor",$tablas_consulta,$condicion.$condicion_adicional,"GROUP BY ".$graficos[$i]["dato"],$conn);
	if($resultados["numcampos"]){	
		if($graficos[$i]["mascara_dato"]){
			$enmascarar=true;
			$arreglo1=explode("!",$graficos[$i]["mascara_dato"]);			
			foreach($arreglo1 AS $key=>$valor){
				$arreglo2=explode("@",$valor);
				$mascaras[$arreglo2[0]]=$arreglo2[1];	
			}
		}
		for($j=0;$j<$resultados["numcampos"];$j++){
			if($enmascarar){
				$resultados[$j]["dato"]=$mascaras[$resultados[$j]["dato"]];
			}
			array_push($series,array($resultados[$j]["dato"]=>$resultados[$j]["valor"]));
			array_push($tick,$resultados[$j]["dato"]);
		}
		array_push($datos["serie_temp"],$series);	
	}
	$condicion_adicional="";
}
$datos["etiquetas"]=array_values(array_unique($tick));
$cant_series=count($datos["serie_temp"]);
$cant_etiquetas=count($datos["etiquetas"]);
for($i=0;$i<$cant_series;$i++){
	$datos["serie"][$i]=array();
	for($j=0;$j<$cant_etiquetas;$j++){
		if(isset($datos["serie_temp"][$i][$j][$datos["etiquetas"][$j]])){
			array_push($datos["serie"][$i],intval($datos["serie_temp"][$i][$j][$datos["etiquetas"][$j]]));
		}else{
			array_push($datos["serie"][$i],0);
		}
	}
}

unset($datos['serie_temp']);

//print_r($graficos);
echo(json_encode($datos));
 
?>