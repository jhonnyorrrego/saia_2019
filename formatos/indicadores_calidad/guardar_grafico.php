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
include_once ($ruta_db_superior."db.php");
$exito=0;
if($_REQUEST['iddoc']){
    
	$ruta_grafico=$ruta_db_superior."temporal_".usuario_actual("login")."/".$_REQUEST['iddoc']."/";
	
	$archivo_eliminar='';
	if(@$_REQUEST['nombre_imagen']){
	    $archivo_eliminar=$_REQUEST['nombre_imagen'];
    	if(file_exists($ruta_grafico.$archivo_eliminar)){
    		unlink($ruta_grafico.$archivo_eliminar);
    	}
	}
	
	
	if(!file_exists($ruta_grafico)){
		crear_destino($ruta_grafico);
	}

	if($_REQUEST['img']){
		$datoimg=explode(";",$_REQUEST['img']);
		$decode=explode(",",$datoimg[1]);
		$datos=base64_decode($decode[1]);
		$grafico_total_evaluacion="total_evaluacion.png";
		$archivo = fopen($ruta_grafico.$grafico_total_evaluacion, "w+");	 //crea el archivo
		fclose($archivo);
		file_put_contents($ruta_grafico.$grafico_total_evaluacion, $datos);
		if(file_exists($ruta_grafico.$grafico_total_evaluacion)){
			$exito=1;
		}
	}
}
if($datos_img1==1){
	echo 1;
}else if($datos_img2==1){
    echo 1;
}else{
	echo 2;
}

?>