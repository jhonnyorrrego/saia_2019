<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0
$tabla = @$_REQUEST["tabla"];
$id = @$_REQUEST["id"];
if(isset($_REQUEST["estado"]) && $_REQUEST["estado"]!="")
{
 $activo = " and estado = 1"; 
}
if(isset($_REQUEST["seleccionado"]))
  $seleccionado=explode(",",$_REQUEST["seleccionado"]);
else
  $seleccionado=array();  
if(isset($_REQUEST["excluido"]))
  $excluido=explode(",",$_REQUEST["excluido"]);
else
  $excluido=array();  
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ){ 
  header("Content-type: application/xhtml+xml"); 
} 
else { 
  header("Content-type: text/xml"); 
}
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
if($id and $id<>"")
  echo("<tree id=\"".$id."\">\n"); 
else
  echo("<tree id=\"0\">\n");
  
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
if($tabla=="serie"){
  if(isset($_REQUEST["categoria"])&&$_REQUEST["categoria"]){
    switch($_REQUEST["categoria"]){
      case 1:echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Comunicaciones Oficiales\" id=\"1-categoria-Comunicaciones Oficiales\" >\n"; 
       llena_serie("NULL"," and categoria=1 ");
   echo "</item>\n";
              break;
       case 2:echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Produccion Documental\" id=\"2-categoria-Produccion Documental\" >\n"; 
       llena_serie("NULL"," and categoria=2 ");
   echo "</item>\n";
              break;
       case 3: echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Otras categorias\" id=\"3-categoria-Otras categorias\" >\n"; 
       llena_serie("NULL"," and categoria=3 ");
   echo "</item>\n";
              break;       
      }
   }
   else
   {
   echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Comunicaciones Oficiales\" id=\"1-categoria-Comunicaciones Oficiales\"  >\n"; 
       llena_serie("NULL"," and categoria=1 ");
   echo "</item>\n";
   echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Produccion Documental\" id=\"2-categoria-Produccion Documental\" >\n"; 
       llena_serie("NULL"," and categoria=2 ");
   echo "</item>\n";
   echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Otras categorias\" id=\"3-categoria-Otras categorias\" >\n"; 
       llena_serie("NULL"," and categoria=3 ");
   echo "</item>\n";
   }
  }
else{
  if(@$_REQUEST["tabla"] && @$_REQUEST["cerrar_en_tabla"]){
    echo  "<item style=\"font-family:verdana; font-size:7pt;\" nocheckbox=\"1\" text=\"".$_REQUEST["tabla"]."\" id=\"".$_REQUEST["tabla"].rand()."\">\n";           
  }  
  if($id and $id<>"")
    llena_serie($id);
  else
    llena_serie("NULL");
  if(@$_REQUEST["tabla"] && @$_REQUEST["cerrar_en_tabla"]){
    echo "</item>\n"; 
  }  
}
echo("</tree>\n");
$activo = "";
?>
<?php

function llena_serie($serie,$condicion=""){
global $conn,$tabla,$seleccionado,$activo,$excluido;
if(isset($_REQUEST["orden"]))
  $orden=$_REQUEST["orden"];
else
  $orden="nombre";
if($serie=="NULL")
  $papas=busca_filtro_tabla("*",$tabla,"(cod_padre IS NULL OR cod_padre=0) $activo $condicion","$orden ASC",$conn);
else
  $papas=busca_filtro_tabla("*",$tabla,"cod_padre=".$serie.$activo.$condicion,"$orden ASC",$conn); 

if($papas["numcampos"])
{ 
  for($i=0; $i<$papas["numcampos"]; $i++)
  {
    $hijos = busca_filtro_tabla("count(*) AS cant",$tabla,"cod_padre=".$papas[$i]["id$tabla"].$activo.$condicion,"",$conn);
		if(in_array($papas[$i]["id$tabla"],$excluido))continue;
    echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
    $cadena_codigo='';
    if(@$papas[$i]["codigo"]){
      $cadena_codigo="(".$papas[$i]["codigo"].")";
    }
    echo("text=\"".htmlspecialchars(($papas[$i]["nombre"])).$cadena_codigo." \" id=\"".$papas[$i]["id$tabla"]."\"");
    if($hijos[0]["cant"]!=0 && ($tabla=="serie" || @$_REQUEST["sin_padre"]))
      echo(" nocheckbox=\"1\" "); 
    if(in_array($papas[$i]["id$tabla"],$seleccionado)!==false)
      echo " checked=\"1\" ";  
    if($hijos[0][0])
      echo(" child=\"1\">\n");
    else
      echo(" child=\"0\">\n");
    llena_serie($papas[$i]["id$tabla"]);
    echo("</item>\n");
  }     
}
return;
}
?>
