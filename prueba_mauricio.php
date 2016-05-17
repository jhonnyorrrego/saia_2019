<?php
die();
include_once("db.php");
validar_sesion();

function validar_sesion(){
  global $conn;
  
  almacenar_sesion2(1,"");
}

function cerrar_sesion2(){
global $conn;
$iplocal=getRealIP();
$ipremoto=servidor_remoto();
$sql="UPDATE log_acceso SET fecha_cierre=".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s")." WHERE iplocal='".$iplocal."' AND ipremota='".$ipremoto."' AND fecha_cierre IS NULL AND exito=1";
print_r($sql);
die();
$conn->Ejecutar_sql($sql);
}

function almacenar_sesion2($exito,$login){
global $conn;
$datos=array();
if($login==""){
  $login=usuario_actual("login");
  $id=usuario_actual("id");
  $idfun_intentetos=usuario_actual("idfuncionario");
}
$iplocal=getRealIP();
$ipremoto=servidor_remoto();
if($iplocal=="" || $ipremoto==""){
  if($iplocal=="")
      $iplocal=$ipremoto;
  else $ipremoto=$iplocal;
}

$idsesion=ultima_sesion2();

$accion="";
if($idsesion==""){
  $accion="INSERTA";
}
else {
  $accion="ACTUALIZA";
}
$datos_sesion=datos_sesion();
switch($accion){
  case "INSERTA":
    $sql="INSERT INTO log_acceso(iplocal,ipremota,login,exito,idsesion_php,sesion_php,fecha) VALUES('$iplocal','$ipremoto','".$login."',".$exito.",'".session_id()."','".$datos_sesion["datos"]."',".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").")";
  break;
  case "ACTUALIZA":
    $sql="UPDATE log_acceso A SET A.sesion_php='".$datos_sesion["ruta"]."' WHERE A.idlog_acceso=".$idsesion;
  break;
}
if($sql!=""){
  $conn->Ejecutar_Sql($sql);
}
else{
  if($datos_sesion["ruta"]=="")
    alerta("Ruta de Sesion, no definida. Por favor comunicarle al Administrador del sistema");
  if($datos_sesion["datos"]=="")
    alerta("Su sesion no fue encontrada. Por favor comunicarle al Administrador del sistema");
}
return($datos);
}

function ultima_sesion2(){
global $conn;
$iplocal=getRealIP();
$ipremoto=servidor_remoto();
$conexion=$conn->Ejecutar_sql("Select A.idsesion_php FROM log_acceso A WHERE A.iplocal='".$iplocal."' AND A.ipremota='".$ipremoto."' AND fecha_cierre IS NULL AND A.exito=1 ORDER BY A.fecha DESC");
if($conexion->num_rows){
 $dato=$conn->sacar_fila();
 return($dato["idsesion_php"]);
}
return("");
}

function exportar_tabla(){
  global $conn;
  
  $tabla="modulo";
  if(@$_REQUEST["tabla"])$tabla=$_REQUEST["tabla"];
  $datos=busca_filtro_tabla("column_name,data_type","information_schema.columns","TABLE_NAME = '".$tabla."' AND TABLE_SCHEMA='".DB."'","ordinal_position",$conn);
  
  $datos_tabla=busca_filtro_tabla("",$tabla,"","",$conn);
  
  $campos=extrae_campo($datos,"column_name","");
  
  $cadena=array();
  $cadena[]="set identity_insert ".$tabla." on;";
  for($j=0;$j<$datos_tabla["numcampos"];$j++){
  $valores=array();
  	for($i=0;$i<$datos["numcampos"];$i++){
  		if($datos[$i]["data_type"]=='int'){
  			if($datos_tabla[$j][$datos[$i]["column_name"]]==0)$valores[]=0;
  			else if($datos_tabla[$j][$datos[$i]["column_name"]])$valores[]=$datos_tabla[$j][$datos[$i]["column_name"]];
  			else $valores[]="NULL";
  		}
  		else if($datos[$i]["data_type"]=='blob' || $datos[$i]["data_type"]=='mediumblob'){
  			$valores[]="NULL";
  			//$valores[]="'".$datos_tabla[$j][$datos[$i]["column_name"]]."'";
  		}
  		else if($datos[$i]["data_type"]=='timestamp'){
  			if(!$datos_tabla[$j][$datos[$i]["column_name"]])$valores[]="NULL";
  			else $valores[]="CONVERT(datetime,'".$datos_tabla[$j][$datos[$i]["column_name"]].".000',20)";
  		}
  		else if($datos[$i]["data_type"]=='datetime'){
  			if($datos_tabla[$j][$datos[$i]["column_name"]]=='0000-00-00 00:00:00')$valores[]="NULL";
  			else if(!$datos_tabla[$j][$datos[$i]["column_name"]])$valores[]="NULL";
  			else $valores[]="CONVERT(datetime,'".$datos_tabla[$j][$datos[$i]["column_name"]].".000',20)";
  		}
  		else{
  			$valores[]="'".str_replace("'","''",$datos_tabla[$j][$datos[$i]["column_name"]])."'";
  		}
  	}
  	$cadena[]="insert into ".$tabla."(".strtolower(implode(",",$campos)).")values(".implode(",",$valores).");";
  }
  $cadena[]="set identity_insert ".$tabla." off;";
  echo(implode("\r",$cadena));
}
?>