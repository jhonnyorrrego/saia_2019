<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."distribucion/funciones_distribucion.php");
ini_set('display_errors',true);

/*
QUE TIENE LA RADICACION VIEJA?

ft_destino_radicacion
	
	en este formato "item_despacho_ingres" esta el campo:
		- ft_destino_radicacio (idft_destino_radicacion).
		
	en este formato "novedad_despacho" esta el campo:
		- item_radicacion (idft_destino_radicacion: separado por comas :( ).		

*/
die('<--- DIE DE SEGURIDAD --->');

$distribuciones_antiguas=busca_filtro_tabla("a.idft_destino_radicacion,a.tipo_origen,a.tipo_destino,a.nombre_origen,a.nombre_destino,a.destino_externo,a.origen_externo,a.estado_item,a.estado_recogida,a.idft_destino_radicacion,b.documento_iddocumento","ft_destino_radicacion a, ft_radicacion_entrada b,documento c","a.ft_radicacion_entrada=b.idft_radicacion_entrada AND b.documento_iddocumento=c.iddocumento AND lower(c.estado)='aprobado' ","",$conn);
$vector_idft_item_despacho_ingres=array();
for($i=0;$i<$distribuciones_antiguas['numcampos'];$i++){
	
	$iddoc=$distribuciones_antiguas[$i]['documento_iddocumento'];
	$iddistribucion_antigua=$distribuciones_antiguas[$i]['idft_destino_radicacion'];
	
	$origen=0;
	$tipo_origen=0;
	
	$destino=0;
	$tipo_destino=0;
	
	$estado_distribucion=0;
	if($distribuciones_antiguas[$i]['estado_item']){
		$estado_distribucion=$distribuciones_antiguas[$i]['estado_item'];
	}
	
	$estado_recogida=0;
	if($distribuciones_antiguas[$i]['estado_recogida']){
		$estado_recogida=1;
	}	
	
	
	
		
	if($distribuciones_antiguas[$i]['tipo_origen']==2 && $distribuciones_antiguas[$i]['tipo_destino']==2){  //INT - INT
		
		$origen=$distribuciones_antiguas[$i]['nombre_origen'];
		$tipo_origen=1;
		
		$destino=$distribuciones_antiguas[$i]['nombre_destino'];
		$tipo_destino=1;
		
	}
	
	if($distribuciones_antiguas[$i]['tipo_origen']==2 && $distribuciones_antiguas[$i]['tipo_destino']==1){  //INT - EXT
	
		$origen=$distribuciones_antiguas[$i]['nombre_origen'];
		$tipo_origen=1;
		
		$destino=$distribuciones_antiguas[$i]['nombre_destino'];
		if(!$destino){
			$destino=$distribuciones_antiguas[$i]['destino_externo'];
		}
		$tipo_destino=2;	
	
	}	
		
	if($distribuciones_antiguas[$i]['tipo_origen']==1 && $distribuciones_antiguas[$i]['tipo_destino']==2){  //EXT - INT
	
		$origen=$distribuciones_antiguas[$i]['nombre_origen'];
		if(!$origen){
			$origen=$distribuciones_antiguas[$i]['origen_externo'];
		}
		$tipo_origen=1;
		
		$destino=$distribuciones_antiguas[$i]['nombre_destino'];
		$tipo_destino=1;
	
	}	

	$datos_distribucion=array();
	$datos_distribucion['origen']=$origen;
	$datos_distribucion['tipo_origen']=$tipo_origen;
	$datos_distribucion['destino']=$destino;
	$datos_distribucion['tipo_destino']=$tipo_destino;
	$datos_distribucion['estado_distribucion']=$estado_distribucion;
	$datos_distribucion['estado_recogida']=$estado_recogida;	
	
	$ingresar=ingresar_distribucion($iddoc,$datos_distribucion,$iddistribucion_antigua);
	
}


	


?>