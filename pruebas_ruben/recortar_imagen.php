<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."pantallas/anexos/librerias_anexos.php");



if(@$_REQUEST['recortar']){
	
	$idfuncionario=$_REQUEST['idfuncionario'];
	$foto_original=busca_filtro_tabla("foto_original","funcionario","idfuncionario=".$idfuncionario,"",$conn);
	
	$targ_w = $targ_h = 150;
	$jpeg_quality = 90;
	
	$src = $ruta_db_superior.$foto_original[0]['foto_original'];
	$exito=0;
	if(file_exists($src)){
		
		$img_r = imagecreatefromjpeg($src);
		$dst_r = ImageCreateTrueColor($targ_w, $targ_h);
		imagecopyresampled($dst_r, $img_r, 0, 0, $_REQUEST['x'], $_REQUEST['y'], $targ_w, $targ_h, $_REQUEST['w'], $_REQUEST['h']);
		header('Content-type: image/jpeg');	
		
		$nombre=basename($src);
		$ruta_recortada=RUTA_FOTOGRAFIA_FUNCIONARIO.'recorte/';
		crear_destino($ruta_db_superior.$ruta_recortada);	
		$ruta_recortada.=$nombre;
		if(file_exists($ruta_db_superior.$ruta_recortada)){
			unlink($ruta_db_superior.$ruta_recortada);
		}
		
		imagejpeg($dst_r, $ruta_db_superior.$ruta_recortada, $jpeg_quality);
		
		$sql="UPDATE funcionario SET foto_recorte='".$ruta_recortada."' WHERE idfuncionario=".$idfuncionario;
		phpmkr_query($sql);				
		$exito=1;
	}
	$retorno=array('exito'=>$exito);
	echo(json_encode($retorno));
	
}
   
   
   
   
  
   
  
   
  


?>