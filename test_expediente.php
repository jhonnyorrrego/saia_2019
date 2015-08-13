<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) 
{ 
  header("Content-type: application/xhtml+xml"); 
} 
else 
{ 
 header("Content-type: text/xml"); 
}
include_once("db.php");
include_once("class.funcionarios.php");
include_once("pantallas/expediente/librerias.php");

$exp_doc=array();
$id=@$_REQUEST["inicia"];
$excluidos=array();

if(@$_REQUEST["excluidos"])
  $excluidos=explode(",",$_REQUEST["excluidos"]);

if(@$_REQUEST["doc"]){
	$varios=1;
	$varios_docs=explode(",",$_REQUEST["doc"]);
  $documento=busca_filtro_tabla("","expediente_doc","documento_iddocumento in(".$_REQUEST["doc"].")","",$conn);
	$exp_doc=array();
	if(count($varios_docs)==1){
  	$exp_doc=extrae_campo($documento,"expediente_idexpediente","U");
  	$varios=0;
  }
}

$funcionarios=array();
$idfunc=usuario_actual("idfuncionario");
$datos = busca_datos_administrativos_funcionario();

$arreglo_lista2=arreglo_expedientes_asignados();
$lista2=implode(",",$arreglo_lista2);

echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
echo("<tree id=\"0\">\n");
llena_expediente($id);
echo("</tree>\n");

function llena_expediente($id){
global $conn,$sql,$exp_doc,$funcionarios,$excluidos,$datos,$dependencias,$varios,$lista2,$arreglo_lista2;
include_once("permisos_tabla.php");
$lista= "'".implode("','",$datos["series"])."'";
if($id==0){
  $papas=busca_filtro_tabla("*","expediente","idexpediente IN (".$lista2.") AND (cod_padre=0 OR cod_padre IS NULL)","nombre ASC",$conn);
	if(!$papas["numcampos"]){
		$papas=busca_filtro_tabla("*","expediente","serie_idserie IN (".$lista.") AND (cod_padre=0 OR cod_padre IS NULL)","nombre ASC",$conn);
	}
}
else{
	$papas=busca_filtro_tabla("*","expediente","cod_padre=".$id,"nombre ASC",$conn);
} 

if($papas["numcampos"])
{ 
  for($i=0; $i<$papas["numcampos"]; $i++)
  {$permitido=0;
   $permisos_exp=busca_filtro_tabla("editar_todos,propietario","expediente","idexpediente=".$papas[$i]["idexpediente"],"",$conn);
	 if(in_array($papas[$i]["idexpediente"],$arreglo_lista2)){
	 	$permitido=1;
	 }
	 else continue;
  if(!in_array($papas[$i]["idexpediente"],$excluidos))
   {echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
    echo("text=\"".htmlspecialchars($papas[$i]["nombre"])." \" id=\"".$papas[$i]["idexpediente"]."\"");
    if(@$_REQUEST["doc"]){
      if($_REQUEST["accion"]==1 && in_array($papas[$i]["idexpediente"],$exp_doc)){
      	if(!$varios){
      		echo(" checked=\"1\" ");
      	}
				else{
        	echo(" nocheckbox=\"1\" ");
				}
			}
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