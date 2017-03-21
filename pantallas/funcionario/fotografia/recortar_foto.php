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
include_once($ruta_db_superior."StorageUtils.php");
include_once($ruta_db_superior.'filesystem/SaiaStorage.php');
if(@$_REQUEST['recortar']){
	
	$idfuncionario=intval($_REQUEST['idfuncionario']);
	$foto_original=busca_filtro_tabla("foto_original","funcionario","idfuncionario=".$idfuncionario,"",$conn);
	
	$targ_w = $targ_h = 150;
	$jpeg_quality = 90;
	
	$src = $ruta_db_superior.$foto_original[0]['foto_original'];
	$exito=0;
	$arr_alm = StorageUtils::resolver_ruta($foto_original[0]['foto_original']);
	$tipo_almacenamiento2 = $arr_alm["clase"];
	if($tipo_almacenamiento2->get_filesystem()->has($arr_alm["ruta"])){
		
		$archivo=$tipo_almacenamiento2->get_filesystem()->get($arr_alm["ruta"]);
		$archivo_binario = $archivo->getContent();	
		
		$img_r = imagecreatefromstring($archivo_binario);
		$dst_r = ImageCreateTrueColor($targ_w, $targ_h);
		imagecopyresampled($dst_r, $img_r, 0, 0, $_REQUEST['x'], $_REQUEST['y'], $targ_w, $targ_h, $_REQUEST['w'], $_REQUEST['h']);
		header('Content-type: image/jpeg');	
		
		$ruta_recortada=RUTA_FOTOGRAFIA_FUNCIONARIO.'recorte/';

		$variable=StorageUtils::get_memory_filesystem('fotos','saia');
		$variable->write('foto_funcionario_recorte/helloworld.txt','helloworld'); //se usa para crear directorio temporal
		$ruta_temporal='saia://fotos/foto_funcionario_recorte/';		
		
		$extencion='jpg';
		$nombre_nuevo = (rand());
		$ruta_recortada.=$nombre_nuevo.'.'.$extencion;		
		
		imagejpeg($dst_r, $ruta_temporal.$nombre_nuevo.'.'.$extencion, $jpeg_quality);
		imagedestroy($dst_r);
		$binario = file_get_contents($ruta_temporal.$nombre_nuevo.'.'.$extencion);	
		$tipo_almacenamiento = new SaiaStorage("imagenes");
		$ruta_final = RUTA_FOTOGRAFIA_FUNCIONARIO.'recorte/';
		$resultado = $tipo_almacenamiento->almacenar_contenido($ruta_final.$nombre_nuevo.'.'.$extencion, $binario);
		$ruta_anexos = array("servidor" => $tipo_almacenamiento->get_ruta_servidor(), "ruta" => $ruta_final.$nombre_nuevo.'.'.$extencion);	
		$ruta_anexos=json_encode($ruta_anexos);		
		
		$cordenadas=$_REQUEST['x'].','.$_REQUEST['y'].','.$_REQUEST['x2'].','.$_REQUEST['y2'];
		$sql="UPDATE funcionario SET foto_cordenadas='".$cordenadas."',foto_recorte='".$ruta_anexos."' WHERE idfuncionario=".$idfuncionario;
		phpmkr_query($sql);				
		$exito=1;
		
		//$archivo_binario=StorageUtils::get_binary_file($ruta_anexos);
		
		//$ruta_anexos=$archivo_binario;
	}
	$retorno=array('exito'=>$exito,'ruta_recortada'=>$ruta_anexos);
	echo(json_encode($retorno));
	
}

?>
