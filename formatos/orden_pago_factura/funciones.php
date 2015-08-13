<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php")){
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");

/*POSTERIOR ADICIONAR-EDITAR*/
function ruta_orden_pago($idformato,$iddoc){
	global $conn;
	$ruta=array();
	$funcionario1=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc v","cargo like '%gestora%administrativa%' and estado_dc=1 and estado=1","",$conn);
	if($funcionario1['numcampos']){
	array_push($ruta,array("funcionario"=>$funcionario1[0]['funcionario_codigo'],"tipo_firma"=>1));
	}
	insertar_ruta($ruta,$iddoc,1);
}

/*MOSTRAR*/
function cargar_datos($idformato,$iddoc){
	global $conn,$datos;
	$datos=busca_filtro_tabla("dop.fecha_creacion,op.dependencia,rf.detalle_factura,drf.fecha_creacion as fecha_creacion_rf,rf.numero_factura,rf.valor_factura,rf.proveedor","ft_orden_pago_factura op,ft_radicacion_facturas rf,documento dop,documento drf","rf.idft_radicacion_facturas=op.ft_radicacion_facturas and rf.documento_iddocumento=drf.iddocumento and op.documento_iddocumento=dop.iddocumento and dop.iddocumento=".$iddoc,"",$conn);
}

function ver_fecha_solicitud($idformato,$iddoc){
	global $conn,$datos;
	$fecha = new DateTime($datos[0]['fecha_creacion']);
	echo ($fecha->format("Y-m-d"));
}

function ver_dependencia_creador($idformato,$iddoc){
	global $conn,$datos;
	$dep=busca_filtro_tabla("","vfuncionario_dc","iddependencia_cargo=".$datos[0]['dependencia'],"",$conn);
	echo ($dep[0]['dependencia']);
}

function ver_papa_detalle_factura($idformato,$iddoc){
	global $conn,$datos;
	echo ($datos[0]['detalle_factura']);
}

function ver_papa_fecha_factura($idformato,$iddoc){
	global $conn,$datos;
	$fecha = new DateTime($datos[0]['fecha_creacion_rf']);
	echo ($fecha->format("Y-m-d"));
}

function ver_papa_nro_factura($idformato,$iddoc){
	global $conn,$datos;
	echo ($datos[0]['numero_factura']);
}

function ver_papa_valor_factura($idformato,$iddoc){
	global $conn,$datos;
	echo ("$".number_format($datos[0]['valor_factura'],0,"","."));
}

function ver_papa_proveedor($idformato,$iddoc){
	global $conn,$datos;
	$prove=busca_filtro_tabla("","ejecutor e,datos_ejecutor de","e.idejecutor=de.ejecutor_idejecutor and de.iddatos_ejecutor=".$datos[0]['proveedor'],"",$conn);
	echo ($prove[0]['nombre']);
}

/*function ver_tipo_gasto($idformato,$iddoc){
global $conn,$datos;
$datos=busca_filtro_tabla("","ft_orden_pago_factura","documento_iddocumento=".$iddoc,"",$conn);
$tipo=busca_filtro_tabla("nombre","serie","idserie=".$datos[0]['tipo_gasto'],"",$conn);
echo $tipo[0][0];
}*/

?>
