<?php
include_once("db.php");
//SCRIPT LIMPIA LA BANDEJA DE GESTION O ENVIADOS SEGUN LA FECHA DE LA CONSULTA DE $documentos
$radicador=busca_filtro_tabla("funcionario_codigo","funcionario,configuracion","configuracion.nombre='radicador_salida' and configuracion.valor=funcionario.login","",$conn);

$documentos=busca_filtro_tabla("a.iddocumento,a.fecha,a.estado,a.descripcion,a.plantilla,a.numero,a.serie,a.tipo_ejecutor,a.iddocumento","documento a,buzon_salida z","(lower(a.estado)<>'eliminado'  ) and (date_format(a.fecha,'%y-%m-%d') <= date_format('2014-03-31','%y-%m-%d')) AND iddocumento=z.archivo_idarchivo AND a.estado='GESTION'","",$conn);

print_r($documentos);
die();

for($i=0;$i<$documentos['numcampos'];$i++){
		$sql="UPDATE documento SET estado='".strtoupper($tipo)."' WHERE iddocumento=".$dias[$i]["iddocumento"];
		
		//echo "***************** ".$sql;
//		phpmkr_query($sql,$conn);
		$datos["archivo_idarchivo"]=$documentos[$i]["iddocumento"];
		$datos["origen"]=$radicador[0][0];
		$destino[0]=$radicador[0][0];
		transferir_archivo_prueba($datos,$destino,'');
}
?>