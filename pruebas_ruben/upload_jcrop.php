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
error_reporting(E_ALL | E_STRICT);


if(@$_REQUEST['subir']){
	
	$idfuncionario=@$_REQUEST['idfuncionario'];
	
	$ruta = RUTA_FOTOGRAFIA_FUNCIONARIO.'original/';

	$configuracion = busca_filtro_tabla("valor,nombre","configuracion","nombre LIKE 'extensiones_upload' OR nombre LIKE 'tamanio_maximo_upload'","",$conn);
	
	
	$extenciones='';
	$max_tamanio='';
	if($configuracion['numcampos']){
		for($i=0; $i < $configuracion['numcampos']; $i++){
			switch ($configuracion[$i]['nombre']) {
				case 'extensiones_upload':
					$extenciones = str_replace(',','|',$configuracion[$i]['valor']);
					break;
				case 'tamanio_maximo_upload':
					$max_tamanio = $configuracion[$i]['valor'];
					break;
			}
		}		
	}
	$options = array('upload_dir'=> $ruta_db_superior.$ruta,
			'upload_url'=> $ruta_db_superior.$ruta,
			'accept_file_types' => '/\.('.$extenciones.')$/i',
			'max_file_size' => $max_tamanio
	);

	
  	crear_destino($ruta_db_superior.$ruta);
	$upload_handler = new UploadHandler($options);
	$files = $upload_handler->get_resultado_carga(1);
	foreach ($files->files as $key => $value){
		if(!isset($value->error)){
			$tipo =  explode('.', $_FILES['files']['name'][0]);
			
			$cant=count($tipo);
			$type=$tipo[($cant-1)];
			$nombre = (rand());
			rename ($ruta_db_superior.$ruta.$tipo[0].'.'.$tipo[1], $ruta_db_superior.$ruta.$nombre.'.'.$tipo[1]);
			
			$foto_original=busca_filtro_tabla("foto_original","funcionario","idfuncionario=".$idfuncionario,"",$conn);
			if($foto_original[0]['foto_original']!=''){
				if(file_exists($ruta_db_superior.$foto_original[0]['foto_original'])){
					unlink($ruta_db_superior.$foto_original[0]['foto_original']);
				}
			}
			
			$sql="UPDATE funcionario SET foto_original='".$ruta.$nombre.'.'.$tipo[1]."' WHERE idfuncionario=".$idfuncionario;
			phpmkr_query($sql);

		}
	}
}
?>