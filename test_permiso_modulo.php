<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0
$tabla = "modulo";
$id = @$_REQUEST["id"];
$activo="";
if(isset($_REQUEST["estado"]) && $_REQUEST["estado"]!="")
{
 $activo = " and estado = 1"; 
}
if(isset($_REQUEST["permiso_admin"]))
  $activo .= " and permiso_admin = ".$_REQUEST["permiso_admin"]; 
if(isset($_REQUEST["seleccionado"]))
  $seleccionado=explode(",",$_REQUEST["seleccionado"]);
else
  $seleccionado=array(); 
   
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) { 
  header("Content-type: application/xhtml+xml"); 
} 
else { 
  header("Content-type: text/xml"); 
}
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
echo("<tree id=\"0\">\n");  
include_once("db.php");

//si paso la entidad, para que marque las series relacionadas
if(@$_REQUEST["entidad"] && @$_REQUEST["llave_entidad"])
{if($_REQUEST["entidad"]=="funcionario")
   {$asignados=busca_filtro_tabla("distinct modulo_idmodulo","permiso","funcionario_idfuncionario=".$_REQUEST["llave_entidad"],"",$conn); 
    $seleccionado=extrae_campo($asignados,"modulo_idmodulo","U");     
   }
 else
   {$asignados=busca_filtro_tabla("distinct modulo_idmodulo","permiso_perfil","perfil_idperfil=".$_REQUEST["llave_entidad"],"",$conn); 
    $seleccionado=extrae_campo($asignados,"modulo_idmodulo","U");
   }
}
  
if($id)
{$inicio=busca_filtro_tabla("*",$tabla,"id$tabla=$id","",$conn);
 echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
 echo("text=\"".($inicio[0]["nombre"])."(".$inicio[0]["codigo"].") \" id=\"".$inicio[0]["id$tabla"]."\" checked=\"1\" >\n");
 llena_serie($id);
 echo("</item>\n");
}
else
{
  llena_serie("NULL");
}  
echo("</tree>\n");

function llena_serie($serie,$condicion=""){
global $conn,$tabla,$seleccionado,$activo,$id;

if($serie=="NULL")
  $papas=busca_filtro_tabla("*",$tabla,"(cod_padre IS NULL OR cod_padre=0) $activo $condicion","etiqueta ASC",$conn);
else
  $papas=busca_filtro_tabla("*",$tabla,"cod_padre=".$serie.$activo.$condicion,"etiqueta ASC",$conn);

if($papas["numcampos"])
{ 
  for($i=0; $i<$papas["numcampos"]; $i++)
  {/*$hijos = busca_filtro_tabla("count(*)",$tabla,"cod_padre=".$papas[$i]["id$tabla"].$activo.$condicion,"",$conn);
   $hijos_seleccionados = busca_filtro_tabla("count(*)",$tabla,"cod_padre=".$papas[$i]["id$tabla"]." and idmodulo in(".implode(',',$seleccionado).")","",$conn);*/
    echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
    echo "text=\"".(htmlspecialchars($papas[$i]["etiqueta"]))." (".$papas[$i]["nombre"].") \" ";
    /*if(isset($_REQUEST["filtro_perfil"]))
      {
       if(in_array($papas[$i]["idmodulo"],$seleccionado)!==false)
          {if(!$hijos[0][0]) //si no tiene hijos
             echo ' opcion="quitar" im0="green.gif" im1="green.gif" im2="green.gif " ';         
           elseif($hijos_seleccionados[0][0]==$hijos[0][0]) //si todos los hijos estan seleccionados
              echo ' opcion="quitar" im0="green.gif" im1="green.gif" im2="green.gif " ';
           elseif($hijos_seleccionados[0][0])  //si solo algunos est�n seleccionados
             echo ' opcion="adicionar" im0="blue.gif" im1="blue.gif" im2="blue.gif " ';
           else //si no hay hijos seleccionados
             echo ' opcion="adicionar" im0="red.gif" im1="red.gif" im2="red.gif " ';           
          } 
       elseif($hijos_seleccionados[0][0])  //si solo algunos est�n seleccionados
         echo ' opcion="adicionar" im0="blue.gif" im1="blue.gif" im2="blue.gif " ';
       else
         echo ' opcion="adicionar" im0="red.gif" im1="red.gif" im2="red.gif " '; 
      }*/

    echo " id=\"".$papas[$i]["idmodulo"]."\"";
    if(in_array($papas[$i]["idmodulo"],$seleccionado)!==false)
      echo " checked=\"1\" ";
        
    /*if($hijos[0][0])
      echo(" child=\"1\">\n");
    else
      echo(" child=\"0\">\n");*/
    echo(" >\n");
    llena_serie($papas[$i]["id$tabla"]);
    echo("</item>\n");
  }     
}
return;
}
?>
