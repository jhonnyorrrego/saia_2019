<?php
$_SESSION["LOGIN".LLAVE_SAIA]="cerok";
include_once("db.php");
$datos=busca_filtro_tabla("","funcionario","login='cerok'","");
print_r($datos);
?>  