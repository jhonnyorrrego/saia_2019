<?php
include_once("db.php");
$idmodulo=$_REQUEST["idmodulo"];
$ayuda=busca_filtro_tabla("","modulo","idmodulo=".$idmodulo,"",$conn);
if($ayuda[0]["ayuda"]!=''){
	echo "<span style='font-size:10pt'>".$ayuda[0]["ayuda"]."<br><br></span><span style='font-size:7pt;color:red'>Clic para cerrar</span>";
}
else{
	echo "<span style='font-size:10pt;'>No hay registros de ayuda<br><br></span><span style='font-size:7pt;color:red'>Clic para cerrar</span>";
}
?>