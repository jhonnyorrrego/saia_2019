<?php 
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0
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
$where_id="";
if(@$id != ""){
  $where_id=" and idpantalla=".$id;
  echo("<tree id=\"".$id."\">\n");
}   
else{
  $where_id="";
  echo("<tree id=\"0\">\n");
}    
include_once($ruta_db_superior."db.php");
if(@$_REQUEST["tipo_pantalla"]){
  switch($_REQUEST["tipo_pantalla"]){
    case 1:
      echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Sistema\" id=\"1-sistema\"  nocheckbox=\"1\">\n"; 
        llena_pantalla("NULL"," and tipo_pantalla=1 ".$where_id);
      echo "</item>\n";
    break;
    case 2:
      echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Formato\" id=\"2-formato\" nocheckbox=\"1\">\n"; 
        llena_pantalla("NULL"," and tipo_pantalla=2 ".$where_id);
      echo "</item>\n";
    break;
    case 3: 
      echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Auxiliar\" id=\"3-auxiliar\" nocheckbox=\"1\">\n"; 
        llena_pantalla("NULL"," and tipo_pantalla=3 ".$where_id);
      echo "</item>\n";
    break;
    case 4: 
      echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Clase\" id=\"3-clase\" nocheckbox=\"1\">\n"; 
        llena_pantalla("NULL"," and tipo_pantalla=4 ".$where_id);
      echo "</item>\n";
    break;       
  }
}
else{
  echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Sistema\" id=\"1-sistema\"  nocheckbox=\"1\">\n"; 
  llena_pantalla("NULL"," and tipo_pantalla=1 ".$where_id);
  echo "</item>\n";
  echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Formato\" id=\"2-formato\"  nocheckbox=\"1\">\n"; 
  llena_pantalla("NULL"," and tipo_pantalla=2 ".$where_id);
  echo "</item>\n";
  echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Auxiliar\" id=\"3-auxiliar\"  nocheckbox=\"1\">\n"; 
  llena_pantalla("NULL"," and tipo_pantalla=3 ".$where_id);
  echo "</item>\n";  
}
echo("</tree>\n");
$activo = "";
?>
<?php

function llena_pantalla($pantalla,$condicion=""){
global $conn,$seleccionado,$activo,$excluido;
if(isset($_REQUEST["orden"]))
  $orden=$_REQUEST["orden"];
else
  $orden="";
if($pantalla=="NULL")
  $papas=busca_filtro_tabla("*","pantalla","(cod_padre IS NULL OR cod_padre=0) ".$activo.$condicion,$orden,$conn);
else
  $papas=busca_filtro_tabla("*","pantalla","cod_padre=".$pantalla.$activo.$condicion,$orden,$conn); 

if($papas["numcampos"]){ 
  for($i=0; $i<$papas["numcampos"]; $i++){
    $hijos = busca_filtro_tabla("count(*) AS cant",$tabla,"cod_padre=".$papas[$i]["id$tabla"].$activo.$condicion,"",$conn);
		if(in_array($papas[$i]["idpantalla"],$excluido))continue;
    echo("<item style=\"font-family:verdana; font-size:7pt;\" ");    
    echo("text=\"".htmlspecialchars(($papas[$i]["etiqueta"]))." \" id=\"".$papas[$i]["idpantalla"]."\"");
    if($hijos[0]["cant"]!=0 && @$_REQUEST["sin_padre"])
      echo(" nocheckbox=\"1\" "); 
    if(in_array($papas[$i]["idpantalla"],$seleccionado)!==false)
      echo " checked=\"1\" ";  
    if($hijos[0][0])
      echo(" child=\"1\">\n");
    else
      echo(" child=\"0\">\n");
    llena_pantalla($papas[$i]["idpantalla"]);
    echo("</item>\n");
  }     
}
return;
}
?>