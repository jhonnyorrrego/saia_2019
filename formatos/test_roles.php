<?php 
//ini_set("display_errors",true);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 ISO-8859-1

if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) 
{ 
  header("Content-type: application/xhtml+xml"); 
} 
else 
{ 
  header("Content-type: text/xml"); 
}

echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");

$id = @$_GET["id"];

if($id and $id<>"")
  echo("<tree id=\"".$id."\">\n");
else
  echo("<tree id=\"0\">\n");

if(isset($_REQUEST["seleccionado"]))
   $seleccionados=explode(",",$_REQUEST["seleccionado"]);
else   
   $seleccionados=array();
if(isset($_REQUEST["excluidos"]))
   $excluidos=explode(",",$_REQUEST["excluidos"]);
else   
   $excluidos=array();
require_once("db.php");

 echo llena_dependencia(0,0); 
 
echo("</tree>\n");
?>
<?php
function llena_dependencia($codigo,$ruta)
{
global $conn,$sql,$seleccionados;
$llenado=FALSE;
$cadena="";
if($codigo == 0)
{
  $prof=busca_filtro_tabla("","dependencia","cod_padre is null AND estado=1","",$conn);
  if($prof["numcampos"]){
    $cadena.=("<item style=\"font-family:verdana; font-size:7pt;\" ");
    $cadena.=("text=\"".ucwords(($prof[0]["nombre"]))."\" id=\"".$prof[0]["iddependencia"]."#\" >\n");
    $cadena.=llena_dependencia($prof[0]["iddependencia"], 0);
    $cadena.=("</item>\n");
    return $cadena;
  }
}
else
{
  $prof=busca_filtro_tabla("","dependencia","iddependencia=".$codigo." AND estado=1","",$conn);    
  if($prof["numcampos"]){
    $hijos=busca_filtro_tabla("*","dependencia A"," estado=1 AND A.cod_padre=".$prof[0]["iddependencia"],"A.nombre ASC",$conn); 
  if($hijos["numcampos"]){
    for($i=0;$i<$hijos["numcampos"];$i++)
    {$valor=in_array($hijos[$i]["iddependencia"]."d",$seleccionados);
     if($valor!="" && $valor!=Null)
       $adicional=" checked=\"1\" "; 
     else
       $adicional="";       
     $codigo_hijos=llena_dependencia($hijos[$i]["iddependencia"], 0);     
     if($codigo_hijos<>"")
     {$cadena.=("<item style=\"font-family:verdana; font-size:7pt;\" $adicional ");
      $cadena.=("text=\"".ucwords((formato_cargo($hijos[$i]["nombre"])))."\" nocheckbox=\"1\" id=\"".$hijos[$i]["iddependencia"]."#\" >\n");
      $cadena.=$codigo_hijos."</item>\n";
     } 
    }       
  } 
  $funcionarios=llena_funcionarios($codigo,$ruta);  
  if($cadena=="" and $funcionarios=="")
    return("");
  else       
    return $cadena.$funcionarios;
 }
 }
} 

function llena_funcionarios($codigo,$ruta){
global $conn,$sql,$seleccionados,$excluidos;
$func="";
//GROUP BY funcionario_codigo 
$where_usuarios= "B.cargo_idcargo=C.idcargo AND B.funcionario_idfuncionario=A.idfuncionario AND A.login<>'0k' AND B.dependencia_iddependencia <> 1 AND A.estado=1 AND B.estado=1 and C.estado=1 AND B.dependencia_iddependencia=".$codigo;
if(count($excluidos)){
  $where_usuarios.=" AND idfuncionario NOT IN (".implode(",",$excluidos).")";
}
$usuarios=busca_filtro_tabla("distinct B.iddependencia_cargo,A.login,A.funcionario_codigo,lower(A.nombres) AS nombres_ord,lower(A.apellidos) AS apellidos,A.sistema,C.nombre AS cargo","funcionario A,dependencia_cargo B, cargo C",$where_usuarios,"nombres_ord ASC",$conn);
//print_r($usuarios);
if($ruta == 0)
 $ruta = "";
else
  $ruta = "%".$ruta; 
for($j=0;$j<$usuarios["numcampos"];$j++)
{ $sistema = "";
   if($usuarios[$j]["sistema"]==0)
     $sistema = "(Sin SAIA)";
  $valor=in_array($usuarios[$j]["iddependencia_cargo"],$seleccionados);
  //alerta($valor);
  $adicional="";
  if($valor!="" && $valor!=Null)
      $adicional=" checked=\"1\" "; 
   $func.=("<item style=\"font-family:verdana; font-size:7pt;\" $adicional ");
  if($usuarios[$j]["nombres_ord"])
    $func.=("text=\"".ucwords(($usuarios[$j]["nombres_ord"]." ".$usuarios[$j]["apellidos"]))."-".(formato_cargo($usuarios[$j]["cargo"]))."  $sistema\" id=\"".$usuarios[$j]["iddependencia_cargo"]."$ruta\" ruta=\"$ruta\" >");
   else  
    $func.=("text=\"".($usuarios[$j]["login"])."\" id=\"".$usuarios[$j]["iddependencia_cargo"]."$ruta\" ruta=\"$ruta\" >");
   $func.=("</item>\n"); 
}
if($usuarios["numcampos"])
  return($func);
else  return(""); 
}

function codifica_caracteres($original){
$codificada=$original;
return($codificada);
}
?>
