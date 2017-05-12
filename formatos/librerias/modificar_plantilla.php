<?php session_start();
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."class_transferencia.php");
guardar_documento($_REQUEST["iddoc"],1);

$datos_formato=busca_filtro_tabla("","formato","idformato=".$_REQUEST["formato"],"",$conn);
if($datos_formato[0]["mostrar_pdf"]==1){
	$sql1="update documento set pdf='' where iddocumento=".$_REQUEST["iddoc"];
	phpmkr_query($sql1);
	redirecciona($ruta_db_superior."pantallas/documento/visor_documento.php?iddoc=".$_REQUEST["iddoc"]);
}else if($datos_formato[0]["mostrar_pdf"]==2){
		redirecciona("../../pantallas/documento/visor_documento.php?pdf_word=1&iddoc=".$_REQUEST["iddoc"]);
	}
 // Recibe el parametro para editar una ruta
if(@$_REQUEST["adruta"]){
  echo "<script>window.location='rutaadd.php?x_plantilla=".@$_REQUEST["x_plantilla"]."&obligatorio=".$_REQUEST["obligatorio"]."&doc=".$_REQUEST["iddoc"]."&origen=".usuario_actual("funcionario_codigo")."&reset_ruta=1';</script>";
}

$tiene_ruta=busca_filtro_tabla("","ruta","lower(tipo)='activo' AND documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
if($tiene_ruta['numcampos']>1){
    $sql="DELETE FROM buzon_salida WHERE lower(nombre) IN('revisado','aprobado') AND archivo_idarchivo=".$_REQUEST["iddoc"];
    phpmkr_query($sql);
    $sql="DELETE FROM buzon_entrada WHERE lower(nombre) IN('revisado','aprobado') AND archivo_idarchivo=".$_REQUEST["iddoc"];
    phpmkr_query($sql);
    $sql="UPDATE buzon_entrada SET activo=1 WHERE lower(nombre)='por_aprobar' AND archivo_idarchivo=".$_REQUEST["iddoc"];
    phpmkr_query($sql);

}


echo "<script>window.location='".$ruta_db_superior . FORMATOS_CLIENTE . $datos_formato[0]["nombre"]."/mostrar_".$datos_formato[0]["nombre"].".php?iddoc=".$_REQUEST["iddoc"]."&tipo_destino=1';</script>";
?>
