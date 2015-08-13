<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
include_once("../../db.php");
$id = @$_GET["id"];
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") )
{
  header("Content-type: application/xhtml+xml");
}
else
{
  header("Content-type: text/xml");
}
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
if($id && $id[0]=="f")
  echo("<tree id=\"".$id."\">\n");
else
  echo("<tree id=\"0\">\n");
llena_formato($id);
echo("</tree>\n");
?>
<?php

function llena_formato($id){
global $conn,$sql;
$papas["numcampos"]=0;
$ldescripcion=array();
$texto="";
if($id=="NULL"){
    echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Seleccione un Documento Valido \" id=\"-1\" child=\"0\" ></item>");
    return;
}
else{
  $datos=explode("-",$_REQUEST["id"]);
  $id=substr($datos[0],1);
  //$tipo=$datos[0][0];
  $tabla=$datos[1];
  $campo_descripcion=$datos[2];
  $idformato=$datos[3];
  if(@$id && @$id!=""){
    $papas=busca_filtro_tabla("idformato AS llave, etiqueta AS etiqueta,nombre_tabla","formato","cod_padre=".$idformato,"",$conn);
  }
}

//print_r($papas);
for($i=0; $i<$papas["numcampos"]; $i++){
  $campo=busca_filtro_tabla("","campos_formato","formato_idformato=".$papas[$i]["llave"]." AND (acciones LIKE '%d%' OR (valor=".$idformato." AND etiqueta_html='detalle'))","",$conn);
  $campo_enlace="";
  $campo_descripcion="";
  for($j=0;$j<$campo["numcampos"];$j++){
    if($campo[$j]["etiqueta_html"]!="detalle" && $campo_descripcion=="")
      $campo_descripcion=$campo[$j]["nombre"];
    else $campo_enlace=$campo[$j]["nombre"];
  }
  $texto.=etiqueta(array($papas[$i]["etiqueta"],"f".$papas[$i]["llave"],$papas[$i]["nombre_tabla"],$campo_descripcion,$papas[$i]["llave"]));
  $hijos = busca_filtro_tabla($campo_descripcion.",id".$papas[$i]["nombre_tabla"]." AS id",$papas[$i]["nombre_tabla"],$campo_enlace."=".$id,"",$conn);
  for($h=0;$h<$hijos["numcampos"];$h++){
    $texto.=etiqueta(array($hijos[$h][$campo_descripcion],"h".$hijos[$h]["id"],$papas[$i]["nombre_tabla"],$campo_descripcion,$papas[$i]["llave"]));
    $texto.="</item>";
  }
  //llena_serie($papas[$i]["id$tabla"]);
  $texto.='</item>';
}
echo($texto);
return;
}
function etiqueta($arreglo){
//print_r($arreglo);
  $cad=('<item style="font-family:verdana; font-size:7pt;" child="1" ');
  $cad.=('text="'.delimita(htmlspecialchars($arreglo[0]),30).' " id="'.$arreglo[1].'-'.$arreglo[2].'-'.$arreglo[3].'-'.$arreglo[4].'">');
  $cad.=('<userdata name="tabla">'.$arreglo[2].'</userdata>');
  $cad.=('<userdata name="campo_descripcion">'.$arreglo[3].'</userdata>');
  $cad.=('<userdata name="formato">'.$arreglo[4].'</userdata>');
return($cad);
}
?>
