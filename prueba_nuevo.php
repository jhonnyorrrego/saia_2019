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
include_once("db.php");
include_once("pantallas/anexos/librerias_anexos.php");
error_reporting(E_ALL | E_STRICT);

$entrar=1;
if($entrar){
	
	$ruta = RUTA_FOTOGRAFIA_FUNCIONARIO.'original/';
	$idtareas_listado=@$_REQUEST['idtareas_listado'];

	
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
			if($cant)
				$type=$tipo[($cant-1)];
			else{
				$type=$tipo[1];
			}
			$nombre = (rand());
			
			//rename($ruta_db_superior.$ruta."/".$_FILES['files']['name'][0], $ruta_db_superior.$ruta."/".$nombre.'.'.$type);
			chmod($ruta_db_superior.$ruta,0777);
			chmod($ruta_db_superior.$ruta."/".$nombre.'.'.$type,0777);

			
		}
	}
}
?>