<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; }
include_once($ruta_db_superior."db.php");

if(@$_REQUEST["tipo"]==1){
	$idpais=$_REQUEST["idpais"];
	$departamentos=busca_filtro_tabla("","departamento A","A.pais_idpais=".$idpais,"A.nombre asc",$conn);
	$texto="";
	$texto.="<option value=''>Seleccione...</option>";
	for($i=0;$i<$departamentos["numcampos"];$i++){
		$texto.="<option value='".$departamentos[$i]["iddepartamento"]."'>".$departamentos[$i]["nombre"]."</option>";
	}
	echo($texto);
}
if(@$_REQUEST["tipo"]==2){
	$iddepartamento=$_REQUEST["iddepartamento"];
	$municipios=busca_filtro_tabla("","municipio A","A.departamento_iddepartamento=".$iddepartamento,"A.nombre asc",$conn);
	$texto="";
	$texto.="<option value=''>Seleccione...</option>";
	for($i=0;$i<$municipios["numcampos"];$i++){
		$texto.="<option value='".$municipios[$i]["idmunicipio"]."'>".$municipios[$i]["nombre"]."</option>";
	}
	echo($texto);
}
?>