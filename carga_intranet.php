<?php
 include_once ("db.php");
function cargar(){
 global $conn;
 $anio=date("Y-m-d");
 $archivo="/usuariosIntranet.txt";
 $cont=0;
 if(is_file($archivo)){
  $fp = fopen ($archivo,"r");
  ejecuta_sql("truncate temporal_funcionario",$conn);
 } 
 while ($fp&&$data = fgetcsv ($fp, 1000, ";"))
 {
  $sql="INSERT INTO temporal_funcionario VALUES(NULL,'$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$anio')";
  ejecuta_sql($sql,$conn);
  //echo($sql."<BR>");
  $cont++; 
 }
 fclose ($fp);
 ejecuta_sql("UPDATE configuracion SET valor='".$anio."' WHERE configuracion.nombre='fecha_creacion_funcionario'",$conn);
 } 
function actualizar_funcionarios(){
global $conn;
$listado_temporal_funcionario=busca_filtro_tabla("*","temporal_funcionario","1=1","codigo_intranet ASC",$conn);
ejecuta_sql("update funcionario set estado=0",$conn);
$sql="update dependencia_cargo set estado=0";
ejecuta_sql($sql,$conn);
for($i=0;$i<=$listado_temporal_funcionario["numcampos"];$i++){
  $funcionario=busca_filtro_tabla("idfuncionario,funcionario_codigo","funcionario","funcionario_codigo=".$listado_temporal_funcionario[$i]["codigo_intranet"],"",$conn);
  $cargo=busca_filtro_tabla("idcargo,nombre","cargo","nombre='".$listado_temporal_funcionario[$i]["cargo"]."'","nombre ASC",$conn);
  $dependencia=busca_filtro_tabla("*","dependencia","nombre LIKE '".$listado_temporal_funcionario[$i]["dependencia"]."'","",$conn);
  if($funcionario["numcampos"]){
    ejecuta_sql("update funcionario set estado=1 where idfuncionario=".$funcionario[0]["idfuncionario"],$conn);
    $idfuncionario=$funcionario[0]["idfuncionario"];
  }
  else{
    $sql="INSERT INTO funcionario(funcionario_codigo,login,nombres,apellidos,estado,clave) VALUES('".$listado_temporal_funcionario[$i]["codigo_intranet"]."','".$listado_temporal_funcionario[$i]["login"]."','".$listado_temporal_funcionario[$i]["nombres"]."','".$listado_temporal_funcionario[$i]["apellidos"]."',1,'".$listado_temporal_funcionario[$i]["login"]."')";
    $idfuncionario=ejecuta_sql($sql,$conn);
  }
  if($cargo["numcampos"]){
    $idcargo=$cargo[0]["idcargo"];
  }
  else{
    $sql="INSERT INTO cargo(nombre) VALUES('".$listado_temporal_funcionario[$i]["cargo"]."')";
    $idcargo=ejecuta_sql($sql,$conn);
  }
  if($dependencia["numcampos"]){
    $iddependencia=$dependencia[0]["iddependencia"];
  }
  else {
    $sql="INSERT INTO dependencia(nombre) VALUES('".$listado_temporal_funcionario[$i]["dependencia"]."')";
    $iddependencia=ejecuta_sql($sql,$conn);  
  }
  $dependencia_cargo=busca_filtro_tabla("*","dependencia_cargo","funcionario_idfuncionario=".$idfuncionario." AND cargo_idcargo=".$idcargo." AND dependencia_iddependencia=".$iddependencia,"",$conn);    
  if($dependencia_cargo["numcampos"]){
    $sql="UPDATE dependencia_cargo SET estado=1 WHERE iddependencia_cargo=".$dependencia_cargo[0]["iddependencia_cargo"];
    ejecuta_sql($sql,$conn);
  }
  else{
    $sql="INSERT INTO dependencia_cargo(funcionario_idfuncionario,cargo_idcargo,dependencia_iddependencia,fecha_inicial) VALUES('$idfuncionario','$idcargo','$iddependencia','".date("Y-m-d")."')";
    ejecuta_sql($sql,$conn);      
  }
}
//print_r($listado_temporal_funcionario);
} 
function cargar_permisos($tipo,$valor,$tipo_permiso){
global $conn;
  if($tipo=="login"){
    $funcionario=busca_filtro_tabla("*","funcionario","funcionario.login='".$valor."'","",$conn);
  }  
  else if($tipo=="idfuncionario"){
    $funcionario=busca_filtro_tabla("*","funcionario","funcionario.idfuncionario='".$valor."'","",$conn);
  }
  else if($tipo=="codigo"){
    $funcionario=busca_filtro_tabla("*","funcionario","funcionario.codigo='".$valor."'","",$conn);
  }
  else $funcionario["numcampos"]=0;
  if($funcionario["numcampos"]){
    switch($tipo_permiso){
    case "ADMINISTRADOR":
      $sql="INSERT INTO permiso(tabla,accion,funcionario_idfuncionario) ,('radicacion','RADICACION_SALIDA',".$funcionario[0]["idfuncionario"]."),('configuracion','FUNCIONARIO',".$funcionario[0]["idfuncionario"]."),('configuracion','SERIE',".$funcionario[0]["idfuncionario"]."),('configuracion','DEPENDENCIA_CARGO',".$funcionario[0]["idfuncionario"]."),('documento','EDITAR_DOCUMENTOS',".$funcionario[0]["idfuncionario"]."),VALUES('documento','ACCESAR',".$funcionario[0]["idfuncionario"]."),('documento','ACCESAR_DEPENDENCIA',".$funcionario[0]["idfuncionario"]."),('documento','TRANSFERIR',".$funcionario[0]["idfuncionario"].")" ;
      echo($sql);  
    break;
    case "AUXILIAR":
      $sql="INSERT INTO permiso(tabla,accion,funcionario_idfuncionario) VALUES('radicacion','ACCESAR',".$funcionario[0]["idfuncionario"]."),('radicacion','TRANSFERIR',".$funcionario[0]["idfuncionario"]."),('radicacion','RADICACION_SALIDA',".$funcionario[0]["idfuncionario"].")";
      echo($sql);  
    break;
    case "DIRECTIVO":
      $sql="INSERT INTO permiso(tabla,accion,funcionario_idfuncionario) VALUES('radicacion','ACCESAR',".$funcionario[0]["idfuncionario"]."),('radicacion','TRANSFERIR',".$funcionario[0]["idfuncionario"]."),('radicacion','RADICACION_SALIDA',".$funcionario[0]["idfuncionario"].")";
      echo($sql);  
    break;
    
    }
  }
}
cargar();
actualizar_funcionarios();
cargar_permisos("login","nelson","ADMINISTRADOR");
?>
