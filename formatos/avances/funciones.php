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
	
function transferir_avance($idformato,$iddoc){
	global $conn;
	
	$papa=buscar_papa_formato($idformato,$iddoc,"ft_recordar_tarea");
	$destino=busca_filtro_tabla("ejecutor","documento","iddocumento=".$papa,"",$conn);
	
	//transferencia_automatica(208,$papa,$destino[0][0]."@",3);//Se comenta por indicacion de Camilo	
}
function tarea_origen($idformato,$iddoc){
	global $conn;
	
	$papa=buscar_papa_formato($idformato,$iddoc,"ft_recordar_tarea");
	
	$tarea_padre=busca_filtro_tabla("tarea_asiganda","ft_recordar_tarea","documento_iddocumento=".$papa,"",$conn);
	echo $tarea_padre[0]['tarea_asiganda'];
	//print_r($tarea_padre);
}	
function link_padre($idformato,$iddoc){
	global $conn;
	
	$papa=buscar_papa_formato($idformato,$iddoc,"ft_recordar_tarea");
	
	$texto="<a href='../../ordenar.php?accion=mostrar&tipo_destino=1&mostrar_formato=1&key=".$papa."' target='_blank'>Registro de la tarea</a>";
	
	echo ($texto);
}
function tarea_padre_funcion($idformato,$iddoc){
	global $conn;
	
	$papa=buscar_papa_formato($idformato,$iddoc,"ft_recordar_tarea");
	
	$tarea_padre=busca_filtro_tabla("tarea_asiganada","ft_recordar_tarea","documento_iddocumento=".$papa,"",$conn);
	$sql="update documento set descripcion='tarea asignada: ".$tarea_padre[0][0]."' where iddocumento=".$iddoc;
	phpmkr_query($sql);	
}
function validar_ingreso_funcion($idformato,$iddoc){
	global $conn;
	
	$usuario=usuario_actual("idfuncionario");
	$papa=$_REQUEST["anterior"];
	$band=0;
	$responsable=busca_filtro_tabla("responsable","ft_recordar_tarea","documento_iddocumento=".$papa,"",$conn);
	$res=explode(",",$responsable[0][0]);
	$tam=sizeof($res);
	$funcionario=busca_filtro_tabla("iddependencia_cargo","dependencia_cargo","funcionario_idfuncionario=".$usuario,"",$conn);
	for ($j=0;$j<$funcionario["numcampos"];$j++){ 
		for ($i=0;$i<$tam;$i++){				 
			if($funcionario[$j]["iddependencia_cargo"]==$res[$i]){
				$band=1;
			}
		}
	}
	if($band==0){
		alerta("No es el funcionario responsable de realizar el avance!");
		redirecciona("../../vacio.php");
	}	
}	
function tarea_ejecutada_funcion($idformato,$iddoc){
	global $conn;
	
	$papa=buscar_papa_formato($idformato,$iddoc,"ft_recordar_tarea");
	$estado_avance=busca_filtro_tabla("estado","ft_avances","documento_iddocumento=".$iddoc,"",$conn);
		if($estado_avance[0][0]=="Ejecutada"||$estado_avance[0][0]=="Cancelada"){
		$sql="update ft_recordar_tarea set ejecutado=1 where documento_iddocumento=".$papa;
	   	phpmkr_query($sql);
	}	
}
function paso_ejecutados($idformato,$iddoc){
	global $conn;
	
	$papa=buscar_papa_formato($idformato,$iddoc,"ft_recordar_tarea");
	$estado_avance=busca_filtro_tabla("estado","ft_avances","documento_iddocumento=".$iddoc,"",$conn);
	if($estado_avance[0][0]=="Ejecutada"||$estado_avance[0][0]=="Cancelada"){
		$sql="update documento set estado='HISTORICO' where iddocumento=".$papa;
		phpmkr_query($sql);
	}	
}	
?>