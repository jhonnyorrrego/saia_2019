<?phpif(@$_REQUEST["iddoc"] || @$_REQUEST["key"]){	include_once("formatos/librerias/menu_principal_documento.php");	echo(menu_principal_documento($_REQUEST["iddoc"],@$_REQUEST["vista"]));}
include_once("db.php");include_once("formatos/librerias/funciones_generales.php");
$dato=busca_filtro_tabla("a.diagram_iddiagram_instance,a.idpaso_documento","paso_documento a, documento b, diagram e, diagram_instance d","a.documento_iddocumento=b.iddocumento AND a.diagram_iddiagram_instance=d.iddiagram_instance AND d.diagram_iddiagram=e.id AND b.iddocumento=".$_REQUEST["key"],"GROUP BY a.diagram_iddiagram_instance,a.idpaso_documento",$conn);
if($dato["numcampos"]>0){
  abrir_url("workflow/mapeo_diagrama.php?idpaso_documento=".$dato[0]["idpaso_documento"],"_self");  
}else{	echo "No pertenece a ningun flujo";}$formato = busca_filtro_tabla("","documento A, formato B","lower(A.plantilla)=lower(B.nombre) AND iddocumento=".$_REQUEST["key"]." and cod_padre<>0","",$conn);if($formato["numcampos"] > 0){	$iddocpapa = buscar_papa_primero($_REQUEST["key"]);	$dato=busca_filtro_tabla("a.diagram_iddiagram_instance, a.idpaso_documento","paso_documento a, documento b, diagram e, diagram_instance d","a.documento_iddocumento=b.iddocumento AND a.diagram_iddiagram_instance=d.iddiagram_instance AND d.diagram_iddiagram=e.id AND b.iddocumento=".$iddocpapa,"GROUP BY a.diagram_iddiagram_instance,a.idpaso_documento",$conn);	if($dato["numcampos"]==1){	  $iddocpapa = buscar_papa_primero($_REQUEST["key"]);	  abrir_url("workflow/mapeo_diagrama.php?idpaso_documento=".$dato[0]["idpaso_documento"],"centro");  	}}
$idbusqueda=97;
$datos=busca_filtro_tabla("","busquedas","idbusquedas=".$idbusqueda,"",$conn);
$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=".$idbusqueda,"orden",$conn);
if($funciones<>"")
  {for($i=0; $i<$funciones["numcampos"]; $i++)
      {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
      }
   $id_func=implode(",",$id_func);
  }

if($datos["numcampos"])
  {
  if(@$_REQUEST["key"])
    $datos[0]["codigo"]=str_replace("/*codigo_adicional*/"," AND b.iddocumento=".$_REQUEST["key"],$datos[0]["codigo"]);
  else if($_REQUEST["doc"])
    $datos[0]["codigo"]=str_replace("/*codigo_adicional*/"," AND b.iddocumento=".$_REQUEST["iddoc"],$datos[0]["codigo"]);
    //die($datos[0]["codigo"]);
?>
<form name=form1 action="buscador/index.php" method="post">
<input type="hidden" name="busqueda" value="busqueda">
<input type="hidden" name="func_busqueda" value="<?php echo $id_func; ?>">
<input type="hidden" name="llave" value="<?php echo $datos[0]["llave"]; ?>">
<input type="hidden" name="registros" value="10">
<input type="hidden" name="tablas" value="tablas">
<input type="hidden" name="tabla" value="diagram">
<input type="hidden" name="grafico" value="<?php echo $datos[0]["grafico"]; ?>">
<input type="hidden" name="subtitulo" value="<?php echo $datos[0]["subtitulo"]; ?>">
<input type="hidden" name="totales" value="<?php echo $datos[0]["totales"]; ?>">
<input type="hidden" name="sql" value="<?php echo $datos[0]["codigo"]; ?>">
<input type="image" src="<?php echo "/".RUTA_SCRIPT."/imagenes/cargando.gif"; ?>">
</form>  
<script>
form1.submit();
</script>
<?php  
  }
?>
