<?php
/*$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");

$obj='linea_accion.csv';
$archivo=fopen('tareas_administrativas_saia/cargar_anexos/files/'.$obj,'r');
$a=1;
while($linea=fgetcsv($archivo,0,"|")){
	$tipo="";
	if(strtolower($linea[0])=="linea"){
		$tipo=1;
	}
	if(strtolower($linea[0])=="proyecto"){
		$tipo=2;
	}
	if(strtolower($linea[0])=="accion"){
		$tipo=3;
	}
	$codigo=$linea[1];
	$dato_padre=explode(".",$linea[1]);
	$cant=count($dato_padre);
	$nombre=$linea[2];
	$cc=$linea[3];
	if($cant==1){
		$cod_padre='';
	}
	if($cant==2){
		$cod_padre=$dato_padre[0];
	}
	if($cant==3){
		$cod_padre=$dato_padre[0].".".$dato_padre[1];
	}
	
	$existencia=busca_filtro_tabla("","ft_resumen_presupuestal A","A.codigo='".$codigo."'","",$conn);
	if(!$existencia["numcampos"]){
		$codigo_padre="";
		if($cod_padre){
			$busqueda=busca_filtro_tabla("","ft_resumen_presupuestal A","A.codigo='".$cod_padre."'","",$conn);
			$codigo_padre=$busqueda[0]["idft_resumen_presupuestal"];
		}
		$sql1="insert into ft_resumen_presupuestal(cod_padre,codigo,nombre, centro_costo, tipo, documento_iddocumento, dependencia)values('".$codigo_padre."', '".$codigo."', '".$nombre."', '".$cc."', '".$tipo."', '1', '1')";
		phpmkr_query($sql1);
	}
}*/
echo(phpinfo());
?>