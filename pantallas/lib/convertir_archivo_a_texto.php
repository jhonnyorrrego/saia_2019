<?php
$retorno=array("exito"=>0);
if(@$_REQUEST["ruta"]){
	if(@$_REQUEST["accion"]=="cargar"){
		$retorno["exito"]=1;
		$retorno["codigo_html"]=file_get_contents(trim($_REQUEST["ruta"]));		
	}
	else if(@$_REQUEST["accion"]=="guardar"){
		if(@$_REQUEST["codigo_html"]){      
			if(file_put_contents($_REQUEST["ruta"], $_REQUEST["codigo_html"])){
				$retorno["exito"]=1;
        $retorno["codigo_html"]=$_REQUEST["codigo_html"];
			}
		}
	}
}	
echo(json_encode($retorno));
?>