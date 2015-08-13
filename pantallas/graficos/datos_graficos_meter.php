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

$graficos=busca_filtro_tabla("","busqueda_grafico A,busqueda_grafico_serie B","A.idbusqueda_grafico=B.busqueda_grafico_idbusqueda_grafico AND A.idbusqueda_grafico=".@$_REQUEST["idbusqueda_grafico"]." AND A.estado=1","",$conn);
$_REQUEST["idbusqueda_componente"]=$graficos[0]["busqueda_idbusqueda_componente"];
include_once($ruta_db_superior."pantallas/busquedas/servidor_busqueda.php");

$mascaras=array();
$enmascarar=false;
$array=array();
for($i=0;$i<$graficos["numcampos"];$i++){
	$resultados=busca_filtro_tabla($graficos[$i]["dato"]." AS dato, ".$graficos[$i]["valor"]." AS valor",$tablas_consulta,$condicion,"GROUP BY ".$graficos[$i]["dato"],$conn);
	if($resultados["numcampos"]){	
		$series=array();
		$series2=array();
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
			array_push($series,array($resultados[$j]["dato"],intval($resultados[$j]["valor"])));// valores de barras
			array_push($series2,array($resultados[$j]["dato"],intval($resultados[$j]["valor"])));// valores de lineas	
			
		}
		array_push($array,$series);	
		array_push($array,$series2);
		$data['datos']=$array;	
		$data['nombregrafico']=$graficos[0]['etiqueta']	;
		$data['min']=5;		
		$data['max']=10;							
	}
}
echo(json_encode($data));
?>