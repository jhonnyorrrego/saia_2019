<?php
include_once("pantallas/busquedas/servidor.php");
$response->pendientes=rand();
echo stripslashes(json_encode($response));
?>