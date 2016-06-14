<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0
$tabla = @$_GET["tabla"];
$id = @$_GET["id"];
if(isset($_REQUEST["estado"]) && $_REQUEST["estado"]!="")
{
 $activo = " and estado = 1"; 
}
if(isset($_REQUEST["seleccionado"]))
  $seleccionado=explode(",",$_REQUEST["seleccionado"]);
else
  $seleccionado=array(); 
if(isset($_REQUEST["condicion"]))
  $condicion=" AND ".$_REQUEST["condicion"];
else
  $condicion="";    
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) 
{ 
  header("Content-type: application/xhtml+xml"); 
} 
else 
{ 
  header("Content-type: text/xml"); 
}
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
if($id and $id<>"")
  echo("<tree id=\"".$id."\">\n"); 
else
  echo("<tree id=\"0\">\n");



  
include_once("db.php");
if($tabla=="serie")
  {if(isset($_REQUEST["categoria"])&&$_REQUEST["categoria"])
   {switch($_REQUEST["categoria"])
      {case 1:echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Comunicaciones Oficiales\" id=\"cat1\" nocheckbox=\"true\">\n"; 
       llena_serie("NULL"," and categoria=1 ");
   echo "</item>\n";
              break;
       case 2:echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Produccion Documental\" id=\"cat2\" nocheckbox=\"true\">\n"; 
       llena_serie("NULL"," and categoria=2 ");
   echo "</item>\n";
              break;
       case 3: echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Otras categorias\" id=\"cat3\" nocheckbox=\"true\">\n"; 
       llena_serie("NULL"," and categoria=3 ");
   echo "</item>\n";
              break;       
      }
   }
   else
   {
   echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Comunicaciones Oficiales\" id=\"cat1\"  nocheckbox=\"true\">\n"; 
       llena_serie("NULL"," and categoria=1 ");
   echo "</item>\n";
   echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Produccion Documental\" id=\"cat2\" nocheckbox=\"true\">\n"; 
       llena_serie("NULL"," and categoria=2 ");
   echo "</item>\n";
   echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Otras categorias\" id=\"cat3\" nocheckbox=\"true\">\n"; 
       llena_serie("NULL"," and categoria=3 ");
   echo "</item>\n";
   }
  }
else
{ //ECHO $condicion ;
if($id and $id<>"")
  llena_serie($id,$condicion);
else
  llena_serie("NULL",$condicion);
}
if(!$_REQUEST['no_fondos']){ 
echo "<item style=\"font-family:verdana; font-size:7pt;\" text=\"FONDO DEPARTAMENTAL DE EDUCACION\" id=\"17196\">\n";
  echo "</item>\n";
  echo "<item style=\"font-family:verdana; font-size:7pt;\" text=\"FONDO DEPARTAMENTAL DE SALUD\" id=\"17197\">\n"; 
  echo "</item>\n";
}
echo("</tree>\n");
$activo = "";
?>
<?php
$i = 0;
function llena_serie($serie,$condicion=""){
global $conn,$tabla,$seleccionado,$activo;
$i++;
if($i==100){
  die();
  return;
}
if($serie=="NULL")
  $papas=busca_filtro_tabla("*",$tabla,"cod_padre=1 and estado=1 AND nombre LIKE 'SECRETARIA%' $activo $condicion","nombre ASC",$conn);
  
  //$papas=busca_filtro_tabla("*",$tabla,"cod_padre=1 and estado=1 AND (nombre LIKE 'SECRETARIA%' OR lower(nombre) LIKE 'despacho%del%gobernador%') $activo $condicion","nombre ASC",$conn);
else
  {if($tabla=="serie")
     $condicion="";
   $papas=busca_filtro_tabla("*",$tabla,"cod_padre=".$serie.$activo.$condicion,"nombre ASC",$conn);
  }
  //PRINT_R($papas);
if($papas["numcampos"])
{ 
  for($i=0; $i<$papas["numcampos"]; $i++)
  {
  	if(!$_REQUEST["no_hijos"]){
    $hijos = busca_filtro_tabla("count(*)",$tabla,"cod_padre=".$papas[$i]["id$tabla"].$activo.$condicion,"",$conn);
	}
    echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
    echo("text=\"".htmlspecialchars(($papas[$i]["nombre"]))."(".$papas[$i]["codigo"].") \" id=\"".$papas[$i]["id$tabla"]."\"");	
	
    if(in_array($papas[$i]["id$tabla"],$seleccionado)!==false)
      echo " checked=\"1\" ";  
    if($hijos[0][0])
      echo(" child=\"1\">\n");
    else
      echo(" child=\"0\">\n");
    //llena_serie($papas[$i]["id$tabla"],$condicion);
    echo("</item>\n");
  }     
  echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
    echo("text=\"".htmlspecialchars(('DESPACHO DEL GOBERNADOR'))."(0001) \" id=\"2\"");	
	
    if(in_array($papas[$i]["id$tabla"],$seleccionado)!==false)
      echo " checked=\"1\" ";  
    if($hijos[0][0])
      echo(" child=\"1\">\n");
    else
      echo(" child=\"0\">\n");
    //llena_serie($papas[$i]["id$tabla"],$condicion);
    echo("</item>\n");
}
return;
}
?>
