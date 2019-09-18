<?php
include_once("../../db.php");
$datos_ejecutor=busca_filtro_tabla("iddatos_ejecutor","datos_ejecutor,ejecutor","ejecutor_idejecutor=idejecutor and ejecutor_idejecutor=".$_REQUEST["idejecutor"],"fecha desc");
if($datos_ejecutor["numcampos"])
  echo "|".$datos_ejecutor[0][0];
else
  echo "|0";  
?>