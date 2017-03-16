<?php 
//ini_set("display_errors",true);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 ISO-8859-1
require_once("db.php");
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) 
{ 
  header("Content-type: application/xhtml+xml"); 
} 
else 
{ 
  header("Content-type: text/xml"); 
}

//echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");

$seleccionados = array('1087997725','42161003','599','268');
echo("<tree id=\"0\">\n");
llena_funcionario();
echo("</tree>\n");
function llena_funcionario(){
	global $conn,$seleccionados;
	$usuarios=busca_filtro_tabla("*","funcionario A","A.estado=1 AND funcionario_codigo IN (".implode(",",$seleccionados).")","",$conn);
	//print_r($usuarios);
	if($usuarios["numcampos"]){
		for($i=0;$i<$usuarios["numcampos"];$i++){
			$cargo=busca_filtro_tabla("","funcionario a, cargo c, dependencia_cargo d","a.idfuncionario = d.funcionario_idfuncionario
AND d.estado =1
AND d.cargo_idcargo = c.idcargo
AND a.funcionario_codigo=".$usuarios[$i]["funcionario_codigo"],"d.iddependencia_cargo",$conn);
			
			echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
			
			echo("text=\"".ucwords((codifica_caracteres($usuarios[$i]["nombres"]." ".$usuarios[$i]["apellidos"])))." (".$cargo[0]["nombre"].") \" id=\"".$cargo[0]["iddependencia_cargo"]."\">");
			echo("</item>\n");
		} 
	    
	}
}


function codifica_caracteres($original){
$codificada=str_replace("ACUTE;","acute;",$original);
$codificada=str_replace("TILDE;","tilde;",$codificada);
return($codificada);
}
?>