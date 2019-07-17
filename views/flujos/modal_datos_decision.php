<?php
$objeto64 = $_REQUEST["objeto"];
$salida64 = $_REQUEST["salidas"];
$objetoBpmn = json_decode(base64_decode($objeto64));
$salidaBpmn = json_decode(base64_decode($salida64));
//var_dump($objetoBpmn);
var_dump($salidaBpmn);