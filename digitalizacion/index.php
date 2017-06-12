<?php
//require_once __DIR__ . '/../vendor/autoload.php';

ini_set("display_errors", true);

//require_once '../vendor/luracast/restler/vendor/restler.php';

require_once '../vendor/restler.php';

use Luracast\Restler\Restler;

$r = new Restler();
//$r->setAPIVersion(1);
$r->setSupportedFormats('JsonFormat', 'XmlFormat');
$r->addAPIClass('Digitalizacion'); // repeat for more
$r->handle(); //serve the response
