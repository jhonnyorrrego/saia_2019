<?php 
include_once ("db.php");
$tabla = "modulo";
$id = @$_REQUEST["id"];

if (isset($_REQUEST["permiso_admin"])){
	$activo = " and permiso_admin = " . $_REQUEST["permiso_admin"];
}else{
	$activo = " and permiso_admin=0";
	$admin = 0;
}

$configuracion = busca_filtro_tabla("A.valor", "configuracion A", "A.tipo='usuario' AND A.nombre='login_administrador'", "", $conn);
if ($configuracion["numcampos"] && trim($configuracion[0]["valor"]) == trim($_SESSION["LOGIN" . LLAVE_SAIA])) {
	$admin = 1;
$activo="";
}

if (isset($_REQUEST["estado"]) && $_REQUEST["estado"] != "") {
	$activo .= " and estado = 1";
}

  $seleccionado=array(); 
if (isset($_REQUEST["seleccionado"])) {
	$seleccionado = explode(",", $_REQUEST["seleccionado"]);
}
   
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) { 
  header("Content-type: application/xhtml+xml"); 
} else { 
  header("Content-type: text/xml"); 
}
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
echo("<tree id=\"0\">\n");  
//si paso la entidad, para que marque las series relacionadas
if(@$_REQUEST["entidad"] && @$_REQUEST["llave_entidad"]){
   if($_REQUEST["entidad"]=="funcionario"){
    $asignados=busca_filtro_tabla("distinct modulo_idmodulo","permiso","funcionario_idfuncionario=".$_REQUEST["llave_entidad"],"",$conn); 
    $seleccionado=extrae_campo($asignados,"modulo_idmodulo","U");     
   }else{
    $asignados=busca_filtro_tabla("distinct modulo_idmodulo","permiso_perfil","perfil_idperfil=".$_REQUEST["llave_entidad"],"",$conn); 
    $seleccionado=extrae_campo($asignados,"modulo_idmodulo","U");
   }
}
  
if($id){
 $inicio=busca_filtro_tabla("*",$tabla,"id$tabla=$id","",$conn);
 echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
 echo("text=\"".($inicio[0]["nombre"])."(".$inicio[0]["codigo"].") \" id=\"".$inicio[0]["id$tabla"]."\" checked=\"1\" >\n");
 llena_serie($id);
 echo("</item>\n");
}else{
  llena_serie("NULL");
}  
echo("</tree>\n");

function llena_serie($serie,$condicion=""){
global $conn,$tabla,$seleccionado,$activo,$id;
	if ($serie == "NULL") {
  $papas=busca_filtro_tabla("*",$tabla,"(cod_padre IS NULL OR cod_padre=0) $activo $condicion","etiqueta ASC",$conn);
	} else {
  $papas=busca_filtro_tabla("*",$tabla,"cod_padre=".$serie.$activo.$condicion,"etiqueta ASC",$conn);
	}
if($papas["numcampos"]){ 
  for($i=0; $i<$papas["numcampos"]; $i++){
    echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
    echo "text=\"".(htmlspecialchars($papas[$i]["etiqueta"]))." (".$papas[$i]["nombre"].") \" ";

    echo " id=\"".$papas[$i]["idmodulo"]."\"";
			if (in_array($papas[$i]["idmodulo"], $seleccionado) !== false) {
      echo " checked=\"1\" ";
			}
    echo(" >\n");
    llena_serie($papas[$i]["id$tabla"]);
    echo("</item>\n");
  }     
}
return;
}
?>