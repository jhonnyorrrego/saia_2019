<?php
include_once("../db.php");
/*ini_set("display_errors",true);
print_r(solicitud_acceso('usuario/~/cerok/-/clave/~/cerok_saia/-/'));*/
function solicitud_acceso($datos){
global $conn;
$arreglo=explode("/-/",$datos);
foreach($arreglo AS $key=>$valor){
  $arreglo2=explode("/~/",$valor);
  if($arreglo2[0]=="usuario"){
    $usuario=$arreglo2[1];
  } 
  elseif($arreglo2[0]=="clave"){
    $clave=$arreglo2[1];
  }
}
$acceso=busca_filtro_tabla("nombres,apellidos,login,acceso_web","funcionario","login='".$usuario."' AND clave='".$clave."' AND estado=1","",$conn);
return($acceso);
}
?>