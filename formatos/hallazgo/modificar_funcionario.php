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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."class_transferencia.php");

if($_REQUEST["actualizar_funcionario"]){
	$update_funcionario_hallago = "update ft_hallazgo set ".$_REQUEST["campo"]."='".$_REQUEST['actualizar_funcionario']."' where documento_iddocumento=".$_REQUEST['iddocumento'];
	phpmkr_query($update_funcionario_hallago);
	
	$destino_transferencia = busca_filtro_tabla("nombres, apellidos, funcionario_codigo","vfuncionario_dc","lower(cargo) like'profesional%universitario%grado%22' and lower(dependencia) like'direcci%control%interno' and estado=1 and estado_dc=1 and estado_dep=1","",$conn);	
			
	$funcionario = explode(',', $_REQUEST['actualizar_funcionario']);
	
	foreach ($funcionario as $value){
		transferencia_automatica($_REQUEST['idformato'],$_REQUEST['iddocumento'],$value.'@',3);
	}
			
	transferencia_automatica($_REQUEST['idformato'],$_REQUEST['iddocumento'],$destino_transferencia[0]["funcionario_codigo"].'@',3,"Se ha realizado modificaci&oacute;n en el responsable del mejoramiento o seguimiento del plan");
}
echo(1);
