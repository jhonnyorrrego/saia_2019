<?php
  $max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
  include_once($ruta_db_superior."db.php");
  include_once($ruta_db_superior."pantallas/remitente/librerias.php");  
if(@$_REQUEST["ejecutar_remitente"]){
  if(!@$_REQUEST["tipo_retorno"]){
    $_REQUEST["tipo_retorno"]=1;
  }
  if($_REQUEST["tipo_retorno"]){
    echo(json_encode($_REQUEST["ejecutar_remitente"]()));
  }  
  else{
    $_REQUEST["ejecutar_remitente"]();
  }
}
function set_remitente(){
$retorno=new stdClass;
$retorno->exito=0;
$retorno->mensaje="Error al guardar Prueba";
$exito=0;
$campos=array("cargo","empresa","direccion","telefono","email","titulo","ciudad","codigo","ejecutor_idejecutor");
$valores=array();
foreach($campos AS $key=>$campo){
  if(@$_REQUEST[$campo]){
    array_push($valores,$_REQUEST[$campo]);
  }
  else{
    array_push($valores,"");
  }
}
$sql2="INSERT INTO datos_ejecutor(".implode(",",$campos).") VALUES('".implode("','",$valores)."')";
phpmkr_query($sql2);
$iddatos_ejecutor=phpmkr_insert_id();
$retorno->sql=$sql2;
if($iddatos_ejecutor){
	$exito=1;
}
if($exito){
  $retorno->iddatos_ejecutor=$iddatos_ejecutor;
  $retorno->exito=1;
  $retorno->mensaje="Datos guardados"; 
}
return($retorno);
}
?>