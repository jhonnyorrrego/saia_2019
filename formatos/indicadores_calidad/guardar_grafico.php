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
$datos_img1=0;
$datos_img2=0;
if($_REQUEST['iddoc']){
	$ruta_grafico=$ruta_db_superior."temporal_".usuario_actual("login")."/".$_REQUEST['iddoc']."/";
	if(file_exists($ruta_grafico)){
		borrar_archivos_graficos($ruta_grafico,0);
	}
	if(!file_exists($ruta_grafico)){
		crear_destino($ruta_grafico);
	}
	
	if(@$_REQUEST['guardar_imagen']==1){
	if($_REQUEST['img']){
		$datoimg=explode(";",$_REQUEST['img']);
		$decode=explode(",",$datoimg[1]);
		$datos=base64_decode($decode[1]);

		$grafico_total_evaluacion="total_evaluacion.png";
		$archivo = fopen($ruta_grafico.$grafico_total_evaluacion, "w+");	 //crea el archivo
		fclose($archivo);
		file_put_contents($ruta_grafico.$grafico_total_evaluacion, $datos);
		if(file_exists($ruta_grafico.$grafico_total_evaluacion)){
			$datos_img1=1;
		}
	}
	}
	if(@$_REQUEST['guardar_imagen']==2){	
	if($_REQUEST['img2']){
		$datoimg=explode(";",$_REQUEST['img2']);
		$decode=explode(",",$datoimg[1]);
		$datos=base64_decode($decode[1]);
		
		$grafico_competencias="competencias.png";
		$archivo = fopen($ruta_grafico.$grafico_competencias, "w+");	 //crea el archivo
		fclose($archivo);
		file_put_contents($ruta_grafico.$grafico_competencias, $datos);
		if(file_exists($ruta_grafico.$grafico_competencias)){
			$datos_img2=1;
		}
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
function borrar_archivos_graficos($dir, $deleteRootToo){ 
	if(!$dh = @opendir($dir)){ 
  	return; 
  } 
  while (false !== ($obj = readdir($dh))){ 
    if($obj == '.' || $obj == '..'){ 
       continue; 
    } 
    if(!@unlink($dir . '/' . $obj)) {   
       borrar_archivos_graficos($dir.'/'.$obj, true); 
    }  
  }
  closedir($dh); 
  //para borrar la carpeta raiz tambien
  if($deleteRootToo){ 
    @rmdir($dir); 
  }
  return; 
}
?>