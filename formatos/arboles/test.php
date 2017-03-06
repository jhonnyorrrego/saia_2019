<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 ISO-8859-1
/*if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") )
{ 
  header("Content-type: application/xhtml+xml"); 
} 
else 
{ 
  header("Content-type: text/xml"); 
}*/
$texto="<?xml version=\"1.0\" encoding=\"UTF-8\"?".">";
$texto.="<tree id=\"0\">\n";
require_once("../../db.php");
if(isset($_REQUEST["seleccionado"]) && $_REQUEST["seleccionado"]<>""){
  $seleccionados1=explode("|",$_REQUEST["seleccionado"]);
  $seleccionados=explode(",",$seleccionados1[0]);
  if(isset($seleccionados1[1])&&$seleccionados1[1]!="")
    $parciales=explode(",",$seleccionados1[1]);
  else $parciales=array();
}
else{
  $seleccionados=array();
  $parciales=array();
}
$codigo=valida_envio("key",0,3); 
$texto.="</tree>\n";
crear_archivo("test.xml",$texto);
?>
<?php
function llena_dependencia($codigo, $ruta){
global $conn,$sql,$seleccionados,$parciales,$texto;
$llenado=FALSE;
if($codigo == 0)
{
  $prof=busca_filtro_tabla("","dependencia","cod_padre IS NULL OR cod_padre=0","",$conn);
  for($i=0;$i<$prof["numcampos"];$i++){
    $texto.=("<item style=\"font-family:verdana; font-size:7pt;\" ");
    //if(in_array($prof[$i]["iddependencia"]."d",$seleccionados))
      $texto.=(" nocheckbox=\"1\" ");
    /*else if(in_array($prof[$i]["iddependencia"]."d",$parciales))
      $texto.=(" nocheckbox=\"1\" ");*/
    $texto.="text=\"".ucwords(($prof[$i]["nombre"]))."\" id=\"".$prof[$i]["iddependencia"]."d\" child=\"1\">\n";
    llena_dependencia($prof[$i]["iddependencia"],$ruta);
    $texto.=("</item>\n");
  }
}
else
{
  $hijos=busca_filtro_tabla("","dependencia","estado=1 AND cod_padre=".$codigo,"",$conn);
  if($hijos["numcampos"]){
    for($i=0;$i<$hijos["numcampos"] && $hijos[$i]["iddependencia"]!=$codigo;$i++){
      $texto.="<item style=\"font-family:verdana; font-size:7pt;\" ";
      //if(in_array($prof[$i]["iddependencia"]."d",$seleccionados) || in_array($prof[$i]["iddependencia"]."d",$parciales)){
        $texto.=(" nocheckbox=\"1\" ");
      //}
      $texto.=" text=\"".(formato_cargo($hijos[$i]["nombre"]))."\" id=\"".$hijos[$i]["iddependencia"]."d\" child=\"1\">\n";
      llena_dependencia($hijos[$i]["iddependencia"],$ruta);
      llena_funcionarios($hijos[$i]["iddependencia"],$ruta);
      $texto.="</item>\n";
    }
  llena_funcionarios($hijos[$i]["iddependencia"],$ruta);
  }
}
return;
}

function llena_funcionarios($codigo,$ruta){
global $conn,$sql,$seleccionados,$texto;
//GROUP BY funcionario_codigo 
$usuarios=busca_filtro_tabla("A.login,A.funcionario_codigo,A.nombres AS nombres_ord,A.apellidos AS apellidos,C.nombre AS cargo","funcionario A,dependencia_cargo B, cargo C","B.cargo_idcargo=C.idcargo AND B.funcionario_idfuncionario=A.idfuncionario AND B.dependencia_iddependencia <> 1 AND A.estado=1 AND B.estado=1 AND B.dependencia_iddependencia=".$codigo,"nombres_ord ASC",$conn);
if($ruta == 0)
 $ruta = "";
else
  $ruta = "%".$ruta; 
for($j=0;$j<$usuarios["numcampos"];$j++){
   $texto.="<item style=\"font-family:verdana; font-size:7pt;\" ";
   $valor=in_array($usuarios[$j]["funcionario_codigo"],$seleccionados);
   if($valor!="" && $valor!=Null)
       $texto.= " checked=\"1\" ";
   if($usuarios[$j]["nombres_ord"])
    $texto.= codifica_encabezado(html_entity_decode("text=\"".ucwords(($usuarios[$j]["nombres_ord"]." ".$usuarios[$j]["apellidos"]))." (".($usuarios[$j]["login"])."-".formato_cargo($usuarios[$j]["cargo"]).")\" id=\"".$usuarios[$j]["funcionario_codigo"]."$ruta\" ruta=\"$ruta\" child=\"0\">"));
   else  
    $texto.= htmlspecialchars_decode("text=\"".($usuarios[$j]["login"])."\" id=\"".$usuarios[$j]["funcionario_codigo"]."$ruta\" ruta=\"$ruta\" child=\"0\">");
   $texto.="</item>\n";
}
if($usuarios["numcampos"])
  return(TRUE);
else  return(FALSE); 
}

function llena_funcionario($codigo,$ruta){
global $conn,$sql,$texto;
$usuarios=busca_filtro_tabla("*","funcionario A","A.estado=1 AND A.funcionario_codigo=".$codigo,"",$conn);
if($usuarios["numcampos"]){
  $texto.="<item style=\"font-family:verdana; font-size:7pt;\" ";
  if($usuarios[0]["nombres_ord"])
    $texto.="text=\"".ucwords(($usuarios[0]["nombres_ord"]." ".$usuarios[0]["apellidos"]))." (".$usuarios[0]["funcionario_codigo"].")\" id=\"".$usuarios[0]["funcionario_codigo"]."%$ruta\" ruta=\"$ruta\">";
  else  
    $texto.="text=\"".($usuarios[0]["login"]."\" id=\"".$usuarios[0]["funcionario_codigo"])."\" ruta=\"$ruta\">";
  $texto.="</item>\n";
  return(TRUE);    
}
return(FALSE);
}
?>
