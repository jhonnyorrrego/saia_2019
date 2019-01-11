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
require_once($ruta_db_superior.'StorageUtils.php');
require_once($ruta_db_superior.'filesystem/SaiaStorage.php');

if(@$_REQUEST['eliminar_foto']){
	
	$idfuncionario=@$_REQUEST['idfuncionario'];
	$datos_fotografia=busca_filtro_tabla("foto_original,foto_recorte,foto_cordenadas","funcionario","idfuncionario=".$idfuncionario,"",$conn);

	
	$exito=0;
	if($datos_fotografia['numcampos']){
		$tipo_almacenamiento_original = StorageUtils::resolver_ruta($datos_fotografia[0]['foto_original']);
		$tipo_almacenamiento_recortada = StorageUtils::resolver_ruta($datos_fotografia[0]['foto_recorte']);
		
		if($tipo_almacenamiento_original['clase']->get_filesystem()->has($tipo_almacenamiento_original['ruta'])){
			$tipo_almacenamiento_original['clase']->get_filesystem()->delete($tipo_almacenamiento_original['ruta']);
		}
		if($tipo_almacenamiento_recortada['clase']->get_filesystem()->has($tipo_almacenamiento_recortada['ruta'])){
			$tipo_almacenamiento_recortada['clase']->get_filesystem()->delete($tipo_almacenamiento_recortada['ruta']);
		}	
		
		$sql=" UPDATE funcionario SET  foto_original=null,foto_recorte=null,foto_cordenadas=null WHERE idfuncionario=".$idfuncionario;
		phpmkr_query($sql);	
		$exito=1;
	}
	echo(json_encode(array('exito'=>$exito)));
}

?>
