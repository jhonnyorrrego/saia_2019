<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; }
$id = @$_REQUEST["id"];
$activo="";
if(isset($_REQUEST["estado"]) && $_REQUEST["estado"]!=""){
 $activo = " and estado = 1"; 
}
if(isset($_REQUEST["seleccionado"]))
  $seleccionado=explode(",",$_REQUEST["seleccionado"]);
else
  $seleccionado=array();  
if(stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) { 
  header("Content-type: application/xhtml+xml"); 
} 
else { 
  header("Content-type: text/xml"); 
}
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
echo("<tree id=\"0\">\n");  
include_once($ruta_db_superior."db.php");
if($id){
  $inicio=busca_filtro_tabla("","cargo","idcargo=".$id.$activo,"",$conn);
  echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
  echo("text=\"".htmlspecialchars(($inicio[0]["nombre"]))."(".$inicio[0]["codigo"].") \" id=\"".$inicio[0]["idcargo"]."\" checked=\"1\" >\n");
  llena_cargo($id);
  echo("</item>\n");
}
else{
  echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
  echo("text=\"Cargos\" id=\"1-cargo\"  nocheckbox=\"1\">\n");
  llena_cargo("NULL"," AND tipo_cargo=1");
  echo("</item>\n");
  echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
  echo("text=\"Funci&#243;n administrativa\" id=\"2-cargo\" nocheckbox=\"1\">\n");
  llena_cargo("NULL"," AND tipo_cargo=2");
  echo("</item>\n");
  echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
  echo("text=\"Cualquier usuario\" id=\"-1\" >\n");
  echo("</item>\n");
}  
echo("</tree>\n");
function llena_cargo($llave,$condicion=""){
  global $conn,$seleccionado,$activo,$id;
if($llave=="NULL")
  $papas=busca_filtro_tabla("","cargo","(cod_padre IS NULL OR cod_padre=0) ".$activo." ".$condicion,"nombre ASC",$conn);
else
  $papas=busca_filtro_tabla("","cargo","cod_padre=".$llave.$activo.$condicion,"nombre ASC",$conn);
if($papas["numcampos"]){ 
  for($i=0; $i<$papas["numcampos"]; $i++){
    $hijos = busca_filtro_tabla("count(*)","cargo","cod_padre=".$papas[$i]["id$tabla"].$activo.$condicion,"",$conn);
    echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
    echo("text=\"".htmlspecialchars(($papas[$i]["nombre"]))."(".$papas[$i]["codigo"].") \" id=\"".$papas[$i]["idcargo"]."\"");
    if(in_array($papas[$i]["idcargo"],$seleccionado)!==false)
      echo " checked=\"1\" ";  
    if($hijos[0][0])
      echo(" child=\"1\">\n");
    else
      echo(" child=\"0\">\n");
    llena_cargo($papas[$i]["idcargo"],$condicion);
    echo("</item>\n");
  }     
}
return;
}
?>
