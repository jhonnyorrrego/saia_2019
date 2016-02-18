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

$tipo =  explode('/', $_FILES['files']['type'][0]);

$estado_documento = busca_filtro_tabla("estado","documento","iddocumento=".$_REQUEST['iddocumento'],"",$conn);
$ruta = RUTA_ARCHIVOS.$estado_documento[0]['estado'].'/'.date('Y-m').'/'.$_REQUEST['iddocumento'].'/anexos/';
$configuracion = busca_filtro_tabla("valor,nombre","configuracion","nombre LIKE 'extensiones_upload' OR nombre LIKE 'tamanio_maximo_upload'","",$conn);

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

$options = array('upload_dir'=> $ruta_db_superior.$ruta, 
'upload_url'=> $ruta_db_superior.$ruta,
'accept_file_types' => '/\.('.$extenciones.')$/i',
'max_file_size' => $max_tamanio									
);
$upload_handler = new UploadHandler($options);
$files = $upload_handler->get_resultado_carga(1);
foreach ($files->files as $key => $value) {		
	if(!isset($value->error)){
		$tipo =  explode('.', $_FILES['files']['name'][0]);
		$cant=count($tipo);
		if($cant)
			$type=$tipo[($cant-1)];
		else{
			$type=$tipo[1];
		}				
		$nombre = (rand());
		if(rename($ruta_db_superior.$ruta.$_FILES['files']['name'][0],$ruta_db_superior.$ruta.$nombre.".".$type)){
			$sql="INSERT INTO anexos(fecha,funcionario_idfuncionario,documento_iddocumento,ruta,etiqueta,tipo,aleatorio) values(".fecha_db_almacenar(date('Y-m-d h:i:s'),"Y-m-d h:i:s").",".usuario_actual('idfuncionario').",".$_REQUEST['iddocumento'].",'".$ruta.$nombre.'.'.$type."','".$_FILES['files']['name'][0]."','".$type."','".$nombre."')";  					
  		phpmkr_query($sql);		
  		$idanexo=phpmkr_insert_id();			  		
		$sql_permiso="INSERT INTO permiso_anexo (anexos_idanexos, idpropietario, caracteristica_propio, caracteristica_dependencia, caracteristica_cargo, caracteristica_total) VALUE(".$idanexo.",'".usuario_actual("idfuncionario")."','lem','','','l')";
  		phpmkr_query($sql_permiso,$conn);
		}					
	}
}
?>
