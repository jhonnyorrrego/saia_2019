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

function mostrar_documento($iddocumento){
	global $conn;
	$numero=busca_filtro_tabla("numero","documento","iddocumento=".$iddocumento,"",$conn);
	if($numero[0][0]!=0 || $numero[0][0]!='numero'){
		return('<div class="link kenlace_saia" enlace="ordenar.php?key='.$iddocumento.'&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="Documento No.'.$numero[0][0].'"><center><span class="badge">'.$numero[0][0].'</span></center></div>');
	}else{
		return('<div class="link kenlace_saia" enlace="ordenar.php?key='.$iddocumento.'&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="Documento No.0"><center><span class="badge">0</span></center></div>');
	}
}
function mostrar_nombre($iddatos_ejecutor){
 	global $conn;

 	$nombre_cliente=busca_filtro_tabla("A.nombre","ejecutor A, datos_ejecutor B","B.ejecutor_idejecutor=A.idejecutor AND B.iddatos_ejecutor=".$iddatos_ejecutor,"",$conn);
	
	return($nombre_cliente[0][0]);
}

function mostrar_nit($iddatos_ejecutor){
 	global $conn;

 	$nombre_cliente=busca_filtro_tabla("A.identificacion","ejecutor A, datos_ejecutor B","B.ejecutor_idejecutor=A.idejecutor AND B.iddatos_ejecutor=".$iddatos_ejecutor,"",$conn);
	
	return($nombre_cliente[0][0]);
}
function mostrar_estado($estado){
	switch($estado){
		case 0:
			$estado_cliente="Contacto";
			break;
		case 1:
			$estado_cliente="Potencial";
			break;
		case 2:
			$estado_cliente="Cliente";
			break;
	}
	return($estado_cliente);
}
function mostrar_sector($sector){
	global $conn;
	$nombre_sector=busca_filtro_tabla("nombre","serie","idserie=".$sector,"",$conn);
	return($nombre_sector[0][0]);
}
function mostrar_direccion($iddatos_ejecutor){
	global $conn;
	$direccion=busca_filtro_tabla("direccion","datos_ejecutor","iddatos_ejecutor=".$iddatos_ejecutor,"",$conn);
	return($direccion[0][0]);
}
function mostrar_pais($iddatos_ejecutor){
		global $conn;
		$idmunicipio=busca_filtro_tabla("ciudad","datos_ejecutor","iddatos_ejecutor=".$iddatos_ejecutor,"",$conn);
	$pais=busca_filtro_tabla("C.nombre","departamento A, municipio B, pais C","A.iddepartamento=B.departamento_iddepartamento AND A.pais_idpais=C.idpais AND B.idmunicipio=".$idmunicipio[0][0],"",$conn);
	return($pais[0][0]);
}
function mostrar_departamento($iddatos_ejecutor){
	global $conn;
	$idmunicipio=busca_filtro_tabla("ciudad","datos_ejecutor","iddatos_ejecutor=".$iddatos_ejecutor,"",$conn);
	$departamento=busca_filtro_tabla("A.nombre","departamento A, municipio B","A.iddepartamento=B.departamento_iddepartamento AND B.idmunicipio=".$idmunicipio[0][0],"",$conn);
	return($departamento[0][0]);
}
function mostrar_municipio($iddatos_ejecutor){
	global $conn;
	$idmunicipio=busca_filtro_tabla("ciudad","datos_ejecutor","iddatos_ejecutor=".$iddatos_ejecutor,"",$conn);
	$ciudad=busca_filtro_tabla("nombre","municipio","idmunicipio=".$idmunicipio[0][0],"",$conn);
	return($ciudad[0][0]);
}
?>