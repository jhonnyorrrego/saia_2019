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


if(@$_REQUEST['idtareas_listado_anexos']){
	
	$anexo=busca_filtro_tabla('','tareas_listado_anexos a, tareas_listado b ','b.idtareas_listado=a.fk_tareas_listado	 AND a.idtareas_listado_anexos='.@$_REQUEST['idtareas_listado_anexos'],'',$conn);

	$ruta_eliminados=$ruta_db_superior.RUTA_BACKUP_ELIMINADOS."anexos_tareas/".$anexo[0]['listado_tareas_fk']."/".$anexo[0]['idtareas_listado']."/";
	crear_destino($ruta_eliminados);
	chmod($ruta_eliminados,0777);
	
	$cadena_sql_insert="INSERT INTO tareas_listado_anexos
 (etiqueta,ruta,tipo,fk_tareas_listado) values('".$anexo[0]['etiqueta']."','".$anexo[0]['ruta']."','".$anexo[0]['tipo']."','".$anexo[0]['idtareas_listado']."')";
 
 
 	$archivo_txt = fopen($ruta_eliminados."sql_anexos_tareas_".$anexo[0]['idtareas_listado'].".txt","w");	
	fwrite($archivo_txt, $cadena_sql_insert);
	fclose($archivo_txt);	
	chmod($ruta_eliminados."sql_anexos_tareas_".@$_REQUEST['idtareas_listado_anexos'].".txt",0777);
	
	
	$nombre_anexo=basename($ruta_db_superior.$anexo[0]['ruta']);
	copy($ruta_db_superior.$anexo[0]['ruta'], $ruta_eliminados.$nombre_anexo);
	chmod($ruta_eliminados.$nombre_anexo,0777);
	unlink($ruta_db_superior.$anexo[0]['ruta']);


	$sql="DELETE FROM tareas_listado_anexos WHERE idtareas_listado_anexos=".@$_REQUEST['idtareas_listado_anexos'];
	phpmkr_query($sql);
}



?>