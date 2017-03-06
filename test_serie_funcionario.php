<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0
$id = @$_GET["id"];    
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) 
{ 
 header("Content-type: application/xhtml+xml"); 
} 
else 
{ 
  header("Content-type: text/xml"); 
}
if(!isset($_SESSION)){
  session_start();
} 
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");

include_once("db.php");
include_once("class.funcionarios.php");
$seleccionado=array();
if(isset($_REQUEST["seleccionado"]))
  $seleccionado=explode(',',$_REQUEST["seleccionado"]);

$funcionario=usuario_actual("id"); 
$datos = busca_datos_administrativos_funcionario($funcionario);
$datos["series_encontradas"]=0;
if($id!=""){
$valor=$id;
//$padre=" and idserie=".$id."";
}
else{
	$id="NULL";
}
$categoria=$_REQUEST["categoria"];
if($categoria==""){
   echo  "\n<tree id=\"0\">\n";
   echo "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Comunicaciones Oficiales\" id=\"cat1\" nocheckbox=\"1\" >\n"; 
   echo llena_serie($id," and categoria=1 ");
   echo "</item>\n";
   
   echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Produccion Documental\" id=\"cat2\" nocheckbox=\"1\" >\n"; 
   echo llena_serie($id," and categoria=2 ",$padre);
   echo "</item>\n";
   echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Otras categorias\" id=\"cat3\" nocheckbox=\"1\" >\n"; 
   echo  llena_serie($id," and categoria=3 ");
   echo "</item>\n";
echo("</tree>\n");
} 
if($categoria!=""){
   echo  "\n<tree id=\"0\">\n";
	if($categoria==1){
	   echo "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Comunicaciones Oficiales\" id=\"cat1\" nocheckbox=\"1\" >\n"; 
	   echo llena_serie($id," and categoria=1 ", $padre);
	   echo "</item>\n";
	}
	if($categoria==2){
	   echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Produccion Documental\" id=\"cat2\" nocheckbox=\"1\" >\n"; 
	   echo llena_serie($id," and categoria=2 ",$padre);
	   echo "</item>\n";
	}
	if($categoria==3){
	   echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Otras categorias\" id=\"cat3\" nocheckbox=\"1\" >\n"; 
	   echo  llena_serie($id," and categoria=3 ", $padre);
	   echo "</item>\n";
	} 
echo("</tree>\n");
} 

?>
<?php

function llena_serie($serie,$condicion="",$padre=""){ 
global $conn,$datos,$seleccionado;
$lista_papas = array();
$texto="";
$lista= "'".implode("','",$datos["series"])."'";
$hijos="";
if($serie=="NULL")
{
 $papas=busca_filtro_tabla("nombre,codigo,idserie,cod_padre","serie","idserie in($lista) and (cod_padre IS NULL OR cod_padre=0) $condicion $padre","nombre ASC",$conn);
}
else
 {$papas=busca_filtro_tabla("nombre,codigo,idserie,cod_padre","serie","idserie in($lista) and cod_padre=$serie $condicion","nombre ASC",$conn);
}

if($papas["numcampos"]>0)
{ 
  for($i=0; $i<$papas["numcampos"]; $i++)
  { 
    if(!@$_REQUEST["solo_papas"])
      $hijos=llena_serie($papas[$i]["idserie"]);
    $texto.=("\n<item style=\"font-family:verdana; font-size:7pt;\" ");
    $texto.= "text=\"".ucwords(($papas[$i]["nombre"]))."(".strtoupper($papas[$i]["codigo"]).") \" ";
    if($hijos<>""){
    	if(!@$_REQUEST["con_padres"])
      	$texto.=" nocheckbox=\"1\"";
		} 
    elseif(in_array($papas[$i]["idserie"],$seleccionado))
      $texto.=" checked=\"true\"";           
    $texto.=" id=\"".$papas[$i]["idserie"]."\">".$hijos;   
    $texto.=("</item>\n");
    $datos["series_encontradas"]++;
  }     
}//nocheckbox=1

return $texto;
}

function codifica_caracteres($original){
$codificada=codifica_encabezado(html_entity_decode(($original)));
return($codificada);
}
?>
