<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0
$tabla = @$_REQUEST["tabla"];
$id = @$_REQUEST["id"];
$activo="";
if(isset($_REQUEST["estado"]) && $_REQUEST["estado"]!="")
{
 $activo = " and estado = 1"; 
}
if(isset($_REQUEST["seleccionado"]))
  $seleccionado=explode(",",$_REQUEST["seleccionado"]);
else
  $seleccionado=array(); 
   
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) 
{ 
  header("Content-type: application/xhtml+xml"); 
} 
else 
{ 
  header("Content-type: text/xml"); 
}
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
echo("<tree id=\"0\">\n");  
include_once("db.php");
//si paso las series seleccionadas, para que marque las entidades relacionadas
if(isset($_REQUEST["series"]) && $tabla<>"serie")
{$nuevas=array();
 $series=explode(",",$_REQUEST["series"]);
 for($i=0;$i<count($series);$i++)//quito las categorias de la lista de series
  {if(strpos($series[$i],"-")==false)
     $nuevas[]=$series[$i];
  }
 $_REQUEST["series"]=implode(",",$nuevas); 
 $asignados=busca_filtro_tabla("distinct llave_entidad","entidad_serie,entidad","entidad_identidad=identidad and serie_idserie=".implode(" and serie_idserie=",$series)." and entidad.nombre='$tabla'","",$conn); 
 $seleccionado=extrae_campo($asignados,"llave_entidad","U");
}
//si paso la entidad, para que marque las series relacionadas
if(@$_REQUEST["tipo_entidad"] && @$_REQUEST["llave_entidad"])
{if($tabla=="serie")
   {$asignados=busca_filtro_tabla("distinct serie_idserie","entidad_serie","entidad_identidad=".$_REQUEST["tipo_entidad"]." and llave_entidad=".$_REQUEST["llave_entidad"],"",$conn); 
    $seleccionado=extrae_campo($asignados,"serie_idserie","U");
   }
 else
   $seleccionado=array($_REQUEST["llave_entidad"]);   
}
  
if($id)
{$inicio=busca_filtro_tabla("*",$tabla,"id$tabla=$id","",$conn);
 echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
 echo("text=\"".htmlspecialchars(($inicio[0]["nombre"]))."(".$inicio[0]["codigo"].") \" id=\"".$inicio[0]["id$tabla"]."\" checked=\"1\" >\n");
 llena_serie($id);
 echo("</item>\n");
}
elseif($tabla=="serie")
  {if(!$id)
     $id="NULL";
   if(isset($_REQUEST["categoria"])&&$_REQUEST["categoria"])
   {switch($_REQUEST["categoria"])
      {case 1:echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Comunicaciones Oficiales\" id=\"1-categoria-Comunicaciones Oficiales\" >\n"; 
       llena_serie($id," and categoria=1 ");
   echo "</item>\n";
              break;
       case 2:echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Produccion Documental\" id=\"2-categoria-Produccion Documental\" >\n"; 
       llena_serie($id," and categoria=2 ");
   echo "</item>\n";
              break;
       case 3: echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Otras categorias\" id=\"3-categoria-Otras categorias\" >\n"; 
       llena_serie($id," and categoria=3 ");
   echo "</item>\n";
              break;       
      }
   }
   else
   { 
   echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Comunicaciones Oficiales\" id=\"1-categoria-Comunicaciones Oficiales\"  >\n"; 
       llena_serie($id," and categoria=1 ");
   echo "</item>\n";
   echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Produccion Documental\" id=\"2-categoria-Produccion Documental\" >\n"; 
       llena_serie($id," and categoria=2 ");
   echo "</item>\n";
   echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Otras categorias\" id=\"3-categoria-Otras categorias\" >\n"; 
       llena_serie($id," and categoria=3 ");
   echo "</item>\n";
   }
  }
else
{
  llena_serie("NULL");
}  
echo("</tree>\n");
$activo = "";


function llena_serie($serie,$condicion=""){
global $conn,$tabla,$seleccionado,$activo,$id;
if($serie=="NULL")
  $papas=busca_filtro_tabla("*",$tabla,"(cod_padre IS NULL OR cod_padre=0) $activo $condicion","nombre ASC",$conn);
else
  $papas=busca_filtro_tabla("*",$tabla,"cod_padre=".$serie.$activo.$condicion,"nombre ASC",$conn);
if($papas["numcampos"])
{ 
  for($i=0; $i<$papas["numcampos"]; $i++)
  {
    $hijos = busca_filtro_tabla("count(*)",$tabla,"cod_padre=".$papas[$i]["id$tabla"].$activo.$condicion,"",$conn);
    echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
    echo("text=\"".htmlspecialchars(($papas[$i]["nombre"]))."(".$papas[$i]["codigo"].") \" id=\"".$papas[$i]["id$tabla"]."\"");
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
