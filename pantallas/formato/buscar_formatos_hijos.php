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
if($_REQUEST["formato"]){
	$datos_formato=busca_filtro_tabla("","formato","etiqueta like '%".$_REQUEST["formato"]."%' and cod_padre=0","",$conn);
	$idformatos=array();
	if($datos_formato["numcampos"]){
		for($i=0;$i<$datos_formato["numcampos"];$i++){
			$idformato[$i]=$datos_formato[$i]["idformato"];	
		}
	}
	else{
		$datos_formato=busca_filtro_tabla("B.cod_padre","formato A, formato B","A.idformato = B.cod_padre and B.etiqueta like '%".$_REQUEST["formato"]."%'","",$conn);
		$idformatos=array();
		if($datos_formato["numcampos"]){
			for($i=0;$i<$datos_formato["numcampos"];$i++){
				$idformato[$i]=$datos_formato[$i]["cod_padre"];	
			}			
		}
	}
	$resultado = implode(",",$idformato);	
	echo $resultado;
}
?>