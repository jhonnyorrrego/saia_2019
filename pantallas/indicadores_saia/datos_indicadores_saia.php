<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
	while($max_salida>0){
	  if(is_file($ruta."db.php")){
	    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	  }
	  $ruta.="../";
	  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
$reporte_modulos=busca_filtro_tabla("idmodulo,etiqueta,enlace","modulo","cod_padre =".$_REQUEST["idmodulo"],"orden",$conn);
$datos = array();
for($i=0;$i<$reporte_modulos["numcampos"];$i++){
	$grafico=busca_filtro_tabla("A.*,B.nombre,B.busqueda_idbusqueda","busqueda_grafico A,busqueda_componente B","A.busqueda_idbusqueda_componente=B.idbusqueda_componente AND A.modulo_idmodulo=".$reporte_modulos[$i]["idmodulo"],"",$conn);	
	array_push($datos, array("id"=>$reporte_modulos[$i]["idmodulo"],"descripcion"=>$reporte_modulos[$i]["etiqueta"],"url"=>$ruta_db_superior.$reporte_modulos[$i]["enlace"],"alto"=>$grafico[0]["alto"],"ancho"=>$grafico[0]["ancho"],"idbusqueda_componente"=>$grafico[0]["busqueda_idbusqueda_componente"],"idbusqueda"=>$grafico[0]["busqueda_idbusqueda"],"default_componente"=>$grafico[0]["nombre"]));	
}
echo(json_encode($datos));
?>