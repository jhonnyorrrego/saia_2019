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
//$_REQUEST["idbusqueda_grafico"]=1;

$graficos=busca_filtro_tabla("","busqueda_grafico A,busqueda_grafico_serie B","A.idbusqueda_grafico=B.busqueda_grafico_idbusqueda_grafico AND A.idbusqueda_grafico=".@$_REQUEST["idbusqueda_grafico"]." AND A.estado=1","",$conn);
$_REQUEST["idbusqueda_componente"]=$graficos[0]["busqueda_idbusqueda_componente"];
include_once($ruta_db_superior."pantallas/busquedas/servidor_busqueda.php");
$datos=array(); 
$nombre_serie=array(); 
$mascaras=array();
$enmascarar=false;
$sql_serie=array();
for($i=0;$i<$graficos["numcampos"];$i++){
	$condicion2=$condicion;
	if($graficos[$i]["condicion_adicional"]!=''){
		$condicion2.=$graficos[$i]["condicion_adicional"];
	}
	$resultados=busca_filtro_tabla($graficos[$i]["dato"]." AS dato, ".$graficos[$i]["valor"]." AS valor",$tablas_consulta,$condicion2,"GROUP BY ".$graficos[$i]["dato"],$conn);
	if($resultados["numcampos"]){	
		$series=array();
		$etiquetas=array();
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
			array_push($series,array(codifica_encabezado(html_entity_decode($resultados[$j]["dato"])),intval($resultados[$j]["valor"])));				
		}
		array_push($datos,$series);		
		unset($series);	
		array_push($nombre_serie,array("label"=>$graficos[$i]['nombre']));
		array_push($sql_serie,$resultados["sql"]);			
	}else{
		array_push($sql_serie,$resultados["sql"]);	
	}
}
//array_push($nombre_serie,array("renderer"=>$.jqplot.BarRenderer));
$data['datos']=$datos;			
$data['nombre_serie']=$nombre_serie;
$data['nombre_grafico']=$graficos[0]['etiqueta']	;
$data['xaxis']=$graficos[0]["etiquetax"];
$data['yaxis']=$graficos[0]["etiquetay"];
$data['sql']=$sql_serie;
echo(json_encode($data));
?>