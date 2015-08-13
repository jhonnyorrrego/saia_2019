<?php
include_once("../../db.php");
 
$numero=$_REQUEST["numero"];
$id= $_REQUEST["id_padre"];
if($_REQUEST["iddoc"]>0)
$documento=$_REQUEST["iddoc"];
}elseif($_REQUEST["documento"]>0){
$documento=$_REQUEST["documento"];
}

$consulta=busca_filtro_tabla("","ft_acta_evaluacion","documento_iddocumento=".$documento,"",$conn);
$empresas=busca_filtro_tabla("","ft_empresas","ft_evaluacion=".$consulta[0]["idft_evaluacion"],"",$conn);
if($empresas["numcampos"]){
echo(0);
}else{
echo(1);
}
?>

