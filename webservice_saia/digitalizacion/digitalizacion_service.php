<?php
class TareasDigitalizacion {

public function getTareasDigitalizacion($inmessage) {
return "Hello $inmessage!";
}
} //end class

ini_set("soap.wsdl_cache_enabled", "0");
$server = new SoapServer("digitalizacion.wsdl");
$server->setClass("TareasDigitalizacion");
$server->handle();

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='POST')
$server->handle();
else {
$wsdl = @implode ('', @file ('digitalizacion.wsdl'));
if (strlen($wsdl) > 1) {
header("Content-type: text/xml");
echo $wsdl;
}
}



?>
