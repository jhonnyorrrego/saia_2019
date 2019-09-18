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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
function parsear_fecha_reserva1($fecha){
	$datos_fecha=date_parse($fecha);
	$cadena=$datos_fecha["day"]." de ".mes($datos_fecha["month"])." del ".$datos_fecha["year"];
	return($cadena);
}
function parsear_fecha_reserva2($fecha){
	$datos_fecha=date_parse($fecha);
	$cadena=$datos_fecha["day"]." de ".mes($datos_fecha["month"])." del ".$datos_fecha["year"];
	return($cadena);
}
function parsear_fecha_reserva3($fecha){
	$datos_fecha=date_parse($fecha);
	$cadena=$datos_fecha["day"]." de ".mes($datos_fecha["month"])." del ".$datos_fecha["year"];
	return($cadena);
}
function nombre_solicitante($ejecutor){
	
	$nombres=busca_filtro_tabla("A.nombres, A.apellidos","funcionario A","A.funcionario_codigo=".$ejecutor,"");
	$cadena=ucwords(strtolower($nombres[0]["nombres"]." ".$nombres[0]["apellidos"]));
	return($cadena);
}
function enlace_documento_reservar($doc){
	
	$numero=busca_filtro_tabla("A.numero","documento A, formato B","A.iddocumento=".$doc." AND lower(A.plantilla)=lower(B.nombre)","");
	$cadena='<span class="link kenlace_saia" title="Radicado No '.$numero[0]["numero"].'" titulo="Radicado No '.$numero[0]["numero"].'" conector="iframe" enlace="ordenar.php?mostrar_formato=1&key='.$doc.'" style="color:#0088CC">Ver documento '.$numero[0]["numero"].'</span>';
	return($cadena);
}
function accion_entrega($iddocumento,$funcionario,$fecha,$observacion,$estado_doc){
	
	if(($funcionario=='usuario_entrega' || !$funcionario)&&$estado_doc==1){
		$texto='<input type="checkbox" class="_entregar" name="" value="'.$iddocumento.'">';
	}
	else if($funcionario && $funcionario!='usuario_entrega'){
		$usuario=busca_filtro_tabla("","funcionario A","A.idfuncionario=".$funcionario,"");
		$cadena=ucwords(strtolower($usuario[0]["nombres"]." ".$usuario[0]["apellidos"]));
		$cadena.="<br />".parsear_fecha_reserva1($fecha);
		$cadena.="<br />".$observacion;
		$texto=$cadena;
	}
	return($texto);
}
function accion_devuelto($iddocumento,$funcionario,$fecha,$observacion,$estado_doc){
	
	if(($funcionario=='usuario_devolver' || !$funcionario)&&$estado_doc==2){
		$texto='<input type="checkbox" class="_devolver" name="" value="'.$iddocumento.'">';
	}
	else if($funcionario && $funcionario!='usuario_devolver'){
		$usuario=busca_filtro_tabla("","funcionario A","A.idfuncionario=".$funcionario,"");
		$cadena=ucwords(strtolower($usuario[0]["nombres"]." ".$usuario[0]["apellidos"]));
		$cadena.="<br />".parsear_fecha_reserva1($fecha);
		$cadena.="<br />".$observacion;
		$texto=$cadena;
	}
	return($texto);
}
function tiempo_transcurrido_reserva($fecha_entrega,$fecha_devolver){
	if($fecha_entrega!='fecha_entrega' && $fecha_entrega){
		$datos_fecha_entrega=date_parse($fecha_entrega);
		$fechai=$datos_fecha_entrega["year"]."-".$datos_fecha_entrega["month"]."-".$datos_fecha_entrega["day"];
	}
	if($fecha_devolver!='fecha_devolver' && $fecha_devolver){
		$datos_fecha_devolver=date_parse($fecha_devolver);
		$fechaf=$datos_fecha_devolver["year"]."-".$datos_fecha_devolver["month"]."-".$datos_fecha_devolver["day"];
	}
	else{
		$fechaf=date('Y-m-d');
	}
	if($fechai && $fechaf){
		$dias=resta_fechasphp($fechaf,$fechai);
		return($dias." dia(s)");
	}
	else{
		return('');
	}
}
if(@$_REQUEST["ejecutar_accion"])$_REQUEST["ejecutar_accion"]();
?>