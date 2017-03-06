<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 ISO-8859-1
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."pantallas/documento/class_documento_informacion.php");
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml")){ 
  header("Content-type: application/xhtml+xml"); 
} 
else{ 
  header("Content-type: text/xml"); 
}
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");

if(@$_REQUEST["seleccionado"])
   $seleccionados=explode(",",$_REQUEST["seleccionado"]);
else
  $seleccionados=array();
echo("<tree id='0'>\n");
echo(llena_documentos_seleccionados());
echo("</tree>\n");
function llena_documentos_seleccionados(){
global $conn,$seleccionados;
$where_doc='';
if(@$_REQUEST["iddocumento"]){
  $where_doc=" AND B.iddocumento <>".$_REQUEST["iddocumento"];
}
$funcionario=usuario_actual("idfuncionario");
$documentos=busca_filtro_tabla("","documento_por_vincular A, documento B","A.documento_iddocumento=B.iddocumento AND A.funcionario_idfuncionario=".$funcionario.$where_doc,"",$conn);
for($i=0;$i<$documentos["numcampos"];$i++){
  echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"No.".$documentos[$i]["numero"]." - ".delimita(codifica_encabezado(html_entity_decode(strip_tags($documentos[$i]["descripcion"]))),500)."\" id=\"documento_".$documentos[$i]["documento_iddocumento"]."\">");
  llenado_paginas_documento($documentos[$i]["documento_iddocumento"]);  
  llenado_anexos_documento($documentos[$i]["documento_iddocumento"]);
  echo("</item>\n"); 
}  
}
function llenado_paginas_documento($iddoc){
  $paginas=paginas_documento($iddoc,1);
  if($paginas["numcampos"]){
    echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"P&#225;ginas\" id=\"lpaginas_".$iddoc."_".$paginas["numcampos"]."\">");
    for($i=0;$i<$paginas["numcampos"];$i++){
      echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"P&#225;gina ".$paginas[$i]["pagina"]."\" id=\"pagina_".$paginas[$i]["consecutivo"]."_".$iddoc."\">");  
      echo("</item>\n");  
    }
    echo("</item>\n");
  }    
}
function llenado_anexos_documento($iddoc){
  $anexos=anexos_documento($iddoc,1);
  if($anexos["numcampos"]){
    echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Anexos\" id=\"lanexos_".$iddoc."_".$anexos["numcampos"]."\">");
    for($i=0;$i<$anexos["numcampos"];$i++){
      echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"".codifica_encabezado(html_entity_decode($anexos[$i]["etiqueta"]))."\" id=\"anexo_".$anexos[$i]["idanexos"]."_".$iddoc."\">");
      echo("</item>\n");
    }
    echo("</item>\n");
  }  
}
?>