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
	
	$idfuncionario=intval($_REQUEST['idfuncionario']);
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

		if(file_exists($ruta_db_superior.$ruta_recortada.$nombre)){
			unlink($ruta_db_superior.$ruta_recortada.$nombre);
		}
		
		
		$extencion=explode('.',$nombre);
		$nombre_nuevo = (rand());
		$ruta_recortada.=$nombre_nuevo.'.'.$extencion[ count($extencion)-1 ];		
		
		imagejpeg($dst_r, $ruta_db_superior.$ruta_recortada, $jpeg_quality);
		imagedestroy($dst_r);
		clearstatcache();
		
		$cordenadas=$_REQUEST['x'].','.$_REQUEST['y'].','.$_REQUEST['x2'].','.$_REQUEST['y2'];
		$sql="UPDATE funcionario SET foto_cordenadas='".$cordenadas."',foto_recorte='".$ruta_recortada."' WHERE idfuncionario=".$idfuncionario;
		phpmkr_query($sql);				
		$exito=1;
	}
	$retorno=array('exito'=>$exito,'ruta_recortada'=>$ruta_recortada);
	echo(json_encode($retorno));
	
}

?>