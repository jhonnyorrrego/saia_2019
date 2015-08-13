<?php
include_once("db.php");
if(isset($_REQUEST["idbusqueda"])&&$_REQUEST["idbusqueda"])
{$datos=busca_filtro_tabla("","campo_busqueda_usuario","busqueda_usuario=".$_REQUEST["idbusqueda"],"",$conn);
 
 for($i=0;$i<$datos["numcampos"];$i++)
   echo $datos[$i]["campo"]."|".$datos[$i]["valor"]."||";
}
elseif(isset($_REQUEST["borrar_busqueda"])&&$_REQUEST["borrar_busqueda"])
{phpmkr_query("delete from busqueda_usuario where idbusqueda_usuario=".$_REQUEST["borrar_busqueda"]);
 phpmkr_query("delete from campo_busqueda_usuario where busqueda_usuario=".$_REQUEST["borrar_busqueda"]);
 $datos=busca_filtro_tabla("","busqueda_usuario","idbusqueda_usuario=".$_REQUEST["borrar_busqueda"],"",$conn);
 echo $datos["numcampos"];
}
elseif(isset($_REQUEST["etiqueta"])&&$_REQUEST["etiqueta"])
{$cuantas=busca_filtro_tabla("count(*)","busqueda_usuario","funcionario='".usuario_actual("funcionario_codigo")."'","",$conn);
 if($cuantas[0][0]<15)
 {$datos=busca_filtro_tabla("","busqueda_usuario","lower(etiqueta) like'".strtolower(trim($_REQUEST["etiqueta"]))."' and funcionario='".usuario_actual("funcionario_codigo")."'","",$conn);
  echo $datos["numcampos"];
 }
 else
   echo "-1";   
}
?>