<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once($ruta_db_superior."pantallas/anexos/librerias_anexos.php");
include_once($ruta_db_superior."StorageUtils.php");
include_once($ruta_db_superior.'filesystem/SaiaStorage.php');

if(@$_REQUEST['idtareas_listado_anexos']){
	
	$anexo=busca_filtro_tabla('','tareas_listado_anexos a, tareas_listado b ','b.idtareas_listado=a.fk_tareas_listado	 AND a.idtareas_listado_anexos='.@$_REQUEST['idtareas_listado_anexos'],'',$conn);
	$ruta_eliminados="anexos_tareas/".$anexo[0]['listado_tareas_fk']."/".$anexo[0]['idtareas_listado']."/";

	$variable=StorageUtils::get_memory_filesystem('tareas','saia');
	$variable->write('tareas_avanzadas/eliminar/helloworld.txt','helloworld'); //se usa para crear directorio temporal
	$ruta_temporal='saia://tareas/tareas_avanzadas/eliminar/';	
	
	$cadena_sql_insert="INSERT INTO tareas_listado_anexos
 (etiqueta,ruta,tipo,fk_tareas_listado) values('".$anexo[0]['etiqueta']."','".$anexo[0]['ruta']."','".$anexo[0]['tipo']."','".$anexo[0]['idtareas_listado']."')";

 	$archivo_txt = fopen($ruta_temporal."sql_anexos_tareas_".$anexo[0]['idtareas_listado'].".txt","w");	
	fwrite($archivo_txt, $cadena_sql_insert);
	fclose($archivo_txt);	

	$tipo_almacenamiento = new SaiaStorage(RUTA_BACKUP_ELIMINADOS);
	$resultado=$tipo_almacenamiento->copiar_contenido_externo($ruta_temporal."sql_anexos_tareas_".$anexo[0]['idtareas_listado'].".txt", $ruta_eliminados."sql_anexos_tareas_".$anexo[0]['idtareas_listado'].".txt");
	$arr_almacen = StorageUtils::resolver_ruta($anexo[0]["ruta"]);
	$nombre_anexo=basename($arr_almacen["ruta"]);
	$resultado=$arr_almacen['clase']->copiar_contenido($tipo_almacenamiento, $arr_almacen["ruta"], $ruta_eliminados.$nombre_anexo);
	$arr_almacen['clase']->get_filesystem()->delete($arr_almacen["ruta"]);

	$sql="DELETE FROM tareas_listado_anexos WHERE idtareas_listado_anexos=".@$_REQUEST['idtareas_listado_anexos'];
	phpmkr_query($sql);
}



?>
