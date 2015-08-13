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

function mostrar_datos_cliente($idformato,$iddoc){
	global $conn;
	
	$datos=busca_filtro_tabla(fecha_db_obtener("A.fecha_ingreso_cliente","Y-m-d")." AS fecha_ingreso, A.observaciones_cliente, B.direccion, B.telefono, B.ciudad, C.nombre AS nombre_cliente, C.identificacion","ft_datos_cliente A, datos_ejecutor B, ejecutor C","A.datos_cliente=B.iddatos_ejecutor AND B.ejecutor_idejecutor=C.idejecutor AND A.documento_iddocumento=".$iddoc,"",$conn);
	$ciudad_cliente=busca_filtro_tabla("A.nombre AS municipio, B.nombre AS departamento","municipio A, departamento B","A.departamento_iddepartamento=B.iddepartamento AND A.idmunicipio=".$datos[0]['ciudad'],"",$conn);

	$tabla="";
	
	$tabla.="<table style=\"border-collapse: collapse; width: 100%;\" border=\"1\">";
	$tabla.="<tbody>";
	$tabla.="<tr>";
	$tabla.="<td class=\"encabezado_list\" colspan=\"2\">Datos del Cliente</td>";
	$tabla.="</tr>";
	$tabla.="<tr>";
	$tabla.="<td class=\"encabezado_list\" style=\"text-align: left;\">Fecha ingreso cliente</td>";
	$tabla.="<td>".fecha($datos[0]['fecha_ingreso'])."</td>";
	$tabla.="</tr>";
	$tabla.="<tr>";
	$tabla.="<td class=\"encabezado_list\" style=\"text-align: left;\">Nombre o raz&oacute;n social</td>";
	$tabla.="<td>".$datos[0]['nombre_cliente']."</td>";
	$tabla.="</tr>";
	$tabla.="<tr>";
	$tabla.="<td class=\"encabezado_list\" style=\"text-align: left;\">Identificaci&oacute;n</td>";
	$tabla.="<td>".$datos[0]['identificacion']."</td>";
	$tabla.="</tr>";
	$tabla.="<tr>";
	$tabla.="<td class=\"encabezado_list\" style=\"text-align: left;\">Direcci&oacute;n</td>";
	$tabla.="<td>".$datos[0]['direccion']."</td>";
	$tabla.="</tr>";
	$tabla.="<tr>";
	$tabla.="<td class=\"encabezado_list\" style=\"text-align: left;\">Tel&eacute;fono</td>";
	$tabla.="<td>".$datos[0]['telefono']."</td>";
	$tabla.="</tr>";
	$tabla.="<tr>";
	$tabla.="<td class=\"encabezado_list\" style=\"text-align: left;\">Ciudad</td>";
	if($ciudad_cliente!=""){		
		$tabla.="<td>".$ciudad_cliente[0]['municipio'].", ".$ciudad_cliente[0]['departamento']."</td>";
	}else{
		$tabla.="<td>&nbsp;</td>";
	}
	$tabla.="</tr>";
	if($datos[0]['observaciones_cliente']){	
		$tabla.="<tr>";
		$tabla.="<td class=\"encabezado_list\" style=\"text-align: center;\" colspan=\"2\">Observaciones</td>";
		$tabla.="</tr>";
		$tabla.="<tr>";	
		$tabla.="<td style=\"text-align: left;\" colspan=\"2\">".utf8_encode(html_entity_decode($datos[0]['observaciones_cliente']))."</td>";
		$tabla.="</tr>";
	}
	$tabla.="</tbody>";
	$tabla.="</table>";	
	
	echo($tabla);
}
?>