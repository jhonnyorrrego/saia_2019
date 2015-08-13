<?php

/*WEBURL points the URL where application is installed.
 *It is used mainly by the email engine or cron script to add proper back links
 *to the application.
 */

//where diagrams will be stored
define('STOREFOLDER','~multipro/saia1.06/diagramo'); //no trailing slashes


/**Store the version of the editor. Usefull in bugs and software update*/
define('VERSION', '1.1');


#debug information
define('DEBUG', false);

#define if running as script or as service
define('SERVICE', false);

#SMTP settings
define('SMTP_ENABLE', false);
define('SMTP_HOST', 'ssl://smtp.gmail.com');
define('SMTP_PORT', '465');
define('SMTP_USERNAME', 'scriptoid2010@gmail.com');
define('SMTP_PASSWORD', '#####');
#end SMTP settings
?>
