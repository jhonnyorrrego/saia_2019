<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."workflow/libreria_paso.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."class_transferencia.php");

if($_REQUEST["docs"]&&$_REQUEST["accion"])
{$valores=substr($_REQUEST["docs"],0,-1);
 if($_REQUEST["accion"]=="causacion")
  $sql="update ft_recibo_caja_menor set fecha_".$_REQUEST["accion"]."=".fecha_db_almacenar("","Y-m-d H:i:s").",usuario_causante='".usuario_actual("nombres")." ".usuario_actual("apellidos")."' where documento_iddocumento in($valores)";
 else if($_REQUEST["accion"]=="reembolso"){
 	$sql="update ft_recibo_caja_menor set fecha_".$_REQUEST["accion"]."=".fecha_db_almacenar("","Y-m-d H:i:s").",usuario_".$_REQUEST["accion"]."='".usuario_actual("nombres")." ".usuario_actual("apellidos")."', descripcion_reembolso='".$_REQUEST["descripcion_reembolso"]."' where documento_iddocumento in($valores)";
 }
 else{
  $sql="update ft_recibo_caja_menor set fecha_".$_REQUEST["accion"]."=".fecha_db_almacenar("","Y-m-d H:i:s").",usuario_".$_REQUEST["accion"]."='".usuario_actual("nombres")." ".usuario_actual("apellidos")."' where documento_iddocumento in($valores)";
 }

 phpmkr_query($sql);
 //alerta(codifica_encabezado("Se ha registrado la causaci�n."));
 //--------------Terminar flujo------------------------
 $actividad = Null;
 $actividad_next = Null;
 if($_REQUEST["accion"]=="causacion"){
 	$actividad = 25;
 	$actividad_next = 43;
 }
 else if($_REQUEST["accion"]=="remision"){
 	$actividad = 24;
 	$actividad_next = 25;
 }
 else if($_REQUEST["accion"]=="reembolso"){
 	$actividad = 43;
	$actividad_next = 26;
 }
 if(strpos($_REQUEST["docs"],",")){
 	$documentos = explode(",",$_REQUEST["docs"]);
 }
 else {
     $documentos[0] = $_REQUEST["docs"];
 }
 $cantidad = count($documentos);
 for($i=0;$i<$cantidad;$i++){
 	if($documentos[$i] != ''){
 		$doc = busca_filtro_tabla("a.documento_iddocumento as doc","ft_solicitud_gastos_caja_menor a,ft_recibo_caja_menor b","b.documento_iddocumento=".$documentos[$i]." and ft_solicitud_gastos_caja_menor=idft_solicitud_gastos_caja_menor","",$conn);
 		$iddoc = $doc[0]["doc"];
	 	$paso = busca_filtro_tabla("","paso_documento","documento_iddocumento=".$iddoc,"idpaso_documento desc",$conn);
	 	terminar_actividad_paso($iddoc,'',2,$paso[0]["idpaso_documento"],$actividad);
		$formato = busca_filtro_tabla("","formato","nombre like '%solicitud_gastos_caja_menor%'","",$conn);
		$actividad = busca_filtro_tabla("","paso_actividad","idpaso_actividad=".$actividad_next,"",$conn);
		$datos = buscar_entidad_asignada($actividad[0]["entidad_identidad"],$actividad[0]["llave_entidad"]);
		
		if(@$datos["id"] != 0){
			if($actividad[0]["entidad_identidad"] == 1 && $actividad_next != ''){
				transferencia_automatica($formato[0]["idformato"],$iddoc,$actividad[0]["llave_entidad"].'@',3);
				
			}
			else if($actividad[0]["entidad_identidad"] == 2 && $actividad_next != ''){
				$destinos = explode(",",$actividad[0]["llave_entidad"]);
				$cantidad = count($destinos);
				for($i=0;$i<$cantidad;$i++){
					$funcionario = buscar_funcionario_dependencia($destinos[$i]);
					$destinos = implode("@",$funcionario);
					transferencia_automatica($formato[0]["idformato"],$iddoc,$destinos,3);
				}
			}
		}
	}
 }
 redirecciona("reciboslist.php?tipo=".$_REQUEST["tipo"]);
}
function buscar_funcionario_dependencia($iddepen){
	global $conn;
	$hoy = date('Y-m-d H:i:s');
	$consutla = busca_filtro_tabla("distinct(a.funcionario_idfuncionario),b.funcionario_codigo","dependencia_cargo a,funcionario b, dependencia c","c.iddependencia=".$iddepen." AND c.estado=1 AND c.iddependencia=a.dependencia_iddependencia AND a.estado=1 AND funcionario_idfuncionario=idfuncionario AND b.estado=1 AND a.fecha_final>".fecha_db_almacenar($hoy,'Y-m-d H:i:s'),"",$conn);
	$funcionario = array();
	for($i=0;$i<$consutla["numcampos"];$i++){
		array_push($funcionario,$consutla[$i]["funcionario_codigo"]);
	}
	return $funcionario;
}
?>