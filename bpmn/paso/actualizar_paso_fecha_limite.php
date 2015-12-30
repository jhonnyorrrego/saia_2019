<?php 
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; }
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."workflow/libreria_paso.php");
$retorno=array();
$retorno["exito"]=0;
if(@$_REQUEST["idpaso_documento"] && @$_REQUEST["fecha_limite"]){
	$sql1="UPDATE paso_documento SET fecha_limite=".fecha_db_almacenar($_REQUEST["fecha_limite"],"Y-m-d H:i:s")." WHERE idpaso_documento=".$_REQUEST["idpaso_documento"];
	phpmkr_query($sql1);
	if($conn->Conn->conn->affected_rows==1){
	  $estado=estado_paso_documento($_REQUEST["idpaso_documento"]);
    $retorno["estado"]=imprimir_estado_paso_documento($estado[0]["estado_paso_documento"]);
		$retorno["exito"]=1;
		$retorno["sql"]=$sql1;
	}
}
echo(json_encode($retorno));
?>