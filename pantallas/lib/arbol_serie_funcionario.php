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
include_once($ruta_db_superior."pantallas/funcionario/class_funcionario_adicionales.php");
$funcionario=usuario_actual("id");
$clase_funcionario=new funcionario($funcionario);
$clase_funcionario->get_series();
$arreglo_series=extrae_campo($clase_funcionario->series_funcionario,"idserie");
$seleccionado=array();
if(isset($_REQUEST["seleccionado"]))
  $seleccionado=explode(',',$_REQUEST["seleccionado"]);
$datos=array();
$datos["series"]=$arreglo_series;
$datos["series_encontradas"]=0;
if($id!=""){
$valor=$id;
$padre=" and idserie=".$id."";
}
 
if($id==""){
   echo  "\n<tree id=\"0\">\n";
   echo "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Comunicaciones Oficiales\" id=\"cat1\" nocheckbox=\"1\" >\n"; 
   echo llena_serie("NULL"," and categoria=1 ");
   echo "</item>\n";
   
   echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Produccion Documental\" id=\"cat2\" nocheckbox=\"1\" >\n"; 
   echo llena_serie("NULL"," and categoria=2 ",$padre);
   echo "</item>\n";
   echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Otras categorias\" id=\"cat3\" nocheckbox=\"1\" >\n"; 
   echo  llena_serie("NULL"," and categoria=3 ");
   echo "</item>\n";
echo("</tree>\n");
} 
if($id!=""){
   echo  "\n<tree id=\"0\">\n";
	if($id==1){
	   echo "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Comunicaciones Oficiales\" id=\"cat1\" nocheckbox=\"1\" >\n"; 
	   echo llena_serie("NULL"," and categoria=1 ", $padre);
	   echo "</item>\n";
	}
	if($id==2){
	   echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Produccion Documental\" id=\"cat2\" nocheckbox=\"1\" >\n"; 
	   echo llena_serie("NULL"," and categoria=2 ",$padre);
	   echo "</item>\n";
	}
	if($id==3){
	   echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Otras categorias\" id=\"cat3\" nocheckbox=\"1\" >\n"; 
	   echo  llena_serie("NULL"," and categoria=3 ", $padre);
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
 $papas=busca_filtro_tabla("nombre,codigo,idserie,cod_padre","serie","idserie in($lista) and (cod_padre IS NULL OR cod_padre=0) $condicion $padre","nombre",$conn);                      
}
else
 {$papas=busca_filtro_tabla("nombre,codigo,idserie,cod_padre","serie","idserie in($lista) and cod_padre=$serie $condicion","nombre",$conn);
}

if($papas["numcampos"]>0)
{ 
  for($i=0; $i<$papas["numcampos"]; $i++)
  { 
    if(!@$_REQUEST["solo_papas"])
      $hijos=llena_serie($papas[$i]["idserie"]);
    $texto.=("\n<item style=\"font-family:verdana; font-size:7pt;\" ");
    $texto.= "text=\"".ucwords(htmlentities($papas[$i]["nombre"]))."(".strtoupper($papas[$i]["codigo"]).") \" ";
    if($hijos<>"")
      $texto.=" nocheckbox=\"1\""; 
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
$codificada=utf8_decode(html_entity_decode(htmlentities($original)));
return($codificada);
}
?>
