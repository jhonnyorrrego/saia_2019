<?php
include_once("db.php");
$activos=busca_filtro_tabla("","documento","estado='ACTIVO'","iddocumento",$conn);
for($i=0;$i<$activos["numcampos"];$i++){
  $sql1="INSERT INTO permiso_documento (funcionario, documento_iddocumento, permisos) VALUES ('".$activos[$i]["ejecutor"]."', '".$activos[$i]["iddocumento"]."','e,m,r')";
  echo $i."---->".$activos[$i]["iddocumento"]."<br>";
  phpmkr_query($sql1);
}
?>
