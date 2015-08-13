<?php
include_once("db.php");
$ruta="foldergraf.php";
if($_REQUEST["key"])
 {$folder=busca_filtro_tabla("caja_idcaja","folder","idfolder=".$_REQUEST["key"],"",$conn);
  phpmkr_query("delete from folder where idfolder=".$_REQUEST["key"]);
  phpmkr_query("delete from almacenamiento where folder_idfolder=".$_REQUEST["key"]);
  alerta("Carpeta Eliminada");
  $ruta.="?caja=".$folder[0]["caja_idcaja"];  
 }
redirecciona($ruta);  
?>