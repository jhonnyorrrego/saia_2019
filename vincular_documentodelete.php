<?php
include_once("db.php");
if($_REQUEST["id"])
  {$sql='delete from documento_vinculados where iddocumento_vinculados='.$_REQUEST['id'];
   phpmkr_query($sql);
   alerta('Registro eliminado.');
   redirecciona('vincular_documentoview.php?iddoc='.$_REQUEST['iddoc']); 
  }
?>