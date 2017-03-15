<?php
  $max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
  include_once($ruta_db_superior."db.php");
  include_once($ruta_db_superior."pantallas/caja/librerias.php");  
  include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
  $validar_enteros=array("idcaja","entidad_identidad");
	desencriptar_sqli('form_info');
  
 // print_r($_REQUEST);die();
if(@$_REQUEST["ejecutar_caja"]){  
  if(!@$_REQUEST["tipo_retorno"]){
    $_REQUEST["tipo_retorno"]=1;
  }
  if($_REQUEST["tipo_retorno"]){
    echo(json_encode($_REQUEST["ejecutar_caja"]()));
  }  
  else{
    $_REQUEST["ejecutar_caja"]();
  }
}
function set_caja(){
$retorno=new stdClass;
$retorno->exito=0;
$retorno->mensaje="Error al guardar";
$exito=0;
$campos=array("fondo", "seccion", "subseccion", "division", "codigo", "serie_idserie", "no_carpetas", "no_cajas", "no_consecutivo", "no_correlativo", "fecha_extrema_i", "fecha_extrema_f", "estanteria", "panel", "material", "seguridad", "funcionario_idfuncionario");
$valores=array();
foreach($campos AS $key=>$campo){
  if(@$_REQUEST[$campo]){
    array_push($valores,$_REQUEST[$campo]);
  }
  else{
    array_push($valores,"");
  }
}
$sql2="INSERT INTO caja(".implode(",",$campos).") VALUES('".implode("','",$valores)."')";
phpmkr_query($sql2);
$idcaja=phpmkr_insert_id();
if($idcaja){
  if(asignar_caja($idcaja,1,usuario_actual("idfuncionario"))){
    $exito=1; 
  }  
}
if($exito){
  $retorno->idcaja=$idcaja;
  $retorno->exito=1;
  $retorno->mensaje="Caja guardado con &eacute;xito"; 
}
return($retorno);
}
function update_caja(){
$retorno=new stdClass;
$retorno->exito=0;
$retorno->mensaje="Error al guardar";
$exito=0;
$campos=array("fondo", "seccion", "subseccion", "division", "codigo", "serie_idserie", "no_carpetas", "no_cajas", "no_consecutivo", "no_correlativo", "fecha_extrema_i", "fecha_extrema_f", "estanteria", "panel", "material", "seguridad", "funcionario_idfuncionario");
$valores=array();
$update=array();
foreach($campos AS $key=>$campo){
	$update[]=$campo."='".$_REQUEST[$campo]."'";
}
$sql2="UPDATE caja SET ".implode(",",$update)." WHERE idcaja=".$_REQUEST["idcaja"];
phpmkr_query($sql2);
$idcaja=$_REQUEST["idcaja"];
$retorno->sql=$sql2;
if($idcaja){  
	$exito=1;
}
if($exito){
  $retorno->idcaja=$idcaja;
  $retorno->exito=1;
  $retorno->mensaje="Caja actualizado con &eacute;xito"; 
}
return($retorno);
}
function delete_caja(){
$retorno=new stdClass;
$retorno->exito=0;
$retorno->mensaje="Error al eliminar";
$exito=0;

$sql2="DELETE FROM caja WHERE idcaja=".$_REQUEST["idcaja"];
phpmkr_query($sql2);
$idcaja=$_REQUEST["idcaja"];
$retorno->sql=$sql2;
if($idcaja){
	$exito=1;
}
if($exito){
  $retorno->idcaja=$idcaja;
  $retorno->exito=1;
  $retorno->mensaje="Caja eliminado con &eacute;xito"; 
}
return($retorno);
}
function asignar_permiso_caja(){
$retorno=new stdClass;
$retorno->exito=0;
$retorno->mensaje="Error al asignar el caja";
$retorno->idcaja=$_REQUEST["idcaja"];
if(@$_REQUEST["idcaja"] && @$_REQUEST["tipo_entidad"] && @$_REQUEST["entidad_identidad"]){
  $llaves_entidad=busca_filtro_tabla("idfuncionario","funcionario","funcionario_codigo IN(".$_REQUEST["entidad_identidad"].")","",$conn);
  $exito=0;
  for($i=0;$i<$llaves_entidad["numcampos"];$i++){
    if(asignar_caja($_REQUEST["idcaja"], $_REQUEST["tipo_entidad"], $llaves_entidad[$i]["idfuncionario"])){
      $exito++;
    }
  }  
  if($exito==$llaves_entidad["numcampos"]){
    $retorno->exito=1;
    $retorno->mensaje="Asignaciones al caja realizadas con &eacute;xito";
  }
  else if($exito==0){
    $retorno->exito=0;  
    $retorno->mensaje="No se realizan asignaciones al caja";
  }
  else{
    $retorno->exito=0;  
    $retorno->mensaje="Se realizan algunas asignaciones al caja se presentan errores";
  }
}
return($retorno);
}

?>