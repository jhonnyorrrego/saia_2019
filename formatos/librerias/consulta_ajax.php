<?php
include_once("../../db.php");

if($_REQUEST["tabla"] && $_REQUEST["campo"] && $_REQUEST["llave"] && $_REQUEST["id"])
   {$dato=busca_filtro_tabla($_REQUEST["campo"],$_REQUEST["tabla"],$_REQUEST["llave"]."=".$_REQUEST["id"],"");
    echo "<input type='text' name='".$_REQUEST["campo"]."' value='".$dato[0][0]."' obligatorio='".$_REQUEST["obligatorio"]."'  id='".$_REQUEST["campo"]."' size=100>";
   }
else
  echo "<input type='text' name='".$_REQUEST["campo"]."' value='' obligatorio='".$_REQUEST["obligatorio"]."'  id='".$_REQUEST["campo"]."' size=100>";
?>
