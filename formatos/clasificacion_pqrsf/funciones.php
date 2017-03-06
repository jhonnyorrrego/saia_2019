<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

/*POSTERIOR ADICIONAR*/
function transferir_clasificacion_pqrsf($idformato,$iddoc){
	transferir_desde_papa($idformato,$iddoc,'responsable',2,"Transferencia al Responsable Asignado");
	$estado_papa=intval(buscar_papa_formato_campo($idformato,$iddoc,"ft_pqrsf","estado_reporte"));
	if($estado_papa==1 || $estado_papa==""){
		$iddoc_papa=buscar_papa_formato_campo($idformato,$iddoc,"ft_pqrsf","documento_iddocumento");
		$update_estado="UPDATE ft_pqrsf SET estado_reporte=2,funcionario_reporte=".usuario_actual("idfuncionario").",fecha_reporte=".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s")." WHERE documento_iddocumento=".$iddoc_papa;//Cambio a Asignado
		phpmkr_query($update_estado);
	}
}

/*MOSTRAR*/
function ver_responsable($idformato,$iddoc,$tipo=NULL){
  $respon=busca_filtro_tabla("F.nombres, F.apellidos","funcionario F, dependencia_cargo DC, ft_clasificacion_pqrsf D","D.responsable=DC.iddependencia_cargo AND DC.funcionario_idfuncionario=F.idfuncionario AND D.documento_iddocumento=".$iddoc,"",$conn);
	$funcionario=codifica_encabezado(html_entity_decode($respon[0]['nombres']." ".$respon[0]['apellidos']));
	if($tipo==1){
		return($funcionario);
	}else{
		echo($funcionario);
	}
}
?>