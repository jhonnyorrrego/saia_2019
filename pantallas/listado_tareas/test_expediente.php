<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
?>
<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) { 
  header("Content-type: application/xhtml+xml"); 
} 
else { 
  header("Content-type: text/xml"); 
}
include_once($ruta_db_superior."db.php");
$exp_doc=array();
$id=@$_REQUEST["inicia"];
$excluidos=array();
if(@$_REQUEST["excluidos"])
  $excluidos=explode(",",$_REQUEST["excluidos"]);
if(@$_REQUEST["doc"]){
  $documento=busca_filtro_tabla("","expediente_doc","documento_iddocumento=".$_REQUEST["doc"],"",$conn);
  $exp_doc=extrae_campo($documento,"expediente_idexpediente","U");
}
$funcionarios=array();
$idfunc=usuario_actual("idfuncionario");
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
echo("<tree id=\"0\">\n");
llena_expediente($id);
echo("</tree>\n");
?>
<?php

function llena_expediente($id){
global $conn,$sql,$exp_doc,$funcionarios,$excluidos,$ruta_db_superior;
include_once($ruta_db_superior."permisos_tabla.php");
if($id==0){
  $papas=busca_filtro_tabla("*","expediente","(cod_padre=0 OR cod_padre IS NULL)","nombre ASC",$conn);
}
else{
  $papas=busca_filtro_tabla("*","expediente","cod_padre=".$id,"nombre ASC",$conn);
}    
if($papas["numcampos"]){ 
  for($i=0; $i<$papas["numcampos"]; $i++){
    $permitido=0;
    $permisos_exp=busca_filtro_tabla("editar_todos,propietario","expediente","idexpediente=".$papas[$i]["idexpediente"],"",$conn);
    if(@$permisos_fun[0]["editar"]||$permisos_exp[0]["editar_todos"]||$permisos_exp[0]["propietario"]==usuario_actual("funcionario_codigo"))
      $permitido=1;
    if(!in_array($papas[$i]["idexpediente"],$excluidos)){
      echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
      echo("text=\"".htmlspecialchars($papas[$i]["nombre"])." \" id=\"".$papas[$i]["idexpediente"]."\"");
      if(@$_REQUEST["doc"]){
        if($_REQUEST["accion"]==1 && in_array($papas[$i]["idexpediente"],$exp_doc))
          echo(" nocheckbox=\"1\" ");
        elseif($_REQUEST["accion"]==0 && !in_array($papas[$i]["idexpediente"],$exp_doc))
          echo(" nocheckbox=\"1\" ");       
      }
      elseif(@$_REQUEST["seleccionado"]&&$_REQUEST["seleccionado"]==$papas[$i]["idexpediente"])
        echo " checked=\"1\" ";
      if(!$permitido)
        echo(" nocheckbox=\"1\" ");    
      echo(">");
      llena_expediente($papas[$i]["idexpediente"]);
      echo("</item>\n");
    } 
  }     
}
return;
}
?>