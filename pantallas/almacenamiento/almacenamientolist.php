<?php
include_once("../../db.php");
$idbusqueda=115;
$datos=busca_filtro_tabla("","busquedas","idbusquedas=".$idbusqueda,"",$conn);
$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=".$idbusqueda,"orden asc",$conn);

if($funciones<>""){
	for($i=0; $i<$funciones["numcampos"]; $i++){
		$id_func[]=$funciones[$i]["idfunciones_busqueda"];
	}
   	$id_func=implode(",",$id_func);
}
if(@$_REQUEST["filtrar"]){
	$where='';
	if(@$_REQUEST["caja_idcaja"]){
		$where.=" and a.caja_idcaja='".$_REQUEST["caja_idcaja"]."' ";
	}
	if(@$_REQUEST["numero_orden"]){
		$where.=" and a.numero_orden like '%".$_REQUEST["numero_orden"]."%' ";
	}
	if(@$_REQUEST["nombre_expediente"]){
		$where.=" and a.nombre_expediente like '%".$_REQUEST["nombre_expediente"]."%' ";
	}
	if(@$_REQUEST["no_tomo"]){
		$where.=" and a.no_tomo like '%".$_REQUEST["no_tomo"]."%' ";
	}
	if(@$_REQUEST["codigo_numero"]){
		$where.=" and a.codigo_numero like '%".$_REQUEST["codigo_numero"]."%' ";
	}
	if(@$_REQUEST["fondo"]){
		$where.=" and a.fondo like '%".$_REQUEST["fondo"]."%' ";
	}
	$datos[0]["codigo"]=str_replace("/*filtro*/",$where,$datos[0]["codigo"]);
	//die($datos[0]["codigo"]);
}

if($datos["numcampos"]){
?>
<form name=form1 action="../../buscador/index.php" method="post">
<input type="hidden" name="busqueda" value="busqueda">
<input type="hidden" name="func_busqueda" value="<?php echo $id_func; ?>">
<input type="hidden" name="llave" value="<?php echo $datos[0]["llave"]; ?>">
<input type="hidden" name="orden" value="<?php echo $datos[0]["orden"]; ?>">
<input type="hidden" name="ordenar" value="<?php echo $datos[0]["ordenado"]; ?>">
<input type="hidden" name="registros" value="10">
<input type="hidden" name="tablas" value="almacenamiento">
<input type="hidden" name="tabla" value="almacenamiento">
<input type="hidden" name="grafico" value="<?php echo $datos[0]["grafico"]; ?>">
<input type="hidden" name="subtitulo" value="<?php echo $datos[0]["subtitulo"]; ?>">
<input type="hidden" name="totales" value="<?php echo $datos[0]["totales"]; ?>">
<input type="hidden" name="sql" value="<?php echo $datos[0]["codigo"]; ?>">
</form>  
<script>
form1.submit();
</script>
<?php  
}
?>