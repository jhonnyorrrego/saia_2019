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
include_once $ruta_db_superior . 'core/autoload.php';
include_once($ruta_db_superior."pantallas/generador/file/librerias.php");

foreach($_FILES as $key => $valor){
	if($key!='')$nombre_campo=$key;
}
$ruta=ruta_archivos_pantalla();

crear_destino($ruta_db_superior.$ruta);
$ruta=vincular_anexo($nombre_campo,$ruta);

function vincular_anexo($nombre_campo,$ruta,$id=''){
	global $ruta_db_superior;
	$configuracion=busca_filtro_tabla("valor,nombre","configuracion","nombre LIKE 'extensiones_upload' OR nombre LIKE 'tamanio_maximo_upload'","",$conn);
	for($i=0;$i<$configuracion['numcampos'];$i++){
		switch ($configuracion[$i]['nombre']){
			case 'extensiones_upload':
					$extenciones = str_replace(',','|',$configuracion[$i]['valor']);
				break;
			case 'tamanio_maximo_upload':
					$max_tamanio = $configuracion[$i]['valor'];
			break;
		}
	}	
	$pantalla=@$_REQUEST["pantalla"];
$campos_pantalla=busca_filtro_tabla("a.idpantalla, b.idpantalla_campos","pantalla a, pantalla_campos b","a.nombre='".$pantalla."' and a.idpantalla=b.pantalla_idpantalla and b.nombre='".$nombre_campo."'","",$conn);

	$tipo=explode('.', $_FILES[$nombre_campo]['name'][0]);
	$tamano=$_FILES[$nombre_campo]['size'][0];
	$cant=count($tipo);
	if($cant)
		$type=$tipo[($cant-1)];
	else{
		$type=$tipo[1];
	}
	$extensiones_permitidas=explode("|",$extenciones);
	
	if(!in_array($type,$extensiones_permitidas))return false;
	if($tamano>$max_tamanio)return false;
	
	$nombre=(rand());
	
	if(rename($_FILES[$nombre_campo]['tmp_name'][0],$ruta_db_superior.$ruta.$nombre.".".$type)){
		chmod($ruta_db_superior.$ruta.$nombre.".".$type,PERMISOS_ARCHIVOS);
		$sql="INSERT INTO anexos_temp_pantalla(idsesion,ruta,etiqueta,tipo,pantalla_idpantalla, fk_idpantalla_campos) values('".session_id()."','".$ruta.$nombre.'.'.$type."','".$_FILES[$nombre_campo]['name'][0]."','".$type."', ".$campos_pantalla[0]["idpantalla"].", ".$campos_pantalla[0]["idpantalla_campos"].")";
		phpmkr_query($sql);
		$idanexo=phpmkr_insert_id();
	}
}
?>
