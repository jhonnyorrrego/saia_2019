<?php 
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}

//ini_set("display_errors",true);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 ISO-8859-1

if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) 
{ 
  header("Content-type: application/xhtml+xml"); 
} 
else 
{ 
  header("Content-type: text/xml"); 
}

echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");

include_once($ruta_db_superior."db.php");

$tabla=$_REQUEST['tabla'];
$condicion="";
if($_REQUEST['categoria']){
	$condicion.=' AND lower(categoria)="'.$_REQUEST['categoria'].'"';
}

if($_REQUEST['estado']){
	$condicion.=' AND estado="'.$_REQUEST['estado'].'"';
}
echo("<tree id=\"0\">\n"); 
llena_arbol('',$tabla,$condicion);
echo("</tree>\n");

function llena_arbol($id=0,$tabla,$condicion){
	
	if(!$id){
		$consulta=busca_filtro_tabla("",$tabla,"cod_padre IS NULL OR cod_padre=0 OR cod_padre=''".$condicion,"nombre ASC",$conn);
	}else{
		$consulta=busca_filtro_tabla("",$tabla,"cod_padre=".$id.$condicion,"nombre ASC",$conn);
	}
	if($consulta['numcampos']){
		for($i=0;$i<$consulta['numcampos'];$i++){
			$consulta_hijos=busca_filtro_tabla("",$tabla,"cod_padre=".$consulta[$i]['id'.$tabla].$condicion,"nombre ASC",$conn);
			echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"".$consulta[$i]['nombre']."\" id=\"".$consulta[$i]['id'.$tabla]."\" ");
			
			if($consulta_hijos['numcampos']){
				echo("child=\"1\"  >\n");
				llena_arbol($consulta[$i]['id'.$tabla],$tabla,$condicion);
			}else{
				echo("child=\"0\"  >\n");
			}
			
			echo("</item>\n");
		}
	}
}

?>