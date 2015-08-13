<?php
include_once("db.php");
$sql="UPDATE documento SET pdf=replace(pdf,'out','pdf') WHERE 1=1";
die($sql);
$conn->Ejecutar_Sql($sql,$conn);
?>