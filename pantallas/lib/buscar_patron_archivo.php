<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
if(@$_REQUEST["ruta_archivo"]!='' &&@$_REQUEST["patron"]){
  busca_patron_archivo($_REQUEST["ruta_archivo"],$_REQUEST["patron"],@$_REQUEST["tipo_retorno"]);
}
function buscar_patron_archivo($archivo,$pat,$tipo_retorno){
global $ruta_db_superior;
$retorno=array("exito"=>0,"resultado"=>"Error al parsear el patron ".$pat);
if($archivo!=''&& $pat!=''){	
	$cadena=file_get_contents($ruta_db_superior.$archivo);
	if($cadena!=''&&$pat){
		$patron = '/'.$pat.'\s*.*\(.*\s*\)/';		
		if(preg_match_all($patron, $cadena, $resultado)){
			$retorno["exito"]=1;
			$retorno["resultado"]=$resultado[0];
		}
    else{
      $retorno["exito"]=0;
      $retorno["resultado"]="No se encuentra el texto ".$pat." en el archivo seleccionado(".$archivo.")";
    }
	}   
}
if(@$tipo_retorno){
	echo(json_encode($retorno));	
}
else{
	return($retorno);
}
}
?>