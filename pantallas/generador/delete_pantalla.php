<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
function delete_pantalla($set_type="request",$data=null){
  $retorno=new stdClass;
  $retorno->exito=0;
  $retorno->mensaje="Error al Eliminar la pantalla";
  $exito=0;
  if($set_type=="request"){
    $datos_set=$_REQUEST;
  } else if($set_type=="json" && $data){
    $datos_set=(array)json_decode($data);
    $_REQUEST["idpantalla"]=$datos_set["idpantalla"];
  }
  if($_REQUEST["idpantalla"]){
    $sql2="DELETE FROM pantalla WHERE idpantalla=".$_REQUEST["idpantalla"];
    $retorno->sql_pantalla=$sql2;
    phpmkr_query($sql2);
    $exito=1;
  }
  if($exito){
    $retorno->exito=1;
    $retorno->mensaje="Pantalla borrada con &eacute;xito";
  }
  return($retorno);
}
if(@$_REQUEST["ejecutar_pantalla"]){
  if(!@$_REQUEST["tipo_retorno"]){
    $_REQUEST["tipo_retorno"]=1;
  }
  if($_REQUEST["tipo_retorno"]){
    echo(json_encode($_REQUEST["ejecutar_pantalla"]()));
  }
  else{
    $_REQUEST["ejecutar_pantalla"]();
  }
}
?>