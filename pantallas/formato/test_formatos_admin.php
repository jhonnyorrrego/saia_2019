<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once($ruta_db_superior . "db.php");
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
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") )
{
  header("Content-type: application/xhtml+xml");
}
else
{
  header("Content-type: text/xml");
}
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
if($id and $id<>""){
  echo("<tree id=\"0\">\n");
  $dato_papa=busca_filtro_tabla("",$tabla,"id".$tabla."=".$id,"",$conn);

  if(@$_REQUEST["cargar_dato_padre"]){
    if($dato_papa["numcampos"]){
       echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
      $cadena_codigo='';
      if(@$dato_papa[0]["codigo"]){
        $cadena_codigo="(".$dato_papa[0]["codigo"].")";
      }
      echo("text=\"".htmlspecialchars($dato_papa[0]["nombre"]).$cadena_codigo." \" id=\"".$dato_papa[0]["id".$tabla]."\">");
			validar_vistas($dato_papa[0]["id".$tabla]);
    }
  }
}
else
  echo("<tree id=\"0\">\n");
if($tabla=="serie")
  {if(isset($_REQUEST["categoria"])&&$_REQUEST["categoria"])
   {switch($_REQUEST["categoria"])
      {case 1:echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Comunicaciones Oficiales\" id=\"1-categoria-Comunicaciones Oficiales\" >\n";
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
   elseif($id){
   	llena_serie($id);
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
else
{
if($id and $id<>""){
  llena_serie($id);
  if(@$_REQUEST["cargar_dato_padre"] && $dato_papa["numcampos"]){
    echo("</item>\n");
  }
}
else
  llena_serie("NULL");
}
echo("</tree>\n");
$activo = "";
?>
<?php

function llena_serie($serie,$condicion=""){
global $conn,$tabla,$seleccionado,$activo;
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
    echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
    $cadena_codigo='';
    if(@$papas[$i]["codigo"]){
      $cadena_codigo="(".$papas[$i]["codigo"].")";
    }
    echo("text=\"".htmlspecialchars(($papas[$i]["nombre"])).$cadena_codigo." \" id=\"".$papas[$i]["id$tabla"]."\"");
    if($hijos[0]["cant"]!=0 && (@$_REQUEST["sin_padre"]))
      echo(" nocheckbox=\"1\" ");
    if(in_array($papas[$i]["id$tabla"],$seleccionado)!==false)
      echo " checked=\"1\" ";
    if($hijos[0][0])
      echo(" child=\"1\">\n");
    else
      echo(" child=\"0\">\n");
    llena_serie($papas[$i]["id$tabla"]);
		validar_vistas($papas[$i]["id$tabla"]);
    echo("</item>\n");
  }
}
return;
}
function validar_vistas($id){
	return "";
	$vistas=busca_filtro_tabla("","vista_formato A","formato_padre=".$id,"",$conn);
	if($vistas["numcampos"]){
		echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Vistas\" id=\"vistasmenu_".$id."\" nocheckbox=\"1\" child=\"1\" >");
		for($i=0;$i<$vistas["numcampos"];$i++){
			echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"".$vistas[$i]["etiqueta"]."\" id=\"".$vistas[$i]["idvista_formato"]."_v\"></item>");
		}
		echo("</item>");
	}
}
?>