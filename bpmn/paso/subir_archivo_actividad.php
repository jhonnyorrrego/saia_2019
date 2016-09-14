<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if(is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "pantallas/anexos/librerias_anexos.php");
include_once ($ruta_db_superior . "libreria_paso.php");
include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");

error_reporting(E_ALL | E_STRICT);
$tipo = explode('/', $_FILES['files']['type'][0]);
if(@$_REQUEST["iddocumento"] && @$_REQUEST["idpaso_documento"] && @$_REQUEST["idactividad"]) {
	//$estado_documento = busca_filtro_tabla("estado", "documento", "iddocumento=" . $_REQUEST['iddocumento'], "", $conn);
	// TODO: Validar la ruta de almacenamiento para centralizarla
	
	$formato_ruta = aplicar_plantilla_ruta_documento($_REQUEST['iddocumento']);
	$ruta_archivos = ruta_almacenamiento("archivos");
	$ruta = $ruta_archivos . $formato_ruta . '/anexos_actividades/';
	
	//$ruta = RUTA_ARCHIVOS . $estado_documento[0]['estado'] . '/' . date('Y-m') . '/' . $_REQUEST['iddocumento'] . '/anexos_actividades/';
	$configuracion = busca_filtro_tabla("valor,nombre", "configuracion", "nombre LIKE 'extensiones_upload' OR nombre LIKE 'tamanio_maximo_upload'", "", $conn);
	$extenciones = 'png,jpg,peg';
	for($i = 0; $i < $configuracion['numcampos']; $i++) {
		switch($configuracion[$i]['nombre']) {
			case 'extensiones_upload':
				$extenciones = str_replace(',', '|', $configuracion[$i]['valor']);
				break;
			case 'tamanio_maximo_upload':
				$max_tamanio = $configuracion[$i]['valor'];
				break;
		}
	}
	$options = array(
			'upload_dir' => $ruta,
			'upload_url' => $ruta,
			'accept_file_types' => '/\.(' . $extenciones . ')$/i',
			'max_file_size' => $max_tamanio
	);
	crear_destino($ruta);
	$upload_handler = new UploadHandler($options);
	$files = $upload_handler->get_resultado_carga(1);
	foreach($files->files as $key => $value) {
		if(!isset($value->error)) {
			$tipo = explode('.', $_FILES['files']['name'][0]);
			$cant = count($tipo);
			if($cant)
				$type = $tipo[($cant - 1)];
			else {
				$type = $tipo[1];
			}
			$nombre = (rand());
			$verifica = busca_filtro_tabla("", "paso_actividad_anexo", "actividad_idactividad=" . $_REQUEST["idactividad"] . " AND documento_iddocumento=" . $_REQUEST["iddocumento"] . " AND etiqueta='" . $_FILES['files']['name'][0] . "'", "", $conn);
			if(!$verifica["numcampos"] && rename($ruta . $_FILES['files']['name'][0], $ruta . $nombre . "." . $type)) {
				//Quitar el prefijo de ruta_db_superior para guardar en bdd
				$ruta_alm = substr($ruta, strlen($ruta_db_superior));
				$sql2 = "INSERT INTO paso_actividad_anexo (actividad_idactividad,documento_iddocumento,etiqueta,ruta,tipo) values(" . $_REQUEST["idactividad"] . "," . $_REQUEST['iddocumento'] . ",'" . $_FILES['files']['name'][0] . "','" . $ruta_alm . $nombre . '.' . $type . "','" . $type . "')";
				phpmkr_query($sql2);
				$idanexo = phpmkr_insert_id();
			}
		}
	}
}
?>