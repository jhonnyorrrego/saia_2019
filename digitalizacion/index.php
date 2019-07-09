<?php
require_once '../vendor/restler.php';

use Luracast\Restler\Restler;

$r = new Restler();
//$r->setAPIVersion(1);
$r->setSupportedFormats('JsonFormat', 'XmlFormat');
$r->addAPIClass('Digitalizacion'); // repeat for more
$r->handle(); //serve the response
