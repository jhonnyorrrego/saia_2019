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
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
if($id and $id<>"")
  echo("<tree id=\"".$id."\">\n"); 
else
  echo("<tree id=\"0\">\n");
include_once($ruta_db_superior."db.php");
$permiso=new Permiso();
if($id==''){
	$padre='modulo_formatos';
	$modulo=busca_filtro_tabla("","modulo","nombre='".$padre."'","",$conn);
	$id=$modulo[0]["idmodulo"];
}
echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Formatos\" id=\"-1\" nocheckbox=\"1\">\n");
if($id and $id<>"")
  llena_formato($id);
else
  llena_formato("NULL");
echo("</item>");
echo("</tree>\n");
?>
<?php

function llena_formato($id){
global $conn,$sql,$permiso;
$adicional=" and busqueda='1' ";
if(usuario_actual('login')=='cerok'){
	$adicional="";
}
if($id=="NULL"){
  $papas=busca_filtro_tabla("*","modulo","cod_padre=0".$adicional,"etiqueta ASC",$conn);
}
else{
  $papas=busca_filtro_tabla("*","modulo","cod_padre=".$id.$adicional,"etiqueta ASC",$conn);
}

if($papas["numcampos"])
{ 
  for($i=0; $i<$papas["numcampos"]; $i++)
  {
  	$formato=busca_filtro_tabla("","formato a","item<>'1' AND fk_categoria_formato LIKE ('%20%') AND lower(a.nombre)='".strtolower($papas[$i]["nombre"])."'","",$conn);
  	if(!$formato["numcampos"])continue;
		$ok=$permiso->acceso_modulo_perfil(strtolower($papas[$i]["nombre"]));
		if(!$ok&&usuario_actual('login')!="cerok")continue;
    $hijos = busca_filtro_tabla("count(*)","modulo","cod_padre=".$papas[$i]["idmodulo"],"",$conn);
	
    echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
    echo("text=\"".htmlspecialchars(ucfirst(strtolower($papas[$i]["etiqueta"])))." \" id=\"'".strtoupper($papas[$i]["nombre"])."'\" ");
    if($hijos[0][0])
      echo(" child=\"1\">\n");
    else
      echo(" child=\"0\">\n");
	if($hijos["numcampos"]>0){
		llena_formato($papas[$i]["idmodulo"]);
	}
    echo("</item>\n");
  }     
}
return;
}
?>
