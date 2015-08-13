<?php
include_once("db.php");
if($_REQUEST["key"])
  phpmkr_query("delete from caja where idcaja=".$_REQUEST["key"]);
alerta("Caja Eliminada");
redirecciona("cajagraf.php");  
?>