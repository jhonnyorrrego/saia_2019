<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0
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
if(@$_REQUEST["idcaja"]){
	$idcaja=@$_REQUEST["idcaja"];
}
if(@$_REQUEST["idcarpeta"]){
	$idcarpeta=@$_REQUEST["idcarpeta"];
}
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
  echo("<tree id=\"0\">\n"); 
else
  echo("<tree id=\"0\">\n");
include_once($ruta_db_superior."db.php");

if($idcaja){
	$caja=busca_filtro_tabla("","caja","idcaja=".$idcaja,"",$conn);
	$descripcion=ucfirst(strtolower($caja[0]["fondo"]));
}
if($idcarpeta){
	$carpeta=busca_filtro_tabla("","folder","idfolder=".$idcarpeta,"",$conn);
	$descripcion=ucfirst(strtolower($carpeta[0]["fondo"]));
}

echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"prueba\" id=\"".$idcaja."-caja\" nocheckbox=\"1\">\n");
if($idcaja)
  llena_carpetas($idcaja);
echo("</item>");
echo("</tree>\n");
?>
<?php

function llena_carpetas($idcaja){
global $conn,$sql;
$carpetas=busca_filtro_tabla("","folder","caja_idcaja=".$idcaja,"",$conn);

if($carpetas["numcampos"])
{ 
  for($i=0; $i<$carpetas["numcampos"]; $i++)
  {	
    echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
    echo("text=\"".htmlspecialchars(ucfirst(strtolower($carpetas[$i]["nombre_expediente"])))."\" id=\"".$carpetas[$i]["idfolder"]."-carpeta\" ");
    echo(" child=\"0\">\n");
    echo("</item>\n");
  }     
}
return;
}
?>
