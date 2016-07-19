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

	if(!file_exists($ruta_grafico)){
		crear_destino($ruta_grafico);
	}
	
	$archivo_eliminar='';
	if(@$_REQUEST['nombre_imagen'] && @$_REQUEST['extension']){
	    $archivo_eliminar=$_REQUEST['nombre_imagen'].$_REQUEST['extension'];
    	if(file_exists($ruta_grafico.$archivo_eliminar)){
    		unlink($ruta_grafico.$archivo_eliminar);
    	}
	}
	
	if($_REQUEST['img']){
		$datoimg=explode(";",$_REQUEST['img']);
		$decode=explode(",",$datoimg[1]);
		$datos=base64_decode($decode[1]);
		$grafico=$_REQUEST['nombre_imagen'].$_REQUEST['extension'];
		$archivo = fopen($ruta_grafico.$grafico, "w+");	 //crea el archivo
		fclose($archivo);
		file_put_contents($ruta_grafico.$grafico, $datos);
		if(file_exists($ruta_grafico.$grafico)){
			$exito=1;
		}
	}
}
if($exito){
	echo 1;
}else{
    echo 0;
} 

?>