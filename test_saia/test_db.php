<?php
require_once("define.php");
require_once("conexion.php");
require_once("sql.php");

//print_r(session_id());
$error=array();
$dat_orig=0;
$sql="";
$conn=NULL;
$conn=phpmkr_db_connect();
$sql="SELECT * FROM funcionario WHERE login='cerok'";
$rs=$conn->Ejecutar_Sql($sql);
$temp=phpmkr_fetch_array($rs);
$retorno["sql"]=$sql;
for($i=0;$temp;$temp=phpmkr_fetch_array($rs),$i++)
  array_push($retorno,$temp);
$retorno["numcampos"]=$i;
phpmkr_free_result($rs);
print_r($retorno);


function phpmkr_db_connect($HOST=HOST,$USER=USER,$PASS=PASS,$DB=DB,$MOTOR=MOTOR,$PORT=PORT,$BASEDATOS=BASEDATOS)
{
global $conn;
   if(!$conn)
  {
    $datos=array('basedatos'=>$BASEDATOS,'db'=>$DB,'motor'=>$MOTOR,'host'=>$HOST,'user'=>$USER,'pass'=>$PASS,'port'=>$PORT);
    $con=new conexion($datos);
    $conn=new SQL($con,$MOTOR);
    if($conn && $conn->Conn){
      return ($conn);
    }
    else if(!$conn){
      error("Error al Tratar de Crear el SQL.".$conn->consulta);
      return FALSE;
    }
    else{
       error("Error al conectarse con la Base de datos.".$conn->consulta);
       return FALSE;
    }
  }
  else return(TRUE);
}
function busca_filtro_tabla($campos,$tabla,$filtro,$orden,$conn){
global $sql,$conn;
if(!$conn){
  $conn=phpmkr_db_connect();
}
$retorno=array();
$temp=array();
$retorno["tabla"]=$tabla;
switch ($tabla){
  case ("dependencia2"):
    $tabla = "dependencia";
  break;
  case ("cargo2"):
    $tabla="cargo";
  break;
  case ("cargo3"):
    $tabla="dependencia_cargo";
  break; 
  case ("funcionario2"):
    $tabla="funcionario";
  break;    
}
$sql="Select ";
if($campos)
  $sql.=$campos;
else 
  $sql.="*";
if($tabla)
  $sql.=" FROM ".$tabla;
if($filtro)
  $sql.=" WHERE ".str_replace('"',"'",$filtro);
if($orden){
  if(substr(strtolower($orden),0,5)=="group")
    $sql.=" ".$orden;
  else  
    $sql.=" ORDER BY ".$orden;
}
$sql=htmlspecialchars_decode((utf8_decode($sql)));
$rs=$conn->Ejecutar_Sql($sql);
$temp=phpmkr_fetch_array($rs);
$retorno["sql"]=$sql;
for($i=0;$temp;$temp=phpmkr_fetch_array($rs),$i++)
  array_push($retorno,$temp);
$retorno["numcampos"]=$i;  
phpmkr_free_result($rs);
return($retorno);
}
/*
<Clase>
<Nombre>busca_filtro_tabla
<Parametros>$campos: columnas que se van a seleccionar
            $tabla: Tabla(s) desde la(s) que se va a seleccionar los datos
            $filtro: where de la consulta
            $orden: columna por la que se ordenaran los datos
            $inici: No registro donde inicia la consulta
            $registros:cantidad de registros que deben consultarse
<Responsabilidades>Invocar la busqueda a la base de datos y retornar el resultado de la misma en un arreglo
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function busca_filtro_tabla_limit($campos,$tabla,$filtro,$orden,$inicio,$registros,$conn){
  global $sql,$conn;
  if(!$conn){
    $conn=phpmkr_db_connect();
  }
  $retorno=array();
  $temp=array();
  $retorno["tabla"]=$tabla;
  $sql="Select ";
  if($campos)
    $sql.=$campos;
  else $sql.="*";
  if($tabla)
    $sql.=" FROM ".$tabla;

  if($filtro)
    $sql.=" WHERE ".str_replace('"',"'",$filtro);
  if($orden){ 
      $sql.=$orden;
  }
  $sql=htmlspecialchars_decode((utf8_decode($sql)));
  $rs=$conn->Ejecutar_Limit($sql,$inicio,($inicio+$registros),$conn);
  $temp=phpmkr_fetch_array($rs);

  $retorno["sql"]=$sql;
  
  for($i=0;$temp;$temp=phpmkr_fetch_array($rs),$i++)
    array_push($retorno,$temp);
  $retorno["numcampos"]=$i;  
  phpmkr_free_result($rs);
  return($retorno);
}
/*
<Clase>
<Nombre>phpmkr_fetch_array
<Parametros>$rs: objeto que contiene la consulta
<Responsabilidades> Retornar un arreglo que contiene la siguiente fila de $rs
<Notas>
<Excepciones>Error en capturar resultado en arreglo. Si la conexion con la base de datos no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function phpmkr_fetch_array($rs){
  global $conn;
	if($conn){
    if(!$rs&&$conn->res)
      $rs = $conn->res;
	  $retorno=$conn->sacar_fila($rs);
    return $retorno;
	} 
  else{
    alerta("Error en capturar resultado en arreglo.".$rs->sql);
    return FALSE;
  }      
}
/*
<Clase>
<Nombre>phpmkr_free_result
<Parametros>$rs: objeto que contiene la consulta
<Responsabilidades>libera el objeto $rs
<Notas>
<Excepciones>Error al liberar el resultado, si la conexion con la base de datos no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function phpmkr_free_result($rs){
global $conn;
$conn->liberar_resultado($rs);
}
?>