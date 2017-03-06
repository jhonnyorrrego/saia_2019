<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0 ISO-8859-1*/
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") )
{
  header("Content-type: application/xhtml+xml");
}
else
{
  header("Content-type: text/xml");
}
$imagenes="";
$texto= "<?xml version=\"1.0\" encoding=\"UTF-8\"?"."><tree id=\"0\">\n";
include_once("db.php");
$texto.=llenar_datos(0);
$texto.= "</tree>\n";
echo $texto;

function decodifica($cadena){
return(codifica_encabezado(html_entity_decode($cadena)));
}

function llenar_datos($id)
{global $conn;  $texto="";
 if($id==0)
  $condicion=" and cod_padre is null";
 else
  $condicion="and cod_padre=$id";
 $estructura=busca_filtro_tabla("idft_estructura_contratos,etiqueta,campos","ft_estructura_contratos,documento","documento_iddocumento=iddocumento ".$condicion,"lower(etiqueta)",$conn);
 if($estructura["numcampos"])
 {for($i=0;$i<$estructura["numcampos"];$i++)
  {$texto.= '<item style="font-family:verdana; font-size:7pt;" text="'.decodifica($estructura[$i]["etiqueta"]).'" id="'.$estructura[$i]["idft_estructura_contratos"].'" ';
   if(@$_REQUEST["filtrar_padres"] && $estructura[$i]["campos"]=="")
     $texto.=' nocheckbox="1" '; 
   $texto.='>';
   $texto.=llenar_datos($estructura[$i]["idft_estructura_contratos"]) ;
   $texto.='</item>';
  }
  return($texto);
 }
 else
  return false;   
}  

?>